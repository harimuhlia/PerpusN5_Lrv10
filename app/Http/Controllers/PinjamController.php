<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Pinjam;
use Carbon\Carbon;

class PinjamController extends Controller
{
    public function index(Request $request)
    {
        $query = Pinjam::with(['user.kelas', 'buku']);

        // ROLE
        if (auth()->user()->role != 'admin') {
            $query->where('user_id', auth()->id());
        }

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {

                $q->whereHas('user', function ($u) use ($request) {
                    $u->where('name', 'like', '%' . $request->search . '%');
                })

                ->orWhereHas('buku', function ($b) use ($request) {
                    $b->where('judul', 'like', '%' . $request->search . '%');
                })

                ->orWhere('status', 'like', '%' . $request->search . '%');

            });
        }

        $pinjam = $query->latest()->paginate(10);

        return view('pinjam.index', compact('pinjam'));
    }

    public function create($id)
    {
        $buku = Buku::findOrFail($id);
        return view('pinjam.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'durasi_pinjam' => 'required|integer|min:1|max:30',
            'jumlah' => 'required|integer|min:1|max:100',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($request->jumlah > $buku->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia');
        }

        Pinjam::create([
            'user_id' => auth()->id(),
            'buku_id' => $request->buku_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => now(),
            'durasi_pinjam' => $request->durasi_pinjam,
            'tanggal_kembali' => Carbon::now()->addDays($request->durasi_pinjam),
            'status' => 'pending',
        ]);

        return redirect()->route('pinjam.index')
            ->with('success', 'Request peminjaman berhasil');
    }

    public function show($id)
    {
        $pinjam = Pinjam::with(['user.kelas', 'buku'])
            ->findOrFail($id);

        return view('pinjam.show', compact('pinjam'));
    }

    public function setujui($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        if ($pinjam->buku->stok < $pinjam->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $pinjam->update([
            'status' => 'dipinjam'
        ]);

        $pinjam->buku->decrement('stok', $pinjam->jumlah);

        return redirect()->route('pinjam.index')
            ->with('success', 'Peminjaman disetujui');
    }

    public function kembalikan($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        // hanya buku dipinjam yang bisa dikembalikan
        if ($pinjam->status != 'dipinjam') {

            return back()->with('error', 'Buku tidak sedang dipinjam');
        }

        $today = Carbon::now();

        $tanggalKembali = Carbon::parse($pinjam->tanggal_kembali);

        $denda = 0;

        if ($today->gt($tanggalKembali)) {

            $selisihHari = $tanggalKembali->diffInDays($today);

            $dendaPerHari = 1000;

            $denda = $selisihHari * $dendaPerHari;
        }

        $pinjam->update([
            'status' => 'dikembalikan',
            'denda' => $denda,
            'tanggal_dikembalikan' => $today,
        ]);

        $pinjam->buku->increment('stok');

        return redirect()->route('pinjam.index')
            ->with('success', 'Buku dikembalikan. Denda: Rp ' . number_format($denda));
    }

    // public function kembalikan($id)
    // {
    //     $pinjam = Pinjam::findOrFail($id);

    //     $today = Carbon::now();
    //     $tanggalKembali = Carbon::parse($pinjam->tanggal_kembali);

    //     $denda = 0;

    //     if ($today->gt($tanggalKembali)) {
    //         $selisihHari = $tanggalKembali->diffInDays($today);
    //         $denda = $selisihHari * 1000;
    //     }

    //     $pinjam->update([
    //         'status' => 'dikembalikan',
    //         'denda' => $denda,
    //         'tanggal_dikembalikan' => $today,
    //     ]);

    //     $pinjam->buku->increment('stok', $pinjam->jumlah);

    //     return redirect()->route('pinjam.index')
    //         ->with('success', 'Buku dikembalikan. Denda: Rp ' . number_format($denda));
    // }

    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->delete();

        return redirect()->route('pinjam.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function trashed()
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $pinjam = Pinjam::onlyTrashed()
            ->with(['buku', 'user.kelas'])
            ->latest()
            ->paginate(10);

        return view('pinjam.trashed', compact('pinjam'));
    }

    public function restore($id)
    {
        $pinjam = Pinjam::onlyTrashed()->findOrFail($id);
        $pinjam->restore();

        return redirect()->route('pinjam.trashed')
            ->with('success', 'Data berhasil direstore');
    }

    public function forceDelete($id)
    {
        $pinjam = Pinjam::onlyTrashed()->findOrFail($id);
        $pinjam->forceDelete();

        return redirect()->route('pinjam.trashed')
            ->with('success', 'Data berhasil dihapus permanen');
    }

    public function batal($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        // hanya boleh dibatalkan kalau masih pending
        if ($pinjam->status !== 'pending') {
            return back()->with('error', 'Peminjaman tidak bisa dibatalkan');
        }

        $pinjam->update([
            'status' => 'dibatalkan'
        ]);

        return redirect()->route('pinjam.index')
            ->with('success', 'Peminjaman berhasil dibatalkan');
    }
}
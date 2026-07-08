<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanManualController extends Controller
{
    public function index(Request $request)
    {
        $query = Pinjam::with(['user.kelas', 'buku']);

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->whereHas('user', function ($u) use ($request) {

                    $u->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('id_register', 'like', '%' . $request->search . '%');
                })

                    ->orWhereHas('buku', function ($b) use ($request) {

                        $b->where('judul', 'like', '%' . $request->search . '%');
                    })

                    ->orWhere('status', 'like', '%' . $request->search . '%');
            });
        }

        $pinjam = $query->latest()->paginate(10);

        return view('peminjaman-manual.index', compact('pinjam'));
    }

    public function create()
    {
        $buku = Buku::orderBy('judul')->get();

        return view('peminjaman-manual.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_register' => 'required',
            'buku_id' => 'required',
            'jumlah' => 'required|integer|min:1|max:100',
            'durasi_pinjam' => 'required|integer|min:1|max:30',
        ]);

        $user = User::where('id_register', $request->id_register)
            ->where('role', 'anggota')
            ->first();

        if (!$user) {
            return back()->withInput()
                ->with('error', 'ID Register tidak ditemukan.');
        }

        $buku = Buku::findOrFail($request->buku_id);

        if ($request->jumlah > $buku->stok) {
            return back()->withInput()
                ->with('error', 'Jumlah melebihi stok tersedia.');
        }

        Pinjam::create([
            'user_id' => $user->id,
            'buku_id' => $request->buku_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => now(),
            'durasi_pinjam' => $request->durasi_pinjam,
            'tanggal_kembali' => Carbon::now()->addDays($request->durasi_pinjam),
            'status' => 'dipinjam',
        ]);

        $buku->decrement('stok', $request->jumlah);

        return redirect()->route('pinjam.index')
            ->with('success', 'Peminjaman berhasil disimpan.');
    }

    public function show($id)
    {
        $pinjam = Pinjam::with(['user.kelas', 'buku'])
            ->findOrFail($id);

        return view('peminjaman-manual.show', compact('pinjam'));
    }

    public function edit($id)
    {
        $peminjaman = Pinjam::with('user', 'buku')->findOrFail($id);
        $buku = Buku::all();

        return view('peminjaman-manual.edit', compact('peminjaman', 'buku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'buku_id' => 'required',
            'jumlah' => 'required|integer|min:1|max:100',
            'durasi_pinjam' => 'required|integer|min:1|max:30',
        ]);

        $pinjam = Pinjam::findOrFail($id);

        $bukuLama = Buku::findOrFail($pinjam->buku_id);
        $bukuBaru = Buku::findOrFail($request->buku_id);

        // Kembalikan stok lama
        $bukuLama->increment('stok', $pinjam->jumlah);

        // Cek stok buku baru
        if ($request->jumlah > $bukuBaru->stok) {

            $bukuLama->decrement('stok', $pinjam->jumlah);

            return back()->withInput()
                ->with('error', 'Jumlah melebihi stok tersedia.');
        }

        $pinjam->update([
            'buku_id' => $request->buku_id,
            'jumlah' => $request->jumlah,
            'durasi_pinjam' => $request->durasi_pinjam,
            'tanggal_kembali' => Carbon::parse($pinjam->tanggal_pinjam)
                ->addDays($request->durasi_pinjam),
        ]);

        // Kurangi stok baru
        $bukuBaru->decrement('stok', $request->jumlah);

        return redirect()->route('pinjam.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        if ($pinjam->status == 'dipinjam') {
            $pinjam->buku->increment('stok', $pinjam->jumlah);
        }

        $pinjam->delete();

        return redirect()->route('peminjaman-manual.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function trash()
    {
        $pinjam = Pinjam::onlyTrashed()
            ->with(['buku', 'user.kelas'])
            ->latest()
            ->paginate(10);

        return view('peminjaman-manual.trash', compact('pinjam'));
    }

    public function restore($id)
    {
        $pinjam = Pinjam::onlyTrashed()->findOrFail($id);

        $pinjam->restore();

        return redirect()->route('peminjaman-manual.trash')
            ->with('success', 'Data berhasil direstore.');
    }

    public function forceDelete($id)
    {
        $pinjam = Pinjam::onlyTrashed()->findOrFail($id);

        $pinjam->forceDelete();

        return redirect()->route('peminjaman-manual.trash')
            ->with('success', 'Data berhasil dihapus permanen.');
    }

    public function searchMember(Request $request)
    {
        $member = User::with(['kelas.jurusan'])
            ->where('role', 'anggota')
            ->where('id_register', $request->id_register)
            ->first();

        if (!$member) {

            return response()->json([
                'status' => false,
                'message' => 'Member tidak ditemukan.'
            ]);
        }

        return response()->json([
            'status' => true,
            'member' => [
                'id' => $member->id,
                'name' => $member->name,
                'kelas' => optional($member->kelas)->nama_kelas,
                'jurusan' => optional(optional($member->kelas)->jurusan)->nama_jurusan,
                'email' => $member->email,
                'no_wa' => $member->no_wa
            ]
        ]);
    }
}

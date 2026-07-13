<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $buku = Buku::with(['kategori', 'rak'])
            ->when($search, function ($query) use ($search) {

                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('pengarang', 'like', '%' . $search . '%')
                    ->orWhere('penerbit', 'like', '%' . $search . '%')
                    ->orWhere('kode_buku', 'like', '%' . $search . '%');

            })
            ->latest()
            ->paginate(8);

        return view('katalog.index', compact('buku'));
    }

    public function show($id)
    {
        $buku = Buku::with(['kategori', 'rak'])->findOrFail($id);

        return view('katalog.show', compact('buku'));
    }

    public function pinjamForm($id)
    {
        $buku = Buku::findOrFail($id);

        return view('katalog.pinjam', compact('buku'));
    }

    public function pinjam(Request $request, $id)
    {
        $request->validate([
            'durasi_pinjam' => 'required|integer|min:1',
        ]);

        $buku = Buku::findOrFail($id);

        // stok habis
        if ($buku->stok <= 0) {

            return back()->with('error', 'Stok buku habis');

        }

        Pinjam::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now(),
            'durasi_pinjam' => $request->durasi_pinjam,
            'tanggal_kembali' => now()->addDays($request->durasi_pinjam),
            'status' => 'dipinjam',
        ]);

        // kurangi stok
        $buku->decrement('stok');

        return redirect()->route('katalog.index')
            ->with('success', 'Buku berhasil dipinjam');
    }
}

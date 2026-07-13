<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use App\Exports\BukuExport;
use App\Imports\BukuImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $buku = Buku::with(['kategori', 'rak'])
                    ->when($search, function ($query) use ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('judul', 'LIKE', "%{$search}%")
                            ->orWhere('pengarang', 'LIKE', "%{$search}%")
                            ->orWhere('penerbit', 'LIKE', "%{$search}%")
                            ->orWhere('kode_buku', 'LIKE', "%{$search}%");
                        });
                    })
                    ->latest()
                    ->get();

        return view('buku.index', compact('buku'));
    }
 
    /**
     * Display catalog of the resource.
     */
    public function katalog(Request $request)
    {
        $search = $request->search;

        $buku = Buku::with(['kategori', 'rak'])
                    ->when($search, function ($query) use ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('judul', 'LIKE', "%{$search}%")
                              ->orWhere('pengarang', 'LIKE', "%{$search}%")
                              ->orWhere('penerbit', 'LIKE', "%{$search}%")
                              ->orWhere('kode_buku', 'LIKE', "%{$search}%");
                        });
                    })
                    ->latest()
                    ->paginate(8);

        return view('buku.katalog', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $rak = Rak::all();

        return view('buku.create', compact('kategori', 'rak'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'   => 'required',
            'rak_id'        => 'required',
            'kode_buku'     => 'required|unique:buku,kode_buku',
            'judul'         => 'required',
            'pengarang'     => 'required',
            'penerbit'      => 'required',
            'tahun_terbit'  => 'required|digits:4',
            'stok'          => 'required|integer|min:0',
            'cover'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $cover = null;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover')->store('buku', 'public');
        }

        Buku::create([
            'kategori_id'  => $request->kategori_id,
            'rak_id'       => $request->rak_id,
            'kode_buku'    => $request->kode_buku,
            'judul'        => $request->judul,
            'pengarang'    => $request->pengarang,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'deskripsi'    => $request->deskripsi,
            'cover'        => $cover,
            'stok'         => $request->stok ?? 0,
        ]);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $kategori = Kategori::all();
        $rak = Rak::all();

        return view('buku.edit', compact('buku', 'kategori', 'rak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kategori_id'  => 'required',
            'rak_id'       => 'required',
            'kode_buku'    => 'required|unique:buku,kode_buku,' . $buku->id,
            'judul'        => 'required',
            'pengarang'    => 'required',
            'penerbit'     => 'required',
            'tahun_terbit' => 'required|digits:4',
            'stok'         => 'required|integer|min:0',
            'cover'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $cover = $buku->cover;

        if ($request->hasFile('cover')) {
            // Hapus file cover lama jika ada di dalam folder storage
            if ($buku->cover && Storage::disk('public')->exists($buku->cover)) {
                Storage::disk('public')->delete($buku->cover);
            }

            // Upload file cover baru
            $cover = $request->file('cover')->store('buku', 'public');
        }

        $buku->update([
            'kategori_id'  => $request->kategori_id,
            'rak_id'       => $request->rak_id,
            'kode_buku'    => $request->kode_buku,
            'judul'        => $request->judul,
            'pengarang'    => $request->pengarang,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'deskripsi'    => $request->deskripsi,
            'stok'         => (int) $request->stok,
            'cover'        => $cover,
        ]);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage (Soft Delete).
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil dipindahkan ke trash');
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trash()
    {
        $buku = Buku::onlyTrashed()
                    ->latest()
                    ->paginate(10);

        return view('buku.trash', compact('buku'));
    }

    /**
     * Restore the trashed resource.
     */
    public function restore($id)
    {
        Buku::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('buku.trash')
            ->with('success', 'Data berhasil direstore');
    }

    /**
     * Permanently delete the resource from storage (Force Delete).
     */
    public function forceDelete($id)
    {
        $buku = Buku::onlyTrashed()->findOrFail($id);

        if ($buku->cover && Storage::disk('public')->exists($buku->cover)) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->forceDelete();

        return redirect()->route('buku.trash')
            ->with('success', 'Data berhasil dihapus permanen');
    }

    /**
     * Export data to Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new BukuExport, 'data-buku.xlsx');
    }

    /**
     * Import data from Excel.
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new BukuImport, $request->file('file'));

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diimport');
    }
}

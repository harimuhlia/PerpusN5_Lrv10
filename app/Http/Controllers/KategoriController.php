<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::latest()->paginate(10);

        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Data kategori berhasil ditambahkan');
    }

    public function show(Kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,' . $kategori->id,
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Data kategori berhasil diupdate');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Data kategori berhasil dihapus');
    }

    public function trash()
    {
        $trash = Kategori::onlyTrashed()
                    ->latest()
                    ->get();

        return view('kategori.trash', compact('trash'));
    }

    public function restore(int $id)
    {
        Kategori::onlyTrashed()->where('id', $id)->restore();

        return redirect()->route('kategori.trash')
            ->with('success', 'Data berhasil direstore');
    }

    public function forceDelete(int $id)
    {
        Kategori::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect()->route('kategori.trash')
            ->with('success', 'Data berhasil dihapus permanen');
    }
}

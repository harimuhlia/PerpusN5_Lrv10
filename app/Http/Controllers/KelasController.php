<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('jurusan')
                    ->latest()
                    ->paginate(10);

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();

        return view('kelas.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required',
            'nama_kelas' => 'required',
        ]);

        Kelas::create([
            'jurusan_id' => $request->jurusan_id,
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan');
    }

    public function show(Kelas $kela)
    {
        return view('kelas.show', compact('kela'));
    }

    public function edit(Kelas $kela)
    {
        $jurusan = Jurusan::all();

        return view('kelas.edit', compact('kela', 'jurusan'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'jurusan_id' => 'required',
            'nama_kelas' => 'required',
        ]);

        $kela->update([
            'jurusan_id' => $request->jurusan_id,
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diupdate');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus');
    }

    public function trash()
    {
        $trash = Kelas::onlyTrashed()
                    ->with('jurusan')
                    ->latest()
                    ->get();

        return view('kelas.trash', compact('trash'));
    }

    public function restore(int $id)
    {
        Kelas::onlyTrashed()->where('id', $id)->restore();

        return redirect()->route('kelas.trash')
            ->with('success', 'Data berhasil direstore');
    }

    public function forceDelete(int $id)
    {
        Kelas::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect()->route('kelas.trash')
            ->with('success', 'Data berhasil dihapus permanen');
    }
}

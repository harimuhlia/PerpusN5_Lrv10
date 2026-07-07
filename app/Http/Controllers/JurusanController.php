<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Jurusan::latest()->paginate(10);

        return view('jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|unique:jurusans,nama_jurusan',
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil ditambahkan');
    }

    public function show(Jurusan $jurusan)
    {
        return view('jurusan.show', compact('jurusan'));
    }

    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama_jurusan' => 'required|unique:jurusans,nama_jurusan,' . $jurusan->id,
        ]);

        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil diupdate');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil dihapus');
    }

    public function trash()
    {
        $trash = Jurusan::onlyTrashed()->latest()->get();

        return view('jurusan.trash', compact('trash'));
    }

    public function restore($id)
    {
        Jurusan::onlyTrashed()->where('id', $id)->restore();

        return redirect()->route('jurusan.trash')
            ->with('success', 'Data berhasil direstore');
    }

    public function forceDelete($id)
    {
        Jurusan::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect()->route('jurusan.trash')
            ->with('success', 'Data berhasil dihapus permanen');
    }
}

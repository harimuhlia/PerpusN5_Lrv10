<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rak = Rak::latest()->paginate(10);

        return view('rak.index', compact('rak'));
    }

    public function create()
    {
        return view('rak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_rak' => 'required|unique:raks,kode_rak',
            'nama_rak' => 'required',
        ]);

        Rak::create([
            'kode_rak' => $request->kode_rak,
            'nama_rak' => $request->nama_rak,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('rak.index')
            ->with('success', 'Data rak berhasil ditambahkan');
    }

    public function show(Rak $rak)
    {
        return view('rak.show', compact('rak'));
    }

    public function edit(Rak $rak)
    {
        return view('rak.edit', compact('rak'));
    }

    public function update(Request $request, Rak $rak)
    {
        $request->validate([
            'kode_rak' => 'required|unique:raks,kode_rak,' . $rak->id,
            'nama_rak' => 'required',
        ]);

        $rak->update([
            'kode_rak' => $request->kode_rak,
            'nama_rak' => $request->nama_rak,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('rak.index')
            ->with('success', 'Data rak berhasil diupdate');
    }

    public function destroy(Rak $rak)
    {
        $rak->delete();

        return redirect()->route('rak.index')
            ->with('success', 'Data rak berhasil dihapus');
    }

    public function trash()
    {
        $trash = Rak::onlyTrashed()
                    ->latest()
                    ->get();

        return view('rak.trash', compact('trash'));
    }

    public function restore(int $id)
    {
        Rak::onlyTrashed()->where('id', $id)->restore();

        return redirect()->route('rak.trash')
            ->with('success', 'Data berhasil direstore');
    }

    public function forceDelete(int $id)
    {
        Rak::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect()->route('rak.trash')
            ->with('success', 'Data berhasil dihapus permanen');
    }
}

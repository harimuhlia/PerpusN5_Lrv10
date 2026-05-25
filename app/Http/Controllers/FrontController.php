<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class FrontController extends Controller
{
    public function index()
    {
        $search = request('search');

        $buku = Buku::when($search, function ($query, $search) {

            $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('pengarang', 'like', '%' . $search . '%')
                ->orWhere('kode_buku', 'like', '%' . $search . '%');

        })->latest()->paginate(8);
        return view('front.index', compact('buku'));
    }

    public function detailBuku($id)
    {
        $buku = Buku::with([
                    'kategori',
                    'rak'
                ])->findOrFail($id);

        $rekomendasi = Buku::latest()
                        ->where('id', '!=', $id)
                        ->take(4)
                        ->get();

        return view('front.detail-buku', compact(
            'buku',
            'rekomendasi'
        ));
    }
}
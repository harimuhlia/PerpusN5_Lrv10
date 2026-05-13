<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pinjam;
use App\Models\User;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        return view('pengembalian.index');
    }

    public function cari(Request $request)
    {
        $request->validate([
            'keyword' => 'required'
        ]);

        $member = User::where('id_register', $request->keyword)
            ->orWhere('name', 'like', '%' . $request->keyword . '%')
            ->first();

        $pinjam = [];

        if ($member) {

            $pinjam = Pinjam::with(['buku', 'user'])
                ->where('user_id', $member->id)
                ->where('status', 'dipinjam')
                ->latest()
                ->get();
        }

        return view('pengembalian.index', compact('member', 'pinjam'));
    }

    public function proses($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        $today = Carbon::now();

        $tanggalKembali = Carbon::parse($pinjam->tanggal_kembali);

        $denda = 0;

        if ($today->gt($tanggalKembali)) {

            $telat = $tanggalKembali->diffInDays($today);

            $denda = $telat * 1000;
        }

        $pinjam->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => $today,
            'denda' => $denda,
        ]);

        // kembalikan stok
        $pinjam->buku->increment('stok', $pinjam->jumlah);

        return redirect()->route('pengembalian.index')
            ->with('success', 'Buku berhasil dikembalikan');
    }
}

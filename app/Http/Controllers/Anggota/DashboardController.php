<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pinjam;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistik
        $dipinjam = Pinjam::where('user_id', $user->id)
            ->where('status', 'dipinjam')
            ->count();

        $dikembalikan = Pinjam::where('user_id', $user->id)
            ->where('status', 'dikembalikan')
            ->count();

        // Contoh total denda
        $denda = Pinjam::where('user_id', $user->id)
            ->sum('denda');

        // List peminjaman terbaru
        $pinjam = Pinjam::with('buku')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('anggota.dashboard', compact(
            'dipinjam',
            'dikembalikan',
            'denda',
            'pinjam'
        ));
    }
}

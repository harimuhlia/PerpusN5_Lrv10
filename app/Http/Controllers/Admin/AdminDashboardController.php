<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\User;
use App\Models\Pinjam;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalMember = User::where('role', 'anggota')->count();
        $totalPinjam = Pinjam::count();
        $pinjamAktif = Pinjam::where('status', 'dipinjam')->count();
        $pinjamTerbaru = Pinjam::with(['user', 'buku'])
            ->latest()
            ->get();

        return view('dashboard', compact(
            'totalBuku',
            'totalMember',
            'totalPinjam',
            'pinjamAktif',
            'pinjamTerbaru'
        ));
    }
}

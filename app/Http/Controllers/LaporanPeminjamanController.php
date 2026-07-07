<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjam;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPeminjamanExport;

class LaporanPeminjamanController extends Controller
{
    /**
     * Filter yang digunakan oleh halaman,
     * PDF dan Excel.
     */
    private function filter(Request $request)
    {
        $query = Pinjam::with(['user', 'buku']);

        // ==========================
        // SEARCH MEMBER
        // ==========================
        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('user', function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('id_register', 'like', "%{$search}%");

            });

        }

        // ==========================
        // STATUS
        // ==========================
        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        // ==========================
        // TANGGAL AWAL
        // ==========================
        if ($request->filled('tanggal_awal')) {

            $query->whereDate(
                'tanggal_pinjam',
                '>=',
                $request->tanggal_awal
            );

        }

        // ==========================
        // TANGGAL AKHIR
        // ==========================
        if ($request->filled('tanggal_akhir')) {

            $query->whereDate(
                'tanggal_pinjam',
                '<=',
                $request->tanggal_akhir
            );

        }

        return $query;
    }

    public function index(Request $request)
    {
        $laporan = $this->filter($request)
                ->latest()
                ->get();

        return view('laporan.peminjaman.index', compact('laporan'));
    }

    public function pdf(Request $request)
    {
        $laporan = $this->filter($request)
                        ->latest()
                        ->get();

        $pdf = Pdf::loadView(
            'laporan.peminjaman.pdf',
            compact('laporan')
        )->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-peminjaman.pdf');
    }

    public function excel(Request $request)
    {
        $data = $this->filter($request)
                     ->latest()
                     ->get();

        return Excel::download(
            new LaporanPeminjamanExport($data),
            'laporan-peminjaman.xlsx'
        );
    }
}
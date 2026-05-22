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
    public function index(Request $request)
    {
        $query = Pinjam::with(['user', 'buku']);

        // SEARCH
        if ($request->search) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('id_register', 'like', '%' . $request->search . '%');

            });
        }

        // FILTER STATUS
        if ($request->status) {

            $query->where('status', $request->status);

        }

        // FILTER TANGGAL
        if ($request->tanggal_awal && $request->tanggal_akhir) {

            $query->whereBetween('tanggal_pinjam', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        // FILTER MEMBER
        if ($request->member_id) {

            $query->where('user_id', $request->member_id);

        }

        $laporan = $query->latest()->paginate(10);

        $member = User::where('role', 'anggota')->get();

        return view('laporan.peminjaman.index', compact(
            'laporan',
            'member'
        ));
    }

    public function pdf(Request $request)
    {
        $query = Pinjam::with(['user', 'buku']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->tanggal_awal && $request->tanggal_akhir) {

            $query->whereBetween('tanggal_pinjam', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $laporan = $query->latest()->get();

        $pdf = Pdf::loadView('laporan.peminjaman.pdf', compact('laporan'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-peminjaman.pdf');
    }

    public function excel(Request $request)
    {
        $query = Pinjam::with(['user', 'buku']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->tanggal_awal && $request->tanggal_akhir) {

            $query->whereBetween('tanggal_pinjam', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $data = $query->latest()->get();

        return Excel::download(
            new LaporanPeminjamanExport($data),
            'laporan-peminjaman.xlsx'
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\PembayaranDenda;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PembayaranDendaExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class PembayaranDendaController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = PembayaranDenda::with([
            'pinjam.user.kelas',
            'pinjam.buku',
            'petugas'
        ]);

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween(
                'tanggal_bayar',
                [$tanggalAwal, $tanggalAkhir]
            );
        }

        $pembayaran = $query
            ->latest()
            ->get();

        $laporan = PembayaranDenda::query();

        if ($tanggalAwal && $tanggalAkhir) {
            $laporan->whereBetween(
                'tanggal_bayar',
                [$tanggalAwal, $tanggalAkhir]
            );
        }

        $totalDenda = (clone $laporan)->sum('nominal');

        $totalTransaksi = (clone $laporan)->count();

        $totalHariIni = (clone $laporan)
            ->whereDate('tanggal_bayar', today())
            ->sum('nominal');

        $totalBulanIni = (clone $laporan)
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('nominal');

        return view(
            'pembayaran-denda.index',
            compact(
                'pembayaran',
                'totalDenda',
                'totalHariIni',
                'totalBulanIni',
                'totalTransaksi',
                'tanggalAwal',
                'tanggalAkhir'
            )
        );
    }

    public function create($pinjam_id)
    {
        $pinjam = Pinjam::with([
            'user.kelas',
            'buku',
            'pembayaranDenda'
        ])->findOrFail($pinjam_id);

        if ($pinjam->status != 'dikembalikan') {
            return redirect()->route('pinjam.index')
                ->with('error', 'Pembayaran hanya dapat dilakukan setelah buku dikembalikan.');
        }

        if ($pinjam->denda <= 0) {
            return redirect()->route('pinjam.index')
                ->with('error', 'Peminjaman ini tidak memiliki denda.');
        }

        if ($pinjam->pembayaranDenda) {
            return redirect()->route('pinjam.index')
                ->with('error', 'Denda sudah dibayar.');
        }

        return view('pembayaran-denda.create', compact('pinjam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pinjam_id' => 'required|exists:pinjams,id',
            'nominal' => 'required|numeric|min:1',
            'tanggal_bayar' => 'required|date',
            'metode_pembayaran' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        $pinjam = Pinjam::findOrFail($request->pinjam_id);

        // Pastikan buku sudah dikembalikan
        if ($pinjam->status != 'dikembalikan') {
            return back()->with('error', 'Buku belum dikembalikan.');
        }

        // Pastikan memang ada denda
        if ($pinjam->denda <= 0) {
            return back()->with('error', 'Peminjaman ini tidak memiliki denda.');
        }

        // Cek apakah sudah pernah dibayar
        if ($pinjam->pembayaranDenda) {
            return back()->with('error', 'Denda sudah dibayar.');
        }

        // Nominal harus sama dengan jumlah denda
        if ($request->nominal != $pinjam->denda) {
            return back()->with('error', 'Nominal pembayaran harus sama dengan jumlah denda.');
        }

        PembayaranDenda::create([
            'pinjam_id' => $pinjam->id,
            'user_id' => auth()->id(),
            'nominal' => $request->nominal,
            'tanggal_bayar' => Carbon::parse($request->tanggal_bayar),
            'metode_pembayaran' => $request->metode_pembayaran,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pembayaran-denda.index')
            ->with('success', 'Pembayaran denda berhasil disimpan.');
    }

    public function show($id)
    {
        $pembayaran = PembayaranDenda::with([
            'pinjam.user.kelas',
            'pinjam.buku',
            'petugas'
        ])->findOrFail($id);

        return view('pembayaran-denda.show', compact('pembayaran'));
    }

    public function destroy($id)
    {
        $pembayaran = PembayaranDenda::findOrFail($id);

        $pembayaran->delete();

        return redirect()->route('pembayaran-denda.index')
            ->with('success', 'Data pembayaran denda berhasil dihapus.');
    }

    public function trashed()
    {
        $pembayaran = PembayaranDenda::onlyTrashed()
            ->with([
                'pinjam.user.kelas',
                'pinjam.buku',
                'petugas'
            ])
            ->latest()
            ->get();

        return view('pembayaran-denda.trashed', compact('pembayaran'));
    }

    public function restore($id)
    {
        $pembayaran = PembayaranDenda::onlyTrashed()
            ->findOrFail($id);

        $pembayaran->restore();

        return redirect()->route('pembayaran-denda.trashed')
            ->with('success', 'Data pembayaran denda berhasil direstore.');
    }

    public function forceDelete($id)
    {
        $pembayaran = PembayaranDenda::onlyTrashed()
            ->findOrFail($id);

        $pembayaran->forceDelete();

        return redirect()->route('pembayaran-denda.trashed')
            ->with('success', 'Data pembayaran denda berhasil dihapus permanen.');
    }

    public function cetak(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = PembayaranDenda::with([
            'pinjam.user.kelas',
            'pinjam.buku',
            'petugas'
        ]);

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('tanggal_bayar', [
                $tanggalAwal,
                $tanggalAkhir
            ]);
        }

        $pembayaran = $query->orderBy('tanggal_bayar','asc')->get();

        $totalNominal = $pembayaran->sum('nominal');

        $pdf = Pdf::loadView('pembayaran-denda.cetak', compact(
            'pembayaran',
            'tanggalAwal',
            'tanggalAkhir',
            'totalNominal'
        ));

        $pdf->setPaper('A4','landscape');

        return $pdf->stream('laporan-pembayaran-denda.pdf');
    }

    public function excel(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        return Excel::download(
            new PembayaranDendaExport(
                $tanggalAwal,
                $tanggalAkhir
            ),
            'Laporan_Pembayaran_Denda_'.now()->format('Ymd_His').'.xlsx'
        );
    }
}
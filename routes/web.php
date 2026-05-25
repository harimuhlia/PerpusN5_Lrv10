<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Anggota\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\LaporanPeminjamanController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index']);
Route::get('/detail-buku/{id}',[FrontController::class, 'detailBuku'])
    ->name('front.detail-buku');

Route::get('/redirect', function () {
    if (auth()->user()->role == 'admin') {
        return redirect('/dashboard');
    }
    if (auth()->user()->role == 'anggota') {
        return redirect()->route('anggota.dashboard');
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:anggota'])->group(function () {

    Route::get('/anggota/dashboard', [DashboardController::class, 'index'])
        ->name('anggota.dashboard');
});

Route::put('/pinjam/{id}/batal', [PinjamController::class, 'batal'])
    ->name('pinjam.batal');

Route::middleware(['auth', 'role:admin'])->group(function () {   
    Route::resource('member', MemberController::class);
    Route::get('/member-trash', [MemberController::class, 'trash'])
        ->name('member.trash');
    Route::get('/member-restore/{id}', [MemberController::class, 'restore'])
        ->name('member.restore');
    Route::delete('/member-force-delete/{id}', [MemberController::class, 'forceDelete'])
        ->name('member.forceDelete');
    Route::get('/member/{id}/kartu', [MemberController::class, 'kartu'])
        ->name('member.kartu');
    Route::post('/member/cetak-masal', [MemberController::class, 'cetakMasal'])
        ->name('member.cetakMasal');

    Route::resource('jurusan', JurusanController::class);
    Route::get('/jurusan-trash', [JurusanController::class, 'trash'])
        ->name('jurusan.trash');
    Route::get('/jurusan/restore/{id}', [JurusanController::class, 'restore'])
        ->name('jurusan.restore');
    Route::delete('/jurusan/force-delete/{id}', [JurusanController::class, 'forceDelete'])
        ->name('jurusan.forceDelete');

    Route::resource('kelas', KelasController::class);
    Route::get('/kelas-trash', [KelasController::class, 'trash'])
        ->name('kelas.trash');
    Route::get('/kelas/restore/{id}', [KelasController::class, 'restore'])
        ->name('kelas.restore');
    Route::delete('/kelas/force-delete/{id}', [KelasController::class, 'forceDelete'])
        ->name('kelas.forceDelete');

    Route::resource('kategori', KategoriController::class);
    Route::get('/kategori-trash', [KategoriController::class, 'trash'])
        ->name('kategori.trash');
    Route::get('/kategori/restore/{id}', [KategoriController::class, 'restore'])
        ->name('kategori.restore');
    Route::delete('/kategori/force-delete/{id}', [KategoriController::class, 'forceDelete'])
        ->name('kategori.forceDelete');

    Route::resource('rak', RakController::class);
    Route::get('/rak-trash', [RakController::class, 'trash'])
        ->name('rak.trash');
    Route::get('/rak/restore/{id}', [RakController::class, 'restore'])
        ->name('rak.restore');
    Route::delete('/rak/force-delete/{id}', [RakController::class, 'forceDelete'])
        ->name('rak.forceDelete');
    
    Route::resource('buku', BukuController::class);
    Route::get('/buku-trash', [BukuController::class, 'trash'])
    ->name('buku.trash');
    Route::get('/buku-restore/{id}', [BukuController::class, 'restore'])
        ->name('buku.restore');
    Route::delete('/buku-force-delete/{id}', [BukuController::class, 'forceDelete'])
        ->name('buku.forceDelete');
    Route::get('/buku-export', [BukuController::class, 'exportExcel'])
    ->name('buku.export');
    Route::post('/buku-import', [BukuController::class, 'importExcel'])
    ->name('buku.import');

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/pengembalian', [PengembalianController::class, 'index'])
        ->name('pengembalian.index');
    Route::post('/pengembalian/cari', [PengembalianController::class, 'cari'])
        ->name('pengembalian.cari');
    Route::put('/pengembalian/{id}/proses', [PengembalianController::class, 'proses'])
        ->name('pengembalian.proses');

    Route::get('/laporan/peminjaman',
        [LaporanPeminjamanController::class, 'index'])
        ->name('laporan.peminjaman');

    Route::get('/laporan/peminjaman/pdf',
        [LaporanPeminjamanController::class, 'pdf'])
        ->name('laporan.peminjaman.pdf');

    Route::get('/laporan/peminjaman/excel',
        [LaporanPeminjamanController::class, 'excel'])
        ->name('laporan.peminjaman.excel');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/katalog', [KatalogController::class, 'index'])
        ->name('katalog.index');
    Route::get('/katalog/{id}', [KatalogController::class, 'show'])
        ->name('katalog.show');

    Route::get('/pinjam', [PinjamController::class, 'index'])
        ->name('pinjam.index');
    Route::get('/pinjam/trashed', [PinjamController::class, 'trashed'])
        ->name('pinjam.trashed');
    Route::get('/pinjam/create/{id}', [PinjamController::class, 'create'])
        ->name('pinjam.create');
    Route::post('/pinjam/store', [PinjamController::class, 'store'])
        ->name('pinjam.store');
    Route::get('/pinjam/{id}', [PinjamController::class, 'show'])
        ->name('pinjam.show');
    Route::put('/pinjam/{id}/setujui', [PinjamController::class, 'setujui'])
        ->name('pinjam.setujui');
    Route::put('/pinjam/{id}/kembalikan', [PinjamController::class, 'kembalikan'])
        ->name('pinjam.kembalikan');
    Route::delete('/pinjam/{id}', [PinjamController::class, 'destroy'])
        ->name('pinjam.destroy');
    Route::post('/pinjam/{id}/restore', [PinjamController::class, 'restore'])
    ->name('pinjam.restore');
    Route::delete('/pinjam/{id}/force-delete', [PinjamController::class, 'forceDelete'])
    ->name('pinjam.forceDelete');
});

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {return "Halaman Admin";});
});
// ANGGOTA
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/anggota', function () {return "Halaman Anggota";});
});

require __DIR__.'/auth.php';

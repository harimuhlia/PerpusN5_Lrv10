<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pinjams';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'durasi_pinjam',
        'tanggal_kembali',
        'status', 'jumlah', 'kelas_id', 'denda',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // public function getDendaOtomatisAttribute()
    // {
    //     if ($this->status == 'dikembalikan') {
    //         return $this->denda; // dari database
    //     }

    //     $telat = Carbon::now()->diffInDays($this->tanggal_kembali, false);

    //     return $telat < 0 ? abs($telat) * 1000 : 0;
    // }

    public function getDendaOtomatisAttribute()
    {
        // jika status dipinjam → hitung realtime
        if ($this->status == 'dipinjam') {

            $today = Carbon::now();

            $tanggalKembali = Carbon::parse($this->tanggal_kembali);

            if ($today->gt($tanggalKembali)) {

                $hariTelat = $tanggalKembali->diffInDays($today);

                $dendaPerHari = 1000;

                return $hariTelat * $dendaPerHari;
            }
        }

        // jika sudah dikembalikan
        if ($this->status == 'dikembalikan') {

            return $this->denda;
        }

        // pending / dibatalkan
        return 0;
    }
}

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
        'jumlah',
        'tanggal_pinjam',
        'durasi_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status',
        'denda',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_dikembalikan' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function pembayaranDenda()
    {
        return $this->hasOne(PembayaranDenda::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getDendaOtomatisAttribute()
    {
        // Denda dihitung realtime jika buku masih dipinjam
        if ($this->status == 'dipinjam') {

            $today = Carbon::now();
            if ($today->gt($this->tanggal_kembali)) {
                $hariTelat = $this->tanggal_kembali->diffInDays($today);
                return $hariTelat * 1000;

            }

        }

        // Jika sudah dikembalikan gunakan denda yang tersimpan
        if ($this->status == 'dikembalikan') {
            return $this->denda;
        }
        return 0;
    }
}
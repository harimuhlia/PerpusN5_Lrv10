<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranDenda extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pembayaran_dendas';

    protected $fillable = [
        'pinjam_id',
        'user_id',
        'nominal',
        'tanggal_bayar',
        'metode_pembayaran',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
        'nominal' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function pinjam()
    {
        return $this->belongsTo(Pinjam::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
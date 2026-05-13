<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jurusans';

    protected $fillable = [
        'nama_jurusan',
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}

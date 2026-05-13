<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kelas';

    protected $fillable = [
        'jurusan_id',
        'nama_kelas',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'kelas_id');
    }
}

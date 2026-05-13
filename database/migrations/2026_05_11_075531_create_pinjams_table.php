<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('buku_id');

            $table->date('tanggal_pinjam');

            $table->integer('durasi_pinjam');

            $table->date('tanggal_kembali');

            $table->enum('status', [
                'pending',
                'dipinjam',
                'dikembalikan', 'dibatalkan'
            ])->default('pending');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjams');
    }
};

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
        $table->unsignedInteger('jumlah')->default(1);
        $table->date('tanggal_pinjam');
        $table->unsignedInteger('durasi_pinjam')->default(7);
        $table->date('tanggal_kembali');
        $table->date('tanggal_dikembalikan')->nullable();
        $table->decimal('denda', 12, 2)->default(0);
        $table->enum('status', [
            'pending',
            'dipinjam',
            'dikembalikan',
            'dibatalkan'
        ])->default('pending');

        $table->timestamps();
        $table->softDeletes();
        $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

        $table->foreign('buku_id')
            ->references('id')
            ->on('buku')
            ->onDelete('cascade');

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

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
        Schema::create('pembayaran_dendas', function (Blueprint $table) {

        $table->engine = 'InnoDB';
        $table->id();
        $table->unsignedBigInteger('pinjam_id');
        $table->unsignedBigInteger('user_id');
        $table->decimal('nominal', 12, 2);
        $table->date('tanggal_bayar');
        $table->string('metode_pembayaran')->default('Tunai');
        $table->text('keterangan')->nullable();
        $table->timestamps();
        $table->softDeletes();
        $table->foreign('pinjam_id')
            ->references('id')
            ->on('pinjams')
            ->onDelete('cascade');
        $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_dendas');
    }
};

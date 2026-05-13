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
        Schema::create('buku', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('rak_id');
            $table->string('kode_buku')->unique();
            $table->string('judul');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->year('tahun_terbit');
            $table->text('deskripsi')->nullable();
            $table->string('cover')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategoris')
                  ->onDelete('cascade');

            $table->foreign('rak_id')
                  ->references('id')
                  ->on('raks')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};

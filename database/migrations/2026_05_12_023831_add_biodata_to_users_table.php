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
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_register')->unique()->nullable()->after('id');

            $table->unsignedInteger('kelas_id')
                  ->nullable()
                  ->after('role');

            $table->string('no_wa')->nullable()->after('kelas_id');

            $table->text('alamat')->nullable()->after('no_wa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
                $table->dropColumn([
                'id_register',
                'kelas_id',
                'no_wa',
                'alamat'
            ]);
        });
    }
};

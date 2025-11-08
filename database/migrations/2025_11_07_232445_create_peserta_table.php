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
        Schema::create('peserta', function (Blueprint $table) {
            $table->string('id_peserta', 50)->primary();
            $table->string('nama_lengkap', 255);
            $table->string('email', 255)->unique();
            $table->string('no_hp', 20);
            $table->string('asal_instansi', 255);
            $table->dateTime('tgl_registrasi');
            $table->string('qr_code_token', 100)->unique()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
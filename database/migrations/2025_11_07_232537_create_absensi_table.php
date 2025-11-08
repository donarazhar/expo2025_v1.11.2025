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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->string('qr_code_token', 100);
            $table->dateTime('waktu_scan');
            $table->string('petugas_scanner', 100);
            $table->boolean('status_kehadiran')->default(true);
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('qr_code_token')
                  ->references('qr_code_token')
                  ->on('peserta')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // Index untuk performa query
            $table->index('qr_code_token');
            $table->index('waktu_scan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
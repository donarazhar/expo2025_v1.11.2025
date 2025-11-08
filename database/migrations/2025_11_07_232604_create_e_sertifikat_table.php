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
        Schema::create('e_sertifikat', function (Blueprint $table) {
            $table->id('id_sertifikat');
            $table->string('qr_code_token', 100)->unique();
            $table->string('nomor_sertifikat', 100)->unique();
            $table->dateTime('tgl_penerbitan');
            $table->boolean('status_kirim')->default(false);
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('qr_code_token')
                  ->references('qr_code_token')
                  ->on('peserta')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // Index untuk performa query
            $table->index('qr_code_token');
            $table->index('nomor_sertifikat');
            $table->index('status_kirim');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_sertifikat');
    }
};
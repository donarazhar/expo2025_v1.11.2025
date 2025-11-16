<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('nama_hadiah');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->integer('jumlah'); // Total hadiah tersedia
            $table->integer('sisa'); // Sisa hadiah yang belum diundi
            $table->integer('urutan')->default(0); // Urutan pengundian
            $table->enum('kategori', ['utama', 'doorprize', 'hiburan'])->default('doorprize');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prizes');
    }
};

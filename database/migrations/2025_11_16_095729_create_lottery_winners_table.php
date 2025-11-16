<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lottery_winners', function (Blueprint $table) {
            $table->id();

            // Event bisa NULL untuk undian umum
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('prize_id');

            // QR Code & Peserta Info
            $table->string('qr_code_token', 100);
            $table->string('id_peserta', 20);
            $table->unsignedBigInteger('registration_id')->nullable(); // Bisa null untuk peserta umum

            // Winner Info (denormalized untuk performa)
            $table->string('nama_pemenang');
            $table->string('email_pemenang')->nullable();
            $table->string('no_hp_pemenang', 20)->nullable();
            $table->string('nama_hadiah');

            // Lottery Info
            $table->timestamp('waktu_undi');
            $table->enum('participant_type', ['registered', 'general'])->default('registered');

            // Claim Info
            $table->boolean('sudah_diambil')->default(false);
            $table->timestamp('waktu_ambil')->nullable();
            $table->string('diambil_oleh')->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();

            // Foreign Keys
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');

            $table->foreign('prize_id')
                ->references('id')
                ->on('prizes')
                ->onDelete('restrict'); // Jangan hapus prize jika ada winner

            $table->foreign('registration_id')
                ->references('id')
                ->on('event_registrations')
                ->onDelete('set null');

            // Indexes
            $table->index('event_id');
            $table->index('prize_id');
            $table->index('qr_code_token');
            $table->index('id_peserta');
            $table->index('waktu_undi');
            $table->index('sudah_diambil');
            $table->index('participant_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lottery_winners');
    }
};

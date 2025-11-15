<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('pembicara')->nullable();
            $table->datetime('waktu_mulai');
            $table->datetime('waktu_selesai')->nullable();
            $table->string('lokasi_detail')->nullable();
            $table->timestamps();
        });
        
        // Add foreign key after table creation
        Schema::table('event_schedules', function (Blueprint $table) {
            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_schedules');
    }
};
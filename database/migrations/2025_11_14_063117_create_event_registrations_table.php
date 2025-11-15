<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('id_peserta', 50);  // Changed to string to match peserta PK
            $table->unsignedBigInteger('event_id');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->unique(['id_peserta', 'event_id']);
        });
        
        // Add foreign keys after table creation
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->foreign('id_peserta')
                  ->references('id_peserta')  // References string PK
                  ->on('peserta')              // Singular table name
                  ->onDelete('cascade');
                  
            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
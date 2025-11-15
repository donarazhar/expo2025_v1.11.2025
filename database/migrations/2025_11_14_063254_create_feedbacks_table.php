<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('id_peserta', 50);  // Changed to string
            $table->unsignedBigInteger('event_id')->nullable();
            $table->integer('rating')->unsigned()->default(5);
            $table->text('komentar')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
        
        // Add foreign keys after table creation
        Schema::table('feedbacks', function (Blueprint $table) {
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
        Schema::dropIfExists('feedbacks');
    }
};
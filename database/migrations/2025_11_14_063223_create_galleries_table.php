<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('image_path');
            $table->string('kategori')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
        
        // Add foreign key after table creation
        Schema::table('galleries', function (Blueprint $table) {
            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
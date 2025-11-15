<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('live_streams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('judul');
            $table->string('platform',50);
            $table->text('stream_url');
            $table->text('embed_code')->nullable();
            $table->datetime('jadwal_tayang')->nullable();
            $table->enum('status', ['scheduled', 'live', 'ended'])->default('scheduled');
            $table->integer('viewer_count')->default(0);
            $table->timestamps();
        });
        
        // Add foreign key after table creation
        Schema::table('live_streams', function (Blueprint $table) {
            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('live_streams');
    }
};
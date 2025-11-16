<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // Jika belum ada kolom ini
            $table->boolean('hadir')->default(false)->after('status');
            $table->timestamp('waktu_hadir')->nullable()->after('hadir');
            $table->string('metode_checkin')->nullable()->after('waktu_hadir'); // manual, qr, barcode
        });
    }

    public function down(): void
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumn(['hadir', 'waktu_hadir', 'metode_checkin']);
        });
    }
};

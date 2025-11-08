<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peserta;
use App\Models\Absensi;
use App\Models\ESertifikat;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Admin Users
        $this->call(AdminUserSeeder::class);
        
        // Seed Peserta
        $peserta1 = Peserta::create([
            'nama_lengkap' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@example.com',
            'no_hp' => '081234567890',
            'asal_instansi' => 'Universitas Al Azhar Indonesia',
        ]);

        $peserta2 = Peserta::create([
            'nama_lengkap' => 'Siti Nurhaliza',
            'email' => 'siti.nur@example.com',
            'no_hp' => '081234567891',
            'asal_instansi' => 'SMA Al Azhar Jakarta',
        ]);

        $peserta3 = Peserta::create([
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'no_hp' => '081234567892',
            'asal_instansi' => 'PT Teknologi Indonesia',
        ]);

        $peserta4 = Peserta::create([
            'nama_lengkap' => 'Dewi Lestari',
            'email' => 'dewi.lestari@example.com',
            'no_hp' => '081234567893',
            'asal_instansi' => 'Universitas Indonesia',
        ]);

        $peserta5 = Peserta::create([
            'nama_lengkap' => 'Rizky Pratama',
            'email' => 'rizky.pratama@example.com',
            'no_hp' => '081234567894',
            'asal_instansi' => 'SMK Al Azhar Surabaya',
        ]);

        // Seed Absensi untuk peserta yang hadir
        Absensi::create([
            'qr_code_token' => $peserta1->qr_code_token,
            'waktu_scan' => now()->subDays(2)->setTime(8, 30, 0),
            'petugas_scanner' => 'Petugas A',
            'status_kehadiran' => true,
        ]);

        Absensi::create([
            'qr_code_token' => $peserta2->qr_code_token,
            'waktu_scan' => now()->subDays(2)->setTime(8, 45, 0),
            'petugas_scanner' => 'Petugas A',
            'status_kehadiran' => true,
        ]);

        Absensi::create([
            'qr_code_token' => $peserta1->qr_code_token,
            'waktu_scan' => now()->subDays(1)->setTime(9, 0, 0),
            'petugas_scanner' => 'Petugas B',
            'status_kehadiran' => true,
        ]);

        Absensi::create([
            'qr_code_token' => $peserta3->qr_code_token,
            'waktu_scan' => now()->subDays(1)->setTime(9, 15, 0),
            'petugas_scanner' => 'Petugas B',
            'status_kehadiran' => true,
        ]);

        // Seed E-Sertifikat untuk peserta yang sudah hadir
        ESertifikat::create([
            'qr_code_token' => $peserta1->qr_code_token,
            'tgl_penerbitan' => now()->subDays(1),
            'status_kirim' => true,
        ]);

        ESertifikat::create([
            'qr_code_token' => $peserta2->qr_code_token,
            'tgl_penerbitan' => now()->subDays(1),
            'status_kirim' => false,
        ]);

        ESertifikat::create([
            'qr_code_token' => $peserta3->qr_code_token,
            'tgl_penerbitan' => now(),
            'status_kirim' => false,
        ]);

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📊 Created:');
        $this->command->info('   - 5 Peserta');
        $this->command->info('   - 4 Absensi records');
        $this->command->info('   - 3 E-Sertifikat');
    }
}
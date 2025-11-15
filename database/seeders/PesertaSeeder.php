<?php

namespace Database\Seeders;

use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PesertaSeeder extends Seeder
{
    public function run()
    {
        $pesertas = [
            [
                'id_peserta' => 'A7K2',
                'nama_lengkap' => 'Ahmad Fadli Rahman',
                'email' => 'ahmad.fadli@gmail.com',
                'no_hp' => '081234567890',
                'asal_instansi' => 'Universitas Indonesia',
                'tgl_registrasi' => Carbon::now()->subDays(10),
                'qr_code_token' => Str::random(32), // Add this
            ],
            [
                'id_peserta' => 'B3M9',
                'nama_lengkap' => 'Siti Nurhaliza',
                'email' => 'siti.nur@gmail.com',
                'no_hp' => '082345678901',
                'asal_instansi' => 'SMA Al Azhar 1 Jakarta',
                'tgl_registrasi' => Carbon::now()->subDays(9),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'C5L7',
                'nama_lengkap' => 'Muhammad Rizki Pratama',
                'email' => 'rizki.pratama@gmail.com',
                'no_hp' => '083456789012',
                'asal_instansi' => 'Institut Teknologi Bandung',
                'tgl_registrasi' => Carbon::now()->subDays(8),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'D8N4',
                'nama_lengkap' => 'Fatimah Az-Zahra',
                'email' => 'fatimah.zahra@gmail.com',
                'no_hp' => '084567890123',
                'asal_instansi' => 'Universitas Gadjah Mada',
                'tgl_registrasi' => Carbon::now()->subDays(7),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'E2P6',
                'nama_lengkap' => 'Abdullah Aziz',
                'email' => 'abdullah.aziz@gmail.com',
                'no_hp' => '085678901234',
                'asal_instansi' => 'SMP Al Azhar Kelapa Gading',
                'tgl_registrasi' => Carbon::now()->subDays(6),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'F9Q1',
                'nama_lengkap' => 'Dewi Kartika Sari',
                'email' => 'dewi.kartika@gmail.com',
                'no_hp' => '086789012345',
                'asal_instansi' => 'Universitas Brawijaya',
                'tgl_registrasi' => Carbon::now()->subDays(5),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'G4R8',
                'nama_lengkap' => 'Hasan Basri',
                'email' => 'hasan.basri@gmail.com',
                'no_hp' => '087890123456',
                'asal_instansi' => 'Universitas Airlangga',
                'tgl_registrasi' => Carbon::now()->subDays(4),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'H7S3',
                'nama_lengkap' => 'Aisyah Putri',
                'email' => 'aisyah.putri@gmail.com',
                'no_hp' => '088901234567',
                'asal_instansi' => 'SMA Negeri 8 Jakarta',
                'tgl_registrasi' => Carbon::now()->subDays(3),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'I1T5',
                'nama_lengkap' => 'Umar Faruq',
                'email' => 'umar.faruq@gmail.com',
                'no_hp' => '089012345678',
                'asal_instansi' => 'Universitas Diponegoro',
                'tgl_registrasi' => Carbon::now()->subDays(2),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'J6U2',
                'nama_lengkap' => 'Khadijah Nuraini',
                'email' => 'khadijah.nuraini@gmail.com',
                'no_hp' => '081123456789',
                'asal_instansi' => 'Universitas Padjadjaran',
                'tgl_registrasi' => Carbon::now()->subDays(1),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'K3V9',
                'nama_lengkap' => 'Yusuf Ibrahim',
                'email' => 'yusuf.ibrahim@gmail.com',
                'no_hp' => '082234567890',
                'asal_instansi' => 'SMA Al Azhar Pondok Labu',
                'tgl_registrasi' => Carbon::now(),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'L8W4',
                'nama_lengkap' => 'Maryam Salsabila',
                'email' => 'maryam.salsabila@gmail.com',
                'no_hp' => '083345678901',
                'asal_instansi' => 'Universitas Islam Negeri Jakarta',
                'tgl_registrasi' => Carbon::now()->subHours(12),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'M5X7',
                'nama_lengkap' => 'Ali Imran',
                'email' => 'ali.imran@gmail.com',
                'no_hp' => '084456789012',
                'asal_instansi' => 'Institut Pertanian Bogor',
                'tgl_registrasi' => Carbon::now()->subHours(10),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'N2Y1',
                'nama_lengkap' => 'Zainab Husna',
                'email' => 'zainab.husna@gmail.com',
                'no_hp' => '085567890123',
                'asal_instansi' => 'Universitas Andalas',
                'tgl_registrasi' => Carbon::now()->subHours(8),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'O9Z6',
                'nama_lengkap' => 'Hamzah Malik',
                'email' => 'hamzah.malik@gmail.com',
                'no_hp' => '086678901234',
                'asal_instansi' => 'SMP Negeri 5 Jakarta',
                'tgl_registrasi' => Carbon::now()->subHours(6),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'P4A8',
                'nama_lengkap' => 'Raihan Maulana',
                'email' => 'raihan.maulana@gmail.com',
                'no_hp' => '087789012345',
                'asal_instansi' => 'Universitas Hasanuddin',
                'tgl_registrasi' => Carbon::now()->subHours(4),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'Q7B3',
                'nama_lengkap' => 'Hafizah Zahra',
                'email' => 'hafizah.zahra@gmail.com',
                'no_hp' => '088890123456',
                'asal_instansi' => 'SMA Al Azhar Kemang',
                'tgl_registrasi' => Carbon::now()->subHours(2),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'R1C5',
                'nama_lengkap' => 'Ibrahim Khalil',
                'email' => 'ibrahim.khalil@gmail.com',
                'no_hp' => '089901234567',
                'asal_instansi' => 'Universitas Negeri Semarang',
                'tgl_registrasi' => Carbon::now()->subHour(),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'S6D2',
                'nama_lengkap' => 'Safiyyah Amira',
                'email' => 'safiyyah.amira@gmail.com',
                'no_hp' => '081012345678',
                'asal_instansi' => 'Universitas Syiah Kuala',
                'tgl_registrasi' => Carbon::now()->subMinutes(30),
                'qr_code_token' => Str::random(32),
            ],
            [
                'id_peserta' => 'T3E9',
                'nama_lengkap' => 'Bilal Naufal',
                'email' => 'bilal.naufal@gmail.com',
                'no_hp' => '082123456789',
                'asal_instansi' => 'SD Al Azhar BSD',
                'tgl_registrasi' => Carbon::now(),
                'qr_code_token' => Str::random(32),
            ],
        ];

        foreach ($pesertas as $pesertaData) {
            $peserta = Peserta::create($pesertaData);
            $this->command->info("✅ Created: {$peserta->nama_lengkap} ({$peserta->id_peserta})");
        }

        $this->command->info('🎉 PesertaSeeder completed! Created '.count($pesertas).' participants.');
    }
}

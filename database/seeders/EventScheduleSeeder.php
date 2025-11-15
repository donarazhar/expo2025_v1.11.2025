<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventSchedule;
use App\Models\Event;

class EventScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $seminar = Event::where('slug', 'seminar-nasional-pendidikan-islam')->first();
        
        if ($seminar) {
            $schedules = [
                [
                    'event_id' => $seminar->id,
                    'judul' => 'Registrasi & Pembukaan',
                    'deskripsi' => 'Registrasi ulang peserta dan sambutan pembukaan',
                    'pembicara' => 'Panitia',
                    'waktu_mulai' => '2025-12-04 08:00:00',
                    'waktu_selesai' => '2025-12-04 09:00:00',
                    'lokasi_detail' => 'Lobby Utama',
                ],
                [
                    'event_id' => $seminar->id,
                    'judul' => 'Keynote Speaker: Transformasi Pendidikan Islam',
                    'deskripsi' => 'Pemaparan visi transformasi pendidikan Islam modern',
                    'pembicara' => 'Prof. Dr. Ahmad Syafii Maarif',
                    'waktu_mulai' => '2025-12-04 09:00:00',
                    'waktu_selesai' => '2025-12-04 10:30:00',
                    'lokasi_detail' => 'Auditorium Utama',
                ],
                [
                    'event_id' => $seminar->id,
                    'judul' => 'Panel Diskusi: Inovasi Kurikulum',
                    'deskripsi' => 'Diskusi panel tentang inovasi kurikulum pendidikan Islam',
                    'pembicara' => 'Tim Ahli',
                    'waktu_mulai' => '2025-12-04 10:45:00',
                    'waktu_selesai' => '2025-12-04 12:00:00',
                    'lokasi_detail' => 'Auditorium Utama',
                ],
            ];

            foreach ($schedules as $schedule) {
                EventSchedule::create($schedule);
            }
        }

        $this->command->info('✅ Event schedules seeded successfully!');
    }
}
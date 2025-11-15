<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run()
    {
        $events = [
            [
                'judul' => 'Opening Ceremony Al Azhar Expo 2025',
                'deskripsi' => 'Pembukaan resmi Al Azhar Expo 2025 yang akan menghadirkan sambutan dari berbagai tokoh pendidikan dan keagamaan. Acara ini menandai dimulainya rangkaian kegiatan selama 3 hari penuh yang akan menginspirasi ribuan jamaah.',
                'tanggal_mulai' => '2025-12-04 08:00:00',
                'tanggal_selesai' => '2025-12-04 10:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 500,
                'status' => 'published',
                'kategori' => 'Opening',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Registrasi & Persiapan',
                        'waktu_mulai' => '2025-12-04 07:30:00',
                        'waktu_selesai' => '2025-12-04 08:00:00',
                    ],
                    [
                        'judul' => 'Sambutan Ketua Panitia',
                        'waktu_mulai' => '2025-12-04 08:00:00',
                        'waktu_selesai' => '2025-12-04 08:15:00',
                        'pembicara' => 'Dr. H. Ahmad Syafii, M.Pd',
                    ],
                    [
                        'judul' => 'Pembukaan Resmi',
                        'waktu_mulai' => '2025-12-04 08:15:00',
                        'waktu_selesai' => '2025-12-04 08:45:00',
                        'pembicara' => 'Prof. Dr. Ir. Asep Saefuddin, M.Sc',
                    ],
                ],
            ],
            [
                'judul' => 'Talkshow Nasional: Pendidikan & Adab',
                'deskripsi' => 'Diskusi mendalam tentang pentingnya pendidikan karakter dan adab dalam membentuk generasi muda yang berakhlak mulia. Menghadirkan pakar pendidikan dan tokoh agama ternama yang akan berbagi wawasan dan pengalaman.',
                'tanggal_mulai' => '2025-12-04 10:00:00',
                'tanggal_selesai' => '2025-12-04 12:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Auditorium',
                'kapasitas' => 300,
                'status' => 'published',
                'kategori' => 'Talkshow',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Sesi 1: Pendidikan Karakter di Era Digital',
                        'waktu_mulai' => '2025-12-04 10:00:00',
                        'waktu_selesai' => '2025-12-04 11:00:00',
                        'pembicara' => 'Prof. Dr. Arief Rachman, M.Pd',
                        'deskripsi' => 'Membahas tantangan dan strategi pendidikan karakter di era digital',
                    ],
                    [
                        'judul' => 'Sesi 2: Adab dalam Kehidupan Sehari-hari',
                        'waktu_mulai' => '2025-12-04 11:00:00',
                        'waktu_selesai' => '2025-12-04 12:00:00',
                        'pembicara' => 'Ustadz Abdul Somad, Lc., MA',
                        'deskripsi' => 'Pentingnya adab dan akhlak dalam kehidupan bermasyarakat',
                    ],
                ],
            ],
            [
                'judul' => 'Seminar Ekonomi Keumatan & Wakaf',
                'deskripsi' => 'Seminar nasional membahas potensi ekonomi keumatan dan peran wakaf produktif dalam pemberdayaan ekonomi masyarakat. Menghadirkan praktisi ekonomi syariah dan pakar wakaf.',
                'tanggal_mulai' => '2025-12-05 13:00:00',
                'tanggal_selesai' => '2025-12-05 15:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Auditorium',
                'kapasitas' => 250,
                'status' => 'published',
                'kategori' => 'Seminar',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Ekonomi Syariah untuk Kemakmuran Umat',
                        'waktu_mulai' => '2025-12-05 13:00:00',
                        'waktu_selesai' => '2025-12-05 14:00:00',
                        'pembicara' => 'Dr. Muhammad Syafi\'i Antonio, M.Ec',
                    ],
                    [
                        'judul' => 'Wakaf Produktif: Solusi Pemberdayaan Ekonomi',
                        'waktu_mulai' => '2025-12-05 14:00:00',
                        'waktu_selesai' => '2025-12-05 15:00:00',
                        'pembicara' => 'Prof. Dr. KH. Ma\'ruf Amin',
                    ],
                ],
            ],
            [
                'judul' => 'Talkshow Special: Anies Baswedan & Ustadz Adi Hidayat',
                'deskripsi' => 'Talkshow spesial menghadirkan dua tokoh nasional yang akan berbagi visi tentang Indonesia masa depan. Diskusi interaktif dengan tema kepemimpinan, pendidikan, dan pembangunan karakter bangsa.',
                'tanggal_mulai' => '2025-12-05 15:30:00',
                'tanggal_selesai' => '2025-12-05 17:30:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 1000,
                'status' => 'published',
                'kategori' => 'Talkshow',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Sesi Dialog & Diskusi',
                        'waktu_mulai' => '2025-12-05 15:30:00',
                        'waktu_selesai' => '2025-12-05 17:00:00',
                        'pembicara' => 'Anies Baswedan & Ustadz Adi Hidayat, Lc., MA',
                        'deskripsi' => 'Dialog interaktif tentang kepemimpinan dan pendidikan',
                    ],
                    [
                        'judul' => 'Sesi Tanya Jawab',
                        'waktu_mulai' => '2025-12-05 17:00:00',
                        'waktu_selesai' => '2025-12-05 17:30:00',
                    ],
                ],
            ],
            [
                'judul' => 'Islamic Fashion Show 2025',
                'deskripsi' => 'Peragaan busana muslim modern yang menampilkan karya desainer muda Indonesia. Menampilkan koleksi busana muslim yang stylish, syar\'i, dan mengikuti perkembangan fashion terkini.',
                'tanggal_mulai' => '2025-12-04 14:00:00',
                'tanggal_selesai' => '2025-12-04 16:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Stage',
                'kapasitas' => 400,
                'status' => 'published',
                'kategori' => 'Fashion Show',
                'is_featured' => false,
            ],
            [
                'judul' => 'Lomba Robotik & Coding',
                'deskripsi' => 'Kompetisi robotik dan coding untuk pelajar tingkat SD, SMP, dan SMA. Menguji kreativitas dan kemampuan programming dalam menyelesaikan tantangan yang diberikan.',
                'tanggal_mulai' => '2025-12-05 08:00:00',
                'tanggal_selesai' => '2025-12-05 12:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Tech Lab',
                'kapasitas' => 100,
                'status' => 'published',
                'kategori' => 'Lomba',
                'is_featured' => false,
            ],
            [
                'judul' => 'Fundraising Gelar Sorban untuk Palestina',
                'deskripsi' => 'Acara penggalangan dana untuk membantu saudara-saudara kita di Palestina. Sekaligus gelar sorban sebagai bentuk solidaritas dan dukungan moril.',
                'tanggal_mulai' => '2025-12-05 19:00:00',
                'tanggal_selesai' => '2025-12-05 21:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 500,
                'status' => 'published',
                'kategori' => 'Fundraising',
                'is_featured' => false,
            ],
            [
                'judul' => 'Digital Expo & Technology',
                'deskripsi' => 'Pameran teknologi pendidikan terkini. Menampilkan berbagai aplikasi, platform, dan tools digital yang dapat membantu proses pembelajaran di era modern.',
                'tanggal_mulai' => '2025-12-06 08:00:00',
                'tanggal_selesai' => '2025-12-06 12:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Exhibition Hall',
                'kapasitas' => 0, // Unlimited
                'status' => 'published',
                'kategori' => 'Pameran',
                'is_featured' => false,
            ],
            [
                'judul' => 'Pertemuan Jamaah Haji Al Azhar 2018-2025',
                'deskripsi' => 'Gathering untuk jamaah haji Al Azhar dari tahun 2018 hingga 2025. Berbagi pengalaman spiritual dan mempererat silaturahmi antar jamaah.',
                'tanggal_mulai' => '2025-12-06 14:00:00',
                'tanggal_selesai' => '2025-12-06 16:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 300,
                'status' => 'published',
                'kategori' => 'Gathering',
                'is_featured' => false,
            ],
            [
                'judul' => 'Al Azhar Award 2025',
                'deskripsi' => 'Penganugerahan penghargaan kepada tokoh-tokoh yang berjasa dalam dunia pendidikan dan dakwah. Apresiasi atas dedikasi dan kontribusi mereka untuk Al Azhar.',
                'tanggal_mulai' => '2025-12-06 16:00:00',
                'tanggal_selesai' => '2025-12-06 17:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 500,
                'status' => 'published',
                'kategori' => 'Penghargaan',
                'is_featured' => false,
            ],
            [
                'judul' => 'Closing Ceremony',
                'deskripsi' => 'Penutupan resmi Al Azhar Expo 2025. Penampilan seni, foto bersama, dan pesan penutup dari panitia. Sampai jumpa di Al Azhar Expo berikutnya!',
                'tanggal_mulai' => '2025-12-06 17:00:00',
                'tanggal_selesai' => '2025-12-06 18:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 1000,
                'status' => 'published',
                'kategori' => 'Closing',
                'is_featured' => false,
            ],
        ];

        foreach ($events as $eventData) {
            $schedules = $eventData['schedules'] ?? [];
            unset($eventData['schedules']);

            $eventData['slug'] = Str::slug($eventData['judul']);

            $event = Event::create($eventData);

            // Create schedules
            foreach ($schedules as $scheduleData) {
                $event->schedules()->create($scheduleData);
            }

            $this->command->info("✅ Created: {$event->judul}");
        }

        $this->command->info('🎉 EventSeeder completed! Created '.count($events).' events.');
    }
}

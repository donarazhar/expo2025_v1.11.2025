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
            // ==================== HARI 1: SELASA, 6 JANUARI 2025 ====================
            [
                'judul' => 'Pembukaan Al Azhar Expo 2025',
                'deskripsi' => 'Pembukaan resmi Al Azhar Expo 2025 dengan penampilan Kizuna Melodi UAI & Vocal Grup. Dihadiri oleh Pembina, Pengawas, dan Pengurus YPI Al Azhar, Kepala Dinas Pendidikan DKI Jakarta, Pengawas Pendidikan Wilayah II, MKKS, Pejabat Eselon YPI Al Azhar, Rektor UAI, dan Kepala Sekolah se-Jabodetabek.',
                'tanggal_mulai' => '2025-01-06 08:00:00',
                'tanggal_selesai' => '2025-01-06 08:30:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 300,
                'status' => 'published',
                'kategori' => 'Opening',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Registrasi Peserta',
                        'waktu_mulai' => '2025-01-06 07:30:00',
                        'waktu_selesai' => '2025-01-06 08:00:00',
                        'deskripsi' => 'Check-in peserta undangan',
                    ],
                    [
                        'judul' => 'Performance Kizuna Melodi UAI & Vocal Grup',
                        'waktu_mulai' => '2025-01-06 08:00:00',
                        'waktu_selesai' => '2025-01-06 08:15:00',
                        'deskripsi' => 'Performance pembuka dari Universitas Al Azhar Indonesia',
                    ],
                    [
                        'judul' => 'Sambutan & Pembukaan Resmi',
                        'waktu_mulai' => '2025-01-06 08:15:00',
                        'waktu_selesai' => '2025-01-06 08:30:00',
                        'pembicara' => 'Pengurus YPI Al Azhar',
                    ],
                ],
            ],
            [
                'judul' => 'Seminar Nasional: Mewujudkan Pendidikan Menuju Indonesia Emas 2045',
                'deskripsi' => 'Seminar Nasional dengan tema "Mewujudkan pendidikan yang merata, berkualitas, dan inklusif menuju Indonesia Emas 2045". Menghadirkan Kepala Dinas Pendidikan DKI Jakarta dan Menteri Pendidikan sebagai keynote speaker. Target peserta: 300 orang (Pembina YPI, Pengawas Pendidikan, MKKS TK-SMA, Pejabat Eselon I-III YPI, Kepala Sekolah se-Jabodetabek).',
                'tanggal_mulai' => '2025-01-06 08:45:00',
                'tanggal_selesai' => '2025-01-06 10:15:00',
                'lokasi' => 'Masjid Agung Al Azhar - Auditorium',
                'kapasitas' => 300,
                'status' => 'published',
                'kategori' => 'Seminar',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Opening Seminar',
                        'waktu_mulai' => '2025-01-06 08:45:00',
                        'waktu_selesai' => '2025-01-06 09:00:00',
                        'deskripsi' => 'Pembukaan seminar dan pengantar moderator',
                    ],
                    [
                        'judul' => 'Keynote Speech: Visi Pendidikan Jakarta',
                        'waktu_mulai' => '2025-01-06 09:00:00',
                        'waktu_selesai' => '2025-01-06 09:45:00',
                        'pembicara' => 'Kepala Dinas Pendidikan DKI Jakarta',
                        'deskripsi' => 'Visi pendidikan Jakarta menuju Indonesia Emas 2045',
                    ],
                    [
                        'judul' => 'Panel Discussion & Tanya Jawab',
                        'waktu_mulai' => '2025-01-06 09:45:00',
                        'waktu_selesai' => '2025-01-06 10:15:00',
                        'pembicara' => 'Menteri Pendidikan DKI Jakarta',
                    ],
                ],
            ],
            [
                'judul' => 'Instrumentalia Musik Tradisional',
                'deskripsi' => 'Pertunjukan musik tradisional Indonesia yang memukau. Menampilkan keindahan dan kekayaan budaya nusantara melalui alunan musik tradisional.',
                'tanggal_mulai' => '2025-01-06 10:15:00',
                'tanggal_selesai' => '2025-01-06 10:45:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Stage',
                'kapasitas' => 300,
                'status' => 'published',
                'kategori' => 'Performance',
                'is_featured' => false,
            ],
            [
                'judul' => 'Kunjungan Stand dan Bazar',
                'deskripsi' => 'Waktu bebas untuk mengunjungi berbagai stand pameran dan bazar. Tersedia produk UMKM, buku, teknologi pendidikan, dan berbagai produk islami. Pengunjung dapat berinteraksi dengan exhibitor dan melihat berbagai inovasi pendidikan.',
                'tanggal_mulai' => '2025-01-06 10:45:00',
                'tanggal_selesai' => '2025-01-06 11:45:00',
                'lokasi' => 'Masjid Agung Al Azhar - Exhibition Area',
                'kapasitas' => 0, // Unlimited
                'status' => 'published',
                'kategori' => 'Pameran',
                'is_featured' => false,
            ],
            [
                'judul' => 'Talkshow: Membangun Generasi yang Beradab dan Berkemajuan',
                'deskripsi' => 'Talkshow tentang pentingnya membangun generasi muda yang beradab dan berkemajuan. Menghadirkan Direktur DIKDASMEN dan tokoh pendidikan sebagai narasumber. Terbuka untuk Anggota OTM, Pengurus, dan Forkom Jamiyyah Kampus Al Azhar se-Jabodetabek.',
                'tanggal_mulai' => '2025-01-06 13:30:00',
                'tanggal_selesai' => '2025-01-06 14:15:00',
                'lokasi' => 'Masjid Agung Al Azhar - Auditorium',
                'kapasitas' => 200,
                'status' => 'published',
                'kategori' => 'Talkshow',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Sesi Diskusi Utama',
                        'waktu_mulai' => '2025-01-06 13:30:00',
                        'waktu_selesai' => '2025-01-06 14:00:00',
                        'pembicara' => 'Dir. DIKDASMEN YPI Al Azhar',
                    ],
                    [
                        'judul' => 'Sesi Tanya Jawab',
                        'waktu_mulai' => '2025-01-06 14:00:00',
                        'waktu_selesai' => '2025-01-06 14:15:00',
                    ],
                ],
            ],
            [
                'judul' => 'Talkshow: Tampil Percaya Diri dengan Busana Islami',
                'deskripsi' => 'Talkshow tentang fashion muslim modern yang syar\'i dan stylish. Menghadirkan desainer busana muslim/muslimah ternama yang akan berbagi tips dan trik tampil percaya diri dengan busana islami.',
                'tanggal_mulai' => '2025-01-06 15:00:00',
                'tanggal_selesai' => '2025-01-06 15:15:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Stage',
                'kapasitas' => 200,
                'status' => 'published',
                'kategori' => 'Talkshow',
                'is_featured' => false,
                'schedules' => [
                    [
                        'judul' => 'Tips Fashion Muslim Modern',
                        'waktu_mulai' => '2025-01-06 15:00:00',
                        'waktu_selesai' => '2025-01-06 15:15:00',
                        'pembicara' => 'Desainer Busana Muslim/Muslimah',
                    ],
                ],
            ],
            [
                'judul' => 'Lomba Islamic Fashion Show - Kategori SMP-SMA',
                'deskripsi' => 'Lomba peragaan busana muslim untuk siswa SMP dan SMA. Menampilkan kreativitas fashion muslim yang stylish dan syar\'i. Peserta: 15-20 siswa SMP-SMA. Total hadiah: Rp 2.200.000. Dinilai oleh juri profesional dari dunia fashion muslim.',
                'tanggal_mulai' => '2025-01-06 15:30:00',
                'tanggal_selesai' => '2025-01-06 16:30:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Stage',
                'kapasitas' => 50,
                'status' => 'published',
                'kategori' => 'Lomba',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Briefing & Persiapan Peserta',
                        'waktu_mulai' => '2025-01-06 15:15:00',
                        'waktu_selesai' => '2025-01-06 15:30:00',
                        'deskripsi' => 'Technical meeting dan persiapan terakhir',
                    ],
                    [
                        'judul' => 'Lomba Fashion Show',
                        'waktu_mulai' => '2025-01-06 15:30:00',
                        'waktu_selesai' => '2025-01-06 16:15:00',
                        'deskripsi' => 'Peragaan busana muslim oleh peserta SMP-SMA',
                    ],
                    [
                        'judul' => 'Penilaian Juri',
                        'waktu_mulai' => '2025-01-06 16:15:00',
                        'waktu_selesai' => '2025-01-06 16:30:00',
                        'deskripsi' => 'Deliberasi dan penilaian akhir',
                    ],
                ],
            ],
            [
                'judul' => 'Lomba Islamic Fashion Show - Kategori Umum',
                'deskripsi' => 'Lomba peragaan busana muslim untuk kategori umum. Menampilkan kreativitas fashion muslim yang stylish dan syar\'i. Peserta: 15-20 orang umum. Total hadiah: Rp 3.200.000. Kesempatan untuk desainer muda dan fashion enthusiast menunjukkan karya.',
                'tanggal_mulai' => '2025-01-06 16:45:00',
                'tanggal_selesai' => '2025-01-06 17:45:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Stage',
                'kapasitas' => 50,
                'status' => 'published',
                'kategori' => 'Lomba',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Briefing & Persiapan Peserta',
                        'waktu_mulai' => '2025-01-06 16:30:00',
                        'waktu_selesai' => '2025-01-06 16:45:00',
                        'deskripsi' => 'Technical meeting dan persiapan terakhir',
                    ],
                    [
                        'judul' => 'Lomba Fashion Show',
                        'waktu_mulai' => '2025-01-06 16:45:00',
                        'waktu_selesai' => '2025-01-06 17:30:00',
                        'deskripsi' => 'Peragaan busana muslim kategori umum',
                    ],
                    [
                        'judul' => 'Penilaian Juri',
                        'waktu_mulai' => '2025-01-06 17:30:00',
                        'waktu_selesai' => '2025-01-06 17:45:00',
                        'deskripsi' => 'Deliberasi dan penilaian akhir',
                    ],
                ],
            ],
            [
                'judul' => 'Pembagian Doorprize & Penutupan Hari Ke-1',
                'deskripsi' => 'Pengumuman pemenang lomba fashion show kategori SMP-SMA dan Umum, pembagian doorprize untuk pengunjung, dan penutupan acara hari pertama Al Azhar Expo 2025.',
                'tanggal_mulai' => '2025-01-06 18:00:00',
                'tanggal_selesai' => '2025-01-06 18:30:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 300,
                'status' => 'published',
                'kategori' => 'Closing',
                'is_featured' => false,
            ],

            // ==================== HARI 2: RABU, 7 JANUARI 2025 ====================
            [
                'judul' => 'Talkshow: Membangun Generasi Emas untuk Ekonomi Berkelanjutan',
                'deskripsi' => 'Talkshow nasional dengan tema "Membangun Generasi Emas yang Kreatif, Inovatif, dan Produktif untuk Ekonomi Masa Depan yang Berkelanjutan". Menghadirkan Rektor UAI, Kabid Pemberdayaan Umat, dan tokoh ekonomi. Target peserta: Mahasiswa UAI (100), Siswa SMA Al Azhar (100), Siswa SMA Non Al Azhar (100), dan Pejabat Eselon 1.',
                'tanggal_mulai' => '2025-01-07 08:00:00',
                'tanggal_selesai' => '2025-01-07 09:30:00',
                'lokasi' => 'Masjid Agung Al Azhar - Auditorium',
                'kapasitas' => 300,
                'status' => 'published',
                'kategori' => 'Talkshow',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Keynote Speech: Generasi Emas Indonesia',
                        'waktu_mulai' => '2025-01-07 08:00:00',
                        'waktu_selesai' => '2025-01-07 08:45:00',
                        'pembicara' => 'Rektor Universitas Al Azhar Indonesia',
                    ],
                    [
                        'judul' => 'Panel Discussion: Ekonomi Berkelanjutan',
                        'waktu_mulai' => '2025-01-07 08:45:00',
                        'waktu_selesai' => '2025-01-07 09:15:00',
                        'pembicara' => 'Kabid Pemberdayaan Umat',
                    ],
                    [
                        'judul' => 'Sesi Tanya Jawab Interaktif',
                        'waktu_mulai' => '2025-01-07 09:15:00',
                        'waktu_selesai' => '2025-01-07 09:30:00',
                    ],
                ],
            ],
            [
                'judul' => 'Performance Hadrah MRA Bintaro',
                'deskripsi' => 'Penampilan seni Hadrah dari MRA (Madrasah Raudhatul Athfal) Bintaro. Menampilkan keindahan seni Islami melalui alunan Hadrah yang memukau dari para santri cilik.',
                'tanggal_mulai' => '2025-01-07 09:30:00',
                'tanggal_selesai' => '2025-01-07 09:45:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Stage',
                'kapasitas' => 300,
                'status' => 'published',
                'kategori' => 'Performance',
                'is_featured' => false,
            ],
            [
                'judul' => 'Talkshow: Membina Anak Pintar Robotik Sedari Dini',
                'deskripsi' => 'Talkshow tentang pentingnya pendidikan robotik untuk anak sejak dini. Program kerja sama dengan Robothink. Menghadirkan narasumber dari Robothink dan praktisi pendidikan. Target peserta: Pembina/Pelatih Ekstrakurikuler TK/SD/SMP/SMA Negeri dan Swasta se-Jakarta (100 orang).',
                'tanggal_mulai' => '2025-01-07 09:45:00',
                'tanggal_selesai' => '2025-01-07 10:30:00',
                'lokasi' => 'Masjid Agung Al Azhar - Auditorium',
                'kapasitas' => 200,
                'status' => 'published',
                'kategori' => 'Talkshow',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Sesi Presentasi: Pendidikan Robotik untuk Anak',
                        'waktu_mulai' => '2025-01-07 09:45:00',
                        'waktu_selesai' => '2025-01-07 10:15:00',
                        'pembicara' => 'Narasumber dari Robothink',
                        'deskripsi' => 'Pengenalan program robotik dan manfaatnya untuk anak',
                    ],
                    [
                        'judul' => 'Sesi Tanya Jawab & Diskusi',
                        'waktu_mulai' => '2025-01-07 10:15:00',
                        'waktu_selesai' => '2025-01-07 10:30:00',
                    ],
                ],
            ],
            [
                'judul' => 'Kontes Robot Anak Indonesia (KRAI)',
                'deskripsi' => 'Kompetisi robotik untuk anak-anak tingkat TK, SD, SMP, dan SMA. Menguji kreativitas, programming, dan problem solving. Lokasi: Robothink Epicentrum Walk Kuningan (Jl. HR. Rasuna Said, Epiwalk Lt.1 Unit W235). Peserta: Lomba Robotik dan Pembina Ekstrakurikuler TK/SD/SMP/SMA Islam Al Azhar se-Jabodetabek (75 orang).',
                'tanggal_mulai' => '2025-01-07 10:30:00',
                'tanggal_selesai' => '2025-01-07 12:00:00',
                'lokasi' => 'Robothink - Epicentrum Walk Lt.1 Unit W235, Kuningan',
                'kapasitas' => 100,
                'status' => 'published',
                'kategori' => 'Lomba',
                'is_featured' => true,
            ],
            [
                'judul' => 'Orasi Peduli Palestina & Gelar Sorban',
                'deskripsi' => 'Acara solidaritas untuk Palestina dengan orasi dan gelar sorban sebagai bentuk dukungan moril kepada saudara-saudara kita di Palestina. Terbuka untuk Jamaah Masjid Agung, Jamaah Haji Al Azhar 2018-2025, dan Masyarakat Umum.',
                'tanggal_mulai' => '2025-01-07 12:45:00',
                'tanggal_selesai' => '2025-01-07 13:30:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 500,
                'status' => 'published',
                'kategori' => 'Fundraising',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Orasi Peduli Palestina',
                        'waktu_mulai' => '2025-01-07 12:45:00',
                        'waktu_selesai' => '2025-01-07 13:00:00',
                        'pembicara' => 'Tokoh Peduli Palestina',
                    ],
                    [
                        'judul' => 'Gelar Sorban untuk Palestina',
                        'waktu_mulai' => '2025-01-07 13:00:00',
                        'waktu_selesai' => '2025-01-07 13:30:00',
                        'deskripsi' => 'Aksi solidaritas dengan gelar sorban bersama',
                    ],
                ],
            ],
            [
                'judul' => 'Ceramah Umum: Peran Masjid dalam Pendidikan Peradaban',
                'deskripsi' => 'Ceramah umum tentang peran strategis masjid dalam membangun pendidikan dan peradaban Islam. Menghadirkan Ustadz Adi Hidayat, Lc., MA sebagai pemateri. Terbuka untuk Jamaah Masjid Agung dan Masyarakat Umum.',
                'tanggal_mulai' => '2025-01-07 13:30:00',
                'tanggal_selesai' => '2025-01-07 15:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 500,
                'status' => 'published',
                'kategori' => 'Ceramah',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Ceramah Utama',
                        'waktu_mulai' => '2025-01-07 13:30:00',
                        'waktu_selesai' => '2025-01-07 14:30:00',
                        'pembicara' => 'Ustadz Adi Hidayat, Lc., MA',
                        'deskripsi' => 'Peran masjid dalam membangun peradaban Islam',
                    ],
                    [
                        'judul' => 'Sesi Tanya Jawab',
                        'waktu_mulai' => '2025-01-07 14:30:00',
                        'waktu_selesai' => '2025-01-07 15:00:00',
                    ],
                ],
            ],
            [
                'judul' => 'Talkshow: Kurikulum Alquran dan Implementasinya',
                'deskripsi' => 'Talkshow tentang kurikulum Alquran dan implementasinya dalam pendidikan dan dakwah. Menghadirkan pakar pendidikan Islam. Terbuka untuk Pendidik dan Masyarakat Umum.',
                'tanggal_mulai' => '2025-01-07 15:25:00',
                'tanggal_selesai' => '2025-01-07 15:45:00',
                'lokasi' => 'Masjid Agung Al Azhar - Auditorium',
                'kapasitas' => 200,
                'status' => 'published',
                'kategori' => 'Talkshow',
                'is_featured' => false,
            ],
            [
                'judul' => 'Demo Halal Cooking & Edukasi Gizi',
                'deskripsi' => 'Demonstrasi memasak makanan halal yang sehat dan bergizi. Edukasi tentang pentingnya gizi seimbang dalam kehidupan sehari-hari. Terbuka untuk Masyarakat Umum.',
                'tanggal_mulai' => '2025-01-07 15:45:00',
                'tanggal_selesai' => '2025-01-07 16:15:00',
                'lokasi' => 'Masjid Agung Al Azhar - Cooking Stage',
                'kapasitas' => 150,
                'status' => 'published',
                'kategori' => 'Workshop',
                'is_featured' => false,
            ],
            [
                'judul' => 'Festival Rampak Gendang',
                'deskripsi' => 'Festival seni budaya dengan pertunjukan Rampak Gendang yang memukau. Menampilkan keindahan seni tradisional Indonesia. Terbuka untuk Peserta Lomba dan Masyarakat Umum.',
                'tanggal_mulai' => '2025-01-07 16:15:00',
                'tanggal_selesai' => '2025-01-07 17:00:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Stage',
                'kapasitas' => 500,
                'status' => 'published',
                'kategori' => 'Performance',
                'is_featured' => true,
            ],
            [
                'judul' => 'Penutupan Al Azhar Expo 2025',
                'deskripsi' => 'Penutupan resmi Al Azhar Expo 2025. Pengumuman juara lomba-lomba (Fashion Show & Robotik), pembagian doorprize untuk pengunjung, dan pesan penutup dari panitia. Sampai jumpa di Al Azhar Expo berikutnya!',
                'tanggal_mulai' => '2025-01-07 17:00:00',
                'tanggal_selesai' => '2025-01-07 17:45:00',
                'lokasi' => 'Masjid Agung Al Azhar - Main Hall',
                'kapasitas' => 500,
                'status' => 'published',
                'kategori' => 'Closing',
                'is_featured' => true,
                'schedules' => [
                    [
                        'judul' => 'Pengumuman Juara Lomba',
                        'waktu_mulai' => '2025-01-07 17:00:00',
                        'waktu_selesai' => '2025-01-07 17:20:00',
                        'deskripsi' => 'Pengumuman juara Fashion Show dan Robotik',
                    ],
                    [
                        'judul' => 'Pembagian Doorprize',
                        'waktu_mulai' => '2025-01-07 17:20:00',
                        'waktu_selesai' => '2025-01-07 17:35:00',
                    ],
                    [
                        'judul' => 'Penutupan & Foto Bersama',
                        'waktu_mulai' => '2025-01-07 17:35:00',
                        'waktu_selesai' => '2025-01-07 17:45:00',
                        'pembicara' => 'Ketua Panitia Al Azhar Expo 2025',
                    ],
                ],
            ],
        ];

        foreach ($events as $eventData) {
            $schedules = $eventData['schedules'] ?? [];
            unset($eventData['schedules']);

            $eventData['slug'] = Str::slug($eventData['judul']);

            $event = Event::create($eventData);

            // Create schedules if any
            foreach ($schedules as $scheduleData) {
                $event->schedules()->create($scheduleData);
            }

            $this->command->info("✅ Created: {$event->judul}");
        }

        $this->command->info('🎉 EventSeeder completed! Created '.count($events).' events.');
    }
}

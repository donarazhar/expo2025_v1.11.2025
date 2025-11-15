<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            // Kategori: Pendaftaran
            [
                'kategori' => 'Pendaftaran',
                'pertanyaan' => 'Bagaimana cara mendaftar Al Azhar Expo 2025?',
                'jawaban' => 'Anda dapat mendaftar melalui website resmi di halaman utama (alazharexpo.com). Isi formulir pendaftaran dengan data lengkap Anda: nama lengkap, email, nomor HP, dan asal instansi. Setelah submit, Anda akan langsung mendapatkan ID Peserta unik (4 karakter) yang dapat digunakan untuk check-in dan mendaftar event.',
                'urutan' => 1,
                'is_published' => true,
            ],
            [
                'kategori' => 'Pendaftaran',
                'pertanyaan' => 'Apakah pendaftaran berbayar?',
                'jawaban' => 'Tidak, pendaftaran Al Azhar Expo 2025 sepenuhnya GRATIS untuk umum. Anda hanya perlu mendaftar untuk mendapatkan ID Peserta. Namun beberapa event khusus mungkin memiliki kuota terbatas dan sistem first-come-first-served.',
                'urutan' => 2,
                'is_published' => true,
            ],
            [
                'kategori' => 'Pendaftaran',
                'pertanyaan' => 'Apakah bisa mendaftar di tempat (on-site)?',
                'jawaban' => 'Ya, Anda masih bisa mendaftar langsung di lokasi acara. Namun kami sangat merekomendasikan untuk mendaftar online terlebih dahulu agar proses check-in lebih cepat dan Anda bisa langsung mendaftar ke event pilihan sebelum kuota penuh.',
                'urutan' => 3,
                'is_published' => true,
            ],
            [
                'kategori' => 'Pendaftaran',
                'pertanyaan' => 'Bagaimana cara mendaftar event setelah registrasi?',
                'jawaban' => 'Setelah mendapat ID Peserta, buka halaman Portal Jamaah > Events. Pilih event yang ingin Anda ikuti, klik "Lihat Detail", lalu masukkan ID Peserta Anda pada form pendaftaran. Anda akan mendapat konfirmasi jika pendaftaran berhasil.',
                'urutan' => 4,
                'is_published' => true,
            ],

            // Kategori: Jadwal
            [
                'kategori' => 'Jadwal',
                'pertanyaan' => 'Kapan Al Azhar Expo 2025 diadakan?',
                'jawaban' => 'Al Azhar Expo 2025 akan diadakan pada tanggal 4-6 Desember 2025 (3 hari). Acara dimulai pukul 08.00 WIB dan berlangsung hingga malam hari.',
                'urutan' => 1,
                'is_published' => true,
            ],
            [
                'kategori' => 'Jadwal',
                'pertanyaan' => 'Apa saja event yang akan diadakan?',
                'jawaban' => 'Al Azhar Expo 2025 menghadirkan berbagai event menarik: Opening Ceremony, Talkshow Nasional (Pendidikan & Adab, Ekonomi Keumatan), Talkshow Special dengan Anies Baswedan & Ustadz Adi Hidayat, Islamic Fashion Show, Lomba Robotik & Coding, Fundraising Gelar Sorban untuk Palestina, Digital Expo, Pertemuan Jamaah Haji, Al Azhar Award, dan Closing Ceremony. Lihat jadwal lengkap di website.',
                'urutan' => 2,
                'is_published' => true,
            ],
            [
                'kategori' => 'Jadwal',
                'pertanyaan' => 'Apakah jadwal bisa berubah?',
                'jawaban' => 'Jadwal yang tertera adalah jadwal sementara dan dapat berubah sewaktu-waktu. Kami akan menginformasikan perubahan jadwal melalui website dan media sosial resmi. Pastikan Anda mengecek update terbaru sebelum datang.',
                'urutan' => 3,
                'is_published' => true,
            ],

            // Kategori: Lokasi
            [
                'kategori' => 'Lokasi',
                'pertanyaan' => 'Dimana lokasi Al Azhar Expo 2025?',
                'jawaban' => 'Lokasi di Masjid Agung Al Azhar, Jl. Sisingamangaraja No. 2, Kebayoran Baru, Jakarta Selatan 12110. Mudah diakses dengan berbagai moda transportasi umum seperti TransJakarta, MRT, dan ojek online.',
                'urutan' => 1,
                'is_published' => true,
            ],
            [
                'kategori' => 'Lokasi',
                'pertanyaan' => 'Bagaimana cara ke lokasi dengan transportasi umum?',
                'jawaban' => 'Dari Stasiun MRT Blok M, naik TransJakarta Koridor 6 jurusan Ragunan dan turun di Halte Masjid Agung Al Azhar (tepat di depan lokasi). Atau dari Stasiun MRT Senayan/Blok A, bisa jalan kaki sekitar 15 menit atau naik ojek online.',
                'urutan' => 2,
                'is_published' => true,
            ],
            [
                'kategori' => 'Lokasi',
                'pertanyaan' => 'Apakah tersedia parkir?',
                'jawaban' => 'Ya, tersedia area parkir gratis untuk motor dan mobil di area Masjid Agung Al Azhar. Namun kapasitas terbatas, kami sarankan datang lebih awal atau gunakan transportasi umum.',
                'urutan' => 3,
                'is_published' => true,
            ],

            // Kategori: Fasilitas
            [
                'kategori' => 'Fasilitas',
                'pertanyaan' => 'Fasilitas apa saja yang tersedia?',
                'jawaban' => 'Tersedia berbagai fasilitas: parkir gratis, musholla yang luas, toilet bersih, area makan/food court, WiFi gratis, charging station, ruang laktasi, area bermain anak, dan fasilitas kesehatan/P3K. Semua fasilitas dapat diakses dengan mudah di area acara.',
                'urutan' => 1,
                'is_published' => true,
            ],
            [
                'kategori' => 'Fasilitas',
                'pertanyaan' => 'Apakah ada penyediaan makanan?',
                'jawaban' => 'Ya, tersedia food court dengan berbagai pilihan makanan dan minuman halal. Harga terjangkau mulai dari Rp 10.000. Anda juga diperbolehkan membawa makanan dari luar.',
                'urutan' => 2,
                'is_published' => true,
            ],
            [
                'kategori' => 'Fasilitas',
                'pertanyaan' => 'Apakah ada dress code?',
                'jawaban' => 'Tidak ada dress code khusus, namun kami menganjurkan berpakaian sopan dan menutup aurat sesuai syariat Islam karena acara diadakan di Masjid. Dilarang memakai pakaian ketat, transparan, atau terlalu terbuka.',
                'urutan' => 3,
                'is_published' => true,
            ],

            // Kategori: Kontak
            [
                'kategori' => 'Kontak',
                'pertanyaan' => 'Bagaimana cara menghubungi panitia?',
                'jawaban' => 'Anda dapat menghubungi kami melalui: Email: info@alazharexpo.com, WhatsApp: +62 821 xxxx xxxx (jam kerja 08.00-17.00 WIB), atau melalui form feedback di website Portal Jamaah.',
                'urutan' => 1,
                'is_published' => true,
            ],
            [
                'kategori' => 'Kontak',
                'pertanyaan' => 'Bagaimana jika ID Peserta hilang?',
                'jawaban' => 'Jika ID Peserta hilang, silakan hubungi panitia via WhatsApp atau datang ke booth informasi dengan membawa identitas diri (KTP/Kartu Pelajar). Tim kami akan membantu menemukan ID Peserta Anda berdasarkan data registrasi.',
                'urutan' => 2,
                'is_published' => true,
            ],

            // Kategori: Lain-lain
            [
                'kategori' => 'Lain-lain',
                'pertanyaan' => 'Apakah anak-anak boleh ikut?',
                'jawaban' => 'Ya, anak-anak sangat dipersilakan untuk ikut. Tersedia area bermain anak dan beberapa kegiatan khusus untuk anak-anak. Orang tua wajib mengawasi anak-anak selama acara berlangsung.',
                'urutan' => 1,
                'is_published' => true,
            ],
            [
                'kategori' => 'Lain-lain',
                'pertanyaan' => 'Apakah boleh membawa kamera profesional?',
                'jawaban' => 'Untuk kamera pocket/HP diperbolehkan. Untuk kamera DSLR/profesional, harap konfirmasi terlebih dahulu ke panitia. Media/fotografer resmi harus menunjukkan surat tugas.',
                'urutan' => 2,
                'is_published' => true,
            ],
            [
                'kategori' => 'Lain-lain',
                'pertanyaan' => 'Apakah ada sertifikat untuk peserta?',
                'jawaban' => 'Sertifikat diberikan untuk event tertentu yang membutuhkan (seminar, workshop, lomba). Untuk mendapatkan sertifikat, pastikan Anda melakukan check-in dan mengikuti event hingga selesai. Sertifikat dapat diunduh melalui Portal Jamaah setelah acara.',
                'urutan' => 3,
                'is_published' => true,
            ],
        ];

        foreach ($faqs as $faqData) {
            $faq = Faq::create($faqData);
            $this->command->info("✅ Created FAQ: {$faq->pertanyaan}");
        }

        $this->command->info('🎉 FaqSeeder completed! Created '.count($faqs).' FAQs.');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Feedback;
use App\Models\Peserta;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    public function run()
    {
        // Check if we have peserta
        $pesertas = Peserta::all();

        if ($pesertas->isEmpty()) {
            $this->command->warn('⚠️  No Peserta found. Please run PesertaSeeder first!');

            return;
        }

        $events = Event::all();

        $feedbackTemplates = [
            [
                'rating' => 5,
                'komentar' => 'Alhamdulillah, Al Azhar Expo tahun ini luar biasa! Materi yang disampaikan sangat bermanfaat dan menginspirasi. Panitia juga sangat ramah dan profesional. Terima kasih Al Azhar!',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'rating' => 5,
                'komentar' => 'MasyaAllah, event yang sangat berkesan. Terutama talkshow dengan Ustadz Adi Hidayat dan Pak Anies Baswedan. Insight yang dibagikan sangat dalam dan aplikatif. Semoga bisa hadir lagi tahun depan!',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'rating' => 5,
                'komentar' => 'Pengalaman yang tak terlupakan! Dari opening sampai closing, semua terorganisir dengan baik. Fasilitas lengkap, acara variatif, dan yang paling penting: spiritualitas yang terasa. Jazakumullah khairan!',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'rating' => 4,
                'komentar' => 'Event yang sangat bagus! Islamic Fashion Show nya keren banget, membuktikan busana muslim bisa stylish dan syar\'i. Cuma mungkin untuk parkir bisa diperluas karena agak penuh. Overall recommended!',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 5,
                'komentar' => 'Sebagai guru, saya sangat terbantu dengan seminar pendidikan yang diadakan. Materi yang disampaikan Prof. Arief Rachman sangat applicable untuk dunia pendidikan. Terima kasih Al Azhar!',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 4,
                'komentar' => 'Anak saya sangat senang ikut lomba robotik. Kompetisinya seru dan menantang. Makanan di food court juga enak-enak dan harganya terjangkau. Recommended untuk keluarga!',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 5,
                'komentar' => 'Program Gelar Sorban untuk Palestina sangat menyentuh hati. Semoga bantuan kita bisa bermanfaat untuk saudara-saudara di sana. Barakallahu fiikum Al Azhar!',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 5,
                'komentar' => 'Pertemuan jamaah haji nya sangat hangat dan penuh makna. Senang bisa ketemu lagi dengan teman-teman seperjalanan. Terima kasih Al Azhar sudah memfasilitasi!',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 4,
                'komentar' => 'Digital Expo nya informatif! Banyak teknologi baru untuk pendidikan yang saya baru tau. Cuma mungkin waktu untuk trial bisa lebih lama. But still, great event!',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 5,
                'komentar' => 'Live streaming nya sangat membantu bagi yang tidak bisa hadir. Kualitas video dan audio jernih. Admin juga responsif jawab pertanyaan di chat. Top!',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 5,
                'komentar' => 'Seminar ekonomi syariah nya eye-opening! Pak Syafi\'i Antonio membuka wawasan saya tentang potensi ekonomi Islam. Langsung tertarik untuk belajar lebih dalam.',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 4,
                'komentar' => 'Acara keseluruhan bagus, hanya saja untuk beberapa sesi agak mepet waktunya. Tapi overall sangat puas dengan pengalaman di Al Azhar Expo ini!',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 5,
                'komentar' => 'WiFi gratis nya sangat membantu! Jadi bisa langsung share ke medsos dan update keluarga. Charging station juga available. Panitia sudah pikirkan detail banget!',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 5,
                'komentar' => 'Al Azhar Award ceremony nya sangat touching. Para penerima penghargaan benar-benar inspiratif. Semoga Al Azhar terus melahirkan generasi terbaik bangsa!',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'rating' => 4,
                'komentar' => 'Closing ceremony nya meriah! Penampilan seni budaya Islam nya keren. Sedih event nya udah selesai, tapi excited buat next year. See you Al Azhar Expo 2026!',
                'is_published' => true,
                'is_featured' => false,
            ],
        ];

        $createdCount = 0;

        foreach ($feedbackTemplates as $template) {
            // Random peserta
            $peserta = $pesertas->random();

            // Random event or null (general feedback)
            $event = $events->isNotEmpty() && rand(0, 1) ? $events->random() : null;

            $feedbackData = array_merge($template, [
                'id_peserta' => $peserta->id_peserta,
                'event_id' => $event?->id,
            ]);

            $feedback = Feedback::create($feedbackData);
            $createdCount++;

            $eventName = $event ? $event->judul : 'General Feedback';
            $this->command->info("✅ Created feedback from {$peserta->nama_lengkap} for {$eventName}");
        }

        $this->command->info("🎉 FeedbackSeeder completed! Created {$createdCount} feedbacks.");
    }
}

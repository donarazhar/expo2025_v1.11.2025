<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $events = Event::all();

        if ($events->isEmpty()) {
            $this->command->warn('⚠️  No Events found. Please run EventSeeder first!');

            return;
        }

        // Get some specific events
        $openingEvent = Event::where('judul', 'LIKE', '%Opening%')->first();
        $talkshowEvent = Event::where('judul', 'LIKE', '%Pendidikan%')->first();
        $fashionEvent = Event::where('judul', 'LIKE', '%Fashion%')->first();
        $robotikEvent = Event::where('judul', 'LIKE', '%Robotik%')->first();
        $closingEvent = Event::where('judul', 'LIKE', '%Closing%')->first();

        $galleries = [
            // Opening Ceremony
            [
                'event_id' => $openingEvent?->id,
                'judul' => 'Opening Ceremony - Sambutan Ketua Panitia',
                'deskripsi' => 'Dr. H. Ahmad Syafii, M.Pd memberikan sambutan pembukaan Al Azhar Expo 2025',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Opening',
                'urutan' => 1,
            ],
            [
                'event_id' => $openingEvent?->id,
                'judul' => 'Opening Ceremony - Moment Pembukaan',
                'deskripsi' => 'Moment pembukaan resmi oleh Prof. Dr. Ir. Asep Saefuddin, M.Sc',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Opening',
                'urutan' => 2,
            ],
            [
                'event_id' => $openingEvent?->id,
                'judul' => 'Suasana Opening Ceremony',
                'deskripsi' => 'Antusiasme jamaah memadati Main Hall Masjid Agung Al Azhar',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Opening',
                'urutan' => 3,
            ],

            // Talkshow
            [
                'event_id' => $talkshowEvent?->id,
                'judul' => 'Talkshow Pendidikan - Prof. Arief Rachman',
                'deskripsi' => 'Prof. Dr. Arief Rachman membahas pendidikan karakter di era digital',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Talkshow',
                'urutan' => 4,
            ],
            [
                'event_id' => $talkshowEvent?->id,
                'judul' => 'Talkshow Pendidikan - Sesi Diskusi',
                'deskripsi' => 'Diskusi interaktif dengan peserta tentang implementasi pendidikan karakter',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Talkshow',
                'urutan' => 5,
            ],
            [
                'event_id' => $talkshowEvent?->id,
                'judul' => 'Talkshow Special - Anies & Ustadz Adi',
                'deskripsi' => 'Dialog eksklusif dengan dua tokoh nasional',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Talkshow',
                'urutan' => 6,
            ],

            // Fashion Show
            [
                'event_id' => $fashionEvent?->id,
                'judul' => 'Islamic Fashion Show - Koleksi Modern',
                'deskripsi' => 'Model menampilkan koleksi busana muslim modern dari desainer muda',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Fashion Show',
                'urutan' => 7,
            ],
            [
                'event_id' => $fashionEvent?->id,
                'judul' => 'Islamic Fashion Show - Runway',
                'deskripsi' => 'Peragaan busana di Main Stage dengan backdrop yang menawan',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Fashion Show',
                'urutan' => 8,
            ],
            [
                'event_id' => $fashionEvent?->id,
                'judul' => 'Islamic Fashion Show - Designer Collection',
                'deskripsi' => 'Koleksi eksklusif dari desainer ternama',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Fashion Show',
                'urutan' => 9,
            ],

            // Lomba & Competition
            [
                'event_id' => $robotikEvent?->id,
                'judul' => 'Lomba Robotik - Kompetisi Line Follower',
                'deskripsi' => 'Para peserta menguji robot line follower mereka',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Lomba',
                'urutan' => 10,
            ],
            [
                'event_id' => $robotikEvent?->id,
                'judul' => 'Lomba Coding - Sesi Programming',
                'deskripsi' => 'Peserta fokus menyelesaikan tantangan coding',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Lomba',
                'urutan' => 11,
            ],
            [
                'event_id' => $robotikEvent?->id,
                'judul' => 'Lomba Robotik - Awarding Ceremony',
                'deskripsi' => 'Penyerahan hadiah kepada para pemenang',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Lomba',
                'urutan' => 12,
            ],

            // General Event
            [
                'event_id' => null,
                'judul' => 'Pameran Stand - Area Exhibitor',
                'deskripsi' => 'Berbagai stand pameran dari lembaga dan unit Al Azhar',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Pameran',
                'urutan' => 13,
            ],
            [
                'event_id' => null,
                'judul' => 'Bazar Produk - Produk Unggulan',
                'deskripsi' => 'Pengunjung melihat-lihat produk unggulan Al Azhar',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Pameran',
                'urutan' => 14,
            ],
            [
                'event_id' => null,
                'judul' => 'Bazar Makanan - Food Court',
                'deskripsi' => 'Area food court dengan berbagai pilihan makanan halal',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Pameran',
                'urutan' => 15,
            ],

            // Lokasi & Venue
            [
                'event_id' => null,
                'judul' => 'Masjid Agung Al Azhar - Exterior',
                'deskripsi' => 'Kemegahan arsitektur Masjid Agung Al Azhar',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Lokasi',
                'urutan' => 16,
            ],
            [
                'event_id' => null,
                'judul' => 'Main Hall - Interior',
                'deskripsi' => 'Interior Main Hall yang luas dan megah',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Lokasi',
                'urutan' => 17,
            ],
            [
                'event_id' => null,
                'judul' => 'Auditorium - Conference Hall',
                'deskripsi' => 'Ruang auditorium modern dengan fasilitas lengkap',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Lokasi',
                'urutan' => 18,
            ],

            // Closing
            [
                'event_id' => $closingEvent?->id,
                'judul' => 'Closing Ceremony - Foto Bersama',
                'deskripsi' => 'Foto bersama panitia dan peserta di penutupan acara',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Closing',
                'urutan' => 19,
            ],
            [
                'event_id' => $closingEvent?->id,
                'judul' => 'Closing Ceremony - Al Azhar Award',
                'deskripsi' => 'Penyerahan penghargaan Al Azhar Award',
                'image_path' => 'gallery/no-image.jpg',
                'kategori' => 'Closing',
                'urutan' => 20,
            ],
        ];

        foreach ($galleries as $galleryData) {
            $gallery = Gallery::create($galleryData);
            $this->command->info("✅ Created: {$gallery->judul}");
        }

        $this->command->info('🎉 GallerySeeder completed! Created '.count($galleries).' images.');
        $this->command->warn('⚠️  Note: Placeholder image paths. Update with actual files in storage/app/public/gallery/');
    }
}

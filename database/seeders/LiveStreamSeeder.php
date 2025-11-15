<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\LiveStream;
use Illuminate\Database\Seeder;

class LiveStreamSeeder extends Seeder
{
    public function run()
    {
        // Get some events for linking
        $openingEvent = Event::where('judul', 'LIKE', '%Opening Ceremony%')->first();
        $talkshowSpecial = Event::where('judul', 'LIKE', '%Anies Baswedan%')->first();
        $fashionShow = Event::where('judul', 'LIKE', '%Fashion Show%')->first();
        $closingEvent = Event::where('judul', 'LIKE', '%Closing%')->first();

        $liveStreams = [
            [
                'event_id' => $openingEvent?->id,
                'judul' => '🔴 LIVE: Opening Ceremony Al Azhar Expo 2025',
                'platform' => 'youtube',
                'stream_url' => 'dQw4w9WgXcQ', // YouTube video ID
                'status' => 'scheduled',
                'jadwal_tayang' => '2025-12-04 08:00:00',
            ],
            [
                'event_id' => $talkshowSpecial?->id,
                'judul' => '🔴 LIVE: Talkshow Special - Anies Baswedan & Ustadz Adi Hidayat',
                'platform' => 'youtube',
                'stream_url' => 'dQw4w9WgXcQ',
                'status' => 'scheduled',
                'jadwal_tayang' => '2025-12-05 15:30:00',
            ],
            [
                'event_id' => $fashionShow?->id,
                'judul' => '🔴 LIVE: Islamic Fashion Show 2025',
                'platform' => 'other', // Changed from 'instagram' to 'other'
                'stream_url' => 'https://instagram.com/alazharjakarta',
                'status' => 'scheduled',
                'jadwal_tayang' => '2025-12-04 14:00:00',
            ],
            [
                'event_id' => $closingEvent?->id,
                'judul' => '🔴 LIVE: Closing Ceremony Al Azhar Expo 2025',
                'platform' => 'youtube',
                'stream_url' => 'dQw4w9WgXcQ',
                'status' => 'scheduled',
                'jadwal_tayang' => '2025-12-06 17:00:00',
            ],
            [
                'event_id' => null,
                'judul' => '🔴 LIVE: Behind The Scenes - Persiapan Al Azhar Expo',
                'platform' => 'youtube',
                'stream_url' => 'dQw4w9WgXcQ',
                'status' => 'scheduled',
                'jadwal_tayang' => now()->addDays(1),
            ],
        ];

        foreach ($liveStreams as $streamData) {
            $stream = LiveStream::create($streamData);
            $this->command->info("✅ Created: {$stream->judul}");
        }

        $this->command->info('🎉 LiveStreamSeeder completed! Created '.count($liveStreams).' live streams.');
    }
}

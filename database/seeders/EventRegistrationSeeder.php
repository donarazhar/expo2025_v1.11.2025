<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Peserta;
use Illuminate\Database\Seeder;

class EventRegistrationSeeder extends Seeder
{
    public function run()
    {
        $events = Event::all();
        $pesertas = Peserta::all();

        if ($events->isEmpty() || $pesertas->isEmpty()) {
            $this->command->warn('⚠️  No Events or Pesertas found. Please run EventSeeder and PesertaSeeder first!');

            return;
        }

        $createdCount = 0;

        // Register random pesertas to random events
        foreach ($events as $event) {
            // Register 5-15 random pesertas to each event
            $numberOfRegistrations = rand(5, min(15, $pesertas->count()));
            $selectedPesertas = $pesertas->random($numberOfRegistrations);

            foreach ($selectedPesertas as $peserta) {
                // Check if already registered
                $exists = EventRegistration::where('event_id', $event->id)
                    ->where('id_peserta', $peserta->id_peserta)
                    ->exists();

                if (! $exists) {
                    EventRegistration::create([
                        'event_id' => $event->id,
                        'id_peserta' => $peserta->id_peserta,
                        'status' => 'confirmed',
                    ]);
                    $createdCount++;
                }
            }
        }

        $this->command->info("🎉 EventRegistrationSeeder completed! Created {$createdCount} registrations.");
    }
}

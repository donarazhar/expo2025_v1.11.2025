<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info("🚀 Starting Database Seeding...\n");

        // Order matters! Follow this sequence:
        $this->call([
            // 1. Admin Users (Independent)
            AdminUserSeeder::class,

            // // 2. Peserta (Independent)
            PesertaSeeder::class,

            // // 3. Events (Independent)
            EventSeeder::class,

            // // 4. Event Registrations (Depends on: Peserta, Events)
            // EventRegistrationSeeder::class,

            // // 5. Live Streams (Depends on: Events)
            // LiveStreamSeeder::class,

            // // 6. Gallery (Depends on: Events)
            // GallerySeeder::class,

            // // 7. FAQs (Independent)
            FaqSeeder::class,

            // // 8. Feedback (Depends on: Peserta, Events)
            // FeedbackSeeder::class,
        ]);

        // $this->command->info("\n✅ All seeders completed successfully!");
        // $this->command->info("🎉 Database is ready for testing!\n");

        // // Display summary
        // $this->displaySummary();
    }

    private function displaySummary()
    {
        $this->command->info('📊 DATABASE SUMMARY:');
        $this->command->table(
            ['Table', 'Count'],
            [
                ['Admin Users', \App\Models\AdminUser::count()],
                ['Peserta', \App\Models\Peserta::count()],
                ['Events', \App\Models\Event::count()],
                ['Event Schedules', \App\Models\EventSchedule::count()],
                ['Event Registrations', \App\Models\EventRegistration::count()],
                ['Live Streams', \App\Models\LiveStream::count()],
                ['Gallery', \App\Models\Gallery::count()],
                ['FAQs', \App\Models\Faq::count()],
                ['Feedback', \App\Models\Feedback::count()],
            ]
        );

        $this->command->info("\n🔐 LOGIN CREDENTIALS:");
        $this->command->info('Super Admin: admin@alazharexpo.com / password');
        $this->command->info('Admin User: user@alazharexpo.com / password');

        $this->command->info("\n👤 SAMPLE PESERTA IDs:");
        $this->command->info('A7K2, B3M9, C5L7, D8N4, E2P6 (and 15 more)');
    }
}

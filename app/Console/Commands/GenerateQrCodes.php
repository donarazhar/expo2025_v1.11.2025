<?php

namespace App\Console\Commands;

use App\Models\ESertifikat;
use Illuminate\Console\Command;

class GenerateQrCodes extends Command
{
    protected $signature = 'sertifikat:generate-qr {--all : Generate for all certificates}';

    protected $description = 'Generate QR codes for certificates';

    public function handle()
    {
        if ($this->option('all')) {
            $sertifikats = ESertifikat::all();
            $this->info("Generating QR codes for ALL {$sertifikats->count()} certificates...");
        } else {
            $sertifikats = ESertifikat::whereNull('qr_code')
                ->orWhere('qr_code', '')
                ->get();
            $this->info("Generating QR codes for {$sertifikats->count()} certificates without QR code...");
        }

        if ($sertifikats->isEmpty()) {
            $this->info('No certificates need QR code generation.');

            return Command::SUCCESS;
        }

        $bar = $this->output->createProgressBar($sertifikats->count());
        $bar->start();

        $success = 0;
        $failed = 0;
        $errors = [];

        foreach ($sertifikats as $sertifikat) {
            try {
                $result = $sertifikat->generateQrCode();
                if ($result) {
                    $success++;
                } else {
                    $failed++;
                    $errors[] = "Failed for {$sertifikat->nomor_sertifikat}: generateQrCode returned false";
                }
            } catch (\Exception $e) {
                $failed++;
                $errors[] = "Exception for {$sertifikat->nomor_sertifikat}: {$e->getMessage()}";
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Show errors
        if (! empty($errors)) {
            $this->error('Errors:');
            foreach ($errors as $error) {
                $this->error("  - {$error}");
            }
            $this->newLine();
        }

        $this->info("✓ Success: {$success}");
        if ($failed > 0) {
            $this->warn("✗ Failed: {$failed}");
        }

        return Command::SUCCESS;
    }
}

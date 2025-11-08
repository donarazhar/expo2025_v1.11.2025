<?php

namespace App\Services;

use App\Models\Peserta;
use App\Models\ESertifikat;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class EmailService
{
    /**
     * Send registration confirmation email
     */
    public function sendRegistrationConfirmation(Peserta $peserta): bool
    {
        try {
            $data = [
                'nama' => $peserta->nama_lengkap,
                'id_peserta' => $peserta->id_peserta,
                'email' => $peserta->email,
                'no_hp' => $peserta->no_hp,
                'instansi' => $peserta->asal_instansi,
                'tgl_registrasi' => $peserta->tgl_registrasi->format('d F Y, H:i'),
                'qr_code_url' => $this->getQRCodeUrl($peserta),
                'event_date' => '4-6 Desember 2025',
                'event_location' => 'Masjid Agung Al Azhar Jakarta',
            ];

            $this->sendEmail(
                $peserta->email,
                'Konfirmasi Pendaftaran Al Azhar Expo 2025',
                'emails.registration-confirmation',
                $data
            );

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send registration email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send certificate email
     */
    public function sendCertificate(string $email, string $nama, ESertifikat $sertifikat, string $certificateHTML): bool
    {
        try {
            $data = [
                'nama' => $nama,
                'nomor_sertifikat' => $sertifikat->nomor_sertifikat,
                'tanggal_terbit' => $sertifikat->tgl_penerbitan->format('d F Y'),
                'certificate_url' => route('certificate.download', $sertifikat->id_sertifikat),
                'verification_url' => route('certificate.verify', $sertifikat->nomor_sertifikat),
            ];

            $this->sendEmail(
                $email,
                'E-Sertifikat Al Azhar Expo 2025',
                'emails.certificate',
                $data
            );

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send certificate email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send attendance reminder (H-1)
     */
    public function sendAttendanceReminder(Peserta $peserta): bool
    {
        try {
            $data = [
                'nama' => $peserta->nama_lengkap,
                'event_date' => '4-6 Desember 2025',
                'event_location' => 'Masjid Agung Al Azhar Jakarta',
                'event_time' => '08.00 - 16.00 WIB',
                'qr_code_url' => $this->getQRCodeUrl($peserta),
                'maps_url' => 'https://goo.gl/maps/al-azhar-jakarta',
            ];

            $this->sendEmail(
                $peserta->email,
                'Pengingat: Al Azhar Expo 2025 Besok!',
                'emails.attendance-reminder',
                $data
            );

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send reminder email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send bulk emails
     */
    public function sendBulkEmail(array $recipients, string $subject, string $view, array $data): int
    {
        $sentCount = 0;

        foreach ($recipients as $recipient) {
            try {
                $this->sendEmail($recipient['email'], $subject, $view, array_merge($data, [
                    'nama' => $recipient['nama'] ?? 'Peserta',
                ]));
                $sentCount++;
            } catch (\Exception $e) {
                Log::error("Failed to send email to {$recipient['email']}: {$e->getMessage()}");
            }
        }

        return $sentCount;
    }

    /**
     * Core email sending function
     */
    private function sendEmail(string $to, string $subject, string $view, array $data): void
    {
        // Check if mail is configured
        if (!$this->isMailConfigured()) {
            Log::warning('Mail not configured. Email simulation: ' . $to);
            $this->simulateEmail($to, $subject, $data);
            return;
        }

        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)
                   ->subject($subject)
                   ->from(config('mail.from.address'), config('mail.from.name'));
        });
    }

    /**
     * Check if mail is configured
     */
    private function isMailConfigured(): bool
    {
        return config('mail.mailers.smtp.host') !== 'mailpit' 
            && config('mail.from.address') !== 'hello@example.com';
    }

    /**
     * Simulate email sending (for development)
     */
    private function simulateEmail(string $to, string $subject, array $data): void
    {
        Log::info('=== EMAIL SIMULATION ===');
        Log::info("To: {$to}");
        Log::info("Subject: {$subject}");
        Log::info('Data: ' . json_encode($data, JSON_PRETTY_PRINT));
        Log::info('========================');
    }

    /**
     * Get QR Code URL for peserta
     */
    private function getQRCodeUrl(Peserta $peserta): string
    {
        $qrService = new QRCodeService();
        return $qrService->generateDownloadableQR($peserta);
    }

    /**
     * Send test email
     */
    public function sendTestEmail(string $email): bool
    {
        try {
            $data = [
                'nama' => 'Test User',
                'message' => 'This is a test email from Al Azhar Expo 2025 system.',
            ];

            $this->sendEmail(
                $email,
                'Test Email - Al Azhar Expo 2025',
                'emails.test',
                $data
            );

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send test email: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get email statistics
     */
    public function getStatistics(): array
    {
        return [
            'mail_configured' => $this->isMailConfigured(),
            'mail_driver' => config('mail.default'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
        ];
    }
}
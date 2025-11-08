<?php

namespace App\Services;

use App\Models\ESertifikat;
use App\Models\Peserta;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class CertificateService
{
    /**
     * Generate certificate for peserta
     */
    public function generateCertificate(Peserta $peserta): ESertifikat
    {
        // Create sertifikat record
        $sertifikat = ESertifikat::create([
            'qr_code_token' => $peserta->qr_code_token,
            'tgl_penerbitan' => now(),
        ]);

        // Generate PDF (will be created when downloaded)
        return $sertifikat;
    }

    /**
     * Generate certificate HTML
     */
    public function generateCertificateHTML(ESertifikat $sertifikat): string
    {
        $peserta = $sertifikat->peserta;
        
        if (!$peserta) {
            throw new \Exception('Peserta not found for certificate');
        }

        $data = [
            'nomor_sertifikat' => $sertifikat->nomor_sertifikat,
            'nama_peserta' => $peserta->nama_lengkap,
            'email' => $peserta->email,
            'instansi' => $peserta->asal_instansi,
            'tanggal_terbit' => $sertifikat->tgl_penerbitan->format('d F Y'),
            'qr_code_url' => $this->generateCertificateQR($sertifikat),
        ];

        return View::make('certificates.template', $data)->render();
    }

    /**
     * Generate QR Code for certificate verification
     */
    private function generateCertificateQR(ESertifikat $sertifikat): string
    {
        $verificationUrl = route('certificate.verify', [
            'number' => $sertifikat->nomor_sertifikat
        ]);

        $size = '200x200';
        return sprintf(
            'https://chart.googleapis.com/chart?chs=%s&cht=qr&chl=%s&choe=UTF-8',
            $size,
            urlencode($verificationUrl)
        );
    }

    /**
     * Generate certificate as downloadable HTML
     */
    public function generateDownloadableHTML(ESertifikat $sertifikat): string
    {
        $html = $this->generateCertificateHTML($sertifikat);
        
        // Add print styles and auto-download script
        $html = $this->addDownloadScripts($html, $sertifikat);
        
        return $html;
    }

    /**
     * Add download and print scripts
     */
    private function addDownloadScripts(string $html, ESertifikat $sertifikat): string
    {
        $script = <<<HTML
        <script>
            // Auto print on load
            window.onload = function() {
                window.print();
            };
        </script>
        HTML;

        return str_replace('</body>', $script . '</body>', $html);
    }

    /**
     * Verify certificate by number
     */
    public function verifyCertificate(string $nomorSertifikat): ?ESertifikat
    {
        return ESertifikat::where('nomor_sertifikat', $nomorSertifikat)
                         ->with('peserta')
                         ->first();
    }

    /**
     * Bulk generate certificates for all attended participants
     */
    public function bulkGenerate(): int
    {
        $peserta = Peserta::has('absensi')
                         ->doesntHave('sertifikat')
                         ->get();

        $count = 0;
        foreach ($peserta as $p) {
            try {
                $this->generateCertificate($p);
                $count++;
            } catch (\Exception $e) {
                \Log::error("Failed to generate certificate for {$p->id_peserta}: {$e->getMessage()}");
            }
        }

        return $count;
    }

    /**
     * Send certificate via email
     */
    public function sendCertificateEmail(ESertifikat $sertifikat): bool
    {
        $peserta = $sertifikat->peserta;
        
        if (!$peserta || !$peserta->email) {
            return false;
        }

        try {
            // Generate certificate HTML
            $certificateHTML = $this->generateCertificateHTML($sertifikat);
            
            // Send email (using EmailService)
            $emailService = new EmailService();
            $emailService->sendCertificate($peserta->email, $peserta->nama_lengkap, $sertifikat, $certificateHTML);
            
            // Update status
            $sertifikat->update(['status_kirim' => true]);
            
            return true;
        } catch (\Exception $e) {
            \Log::error("Failed to send certificate email: {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Get certificate statistics
     */
    public function getStatistics(): array
    {
        return [
            'total_issued' => ESertifikat::count(),
            'total_sent' => ESertifikat::where('status_kirim', true)->count(),
            'pending_send' => ESertifikat::where('status_kirim', false)->count(),
            'eligible_for_certificate' => Peserta::has('absensi')->doesntHave('sertifikat')->count(),
        ];
    }
}
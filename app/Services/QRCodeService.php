<?php

namespace App\Services;

use App\Models\Peserta;
use Illuminate\Support\Facades\Storage;

class QRCodeService
{
    /**
     * Generate QR Code for peserta
     * Using Google Charts API as fallback
     */
    public function generateQRCode(Peserta $peserta): string
    {
        $data = $this->getQRData($peserta);
        
        // Generate QR Code using Google Charts API
        $qrCodeUrl = $this->generateQRCodeUrl($data);
        
        // Download and save QR Code
        $qrCodePath = $this->saveQRCode($peserta->id_peserta, $qrCodeUrl);
        
        return $qrCodePath;
    }

    /**
     * Get data to be encoded in QR Code
     */
    private function getQRData(Peserta $peserta): string
    {
        return json_encode([
            'token' => $peserta->qr_code_token,
            'id' => $peserta->id_peserta,
            'name' => $peserta->nama_lengkap,
            'email' => $peserta->email,
            'event' => 'Al Azhar Expo 2025',
        ]);
    }

    /**
     * Generate QR Code URL using Google Charts API
     */
    private function generateQRCodeUrl(string $data): string
    {
        $size = '300x300';
        $encoding = 'UTF-8';
        
        return sprintf(
            'https://chart.googleapis.com/chart?chs=%s&cht=qr&chl=%s&choe=%s',
            $size,
            urlencode($data),
            $encoding
        );
    }

    /**
     * Save QR Code to storage
     */
    private function saveQRCode(string $idPeserta, string $qrCodeUrl): string
    {
        try {
            // Create directory if not exists
            $directory = 'public/qrcodes';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Download QR Code image
            $qrCodeContent = file_get_contents($qrCodeUrl);
            
            // Save with peserta ID
            $filename = "qrcode_{$idPeserta}.png";
            $path = "{$directory}/{$filename}";
            
            Storage::put($path, $qrCodeContent);
            
            return Storage::url($path);
        } catch (\Exception $e) {
            \Log::error('QR Code generation failed: ' . $e->getMessage());
            return '';
        }
    }

    /**
     * Generate QR Code as base64 for immediate display
     */
    public function generateQRCodeBase64(Peserta $peserta): string
    {
        $data = $this->getQRData($peserta);
        $qrCodeUrl = $this->generateQRCodeUrl($data);
        
        try {
            $imageContent = file_get_contents($qrCodeUrl);
            return 'data:image/png;base64,' . base64_encode($imageContent);
        } catch (\Exception $e) {
            \Log::error('QR Code base64 generation failed: ' . $e->getMessage());
            return '';
        }
    }

    /**
     * Verify QR Code token
     */
    public function verifyQRCode(string $token): ?Peserta
    {
        return Peserta::where('qr_code_token', $token)->first();
    }

    /**
     * Generate QR Code for download (high quality)
     */
    public function generateDownloadableQR(Peserta $peserta): string
    {
        $data = $this->getQRData($peserta);
        
        // Generate larger QR Code for download
        $size = '500x500';
        $qrCodeUrl = sprintf(
            'https://chart.googleapis.com/chart?chs=%s&cht=qr&chl=%s&choe=UTF-8',
            $size,
            urlencode($data)
        );
        
        return $qrCodeUrl;
    }
}
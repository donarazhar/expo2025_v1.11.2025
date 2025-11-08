<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegistrationController extends Controller
{
    /**
     * Store a new registration
     */
    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:peserta,email|max:255',
            'no_hp' => 'required|string|regex:/^(\+62|62|0)[0-9]{9,12}$/|max:20',
            'asal_instansi' => 'required|string|min:3|max:255',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nama_lengkap.min' => 'Nama lengkap minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.regex' => 'Format nomor HP tidak valid (contoh: 081234567890)',
            'asal_instansi.required' => 'Asal instansi wajib diisi',
            'asal_instansi.min' => 'Asal instansi minimal 3 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create new peserta
            $peserta = Peserta::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'asal_instansi' => $request->asal_instansi,
            ]);

            // Generate QR Code (optional - save to storage)
            // $this->generateQRCode($peserta);

            // Send confirmation email (optional)
            // $this->sendConfirmationEmail($peserta);

            return response()->json([
                'message' => 'Pendaftaran berhasil!',
                'id_peserta' => $peserta->id_peserta,
                'qr_code_token' => $peserta->qr_code_token,
                'data' => [
                    'nama_lengkap' => $peserta->nama_lengkap,
                    'email' => $peserta->email,
                    'tgl_registrasi' => $peserta->tgl_registrasi->format('d F Y H:i'),
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat pendaftaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show success page
     */
    public function success($id_peserta)
    {
        $peserta = Peserta::where('id_peserta', $id_peserta)->firstOrFail();
        
        return view('success', compact('peserta'));
    }

    /**
     * Download QR Code
     */
    public function downloadQr($id_peserta)
    {
        $peserta = Peserta::where('id_peserta', $id_peserta)->firstOrFail();
        
        // Generate QR Code
        $qrCode = QrCode::format('png')
                        ->size(400)
                        ->margin(2)
                        ->errorCorrection('H')
                        ->generate($peserta->qr_code_token);
        
        return response($qrCode)
                ->header('Content-Type', 'image/png')
                ->header('Content-Disposition', 'attachment; filename="QR-' . $peserta->id_peserta . '.png"');
    }

    /**
     * Generate and save QR Code
     */
    private function generateQRCode($peserta)
    {
        $qrCode = QrCode::format('png')
                        ->size(400)
                        ->margin(2)
                        ->errorCorrection('H')
                        ->generate($peserta->qr_code_token);
        
        // Save to storage
        $path = 'qrcodes/' . $peserta->id_peserta . '.png';
        \Storage::put('public/' . $path, $qrCode);
        
        return $path;
    }

    /**
     * Send confirmation email
     */
    private function sendConfirmationEmail($peserta)
    {
        // TODO: Implement email sending
        // Mail::to($peserta->email)->send(new RegistrationConfirmation($peserta));
    }
}
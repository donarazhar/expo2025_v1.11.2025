<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ForgotIdController extends Controller
{
    /**
     * Show forgot ID form
     */
    public function show()
    {
        return view('portal.auth.forgot-id');
    }

    /**
     * Search peserta by email
     */
    public function search(Request $request)
    {
        // Rate limiting - max 5 attempts per minute per IP
        $key = 'forgot-id:'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik.",
            ]);
        }

        RateLimiter::hit($key, 60); // 60 seconds decay

        // Validate
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
        ]);

        // Search peserta
        $peserta = Peserta::where('email', $validated['email'])->first();

        if (! $peserta) {
            return back()
                ->withInput()
                ->with('error', 'Email tidak ditemukan dalam sistem. Pastikan Anda sudah terdaftar sebagai peserta.');
        }

        // Log activity (optional)
        activity('forgot-id')
            ->causedBy($peserta)
            ->withProperties([
                'email' => $peserta->email,
                'ip' => $request->ip(),
            ])
            ->log("Pencarian ID oleh email: {$peserta->email}");

        // Return with peserta data
        return back()
            ->with('peserta', $peserta)
            ->with('success', 'ID Peserta ditemukan!');
    }
}

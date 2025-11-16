<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #0053C5;
        }
        .logo {
            width: 80px;
            height: 80px;
            background: #0053C5;
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        h1 {
            color: #0053C5;
            margin: 10px 0;
            font-size: 24px;
        }
        .success-badge {
            display: inline-block;
            background: #10B981;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            margin: 15px 0;
        }
        .info-box {
            background: #F0F9FF;
            border-left: 4px solid #0053C5;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #E5E7EB;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #6B7280;
        }
        .value {
            color: #111827;
            font-weight: 500;
        }
        .qr-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: #F9FAFB;
            border-radius: 10px;
        }
        .qr-code {
            max-width: 250px;
            margin: 15px auto;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .event-details {
            background: linear-gradient(135deg, #0053C5 0%, #003D91 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .event-details h3 {
            margin: 0 0 15px 0;
            font-size: 18px;
        }
        .event-item {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .event-icon {
            margin-right: 10px;
        }
        .button {
            display: inline-block;
            background: #0053C5;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            margin: 10px 5px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #E5E7EB;
            color: #6B7280;
            font-size: 14px;
        }
        .important-note {
            background: #FEF3C7;
            border-left: 4px solid #F59E0B;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">AZ</div>
            <h1>Al Azhar Expo 2025</h1>
            <div class="success-badge">✓ Pendaftaran Berhasil!</div>
        </div>

        <!-- Greeting -->
        <p>Assalamu'alaikum <strong>{{ $nama }}</strong>,</p>
        <p>Terima kasih telah mendaftar untuk mengikuti <strong>Al Azhar Expo 2025</strong>. Pendaftaran Anda telah berhasil diproses!</p>

        <!-- Registration Info -->
        <div class="info-box">
            <h3 style="margin-top: 0; color: #0053C5;">📋 Informasi Pendaftaran</h3>
            <div class="info-row">
                <span class="label">ID Peserta:</span>
                <span class="value">{{ $id_peserta }}</span>
            </div>
            <div class="info-row">
                <span class="label">Nama:</span>
                <span class="value">{{ $nama }}</span>
            </div>
            <div class="info-row">
                <span class="label">Email:</span>
                <span class="value">{{ $email }}</span>
            </div>
            <div class="info-row">
                <span class="label">No. HP:</span>
                <span class="value">{{ $no_hp }}</span>
            </div>
            <div class="info-row">
                <span class="label">Instansi:</span>
                <span class="value">{{ $instansi }}</span>
            </div>
            <div class="info-row">
                <span class="label">Tgl Registrasi:</span>
                <span class="value">{{ $tgl_registrasi }}</span>
            </div>
        </div>

        <!-- QR Code -->
        <div class="qr-section">
            <h3 style="color: #0053C5; margin-top: 0;">🎫 QR Code Anda</h3>
            <p>Simpan atau cetak QR Code ini untuk keperluan absensi di event</p>
            <div class="qr-code">
                <img src="{{ $qr_code_url }}" alt="QR Code" style="width: 100%; height: auto;">
            </div>
            <p style="font-size: 12px; color: #6B7280;">ID: {{ $id_peserta }}</p>
        </div>

        <!-- Event Details -->
        <div class="event-details">
            <h3>📅 Detail Event</h3>
            <div class="event-item">
                <span class="event-icon">📆</span>
                <span><strong>Tanggal:</strong> {{ $event_date }}</span>
            </div>
            <div class="event-item">
                <span class="event-icon">📍</span>
                <span><strong>Lokasi:</strong> {{ $event_location }}</span>
            </div>
            <div class="event-item">
                <span class="event-icon">⏰</span>
                <span><strong>Waktu:</strong> 08.00 - 16.00 WIB</span>
            </div>
        </div>

        <!-- Important Note -->
        <div class="important-note">
            <strong>⚠️ Catatan Penting:</strong>
            <ul style="margin: 10px 0; padding-left: 20px;">
                <li>Harap bawa QR Code ini (cetak atau tampilkan di HP)</li>
                <li>Datang tepat waktu untuk mendapatkan pengalaman terbaik</li>
                <li>E-Sertifikat akan dikirim setelah mengikuti event</li>
                <li>Untuk informasi lebih lanjut, kunjungi website kami</li>
            </ul>
        </div>

        <!-- CTA Buttons -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $qr_code_url }}" class="button" download style="background: #10B981;">
                ⬇️ Download QR Code
            </a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Al Azhar Expo 2025</strong></p>
            <p>Yayasan Pesantren Islam Al Azhar<br>
            Masjid Agung Al Azhar Jakarta</p>
            <p style="margin-top: 15px;">
                Email ini dikirim otomatis. Mohon tidak membalas email ini.<br>
                Untuk pertanyaan, hubungi: <a href="mailto:info@alazharexpo.com" style="color: #0053C5;">info@alazharexpo.com</a>
            </p>
            <p style="margin-top: 15px; font-size: 12px;">
                © 2025 Al Azhar Expo. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
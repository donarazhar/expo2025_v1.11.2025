<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sertifikat - {{ $nama_peserta }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .certificate-container {
            width: 297mm;
            height: 210mm;
            background: white;
            position: relative;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        /* Border Design */
        .border-design {
            position: absolute;
            inset: 15mm;
            border: 3px solid #0053C5;
            border-radius: 10px;
        }
        
        .border-design::before {
            content: '';
            position: absolute;
            inset: 5px;
            border: 1px solid #C5A572;
        }
        
        /* Header */
        .certificate-header {
            text-align: center;
            padding-top: 25mm;
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
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .event-title {
            font-size: 28px;
            color: #0053C5;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .certificate-title {
            font-size: 48px;
            color: #C5A572;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 15px 0;
        }
        
        /* Content */
        .certificate-content {
            text-align: center;
            padding: 0 60mm;
            margin-top: 20px;
        }
        
        .intro-text {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }
        
        .recipient-name {
            font-size: 36px;
            color: #0053C5;
            font-weight: bold;
            text-decoration: underline;
            text-decoration-color: #C5A572;
            text-decoration-thickness: 2px;
            text-underline-offset: 8px;
            margin: 20px 0;
        }
        
        .description {
            font-size: 14px;
            color: #555;
            line-height: 1.8;
            margin: 20px 0;
        }
        
        /* Footer Info */
        .certificate-footer {
            position: absolute;
            bottom: 20mm;
            width: 100%;
            padding: 0 30mm;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            align-items: end;
        }
        
        .certificate-number {
            text-align: left;
        }
        
        .qr-section {
            text-align: center;
        }
        
        .qr-code {
            width: 80px;
            height: 80px;
            border: 2px solid #0053C5;
            padding: 5px;
            background: white;
            display: inline-block;
        }
        
        .qr-code img {
            width: 100%;
            height: 100%;
        }
        
        .signature-section {
            text-align: right;
        }
        
        .signature-line {
            border-top: 2px solid #333;
            margin-top: 40px;
            padding-top: 10px;
            display: inline-block;
            min-width: 150px;
        }
        
        .label {
            font-size: 11px;
            color: #666;
            font-weight: normal;
        }
        
        .value {
            font-size: 13px;
            color: #333;
            font-weight: 600;
        }
        
        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120px;
            color: rgba(0, 83, 197, 0.03);
            font-weight: bold;
            pointer-events: none;
            z-index: 0;
        }
        
        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .certificate-container {
                box-shadow: none;
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <!-- Watermark -->
        <div class="watermark">AL AZHAR</div>
        
        <!-- Border -->
        <div class="border-design"></div>
        
        <!-- Header -->
        <div class="certificate-header">
            <div class="logo">AZ</div>
            <div class="event-title">AL AZHAR EXPO 2025</div>
            <div class="certificate-title">Sertifikat</div>
        </div>
        
        <!-- Content -->
        <div class="certificate-content">
            <p class="intro-text">Diberikan kepada:</p>
            
            <h2 class="recipient-name">{{ $nama_peserta }}</h2>
            
            <p class="description">
                Atas partisipasinya dalam mengikuti <strong>Al Azhar Expo 2025</strong> yang diselenggarakan pada tanggal <strong>4-6 Desember 2025</strong> di Masjid Agung Al Azhar Jakarta dengan tema <em>"Sinergi Pendidikan, Dakwah, dan Sosial: Beradab dalam Kemodernan, Siap Menjawab Tantangan Masa Depan"</em>.
            </p>
        </div>
        
        <!-- Footer -->
        <div class="certificate-footer">
            <div class="footer-content">
                <!-- Certificate Number -->
                <div class="certificate-number">
                    <div class="label">Nomor Sertifikat</div>
                    <div class="value">{{ $nomor_sertifikat }}</div>
                    <div class="label" style="margin-top: 10px;">Tanggal Terbit</div>
                    <div class="value">{{ $tanggal_terbit }}</div>
                </div>
                
                <!-- QR Code -->
                <div class="qr-section">
                    <div class="qr-code">
                        <img src="{{ $qr_code_url }}" alt="QR Verification">
                    </div>
                    <div class="label" style="margin-top: 5px;">Scan untuk verifikasi</div>
                </div>
                
                <!-- Signature -->
                <div class="signature-section">
                    <div style="margin-bottom: 50px;">
                        <div class="label">Jakarta, {{ $tanggal_terbit }}</div>
                    </div>
                    <div class="signature-line">
                        <div class="value">Ketua Panitia</div>
                        <div class="label">Al Azhar Expo 2025</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sertifikat - {{ $sertifikat->peserta->nama_lengkap }}</title>
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
            width: 297mm;
            height: 210mm;
            position: relative;
            background: #ffffff;
        }

        .container {
            width: 100%;
            height: 100%;
            padding: 20px;
            position: relative;
        }

        .content {
            width: 100%;
            height: 100%;
            border: 4px solid #0053C5;
            padding: 30px 50px;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        /* Certificate Number - Top Right */
        .certificate-number {
            position: absolute;
            top: 40px;
            right: 60px;
            font-size: 14px;
            color: #666;
        }

        /* Logo - Top Left */
        .logo {
            position: absolute;
            top: 40px;
            left: 60px;
            width: 135px;
            height: 135px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            margin-top: 20px;
        }

        .header-text {
            text-align: center;
        }

        .title {
            font-size: 52px;
            font-weight: bold;
            color: #0053C5;
            letter-spacing: 8px;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 26px;
            color: #555;
            letter-spacing: 2px;
        }

        .body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 10px 0;
        }

        .awarded {
            font-size: 20px;
            color: #333;
            margin-bottom: 25px;
        }

        .name {
            font-size: 46px;
            font-weight: bold;
            color: #000;
            margin: 15px 0 35px 0;
            border-bottom: 3px solid #000;
            padding-bottom: 12px;
            min-width: 550px;
            display: inline-block;
        }

        .description {
            font-size: 17px;
            color: #333;
            line-height: 1.9;
            max-width: 750px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 0 60px;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .signature {
            text-align: center;
            width: 280px;
        }

        .signature-line {
            width: 100%;
            border-top: 2px solid #333;
            margin-bottom: 12px;
        }

        .signature-name {
            font-weight: bold;
            font-size: 17px;
            color: #0053C5;
            margin-bottom: 3px;
        }

        .signature-title {
            font-size: 15px;
            color: #333;
        }

        .qr-code {
            position: absolute;
            bottom: 40px;
            left: 60px;
            width: 90px;
            height: 90px;
            border: 2px solid #ddd;
            padding: 5px;
            background: white;
        }

        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">

            <!-- Certificate Number - Top Right -->
            <div class="certificate-number">
                No: {{ $sertifikat->nomor_sertifikat }}
            </div>

            <!-- Logo - Top Left -->
            <div class="logo">
                <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo Al Azhar">
            </div>

            <!-- Header -->
            <div class="header">
                <div class="header-text">
                    <div class="title">SERTIFIKAT</div>
                    <div class="subtitle">AL AZHAR EXPO 2025</div>
                </div>
            </div>

            <!-- Body -->
            <div class="body">
                <div class="awarded">Diberikan kepada :</div>

                <div class="name">{{ strtoupper($sertifikat->peserta->nama_lengkap) }}</div>

                <div class="description">
                    Telah mengikuti dan menyelesaikan kegiatan<br>
                    Al Azhar Expo 2025<br>
                    "Al Azhar Inspirasi Bangsa"<br>
                    yang diselenggarakan pada 18-19 Desember 2025<br>
                    di Masjid Agung Al Azhar, Jakarta
                </div>
            </div>

            <!-- Footer Signatures -->
            <div class="footer">
                <div class="signature">
                    <div class="signature-line"></div>
                    <div class="signature-name">KETUA PANITIA</div>
                    <div class="signature-title">Al Azhar Expo 2025</div>
                </div>

                <div class="signature">
                    <div class="signature-line"></div>
                    <div class="signature-name">KETUA YPI AL AZHAR</div>
                    <div class="signature-title">Jakarta</div>
                </div>
            </div>

            <!-- QR Code - Generate On-The-Fly -->
            @php
                try {
                    $qrCodeImage = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
                        ->size(300)
                        ->errorCorrection('H')
                        ->generate($sertifikat->verification_url);
                    $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCodeImage);
                } catch (\Exception $e) {
                    $qrCodeBase64 = null;
                    \Log::error('Failed to generate QR Code for PDF: ' . $e->getMessage());
                }
            @endphp

            @if ($qrCodeBase64)
                <div class="qr-code">
                    <img src="{{ $qrCodeBase64 }}" alt="QR Code">
                </div>
            @endif

        </div>
    </div>
</body>

</html>

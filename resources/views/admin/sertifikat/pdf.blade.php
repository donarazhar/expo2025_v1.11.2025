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
            font-family: 'Times New Roman', serif;
            width: 297mm;
            height: 210mm;
            position: relative;
            background: linear-gradient(135deg, #0053C5 0%, #003D91 100%);
        }
        
        .container {
            width: 100%;
            height: 100%;
            padding: 40px;
            position: relative;
        }
        
        .border {
            border: 8px solid #fff;
            padding: 30px;
            height: 100%;
            position: relative;
        }
        
        .inner-border {
            border: 2px solid #fff;
            padding: 40px;
            height: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0053C5;
            font-size: 36px;
            font-weight: bold;
        }
        
        .title {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
            letter-spacing: 4px;
        }
        
        .subtitle {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.9;
        }
        
        .awarded {
            font-size: 18px;
            margin-bottom: 20px;
        }
        
        .name {
            font-size: 42px;
            font-weight: bold;
            margin: 20px 0;
            border-bottom: 2px solid white;
            padding-bottom: 10px;
            display: inline-block;
            min-width: 500px;
        }
        
        .description {
            font-size: 16px;
            margin: 30px auto;
            max-width: 700px;
            line-height: 1.8;
        }
        
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            padding: 0 100px;
        }
        
        .signature {
            text-align: center;
        }
        
        .signature-line {
            width: 200px;
            border-top: 2px solid white;
            margin: 60px auto 10px;
        }
        
        .signature-name {
            font-weight: bold;
            font-size: 16px;
        }
        
        .signature-title {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .certificate-number {
            position: absolute;
            bottom: 20px;
            right: 40px;
            font-size: 12px;
            opacity: 0.8;
        }
        
        .qr-code {
            position: absolute;
            bottom: 20px;
            left: 40px;
            width: 80px;
            height: 80px;
            background: white;
            padding: 5px;
            border-radius: 8px;
        }
        
        .qr-code img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="border">
            <div class="inner-border">
                
                <div class="logo">AZ</div>
                
                <div class="title">SERTIFIKAT</div>
                <div class="subtitle">Al Azhar Expo 2025</div>
                
                <div class="awarded">Diberikan Kepada:</div>
                
                <div class="name">{{ strtoupper($sertifikat->peserta->nama_lengkap) }}</div>
                
                <div class="description">
                    Telah mengikuti dan menyelesaikan kegiatan<br>
                    <strong>Al Azhar Expo 2025</strong><br>
                    "Al Azhar Inspirasi Bangsa"<br>
                    yang diselenggarakan pada 4-6 Desember 2025<br>
                    di Masjid Agung Al Azhar, Jakarta
                </div>
                
                <div class="footer">
                    <div class="signature">
                        <div class="signature-line"></div>
                        <div class="signature-name">Ketua Panitia</div>
                        <div class="signature-title">Al Azhar Expo 2025</div>
                    </div>
                    
                    <div class="signature">
                        <div class="signature-line"></div>
                        <div class="signature-name">Ketua YPI Al Azhar</div>
                        <div class="signature-title">Jakarta</div>
                    </div>
                </div>
                
                @if($sertifikat->qr_code)
                <div class="qr-code">
                    <img src="{{ public_path('storage/' . $sertifikat->qr_code) }}" alt="QR Code">
                </div>
                @endif
                
                <div class="certificate-number">
                    No: {{ $sertifikat->nomor_sertifikat }}
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
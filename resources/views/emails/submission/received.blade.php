<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Diterima</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; line-height: 1.6; color: #374151; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .header { background-image: linear-gradient(to right, #047857, #059669); padding: 32px 24px; text-align: center; }
        .logo { width: 80px; height: auto; margin-bottom: 16px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); }
        .title { color: #ffffff; font-size: 24px; font-weight: 800; margin: 0; letter-spacing: 0.5px; text-align: center; }
        .content { padding: 40px 32px; }
        .greeting { font-size: 18px; margin-bottom: 24px; }
        .message { margin-bottom: 32px; color: #4b5563; }
        .tracking-box { background-color: #ecfdf5; border: 2px dashed #10b981; border-radius: 12px; padding: 24px; text-align: center; margin-bottom: 32px; }
        .tracking-label { display: block; text-transform: uppercase; letter-spacing: 1px; font-size: 12px; color: #047857; margin-bottom: 8px; font-weight: 600; }
        .tracking-code { display: block; font-family: 'Courier New', Courier, monospace; font-size: 32px; font-weight: 700; color: #065f46; letter-spacing: 2px; }
        .btn-container { text-align: center; margin-bottom: 32px; }
        .btn { display: inline-block; background-color: #059669; color: #ffffff; padding: 14px 32px; text-decoration: none; border-radius: 50px; font-weight: 600; box-shadow: 0 4px 6px -1px rgba(5, 150, 105, 0.4); transition: background-color 0.3s; }
        .btn:hover { background-color: #047857; }
        .footer { background-color: #f9fafb; padding: 24px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; }
        .footer-logo { height: 30px; margin-bottom: 12px; opacity: 0.7; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Kementerian_Agama_new_logo.png" alt="Logo Kemenag" class="logo">
            <h1 class="title">Permohonan Diterima</h1>
        </div>
        <div class="content">
            <p class="greeting">Halo, <strong>{{ $submission->content['nama'] }}</strong></p>
            <p class="message">
                Terima kasih telah mengajukan layanan <strong>{{ $submission->service->name }}</strong>. 
                Berkas permohonan Anda telah kami terima pada <strong>{{ $submission->created_at->format('d M Y, H:i') }}</strong> dan saat ini sedang dalam antrean verifikasi petugas.
            </p>
            
            <div class="tracking-box">
                <span class="tracking-label">KODE TRACKING ANDA</span>
                <span class="tracking-code">{{ $submission->tracking_code }}</span>
                <p style="font-size: 13px; color: #6b7280; margin-top: 8px; margin-bottom: 0;">Gunakan kode ini untuk mengecek status secara berkala</p>
            </div>

            <p class="message" style="text-align: center; font-size: 14px;">
                Anda dapat memantau progres permohonan Anda kapan saja melalui halaman Tracking Layanan kami.
            </p>

            <div class="btn-container">
                <a href="{{ route('tracking') }}" class="btn">Cek Status Permohonan</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Kementerian Agama RI.<br>Seluruh Hak Cipta Dilindungi.</p>
        </div>
    </div>
</body>
</html>

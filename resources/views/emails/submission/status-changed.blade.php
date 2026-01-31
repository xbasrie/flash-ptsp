<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Permohonan</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; line-height: 1.6; color: #374151; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .header { background-image: linear-gradient(to right, #047857, #059669); padding: 32px 24px; text-align: center; }
        .logo { width: 80px; height: auto; margin-bottom: 16px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); }
        .title { color: #ffffff; font-size: 24px; font-weight: 800; margin: 0; letter-spacing: 0.5px; text-align: center; }
        .content { padding: 40px 32px; }
        .greeting { font-size: 18px; margin-bottom: 24px; }
        .message { margin-bottom: 24px; color: #4b5563; }
        
        .status-badge { display: inline-block; padding: 8px 16px; border-radius: 99px; font-weight: 700; font-size: 14px; text-transform: uppercase; margin-bottom: 24px; letter-spacing: 1px; }
        .status-approved { background-color: #ecfdf5; color: #047857; border: 1px solid #10b981; }
        .status-rejected { background-color: #fef2f2; color: #b91c1c; border: 1px solid #ef4444; }
        .status-process { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #3b82f6; }
        .status-pending { background-color: #fffbeb; color: #b45309; border: 1px solid #f59e0b; }
        .status-header { font-size: 16px; font-weight: 600; color: #1f2937; margin-bottom: 8px; }

        .note-box { background-color: #f9fafb; border-left: 4px solid #9ca3af; padding: 16px; margin-bottom: 32px; border-radius: 4px; }
        .note-label { font-size: 12px; color: #6b7280; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 4px; }
        .note-content { font-style: italic; color: #374151; }

        .btn-container { text-align: center; margin-bottom: 32px; }
        .btn { display: inline-block; background-color: #059669; color: #ffffff; padding: 14px 32px; text-decoration: none; border-radius: 50px; font-weight: 600; box-shadow: 0 4px 6px -1px rgba(5, 150, 105, 0.4); transition: background-color 0.3s; }
        .btn:hover { background-color: #047857; }
        .footer { background-color: #f9fafb; padding: 24px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/images/logo/kemenag-logo.webp') }}" alt="Logo Kemenag" class="logo">
            <h1 class="title">Status Diperbarui</h1>
        </div>
        <div class="content">
            <p class="greeting">Halo, <strong>{{ $submission->content['nama'] }}</strong></p>
            <p class="message">
                Status permohonan <strong>{{ $submission->service->name }}</strong> Anda dengan kode tracking <strong style="font-family: monospace;">#{{ $submission->tracking_code }}</strong> telah diperbarui.
            </p>
            
            <div style="text-align: center; margin: 32px 0;">
                @php
                    $statusLabel = match($submission->status) {
                        'approved' => 'SELESAI',
                        'rejected' => 'DITOLAK',
                        'process' => 'PROSES',
                        'pending' => 'MENUNGGU',
                        default => strtoupper($submission->status),
                    };

                    $statusClass = match($submission->status) {
                        'approved' => 'status-approved',
                        'rejected' => 'status-rejected',
                        'process' => 'status-process',
                        'pending' => 'status-pending',
                        default => 'status-pending',
                    };
                @endphp
                <span class="status-badge {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>
            </div>

            @if ($submission->admin_note)
            <div class="note-box" style="border-left-color: {{ $submission->status === 'approved' ? '#10b981' : ($submission->status === 'rejected' ? '#ef4444' : '#3b82f6') }};">
                <span class="note-label">Catatan Admin:</span>
                <p class="note-content">"{!! preg_replace('/(https?:\/\/[^\s]+)/', '<a href="$1" target="_blank" style="color: #2563eb; text-decoration: underline;">$1</a>', e($submission->admin_note)) !!}"</p>
            </div>
            @endif

            <p class="message">
                Anda dapat melihat detail lengkap perjalanan permohonan Anda dengan mengklik tombol di bawah ini.
            </p>

            <div class="btn-container">
                <a href="{{ route('tracking') }}" class="btn">Lihat Detail Permohonan</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Kementerian Agama RI.<br>Seluruh Hak Cipta Dilindungi.</p>
        </div>
    </div>
</body>
</html>

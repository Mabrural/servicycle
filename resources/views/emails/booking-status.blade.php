<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $subjectLine }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 20px;
            color: #333;
        }

        .email-card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .header {
            text-align: center;
            color: #0d6efd;
            font-size: 20px;
            font-weight: bold;
        }

        .content {
            margin-top: 15px;
            line-height: 1.6;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="email-card">
        <div class="header">{{ $subjectLine }}</div>
        <div class="content">
            <p>Halo {{ $booking->creator->name }},</p>
            <p>{{ $messageContent }}</p>
            <p><strong>Status sekarang:</strong> {{ ucfirst($booking->status) }}</p>
            <p>Kode Booking: <strong>#{{ $booking->id }}</strong></p>
        </div>
        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
    </div>
</body>

</html>

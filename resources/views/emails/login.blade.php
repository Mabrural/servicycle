<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f6f9fc;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }
        h2 {
            color: #2b2b2b;
            font-weight: 600;
        }
        p {
            color: #4a4a4a;
            line-height: 1.6;
        }
        .warning {
            background: #fff4e5;
            color: #b45309;
            padding: 10px 15px;
            border-radius: 6px;
            margin: 15px 0;
            border-left: 4px solid #f59e0b;
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            background-color: #2563eb;
            color: #ffffff !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
        }
        .footer {
            font-size: 13px;
            color: #888;
            text-align: center;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Halo, {{ e($user->name) }} 👋</h2>

        <p>
            Kami ingin memberi tahu bahwa akun Anda baru saja melakukan aktivitas login ke
            <strong>{{ config('app.name') }}</strong> pada:
        </p>

        <div class="warning">
            📅 <strong>{{ now()->format('d M Y, H:i') }} WIB</strong>
        </div>

        <p>
            Jika ini <strong>bukan Anda</strong>, segera amankan akun Anda dengan mengganti password atau
            hubungi tim dukungan kami.
        </p>

        <a href="{{ config('app.url') }}/forgot-password" class="btn">Amankan Akun</a>

        <p style="margin-top: 25px;">Terima kasih telah menggunakan layanan kami 🙏</p>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Semua hak dilindungi.
        </div>
    </div>
</body>
</html>

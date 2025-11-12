<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Bengkel Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #fff;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        h2 { color: #0d6efd; }
        .info {
            background-color: #f8f9fa;
            border: 1px solid #e1e1e1;
            border-radius: 6px;
            padding: 10px 15px;
            margin-top: 15px;
        }
        .btn {
            display: inline-block;
            margin: 15px 0;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            background-color: #0d6efd;
        }
        .footer {
            margin-top: 20px;
            font-size: 13px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Bengkel Baru Menunggu Verifikasi</h2>

    <p>Halo Admin,</p>
    <p>Ada bengkel baru yang memerlukan verifikasi:</p>

    <div class="info">
        <p><strong>Nama Bengkel:</strong> {{ $workshop->name }}</p>
        <p><strong>Alamat:</strong> {{ $workshop->address }}</p>
        <p><strong>Kota:</strong> {{ $workshop->city }}</p>
        <p><strong>Pemilik:</strong> {{ $workshop->creator->name ?? '-' }}</p>
        <p><strong>Email Pemilik:</strong> {{ $workshop->creator->email ?? '-' }}</p>
    </div>

    <p>Silakan klik tombol di bawah ini untuk membuka halaman verifikasi:</p>
    <a href="{{ $verifyUrl }}" class="btn">Lihat dan Verifikasi</a>

    <p class="footer">Email ini dikirim otomatis oleh sistem ServiCycle.</p>
</div>
</body>
</html>

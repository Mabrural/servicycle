<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Verifikasi Bengkel</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f6f9fc;
            color: #333;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.06);
        }

        .email-header {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }

        .email-header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .email-body {
            padding: 30px 25px;
            line-height: 1.6;
        }

        .email-body h2 {
            font-size: 20px;
            color: #111827;
        }

        .email-body p {
            font-size: 15px;
            color: #374151;
            margin: 10px 0;
        }

        .email-body strong {
            color: #111827;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            color: #fff;
            margin-top: 20px;
        }

        .btn-approve {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .btn-reject {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .footer {
            background-color: #f3f4f6;
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #6b7280;
        }

        .footer a {
            color: #2563eb;
            text-decoration: none;
        }

        h1 {
            color: white;
        }

        @media (max-width: 600px) {
            .email-body {
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="email-header">
            <h1>{{ $status === 'approved' ? 'Bengkel Anda Disetujui!' : 'Pengajuan Bengkel Ditolak' }}</h1>
        </div>

        <div class="email-body">
            @if ($status === 'approved')
                <h2>Selamat, {{ $workshop->name }}!</h2>
                <p>
                    Bengkel Anda telah <strong>disetujui</strong> oleh tim ServiCycle 🎉<br>
                    Sekarang Anda dapat mulai menerima pemesanan servis dari para pengguna aplikasi.
                </p>

                <p>
                    Silakan klik tombol di bawah untuk masuk ke akun Anda:
                </p>

                <a href="{{ url('/') }}" class="btn btn-approve">Masuk ke ServiCycle</a>

                <p style="margin-top: 25px;">
                    Terima kasih telah bergabung bersama kami.<br>
                    Salam hangat, <br>
                    <strong>Tim ServiCycle</strong>
                </p>
            @else
                <h2>Halo, {{ $workshop->name }}</h2>
                <p>
                    Kami mohon maaf, pengajuan bengkel Anda telah <strong>ditolak</strong> pada proses verifikasi.
                </p>

                <p>
                    Kemungkinan karena data tidak lengkap, atau foto bengkel belum sesuai dengan ketentuan.
                    Silakan periksa kembali data Anda dan lakukan pendaftaran ulang bila perlu.
                </p>

                <a href="{{ url('/') }}" class="btn btn-reject">Perbarui Data Bengkel</a>

                <p style="margin-top: 25px;">
                    Terima kasih atas pengertiannya.<br>
                    Salam, <br>
                    <strong>Tim ServiCycle</strong>
                </p>
            @endif
        </div>

        <div class="footer">
            © {{ date('Y') }} ServiCycle. Semua hak dilindungi.<br>
            <a href="{{ url('/') }}">Kunjungi Situs</a> |
            <a href="{{ url('/privacy-policy') }}">Kebijakan Privasi</a>
        </div>
    </div>

</body>

</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Servis Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .btn-primary {
            display: inline-block;
            background-color: #0d6efd;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 15px;
            margin-top: 20px;
        }
        .text-white{
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2>Halo, {{ $booking->workshop->name ?? 'Bengkel' }} 👋</h2>
    <p>Ada booking servis baru dari pelanggan <strong>{{ $booking->creator->name }}</strong>.</p>

    <ul>
        <li><strong>Kendaraan:</strong> {{ $booking->vehicle->license_plate ?? '-' }} / {{ $booking->vehicle->brand }} / {{ $booking->vehicle->model }} / {{ $booking->vehicle->year }}</li>
        <li><strong>Tanggal Booking:</strong> {{ $booking->booking_date->format('d M Y H:i') }}</li>
        <li><strong>Status Saat Ini:</strong> {{ ucfirst(str_replace('_', ' ', $booking->status)) }}</li>
        @if ($booking->notes)
            <li><strong>Catatan:</strong> {{ $booking->notes }}</li>
        @endif
    </ul>

    <div class="info-box">
        <p>Klik tombol di bawah untuk membuka halaman konfirmasi booking:</p>
        <a href="{{ route('booking.verify', ['id' => $booking->id]) }}" class="btn-primary text-white">
            Lihat & Konfirmasi Booking
        </a>
    </div>

    <p>Anda juga dapat melihat detail lengkap di dashboard bengkel Anda.</p>
    <p>Terima kasih 🙏</p>
</body>
</html>

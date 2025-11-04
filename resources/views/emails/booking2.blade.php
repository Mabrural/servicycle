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

        .btn {
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-success {
            background-color: #198754;
            color: #fff;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .d-inline {
            display: inline-block;
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <h2>Halo, {{ $booking->workshop->name ?? 'Bengkel' }} 👋</h2>
    <p>Ada booking servis baru dari pelanggan <strong>{{ $booking->creator->name }}</strong>.</p>

    <ul>
        <li><strong>Kendaraan:</strong> {{ $booking->vehicle->license_plate ?? '-' }} / {{ $booking->vehicle->brand }} /
            {{ $booking->vehicle->model }} / {{ $booking->vehicle->year }}</li>
        <li><strong>Tanggal Booking:</strong> {{ $booking->booking_date->format('d M Y H:i') }}</li>
        <li><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $booking->status)) }}</li>
        @if ($booking->notes)
            <li><strong>Catatan:</strong> {{ $booking->notes }}</li>
        @endif
    </ul>

    <p>Silakan pilih tindakan untuk booking ini:</p>

    <div style="margin: 20px 0;">
        <a href="{{ route('booking.updateStatus.email', ['id' => $booking->id, 'status' => 'diterima']) }}"
            style="background-color:#198754;color:#fff;padding:10px 20px;text-decoration:none;border-radius:5px; margin: 5px;">
            Terima
        </a>

        <a href="{{ route('booking.updateStatus.email', ['id' => $booking->id, 'status' => 'ditolak']) }}"
            style="background-color:#dc3545;color:#fff;padding:10px 20px;text-decoration:none;border-radius:5px; margin: 5px;">
            Tolak
        </a>

    </div>

    <p>Anda juga dapat melihat detail lengkap di dashboard bengkel Anda.</p>
    <p>Terima kasih 🙏</p>
</body>

</html>

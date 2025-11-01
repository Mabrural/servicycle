<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Servis Baru</title>
</head>
<body>
    <h2>Halo, {{ $booking->workshop->name ?? 'Bengkel' }} 👋</h2>
    <p>Ada booking servis baru dari pelanggan <strong>{{ $booking->creator->name }}</strong>.</p>

    <ul>
        <li><strong>Kendaraan:</strong> {{ $booking->vehicle->plate_number ?? '-' }}</li>
        <li><strong>Tanggal Booking:</strong> {{ $booking->booking_date->format('d M Y H:i') }}</li>
        <li><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $booking->status)) }}</li>
        @if ($booking->notes)
            <li><strong>Catatan:</strong> {{ $booking->notes }}</li>
        @endif
    </ul>

    <p>Silakan cek dashboard bengkel Anda untuk detail lebih lanjut.</p>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Booking Servis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 40px;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #0d6efd;
            margin-bottom: 20px;
        }

        ul {
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            font-weight: bold;
            color: #fff;
        }

        .btn-success { background-color: #198754; }
        .btn-danger { background-color: #dc3545; }

        .btn.disabled {
            opacity: 0.6;
            pointer-events: none;
            cursor: not-allowed;
        }

        .status-box {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
        }

        .status-accepted { background: #d1e7dd; color: #0f5132; }
        .status-rejected { background: #f8d7da; color: #842029; }
        .status-pending { background: #fff3cd; color: #664d03; }
    </style>
</head>
<body>
<div class="container">
    <h2>Konfirmasi Booking Servis</h2>

    <p><strong>Pelanggan:</strong> {{ $booking->creator->name }}</p>
    <p><strong>Kendaraan:</strong> {{ $booking->vehicle->license_plate ?? '-' }} / {{ $booking->vehicle->brand }} / {{ $booking->vehicle->model }}</p>
    <p><strong>Tanggal Booking:</strong> {{ $booking->booking_date->format('d M Y H:i') }}</p>

    <div class="status-box status-{{ $booking->status }}">
        <strong>Status Saat Ini:</strong> {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
    </div>

    <div style="margin-top: 30px;">
        @if ($booking->status === 'menunggu_konfirmasi')
            <a href="{{ route('booking.updateStatus.email', ['id' => $booking->id, 'status' => 'diterima']) }}" class="btn btn-success">Terima</a>
            <a href="{{ route('booking.updateStatus.email', ['id' => $booking->id, 'status' => 'ditolak']) }}" class="btn btn-danger">Tolak</a>
        @else
            <p style="font-weight: bold; color: #666; margin-top: 20px;">
                Anda sudah pernah {{ $booking->status === 'diterima' ? 'menerima' : 'menolak' }} servis ini.
            </p>
            <div>
                <a href="#" class="btn btn-success disabled">Terima</a>
                <a href="#" class="btn btn-danger disabled">Tolak</a>
            </div>
        @endif
    </div>
</div>
</body>
</html>

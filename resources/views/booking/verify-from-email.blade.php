<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking Servis</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-light: #dbeafe;
            --success-color: #10b981;
            --success-light: #d1fae5;
            --danger-color: #ef4444;
            --danger-light: #fee2e2;
            --warning-color: #f59e0b;
            --warning-light: #fef3c7;
            --text-color: #1f2937;
            --text-light: #6b7280;
            --bg-color: #f9fafb;
            --white: #ffffff;
            --border-radius: 12px;
            --border-radius-sm: 8px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --box-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 1.5rem;
            --spacing-lg: 2rem;
            --spacing-xl: 3rem;
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: var(--spacing-md);
            line-height: 1.6;
            font-size: 1rem;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: var(--white);
            padding: var(--spacing-lg);
            border-radius: var(--border-radius);
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
            box-shadow: var(--box-shadow-lg);
            transition: var(--transition);
        }

        .header {
            text-align: center;
            margin-bottom: var(--spacing-lg);
            position: relative;
            padding-bottom: var(--spacing-sm);
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--success-color));
            border-radius: 3px;
        }

        h2 {
            color: var(--primary-color);
            margin-bottom: var(--spacing-sm);
            font-size: 1.75rem;
            font-weight: 700;
        }

        .subtitle {
            color: var(--text-light);
            font-size: 1rem;
        }

        .info-card {
            background: var(--primary-light);
            border-radius: var(--border-radius-sm);
            padding: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
            border-left: 4px solid var(--primary-color);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: var(--spacing-sm);
            padding-bottom: var(--spacing-sm);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: var(--text-color);
            flex: 1;
        }

        .info-value {
            color: var(--text-color);
            flex: 1;
            text-align: right;
        }

        .status-box {
            margin: var(--spacing-lg) 0;
            padding: var(--spacing-md);
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-sm);
        }

        .status-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .status-accepted {
            background: var(--success-light);
            color: #065f46;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-rejected {
            background: var(--danger-light);
            color: #991b1b;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .status-pending {
            background: var(--warning-light);
            color: #92400e;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .status-accepted .status-icon {
            background: var(--success-color);
            color: white;
        }

        .status-rejected .status-icon {
            background: var(--danger-color);
            color: white;
        }

        .status-pending .status-icon {
            background: var(--warning-color);
            color: white;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-sm);
            margin-top: var(--spacing-lg);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 1.5rem;
            text-decoration: none;
            border-radius: var(--border-radius-sm);
            margin-right: 0;
            margin-bottom: 0;
            font-weight: 600;
            color: var(--white);
            text-align: center;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-success {
            background-color: var(--success-color);
        }

        .btn-danger {
            background-color: var(--danger-color);
        }

        .btn.disabled {
            opacity: 0.5;
            pointer-events: none;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .action-message {
            text-align: center;
            padding: var(--spacing-md);
            background: #f8f9fa;
            border-radius: var(--border-radius-sm);
            margin-top: var(--spacing-lg);
            color: var(--text-light);
            font-weight: 500;
        }

        /* Desktop styles */
        @media (min-width: 768px) {
            body {
                padding: var(--spacing-xl);
            }

            .container {
                padding: var(--spacing-xl);
            }

            h2 {
                font-size: 2rem;
            }

            .button-group {
                flex-direction: row;
            }

            .btn {
                width: auto;
                flex: 1;
            }

            .info-row {
                flex-direction: row;
            }
        }

        /* Small mobile devices */
        @media (max-width: 360px) {
            body {
                padding: var(--spacing-sm);
                font-size: 0.9rem;
            }

            .container {
                padding: var(--spacing-md);
            }

            h2 {
                font-size: 1.5rem;
            }

            .btn {
                padding: 0.75rem 1.25rem;
                font-size: 0.9rem;
            }

            .info-row {
                flex-direction: column;
                gap: 0.25rem;
            }

            .info-value {
                text-align: left;
            }
        }

        /* Animation for status box */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .status-box,
        .info-card,
        .button-group {
            animation: fadeIn 0.5s ease-out;
        }

        /* Loading state for buttons */
        .btn.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn.loading::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Konfirmasi Booking Servis</h2>
            <p class="subtitle">Silakan tinjau detail booking di bawah ini</p>
        </div>

        <div class="info-card">
            <div class="info-row">
                <span class="info-label">Pelanggan:</span>
                <span class="info-value">{{ $booking->creator->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kendaraan:</span>
                <span class="info-value">{{ $booking->vehicle->license_plate ?? '-' }} / {{ $booking->vehicle->brand }}
                    / {{ $booking->vehicle->model }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Booking:</span>
                <span class="info-value">{{ $booking->booking_date->format('d M Y H:i') }}</span>
            </div>
        </div>

        <div class="status-box status-{{ $booking->status }}">
            <div class="status-icon">
                @if ($booking->status === 'diterima')
                    ✓
                @elseif($booking->status === 'ditolak')
                    ✕
                @else
                    !
                @endif
            </div>
            <div>
                <strong>Status Saat Ini:</strong> {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
            </div>
        </div>

        @if ($booking->status === 'menunggu_konfirmasi')
            <div class="button-group">
                <a href="{{ route('booking.updateStatus.email', ['id' => $booking->id, 'status' => 'diterima']) }}"
                    class="btn btn-success" id="accept-btn">Terima Booking</a>
                <a href="{{ route('booking.updateStatus.email', ['id' => $booking->id, 'status' => 'ditolak']) }}"
                    class="btn btn-danger" id="reject-btn">Tolak Booking</a>
            </div>
        @else
            <div class="action-message">
                Anda sudah pernah {{ $booking->status === 'diterima' ? 'menerima' : 'menolak' }} servis ini.
            </div>
            <div class="button-group">
                <a href="#" class="btn btn-success disabled">Terima</a>
                <a href="#" class="btn btn-danger disabled">Tolak</a>
            </div>
        @endif
    </div>

    <script>
        // Add loading state to buttons when clicked
        document.addEventListener('DOMContentLoaded', function() {
            const acceptBtn = document.getElementById('accept-btn');
            const rejectBtn = document.getElementById('reject-btn');

            if (acceptBtn) {
                acceptBtn.addEventListener('click', function() {
                    this.classList.add('loading');
                    this.innerHTML = 'Memproses...';
                });
            }

            if (rejectBtn) {
                rejectBtn.addEventListener('click', function() {
                    this.classList.add('loading');
                    this.innerHTML = 'Memproses...';
                });
            }

            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('.btn:not(.disabled)');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Ripple effect is handled by CSS
                });
            });
        });
    </script>
</body>

</html>

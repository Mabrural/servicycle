<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Bengkel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --light: #f8f9fa;
            --dark: #212529;
            --border-radius: 12px;
            --shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .verification-card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            background: white;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }
        
        .card-header h4 {
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        
        .card-header h4 i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .info-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 2rem;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .info-table tr {
            transition: var(--transition);
        }
        
        .info-table tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }
        
        .info-table th, .info-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .info-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--dark);
            width: 35%;
            border-right: 1px solid #e9ecef;
        }
        
        .info-table tr:last-child th, 
        .info-table tr:last-child td {
            border-bottom: none;
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .btn-approve {
            background: linear-gradient(135deg, #4CAF50 0%, #8BC34A 100%);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }
        
        .btn-approve:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(76, 175, 80, 0.4);
        }
        
        .btn-reject {
            background: linear-gradient(135deg, #f44336 0%, #e91e63 100%);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
        }
        
        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(244, 67, 54, 0.4);
        }
        
        .action-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 1rem;
        }
        
        .action-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
            display: flex;
            align-items: center;
        }
        
        .action-title i {
            margin-right: 8px;
            color: var(--primary);
        }
        
        .btn-group-custom {
            display: flex;
            gap: 1rem;
        }
        
        /* Responsive styles */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }
            
            .info-table th, .info-table td {
                padding: 0.75rem 1rem;
            }
            
            .btn-group-custom {
                flex-direction: column;
            }
            
            .btn-approve, .btn-reject {
                width: 100%;
                text-align: center;
            }
        }
        
        @media (max-width: 576px) {
            body {
                padding: 10px;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .info-table {
                display: block;
                overflow-x: auto;
            }
            
            .info-table th {
                width: 40%;
            }
            
            .card-header h4 {
                font-size: 1.25rem;
            }
        }
        
        /* Animation for status badge */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .status-badge {
            animation: pulse 2s infinite;
        }
        
        /* Custom styling for specific elements */
        .workshop-name {
            font-weight: 600;
            color: var(--primary);
        }
        
        .creator-info {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .map-link {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .map-link:hover {
            color: var(--primary-light);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card verification-card">
                    <div class="card-header">
                        <h4><i class="fas fa-clipboard-check"></i> Verifikasi Bengkel</h4>
                    </div>
                    <div class="card-body">
                        <table class="info-table">
                            <tr>
                                <th>Nama Bengkel</th>
                                <td class="workshop-name">{{ $workshop->name }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $workshop->address }}</td>
                            </tr>
                            <tr>
                                <th>Kota</th>
                                <td>{{ $workshop->city }}</td>
                            </tr>
                            <tr>
                                <th>Pemilik</th>
                                <td>
                                    <span>{{ $workshop->creator->name ?? '-' }}</span>
                                    <div class="creator-info">{{ $workshop->creator->email ?? '-' }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge status-badge bg-warning text-dark">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ ucfirst($workshop->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>

                        <div class="action-section">
                            <div class="action-title">
                                <i class="fas fa-tasks"></i> Tindakan Verifikasi
                            </div>
                            <div class="btn-group-custom">
                                <form action="{{ route('workshop-verify.update', $workshop->id) }}" method="POST" class="d-inline flex-fill">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-approve w-100">
                                        <i class="fas fa-check-circle me-2"></i> Setujui Bengkel
                                    </button>
                                </form>

                                <form action="{{ route('workshop-verify.update', $workshop->id) }}" method="POST" class="d-inline flex-fill">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-reject w-100">
                                        <i class="fas fa-times-circle me-2"></i> Tolak Bengkel
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tambahkan konfirmasi sebelum menolak bengkel
        document.addEventListener('DOMContentLoaded', function() {
            const rejectButton = document.querySelector('.btn-reject');
            
            if (rejectButton) {
                rejectButton.addEventListener('click', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menolak verifikasi bengkel ini?')) {
                        e.preventDefault();
                    }
                });
            }
            
            // Tambahkan animasi pada tombol setujui
            const approveButton = document.querySelector('.btn-approve');
            
            if (approveButton) {
                approveButton.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                approveButton.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            }
        });
    </script>
</body>
</html>
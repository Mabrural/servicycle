<!DOCTYPE html>
<html lang="id" class="light-style" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Pilih Peran | ServiCycle</title>

    <meta name="description" content="Pilih peran Anda di ServiCycle - Platform manajemen servis kendaraan" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        :root {
            --primary: #696cff;
            --primary-dark: #5f61e6;
            --secondary: #8592a3;
            --success: #71dd37;
            --danger: #ff3e1d;
            --warning: #ffab00;
            --info: #03c3ec;
            --dark: #233446;
            --light: #f5f5f9;
            --gray: #d9dee3;
        }

        body {
            font-family: 'Public Sans', sans-serif;
            background-color: #f5f5f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .auth-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .auth-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .auth-header {
            text-align: center;
            padding: 30px 30px 20px;
            /* background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); */
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .auth-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }

        .auth-logo img {
            height: 50px;
            width: 50px;
            margin-right: 10px;
            border-radius: 10px;
        }

        .auth-logo-text {
            font-size: 24px;
            font-weight: 700;
            color: white;
        }

        .auth-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .auth-subtitle {
            font-size: 15px;
            opacity: 0.9;
        }

        .auth-body {
            padding: 30px;
        }

        .role-selection {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (min-width: 768px) {
            .role-selection {
                grid-template-columns: 1fr 1fr;
            }
        }

        .role-option {
            border: 2px solid var(--gray);
            border-radius: 12px;
            padding: 25px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .role-option::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: transparent;
            transition: background 0.3s ease;
        }

        .role-option:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(105, 108, 255, 0.1);
        }

        .role-option:hover::before {
            background: var(--primary);
        }

        .role-option.selected {
            border-color: var(--primary);
            background-color: rgba(105, 108, 255, 0.05);
        }

        .role-option.selected::before {
            background: var(--primary);
        }

        .role-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: var(--primary);
            transition: transform 0.3s ease;
        }

        .role-option:hover .role-icon {
            transform: scale(1.1);
        }

        .role-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .role-desc {
            font-size: 14px;
            color: var(--secondary);
            line-height: 1.5;
        }

        .role-input {
            position: absolute;
            opacity: 0;
        }

        .btn-continue {
            display: block;
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-continue:hover {
            background: var(--primary-dark);
        }

        .btn-continue:disabled {
            background: var(--gray);
            cursor: not-allowed;
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            color: var(--secondary);
            font-size: 14px;
        }

        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .auth-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            margin-top: 20px;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: var(--primary-dark);
        }

        .back-link i {
            margin-right: 8px;
        }

        /* Animation for selection */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.03);
            }

            100% {
                transform: scale(1);
            }
        }

        .role-option.selected {
            animation: pulse 0.5s ease;
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <h1 class="auth-title">Pilih Peran Anda</h1>
                    <p class="auth-subtitle">Pilih bagaimana Anda akan menggunakan ServiCycle</p>
                </div>

                <div class="auth-body">
                    <form id="roleForm" action="{{ route('set.role') }}" method="POST">

                        @csrf
                        <div class="role-selection">
                            <label class="role-option" for="role_vehicle_owner">
                                <input class="role-input" type="radio" name="role" id="role_vehicle_owner"
                                    value="vehicle_owner" required>
                                <div class="role-icon">
                                    <i class="fas fa-car"></i>
                                </div>
                                <h3 class="role-title">Pemilik Kendaraan</h3>
                                <p class="role-desc">Saya ingin mengelola servis kendaraan pribadi atau bisnis saya</p>
                            </label>

                            <label class="role-option" for="role_workshop">
                                <input class="role-input" type="radio" name="role" id="role_workshop"
                                    value="workshop">
                                <div class="role-icon">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <h3 class="role-title">Bengkel</h3>
                                <p class="role-desc">Saya pemilik atau karyawan bengkel yang ingin mengelola layanan
                                    servis</p>
                            </label>

                        </div>

                        <button type="submit" class="btn-continue" id="continueBtn" disabled>Lanjutkan</button>
                    </form>

                    <div class="auth-footer">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="back-link"
                                style="background: none; border: none; cursor: pointer; padding: 0; font: inherit;">
                                <i class="fas fa-arrow-left"></i> Kembali ke halaman masuk
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleOptions = document.querySelectorAll('.role-option');
            const continueBtn = document.getElementById('continueBtn');

            roleOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options
                    roleOptions.forEach(opt => opt.classList.remove('selected'));

                    // Add selected class to clicked option
                    this.classList.add('selected');

                    // Check the radio input inside this option
                    const radioInput = this.querySelector('input[type="radio"]');
                    radioInput.checked = true;

                    // Enable continue button
                    continueBtn.disabled = false;
                });
            });

            // Handle form submission
            const roleForm = document.getElementById('roleForm');
            roleForm.addEventListener('submit', function(e) {
                const selectedRole = document.querySelector('input[name="role"]:checked');
                if (!selectedRole) {
                    e.preventDefault();
                    alert('Silakan pilih peran terlebih dahulu');
                }
            });
        });
    </script>
</body>

</html>

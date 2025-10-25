<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ServiCycle - Kelola Servis Kendaraan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        secondary: '#6366f1',
                        accent: '#10b981',
                        dark: '#1f2937',
                        light: '#f9fafb'
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
            padding-bottom: 0px;
            /* Space for bottom nav */
        }

        .hero-bg {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .pricing-card {
            transition: all 0.3s ease;
        }

        .pricing-card:hover {
            transform: scale(1.03);
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .nav-link {
            position: relative;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #4f46e5;
            transition: width 0.3s ease;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.6);
        }

        /* Bottom Navigation Styles */
        .bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 50;
            padding: 8px 0;
        }

        .bottom-nav.active {
            display: flex;
        }

        .bottom-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 8px 4px;
            text-decoration: none;
            color: #6b7280;
            transition: all 0.3s;
            position: relative;
            cursor: pointer;
        }

        .bottom-nav-item.active {
            color: #4f46e5;
        }

        .bottom-nav-item i {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .bottom-nav-item span {
            font-size: 10px;
            font-weight: 500;
        }

        .bottom-nav-item.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background-color: #4f46e5;
            border-radius: 0 0 3px 3px;
        }

        @media (max-width: 768px) {
            .desktop-nav {
                display: none;
            }

            .header-login {
                display: none;
            }

            .bottom-nav {
                display: flex;
            }
        }

        /* Improved Responsive Design */
        @media (max-width: 640px) {
            .container-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .hero-bg h2 {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .feature-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .workshop-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .testimonial-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        @media (min-width: 641px) and (max-width: 1024px) {
            .feature-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .workshop-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .testimonial-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 30;
        }

        .overlay.active {
            display: block;
        }

        .workshop-card {
            transition: all 0.3s ease;
        }

        .workshop-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .tab-button.active {
            background-color: #4f46e5;
            color: white;
        }

        .location-permission-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 100;
            justify-content: center;
            align-items: center;
        }

        .location-permission-modal.active {
            display: flex;
        }

        .location-permission-content {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .location-icon {
            font-size: 48px;
            color: #4f46e5;
            margin-bottom: 20px;
        }

        /* Touch improvements for mobile */
        @media (max-width: 768px) {

            .nav-link,
            .bottom-nav-item {
                -webkit-tap-highlight-color: transparent;
            }

            .btn-glow:active {
                transform: scale(0.98);
            }
        }

        /* Loading spinner */
        .loading-spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #4f46e5;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Workshop list styles from first example */
        .workshop-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .name {
            font-size: 18px;
            font-weight: bold;
            color: #222;
        }

        .address {
            color: #555;
            font-size: 14px;
            margin: 5px 0;
        }

        .distance {
            font-weight: bold;
            color: #0066cc;
        }

        .map-link {
            display: inline-block;
            margin-top: 8px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            transition: background 0.2s ease;
        }

        .map-link:hover {
            background: #0056b3;
        }
    </style>
</head>
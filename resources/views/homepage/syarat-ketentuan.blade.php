<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Syarat & Ketentuan | ServiCycle</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #005bbb;
      --primary-light: #e6f2ff;
      --primary-dark: #004a9b;
      --secondary: #2c3e50;
      --secondary-light: #34495e;
      --accent: #ff6b35;
      --accent-light: #ff8c5a;
      --light: #f9fafb;
      --white: #ffffff;
      --gray: #6c757d;
      --gray-light: #e9ecef;
      --gray-lighter: #f8f9fa;
      --border-radius: 16px;
      --border-radius-sm: 8px;
      --shadow: 0 4px 20px rgba(0,0,0,0.05);
      --shadow-lg: 0 10px 30px rgba(0,0,0,0.08);
      --transition: all 0.3s ease;
      --transition-fast: all 0.15s ease;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    html {
      scroll-behavior: smooth;
    }
    
    body {
      font-family: "Poppins", sans-serif;
      line-height: 1.7;
      color: var(--secondary);
      background: linear-gradient(135deg, var(--light) 0%, #f0f4f8 100%);
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }
    
    .container {
      max-width: 900px;
      margin: 0 auto;
      background: var(--white);
      padding: 50px;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-lg);
      position: relative;
      overflow: hidden;
    }
    
    .container::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
    }
    
    .header {
      display: flex;
      align-items: center;
      margin-bottom: 40px;
      position: relative;
    }
    
    .logo {
      display: flex;
      align-items: center;
      margin-right: 20px;
      color: var(--primary);
      font-size: 24px;
      font-weight: 700;
    }
    
    .logo i {
      margin-right: 10px;
      font-size: 28px;
    }
    
    .back-btn {
      display: inline-flex;
      align-items: center;
      background-color: var(--primary);
      color: var(--white);
      border: none;
      padding: 12px 20px;
      border-radius: var(--border-radius-sm);
      font-size: 15px;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(0, 91, 187, 0.2);
    }
    
    .back-btn:hover {
      background-color: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(0, 91, 187, 0.3);
    }
    
    .back-btn:active {
      transform: translateY(0);
    }
    
    .back-btn i {
      margin-right: 8px;
    }
    
    h1 {
      color: var(--secondary);
      text-align: center;
      margin-bottom: 30px;
      font-size: 32px;
      font-weight: 700;
      position: relative;
      padding-bottom: 15px;
    }
    
    h1::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
      border-radius: 2px;
    }
    
    h2 {
      color: var(--primary);
      margin-top: 40px;
      padding: 20px 0 15px;
      border-bottom: 1px solid var(--gray-light);
      font-size: 22px;
      font-weight: 600;
      position: relative;
      display: flex;
      align-items: center;
    }
    
    h2 i {
      margin-right: 12px;
      color: var(--accent);
      font-size: 20px;
    }
    
    h2:before {
      content: "";
      position: absolute;
      left: 0;
      bottom: -1px;
      width: 60px;
      height: 2px;
      background-color: var(--accent);
    }
    
    ul {
      padding-left: 24px;
      margin: 20px 0;
    }
    
    li {
      margin-bottom: 12px;
      position: relative;
      padding-left: 12px;
    }
    
    li:before {
      content: "•";
      color: var(--accent);
      font-weight: bold;
      position: absolute;
      left: -15px;
      font-size: 18px;
    }
    
    p, li {
      font-size: 16px;
      color: var(--secondary-light);
    }
    
    .intro-text {
      font-size: 17px;
      background-color: var(--gray-lighter);
      padding: 20px;
      border-radius: var(--border-radius-sm);
      border-left: 4px solid var(--primary);
      margin-bottom: 30px;
    }
    
    .highlight {
      background-color: var(--primary-light);
      padding: 4px 8px;
      border-radius: 4px;
      font-weight: 500;
      color: var(--primary-dark);
    }
    
    .footer {
      margin-top: 50px;
      text-align: center;
      font-size: 14px;
      color: var(--gray);
      padding-top: 25px;
      border-top: 1px solid var(--gray-light);
    }
    
    .footer-links {
      display: flex;
      justify-content: center;
      margin-top: 15px;
      gap: 20px;
    }
    
    .footer-link {
      color: var(--gray);
      text-decoration: none;
      transition: var(--transition-fast);
    }
    
    .footer-link:hover {
      color: var(--primary);
    }
    
    /* Animasi untuk konten */
    .content-section {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.6s forwards;
    }
    
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    /* Efek hover untuk bagian yang dapat diklik */
    .clickable {
      cursor: pointer;
      transition: var(--transition);
    }
    
    .clickable:hover {
      transform: translateY(-3px);
    }
    
    /* Table of contents */
    .toc-container {
      background-color: var(--gray-lighter);
      padding: 20px;
      border-radius: var(--border-radius-sm);
      margin-bottom: 30px;
      border-left: 4px solid var(--accent);
    }
    
    .toc-title {
      font-weight: 600;
      margin-bottom: 12px;
      color: var(--secondary);
      display: flex;
      align-items: center;
    }
    
    .toc-title i {
      margin-right: 8px;
      color: var(--accent);
    }
    
    .toc-list {
      list-style-type: none;
      padding-left: 0;
    }
    
    .toc-item {
      margin-bottom: 8px;
    }
    
    .toc-link {
      color: var(--secondary-light);
      text-decoration: none;
      transition: var(--transition-fast);
      display: flex;
      align-items: center;
    }
    
    .toc-link:hover {
      color: var(--primary);
    }
    
    .toc-link i {
      margin-right: 8px;
      font-size: 12px;
      color: var(--accent);
    }
    
    /* Responsif untuk tablet */
    @media (max-width: 768px) {
      .container {
        padding: 30px 25px;
        margin: 20px;
      }
      
      h1 {
        font-size: 26px;
      }
      
      h2 {
        font-size: 20px;
      }
      
      .header {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .logo {
        margin-bottom: 15px;
      }
      
      .back-btn {
        width: 100%;
        justify-content: center;
        margin-right: 0;
      }
      
      .footer-links {
        flex-direction: column;
        gap: 10px;
      }
    }
    
    /* Responsif untuk mobile */
    @media (max-width: 480px) {
      .container {
        padding: 25px 20px;
        margin: 15px;
      }
      
      h1 {
        font-size: 24px;
      }
      
      h2 {
        font-size: 19px;
      }
      
      p, li {
        font-size: 15px;
      }
      
      .intro-text {
        font-size: 16px;
        padding: 15px;
      }
    }
    
    /* Progress bar untuk membaca */
    .progress-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background-color: var(--gray-light);
      z-index: 1000;
    }
    
    .progress-bar {
      height: 100%;
      background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
      width: 0%;
      transition: width 0.3s ease;
    }
    
    /* Scroll to top button */
    .scroll-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background-color: var(--primary);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      z-index: 999;
      opacity: 0;
      visibility: hidden;
    }
    
    .scroll-top.show {
      opacity: 1;
      visibility: visible;
    }
    
    .scroll-top:hover {
      background-color: var(--primary-dark);
      transform: translateY(-3px);
    }
  </style>
</head>
<body>
  <!-- Progress bar untuk membaca -->
  <div class="progress-container">
    <div class="progress-bar" id="progressBar"></div>
  </div>
  
  <!-- Scroll to top button -->
  <div class="scroll-top" id="scrollTop">
    <i class="fas fa-chevron-up"></i>
  </div>
  
  <div class="container">
    <div class="header">
      <div class="logo">
        <i class="fas fa-motorcycle"></i>
        <span>ServiCycle</span>
      </div>
      <a href="#" class="back-btn clickable">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>

    <h1>Syarat & Ketentuan ServiCycle</h1>
    
    <div class="content-section">
      <p class="intro-text">Terima kasih telah menggunakan layanan ServiCycle. Dengan melakukan booking servis melalui platform kami, Anda dianggap telah membaca, memahami, dan menyetujui seluruh Syarat & Ketentuan berikut:</p>
      
      <div class="toc-container">
        <div class="toc-title">
          <i class="fas fa-list"></i>
          Daftar Isi
        </div>
        <ul class="toc-list">
          <li class="toc-item"><a href="#section1" class="toc-link"><i class="fas fa-chevron-right"></i> Proses Booking</a></li>
          <li class="toc-item"><a href="#section2" class="toc-link"><i class="fas fa-chevron-right"></i> Waktu dan Jadwal</a></li>
          <li class="toc-item"><a href="#section3" class="toc-link"><i class="fas fa-chevron-right"></i> Tanggung Jawab Pengguna</a></li>
          <li class="toc-item"><a href="#section4" class="toc-link"><i class="fas fa-chevron-right"></i> Ketentuan Lain</a></li>
        </ul>
      </div>

      <section id="section1">
        <h2><i class="fas fa-calendar-check"></i> 1. Proses Booking</h2>
        <ul>
          <li>Booking servis dapat dilakukan kapan saja melalui aplikasi ServiCycle.</li>
          <li>Anda dapat membatalkan booking selama status masih <span class="highlight">Menunggu Konfirmasi</span> dari pihak bengkel.</li>
          <li>Setelah bengkel menerima booking, pembatalan tidak dapat dilakukan melalui aplikasi. Silakan hubungi bengkel secara langsung.</li>
          <li>Konfirmasi booking akan dikirimkan melalui email dan notifikasi aplikasi.</li>
        </ul>
      </section>

      <section id="section2">
        <h2><i class="fas fa-clock"></i> 2. Waktu dan Jadwal</h2>
        <ul>
          <li>Pihak bengkel berhak menyesuaikan jadwal apabila terjadi perubahan operasional atau kondisi darurat.</li>
          <li>Anda akan mendapatkan notifikasi apabila jadwal berubah.</li>
          <li>Keterlambatan lebih dari 30 menit dari jadwal yang ditentukan dapat mengakibatkan pembatalan booking.</li>
          <li>Durasi servis dapat bervariasi tergantung kompleksitas pekerjaan dan ketersediaan suku cadang.</li>
        </ul>
      </section>

      <section id="section3">
        <h2><i class="fas fa-user-check"></i> 3. Tanggung Jawab Pengguna</h2>
        <ul>
          <li>Pastikan informasi kendaraan dan waktu servis yang Anda masukkan sudah benar.</li>
          <li>ServiCycle tidak bertanggung jawab atas kesalahan input atau kelalaian pengguna.</li>
          <li>Pengguna bertanggung jawab penuh atas keakuratan data yang diberikan.</li>
          <li>Pengguna diharapkan memberikan informasi yang jelas mengenai masalah atau keluhan pada kendaraan.</li>
        </ul>
      </section>

      <section id="section4">
        <h2><i class="fas fa-file-contract"></i> 4. Ketentuan Lain</h2>
        <ul>
          <li>Pihak ServiCycle dapat mengubah Syarat & Ketentuan sewaktu-waktu dengan pemberitahuan sebelumnya.</li>
          <li>Dengan melanjutkan penggunaan layanan, Anda dianggap setuju terhadap perubahan tersebut.</li>
          <li>ServiCycle berhak menangguhkan atau menghentikan akses pengguna yang melanggar ketentuan.</li>
          <li>Syarat dan ketentuan ini tunduk pada hukum yang berlaku di Indonesia.</li>
        </ul>
      </section>
    </div>

    <div class="footer">
      <p>&copy; 2025 ServiCycle. Semua Hak Dilindungi.</p>
      <div class="footer-links">
        <a href="#" class="footer-link">Kebijakan Privasi</a>
        <a href="#" class="footer-link">FAQ</a>
        <a href="#" class="footer-link">Hubungi Kami</a>
      </div>
    </div>
  </div>

  <script>
    // Progress bar untuk membaca
    window.addEventListener('scroll', function() {
      const winHeight = window.innerHeight;
      const docHeight = document.documentElement.scrollHeight;
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const scrollPercent = (scrollTop / (docHeight - winHeight)) * 100;
      document.getElementById('progressBar').style.width = scrollPercent + '%';
      
      // Show/hide scroll to top button
      const scrollTopBtn = document.getElementById('scrollTop');
      if (scrollTop > 300) {
        scrollTopBtn.classList.add('show');
      } else {
        scrollTopBtn.classList.remove('show');
      }
    });
    
    // Animasi untuk setiap bagian konten
    document.addEventListener('DOMContentLoaded', function() {
      const sections = document.querySelectorAll('.content-section');
      
      sections.forEach((section, index) => {
        section.style.animationDelay = (index * 0.1) + 's';
      });
    });
    
    // Fungsi untuk tombol kembali
    document.querySelector('.back-btn').addEventListener('click', function(e) {
      e.preventDefault();
      // Simulasi kembali ke halaman sebelumnya
      window.history.back();
    });
    
    // Smooth scroll untuk table of contents
    document.querySelectorAll('.toc-link').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        const offsetTop = targetElement.offsetTop - 100;
        
        window.scrollTo({
          top: offsetTop,
          behavior: 'smooth'
        });
      });
    });
    
    // Scroll to top functionality
    document.getElementById('scrollTop').addEventListener('click', function() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  </script>
</body>
</html>
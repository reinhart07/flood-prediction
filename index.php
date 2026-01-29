<?php 
$title = "FloodGuard Jakarta - Sistem Prediksi Banjir Berbasis AI";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="frontend/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <i class="fas fa-shield-alt"></i>
                <span>FloodGuard</span>
            </div>
            <ul class="nav-menu">
                <li><a href="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? '#' : '../index.php' ?>">Beranda</a></li>
                <li><a href="frontend/about.php">Tentang</a></li>
                <li><a href="frontend/prediksi.php">Prediksi Banjir</a></li>
                <li><a href="frontend/peta.php">Peta Rawan Banjir</a></li>
                <li><a href="frontend/berita.php">Berita</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="frontend/dashboard.php"><i class="fas fa-user-circle"></i> Dashboard</a></li>
                <?php else: ?>
                    <li><a href="frontend/login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <?php endif; ?>
            </ul>
            <div class="nav-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- Hero Carousel Section -->
    <section class="hero-carousel">
        <div class="carousel-container">
            <div class="carousel-slide active">
                <img src="frontend/img/gambar1.jpeg" alt="Banjir Jakarta 1">
                <div class="carousel-overlay"></div>
                <div class="carousel-content">
                    <h1 class="fade-in">Lindungi Jakarta dari Banjir</h1>
                    <p class="fade-in-delay">Sistem prediksi banjir berbasis AI untuk mencegah dampak bencana</p>
                    <a href="frontend/prediksi.php" class="btn btn-primary fade-in-delay-2">
                        <i class="fas fa-cloud-rain"></i> Cek Prediksi Sekarang
                    </a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="../frontend/img/gambar2.png" alt="Banjir Jakarta 2">
                <div class="carousel-overlay"></div>
                <div class="carousel-content">
                    <h1 class="fade-in">Teknologi AI untuk Keselamatan</h1>
                    <p class="fade-in-delay">Machine Learning dengan akurasi 88.49% dalam memprediksi banjir</p>
                    <a href="frontend/about.php" class="btn btn-primary fade-in-delay-2">
                        <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="../frontend/img/gambar3.png" alt="Banjir Jakarta 3">
                <div class="carousel-overlay"></div>
                <div class="carousel-content">
                    <h1 class="fade-in">Data Real-Time Jakarta</h1>
                    <p class="fade-in-delay">Monitoring cuaca dan kondisi banjir dari 4 stasiun BMKG</p>
                    <a href="frontend/peta.php" class="btn btn-primary fade-in-delay-2">
                        <i class="fas fa-map-marked-alt"></i> Lihat Peta
                    </a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="../frontend/img/gambar4.png" alt="Banjir Jakarta 4">
                <div class="carousel-overlay"></div>
                <div class="carousel-content">
                    <h1 class="fade-in">Bersama Cegah Banjir</h1>
                    <p class="fade-in-delay">Partisipasi masyarakat untuk Jakarta yang lebih aman</p>
                    <a href="frontend/berita.php" class="btn btn-primary fade-in-delay-2">
                        <i class="fas fa-newspaper"></i> Berita Terkini
                    </a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="../frontend/img/gambar5.png" alt="Banjir Jakarta 5">
                <div class="carousel-overlay"></div>
                <div class="carousel-content">
                    <h1 class="fade-in">Siaga Banjir 24/7</h1>
                    <p class="fade-in-delay">Sistem peringatan dini untuk melindungi keluarga Anda</p>
                    <a href="frontend/prediksi.php" class="btn btn-primary fade-in-delay-2">
                        <i class="fas fa-exclamation-triangle"></i> Cek Status Bahaya
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <span class="indicator active" data-slide="0"></span>
            <span class="indicator" data-slide="1"></span>
            <span class="indicator" data-slide="2"></span>
            <span class="indicator" data-slide="3"></span>
            <span class="indicator" data-slide="4"></span>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control prev">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="carousel-control next">
            <i class="fas fa-chevron-right"></i>
        </button>
    </section>

    <!-- About Banjir Section -->
    <section class="about-flood">
        <div class="container">
            <div class="section-header">
                <h2>Mengapa Banjir Terjadi di Jakarta?</h2>
                <div class="header-line"></div>
            </div>
            
            <div class="flood-info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-cloud-showers-heavy"></i>
                    </div>
                    <h3>Curah Hujan Tinggi</h3>
                    <p>Jakarta mengalami curah hujan ekstrem terutama saat musim hujan (Desember-Februari) dengan intensitas mencapai 100+ mm per hari yang dapat memicu banjir besar.</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h3>Penurunan Tanah</h3>
                    <p>Jakarta mengalami penurunan tanah (land subsidence) hingga 10-20 cm per tahun akibat eksploitasi air tanah berlebihan, membuat daerah rendah semakin rawan banjir.</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-city"></i>
                    </div>
                    <h3>Urbanisasi Masif</h3>
                    <p>Pertumbuhan kota yang pesat mengurangi area resapan air. Beton dan aspal menutupi tanah sehingga air hujan tidak terserap dan langsung mengalir ke sungai.</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <h3>Sistem Drainase Buruk</h3>
                    <p>Banyak saluran air tersumbat sampah dan sedimentasi. Kapasitas saluran tidak mampu menampung debit air saat hujan deras, menyebabkan luapan ke permukiman.</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-house-flood-water"></i>
                    </div>
                    <h3>Pemukiman di Bantaran Sungai</h3>
                    <p>Ribuan rumah dibangun di bantaran 13 sungai yang melintasi Jakarta, menghalangi aliran air dan memperparah risiko banjir saat sungai meluap.</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-globe-asia"></i>
                    </div>
                    <h3>Perubahan Iklim</h3>
                    <p>Pemanasan global meningkatkan intensitas dan frekuensi cuaca ekstrem. Pola hujan menjadi tidak menentu dengan kejadian hujan ekstrem yang lebih sering terjadi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="statistics">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="stat-number" data-target="88">0</h3>
                    <p>Akurasi Model (%)</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="stat-number" data-target="6308">0</h3>
                    <p>Data Training</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="stat-number" data-target="5">0</h3>
                    <p>Tahun Data (2016-2020)</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="stat-number" data-target="4">0</h3>
                    <p>Stasiun BMKG</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-header">
                <h2>Fitur FloodGuard</h2>
                <div class="header-line"></div>
                <p>Sistem komprehensif untuk mitigasi banjir Jakarta</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>Prediksi AI</h3>
                    <p>Machine Learning dengan Random Forest untuk memprediksi kemungkinan banjir berdasarkan data cuaca real-time.</p>
                    <a href="frontend/prediksi.php" class="feature-link">Coba Sekarang <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-map"></i>
                    </div>
                    <h3>Peta Interaktif</h3>
                    <p>Visualisasi wilayah rawan banjir di Jakarta dengan data geografis dari 34 provinsi Indonesia.</p>
                    <a href="frontend/peta.php" class="feature-link">Lihat Peta <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3>Chatbot Cerdas</h3>
                    <p>Asisten virtual powered by Google Gemini AI untuk menjawab pertanyaan seputar banjir dan pencegahannya.</p>
                    <a href="#chatbot" class="feature-link" id="open-chatbot">Tanya Sekarang <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Peringatan Dini</h3>
                    <p>Notifikasi otomatis saat sistem mendeteksi potensi banjir tinggi di wilayah Anda.</p>
                    <a href="frontend/berita.php" class="feature-link">Info Terkini <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Siap Melindungi Jakarta dari Banjir?</h2>
                <p>Gunakan teknologi AI untuk prediksi banjir yang akurat dan lindungi keluarga Anda</p>
                <div class="cta-buttons">
                    <a href="frontend/prediksi.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-chart-line"></i> Mulai Prediksi
                    </a>
                    <a href="frontend/about.php" class="btn btn-secondary btn-lg">
                        <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Chatbot Widget -->
    <div class="chatbot-widget" id="chatbot-widget">
        <div class="chatbot-header">
            <div class="chatbot-title">
                <i class="fas fa-robot"></i>
                <span>FloodGuard Assistant</span>
            </div>
            <button class="chatbot-close" id="close-chatbot">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="chatbot-messages" id="chatbot-messages">
            <div class="bot-message">
                <div class="message-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="message-content">
                    Halo! Saya asisten FloodGuard. Ada yang bisa saya bantu tentang banjir Jakarta?
                </div>
            </div>
        </div>
        <div class="chatbot-input">
            <input type="text" id="chatbot-input-field" placeholder="Ketik pertanyaan Anda...">
            <button id="chatbot-send">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <!-- Chatbot Toggle Button -->
    <button class="chatbot-toggle" id="chatbot-toggle">
        <i class="fas fa-comments"></i>
        <span class="chatbot-badge">1</span>
    </button>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>
                        <i class="fas fa-shield-alt"></i>
                        FloodGuard Jakarta
                    </h3>
                    <p>Sistem prediksi banjir berbasis AI untuk melindungi Jakarta dari dampak bencana banjir.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="frontend/about.php">Tentang</a></li>
                        <li><a href="frontend/prediksi.php">Prediksi</a></li>
                        <li><a href="frontend/peta.php">Peta</a></li>
                        <li><a href="frontend/berita.php">Berita</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Kontak Darurat</h4>
                    <ul>
                        <li><i class="fas fa-phone"></i> BPBD DKI: 021-6560777</li>
                        <li><i class="fas fa-phone"></i> Posko Banjir: 112</li>
                        <li><i class="fas fa-envelope"></i> info@floodguard.id</li>
                        <li><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Didukung Oleh</h4>
                    <div class="partner-logos">
                        <img src="frontend/img/coris.png" alt="CORIS" class="partner-logo">
                        <img src="frontend/img/klabat.png" alt="Universitas Klabat" class="partner-logo">
                        <img src="frontend/img/dipa.png" alt="Universitas Dipa" class="partner-logo">
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 FloodGuard Jakarta. Dikembangkan untuk PROX x CORIS 2026 International Competition.</p>
                <p>Powered by AI & Machine Learning</p>
            </div>
        </div>
    </footer>

    <script src="frontend/js/main.js"></script>
    <script src="frontend/js/chatbot.js"></script>
</body>
</html>
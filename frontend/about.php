<?php 
$title = "Tentang - FloodGuard Jakarta";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/style.css">
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
                <li><a href="about.php">Tentang</a></li>
                <li><a href="prediksi.php">Prediksi Banjir</a></li>
                <li><a href="peta.php">Peta Rawan Banjir</a></li>
                <li><a href="berita.php">Berita</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php"><i class="fas fa-user-circle"></i> Dashboard</a></li>
                <?php else: ?>
                    <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <?php endif; ?>
            </ul>
            <div class="nav-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1><i class="fas fa-info-circle"></i> Tentang FloodGuard Jakarta</h1>
            <p>Sistem Prediksi Banjir Berbasis Artificial Intelligence</p>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-content">
        <div class="container">
            <!-- Project Overview -->
            <div class="about-section">
                <div class="about-grid">
                    <div class="about-text">
                        <h2>Apa itu FloodGuard?</h2>
                        <p>FloodGuard Jakarta adalah platform inovatif yang menggabungkan teknologi <strong>Artificial Intelligence (AI)</strong> dan <strong>Machine Learning</strong> untuk memprediksi potensi banjir di wilayah Jakarta.</p>
                        <p>Dikembangkan sebagai bagian dari <strong>PROX x CORIS 2026 International Competition</strong> dengan tema <em>"Bridging Gaps: Code for Earth, Intelligence for Justice, and Sustainability for Shaping Tomorrow"</em>, FloodGuard bertujuan mengurangi dampak bencana banjir melalui sistem peringatan dini yang akurat.</p>
                        <p>Dengan memanfaatkan data historis dari BMKG selama 5 tahun (2016-2020) dan algoritma Random Forest, sistem kami mampu memprediksi banjir dengan akurasi <strong>88.49%</strong>.</p>
                    </div>
                    <div class="about-image">
                        <div class="stats-highlight">
                            <div class="stat-item">
                                <h3>88.49%</h3>
                                <p>Akurasi Model</p>
                            </div>
                            <div class="stat-item">
                                <h3>6,308</h3>
                                <p>Data Training</p>
                            </div>
                            <div class="stat-item">
                                <h3>4</h3>
                                <p>Stasiun BMKG</p>
                            </div>
                            <div class="stat-item">
                                <h3>5 Tahun</h3>
                                <p>Data Historis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team Section - DEVELOPER -->
            <section class="team-section">
                <div class="container">
                    <div class="section-header">
                        <h2>Tim Pengembang</h2>
                        <div class="header-line"></div>
                        <p>Dikembangkan dengan dedikasi untuk PROX x CORIS 2026</p>
                    </div>

                    <div class="developer-card">
                        <div class="developer-photo">
                            <img src="../img/rein.jpg" alt="Developer Photo">
                            <div class="photo-badge">
                                <i class="fas fa-code"></i> Full-Stack Developer
                            </div>
                        </div>
                        <div class="developer-info">
                            <h3>Reinhart JR [Reinhart Jens Robert]</h3>
                            <p class="developer-role">
                                <i class="fas fa-laptop-code"></i> Web Development & AI Integration Specialist
                            </p>
                            
                            <div class="developer-bio">
                                <p>Saya adalah mahasiswa yang passionate dalam bidang teknologi dan pengembangan web. FloodGuard Jakarta adalah project yang saya kembangkan untuk kompetisi PROX x CORIS 2026 dengan tujuan memanfaatkan teknologi AI untuk membantu masyarakat Jakarta dalam mitigasi bencana banjir.</p>
                                
                                <p>Dengan menggabungkan Machine Learning, Web Development modern, dan data real-time, saya berharap FloodGuard dapat menjadi solusi yang bermanfaat bagi masyarakat luas.</p>
                            </div>

                            <div class="developer-skills">
                                <h4><i class="fas fa-tools"></i> Tech Stack yang Digunakan:</h4>
                                <div class="skills-tags">
                                    <span class="skill-tag"><i class="fab fa-python"></i> Python</span>
                                    <span class="skill-tag"><i class="fab fa-php"></i> PHP Native</span>
                                    <span class="skill-tag"><i class="fab fa-js"></i> JavaScript</span>
                                    <span class="skill-tag"><i class="fas fa-brain"></i> Machine Learning</span>
                                    <span class="skill-tag"><i class="fas fa-robot"></i> Google Gemini AI</span>
                                    <span class="skill-tag"><i class="fas fa-database"></i> Data Science</span>
                                    <span class="skill-tag"><i class="fas fa-map"></i> Leaflet.js</span>
                                    <span class="skill-tag"><i class="fas fa-flask"></i> Flask API</span>
                                </div>
                            </div>

                            <div class="developer-stats">
                                <div class="stat-item-dev">
                                    <strong>2000+</strong>
                                    <small>Baris Kode</small>
                                </div>
                                <div class="stat-item-dev">
                                    <strong>6308</strong>
                                    <small>Data Training</small>
                                </div>
                                <div class="stat-item-dev">
                                    <strong>88.49%</strong>
                                    <small>Model Accuracy</small>
                                </div>
                                <div class="stat-item-dev">
                                    <strong>1 Bulan</strong>
                                    <small>Development Time</small>
                                </div>
                            </div>

                            <div class="developer-contact">
                                <a href="mailto:reinhartrobert23@Gmail.com.com" class="contact-btn">
                                    <i class="fas fa-envelope"></i> Email
                                </a>
                                <a href="https://github.com/reinhart07" class="contact-btn" target="_blank">
                                    <i class="fab fa-github"></i> GitHub
                                </a>
                                <a href="https://linkedin.com/in/reinhartjensrobert" class="contact-btn" target="_blank">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </a>
                                <a href="https://instagram.com/reinhartjensr" class="contact-btn" target="_blank">
                                    <i class="fab fa-instagram"></i> Instagram
                                </a>
                            </div>

                            <div class="developer-quote">
                                <i class="fas fa-quote-left quote-icon"></i>
                                <p>"Teknologi harus memberikan solusi nyata untuk masalah nyata. FloodGuard adalah upaya saya untuk berkontribusi dalam melindungi Jakarta dari banjir menggunakan kekuatan AI dan data science."</p>
                                <i class="fas fa-quote-right quote-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mission & Vision -->
            <div class="mission-vision">
                <div class="mv-card">
                    <div class="mv-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Visi</h3>
                    <p>Menjadi platform terdepan dalam sistem peringatan dini banjir berbasis AI untuk melindungi masyarakat Jakarta dan Indonesia dari dampak bencana banjir.</p>
                </div>
                <div class="mv-card">
                    <div class="mv-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>Misi</h3>
                    <ul>
                        <li>Menyediakan prediksi banjir akurat berbasis data real-time</li>
                        <li>Meningkatkan kesadaran masyarakat tentang mitigasi banjir</li>
                        <li>Mendukung pemerintah dalam pengambilan keputusan darurat</li>
                        <li>Mengembangkan teknologi berkelanjutan untuk climate resilience</li>
                    </ul>
                </div>
            </div>

            <!-- Technology Stack -->
            <div class="about-section">
                <h2 class="section-title">Teknologi yang Digunakan</h2>
                <div class="tech-grid">
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h4>Machine Learning</h4>
                        <p><strong>Random Forest Classifier</strong> dengan 200 decision trees untuk prediksi akurat berdasarkan pola data historis.</p>
                    </div>
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fab fa-python"></i>
                        </div>
                        <h4>Python & Flask</h4>
                        <p>Backend ML service menggunakan <strong>Flask</strong>, <strong>scikit-learn</strong>, dan <strong>pandas</strong> untuk data processing.</p>
                    </div>
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fab fa-php"></i>
                        </div>
                        <h4>PHP Native</h4>
                        <p>Web backend dengan PHP native untuk integrasi ML API dan database management.</p>
                    </div>
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h4>Leaflet.js</h4>
                        <p>Interactive mapping menggunakan <strong>Leaflet.js</strong> dengan data GeoJSON dari 34 provinsi Indonesia.</p>
                    </div>
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h4>Google Gemini AI</h4>
                        <p>Chatbot cerdas powered by <strong>Gemini API</strong> untuk menjawab pertanyaan seputar banjir.</p>
                    </div>
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4>BMKG Data</h4>
                        <p>Dataset real dari 4 stasiun BMKG Jakarta dengan 6,308 records (2016-2020).</p>
                    </div>
                </div>
            </div>

            <!-- How It Works -->
            <div class="about-section">
                <h2 class="section-title">Cara Kerja FloodGuard</h2>
                <div class="workflow">
                    <div class="workflow-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Input Data Cuaca</h4>
                            <p>Pengguna memasukkan data cuaca (curah hujan, kelembaban, suhu) atau menggunakan data real-time dari API.</p>
                        </div>
                    </div>
                    <div class="workflow-arrow">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="workflow-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Preprocessing Data</h4>
                            <p>Data dinormalisasi dan di-scale menggunakan StandardScaler untuk memastikan konsistensi input.</p>
                        </div>
                    </div>
                    <div class="workflow-arrow">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="workflow-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>ML Prediction</h4>
                            <p>Model Random Forest menganalisis data dan menghasilkan probabilitas banjir (0-100%).</p>
                        </div>
                    </div>
                    <div class="workflow-arrow">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="workflow-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h4>Risk Assessment</h4>
                            <p>Sistem mengklasifikasikan risiko: <span class="badge-low">Low</span>, <span class="badge-medium">Medium</span>, atau <span class="badge-high">High</span>.</p>
                        </div>
                    </div>
                    <div class="workflow-arrow">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="workflow-step">
                        <div class="step-number">5</div>
                        <div class="step-content">
                            <h4>Hasil & Rekomendasi</h4>
                            <p>Pengguna menerima hasil prediksi lengkap dengan rekomendasi tindakan pencegahan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Model Performance -->
            <div class="about-section">
                <h2 class="section-title">Performa Model</h2>
                <div class="performance-grid">
                    <div class="performance-card">
                        <h4>Accuracy</h4>
                        <div class="performance-bar">
                            <div class="bar-fill" style="width: 88.49%"></div>
                        </div>
                        <p class="performance-value">88.49%</p>
                    </div>
                    <div class="performance-card">
                        <h4>AUC-ROC Score</h4>
                        <div class="performance-bar">
                            <div class="bar-fill" style="width: 79.85%"></div>
                        </div>
                        <p class="performance-value">0.7985</p>
                    </div>
                    <div class="performance-card">
                        <h4>Precision (No Flood)</h4>
                        <div class="performance-bar">
                            <div class="bar-fill" style="width: 94%"></div>
                        </div>
                        <p class="performance-value">94%</p>
                    </div>
                    <div class="performance-card">
                        <h4>Recall (No Flood)</h4>
                        <div class="performance-bar">
                            <div class="bar-fill" style="width: 94%"></div>
                        </div>
                        <p class="performance-value">94%</p>
                    </div>
                </div>
                <p class="performance-note">
                    <i class="fas fa-info-circle"></i>
                    Model dilatih menggunakan algoritma Random Forest dengan 200 estimators, max_depth 15, dan SMOTE untuk handling imbalanced data.
                </p>
            </div>

            <!-- Dataset Info -->
            <div class="about-section">
                <h2 class="section-title">Dataset & Features</h2>
                <div class="dataset-info">
                    <div class="dataset-overview">
                        <h4>Sumber Data</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> <strong>BMKG</strong> (Badan Meteorologi, Klimatologi, dan Geofisika)</li>
                            <li><i class="fas fa-check"></i> <strong>4 Stasiun Monitoring:</strong>
                                <ul>
                                    <li>Stasiun Klimatologi Banten (Jakarta Selatan)</li>
                                    <li>Stasiun Meteorologi Maritim Tanjung Priok (Jakarta Utara)</li>
                                    <li>Stasiun Meteorologi Kemayoran (Jakarta Pusat)</li>
                                    <li>Halim Perdana Kusuma (Jakarta Timur)</li>
                                </ul>
                            </li>
                            <li><i class="fas fa-check"></i> <strong>Periode:</strong> 2016-2020 (5 tahun)</li>
                            <li><i class="fas fa-check"></i> <strong>Total Records:</strong> 6,308 data</li>
                            <li><i class="fas fa-check"></i> <strong>Flood Events:</strong> 476 kejadian banjir (7.55%)</li>
                        </ul>
                    </div>
                    <div class="features-list">
                        <h4>Features Utama</h4>
                        <div class="feature-badges">
                            <span class="feature-badge"><i class="fas fa-tint"></i> Kelembaban (RH_avg) - 23.6%</span>
                            <span class="feature-badge"><i class="fas fa-temperature-low"></i> Suhu Min (Tn) - 16.5%</span>
                            <span class="feature-badge"><i class="fas fa-thermometer-half"></i> Suhu Avg (Tavg) - 16.1%</span>
                            <span class="feature-badge"><i class="fas fa-cloud-rain"></i> Curah Hujan (RR) - 12.7%</span>
                            <span class="feature-badge"><i class="fas fa-wind"></i> Kecepatan Angin - 9.0%</span>
                            <span class="feature-badge"><i class="fas fa-sun"></i> Durasi Sinar Matahari - 7.3%</span>
                        </div>
                        <p class="feature-note">
                            <i class="fas fa-lightbulb"></i> Persentase menunjukkan <strong>Feature Importance</strong> dari model Random Forest.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team / Competition Info -->
            <div class="about-section">
                <h2 class="section-title">Competition Information</h2>
                <div class="competition-info">
                    <div class="comp-card">
                        <i class="fas fa-trophy"></i>
                        <h4>PROX x CORIS 2026</h4>
                        <p>International Competition</p>
                    </div>
                    <div class="comp-card">
                        <i class="fas fa-globe"></i>
                        <h4>Sub-Theme</h4>
                        <p>AI for Climate, Justice, and Social Resilience</p>
                    </div>
                    <div class="comp-card">
                        <i class="fas fa-laptop-code"></i>
                        <h4>Category</h4>
                        <p>Web Development</p>
                    </div>
                </div>
            </div>

            <!-- Partners -->
            <div class="about-section">
                <h2 class="section-title">Didukung Oleh</h2>
                <div class="partners-showcase">
                    <div class="partner-item">
                        <img src="img/coris.png" alt="CORIS Logo">
                        <h4>CORIS</h4>
                        <p>Competition Organizer</p>
                    </div>
                    <div class="partner-item">
                        <img src="../frontend/img/klabat.png" alt="Universitas Klabat Logo">
                        <h4>Universitas Klabat</h4>
                        <p>Educational Partner</p>
                    </div>
                    <div class="partner-item">
                        <img src="img/dipa.png" alt="Universitas Dipa Logo">
                        <h4>Universitas Dipa</h4>
                        <p>Educational Partner</p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="about-cta">
                <h2>Siap Mencoba FloodGuard?</h2>
                <p>Lindungi keluarga Anda dengan prediksi banjir yang akurat</p>
                <div class="cta-buttons">
                    <a href="prediksi.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-chart-line"></i> Mulai Prediksi
                    </a>
                    <a href="peta.php" class="btn btn-secondary btn-lg">
                        <i class="fas fa-map"></i> Lihat Peta
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3><i class="fas fa-shield-alt"></i> FloodGuard Jakarta</h3>
                    <p>Sistem prediksi banjir berbasis AI untuk melindungi Jakarta.</p>
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
                        <li><a href="../index.php">Beranda</a></li>
                        <li><a href="about.php">Tentang</a></li>
                        <li><a href="prediksi.php">Prediksi</a></li>
                        <li><a href="peta.php">Peta</a></li>
                        <li><a href="berita.php">Berita</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Kontak Darurat</h4>
                    <ul>
                        <li><i class="fas fa-phone"></i> BPBD DKI: 021-6560777</li>
                        <li><i class="fas fa-phone"></i> Posko Banjir: 112</li>
                        <li><i class="fas fa-envelope"></i> info@floodguard.id</li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Didukung Oleh</h4>
                    <div class="partner-logos">
                        <img src="img/coris.png" alt="CORIS" class="partner-logo">
                        <img src="img/klabat.png" alt="Klabat" class="partner-logo">
                        <img src="img/dipa.png" alt="Dipa" class="partner-logo">
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 FloodGuard Jakarta. Dikembangkan untuk PROX x CORIS 2026.</p>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
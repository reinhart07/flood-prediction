<?php 
$title = "Prediksi Banjir - FloodGuard Jakarta";
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
            <h1><i class="fas fa-cloud-rain"></i> Prediksi Banjir Jakarta</h1>
            <p>Gunakan AI untuk memprediksi kemungkinan banjir berdasarkan kondisi cuaca</p>
        </div>
    </section>

    <!-- Prediction Section -->
    <section class="prediction-section">
        <div class="container">
            <div class="prediction-grid">
                <!-- Input Form -->
                <div class="prediction-form-card">
                    <div class="card-header">
                        <h2><i class="fas fa-edit"></i> Masukkan Data Cuaca</h2>
                        <p>Isi data cuaca untuk mendapatkan prediksi banjir</p>
                    </div>

                    <form id="prediction-form">
                        <!-- SECTION 1: DATA UTAMA -->
                        <div class="form-section">
                            <h3 class="section-subtitle">
                                <i class="fas fa-exclamation-circle"></i> Data Wajib
                            </h3>
                            
                            <div class="form-group">
                                <label for="rainfall">
                                    <i class="fas fa-cloud-showers-heavy"></i>
                                    Curah Hujan (mm)
                                    <span class="required">*</span>
                                    <span class="info-tooltip" title="Jumlah hujan dalam milimeter. 0-10mm (ringan), 10-50mm (sedang), 50+ mm (lebat)">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                </label>
                                <input 
                                    type="number" 
                                    id="rainfall" 
                                    name="RR" 
                                    placeholder="Contoh: 25.5"
                                    step="0.1"
                                    min="0"
                                    max="500"
                                    required
                                >
                                <small class="hint">Cek aplikasi cuaca atau BMKG</small>
                            </div>

                            <div class="form-group">
                                <label for="humidity">
                                    <i class="fas fa-tint"></i>
                                    Kelembaban Udara (%)
                                    <span class="required">*</span>
                                    <span class="info-tooltip" title="Persentase kelembaban udara. Normal: 60-80%, Tinggi: 80-95%">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                </label>
                                <input 
                                    type="number" 
                                    id="humidity" 
                                    name="RH_avg" 
                                    placeholder="Contoh: 78"
                                    step="1"
                                    min="0"
                                    max="100"
                                    required
                                >
                                <small class="hint">Biasanya tampil di aplikasi cuaca</small>
                            </div>
                        </div>

                        <!-- SECTION 2: DATA SUHU -->
                        <div class="form-section">
                            <h3 class="section-subtitle">
                                <i class="fas fa-thermometer-half"></i> Data Suhu
                            </h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="temp-avg">
                                        <i class="fas fa-thermometer-half"></i>
                                        Suhu Rata-rata (°C)
                                        <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="number" 
                                        id="temp-avg" 
                                        name="Tavg" 
                                        placeholder="28.5"
                                        step="0.1"
                                        min="any"
                                        max="45"
                                        required
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="temp-min">
                                        <i class="fas fa-temperature-low"></i>
                                        Suhu Minimum (°C)
                                        <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="number" 
                                        id="temp-min" 
                                        name="Tn" 
                                        placeholder="25.0"
                                        step="0.1"
                                        min="15"
                                        max="45"
                                        required
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="temp-max">
                                        <i class="fas fa-temperature-high"></i>
                                        Suhu Maximum (°C)
                                        <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="number" 
                                        id="temp-max" 
                                        name="Tx" 
                                        placeholder="32.0"
                                        step="0.1"
                                        min="20"
                                        max="50"
                                        required
                                    >
                                </div>
                            </div>
                            <small class="hint">Suhu hari ini (pagi/siang/malam)</small>
                        </div>

                        <!-- SECTION 3: DATA TAMBAHAN -->
                        <div class="form-section">
                            <h3 class="section-subtitle">
                                <i class="fas fa-cloud-sun"></i> Data Cuaca Lainnya
                            </h3>
                            
                            <div class="form-group">
                                <label for="sunshine">
                                    <i class="fas fa-sun"></i>
                                    Durasi Sinar Matahari (jam)
                                    <span class="required">*</span>
                                    <span class="info-tooltip" title="Berapa lama matahari bersinar hari ini (0-12 jam)">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                </label>
                                <input 
                                    type="number" 
                                    id="sunshine" 
                                    name="ss" 
                                    placeholder="5.2"
                                    step="0.1" 
                                    min="0" 
                                    max="12"
                                    required
                                >
                                <small class="hint">Rata-rata 5-8 jam saat cerah</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="wind-max">
                                        <i class="fas fa-wind"></i>
                                        Kecepatan Angin Max (m/s)
                                        <span class="required">*</span>
                                        <span class="info-tooltip" title="Kecepatan angin tertinggi hari ini (1-10 m/s = normal, >10 m/s = kencang)">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                    </label>
                                    <input 
                                        type="number" 
                                        id="wind-max" 
                                        name="ff_x" 
                                        placeholder="3.0"
                                        step="0.1"
                                        min="0"
                                        max="30"
                                        required
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="wind-avg">
                                        <i class="fas fa-wind"></i>
                                        Kecepatan Angin Rata-rata (m/s)
                                        <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="number" 
                                        id="wind-avg" 
                                        name="ff_avg" 
                                        placeholder="2.0"
                                        step="0.1"
                                        min="0"
                                        max="20"
                                        required
                                    >
                                </div>
                            </div>
                            <small class="hint">Cek di aplikasi cuaca atau BMKG</small>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" id="predict-btn">
                                <i class="fas fa-chart-line"></i> Prediksi Sekarang
                            </button>

                            <button type="button" class="btn btn-secondary btn-block" id="use-current-weather">
                                <i class="fas fa-map-marker-alt"></i> Isi Otomatis dari Cuaca Saat Ini
                            </button>

                            <button type="reset" class="btn-reset">
                                <i class="fas fa-redo"></i> Reset Form
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Result Card -->
                <div class="prediction-result-card" id="result-card" style="display: none;">
                    <div class="card-header">
                        <h2><i class="fas fa-chart-pie"></i> Hasil Prediksi</h2>
                    </div>

                    <div class="result-content" id="result-content">
                        <!-- Result will be injected here -->
                    </div>

                    <div class="result-actions">
                        <button class="btn btn-secondary" id="reset-form">
                            <i class="fas fa-redo"></i> Prediksi Lagi
                        </button>
                        <button class="btn btn-primary" id="save-result">
                            <i class="fas fa-download"></i> Simpan Hasil
                        </button>
                    </div>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="info-cards-grid">
                <div class="info-card-small">
                    <i class="fas fa-question-circle"></i>
                    <h4>Cara Menggunakan</h4>
                    <p>Isi minimal 3 data utama (curah hujan, kelembaban, suhu) untuk prediksi akurat.</p>
                </div>
                <div class="info-card-small">
                    <i class="fas fa-clock"></i>
                    <h4>Data Real-Time</h4>
                    <p>Gunakan tombol "Cuaca Saat Ini" untuk otomatis mengisi data dari BMKG.</p>
                </div>
                <div class="info-card-small">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Akurasi 88.49%</h4>
                    <p>Model AI telah dilatih dengan 6,308 data historis dari 4 stasiun BMKG.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (sama seperti index.php) -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3><i class="fas fa-shield-alt"></i> FloodGuard Jakarta</h3>
                    <p>Sistem prediksi banjir berbasis AI untuk melindungi Jakarta.</p>
                </div>
                <div class="footer-col">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="../index.php">Beranda</a></li>
                        <li><a href="about.php">Tentang</a></li>
                        <li><a href="prediksi.php">Prediksi</a></li>
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
                <p>&copy; 2026 FloodGuard Jakarta</p>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
    <script src="js/prediction.js"></script>
</body>
</html>
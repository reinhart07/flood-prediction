<?php 
$title = "Berita Banjir - FloodGuard Jakarta";
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
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(15, 23, 42, 0.9);
            animation: fadeIn 0.3s ease;
        }
        
        .modal.active {
            display: block;
        }
        
        .modal-content {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            margin: 3% auto;
            padding: 0;
            width: 90%;
            max-width: 800px;
            border-radius: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideDown 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .modal-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: #f1f5f9;
            padding: 1.5rem;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        
        .modal-close {
            background: none;
            border: none;
            color: #f1f5f9;
            font-size: 2rem;
            cursor: pointer;
            line-height: 1;
            transition: transform 0.2s;
        }
        
        .modal-close:hover {
            transform: rotate(90deg);
        }
        
        .modal-body {
            padding: 2rem;
            max-height: 70vh;
            overflow-y: auto;
            color: #334155;
        }
        
        .modal-body img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .modal-meta {
            display: flex;
            gap: 1.5rem;
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .modal-body p {
            line-height: 1.8;
            margin-bottom: 1.2rem;
            text-align: justify;
        }
        
        .modal-body h3 {
            color: #1e3a8a;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        
        .modal-body ul {
            list-style: disc;
            padding-left: 2rem;
            margin-bottom: 1.2rem;
        }
        
        .modal-body ul li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }
        
        .modal-footer {
            padding: 1.5rem 2rem;
            background: #f1f5f9;
            border-radius: 0 0 12px 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .share-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
        }
        
        .share-btn:hover {
            transform: scale(1.1);
        }
        
        .share-facebook { background: #1877f2; color: white; }
        .share-twitter { background: #1da1f2; color: white; }
        .share-whatsapp { background: #25d366; color: white; }
    </style>
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
            <h1><i class="fas fa-newspaper"></i> Berita & Informasi Banjir</h1>
            <p>Update terkini seputar banjir Jakarta dan mitigasi bencana</p>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section">
        <div class="container">
            <div class="news-filter">
                <button class="filter-btn active" data-category="all">Semua</button>
                <button class="filter-btn" data-category="breaking">Breaking News</button>
                <button class="filter-btn" data-category="tips">Tips & Edukasi</button>
                <button class="filter-btn" data-category="update">Update Cuaca</button>
            </div>

            <div class="news-grid">
                <!-- Featured News -->
                <div class="news-card" data-category="breaking" data-id="1">
                    <div class="news-badge badge-breaking">Breaking News</div>
                    <div class="news-image">
                        <img src="/img/berita1.jpg" alt="Banjir Jakarta">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> 26 Januari 2026</span>
                            <span><i class="fas fa-clock"></i> 14:30 WIB</span>
                        </div>
                        <h3>BMKG: Waspada Hujan Lebat di Jakarta Hari Ini</h3>
                        <p>BMKG memperingatkan potensi hujan lebat dengan intensitas sedang hingga lebat di wilayah Jakarta dan sekitarnya. Masyarakat diminta untuk waspada terhadap potensi banjir lokal...</p>
                        <button class="btn-read-more" onclick="openModal(1)">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- News Card 1 -->
                <div class="news-card" data-category="update" data-id="2">
                    <div class="news-badge badge-update">Update Cuaca</div>
                    <div class="news-image">
                        <img src="../img/berita2.jpg" alt="Prediksi Cuaca">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> 25 Januari 2026</span>
                        </div>
                        <h3>Prediksi Cuaca: Hujan Sedang Selama Seminggu</h3>
                        <p>BMKG memprediksi curah hujan sedang akan berlangsung selama seminggu ke depan di wilayah Jakarta...</p>
                        <button class="btn-read-more" onclick="openModal(2)">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- News Card 2 -->
                <div class="news-card" data-category="tips" data-id="3">
                    <div class="news-badge badge-tips">Tips & Edukasi</div>
                    <div class="news-image">
                        <img src="../img/berita3.png" alt="Tips Banjir">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> 24 Januari 2026</span>
                        </div>
                        <h3>7 Langkah Menghadapi Banjir di Rumah</h3>
                        <p>Berikut adalah langkah-langkah penting yang perlu dilakukan saat banjir melanda rumah Anda...</p>
                        <button class="btn-read-more" onclick="openModal(3)">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- News Card 3 -->
                <div class="news-card" data-category="breaking" data-id="4">
                    <div class="news-badge badge-breaking">Breaking News</div>
                    <div class="news-image">
                        <img src="../img/berita4.png" alt="Evakuasi">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> 23 Januari 2026</span>
                        </div>
                        <h3>BPBD Evakuasi 150 Warga Terdampak Banjir</h3>
                        <p>BPBD DKI Jakarta berhasil mengevakuasi 150 warga dari wilayah Jakarta Utara yang terendam banjir...</p>
                        <button class="btn-read-more" onclick="openModal(4)">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- News Card 4 -->
                <div class="news-card" data-category="tips" data-id="5">
                    <div class="news-badge badge-tips">Tips & Edukasi</div>
                    <div class="news-image">
                        <img src="../img/berita5.png" alt="Pencegahan">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> 22 Januari 2026</span>
                        </div>
                        <h3>Cara Mencegah Banjir di Lingkungan Anda</h3>
                        <p>Partisipasi masyarakat sangat penting dalam mencegah banjir. Berikut beberapa cara yang bisa dilakukan...</p>
                        <button class="btn-read-more" onclick="openModal(5)">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- News Card 5 -->
                <div class="news-card" data-category="update" data-id="6">
                    <div class="news-badge badge-update">Update Cuaca</div>
                    <div class="news-image">
                        <img src="../img/berita6.png" alt="Status Banjir">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> 21 Januari 2026</span>
                        </div>
                        <h3>Status Siaga 2 di 5 Wilayah Jakarta</h3>
                        <p>BPBD menetapkan status siaga 2 di lima wilayah Jakarta yang berpotensi mengalami banjir...</p>
                        <button class="btn-read-more" onclick="openModal(6)">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Emergency Contact Section -->
    <section class="emergency-section">
        <div class="container">
            <h2 class="section-title">Kontak Darurat Banjir</h2>
            <div class="emergency-grid">
                <div class="emergency-card">
                    <i class="fas fa-phone-alt"></i>
                    <h4>Posko Banjir Jakarta</h4>
                    <a href="tel:112" class="emergency-number">112</a>
                    <p>Layanan 24 jam</p>
                </div>
                <div class="emergency-card">
                    <i class="fas fa-hospital"></i>
                    <h4>BPBD DKI Jakarta</h4>
                    <a href="tel:021-6560777" class="emergency-number">021-6560777</a>
                    <p>Badan Penanggulangan Bencana</p>
                </div>
                <div class="emergency-card">
                    <i class="fas fa-ambulance"></i>
                    <h4>Ambulans</h4>
                    <a href="tel:118" class="emergency-number">118</a>
                    <p>Emergency Medical Service</p>
                </div>
                <div class="emergency-card">
                    <i class="fas fa-fire-extinguisher"></i>
                    <h4>Pemadam Kebakaran</h4>
                    <a href="tel:113" class="emergency-number">113</a>
                    <p>Dinas Pemadam & Penyelamatan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="tips-section">
        <div class="container">
            <h2 class="section-title">Tips Menghadapi Banjir</h2>
            <div class="tips-grid">
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h4>Sebelum Banjir</h4>
                    <ul>
                        <li>Pantau informasi cuaca dari BMKG</li>
                        <li>Siapkan tas darurat berisi dokumen penting</li>
                        <li>Matikan aliran listrik dan gas</li>
                        <li>Pindahkan barang berharga ke tempat tinggi</li>
                        <li>Simpan makanan dan air bersih</li>
                    </ul>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h4>Saat Banjir</h4>
                    <ul>
                        <li>Tetap tenang dan jangan panik</li>
                        <li>Hindari berjalan di air banjir yang dalam</li>
                        <li>Jauhi area dengan arus deras</li>
                        <li>Ikuti instruksi dari petugas</li>
                        <li>Hubungi nomor darurat jika perlu bantuan</li>
                    </ul>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h4>Setelah Banjir</h4>
                    <ul>
                        <li>Bersihkan rumah dari lumpur dan kotoran</li>
                        <li>Cek kondisi listrik sebelum dinyalakan</li>
                        <li>Buang makanan yang terkena air banjir</li>
                        <li>Sterilkan air sebelum digunakan</li>
                        <li>Waspada penyakit pasca banjir</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Full Article -->
    <div id="newsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle"></h2>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <div class="modal-meta">
                    <span id="modalDate"></span>
                </div>
                <div class="share-buttons">
                    <button class="share-btn share-facebook" title="Share to Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button class="share-btn share-twitter" title="Share to Twitter">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button class="share-btn share-whatsapp" title="Share to WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        // News filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const newsCards = document.querySelectorAll('.news-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const category = btn.getAttribute('data-category');

                newsCards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-category') === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Full Article Content Database
        const articles = {
            1: {
                title: "BMKG: Waspada Hujan Lebat di Jakarta Hari Ini",
                date: "26 Januari 2026, 14:30 WIB",
                image: "img/gambar1.png",
                content: `
                    <img src="../img/berita1.jpg" alt="Peringatan BMKG">
                    
                    <p><strong>Jakarta</strong> - Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) mengeluarkan peringatan dini cuaca ekstrem untuk wilayah DKI Jakarta dan sekitarnya pada hari ini, Minggu 26 Januari 2026. Intensitas hujan diprediksi mencapai kategori sedang hingga lebat dengan potensi disertai petir dan angin kencang.</p>

                    <p>Kepala BMKG Wilayah Jakarta, Dr. Ahmad Zakir, menjelaskan bahwa kondisi ini dipicu oleh pertumbuhan awan konvektif yang masif di sekitar wilayah Jakarta. "Kami mengimbau seluruh masyarakat Jakarta untuk tetap waspada, terutama di daerah-daerah yang rawan genangan dan banjir," ujarnya dalam konferensi pers di kantor BMKG Jakarta Pusat.</p>

                    <h3>Detail Peringatan Cuaca</h3>
                    <p>Menurut data dari BMKG, curah hujan diprediksi mencapai 50-100 mm dalam 24 jam dengan puncak intensitas antara pukul 14.00 hingga 18.00 WIB. Wilayah yang perlu diwaspadai meliputi:</p>
                    <ul>
                        <li>Jakarta Utara: Kelapa Gading, Tanjung Priok, Penjaringan</li>
                        <li>Jakarta Timur: Cawang, Kampung Melayu, Cipinang Melayu</li>
                        <li>Jakarta Barat: Kalideres, Cengkareng, Tambora</li>
                        <li>Jakarta Selatan: Kebayoran Lama, Cilandak</li>
                        <li>Jakarta Pusat: Kemayoran, Sawah Besar</li>
                    </ul>

                    <h3>Imbauan BPBD DKI Jakarta</h3>
                    <p>Menanggapi peringatan dari BMKG, Badan Penanggulangan Bencana Daerah (BPBD) DKI Jakarta telah mengaktifkan seluruh posko siaga banjir di 44 titik strategis. Kepala Pelaksana BPBD DKI Jakarta, Isnawa Adji, memastikan bahwa semua personel dan peralatan evakuasi telah disiapkan.</p>

                    <p>"Kami telah mengerahkan 200 personel gabungan dari BPBD, TNI, Polri, dan relawan di seluruh Jakarta. Pompa air portable dan perahu karet juga sudah stand-by di lokasi-lokasi rawan banjir," jelasnya.</p>

                    <h3>Antisipasi Masyarakat</h3>
                    <p>BMKG dan BPBD mengimbau masyarakat untuk melakukan langkah-langkah antisipasi berikut:</p>
                    <ul>
                        <li>Memantau perkembangan cuaca secara berkala melalui aplikasi resmi BMKG atau situs bmkg.go.id</li>
                        <li>Menghindari aktivitas outdoor yang tidak mendesak</li>
                        <li>Menyiapkan perlengkapan darurat seperti senter, obat-obatan, dan dokumen penting</li>
                        <li>Mematikan peralatan elektronik dan mencabut stop kontak jika air mulai naik</li>
                        <li>Mengikuti arahan dari petugas jika diminta untuk evakuasi</li>
                    </ul>

                    <p>Untuk informasi lebih lanjut dan laporan kondisi terkini, masyarakat dapat menghubungi Posko Banjir Jakarta di nomor 112 atau BPBD DKI Jakarta di 021-6560777 (24 jam).</p>

                    <p><em>Artikel ini akan terus diperbarui sesuai dengan perkembangan situasi terkini.</em></p>
                `
            },
            2: {
                title: "Prediksi Cuaca: Hujan Sedang Selama Seminggu",
                date: "25 Januari 2026",
                image: "img/gambar2.png",
                content: `
                    <img src="img/gambar2.png" alt="Prediksi Cuaca Jakarta">
                    
                    <p><strong>Jakarta</strong> - BMKG memprediksi curah hujan dengan intensitas sedang akan berlangsung selama seminggu ke depan di wilayah Jakarta dan sekitarnya. Prediksi ini berdasarkan analisis pola cuaca dan pergerakan massa udara di wilayah Indonesia bagian barat.</p>

                    <h3>Analisis Meteorologi</h3>
                    <p>Menurut Deputi Bidang Meteorologi BMKG, fenomena La Niña yang masih berlangsung turut berkontribusi pada intensitas curah hujan yang lebih tinggi dari normal. Suhu permukaan laut di sekitar Indonesia yang lebih dingin memicu pembentukan awan hujan yang lebih aktif.</p>

                    <p>"Kami memperkirakan curah hujan harian berkisar antara 20-50 mm dengan puncak pada sore hingga malam hari. Masyarakat diimbau untuk tetap waspada terutama di daerah dataran rendah," jelas pihak BMKG.</p>

                    <h3>Prediksi per Hari</h3>
                    <ul>
                        <li><strong>Senin, 27 Januari:</strong> Hujan sedang, 30-40 mm</li>
                        <li><strong>Selasa, 28 Januari:</strong> Hujan ringan-sedang, 20-35 mm</li>
                        <li><strong>Rabu, 29 Januari:</strong> Hujan sedang-lebat, 40-50 mm</li>
                        <li><strong>Kamis, 30 Januari:</strong> Hujan sedang, 25-40 mm</li>
                        <li><strong>Jumat, 31 Januari:</strong> Hujan ringan-sedang, 20-30 mm</li>
                        <li><strong>Sabtu, 1 Februari:</strong> Hujan ringan, 15-25 mm</li>
                        <li><strong>Minggu, 2 Februari:</strong> Berawan, kemungkinan hujan ringan</li>
                    </ul>

                    <h3>Dampak dan Mitigasi</h3>
                    <p>BPBD DKI Jakarta telah mempersiapkan langkah mitigasi dengan melakukan normalisasi saluran air, pemeriksaan pompa air, dan pembersihan gorong-gorong di 1.200 titik strategis. Tim gabungan juga telah disiagakan untuk mengantisipasi genangan dan banjir lokal.</p>

                    <p>Masyarakat diminta untuk tidak membuang sampah sembarangan dan memastikan saluran air di sekitar rumah tetap lancar. Informasi cuaca terkini dapat dipantau melalui aplikasi Info BMKG atau website resmi BMKG.</p>
                `
            },
            3: {
                title: "7 Langkah Menghadapi Banjir di Rumah",
                date: "24 Januari 2026",
                image: "img/gambar3.png",
                content: `
                    <img src="img/gambar3.png" alt="Tips Menghadapi Banjir">
                    
                    <p><strong>Jakarta</strong> - Banjir merupakan bencana yang sering melanda Jakarta, terutama saat musim hujan. Untuk itu, penting bagi setiap keluarga memahami langkah-langkah yang tepat dalam menghadapi banjir di rumah.</p>

                    <h3>1. Persiapan Sebelum Banjir</h3>
                    <p>Langkah paling penting adalah persiapan sebelum banjir terjadi. Pastikan Anda memiliki:</p>
                    <ul>
                        <li>Tas darurat berisi dokumen penting (KTP, Kartu Keluarga, Sertifikat, Polis Asuransi) dalam plastik waterproof</li>
                        <li>Kotak P3K lengkap dengan obat-obatan rutin</li>
                        <li>Senter atau lampu emergency dengan baterai cadangan</li>
                        <li>Persediaan makanan kaleng dan air minum untuk 3-5 hari</li>
                        <li>Power bank terisi penuh untuk komunikasi</li>
                        <li>Pakaian ganti dan selimut dalam tas kedap air</li>
                    </ul>

                    <h3>2. Pantau Informasi Cuaca</h3>
                    <p>Selalu pantau prediksi cuaca dari BMKG melalui aplikasi atau website resmi. Jika ada peringatan hujan lebat, segera lakukan persiapan tambahan. Simpan nomor kontak penting seperti BPBD (021-6560777), Posko Banjir (112), dan ambulans (118).</p>

                    <h3>3. Amankan Barang Berharga</h3>
                    <p>Pindahkan barang-barang berharga dan elektronik ke tempat yang lebih tinggi minimal 1 meter dari lantai. Angkat furnitur yang bisa diangkat atau letakkan di atas balok. Untuk barang elektronik besar yang tidak bisa dipindahkan, cabut semua kabel dan tutup dengan plastik tebal.</p>

                    <h3>4. Matikan Instalasi Listrik dan Gas</h3>
                    <p>Jika air mulai naik, segera matikan MCB listrik utama untuk mencegah korsleting dan kebakaran. Matikan juga katup gas dan pastikan tidak ada api menyala di rumah. Jangan menyalakan kembali listrik sebelum memastikan semua instalasi benar-benar kering.</p>

                    <h3>5. Evakuasi Diri dan Keluarga</h3>
                    <p>Jika ketinggian air sudah mencapai lutut orang dewasa atau arus sangat deras, segera evakuasi ke tempat yang lebih tinggi. Ikuti jalur evakuasi yang telah ditentukan. Bawa hanya barang-barang penting dalam tas darurat. Jangan mencoba menyeberangi arus air yang deras.</p>

                    <h3>6. Jaga Kesehatan</h3>
                    <p>Air banjir mengandung berbagai kontaminan dan bakteri berbahaya. Hindari kontak langsung dengan air banjir, terutama jika ada luka terbuka. Gunakan sepatu boots dan sarung tangan jika harus melewati air. Jangan mengonsumsi air atau makanan yang terkontaminasi air banjir.</p>

                    <h3>7. Setelah Banjir Surut</h3>
                    <p>Setelah air surut, lakukan pembersihan menyeluruh dengan langkah-langkah berikut:</p>
                    <ul>
                        <li>Dokumentasikan kerusakan dengan foto untuk klaim asuransi</li>
                        <li>Bersihkan lumpur dan kotoran dengan air bersih dan disinfektan</li>
                        <li>Keringkan rumah dengan membuka semua jendela dan pintu</li>
                        <li>Cek kondisi instalasi listrik oleh teknisi sebelum menyalakan</li>
                        <li>Buang semua makanan yang terkena air banjir</li>
                        <li>Sterilkan peralatan masak dan minum</li>
                        <li>Waspada penyakit pasca banjir seperti diare, leptospirosis, dan demam berdarah</li>
                    </ul>

                    <p><strong>Ingat:</strong> Keselamatan jiwa adalah prioritas utama. Jangan ragu untuk meminta bantuan kepada petugas jika situasi membahayakan.</p>
                `
            },
            4: {
                title: "BPBD Evakuasi 150 Warga Terdampak Banjir",
                date: "23 Januari 2026",
                image: "img/gambar4.png",
                content: `
                    <img src="img/gambar4.png" alt="Evakuasi Warga Banjir">
                    
                    <p><strong>Jakarta Utara</strong> - BPBD DKI Jakarta berhasil mengevakuasi 150 warga dari wilayah Jakarta Utara yang terendam banjir sejak Selasa (23/1) dini hari. Banjir terjadi akibat luapan Kali Sunter yang meluap setelah hujan deras mengguyur Jakarta selama 6 jam berturut-turut.</p>

                    <h3>Kronologi Banjir</h3>
                    <p>Hujan lebat mulai turun sejak pukul 23.00 WIB Senin malam dengan intensitas mencapai 85 mm per jam. Kondisi ini menyebabkan Kali Sunter tidak mampu menampung debit air yang meningkat drastis. Pada pukul 02.30 WIB, air mulai meluap dan menggenangi pemukiman warga di Kelurahan Sunter Agung, Tanjung Priok.</p>

                    <p>"Ketinggian air sempat mencapai 1,5 meter di beberapa titik. Kami langsung mengerahkan tim gabungan untuk proses evakuasi," ujar Kepala Pelaksana BPBD DKI Jakarta, Isnawa Adji, saat dikonfirmasi di Posko Penanganan Banjir.</p>

                    <h3>Proses Evakuasi</h3>
                    <p>Tim gabungan yang terdiri dari 80 personel BPBD, TNI, Polri, dan relawan dikerahkan dengan menggunakan 12 perahu karet dan 3 truk amfibi. Evakuasi berjalan lancar meskipun kondisi air yang deras dan gelap. Prioritas evakuasi diberikan kepada:</p>
                    <ul>
                        <li>Ibu hamil dan menyusui: 15 orang</li>
                        <li>Anak-anak dan bayi: 45 orang</li>
                        <li>Lansia dan penyandang disabilitas: 28 orang</li>
                        <li>Dewasa sehat: 62 orang</li>
                    </ul>

                    <h3>Layanan di Posko Pengungsian</h3>
                    <p>Seluruh pengungsi ditampung di GOR Sunter dengan fasilitas yang memadai. Dinas Sosial DKI Jakarta telah menyiapkan:</p>
                    <ul>
                        <li>150 kasur dan selimut</li>
                        <li>Makanan siap saji 3 kali sehari</li>
                        <li>Air bersih dan MCK darurat</li>
                        <li>Posko kesehatan dengan 4 dokter dan 8 perawat</li>
                        <li>Area bermain anak</li>
                        <li>Dapur umum</li>
                    </ul>

                    <p>Tim medis dari Puskesmas setempat juga melakukan pemeriksaan kesehatan kepada seluruh pengungsi. "Sebagian besar dalam kondisi sehat, hanya ada beberapa yang mengalami flu dan batuk ringan," kata dr. Anita Sari, koordinator tim medis.</p>

                    <h3>Kondisi Terkini</h3>
                    <p>Hingga berita ini diturunkan pukul 15.00 WIB, ketinggian air di lokasi banjir telah surut menjadi 30-50 cm. BPBD telah mengerahkan 8 pompa air mobile untuk mempercepat proses pengeringan. Diperkirakan warga dapat kembali ke rumah pada Kamis (24/1) sore hari setelah air benar-benar surut.</p>

                    <p>BPBD juga menerjunkan tim untuk membantu warga membersihkan rumah dari lumpur dan sampah. "Kami akan dampingi warga hingga situasi benar-benar pulih," tegas Isnawa Adji.</p>

                    <h3>Kerugian Material</h3>
                    <p>Berdasarkan data sementara BPBD, kerugian material diperkirakan mencapai Rp 3,2 miliar dengan rincian:</p>
                    <ul>
                        <li>120 unit rumah terendam dengan kerusakan ringan hingga sedang</li>
                        <li>45 unit kendaraan (mobil dan motor) terendam</li>
                        <li>2 warung makan rusak berat</li>
                        <li>Kerusakan infrastruktur jalan dan saluran air</li>
                    </ul>

                    <p>Pemprov DKI Jakarta telah menyatakan akan memberikan bantuan berupa uang tunai dan sembako kepada warga terdampak. Proses pendataan kerugian masih berlangsung untuk memastikan bantuan tepat sasaran.</p>
                `
            },
            5: {
                title: "Cara Mencegah Banjir di Lingkungan Anda",
                date: "22 Januari 2026",
                image: "img/gambar5.png",
                content: `
                    <img src="img/gambar5.png" alt="Pencegahan Banjir">
                    
                    <p><strong>Jakarta</strong> - Banjir bukan hanya tanggung jawab pemerintah, tetapi juga memerlukan partisipasi aktif dari seluruh masyarakat. Dengan melakukan langkah-langkah pencegahan yang sederhana, kita dapat mengurangi risiko banjir di lingkungan sekitar.</p>

                    <h3>1. Jaga Kebersihan Saluran Air</h3>
                    <p>Sampah yang menyumbat selokan adalah penyebab utama banjir lokal. Lakukan kerja bakti rutin minimal sebulan sekali untuk membersihkan saluran air di lingkungan RT/RW. Pastikan:</p>
                    <ul>
                        <li>Tidak ada sampah plastik, daun, atau ranting yang menyumbat</li>
                        <li>Selokan tidak dangkal karena endapan lumpur</li>
                        <li>Tutup saluran dalam kondisi baik</li>
                        <li>Gorong-gorong tidak tersumbat</li>
                    </ul>

                    <p>"Kami mengajak seluruh warga Jakarta untuk tidak membuang sampah sembarangan. Satu bungkus plastik yang Anda buang ke selokan bisa menyumbat aliran air dan menyebabkan banjir," ujar Kepala Dinas Lingkungan Hidup DKI Jakarta.</p>

                    <h3>2. Buat Sumur Resapan</h3>
                    <p>Sumur resapan berfungsi menyerap air hujan ke dalam tanah sehingga mengurangi limpasan air ke saluran drainase. Setiap rumah di Jakarta sebaiknya memiliki minimal 1 sumur resapan dengan spesifikasi:</p>
                    <ul>
                        <li>Kedalaman: 3-5 meter</li>
                        <li>Diameter: 80-100 cm</li>
                        <li>Jarak dari bangunan: minimal 1 meter</li>
                        <li>Diisi dengan batu kerikil dan pasir</li>
                    </ul>

                    <p>Pemprov DKI Jakarta memberikan insentif berupa pengurangan PBB sebesar 10% bagi warga yang memiliki sumur resapan. Informasi lebih lanjut dapat diakses melalui website jakarta.go.id.</p>

                    <h3>3. Terapkan Biopori</h3>
                    <p>Lubang biopori adalah teknologi sederhana untuk meningkatkan daya serap air. Cara membuatnya:</p>
                    <ul>
                        <li>Buat lubang dengan diameter 10-30 cm sedalam 80-100 cm</li>
                        <li>Pasang pipa PVC berlubang (opsional)</li>
                        <li>Isi dengan sampah organik (daun, sisa sayuran)</li>
                        <li>Buat 5-10 lubang per 100 m² lahan</li>
                    </ul>

                    <p>Selain mencegah banjir, biopori juga menghasilkan kompos alami yang baik untuk tanaman.</p>

                    <h3>4. Kurangi Lahan Kedap Air</h3>
                    <p>Semakin banyak lahan tertutup beton dan aspal, semakin sedikit air yang terserap tanah. Solusinya:</p>
                    <ul>
                        <li>Gunakan paving block berlubang untuk halaman</li>
                        <li>Buat taman kecil atau area hijau di rumah</li>
                        <li>Gunakan grass block untuk area parkir</li>
                        <li>Hindari menutup seluruh halaman dengan keramik</li>
                    </ul>

                    <h3>5. Tanam Pohon dan Vegetasi</h3>
                    <p>Pohon dan tanaman berperan penting dalam menyerap air hujan. Pilih jenis tanaman yang tepat:</p>
                    <ul>
                        <li>Pohon dengan akar dalam: Trembesi, Mahoni, Beringin</li>
                        <li>Tanaman penutup tanah: Rumput gajah, Kacang-kacangan</li>
                        <li>Tanaman hias yang tahan air: Pandan, Lidah Mertua</li>
                    </ul>

                    <h3>6. Sistem Pemanenan Air Hujan</h3>
                    <p>Manfaatkan air hujan dengan membuat sistem penampungan:</p>
                    <ul>
                        <li>Pasang talang air dari atap ke tangki penampung</li>
                        <li>Gunakan air hujan untuk menyiram tanaman, mencuci kendaraan, atau MCK</li>
                        <li>Kapasitas tangki disesuaikan dengan luas atap</li>
                        <li>Pasang filter sederhana untuk menyaring kotoran</li>
                    </ul>

                    <h3>7. Edukasi dan Kesadaran Kolektif</h3>
                    <p>Pencegahan banjir memerlukan kesadaran bersama. Lakukan:</p>
                    <ul>
                        <li>Sosialisasi kepada tetangga tentang bahaya sampah dan pentingnya drainase</li>
                        <li>Bentuk Tim Siaga Banjir di tingkat RT/RW</li>
                        <li>Buat group komunikasi untuk koordinasi saat darurat</li>
                        <li>Ajak anak-anak untuk peduli lingkungan sejak dini</li>
                    </ul>

                    <h3>Peran Pemerintah</h3>
                    <p>Pemprov DKI Jakarta terus melakukan upaya pencegahan struktural seperti:</p>
                    <ul>
                        <li>Normalisasi 13 sungai yang melintasi Jakarta</li>
                        <li>Pembangunan 6 waduk dan situ baru</li>
                        <li>Instalasi 1.200 pompa air di titik-titik strategis</li>
                        <li>Pembuatan sumur resapan komunal</li>
                        <li>Aplikasi Jakarta Kini untuk monitoring banjir real-time</li>
                    </ul>

                    <p>"Namun semua upaya pemerintah tidak akan maksimal tanpa partisipasi masyarakat. Mari kita jaga Jakarta bersama dari banjir," ajak Gubernur DKI Jakarta dalam kampanye #JakartaBebaBanjir.</p>

                    <p><strong>Kesimpulan:</strong> Pencegahan banjir adalah tanggung jawab bersama. Dengan langkah-langkah sederhana yang konsisten, kita dapat mengurangi risiko banjir dan melindungi lingkungan kita.</p>
                `
            },
            6: {
                title: "Status Siaga 2 di 5 Wilayah Jakarta",
                date: "21 Januari 2026",
                image: "img/gambar1.png",
                content: `
                    <img src="img/gambar1.png" alt="Status Siaga Banjir">
                    
                    <p><strong>Jakarta</strong> - BPBD DKI Jakarta menetapkan status Siaga 2 (waspada) di lima wilayah Jakarta yang berpotensi mengalami banjir dalam 24-48 jam ke depan. Penetapan status ini berdasarkan analisis prediksi cuaca BMKG dan monitoring ketinggian air sungai.</p>

                    <h3>Wilayah Status Siaga 2</h3>
                    <p>Lima wilayah yang ditetapkan dalam status Siaga 2 adalah:</p>

                    <p><strong>1. Jakarta Utara</strong><br>
                    Ketinggian air di Kali Sunter mencapai 245 cm dari normal 180 cm (Siaga 3: 250 cm, Siaga 1: 300 cm). Wilayah yang perlu waspada: Kelapa Gading, Tanjung Priok, Penjaringan, Koja, Pademangan.</p>

                    <p><strong>2. Jakarta Timur</strong><br>
                    Debit air Sungai Ciliwung di Pintu Air Manggarai mencatat 80 m³/detik dari normal 40 m³/detik. Daerah rawan: Cawang, Kampung Melayu, Bukit Duri, Cipinang Melayu, Duren Sawit.</p>

                    <p><strong>3. Jakarta Barat</strong><br>
                    Kali Pesanggrahan di Pos Duga Air Pesanggrahan mencapai ketinggian 215 cm (Siaga 3: 230 cm). Area waspada: Kalideres, Cengkareng, Kembangan, Tambora, Grogol Petamburan.</p>

                    <p><strong>4. Jakarta Selatan</strong><br>
                    Meskipun relatif aman, beberapa titik di dataran rendah perlu diwaspadai: Kebayoran Lama, Cilandak (dekat Kali Krukut), Jagakarsa, Mampang Prapatan.</p>

                    <p><strong>5. Jakarta Pusat</strong><br>
                    Pintu Air Manggarai sebagai muara Ciliwung mencatat kenaikan signifikan. Daerah rawan: Kemayoran, Sawah Besar, Tanah Abang, Gambir.</p>

                    <h3>Pengertian Status Siaga</h3>
                    <p>BPBD DKI Jakarta menerapkan 4 tingkat status siaga banjir:</p>
                    <ul>
                        <li><strong>Siaga 4 (Normal):</strong> Tidak ada ancaman banjir</li>
                        <li><strong>Siaga 3 (Waspada):</strong> Potensi banjir dalam 3-7 hari</li>
                        <li><strong>Siaga 2 (Siaga):</strong> Potensi banjir dalam 24-48 jam</li>
                        <li><strong>Siaga 1 (Awas):</strong> Banjir sudah terjadi atau akan terjadi dalam 6-12 jam</li>
                    </ul>

                    <h3>Langkah Antisipasi BPBD</h3>
                    <p>Menanggapi penetapan Siaga 2, BPBD telah melakukan langkah-langkah berikut:</p>
                    <ul>
                        <li>Mengaktifkan 44 posko siaga banjir 24 jam</li>
                        <li>Mengerahkan 300 personel gabungan ke lokasi rawan</li>
                        <li>Menyiapkan 25 perahu karet dan 5 truk amfibi</li>
                        <li>Mengoperasikan 180 pompa air mobile</li>
                        <li>Membuka 12 titik pengungsian dengan kapasitas 2.000 orang</li>
                        <li>Koordinasi dengan PLN untuk antisipasi pemadaman darurat</li>
                        <li>Menyiapkan dapur umum dan logistik bantuan</li>
                    </ul>

                    <h3>Imbauan kepada Masyarakat</h3>
                    <p>Kepala Pelaksana BPBD DKI Jakarta mengimbau masyarakat di wilayah Siaga 2 untuk:</p>
                    <ul>
                        <li>Memantau informasi cuaca dan status banjir melalui aplikasi Jakarta Kini atau JAKI</li>
                        <li>Menyiapkan tas darurat berisi dokumen penting, obat-obatan, dan pakaian ganti</li>
                        <li>Mengamankan barang berharga dan elektronik ke tempat tinggi</li>
                        <li>Memastikan jalur evakuasi ke tempat yang lebih tinggi</li>
                        <li>Menyimpan nomor kontak darurat: BPBD (021-6560777), Posko Banjir (112)</li>
                        <li>Tidak membuang sampah ke saluran air</li>
                        <li>Mengikuti arahan petugas jika diminta evakuasi</li>
                    </ul>

                    <h3>Monitoring Real-Time</h3>
                    <p>Masyarakat dapat memantau kondisi terkini melalui:</p>
                    <ul>
                        <li><strong>Website:</strong> banjir.jakarta.go.id</li>
                        <li><strong>Aplikasi:</strong> Jakarta Kini (Android/iOS)</li>
                        <li><strong>Twitter:</strong> @humasjakarta, @BPBDJakarta</li>
                        <li><strong>Call Center:</strong> 112 (24 jam)</li>
                    </ul>

                    <p>Sistem monitoring otomatis BPBD mencatat ketinggian air di 80 titik sungai dan saluran utama secara real-time. Data diperbarui setiap 15 menit dan dapat diakses publik.</p>

                    <h3>Prediksi Cuaca</h3>
                    <p>Menurut BMKG, hujan dengan intensitas sedang-lebat masih berpotensi terjadi hingga 3 hari ke depan. Puncak hujan diperkirakan pada malam hari pukul 18.00-24.00 WIB. Total akumulasi hujan diprediksi mencapai 100-150 mm dalam 72 jam.</p>

                    <p>"Kami memohon kesadaran seluruh warga Jakarta untuk bersama-sama menjaga kebersihan saluran air dan tidak membuang sampah sembarangan. Banjir adalah tanggung jawab kita bersama," tegas Kepala Pelaksana BPBD DKI Jakarta.</p>

                    <p><em>Status Siaga 2 akan dievaluasi setiap 6 jam dan dapat ditingkatkan atau diturunkan sesuai kondisi aktual di lapangan.</em></p>
                `
            }
        };

        // Open Modal Function
        function openModal(articleId) {
            const article = articles[articleId];
            if (!article) return;

            document.getElementById('modalTitle').textContent = article.title;
            document.getElementById('modalDate').innerHTML = `<i class="fas fa-calendar"></i> ${article.date}`;
            document.getElementById('modalBody').innerHTML = article.content;
            document.getElementById('newsModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Close Modal Function
        function closeModal() {
            document.getElementById('newsModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('newsModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Close with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
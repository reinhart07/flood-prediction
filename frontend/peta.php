<?php 
$title = "Peta Rawan Banjir - FloodGuard Jakarta";
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* Map specific styles */
        .map-layout {
            display: flex;
            min-height: 600px;
            background: var(--lighter-bg);
        }
        
        .map-sidebar {
            width: 320px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            overflow-y: auto;
            box-shadow: var(--shadow-md);
        }
        
        .map-container {
            flex: 1;
            position: relative;
            min-height: 600px;
        }
        
        #flood-map {
            width: 100%;
            height: 100%;
            min-height: 600px;
        }
        
        /* Responsive */
        @media (max-width: 968px) {
            .map-layout {
                flex-direction: column;
            }
            .map-sidebar {
                width: 100%;
                max-height: 400px;
            }
            .map-container {
                min-height: 500px;
            }
        }
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
            <h1><i class="fas fa-map-marked-alt"></i> Peta Rawan Banjir Jakarta</h1>
            <p>Visualisasi wilayah rawan banjir dan monitoring real-time</p>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="map-layout">
            <!-- Sidebar -->
            <div class="map-sidebar">
                <div class="sidebar-header">
                    <h3><i class="fas fa-layer-group"></i> Layer Peta</h3>
                </div>
                
                <div class="sidebar-content">
                    <!-- Region Filter -->
                    <div class="sidebar-section">
                        <h4>Wilayah Jakarta</h4>
                        <div class="region-filter">
                            <label class="checkbox-label">
                                <input type="checkbox" class="region-toggle" value="jakarta-selatan" checked>
                                <span>Jakarta Selatan</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" class="region-toggle" value="jakarta-utara" checked>
                                <span>Jakarta Utara</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" class="region-toggle" value="jakarta-pusat" checked>
                                <span>Jakarta Pusat</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" class="region-toggle" value="jakarta-timur" checked>
                                <span>Jakarta Timur</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" class="region-toggle" value="jakarta-barat" checked>
                                <span>Jakarta Barat</span>
                            </label>
                        </div>
                    </div>

                    <!-- Risk Level Legend -->
                    <div class="sidebar-section">
                        <h4>Tingkat Risiko</h4>
                        <div class="legend">
                            <div class="legend-item">
                                <span class="legend-color" style="background: #27ae60;"></span>
                                <span>Rendah (Low)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background: #f39c12;"></span>
                                <span>Sedang (Medium)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background: #e74c3c;"></span>
                                <span>Tinggi (High)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background: #8e44ad;"></span>
                                <span>Sangat Tinggi (Critical)</span>
                            </div>
                        </div>
                    </div>

                    <!-- BMKG Stations -->
                    <div class="sidebar-section">
                        <h4>Stasiun BMKG</h4>
                        <div class="station-list">
                            <div class="station-item">
                                <i class="fas fa-broadcast-tower"></i>
                                <div class="station-info">
                                    <strong>Klimatologi Banten</strong>
                                    <small>Jakarta Selatan</small>
                                </div>
                            </div>
                            <div class="station-item">
                                <i class="fas fa-broadcast-tower"></i>
                                <div class="station-info">
                                    <strong>Tanjung Priok</strong>
                                    <small>Jakarta Utara</small>
                                </div>
                            </div>
                            <div class="station-item">
                                <i class="fas fa-broadcast-tower"></i>
                                <div class="station-info">
                                    <strong>Kemayoran</strong>
                                    <small>Jakarta Pusat</small>
                                </div>
                            </div>
                            <div class="station-item">
                                <i class="fas fa-broadcast-tower"></i>
                                <div class="station-info">
                                    <strong>Halim Perdana Kusuma</strong>
                                    <small>Jakarta Timur</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="sidebar-section">
                        <h4>Statistik Hari Ini</h4>
                        <div class="quick-stats">
                            <div class="stat-mini">
                                <i class="fas fa-cloud-rain"></i>
                                <div>
                                    <strong>12.5</strong>
                                    <small>Curah Hujan (mm)</small>
                                </div>
                            </div>
                            <div class="stat-mini">
                                <i class="fas fa-tint"></i>
                                <div>
                                    <strong>78</strong>
                                    <small>Kelembaban (%)</small>
                                </div>
                            </div>
                            <div class="stat-mini">
                                <i class="fas fa-thermometer-half"></i>
                                <div>
                                    <strong>28.5</strong>
                                    <small>Suhu (°C)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Container -->
            <div class="map-container">
                <div id="flood-map"></div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="map-info-section">
        <div class="container">
            <h2 class="section-title">Wilayah Rawan Banjir Jakarta</h2>
            <div class="flood-prone-grid">
            <div class="prone-card">
                <h4><i class="fas fa-map-pin"></i> Jakarta Utara</h4>
                <p><strong>Tingkat Risiko: Sangat Tinggi</strong></p>
                <ul>
                    <li>Kelapa Gading</li>
                    <li>Penjaringan</li>
                    <li>Koja</li>
                    <li>Tanjung Priok</li>
                </ul>
                <small>Rob dan banjir kiriman sungai</small>
            </div>

            <div class="prone-card">
                <h4><i class="fas fa-map-pin"></i> Jakarta Timur</h4>
                <p><strong>Tingkat Risiko: Tinggi</strong></p>
                <ul>
                    <li>Cawang</li>
                    <li>Kampung Melayu</li>
                    <li>Cipinang Melayu</li>
                    <li>Duren Sawit</li>
                </ul>
                <small>Dekat aliran Sungai Ciliwung</small>
            </div>

            <div class="prone-card">
                <h4><i class="fas fa-map-pin"></i> Jakarta Barat</h4>
                <p><strong>Tingkat Risiko: Tinggi</strong></p>
                <ul>
                    <li>Kalideres</li>
                    <li>Cengkareng</li>
                    <li>Tambora</li>
                    <li>Grogol Petamburan</li>
                </ul>
                <small>Luapan Kali Pesanggrahan</small>
            </div>

            <!-- TAMBAHKAN INI -->
            <div class="prone-card">
                <h4><i class="fas fa-map-pin"></i> Jakarta Pusat</h4>
                <p><strong>Tingkat Risiko: Sedang</strong></p>
                <ul>
                    <li>Kemayoran</li>
                    <li>Sawah Besar</li>
                    <li>Tanah Abang</li>
                    <li>Gambir</li>
                </ul>
                <small>Banjir lokal dekat Kali Ciliwung</small>
            </div>

            <div class="prone-card">
                <h4><i class="fas fa-map-pin"></i> Jakarta Selatan</h4>
                <p><strong>Tingkat Risiko: Sedang</strong></p>
                <ul>
                    <li>Kebayoran Lama</li>
                    <li>Cilandak</li>
                    <li>Jagakarsa</li>
                    <li>Mampang Prapatan</li>
                </ul>
                <small>Banjir lokal saat hujan deras</small>
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
                    <p>Sistem prediksi banjir berbasis AI.</p>
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
                        <img src="../frontend/img/coris.png" alt="CORIS" class="partner-logo">
                        <img src="../frontend/img/klabat.png" alt="Klabat" class="partner-logo">
                        <img src="../frontend/img/dipa.png" alt="Dipa" class="partner-logo">
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 FloodGuard Jakarta</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="js/main.js"></script>
    <script>
        console.log('🗺️ Initializing map...');
        
        // Initialize map centered on Jakarta
        const map = L.map('flood-map').setView([-6.2088, 106.8456], 11);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);

        // Jakarta regions with flood risk levels
        const jakartaRegions = [
            {
                name: 'Jakarta Utara',
                coords: [-6.138, 106.863],
                risk: 'Critical',
                color: '#8e44ad'
            },
            {
                name: 'Jakarta Timur',
                coords: [-6.225, 106.900],
                risk: 'High',
                color: '#e74c3c'
            },
            {
                name: 'Jakarta Barat',
                coords: [-6.168, 106.760],
                risk: 'High',
                color: '#e74c3c'
            },
            {
                name: 'Jakarta Selatan',
                coords: [-6.290, 106.813],
                risk: 'Medium',
                color: '#f39c12'
            },
            {
                name: 'Jakarta Pusat',
                coords: [-6.186, 106.834],
                risk: 'Medium',
                color: '#f39c12'
            }
        ];

        // Add markers for each region
        jakartaRegions.forEach(region => {
            const marker = L.circleMarker(region.coords, {
                radius: 15,
                fillColor: region.color,
                color: '#2c3e50',
                weight: 2,
                opacity: 1,
                fillOpacity: 0.7
            }).addTo(map);

            marker.bindPopup(`
                <div style="text-align: center; padding: 0.5rem;">
                    <strong style="font-size: 1.1rem; color: #0f172a;">${region.name}</strong><br>
                    <span style="color: ${region.color}; font-weight: 600;">Risiko: ${region.risk}</span>
                </div>
            `);
        });

        // BMKG Stations
        const stations = [
            { name: 'Klimatologi Banten', coords: [-6.290, 106.813], area: 'Jakarta Selatan' },
            { name: 'Tanjung Priok', coords: [-6.117, 106.883], area: 'Jakarta Utara' },
            { name: 'Kemayoran', coords: [-6.167, 106.845], area: 'Jakarta Pusat' },
            { name: 'Halim Perdana Kusuma', coords: [-6.266, 106.891], area: 'Jakarta Timur' }
        ];

        stations.forEach(station => {
            const icon = L.divIcon({
                html: '<i class="fas fa-broadcast-tower" style="color: #3b82f6; font-size: 20px;"></i>',
                iconSize: [20, 20],
                className: 'station-marker'
            });

            L.marker(station.coords, { icon: icon })
                .addTo(map)
                .bindPopup(`
                    <strong>${station.name}</strong><br>
                    <small>${station.area}</small>
                `);
        });

        console.log('✅ Map loaded successfully');

    // ========================================
// REAL-TIME WEATHER DATA
// ========================================

// OpenWeatherMap API (FREE - 1000 calls/day)
const WEATHER_API_KEY = '074177402513008ac3c0df9dde13b8dc'; // Daftar di openweathermap.org
const JAKARTA_COORDS = { lat: -6.2088, lon: 106.8456 };

async function updateWeatherStats() {
    try {
        console.log('🌤️ Fetching real-time weather data...');
        
        const response = await fetch(
            `https://api.openweathermap.org/data/2.5/weather?lat=${JAKARTA_COORDS.lat}&lon=${JAKARTA_COORDS.lon}&appid=${WEATHER_API_KEY}&units=metric`
        );
        
        if (!response.ok) {
            throw new Error('Weather API error');
        }
        
        const data = await response.json();
        
        // Extract weather data
        const rainfall = data.rain ? data.rain['1h'] || 0 : 0; // Rainfall last 1 hour (mm)
        const humidity = data.main.humidity; // Humidity (%)
        const temperature = data.main.temp; // Temperature (°C)
        
        console.log('Weather data:', { rainfall, humidity, temperature });
        
        // Update UI
        document.querySelector('.quick-stats .stat-mini:nth-child(1) strong').textContent = rainfall.toFixed(1);
        document.querySelector('.quick-stats .stat-mini:nth-child(2) strong').textContent = humidity;
        document.querySelector('.quick-stats .stat-mini:nth-child(3) strong').textContent = temperature.toFixed(1);
        
        // Add timestamp
        const timestamp = new Date().toLocaleTimeString('id-ID');
        const existingTime = document.querySelector('.weather-update-time');
        if (existingTime) {
            existingTime.textContent = `Update: ${timestamp}`;
        } else {
            const timeDiv = document.createElement('div');
            timeDiv.className = 'weather-update-time';
            timeDiv.style.cssText = 'text-align: center; padding: 0.5rem; color: #64748b; font-size: 0.85rem;';
            timeDiv.textContent = `Update: ${timestamp}`;
            document.querySelector('.quick-stats').appendChild(timeDiv);
        }
        
        console.log('✅ Weather stats updated');
        
    } catch (error) {
        console.error('❌ Weather update error:', error);
        // Keep dummy data if API fails
    }
}

    // Update weather data immediately
    updateWeatherStats();

    // Auto-update every 5 minutes (300000ms)
    setInterval(updateWeatherStats, 300000);

    // Add visual indicator that data is real-time
    const statsSection = document.querySelector('.sidebar-section:has(.quick-stats) h4');
    if (statsSection) {
        statsSection.innerHTML = '<i class="fas fa-sync-alt live-icon"></i> Statistik Real-Time';
        
        // Add pulsing animation
        const style = document.createElement('style');
        style.textContent = `
            .live-icon {
                color: #10b981;
                animation: pulse 2s infinite;
            }
            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }
        `;
        document.head.appendChild(style);
    }
    </script>
</body>
</html>
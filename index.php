<?php 
$title = "FloodGuard Jakarta - AI-Based Flood Prediction System";
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
                <li><a href="#">Home</a></li>
                <li><a href="frontend/about.php">About</a></li>
                <li><a href="frontend/prediksi.php">Flood Prediction</a></li>
                <li><a href="frontend/peta.php">Flood Risk Map</a></li>
                <li><a href="frontend/berita.php">News</a></li>
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
                    <h1 class="fade-in">Protect Jakarta from Floods</h1>
                    <p class="fade-in-delay">AI-based flood prediction system to prevent disaster impacts</p>
                    <a href="frontend/prediksi.php" class="btn btn-primary fade-in-delay-2">
                        <i class="fas fa-cloud-rain"></i> Check Prediction Now
                    </a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="../frontend/img/gambar2.png" alt="Banjir Jakarta 2">
                <div class="carousel-overlay"></div>
                <div class="carousel-content">
                    <h1 class="fade-in">AI Technology for Safety</h1>
                    <p class="fade-in-delay">Machine Learning with 88.49% accuracy in flood prediction</p>
                    <a href="frontend/about.php" class="btn btn-primary fade-in-delay-2">
                        <i class="fas fa-info-circle"></i> Learn More
                    </a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="../frontend/img/gambar3.png" alt="Banjir Jakarta 3">
                <div class="carousel-overlay"></div>
                <div class="carousel-content">
                    <h1 class="fade-in">Jakarta Real-Time Data</h1>
                    <p class="fade-in-delay">Weather and flood condition monitoring from 4 BMKG stations</p>
                    <a href="frontend/peta.php" class="btn btn-primary fade-in-delay-2">
                        <i class="fas fa-map-marked-alt"></i> View Map
                    </a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="../frontend/img/gambar4.png" alt="Banjir Jakarta 4">
                <div class="carousel-overlay"></div>
                <div class="carousel-content">
                    <h1 class="fade-in">Together Prevent Floods</h1>
                    <p class="fade-in-delay">Community participation for a safer Jakarta</p>
                    <a href="frontend/berita.php" class="btn btn-primary fade-in-delay-2">
                        <i class="fas fa-newspaper"></i> Latest News
                    </a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="../frontend/img/gambar5.png" alt="Banjir Jakarta 5">
                <div class="carousel-overlay"></div>
                <div class="carousel-content">
                    <h1 class="fade-in">Flood Alert 24/7</h1>
                    <p class="fade-in-delay">Early warning system to protect your family</p>
                    <a href="frontend/prediksi.php" class="btn btn-primary fade-in-delay-2">
                        <i class="fas fa-exclamation-triangle"></i> Check Hazard Status
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
                <h2>Why Do Floods Occur in Jakarta?</h2>
                <div class="header-line"></div>
            </div>
            
            <div class="flood-info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-cloud-showers-heavy"></i>
                    </div>
                    <h3>High Rainfall</h3>
                    <p>Jakarta experiences extreme rainfall, especially during the rainy season (December-February), with intensities reaching over 100mm/day, which can trigger major floods.</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h3>Land Subsidence</h3>
                    <p>Jakarta experiences land subsidence up to 10-20 cm per year due to excessive groundwater exploitation, making low-lying areas increasingly vulnerable to flooding.</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-city"></i>
                    </div>
                    <h3>Massive Urbanization</h3>
                    <p>Massive urbanization reduces water absorption areas. Concrete and asphalt cover the soil, preventing rainwater from being absorbed and causing it to flow directly into rivers.</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <h3>Poor Drainage System</h3>
                    <p>Many water channels are clogged with garbage and sedimentation. Channel capacity cannot accommodate water discharge during heavy rain, causing overflow into settlements.</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-house-flood-water"></i>
                    </div>
                    <h3>Settlements on Riverbanks</h3>
                    <p>Thousands of houses are built on the banks of 13 rivers crossing Jakarta, blocking water flow and worsening flood risk when rivers overflow.</p>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-globe-asia"></i>
                    </div>
                    <h3>Climate Change</h3>
                    <p>Global warming increases the intensity and frequency of extreme weather. Rainfall patterns become unpredictable with more frequent extreme rainfall events.</p>
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
                    <p>Model Accuracy (%)</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="stat-number" data-target="6308">0</h3>
                    <p>Training Data</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="stat-number" data-target="5">0</h3>
                    <p>Years of Data (2016-2020)</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="stat-number" data-target="4">0</h3>
                    <p>BMKG Stations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-header">
                <h2>FloodGuard Features</h2>
                <div class="header-line"></div>
                <p>Comprehensive system for Jakarta flood mitigation</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>AI Prediction</h3>
                    <p>Machine Learning with Random Forest to predict flood probability based on real-time weather data.</p>
                    <a href="frontend/prediksi.php" class="feature-link">Try Now <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-map"></i>
                    </div>
                    <h3>Interactive Map</h3>
                    <p>Visualization of flood-prone areas in Jakarta with geographic data from 34 provinces of Indonesia.</p>
                    <a href="frontend/peta.php" class="feature-link">View Map <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3>Smart Chatbot</h3>
                    <p>Virtual assistant powered by Google Gemini AI to answer questions about floods and prevention.</p>
                    <a href="#chatbot" class="feature-link" id="open-chatbot">Ask Now <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Early Warning</h3>
                    <p>Automatic notifications when the system detects potential high flood risk in your area.</p>
                    <a href="frontend/berita.php" class="feature-link">Latest Info <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Protect Jakarta from Floods?</h2>
                <p>Use AI technology for accurate flood predictions and protect your family</p>
                <div class="cta-buttons">
                    <a href="frontend/prediksi.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-chart-line"></i> Start Prediction
                    </a>
                    <a href="frontend/about.php" class="btn btn-secondary btn-lg">
                        <i class="fas fa-info-circle"></i> Learn More
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
                    Hello! I am FloodGuard assistant. How can I help you about Jakarta floods?
                </div>
            </div>
        </div>
        <div class="chatbot-input">
            <input type="text" id="chatbot-input-field" placeholder="Type your question...">
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
                    <p>AI-based flood prediction system to protect Jakarta from flood disaster impacts.</p>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="frontend/about.php">About</a></li>
                        <li><a href="frontend/prediksi.php">Prediction</a></li>
                        <li><a href="frontend/peta.php">Map</a></li>
                        <li><a href="frontend/berita.php">News</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Emergency Contact</h4>
                    <ul>
                        <li><i class="fas fa-phone"></i> BPBD DKI: 021-6560777</li>
                        <li><i class="fas fa-phone"></i> Flood Emergency: 112</li>
                        <li><i class="fas fa-envelope"></i> info@floodguard.id</li>
                        <li><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Supported By</h4>
                    <div class="partner-logos">
                        <img src="frontend/img/coris.png" alt="CORIS" class="partner-logo">
                        <img src="frontend/img/klabat.png" alt="Universitas Klabat" class="partner-logo">
                        <img src="frontend/img/dipa.png" alt="Universitas Dipa" class="partner-logo">
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; © 2026 FloodGuard Jakarta. Developed for PROXO x CORIS 2026 International Competition.</p>
                <p>Powered by AI & Machine Learning</p>
            </div>
        </div>
    </footer>

    <script src="frontend/js/main.js"></script>
    <script src="frontend/js/chatbot.js"></script>
</body>
</html>
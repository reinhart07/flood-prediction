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
                <li><a href="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? '#' : '../index.php' ?>">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="prediksi.php">Flood Prediction</a></li>
                <li><a href="peta.php">Flood Risk Map</a></li>
                <li><a href="berita.php">News</a></li>
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
            <h1><i class="fas fa-info-circle"></i> About FloodGuard Jakarta</h1>
            <p>Artificial Intelligence Based Flood Prediction System</p>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-content">
        <div class="container">
            <!-- Project Overview -->
            <div class="about-section">
                <div class="about-grid">
                    <div class="about-text">
                        <h2>What is FloodGuard?</h2>
                        <p>FloodGuard Jakarta is an innovative platform that combines <strong>Artificial Intelligence (AI)</strong> and <strong>Machine Learning</strong> technologies to predict flood potential in Jakarta.</p>
                        <p>Developed as part of the <strong>PROXO x CORIS 2026 International Competition</strong> with the theme <em>"Bridging Gaps: Code for Earth, Intelligence for Justice, and Sustainability for Shaping Tomorrow"</em>, FloodGuard aims to reduce flood disaster impacts through an accurate early warning system.</p>
                        <p>By leveraging historical data from BMKG over 5 years (2016-2020) and Random Forest algorithms, our system can predict floods with an accuracy of <strong>88.49%</strong>.</p>
                    </div>
                    <div class="about-image">
                        <div class="stats-highlight">
                            <div class="stat-item">
                                <h3>88.49%</h3>
                                <p>Model Accuracy</p>
                            </div>
                            <div class="stat-item">
                                <h3>6,308</h3>
                                <p>Training Data</p>
                            </div>
                            <div class="stat-item">
                                <h3>4</h3>
                                <p>BMKG Stations</p>
                            </div>
                            <div class="stat-item">
                                <h3>5 Tahun</h3>
                                <p>Historical Data</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team Section - DEVELOPER -->
            <section class="team-section">
                <div class="container">
                    <div class="section-header">
                        <h2>Development Team</h2>
                        <div class="header-line"></div>
                        <p>Developed with dedication for PROXO x CORIS 2026</p>
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
                                <p>I am a passionate student in the field of technology and web development. 
                                   FloodGuard Jakarta is a project that I developed for the PROXO x CORIS 2026 competition with the aim of utilizing AI technology to help the people of Jakarta mitigate flood disasters.</p>
                                
                                <p>By combining Machine Learning, modern Web Development, and real-time data, I hope FloodGuard can become a useful solution for the wider community.</p>
                            </div>

                            <div class="developer-skills">
                                <h4><i class="fas fa-tools"></i> Tech Stack Used:</h4>
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
                                    <small>Code Line</small>
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
                                    <strong>1 Month</strong>
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
                                <p>"Technology must provide real solutions to real problems. FloodGuard is my effort to contribute to protecting Jakarta from flooding using the power of AI and data science."</p>
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
                    <h3>Vision</h3>
                    <p>Being the leading platform in AI-based early flood warning systems to protect Jakarta and Indonesia's communities from flood impacts.</p>
                </div>
                <div class="mv-card">
                    <div class="mv-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>Mission</h3>
                    <ul>
                        <li>Providing accurate flood predictions based on real-time data</li>
                        <li>Increasing public awareness about flood mitigation</li>
                        <li>Supporting government in emergency decision-making</li>
                        <li>Developing sustainable technology for climate resilience</li>
                    </ul>
                </div>
            </div>

            <!-- Technology Stack -->
            <div class="about-section">
                <h2 class="section-title">Technology Used</h2>
                <div class="tech-grid">
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h4>Machine Learning</h4>
                        <p><strong>Random Forest Classifier</strong> with 200 decision trees for accurate predictions based on historical data patterns.</p>
                    </div>
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fab fa-python"></i>
                        </div>
                        <h4>Python & Flask</h4>
                        <p>Backend ML service using <strong>Flask</strong>, <strong>scikit-learn</strong>, dan <strong>pandas</strong> for data processing.</p>
                    </div>
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fab fa-php"></i>
                        </div>
                        <h4>PHP Native</h4>
                        <p>Web backend with native PHP for ML API integration and database management.</p>
                    </div>
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h4>Leaflet.js</h4>
                        <p>Interactive mapping using <strong>Leaflet.js</strong> with GeoJSON data from 34 Indonesian provinces.</p>
                    </div>
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h4>Google Gemini AI</h4>
                        <p>Smart chatbot powered by<strong>Gemini API</strong> to answer questions about flooding.</p>
                    </div>
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4>BMKG Data</h4>
                        <p>Real dataset from 4 BMKG Jakarta stations with 6,308 records (2016-2020).</p>
                    </div>
                </div>
            </div>

            <!-- How It Works -->
            <div class="about-section">
                <h2 class="section-title">How FloodGuard Works</h2>
                <div class="workflow">
                    <div class="workflow-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Input Weather Data</h4>
                            <p>Users input weather data (rainfall, humidity, temperature) or use real-time data from the API.</p>
                        </div>
                    </div>
                    <div class="workflow-arrow">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="workflow-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Preprocessing Data</h4>
                            <p>Data is normalized and scaled using StandardScaler to ensure input consistency.</p>
                        </div>
                    </div>
                    <div class="workflow-arrow">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="workflow-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>ML Prediction</h4>
                            <p>Model Random Forest analyzes data and generates flood probability (0-100%).</p>
                        </div>
                    </div>
                    <div class="workflow-arrow">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="workflow-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h4>Risk Assessment</h4>
                            <p>System classifies risks: <span class="badge-low">Low</span>, <span class="badge-medium">Medium</span>, or <span class="badge-high">High</span>.</p>
                        </div>
                    </div>
                    <div class="workflow-arrow">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="workflow-step">
                        <div class="step-number">5</div>
                        <div class="step-content">
                            <h4>Results & Recommendations</h4>
                            <p>Users receive complete prediction results with prevention action recommendations.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Model Performance -->
            <div class="about-section">
                <h2 class="section-title">Model Performance</h2>
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
                    The model is trained using the Random Forest algorithm with 200 estimators, max_depth 15, and SMOTE for handling rewarded data.
                </p>
            </div>

            <!-- Dataset Info -->
            <div class="about-section">
                <h2 class="section-title">Dataset & Features</h2>
                <div class="dataset-info">
                    <div class="dataset-overview">
                        <h4>Sumber Data</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> <strong>BMKG</strong> (Meteorology, Climatology and Geophysics Agency)</li>
                            <li><i class="fas fa-check"></i> <strong> 4 Monitoring Stations:</strong>
                                <ul>
                                    <li>Banten Climatology Station (South Jakarta)</li>
                                    <li>Tanjung Priok Maritime Meteorological Station (North Jakarta)</li>
                                    <li>Kemayoran Meteorological Station (Central Jakarta)</li>
                                    <li>Halim Perdana Kusuma (East Jakarta)</li>
                                </ul>
                            </li>
                            <li><i class="fas fa-check"></i> <strong>Period:</strong> 2016-2020 (5 years)</li>
                            <li><i class="fas fa-check"></i> <strong>Total Records:</strong> 6,308 data</li>
                            <li><i class="fas fa-check"></i> <strong>Flood Events:</strong> 476 flood events (7.55%)</li>
                        </ul>
                    </div>
                    <div class="features-list">
                        <h4>Features Utama</h4>
                        <div class="feature-badges">
                            <span class="feature-badge"><i class="fas fa-tint"></i> Humidity (RH_avg) - 23.6%</span>
                            <span class="feature-badge"><i class="fas fa-temperature-low"></i> Min Temperature (Tn) - 16.5%</span>
                            <span class="feature-badge"><i class="fas fa-thermometer-half"></i> Avg Temperature (Tavg) - 16.1%</span>
                            <span class="feature-badge"><i class="fas fa-cloud-rain"></i> Rainfall (RR) - 12.7%</span>
                            <span class="feature-badge"><i class="fas fa-wind"></i> Wind Speed - 9.0%</span>
                            <span class="feature-badge"><i class="fas fa-sun"></i> Sunshine Duration - 7.3%</span>
                        </div>
                        <p class="feature-note">
                            <i class="fas fa-lightbulb"></i> Percentage shows <strong>Feature Importance</strong> from the Random Forest model.
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
                        <h4>PROXO x CORIS 2026</h4>
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
                <h2 class="section-title">Powered By</h2>
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
                <h2>Ready to Try FloodGuard?</h2>
                <p>Protect your family with accurate flood predictions</p>
                <div class="cta-buttons">
                    <a href="prediksi.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-chart-line"></i> Start Prediction
                    </a>
                    <a href="peta.php" class="btn btn-secondary btn-lg">
                        <i class="fas fa-map"></i> View Map
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
                    <p>AI-based flood prediction system to protect Jakarta.</p>
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
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="prediksi.php">Prediction</a></li>
                        <li><a href="peta.php">Map</a></li>
                        <li><a href="berita.php">News</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Emergency Contact</h4>
                    <ul>
                        <li><i class="fas fa-phone"></i> BPBD DKI: 021-6560777</li>
                        <li><i class="fas fa-phone"></i> Flood Post: 112</li>
                        <li><i class="fas fa-envelope"></i> info@floodguard.id</li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Powered By</h4>
                    <div class="partner-logos">
                        <img src="img/coris.png" alt="CORIS" class="partner-logo">
                        <img src="img/klabat.png" alt="Klabat" class="partner-logo">
                        <img src="img/dipa.png" alt="Dipa" class="partner-logo">
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; © 2026 FloodGuard Jakarta. Developed for PROXO x CORIS 2026.</p>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
    
</body>
</html>
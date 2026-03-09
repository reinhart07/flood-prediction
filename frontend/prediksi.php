<?php 
$title = "Flood Prediction - FloodGuard Jakarta";
?>
<!DOCTYPE html>
<html lang="en">
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
            <h1><i class="fas fa-cloud-rain"></i> Jakarta Flood Prediction</h1>
            <p>Use AI to predict flood probability based on weather conditions</p>
        </div>
    </section>

    <!-- Prediction Section -->
    <section class="prediction-section">
        <div class="container">
            <div class="prediction-grid">
                <!-- Input Form -->
                <div class="prediction-form-card">
                    <div class="card-header">
                        <h2><i class="fas fa-edit"></i> Enter Weather Data</h2>
                        <p>Input weather data to get flood prediction</p>
                    </div>

                    <form id="prediction-form">
                        <!-- SECTION 1: MANDATORY DATA -->
                        <div class="form-section">
                            <h3 class="section-subtitle">
                                <i class="fas fa-exclamation-circle"></i> Mandatory Data
                            </h3>
                            
                            <div class="form-group">
                                <label for="rainfall">
                                    <i class="fas fa-cloud-showers-heavy"></i>
                                    Rainfall (mm)
                                    <span class="required">*</span>
                                    <span class="info-tooltip" title="Amount of rain in millimeters. 0-10mm (light), 10-50mm (moderate), 50+ mm (heavy)">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                </label>
                                <input 
                                    type="number" 
                                    id="rainfall" 
                                    name="RR" 
                                    placeholder="Example: 25.5"
                                    step="0.1"
                                    min="0"
                                    max="500"
                                    required
                                >
                                <small class="hint">Check weather app or BMKG</small>
                            </div>

                            <div class="form-group">
                                <label for="humidity">
                                    <i class="fas fa-tint"></i>
                                    Air Humidity (%)
                                    <span class="required">*</span>
                                    <span class="info-tooltip" title="Percentage of air humidity. Normal: 60-80%, High: 80-95%">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                </label>
                                <input 
                                    type="number" 
                                    id="humidity" 
                                    name="RH_avg" 
                                    placeholder="Example: 78"
                                    step="1"
                                    min="0"
                                    max="100"
                                    required
                                >
                                <small class="hint">Usually shown in weather apps</small>
                            </div>
                        </div>

                        <!-- SECTION 2: TEMPERATURE DATA -->
                        <div class="form-section">
                            <h3 class="section-subtitle">
                                <i class="fas fa-thermometer-half"></i> Temperature Data
                            </h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="temp-avg">
                                        <i class="fas fa-thermometer-half"></i>
                                        Average Temperature (°C)
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
                                        Minimum Temperature (°C)
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
                                        Maximum Temperature (°C)
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
                            <small class="hint">Today's temperature (morning/afternoon/evening)</small>
                        </div>

                        <!-- SECTION 3: ADDITIONAL DATA -->
                        <div class="form-section">
                            <h3 class="section-subtitle">
                                <i class="fas fa-cloud-sun"></i> Other Weather Data
                            </h3>
                            
                            <div class="form-group">
                                <label for="sunshine">
                                    <i class="fas fa-sun"></i>
                                    Sunshine Duration (hours)
                                    <span class="required">*</span>
                                    <span class="info-tooltip" title="How long the sun shines today (0-12 hours)">
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
                                <small class="hint">Average 5-8 hours when clear</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="wind-max">
                                        <i class="fas fa-wind"></i>
                                        Max Wind Speed (m/s)
                                        <span class="required">*</span>
                                        <span class="info-tooltip" title="Highest wind speed today (1-10 m/s = normal, >10 m/s = strong)">
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
                                        Average Wind Speed (m/s)
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
                            <small class="hint">Check weather app or BMKG</small>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" id="predict-btn">
                                <i class="fas fa-chart-line"></i> Predict Now
                            </button>

                            <button type="button" class="btn btn-secondary btn-block" id="use-current-weather">
                                <i class="fas fa-map-marker-alt"></i> Auto-fill from Current Weather
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
                        <h2><i class="fas fa-chart-pie"></i> Prediction Result</h2>
                    </div>

                    <div class="result-content" id="result-content">
                        <!-- Result will be injected here -->
                    </div>

                    <div class="result-actions">
                        <button class="btn btn-secondary" id="reset-form">
                            <i class="fas fa-redo"></i> Predict Again
                        </button>
                        <button class="btn btn-primary" id="save-result">
                            <i class="fas fa-download"></i> Save Result
                        </button>
                    </div>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="info-cards-grid">
                <div class="info-card-small">
                    <i class="fas fa-question-circle"></i>
                    <h4>How to Use</h4>
                    <p>Fill in at least 3 main data (rainfall, humidity, temperature) for accurate prediction.</p>
                </div>
                <div class="info-card-small">
                    <i class="fas fa-clock"></i>
                    <h4>Real-Time Data</h4>
                    <p>Use "Current Weather" button to auto-fill data from BMKG.</p>
                </div>
                <div class="info-card-small">
                    <i class="fas fa-shield-alt"></i>
                    <h4>88.49% Accuracy</h4>
                    <p>AI model trained with 6,308 historical data from 4 BMKG stations.</p>
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
                </div>
                <div class="footer-col">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="prediksi.php">Prediction</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Supported By</h4>
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
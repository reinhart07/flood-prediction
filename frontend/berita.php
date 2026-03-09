<?php 
$title = "Flood News - FloodGuard Jakarta";
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
            <h1><i class="fas fa-newspaper"></i> Flood News & Information</h1>
            <p>Latest updates on Jakarta floods and disaster mitigation</p>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section">
        <div class="container">
            <div class="news-filter">
                <button class="filter-btn active" data-category="all">All</button>
                <button class="filter-btn" data-category="breaking">Breaking News</button>
                <button class="filter-btn" data-category="tips">Tips & Education</button>
                <button class="filter-btn" data-category="update">Weather Update</button>
            </div>

            <div class="news-grid">
                <!-- Featured News -->
                <div class="news-card" data-category="breaking" data-id="1">
                    <div class="news-badge badge-breaking">Breaking News</div>
                    <div class="news-image">
                        <img src="/img/berita1.jpg" alt="Jakarta Flood">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> January 26, 2026</span>
                            <span><i class="fas fa-clock"></i> 2:30 PM WIB</span>
                        </div>
                        <h3>BMKG: Heavy Rain Alert in Jakarta Today</h3>
                        <p>BMKG warns of potential heavy rainfall with moderate to heavy intensity in Jakarta and surrounding areas. The public is advised to be vigilant about potential local flooding...</p>
                        <button class="btn-read-more" onclick="openModal(1)">Read More <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- News Card 1 -->
                <div class="news-card" data-category="update" data-id="2">
                    <div class="news-badge badge-update">Weather Update</div>
                    <div class="news-image">
                        <img src="../img/berita2.jpg" alt="Weather Forecast">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> January 25, 2026</span>
                        </div>
                        <h3>Weather Forecast: Moderate Rain for a Week</h3>
                        <p>BMKG predicts moderate rainfall will last for the next week in Jakarta area...</p>
                        <button class="btn-read-more" onclick="openModal(2)">Read More <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- News Card 2 -->
                <div class="news-card" data-category="tips" data-id="3">
                    <div class="news-badge badge-tips">Tips & Education</div>
                    <div class="news-image">
                        <img src="../img/berita3.png" alt="Flood Tips">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> January 24, 2026</span>
                        </div>
                        <h3>7 Steps to Face Floods at Home</h3>
                        <p>Here are important steps you need to take when floods hit your home...</p>
                        <button class="btn-read-more" onclick="openModal(3)">Read More <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- News Card 3 -->
                <div class="news-card" data-category="breaking" data-id="4">
                    <div class="news-badge badge-breaking">Breaking News</div>
                    <div class="news-image">
                        <img src="../img/berita4.png" alt="Evacuation">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> January 23, 2026</span>
                        </div>
                        <h3>BPBD Evacuates 150 Flood-Affected Residents</h3>
                        <p>BPBD DKI Jakarta successfully evacuated 150 residents from North Jakarta affected by flooding...</p>
                        <button class="btn-read-more" onclick="openModal(4)">Read More <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- News Card 4 -->
                <div class="news-card" data-category="tips" data-id="5">
                    <div class="news-badge badge-tips">Tips & Education</div>
                    <div class="news-image">
                        <img src="../img/berita5.png" alt="Prevention">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> January 22, 2026</span>
                        </div>
                        <h3>How to Prevent Floods in Your Area</h3>
                        <p>Public participation is crucial in preventing floods. Here are some ways you can help...</p>
                        <button class="btn-read-more" onclick="openModal(5)">Read More <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- News Card 5 -->
                <div class="news-card" data-category="update" data-id="6">
                    <div class="news-badge badge-update">Weather Update</div>
                    <div class="news-image">
                        <img src="../img/berita6.png" alt="Flood Status">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fas fa-calendar"></i> January 21, 2026</span>
                        </div>
                        <h3>Alert Level 2 in 5 Jakarta Regions</h3>
                        <p>BPBD establishes alert level 2 in five Jakarta regions potentially experiencing flooding...</p>
                        <button class="btn-read-more" onclick="openModal(6)">Read More <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Emergency Contact Section -->
    <section class="emergency-section">
        <div class="container">
            <h2 class="section-title">Flood Emergency Contacts</h2>
            <div class="emergency-grid">
                <div class="emergency-card">
                    <i class="fas fa-phone-alt"></i>
                    <h4>Jakarta Flood Post</h4>
                    <a href="tel:112" class="emergency-number">112</a>
                    <p>24-hour service</p>
                </div>
                <div class="emergency-card">
                    <i class="fas fa-hospital"></i>
                    <h4>BPBD DKI Jakarta</h4>
                    <a href="tel:021-6560777" class="emergency-number">021-6560777</a>
                    <p>Disaster Management Agency</p>
                </div>
                <div class="emergency-card">
                    <i class="fas fa-ambulance"></i>
                    <h4>Ambulance</h4>
                    <a href="tel:118" class="emergency-number">118</a>
                    <p>Emergency Medical Service</p>
                </div>
                <div class="emergency-card">
                    <i class="fas fa-fire-extinguisher"></i>
                    <h4>Fire Department</h4>
                    <a href="tel:113" class="emergency-number">113</a>
                    <p>Fire & Rescue Service</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="tips-section">
        <div class="container">
            <h2 class="section-title">Flood Response Tips</h2>
            <div class="tips-grid">
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h4>Before Floods</h4>
                    <ul>
                        <li>Monitor weather information from BMKG</li>
                        <li>Prepare emergency bag with important documents</li>
                        <li>Turn off electricity and gas supply</li>
                        <li>Move valuables to higher ground</li>
                        <li>Store food and clean water</li>
                    </ul>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h4>During Floods</h4>
                    <ul>
                        <li>Stay calm and don't panic</li>
                        <li>Avoid walking in deep floodwater</li>
                        <li>Stay away from areas with strong currents</li>
                        <li>Follow instructions from officers</li>
                        <li>Call emergency numbers if you need help</li>
                    </ul>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h4>After Floods</h4>
                    <ul>
                        <li>Clean house from mud and dirt</li>
                        <li>Check electrical condition before turning on</li>
                        <li>Discard food exposed to floodwater</li>
                        <li>Sterilize water before use</li>
                        <li>Beware of post-flood diseases</li>
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
                    <h4>Emergency Contacts</h4>
                    <ul>
                        <li><i class="fas fa-phone"></i> BPBD DKI: 021-6560777</li>
                        <li><i class="fas fa-phone"></i> Flood Post: 112</i>
                        <li><i class="fas fa-envelope"></i> info@floodguard.id</li>
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
                <p>&copy; 2026 FloodGuard Jakarta. Developed for PROX x CORIS 2026.</p>
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
                title: "BMKG: Heavy Rain Alert in Jakarta Today",
                date: "January 26, 2026, 2:30 PM WIB",
                image: "img/berita1.jpg",
                content: `
                    <img src="../img/berita1.jpg" alt="BMKG Warning">
                    
                    <p><strong>Jakarta</strong> - The Meteorology, Climatology, and Geophysics Agency (BMKG) issued an early warning for extreme weather in the DKI Jakarta area today, Sunday, January 26, 2026. Rain intensity is predicted to reach moderate to heavy category with potential for thunderstorms and strong winds.</p>

                    <p>Head of BMKG Jakarta Region, Dr. Ahmad Zakir, explained that this condition is triggered by massive convective cloud growth around Jakarta. "We urge all Jakarta residents to remain vigilant, especially in flood-prone areas," he said at a press conference at the Central Jakarta BMKG office.</p>

                    <h3>Weather Warning Details</h3>
                    <p>According to BMKG data, rainfall is predicted to reach 50-100 mm within 24 hours with peak intensity between 2:00 PM to 6:00 PM WIB. Areas that need attention include:</p>
                    <ul>
                        <li>North Jakarta: Kelapa Gading, Tanjung Priok, Penjaringan</li>
                        <li>East Jakarta: Cawang, Kampung Melayu, Cipinang Melayu</li>
                        <li>West Jakarta: Kalideres, Cengkareng, Tambora</li>
                        <li>South Jakarta: Kebayoran Lama, Cilandak</li>
                        <li>Central Jakarta: Kemayoran, Sawah Besar</li>
                    </ul>

                    <h3>BPBD DKI Jakarta Appeal</h3>
                    <p>Responding to BMKG's warning, the Jakarta Regional Disaster Management Agency (BPBD) has activated all flood alert posts at 44 strategic points. Head of BPBD DKI Jakarta, Isnawa Adji, ensured that all personnel and evacuation equipment have been prepared.</p>

                    <p>"We have deployed 200 joint personnel from BPBD, TNI, Police, and volunteers throughout Jakarta. Portable water pumps and rubber boats are also on standby at flood-prone locations," he explained.</p>

                    <h3>Public Preparedness</h3>
                    <p>BMKG and BPBD advise the public to take the following precautionary measures:</p>
                    <ul>
                        <li>Monitor weather developments regularly through the official BMKG app or bmkg.go.id website</li>
                        <li>Avoid non-urgent outdoor activities</li>
                        <li>Prepare emergency supplies such as flashlights, medicines, and important documents</li>
                        <li>Turn off electronic devices and unplug outlets if water starts rising</li>
                        <li>Follow instructions from officers if asked to evacuate</li>
                    </ul>

                    <p>For more information and current condition reports, the public can contact Jakarta Flood Post at 112 or BPBD DKI Jakarta at 021-6560777 (24 hours).</p>

                    <p><em>This article will be continuously updated according to current situation developments.</em></p>
                `
            },
            2: {
                title: "Weather Forecast: Moderate Rain for a Week",
                date: "January 25, 2026",
                image: "img/berita2.jpg",
                content: `
                    <img src="../img/berita2.jpg" alt="Jakarta Weather Forecast">
                    
                    <p><strong>Jakarta</strong> - BMKG predicts moderate rainfall intensity will last for the next week in Jakarta and surrounding areas. This forecast is based on weather pattern analysis and air mass movement in western Indonesia.</p>

                    <h3>Meteorological Analysis</h3>
                    <p>According to BMKG's Deputy for Meteorology, the ongoing La Niña phenomenon contributes to higher-than-normal rainfall intensity. Cooler sea surface temperatures around Indonesia trigger more active rain cloud formation.</p>

                    <p>"We estimate daily rainfall ranging from 20-50 mm with peaks in the afternoon to evening. The public is advised to remain vigilant, especially in lowland areas," BMKG explained.</p>

                    <h3>Daily Forecast</h3>
                    <ul>
                        <li><strong>Monday, January 27:</strong> Moderate rain, 30-40 mm</li>
                        <li><strong>Tuesday, January 28:</strong> Light to moderate rain, 20-35 mm</li>
                        <li><strong>Wednesday, January 29:</strong> Moderate to heavy rain, 40-50 mm</li>
                        <li><strong>Thursday, January 30:</strong> Moderate rain, 25-40 mm</li>
                        <li><strong>Friday, January 31:</strong> Light to moderate rain, 20-30 mm</li>
                        <li><strong>Saturday, February 1:</strong> Light rain, 15-25 mm</li>
                        <li><strong>Sunday, February 2:</strong> Cloudy, possible light rain</li>
                    </ul>

                    <h3>Impact and Mitigation</h3>
                    <p>BPBD DKI Jakarta has prepared mitigation steps by normalizing waterways, checking water pumps, and cleaning gutters at 1,200 strategic points. Joint teams have also been alerted to anticipate puddles and local flooding.</p>

                    <p>The public is asked not to litter and ensure water channels around their homes remain clear. Current weather information can be monitored through the Info BMKG app or official BMKG website.</p>
                `
            },
            3: {
                title: "7 Steps to Face Floods at Home",
                date: "January 24, 2026",
                image: "img/berita3.png",
                content: `
                    <img src="../img/berita3.png" alt="Flood Response Tips">
                    
                    <p><strong>Jakarta</strong> - Floods are a disaster that often hits Jakarta, especially during the rainy season. Therefore, it's important for every family to understand the right steps in facing floods at home.</p>

                    <h3>1. Preparation Before Floods</h3>
                    <p>The most important step is preparation before floods occur. Make sure you have:</p>
                    <ul>
                        <li>Emergency bag containing important documents (ID card, family card, certificates, insurance policies) in waterproof plastic</li>
                        <li>Complete first aid kit with routine medicines</li>
                        <li>Flashlight or emergency lamp with spare batteries</li>
                        <li>Stock of canned food and drinking water for 3-5 days</li>
                        <li>Fully charged power bank for communication</li>
                        <li>Change of clothes and blankets in waterproof bag</li>
                    </ul>

                    <h3>2. Monitor Weather Information</h3>
                    <p>Always monitor weather forecasts from BMKG through apps or official websites. If there's a heavy rain warning, immediately make additional preparations. Save important contact numbers such as BPBD (021-6560777), Flood Post (112), and ambulance (118).</p>

                    <h3>3. Secure Valuables</h3>
                    <p>Move valuables and electronics to higher places at least 1 meter from the floor. Lift furniture that can be lifted or place on blocks. For large electronic items that cannot be moved, unplug all cables and cover with thick plastic.</p>

                    <h3>4. Turn Off Electricity and Gas Installations</h3>
                    <p>If water starts rising, immediately turn off the main electrical MCB to prevent short circuits and fires. Also turn off the gas valve and ensure there are no open flames in the house. Don't turn electricity back on before ensuring all installations are completely dry.</p>

                    <h3>5. Evacuate Yourself and Family</h3>
                    <p>If water height reaches adult knee level or current is very strong, immediately evacuate to higher ground. Follow designated evacuation routes. Bring only essential items in emergency bag. Don't try to cross strong water currents.</p>

                    <h3>6. Maintain Health</h3>
                    <p>Floodwater contains various contaminants and dangerous bacteria. Avoid direct contact with floodwater, especially if there are open wounds. Use boots and gloves if must pass through water. Don't consume water or food contaminated by floodwater.</p>

                    <h3>7. After Flood Recedes</h3>
                    <p>After water recedes, conduct thorough cleaning with the following steps:</p>
                    <ul>
                        <li>Document damage with photos for insurance claims</li>
                        <li>Clean mud and dirt with clean water and disinfectant</li>
                        <li>Dry the house by opening all windows and doors</li>
                        <li>Check electrical installation by technician before turning on</li>
                        <li>Discard all food exposed to floodwater</li>
                        <li>Sterilize cooking and drinking utensils</li>
                        <li>Beware of post-flood diseases such as diarrhea, leptospirosis, and dengue fever</li>
                    </ul>

                    <p><strong>Remember:</strong> Life safety is the top priority. Don't hesitate to ask for help from officers if the situation is dangerous.</p>
                `
            },
            4: {
                title: "BPBD Evacuates 150 Flood-Affected Residents",
                date: "January 23, 2026",
                image: "img/berita4.png",
                content: `
                    <img src="../img/berita4.png" alt="Resident Evacuation">
                    
                    <p><strong>North Jakarta</strong> - BPBD DKI Jakarta successfully evacuated 150 residents from North Jakarta flooded since Tuesday (23/1) early morning. Flooding occurred due to Kali Sunter overflow after heavy rain poured over Jakarta for 6 consecutive hours.</p>

                    <h3>Flood Chronology</h3>
                    <p>Heavy rain started falling since 11:00 PM WIB Monday night with intensity reaching 85 mm per hour. This condition caused Kali Sunter unable to accommodate the drastically increased water discharge. At 02:30 AM WIB, water began overflowing and inundating residents' settlements in Sunter Agung Village, Tanjung Priok.</p>

                    <p>"Water level reached 1.5 meters at several points. We immediately deployed joint teams for the evacuation process," said Head of BPBD DKI Jakarta Operations, Isnawa Adji, when confirmed at the Flood Response Post.</p>

                    <h3>Evacuation Process</h3>
                    <p>Joint team consisting of 80 personnel from BPBD, TNI, Police, and volunteers were deployed using 12 rubber boats and 3 amphibious trucks. Evacuation went smoothly despite strong water conditions and darkness. Evacuation priority given to:</p>
                    <ul>
                        <li>Pregnant and nursing mothers: 15 people</li>
                        <li>Children and babies: 45 people</li>
                        <li>Elderly and disabled: 28 people</li>
                        <li>Healthy adults: 62 people</li>
                    </ul>

                    <h3>Services at Evacuation Post</h3>
                    <p>All evacuees are housed at Sunter Sports Hall with adequate facilities. DKI Jakarta Social Service has prepared:</p>
                    <ul>
                        <li>150 mattresses and blankets</li>
                        <li>Ready-to-eat meals 3 times a day</li>
                        <li>Clean water and emergency sanitation</li>
                        <li>Health post with 4 doctors and 8 nurses</li>
                        <li>Children's play area</li>
                        <li>Public kitchen</li>
                    </ul>

                    <p>Medical team from local health center also conducted health checks on all evacuees. "Most are in healthy condition, only a few experiencing flu and mild cough," said dr. Anita Sari, medical team coordinator.</p>

                    <h3>Current Conditions</h3>
                    <p>As of this report at 3:00 PM WIB, water level at flood location has receded to 30-50 cm. BPBD has deployed 8 mobile water pumps to accelerate drying process. Residents are estimated to return home on Thursday (24/1) evening after water completely recedes.</p>

                    <p>BPBD also deployed teams to help residents clean houses from mud and garbage. "We will accompany residents until the situation fully recovers," Isnawa Adji emphasized.</p>

                    <h3>Material Losses</h3>
                    <p>Based on preliminary BPBD data, material losses are estimated to reach Rp 3.2 billion with details:</p>
                    <ul>
                        <li>120 house units flooded with minor to moderate damage</li>
                        <li>45 vehicle units (cars and motorcycles) flooded</li>
                        <li>2 food stalls heavily damaged</li>
                        <li>Road and water channel infrastructure damage</li>
                    </ul>

                    <p>DKI Jakarta Provincial Government has stated will provide assistance in the form of cash and groceries to affected residents. Loss data collection still ongoing to ensure assistance reaches the right target.</p>
                `
            },
            5: {
                title: "How to Prevent Floods in Your Area",
                date: "January 22, 2026",
                image: "img/berita5.png",
                content: `
                    <img src="../img/berita5.png" alt="Flood Prevention">
                    
                    <p><strong>Jakarta</strong> - Floods are not only the government's responsibility, but also require active participation from all communities. By taking simple preventive steps, we can reduce flood risks in our surrounding environment.</p>

                    <h3>1. Maintain Water Channel Cleanliness</h3>
                    <p>Garbage clogging gutters is the main cause of local flooding. Conduct routine community service at least once a month to clean water channels in RT/RW neighborhoods. Ensure:</p>
                    <ul>
                        <li>No plastic waste, leaves, or twigs blocking</li>
                        <li>Gutters not shallow due to mud deposits</li>
                        <li>Channel covers in good condition</li>
                        <li>Culverts not clogged</li>
                    </ul>

                    <p>"We invite all Jakarta residents not to litter carelessly. One plastic package you throw into the gutter can block water flow and cause flooding," said Head of DKI Jakarta Environmental Service.</p>

                    <h3>2. Create Infiltration Wells</h3>
                    <p>Infiltration wells function to absorb rainwater into the ground thus reducing water runoff to drainage channels. Every house in Jakarta should have at least 1 infiltration well with specifications:</p>
                    <ul>
                        <li>Depth: 3-5 meters</li>
                        <li>Diameter: 80-100 cm</li>
                        <li>Distance from building: minimum 1 meter</li>
                        <li>Filled with gravel and sand</li>
                    </ul>

                    <p>DKI Jakarta Provincial Government provides incentives in the form of 10% property tax reduction for residents who have infiltration wells. Further information can be accessed through jakarta.go.id website.</p>

                    <h3>3. Apply Biopori</h3>
                    <p>Biopori holes are simple technology to increase water absorption. How to make them:</p>
                    <ul>
                        <li>Make holes with diameter 10-30 cm depth 80-100 cm</li>
                        <li>Install perforated PVC pipes (optional)</li>
                        <li>Fill with organic waste (leaves, vegetable scraps)</li>
                        <li>Make 5-10 holes per 100 m² land</li>
                    </ul>

                    <p>Besides preventing floods, biopori also produces natural compost good for plants.</p>

                    <h3>4. Reduce Impermeable Land</h3>
                    <p>The more land covered by concrete and asphalt, the less water absorbed by soil. Solutions:</p>
                    <ul>
                        <li>Use perforated paving blocks for yards</li>
                        <li>Create small gardens or green areas at home</li>
                        <li>Use grass blocks for parking areas</li>
                        <li>Avoid covering entire yard with ceramics</li>
                    </ul>

                    <h3>5. Plant Trees and Vegetation</h3>
                    <p>Trees and plants play important roles in absorbing rainwater. Choose the right types of plants:</p>
                    <ul>
                        <li>Trees with deep roots: Trembesi, Mahogany, Banyan</li>
                        <li>Ground cover plants: Elephant grass, Legumes</li>
                        <li>Water-resistant ornamental plants: Pandan, Snake Plant</li>
                    </ul>

                    <h3>6. Rainwater Harvesting System</h3>
                    <p>Utilize rainwater by creating storage system:</p>
                    <ul>
                        <li>Install gutters from roof to storage tank</li>
                        <li>Use rainwater for watering plants, washing vehicles, or sanitation</li>
                        <li>Tank capacity adjusted to roof area</li>
                        <li>Install simple filter to screen dirt</li>
                    </ul>

                    <h3>7. Education and Collective Awareness</h3>
                    <p>Flood prevention requires collective awareness. Do:</p>
                    <ul>
                        <li>Socialize to neighbors about garbage dangers and drainage importance</li>
                        <li>Form Flood Alert Team at RT/RW level</li>
                        <li>Create communication group for emergency coordination</li>
                        <li>Invite children to care for environment from early age</li>
                    </ul>

                    <h3>Government Role</h3>
                    <p>DKI Jakarta Provincial Government continues structural prevention efforts such as:</p>
                    <ul>
                        <li>Normalization of 13 rivers crossing Jakarta</li>
                        <li>Construction of 6 new reservoirs and lakes</li>
                        <li>Installation of 1,200 water pumps at strategic points</li>
                        <li>Creation of communal infiltration wells</li>
                        <li>Jakarta Kini app for real-time flood monitoring</li>
                    </ul>

                    <p>"However, all government efforts will not be maximum without community participation. Let's protect Jakarta together from floods," invited DKI Jakarta Governor in #FloodFreeJakarta campaign.</p>

                    <p><strong>Conclusion:</strong> Flood prevention is a shared responsibility. With simple consistent steps, we can reduce flood risks and protect our environment.</p>
                `
            },
            6: {
                title: "Alert Level 2 in 5 Jakarta Regions",
                date: "January 21, 2026",
                image: "img/berita6.png",
                content: `
                    <img src="../img/berita6.png" alt="Flood Alert Status">
                    
                    <p><strong>Jakarta</strong> - BPBD DKI Jakarta established Alert Level 2 (vigilance) in five Jakarta regions potentially experiencing flooding within the next 24-48 hours. This status determination is based on BMKG weather forecast analysis and river water level monitoring.</p>

                    <h3>Alert Level 2 Regions</h3>
                    <p>Five regions established under Alert Level 2 are:</p>

                    <p><strong>1. North Jakarta</strong><br>
                    Water level in Kali Sunter reached 245 cm from normal 180 cm (Alert 3: 250 cm, Alert 1: 300 cm). Areas needing vigilance: Kelapa Gading, Tanjung Priok, Penjaringan, Koja, Pademangan.</p>

                    <p><strong>2. East Jakarta</strong><br>
                    Ciliwung River discharge at Manggarai Water Gate recorded 80 m³/second from normal 40 m³/second. Vulnerable areas: Cawang, Kampung Melayu, Bukit Duri, Cipinang Melayu, Duren Sawit.</p>

                    <p><strong>3. West Jakarta</strong><br>
                    Kali Pesanggrahan at Pesanggrahan Water Gauge reached 215 cm height (Alert 3: 230 cm). Vigilance areas: Kalideres, Cengkareng, Kembangan, Tambora, Grogol Petamburan.</p>

                    <p><strong>4. South Jakarta</strong><br>
                    Although relatively safe, several points in lowlands need vigilance: Kebayoran Lama, Cilandak (near Kali Krukut), Jagakarsa, Mampang Prapatan.</p>

                    <p><strong>5. Central Jakarta</strong><br>
                    Manggarai Water Gate as Ciliwung estuary recorded significant rise. Vulnerable areas: Kemayoran, Sawah Besar, Tanah Abang, Gambir.</p>

                    <h3>Understanding Alert Status</h3>
                    <p>BPBD DKI Jakarta implements 4 flood alert status levels:</p>
                    <ul>
                        <li><strong>Alert 4 (Normal):</strong> No flood threat</li>
                        <li><strong>Alert 3 (Vigilance):</strong> Flood potential within 3-7 days</li>
                        <li><strong>Alert 2 (Alert):</strong> Flood potential within 24-48 hours</li>
                        <li><strong>Alert 1 (Warning):</strong> Flood occurred or will occur within 6-12 hours</li>
                    </ul>

                    <h3>BPBD Anticipation Steps</h3>
                    <p>Responding to Alert 2 establishment, BPBD has taken the following steps:</p>
                    <ul>
                        <li>Activating 44 flood alert posts 24 hours</li>
                        <li>Deploying 300 joint personnel to vulnerable locations</li>
                        <li>Preparing 25 rubber boats and 5 amphibious trucks</li>
                        <li>Operating 180 mobile water pumps</li>
                        <li>Opening 12 evacuation points with 2,000 people capacity</li>
                        <li>Coordination with PLN for emergency blackout anticipation</li>
                        <li>Preparing public kitchen and aid logistics</li>
                    </ul>

                    <h3>Appeal to Public</h3>
                    <p>Head of BPBD DKI Jakarta Operations appeals to public in Alert 2 regions to:</p>
                    <ul>
                        <li>Monitor weather information and flood status through Jakarta Kini or JAKI app</li>
                        <li>Prepare emergency bag containing important documents, medicines, and change of clothes</li>
                        <li>Secure valuables and electronics to high places</li>
                        <li>Ensure evacuation route to higher places</li>
                        <li>Save emergency contact numbers: BPBD (021-6560777), Flood Post (112)</li>
                        <li>Not throw garbage into water channels</li>
                        <li>Follow officer instructions if asked to evacuate</li>
                    </ul>

                    <h3>Real-Time Monitoring</h3>
                    <p>Public can monitor current conditions through:</p>
                    <ul>
                        <li><strong>Website:</strong> banjir.jakarta.go.id</li>
                        <li><strong>Application:</strong> Jakarta Kini (Android/iOS)</li>
                        <li><strong>Twitter:</strong> @humasjakarta, @BPBDJakarta</li>
                        <li><strong>Call Center:</strong> 112 (24 hours)</li>
                    </ul>

                    <p>BPBD automatic monitoring system records water level at 80 river and main channel points in real-time. Data updated every 15 minutes and publicly accessible.</p>

                    <h3>Weather Forecast</h3>
                    <p>According to BMKG, moderate to heavy rain intensity still potentially occurs for the next 3 days. Rain peak estimated at night 6:00 PM-12:00 AM WIB. Total rain accumulation predicted to reach 100-150 mm within 72 hours.</p>

                    <p>"We request awareness of all Jakarta residents to together maintain water channel cleanliness and not litter carelessly. Floods are our shared responsibility," emphasized Head of BPBD DKI Jakarta Operations.</p>

                    <p><em>Alert Level 2 status will be evaluated every 6 hours and can be raised or lowered according to actual field conditions.</em></p>
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
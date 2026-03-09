<?php
// ===================================
// CHATBOT API (Google Gemini)
// ===================================

require_once 'config.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendError('Method not allowed', 405);
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['message'])) {
    sendError('Message is required');
}

$userMessage = trim($input['message']);

if (empty($userMessage)) {
    sendError('Message cannot be empty');
}

// System prompt for Gemini (Bilingual: Indonesian & English)
$systemContext = "You are FloodGuard Assistant, a virtual assistant helping Jakarta residents about flood information. 
You must:
- Provide accurate information about Jakarta floods
- Explain how to prevent and face floods
- Provide safety tips during floods
- Explain FloodGuard features (AI prediction, flood risk maps, etc.)
- Speak in friendly and easy-to-understand language (Indonesian OR English based on user query)
- If asked about emergency contacts, mention: BPBD DKI 021-6560777 or 112
- Respond in the same language as the user's question

Do not provide specific medical or legal advice. Focus on general flood and safety information.";

try {
    // Prepare request for Gemini API
    $geminiData = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $systemContext],
                    ['text' => "User: " . $userMessage]
                ]
            ]
        ],
        'generationConfig' => [
            'temperature' => 0.7,
            'maxOutputTokens' => 500,
        ]
    ];
    
    // Call Gemini API
    $ch = curl_init(GEMINI_API_URL . '?key=' . GEMINI_API_KEY);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($geminiData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        throw new Exception("Gemini API connection error: $error");
    }
    
    if ($httpCode !== 200) {
        throw new Exception("Gemini API error: HTTP $httpCode");
    }
    
    $result = json_decode($response, true);
    
    // Extract response text
    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        $botResponse = $result['candidates'][0]['content']['parts'][0]['text'];
        
        sendJSON([
            'success' => true,
            'response' => $botResponse
        ]);
    } else {
        throw new Exception("Invalid response format from Gemini");
    }
    
} catch (Exception $e) {
    error_log("Chatbot error: " . $e->getMessage());
    
    // Fallback responses - BILINGUAL (Indonesian & English)
    $fallbackResponses = [
        // === INDONESIAN ===
        // Greeting & Basic
        'halo' => 'Halo! Saya asisten FloodGuard. Ada yang bisa saya bantu tentang banjir Jakarta?',
        'hai' => 'Hai! Senang bisa membantu Anda. Silakan tanyakan tentang banjir, prediksi, atau pencegahan.',
        'selamat' => 'Selamat datang di FloodGuard Jakarta! Bagaimana saya bisa membantu Anda hari ini?',
        'terima kasih' => 'Sama-sama! Jangan ragu untuk bertanya lagi jika ada yang perlu dibantu.',
        'makasih' => 'Terima kasih kembali! Tetap waspada terhadap banjir ya.',
        
        // About Banjir
        'banjir' => 'Banjir Jakarta umumnya terjadi karena curah hujan tinggi, drainase buruk, rob air laut, dan penurunan tanah. FloodGuard dapat membantu memprediksi risiko banjir dengan AI berdasarkan data cuaca real-time.',
        'penyebab banjir' => 'Penyebab banjir di Jakarta: 1) Curah hujan ekstrem, 2) Sistem drainase tidak memadai, 3) Sampah menyumbat saluran air, 4) Rob dari air laut, 5) Penurunan muka tanah (land subsidence), 6) Perubahan tata guna lahan.',
        'kapan banjir' => 'Banjir Jakarta biasanya terjadi saat musim hujan (November-Maret), terutama saat curah hujan >50mm/hari. Gunakan fitur prediksi FloodGuard untuk monitoring risiko real-time.',
        'wilayah banjir' => 'Wilayah rawan banjir di Jakarta: Jakarta Utara (Kelapa Gading, Penjaringan), Jakarta Timur (Cawang, Kampung Melayu), Jakarta Barat (Kalideres, Cengkareng), Jakarta Selatan (Kebayoran Lama), Jakarta Pusat (Kemayoran).',
        
        // === ENGLISH ===
        // Greeting & Basic
        'hello' => 'Hello! I am FloodGuard Assistant. How can I help you with Jakarta flood information?',
        'hi' => 'Hi! Happy to assist you. Feel free to ask about floods, predictions, or prevention.',
        'welcome' => 'Welcome to FloodGuard Jakarta! How can I help you today?',
        'thank you' => 'You\'re welcome! Don\'t hesitate to ask again if you need help.',
        'thanks' => 'You\'re welcome! Stay alert for floods.',
        
        // About Flood
        'flood' => 'Jakarta floods typically occur due to heavy rainfall, poor drainage, sea tides, and land subsidence. FloodGuard can predict flood risks using AI based on real-time weather data.',
        'flooding' => 'Flooding in Jakarta is caused by: 1) Extreme rainfall, 2) Inadequate drainage systems, 3) Waste blocking waterways, 4) Sea tidal floods (rob), 5) Land subsidence, 6) Land use changes.',
        'cause' => 'Main causes of Jakarta floods: heavy rainfall (>50mm/day), poor drainage infrastructure, garbage blockage, coastal flooding (rob), rapid land subsidence (~10-25cm/year), and reduced water absorption areas.',
        'when' => 'Jakarta floods usually occur during rainy season (November-March), especially when rainfall exceeds 50mm/day. Use FloodGuard prediction features for real-time risk monitoring.',
        'where' => 'Flood-prone areas in Jakarta: North Jakarta (Kelapa Gading, Penjaringan), East Jakarta (Cawang, Kampung Melayu), West Jakarta (Kalideres, Cengkareng), South Jakarta (Kebayoran Lama), Central Jakarta (Kemayoran).',
        'area' => 'Flood-prone areas in Jakarta: North Jakarta (Kelapa Gading, Penjaringan), East Jakarta (Cawang, Kampung Melayu), West Jakarta (Kalideres, Cengkareng), South Jakarta (Kebayoran Lama), Central Jakarta (Kemayoran).',
        
        // Prevention & Tips
        'prevent' => 'Flood prevention tips: 1) Dispose waste properly, 2) Clean drainage regularly, 3) Build infiltration wells, 4) Monitor weather forecasts, 5) Don\'t throw garbage into rivers, 6) Plant trees for water absorption.',
        'prevention' => 'Flood prevention includes: creating infiltration wells, biopores, maintaining drainage cleanliness, proper waste disposal, and regularly monitoring weather predictions from FloodGuard or BMKG.',
        'tips' => 'Flood response tips: BEFORE: Prepare emergency bag, turn off electricity & gas. DURING: Stay calm, follow evacuation routes, call 112. AFTER: Clean house, sterilize water, watch for diseases.',
        'how to' => 'How to face floods: BEFORE: Prepare documents, medicine, food in waterproof bag. DURING: Turn off utilities, follow official evacuation routes, don\'t cross water >knee deep. AFTER: Disinfect house, avoid contaminated water.',
        'prepare' => 'Flood preparedness: 1) Save emergency numbers (112, BPBD 021-6560777), 2) Prepare bag with important documents, medicine, food, 3) Know nearest evacuation routes, 4) Monitor weather info on FloodGuard, 5) Communicate with neighbors.',
        
        // Emergency
        'emergency' => 'Jakarta flood emergency contacts: 🚨 Flood Post: 112 | 🏥 BPBD DKI: 021-6560777 | 🚑 Ambulance: 118 | 🚒 Fire Dept: 113. Stay calm and follow officer instructions!',
        'help' => 'For emergency assistance contact: BPBD DKI 021-6560777, Flood Post 112, or PMI 021-7992325. Teams available 24/7!',
        'evacuation' => 'During flood evacuation: 1) Bring emergency bag (documents, medicine, food), 2) Turn off electricity & gas, 3) Follow official evacuation routes, 4) Don\'t cross fast water >knee deep, 5) Contact family, 6) Listen to officer instructions.',
        'rescue' => 'If you need rescue, call: 112 (Emergency), BPBD 021-6560777, or Basarnas 115. Provide your exact location and number of people needing rescue.',
        
        // FloodGuard Features
        'floodguard' => 'FloodGuard is an AI-based flood prediction system with 88.49% accuracy using Random Forest. Features: 1) Real-time flood risk prediction, 2) Interactive risk area maps, 3) Current weather data from OpenWeatherMap, 4) AI Chatbot (Gemini), 5) Flood news & education.',
        'prediction' => 'To predict floods, click "Flood Prediction" menu then input weather data (rainfall, humidity, temperature, etc). Our AI system will analyze and provide risk level: Low, Medium, or High with action recommendations.',
        'predict' => 'To predict floods, click "Flood Prediction" menu then input weather data (rainfall, humidity, temperature, etc). Our AI system will analyze and provide risk level: Low, Medium, or High with action recommendations.',
        'accuracy' => 'FloodGuard model has 88.49% accuracy based on training with 6,308 historical BMKG data from 2016-2020. Model uses Random Forest algorithm with 8 weather parameters.',
        'feature' => 'FloodGuard features: ✅ AI flood risk prediction, ✅ Interactive map of 5 Jakarta areas, ✅ Real-time weather from OpenWeatherMap, ✅ AI Chatbot powered by Gemini, ✅ Latest flood news & tips, ✅ Prediction history (login required), ✅ Emergency contacts.',
        'how use' => 'How to use FloodGuard: 1) Open Flood Prediction menu, 2) Fill weather data or click "Auto Fill", 3) Click Predict Now, 4) View results & recommendations. To save history, please login/register first.',
        
        // Data & Model
        'data' => 'FloodGuard uses BMKG dataset with 6,308 Jakarta weather records (2016-2020) including rainfall, humidity, temperature, sunshine, and wind speed. Data trained using Random Forest classifier.',
        'model' => 'Our machine learning model is Random Forest with 8 input features: rainfall (RR), humidity (RH_avg), average temperature (Tavg), min temp (Tn), max temp (Tx), sunshine (ss), max wind (ff_x), average wind (ff_avg).',
        'machine learning' => 'We use Random Forest algorithm, an ensemble learning method that combines multiple decision trees for more accurate predictions. Trained on 6,308 historical flood events from 2016-2020.',
        'algorithm' => 'FloodGuard uses Random Forest algorithm with 88.49% accuracy. The model analyzes 8 weather parameters to predict flood probability: Low (<30%), Medium (30-70%), or High (>70%).',
        'bmkg' => 'BMKG (Indonesian Meteorology, Climatology and Geophysics Agency) is our official weather data source. FloodGuard also integrates real-time data from OpenWeatherMap for more accurate predictions.',
        
        // Login & Account
        'login' => 'Login required to: save prediction history, view analysis records, download PDF/JSON reports, and access dashboard features. Click "Login" button at top right to sign in or create new account.',
        'register' => 'To create account, click "Login" then select "Register now". Fill in full name, username, email, and password. Free and your data is secure!',
        'account' => 'Create a free FloodGuard account to: track your prediction history, download reports in PDF/JSON, access personalized dashboard, and get better recommendations.',
        'dashboard' => 'Dashboard available after login. In dashboard you can: view prediction statistics, access complete history, download PDF/JSON reports, delete old predictions.',
        
        // Weather
        'weather' => 'FloodGuard displays real-time Jakarta weather from OpenWeatherMap. See current rainfall, humidity, and temperature data on Map page. Data updated every 5 minutes.',
        'rain' => 'Rainfall >50mm/day is categorized as high and significantly increases flood risk. Rainfall >100mm/day = very high risk. Keep monitoring weather predictions on FloodGuard!',
        'rainfall' => 'Heavy rainfall (>50mm/day) is the primary trigger for Jakarta floods. Our AI model considers rainfall as the most important factor (40% importance) in flood prediction.',
        'season' => 'Jakarta rainy season: November - March. During this season flood risk increases drastically. Use FloodGuard for daily monitoring during this period.',
        
        // Map & Location
        'map' => 'Flood Risk Map feature displays 5 Jakarta areas with color-coding: Purple (Critical), Red (High), Orange (Medium), Green (Low). Click markers for area details. Real-time weather data also displayed.',
        'north jakarta' => 'North Jakarta has VERY HIGH risk due to sea tides and incoming floods. Critical areas: Kelapa Gading, Penjaringan, Koja, Tanjung Priok. Low elevation and near coast.',
        'east jakarta' => 'East Jakarta has HIGH risk, especially near Ciliwung River. Prone areas: Cawang, Kampung Melayu, Cipinang Melayu, Duren Sawit. Often affected by river overflow.',
        'west jakarta' => 'West Jakarta has HIGH risk due to Pesanggrahan River overflow. Prone areas: Kalideres, Cengkareng, Tambora, Grogol Petamburan.',
        'south jakarta' => 'South Jakarta has MEDIUM risk with local flooding during heavy rain. Prone areas: Kebayoran Lama, Cilandak, Jagakarsa, Mampang Prapatan.',
        'central jakarta' => 'Central Jakarta has MEDIUM risk, especially near Ciliwung River. Prone areas: Kemayoran, Sawah Besar, Tanah Abang, Gambir.',
        
        // Competition & About
        'competition' => 'FloodGuard was developed for PROX x CORIS International Competition 2026 in Web Development category with theme "Bridging Gaps: Code for Earth, Intelligence for Justice, and Sustainability for Shaping Tomorrow".',
        'developer' => 'FloodGuard developed by Reinhart Jens Robert using tech stack: PHP, Python Flask, JavaScript, Machine Learning (Random Forest), Google Gemini AI, Leaflet.js for maps, and OpenWeatherMap API.',
        'technology' => 'FloodGuard tech stack: Frontend (HTML, CSS, JavaScript, Leaflet.js), Backend (PHP Native, Python Flask), Database (MySQL), AI/ML (Random Forest, Google Gemini), APIs (OpenWeatherMap, BMKG).',
        'about' => 'FloodGuard is an AI-powered flood prediction platform for Jakarta using machine learning and real-time weather data. Developed for PROX x CORIS 2026 competition to help protect communities from flood disasters.',
        
        // Others
        'news' => 'News page provides latest updates about Jakarta floods, safety tips, and important information from BMKG & BPBD. Articles updated regularly.',
        'chatbot' => 'I am FloodGuard chatbot powered by Google Gemini AI. I can answer questions about floods, how to use FloodGuard, emergency tips, and Jakarta weather information.',
        'contact' => 'Contact us: 📧 Email: info@floodguard.id | 🌐 Website: floodguard.id | 💬 Chatbot available 24/7 on website',
        'api' => 'FloodGuard integrates: OpenWeatherMap API (real-time weather), Google Gemini API (AI chatbot), and BMKG data (historical weather). Internal API available for flood prediction.',
    ];
        
        $lowercaseMsg = strtolower($userMessage);
        $response = 'I apologize, I\'m experiencing technical difficulties. Please contact emergency services at BPBD 021-6560777 for immediate assistance. | Maaf, saya sedang mengalami kendala. Silakan hubungi BPBD di 021-6560777 untuk bantuan langsung.';
        
        foreach ($fallbackResponses as $keyword => $fallback) {
            if (strpos($lowercaseMsg, $keyword) !== false) {
                $response = $fallback;
                break;
            }
        }
    
    sendJSON([
        'success' => true,
        'response' => $response
    ]);
}
?>
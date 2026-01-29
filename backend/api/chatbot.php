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

// System prompt for Gemini
$systemContext = "Kamu adalah FloodGuard Assistant, asisten virtual yang membantu masyarakat Jakarta tentang informasi banjir. 
Kamu harus:
- Memberikan informasi akurat tentang banjir Jakarta
- Menjelaskan cara mencegah dan menghadapi banjir
- Memberikan tips keselamatan saat banjir
- Menjelaskan fitur FloodGuard (prediksi AI, peta rawan banjir, dll)
- Berbicara dalam bahasa Indonesia yang ramah dan mudah dipahami
- Jika ditanya tentang kontak darurat, sebutkan: BPBD DKI 021-6560777 atau 112

Jangan memberikan informasi medis spesifik atau legal advice. Fokus pada informasi umum tentang banjir dan keselamatan.";

try {
    // Prepare request for Gemini API
    $geminiData = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $systemContext],
                    ['text' => "Pengguna: " . $userMessage]
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
    
    // Fallback responses - EXTENDED VERSION
    $fallbackResponses = [
        // Greeting & Basic
        'halo' => 'Halo! Saya asisten FloodGuard. Ada yang bisa saya bantu tentang banjir Jakarta?',
        'hai' => 'Hai! Senang bisa membantu Anda. Silakan tanyakan tentang banjir, prediksi, atau pencegahan.',
        'selamat' => 'Selamat datang di FloodGuard Jakarta! Bagaimana saya bisa membantu Anda hari ini?',
        'terima kasih' => 'Sama-sama! Jangan ragu untuk bertanya lagi jika ada yang perlu dibantu.',
        'makasih' => 'Terima kasih kembali! Tetap waspada terhadap banjir ya.',
        
        // About Banjir
        'banjir' => 'Banjir Jakarta umumnya terjadi karena curah hujan tinggi, drainase buruk, rob air laut, dan penurunan tanah. FloodGuard dapat membantu memprediksi risiko banjir dengan AI berdasarkan data cuaca real-time.',
        'penyebab banjir' => 'Penyebab banjir di Jakarta: 1) Curah hujan ekstrem, 2) Sistem drainase tidak memadai, 3) Sampah menyumbat saluran air, 4) Rob dari air laut, 5) Penurunan muka tanah (land subsidence), 6) Perubahan tata guna lahan, 7) Alih fungsi daerah resapan air.',
        'kapan banjir' => 'Banjir Jakarta biasanya terjadi saat musim hujan (November-Maret), terutama saat curah hujan >50mm/hari. Gunakan fitur prediksi FloodGuard untuk monitoring risiko real-time.',
        'wilayah banjir' => 'Wilayah rawan banjir di Jakarta: Jakarta Utara (Kelapa Gading, Penjaringan), Jakarta Timur (Cawang, Kampung Melayu), Jakarta Barat (Kalideres, Cengkareng), Jakarta Selatan (Kebayoran Lama), Jakarta Pusat (Kemayoran). Cek peta interaktif kami untuk detail lokasi.',
        'lokasi banjir' => 'Wilayah rawan banjir di Jakarta: Jakarta Utara (Kelapa Gading, Penjaringan), Jakarta Timur (Cawang, Kampung Melayu), Jakarta Barat (Kalideres, Cengkareng), Jakarta Selatan (Kebayoran Lama), Jakarta Pusat (Kemayoran). Cek peta interaktif kami untuk detail lokasi.',
        // Pencegahan & Tips
        'cara' => 'Cara mencegah banjir: 1) Buang sampah pada tempatnya, 2) Bersihkan saluran air secara rutin, 3) Buat sumur resapan di rumah, 4) Pantau prediksi cuaca dari BMKG, 5) Jangan membuang sampah ke sungai, 6) Tanam pohon untuk resapan air.',
        'tips' => 'Tips menghadapi banjir: SEBELUM: Siapkan tas darurat, matikan listrik & gas. SAAT: Jangan panik, ikuti jalur evakuasi, hubungi 112. SETELAH: Bersihkan rumah, sterilkan air, waspada penyakit.',
        'pencegahan' => 'Pencegahan banjir meliputi: pembuatan sumur resapan, biopori, menjaga kebersihan saluran air, tidak membuang sampah sembarangan, dan memantau prediksi cuaca secara berkala dari FloodGuard atau BMKG.',
        'siaga' => 'Tips siaga banjir: 1) Simpan nomor darurat (112, BPBD 021-6560777), 2) Siapkan tas berisi dokumen penting, obat, makanan, 3) Ketahui jalur evakuasi terdekat, 4) Pantau info cuaca di FloodGuard, 5) Komunikasi dengan tetangga.',
        
        // Emergency
        'darurat' => 'Kontak darurat banjir Jakarta: 🚨 Posko Banjir: 112 | 🏥 BPBD DKI: 021-6560777 | 🚑 Ambulans: 118 | 🚒 Damkar: 113. Tetap tenang dan ikuti instruksi petugas!',
        'evakuasi' => 'Saat evakuasi banjir: 1) Bawa tas darurat (dokumen, obat, makanan), 2) Matikan listrik & gas, 3) Ikuti jalur evakuasi resmi, 4) Jangan lintasi air deras >lutut, 5) Hubungi keluarga, 6) Dengarkan instruksi petugas.',
        'bantuan' => 'Untuk bantuan darurat hubungi: BPBD DKI 021-6560777, Posko Banjir 112, atau PMI 021-7992325. Tim siap 24/7!',
        
        // FloodGuard Features
        'floodguard' => 'FloodGuard adalah sistem prediksi banjir berbasis AI dengan akurasi 88.49% menggunakan Random Forest. Fitur: 1) Prediksi risiko banjir real-time, 2) Peta interaktif wilayah rawan, 3) Data cuaca terkini dari OpenWeatherMap, 4) Chatbot AI (Gemini), 5) Berita & edukasi banjir.',
        'prediksi' => 'Untuk memprediksi banjir, klik menu "Prediksi Banjir" lalu masukkan data cuaca (curah hujan, kelembaban, suhu, dll). Sistem AI kami akan menganalisis dan memberikan tingkat risiko: Rendah, Sedang, atau Tinggi beserta rekomendasi tindakan.',
        'akurasi' => 'Model FloodGuard memiliki akurasi 88.49% berdasarkan training dengan 6,308 data historis BMKG periode 2016-2020. Model menggunakan algoritma Random Forest dengan 8 parameter cuaca.',
        'fitur' => 'Fitur FloodGuard: ✅ Prediksi AI risiko banjir, ✅ Peta interaktif 5 wilayah Jakarta, ✅ Real-time weather dari OpenWeatherMap, ✅ Chatbot AI powered by Gemini, ✅ Berita & tips banjir terkini, ✅ History prediksi (login required), ✅ Emergency contacts.',
        'cara pakai' => 'Cara pakai FloodGuard: 1) Buka menu Prediksi Banjir, 2) Isi data cuaca atau klik "Isi Otomatis", 3) Klik Prediksi Sekarang, 4) Lihat hasil & rekomendasi. Untuk menyimpan history, silakan login/register terlebih dahulu.',
        
        // Data & Model
        'data' => 'FloodGuard menggunakan dataset BMKG dengan 6,308 record data cuaca Jakarta (2016-2020) yang mencakup curah hujan, kelembaban, suhu, sinar matahari, dan kecepatan angin. Data di-training menggunakan Random Forest classifier.',
        'model' => 'Model machine learning kami adalah Random Forest dengan 8 input features: curah hujan (RR), kelembaban (RH_avg), suhu rata-rata (Tavg), suhu min (Tn), suhu max (Tx), sinar matahari (ss), angin max (ff_x), angin rata-rata (ff_avg).',
        'bmkg' => 'BMKG (Badan Meteorologi Klimatologi dan Geofisika) adalah sumber data cuaca resmi kami. FloodGuard juga mengintegrasikan data real-time dari OpenWeatherMap untuk prediksi yang lebih akurat.',
        
        // Login & Account
        'login' => 'Login diperlukan untuk: menyimpan history prediksi, melihat riwayat analisis, download laporan PDF/JSON, dan akses fitur dashboard. Klik tombol "Login" di pojok kanan atas untuk masuk atau daftar akun baru.',
        'register' => 'Untuk membuat akun, klik "Login" lalu pilih "Daftar sekarang". Isi nama lengkap, username, email, dan password. Gratis dan data Anda aman!',
        'dashboard' => 'Dashboard tersedia setelah login. Di dashboard Anda bisa: melihat statistik prediksi, akses history lengkap, download laporan PDF/JSON, hapus prediksi lama.',
        
        // Weather
        'cuaca' => 'FloodGuard menampilkan cuaca real-time Jakarta dari OpenWeatherMap. Lihat data curah hujan, kelembaban, dan suhu terkini di halaman Peta. Data diperbarui setiap 5 menit.',
        'hujan' => 'Curah hujan >50mm/hari dikategorikan tinggi dan meningkatkan risiko banjir signifikan. Curah hujan >100mm/hari = risiko sangat tinggi. Pantau terus prediksi cuaca di FloodGuard!',
        'musim' => 'Musim hujan Jakarta: November - Maret. Musim ini risiko banjir meningkat drastis. Gunakan FloodGuard untuk monitoring harian selama periode ini.',
        
        // Map & Location
        'peta' => 'Fitur Peta Rawan Banjir menampilkan 5 wilayah Jakarta dengan color-coding: Ungu (Critical), Merah (High), Oranye (Medium), Hijau (Low). Klik marker untuk detail wilayah. Data cuaca real-time juga ditampilkan.',
        'jakarta utara' => 'Jakarta Utara memiliki risiko SANGAT TINGGI karena rob air laut dan banjir kiriman. Area kritis: Kelapa Gading, Penjaringan, Koja, Tanjung Priok. Elevasi rendah dan dekat pesisir.',
        'jakarta timur' => 'Jakarta Timur risiko TINGGI, terutama dekat Sungai Ciliwung. Area rawan: Cawang, Kampung Melayu, Cipinang Melayu, Duren Sawit. Sering terdampak luapan sungai.',
        'jakarta barat' => 'Jakarta Barat risiko TINGGI akibat luapan Kali Pesanggrahan. Area rawan: Kalideres, Cengkareng, Tambora, Grogol Petamburan.',
        'jakarta selatan' => 'Jakarta Selatan risiko SEDANG dengan banjir lokal saat hujan deras. Area rawan: Kebayoran Lama, Cilandak, Jagakarsa, Mampang Prapatan.',
        'jakarta pusat' => 'Jakarta Pusat risiko SEDANG, terutama dekat Kali Ciliwung. Area rawan: Kemayoran, Sawah Besar, Tanah Abang, Gambir.',
        
        // Competition & About
        'lomba' => 'FloodGuard dikembangkan untuk PROX x CORIS International Competition 2026 kategori Web Development dengan tema "Bridging Gaps: Code for Earth, Intelligence for Justice, and Sustainability for Shaping Tomorrow".',
        'developer' => 'FloodGuard dikembangkan oleh Reinhart Jens Robert menggunakan tech stack: PHP, Python Flask, JavaScript, Machine Learning (Random Forest), Google Gemini AI, Leaflet.js untuk maps, dan OpenWeatherMap API.',
        'teknologi' => 'Tech stack FloodGuard: Frontend (HTML, CSS, JavaScript, Leaflet.js), Backend (PHP Native, Python Flask), Database (MySQL), AI/ML (Random Forest, Google Gemini), API (OpenWeatherMap, BMKG).',
        
        // Others
        'berita' => 'Halaman Berita menyediakan update terkini tentang banjir Jakarta, tips keselamatan, dan informasi penting dari BMKG & BPBD. Artikel diperbarui secara berkala.',
        'chatbot' => 'Saya adalah chatbot FloodGuard yang didukung oleh Google Gemini AI. Saya bisa menjawab pertanyaan tentang banjir, cara pakai FloodGuard, tips darurat, dan informasi cuaca Jakarta.',
        'kontak' => 'Hubungi kami: 📧 Email: info@floodguard.id | 🌐 Website: floodguard.id | 💬 Chatbot tersedia 24/7 di website',
        'api' => 'FloodGuard mengintegrasikan: OpenWeatherMap API (cuaca real-time), Google Gemini API (chatbot AI), dan data BMKG (historical weather). API internal tersedia untuk prediksi banjir.',
    ];
        
        $lowercaseMsg = strtolower($userMessage);
        $response = 'Maaf, saya sedang mengalami kendala. Silakan hubungi kontak darurat BPBD di 021-6560777 untuk bantuan langsung.';
        
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
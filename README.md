# FloodGuard Jakarta: AI-Powered Flood Prediction System for Urban Resilience


**FloodGuard Jakarta** is an AI-powered web application that predicts flood risks in Jakarta using machine learning. The system provides 24-72 hour advance warnings with 88.49% accuracy, helping residents and authorities take proactive measures.

---

##  Features

- ** ML-Powered Prediction**: Random Forest model trained on 6,308 historical records (88.49% accuracy)
- ** AI Chatbot**: Google Gemini-powered assistant for flood-related queries
- ** Interactive Map**: Visualize flood risk levels across Jakarta's 5 regions
- ** User Dashboard**: Track prediction history with PDF/JSON export
- ** News & Information**: Curated flood news, emergency contacts, and safety tips
- ** User Authentication**: Secure login/register system
- ** Responsive Design**: Works on desktop, tablet, and mobile devices
- ** Bilingual Support**: Indonesian and English interface

---

##  Tech Stack

### Frontend
- HTML5, CSS3, JavaScript (Vanilla ES6)
- Leaflet.js (Interactive Maps)
- Font Awesome (Icons)
- Google Fonts (Poppins)

### Backend
- PHP 8.0+ (PDO for database)
- Python 3.9+ Flask (ML Service)
- MySQL 8.0 (Database)

### Machine Learning
- scikit-learn 1.3.0 (Random Forest)
- NumPy 1.24.3
- Pandas 2.0.3
- Flask-CORS 4.0.0

### APIs
- OpenWeatherMap API (Real-time weather data)
- Google Gemini API (AI Chatbot)

---

##  Project Structure

```
Flood-prediction/
├── backend/
│   ├── api/
│   │   ├── auth.php              # Authentication endpoints
│   │   ├── chatbot.php           # Gemini chatbot API
│   │   ├── config.php            # Configuration
│   │   ├── predict.php           # ML prediction API
│   │   └── predictions_history.php
│   └── database/
│       └── db.php                # Database connection
├── frontend/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   ├── chatbot.js
│   │   ├── main.js
│   │   └── prediction.js
│   ├── img/
│   ├── about.php
│   ├── berita.php                # News page
│   ├── dashboard.php
│   ├── login.php
│   ├── peta.php                  # Map page
│   ├── prediksi.php              # Prediction page
│   └── register.php
├── ml_service/
│   ├── models/
│   │   ├── flood_model.pkl       # Trained Random Forest model (16MB)
│   │   ├── scaler.pkl
│   │   ├── imputer.pkl
│   │   └── feature_names.pkl
│   ├── app.py                    # Flask ML service
│   └── requirements.txt
|── flood_prediction_training.ipynb
├── floodguard_db.sql
├── index.php                     # Homepage
└── README.md
```

---

##  Installation & Setup

### Prerequisites

- **Laragon** (with PHP 8.0+, MySQL 8.0)
- **Python 3.9+**
- **Git**

### Step 1: Clone Repository

```bash
git clone https://github.com/reinhart07/flood-prediction.git
cd floodguard-prediction
```

### Step 2: Database Setup

1. Start **Laragon**
2. Open **HeidiSQL** (or phpMyAdmin)
3. Create database:
   ```sql
   CREATE DATABASE floodguard_db;
   ```
4. Import database schema:
   ```sql
   USE floodguard_db;
   
   -- Users table
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) UNIQUE NOT NULL,
       email VARCHAR(100) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   
   -- Predictions table
   CREATE TABLE predictions (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       prediction INT NOT NULL,
       probability FLOAT NOT NULL,
       risk_level VARCHAR(20) NOT NULL,
       rainfall FLOAT,
       humidity FLOAT,
       temperature FLOAT,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
   );
   ```

### Step 3: Configure Backend

Edit `backend/api/config.php`:

```php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  
define('DB_NAME', 'floodguard_db');

// API Keys (get your own!)
define('GEMINI_API_KEY', 'YOUR_GEMINI_API_KEY');
define('ML_SERVICE_URL', 'http://localhost:5000');
```

**Get API Keys:**
- Google Gemini: https://ai.google.dev/
- OpenWeatherMap: https://openweathermap.org/api (free tier)

### Step 4: Python ML Service Setup

```bash
# Navigate to ml_service folder
cd ml_service

# Install dependencies
pip install -r requirements.txt

# Run Flask server
python app.py
```

Flask server will run on `http://localhost:5000`

### Step 5: Start Laragon

1. Open **Laragon**
2. Click **Start All**
3. Ensure Apache and MySQL are running

### Step 6: Access Application


http://flood-prediction.test/
```

---

## Usage Guide

### Making a Flood Prediction

1. Navigate to **Flood Prediction** page
2. Option A: Click **"Auto-fill from API"** for real-time weather data
3. Option B: Manually enter 8 weather parameters:
   - Minimum Temperature (°C)
   - Maximum Temperature (°C)
   - Average Temperature (°C)
   - Relative Humidity (%)
   - Rainfall (mm)
   - Sunshine Duration (hours)
   - Maximum Wind Speed (m/s)
   - Average Wind Speed (m/s)
4. Click **"Predict Now"**
5. View result: Risk Level (Low/Medium/High) + Probability (%)

### Using AI Chatbot

1. Click the chatbot icon (💬) in bottom-right corner
2. Ask questions about floods, safety tips, or FloodGuard features
3. Get instant responses in Indonesian or English

### Viewing Prediction History

1. Login/Register an account
2. Navigate to **Dashboard**
3. View all past predictions with filters (Low/Medium/High risk)
4. Export predictions as PDF or JSON

---

## Machine Learning Model

### Dataset
- **Source**: [Kaggle - Climate and Flood Jakarta](https://www.kaggle.com/datasets/christopherrichardc/climate-and-flood-jakarta)
- **Size**: 6,308 daily records (2016-2020)
- **Features**: 8 meteorological parameters

### Model Performance
- **Algorithm**: Random Forest Classifier
- **Accuracy**: 88.49%
- **Precision**: 87.23%
- **Recall**: 89.76%
- **F1 Score**: 88.47%

### Key Features (by importance)
1. Rainfall (RR) - ~40%
2. Relative Humidity (RH_avg) - ~25%
3. Average Temperature (Tavg) - ~15%
4. Others - ~20%

---

## API Endpoints

### Prediction API
```
POST /backend/api/predict.php
Content-Type: application/json

{
  "Tn": 25.0,
  "Tx": 32.0,
  "Tavg": 28.5,
  "RH_avg": 78.0,
  "RR": 15.5,
  "ss": 5.2,
  "ff_x": 3.0,
  "ff_avg": 2.0
}

Response:
{
  "success": true,
  "prediction": 1,
  "probability": 0.45,
  "risk_level": "Medium",
  "timestamp": "2026-03-13T10:30:00"
}
```

### Authentication API
```
POST /backend/api/auth.php?action=login
POST /backend/api/auth.php?action=register
POST /backend/api/auth.php?action=logout
```

### Chatbot API
```
POST /backend/api/chatbot.php
Content-Type: application/json

{
  "message": "What should I do during floods?"
}
```

### Flask ML Service
```
POST http://localhost:5000/predict
GET  http://localhost:5000/model-info
GET  http://localhost:5000/
```

---

##  Testing

### Manual Testing Checklist

- [ ] Homepage loads correctly
- [ ] Prediction with auto-fill works
- [ ] Prediction with manual input works
- [ ] Map displays regions correctly
- [ ] Chatbot responds to queries
- [ ] Login/Register functionality
- [ ] Dashboard shows prediction history
- [ ] PDF/JSON export works
- [ ] Responsive design on mobile

### Browser Compatibility

Tested on:
-  Chrome 90+
-  Firefox 88+
-  Edge 90+
-  Safari 14+

---

##  Troubleshooting

### Flask Service Won't Start
```bash
# Check if port 5000 is in use
netstat -ano | findstr :5000

# Kill process if needed
taskkill /PID <process_id> /F

# Restart Flask
python app.py
```

### Database Connection Error
1. Check Laragon is running
2. Verify database credentials in `config.php`
3. Ensure `floodguard_db` exists in MySQL

### API Keys Not Working
1. Check API keys in `config.php`
2. Verify keys are active:
   - Google Gemini: https://aistudio.google.com/app/apikey
   - OpenWeatherMap: https://home.openweathermap.org/api_keys

### Prediction Returns Error
1. Ensure Flask service is running (`http://localhost:5000`)
2. Check browser console (F12) for errors
3. Verify ML model files exist in `ml_service/models/`

---


##  Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

##  License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

##  Author

**Reinhart Jens Robert**
- GitHub: [@reinhart07](https://github.com/reinhart07)
- Project: [FloodGuard Jakarta](https://github.com/reinhart07/flood-prediction)
- Link Website: https://floodpredictions.d45.site/index.php

---

##  Acknowledgments

- **BMKG** (Badan Meteorologi, Klimatologi, dan Geofisika) for meteorological data
- **BPBD DKI Jakarta** for flood occurrence data
- **Kaggle** for dataset hosting
- **PROXO X CORIS 2026** - International Competition
- **OpenWeatherMap** for real-time weather API
- **Google Gemini** for AI chatbot capabilities

---

##  Support

For issues or questions:
1. Open an [Issue](https://github.com/reinhart07/flood-prediction/issues)
2. Contact via email: [reinhartrobert23@gmail.com]

---

##  Roadmap

### Phase 1 (Q2 2026)
- [ ] Push notification system
- [ ] iOS/Android native apps
- [ ] SMS alert integration

### Phase 2 (Q3 2026)
- [ ] Geographic expansion (Bandung, Surabaya)
- [ ] Deep learning model experimentation
- [ ] Community reporting feature

### Phase 3 (Q4 2026)
- [ ] Real-time water level sensor integration
- [ ] Infrastructure data modeling
- [ ] Climate scenario analysis

### Phase 4 (2027+)
- [ ] International expansion
- [ ] Multi-hazard prediction (landslides, tsunami)
- [ ] IoT sensor network deployment

---

**Built with  for Jakarta's climate resilience**

*Last updated: March 2026*

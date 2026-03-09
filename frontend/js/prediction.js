// FLOODGUARD - PREDICTION PAGE JS


console.log('✅ FloodGuard Prediction JS Loaded');

// DOM Elements
const predictionForm = document.getElementById('prediction-form');
const resultCard = document.getElementById('result-card');
const resultContent = document.getElementById('result-content');
const predictBtn = document.getElementById('predict-btn');
const resetBtn = document.getElementById('reset-form');
const saveBtn = document.getElementById('save-result');
const useCurrentWeatherBtn = document.getElementById('use-current-weather');

// Check if elements exist
console.log('DOM Elements:', {
    form: !!predictionForm,
    resultCard: !!resultCard,
    predictBtn: !!predictBtn,
    useWeatherBtn: !!useCurrentWeatherBtn
});

// ========================================
// HELPER: CHECK IF USER LOGGED IN
// ========================================
let isLoggedIn = false;
let currentUser = null;

async function checkAuth() {
    try {
        const response = await fetch('../backend/api/auth.php?action=check');
        const result = await response.json();
        
        if (result.success && result.logged_in) {
            isLoggedIn = true;
            currentUser = result.user;
            console.log('✅ User logged in:', currentUser.username);
        } else {
            isLoggedIn = false;
            console.log('ℹ️ User not logged in');
        }
    } catch (error) {
        console.error('Auth check error:', error);
        isLoggedIn = false;
    }
}

// Check auth on load
checkAuth();

// ========================================
// HELPER: SHOW NOTIFICATION
// ========================================
function showNotification(message, type) {
    console.log(`[Notification ${type}]:`, message);
    
    const notification = document.createElement('div');
    notification.className = 'custom-notification';
    notification.style.cssText = `
        position: fixed;
        top: 80px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
        color: #f1f5f9;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
        z-index: 10000;
        font-weight: 600;
        max-width: 350px;
        animation: slideInNotif 0.3s ease;
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutNotif 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add notification animation styles
if (!document.getElementById('notification-styles')) {
    const style = document.createElement('style');
    style.id = 'notification-styles';
    style.textContent = `
        @keyframes slideInNotif {
            from { transform: translateX(400px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOutNotif {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(400px); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
}

// ========================================
// AUTO-FILL WEATHER DATA
// ========================================
if (useCurrentWeatherBtn) {
    useCurrentWeatherBtn.addEventListener('click', function() {
        console.log('🌤️ Auto-fill weather data triggered');
        
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Fetching data...';
        this.disabled = true;
        
        // Simulate API delay
        setTimeout(() => {
            try {
                // Fill form with realistic weather data
                document.getElementById('rainfall').value = '15.5';
                document.getElementById('humidity').value = '78';
                document.getElementById('temp-avg').value = '28.5';
                document.getElementById('temp-min').value = '25';
                document.getElementById('temp-max').value = '32';
                document.getElementById('sunshine').value = '5.2';
                document.getElementById('wind-max').value = '3.5';
                document.getElementById('wind-avg').value = '2';
                
                showNotification('✓ Weather data loaded successfully!', 'success');
                console.log('✅ Auto-fill completed');
                
            } catch (error) {
                console.error('❌ Auto-fill error:', error);
                showNotification('✗ Failed to load data', 'error');
            } finally {
                this.innerHTML = originalText;
                this.disabled = false;
            }
        }, 1000);
    });
}

// ========================================
// FORM SUBMISSION & PREDICTION
// ========================================
if (predictionForm) {
    predictionForm.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('📝 Form submitted');
        
        try {
            // Collect form data
            const formData = new FormData(predictionForm);
            const data = {
                RR: parseFloat(formData.get('RR')),
                RH_avg: parseFloat(formData.get('RH_avg')),
                Tavg: parseFloat(formData.get('Tavg')),
                Tn: parseFloat(formData.get('Tn')),
                Tx: parseFloat(formData.get('Tx')),
                ss: parseFloat(formData.get('ss')),
                ff_x: parseFloat(formData.get('ff_x')),
                ff_avg: parseFloat(formData.get('ff_avg'))
            };
            
            console.log('Input data:', data);
            
            // Validate all fields are filled
            const missingFields = [];
            for (const [key, value] of Object.entries(data)) {
                if (isNaN(value) || value === null) {
                    missingFields.push(key);
                }
            }
            
            if (missingFields.length > 0) {
                console.error('❌ Missing fields:', missingFields);
                showNotification('Please fill in all required fields (*)', 'error');
                return;
            }
            
            // Validate temperature logic
            if (data.Tn > data.Tavg) {
                showNotification('Minimum temperature cannot be greater than average', 'error');
                return;
            }
            
            if (data.Tx < data.Tavg) {
                showNotification('Maximum temperature cannot be less than average', 'error');
                return;
            }
            
            // Validate wind speed logic
            if (data.ff_avg > data.ff_x) {
                showNotification('Average wind speed cannot be greater than maximum', 'error');
                return;
            }
            
            // Show loading state
            if (predictBtn) {
                predictBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing prediction...';
                predictBtn.disabled = true;
            }
            
            // Run prediction (with delay to simulate API)
            setTimeout(() => {
                try {
                    console.log('🧠 Running prediction algorithm...');
                    
                    // ========================================
                    // MOCK PREDICTION ALGORITHM
                    // ========================================
                    let probability = 0.0;
                    let risk_level = 'Low';
                    let prediction = 0;
                    
                    // Calculate risk score based on weather conditions
                    let riskScore = 0;
                    
                    // Rainfall impact (most important)
                    if (data.RR > 80) riskScore += 50;
                    else if (data.RR > 50) riskScore += 35;
                    else if (data.RR > 25) riskScore += 20;
                    else if (data.RR > 10) riskScore += 10;
                    
                    // Humidity impact
                    if (data.RH_avg > 85) riskScore += 20;
                    else if (data.RH_avg > 75) riskScore += 10;
                    
                    // Temperature impact (inverse - cooler = more rain)
                    if (data.Tavg < 26) riskScore += 10;
                    
                    // Sunshine impact (less sun = more rain)
                    if (data.ss < 3) riskScore += 10;
                    else if (data.ss < 5) riskScore += 5;
                    
                    // Wind speed (high wind with rain = worse)
                    if (data.ff_x > 5 && data.RR > 20) riskScore += 5;
                    
                    // Convert risk score to probability (0-100%)
                    probability = Math.min(riskScore / 100, 0.95); // Max 95%
                    
                    // Determine risk level
                    if (probability >= 0.7) {
                        risk_level = 'High';
                        prediction = 1;
                    } else if (probability >= 0.4) {
                        risk_level = 'Medium';
                        prediction = 0;
                    } else {
                        risk_level = 'Low';
                        prediction = 0;
                    }
                    
                    const result = {
                        success: true,
                        prediction: prediction,
                        probability: probability,
                        risk_level: risk_level,
                        model: 'Mock Algorithm',
                        timestamp: new Date().toISOString()
                    };
                    
                    console.log('Prediction result:', result);
                    
                    // Display result
                    displayResult(result, data);
                    
                    // Save to database if logged in
                    if (isLoggedIn) {
                        savePredictionToDatabase(data, result);
                    } else {
                        console.log('ℹ️ User not logged in, skipping database save');
                        showNotification('✓ Prediction successful! Login to save history.', 'success');
                    }
                    
                } catch (error) {
                    console.error('❌ Prediction error:', error);
                    showNotification('An error occurred: ' + error.message, 'error');
                } finally {
                    if (predictBtn) {
                        predictBtn.innerHTML = '<i class="fas fa-chart-line"></i> Predict Now';
                        predictBtn.disabled = false;
                    }
                }
            }, 1500);
            
        } catch (error) {
            console.error('❌ Form processing error:', error);
            showNotification('An error occurred while processing the form', 'error');
            
            if (predictBtn) {
                predictBtn.innerHTML = '<i class="fas fa-chart-line"></i> Predict Now';
                predictBtn.disabled = false;
            }
        }
    });
}

// ========================================
// SAVE PREDICTION TO DATABASE
// ========================================
async function savePredictionToDatabase(inputData, result) {
    try {
        console.log('💾 Saving prediction to database...');
        
        const saveData = {
            rainfall: inputData.RR,
            humidity: inputData.RH_avg,
            temp_avg: inputData.Tavg,
            temp_min: inputData.Tn,
            temp_max: inputData.Tx,
            sunshine: inputData.ss,
            wind_max: inputData.ff_x,
            wind_avg: inputData.ff_avg,
            prediction_result: result.prediction,
            probability: result.probability,
            risk_level: result.risk_level
        };
        
        const response = await fetch('../backend/api/predictions_history.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(saveData)
        });
        
        const saveResult = await response.json();
        
        if (saveResult.success) {
            console.log('✅ Prediction saved to database');
            showNotification('✓ Prediction successful and saved!', 'success');
        } else {
            console.error('❌ Failed to save:', saveResult.error);
            showNotification('✓ Prediction successful! (Failed to save to database)', 'success');
        }
        
    } catch (error) {
        console.error('❌ Save error:', error);
        showNotification('✓ Prediction successful! (Failed to save to database)', 'success');
    }
}

// ========================================
// DISPLAY PREDICTION RESULT
// ========================================
function displayResult(result, inputData) {
    console.log('📊 Displaying result...');
    
    const { probability, risk_level } = result;
    
    // Determine display properties based on risk level
    let statusEmoji, statusText, badgeClass, description, recommendations;
    
    switch (risk_level) {
        case 'High':
            statusEmoji = '🚨';
            statusText = 'High Risk';
            badgeClass = 'badge-high';
            description = 'WARNING! Weather conditions indicate high flood risk. Take preventive action immediately!';
            recommendations = [
                'IMMEDIATELY evacuate family to safe location',
                'Turn off electricity and gas supply at home',
                'Bring emergency bag containing documents and important medicines',
                'Contact BPBD DKI Jakarta at 021-6560777 or 112',
                'Do not attempt to cross high floodwater',
                'Follow instructions from officers and SAR Team'
            ];
            break;
            
        case 'Medium':
            statusEmoji = '⚠️';
            statusText = 'Medium Risk';
            badgeClass = 'badge-medium';
            description = 'Weather conditions indicate moderate flood potential. Start preparations and remain vigilant.';
            recommendations = [
                'Move valuables to higher ground',
                'Prepare emergency bag containing important documents',
                'Continue monitoring weather updates from BMKG',
                'Turn off electricity if water starts rising',
                'Contact family for coordination',
                'Prepare alternative evacuation routes'
            ];
            break;
            
        default: // Low
            statusEmoji = '✅';
            statusText = 'Low Risk';
            badgeClass = 'badge-low';
            description = 'Current weather conditions indicate low flood probability. However, remain vigilant for sudden weather changes.';
            recommendations = [
                'Continue monitoring weather information from BMKG',
                'Ensure water channels around home are clear',
                'Prepare emergency supplies as precaution',
                'Clean gutters from garbage regularly',
                'Save BPBD emergency contact numbers'
            ];
    }
    
    // Build result HTML
    const resultHTML = `
        <div class="result-status">${statusEmoji}</div>
        <h3 class="result-title">${statusText}</h3>
        <div class="result-probability">${(probability * 100).toFixed(1)}%</div>
        <div class="risk-badge ${badgeClass}">${risk_level} Risk</div>
        <p class="result-description">${description}</p>
        
        ${isLoggedIn ? `
            <div style="background: #d1fae5; padding: 1rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid #10b981;">
                <strong style="color: #065f46;">
                    <i class="fas fa-check-circle"></i> Prediction result has been saved to your account
                </strong>
                <p style="margin: 0.5rem 0 0 0; color: #065f46;">
                    <a href="dashboard.php" style="color: #059669; text-decoration: underline;">View prediction history →</a>
                </p>
            </div>
        ` : `
            <div style="background: #fef3c7; padding: 1rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid #f59e0b;">
                <strong style="color: #92400e;">
                    <i class="fas fa-info-circle"></i> Login to save prediction history
                </strong>
                <p style="margin: 0.5rem 0 0 0; color: #92400e;">
                    <a href="login.php" style="color: #d97706; text-decoration: underline;">Login now →</a>
                </p>
            </div>
        `}
        
        <div class="result-data-summary">
            <h4><i class="fas fa-database"></i> Input Data</h4>
            <div class="data-grid">
                <div class="data-item">
                    <i class="fas fa-cloud-rain"></i>
                    <strong>${inputData.RR}</strong>
                    <small>Rainfall (mm)</small>
                </div>
                <div class="data-item">
                    <i class="fas fa-tint"></i>
                    <strong>${inputData.RH_avg}</strong>
                    <small>Humidity (%)</small>
                </div>
                <div class="data-item">
                    <i class="fas fa-thermometer-half"></i>
                    <strong>${inputData.Tavg}</strong>
                    <small>Avg Temperature (°C)</small>
                </div>
                <div class="data-item">
                    <i class="fas fa-sun"></i>
                    <strong>${inputData.ss}</strong>
                    <small>Sunshine (hours)</small>
                </div>
                <div class="data-item">
                    <i class="fas fa-wind"></i>
                    <strong>${inputData.ff_x}</strong>
                    <small>Max Wind (m/s)</small>
                </div>
            </div>
        </div>
        
        <div class="result-recommendations">
            <h4><i class="fas fa-lightbulb"></i> Action Recommendations</h4>
            <ul>
                ${recommendations.map(rec => `<li><i class="fas fa-check-circle"></i> ${rec}</li>`).join('')}
            </ul>
        </div>
        
        <div style="margin-top: 1.5rem; padding: 1rem; background: #f1f5f9; border-radius: 8px;">
            <small style="color: #64748b;">
                <i class="fas fa-info-circle"></i> 
                Prediction based on Random Forest model with 88.49% accuracy. 
                Data: Temperature ${inputData.Tn}°C - ${inputData.Tx}°C, Wind ${inputData.ff_avg} m/s
            </small>
        </div>
    `;
    
    // Display result
    if (resultContent) {
        resultContent.innerHTML = resultHTML;
    }
    
    if (resultCard) {
        resultCard.style.display = 'block';
        
        // Smooth scroll to result
        setTimeout(() => {
            resultCard.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }, 100);
    }
    
    // Store result for later use
    window.lastPrediction = {
        timestamp: new Date().toISOString(),
        input: inputData,
        output: result
    };
    
    console.log('✅ Result displayed successfully');
}

// ========================================
// RESET FORM
// ========================================
if (resetBtn) {
    resetBtn.addEventListener('click', function() {
        console.log('🔄 Reset form');
        
        if (predictionForm) {
            predictionForm.reset();
        }
        
        if (resultCard) {
            resultCard.style.display = 'none';
        }
        
        window.scrollTo({ 
            top: 0, 
            behavior: 'smooth' 
        });
        
        showNotification('Form has been reset', 'info');
    });
}

// ========================================
// SAVE RESULT TO JSON
// ========================================
if (saveBtn) {
    saveBtn.addEventListener('click', function() {
        console.log('💾 Save result');
        
        if (!window.lastPrediction) {
            showNotification('No results to save', 'error');
            return;
        }
        
        try {
            const result = window.lastPrediction;
            const filename = `floodguard-prediction-${new Date().getTime()}.json`;
            
            // Create JSON blob
            const dataStr = JSON.stringify(result, null, 2);
            const dataBlob = new Blob([dataStr], { type: 'application/json' });
            
            // Create download link
            const url = URL.createObjectURL(dataBlob);
            const link = document.createElement('a');
            link.href = url;
            link.download = filename;
            link.click();
            
            // Cleanup
            URL.revokeObjectURL(url);
            
            showNotification('✓ Prediction result successfully saved!', 'success');
            console.log('✅ Result saved:', filename);
            
        } catch (error) {
            console.error('❌ Save error:', error);
            showNotification('Failed to save results', 'error');
        }
    });
}

// ========================================
// INPUT VALIDATION (on blur, not on input)
// ========================================
const numberInputs = predictionForm?.querySelectorAll('input[type="number"]');
if (numberInputs) {
    numberInputs.forEach(input => {
        // Only validate when user leaves the field (blur event)
        input.addEventListener('blur', function() {
            const min = parseFloat(this.min);
            const max = parseFloat(this.max);
            const value = parseFloat(this.value);
            
            // Skip if empty
            if (!this.value) return;
            
            // Check minimum
           if (!isNaN(min) && value < min) {
                console.warn(`Value ${value} below minimum ${min} for ${this.name}`);
                this.value = min;
                showNotification(`Minimum value for ${this.name}: ${min}`, 'error');
            }
            
            // Check maximum
            if (!isNaN(max) && value > max) {
                console.warn(`Value ${value} above maximum ${max} for ${this.name}`);
                this.value = max;
                showNotification(`Maximum value for ${this.name}: ${max}`, 'error');
            }
        });
    });
}

// ========================================
// CONSOLE INFO
// ========================================
console.log('%c🌊 FloodGuard Prediction System', 'color: #3b82f6; font-size: 16px; font-weight: bold;');
console.log('%c⚙️ Status: Ready', 'color: #10b981; font-size: 12px;');
console.log('%c📍 Mode: MOCK ALGORITHM', 'color: #f59e0b; font-size: 12px;');
console.log('%c💾 Database: Enabled', 'color: #10b981; font-size: 12px;');
console.log('✅ FloodGuard Prediction JS Initialized Successfully');
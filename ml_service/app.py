# ===================================
# FLOODGUARD - ML SERVICE (Flask)
# ===================================

from flask import Flask, request, jsonify
from flask_cors import CORS
import pickle
import numpy as np
import pandas as pd
import os
from datetime import datetime

app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

# Load models and preprocessors
MODEL_DIR = 'models'

try:
    with open(os.path.join(MODEL_DIR, 'flood_model.pkl'), 'rb') as f:
        model = pickle.load(f)
    
    with open(os.path.join(MODEL_DIR, 'scaler.pkl'), 'rb') as f:
        scaler = pickle.load(f)
    
    with open(os.path.join(MODEL_DIR, 'imputer.pkl'), 'rb') as f:
        imputer = pickle.load(f)
    
    with open(os.path.join(MODEL_DIR, 'feature_names.pkl'), 'rb') as f:
        feature_names = pickle.load(f)
    
    print("✅ Models loaded successfully!")
    print(f"Features: {feature_names}")
    
except Exception as e:
    print(f"❌ Error loading models: {e}")
    print("Please ensure all .pkl files are in the 'models' directory")
    model = None
    scaler = None
    imputer = None
    feature_names = None


@app.route('/', methods=['GET'])
def home():
    """Health check endpoint"""
    return jsonify({
        'status': 'online',
        'service': 'FloodGuard ML Service',
        'model_loaded': model is not None,
        'version': '1.0.0',
        'timestamp': datetime.now().isoformat()
    })


@app.route('/predict', methods=['POST'])
def predict():
    """
    Predict flood probability based on weather data
    
    Expected JSON input:
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
    """
    
    # Check if models are loaded
    if model is None or scaler is None or imputer is None:
        return jsonify({
            'success': False,
            'error': 'ML models not loaded. Please check server configuration.'
        }), 503
    
    try:
        # Get JSON data
        data = request.get_json()
        
        if not data:
            return jsonify({
                'success': False,
                'error': 'No data provided'
            }), 400
        
        # Validate required fields
        required_fields = ['Tn', 'Tx', 'Tavg', 'RH_avg', 'RR', 'ss', 'ff_x', 'ff_avg']
        missing_fields = [field for field in required_fields if field not in data]
        
        if missing_fields:
            return jsonify({
                'success': False,
                'error': f'Missing required fields: {", ".join(missing_fields)}'
            }), 400
        
        # Prepare input data
        input_data = pd.DataFrame({
            'Tn': [float(data['Tn'])],
            'Tx': [float(data['Tx'])],
            'Tavg': [float(data['Tavg'])],
            'RH_avg': [float(data['RH_avg'])],
            'RR': [float(data['RR'])],
            'ss': [float(data['ss'])],
            'ff_x': [float(data['ff_x'])],
            'ff_avg': [float(data['ff_avg'])]
        })
        
        # Validate data ranges
        if not validate_input_ranges(input_data):
            return jsonify({
                'success': False,
                'error': 'Input values out of valid range'
            }), 400
        
        # Preprocessing pipeline
        # 1. Impute missing values (if any)
        input_imputed = imputer.transform(input_data)
        
        # 2. Scale features
        input_scaled = scaler.transform(input_imputed)
        
        # 3. Make prediction
        prediction = model.predict(input_scaled)[0]
        probability = model.predict_proba(input_scaled)[0][1]
        
        # 4. Determine risk level
        if probability < 0.3:
            risk_level = 'Low'
        elif probability < 0.7:
            risk_level = 'Medium'
        else:
            risk_level = 'High'
        
        # Log prediction
        log_prediction(data, prediction, probability, risk_level)
        
        # Return result
        return jsonify({
            'success': True,
            'prediction': int(prediction),
            'probability': float(probability),
            'risk_level': risk_level,
            'model_accuracy': 0.8849,
            'timestamp': datetime.now().isoformat(),
            'input_summary': {
                'rainfall': float(data['RR']),
                'humidity': float(data['RH_avg']),
                'temperature': float(data['Tavg'])
            }
        })
    
    except ValueError as e:
        return jsonify({
            'success': False,
            'error': f'Invalid input data: {str(e)}'
        }), 400
    
    except Exception as e:
        print(f"Prediction error: {e}")
        return jsonify({
            'success': False,
            'error': 'Internal server error during prediction'
        }), 500


@app.route('/model-info', methods=['GET'])
def model_info():
    """Get information about the loaded model"""
    
    if model is None:
        return jsonify({
            'success': False,
            'error': 'Model not loaded'
        }), 503
    
    try:
        # Get model parameters
        model_params = model.get_params()
        
        # Get feature importances
        feature_importances = {}
        if hasattr(model, 'feature_importances_'):
            importances = model.feature_importances_
            feature_importances = {
                feature_names[i]: float(importances[i])
                for i in range(len(feature_names))
            }
            # Sort by importance
            feature_importances = dict(
                sorted(feature_importances.items(), key=lambda x: x[1], reverse=True)
            )
        
        return jsonify({
            'success': True,
            'model_type': type(model).__name__,
            'features': feature_names,
            'feature_importances': feature_importances,
            'model_parameters': {
                'n_estimators': model_params.get('n_estimators'),
                'max_depth': model_params.get('max_depth'),
                'min_samples_split': model_params.get('min_samples_split')
            },
            'accuracy': 0.8849,
            'auc_roc': 0.7985
        })
    
    except Exception as e:
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500


def validate_input_ranges(df):
    """Validate input data is within reasonable ranges"""
    
    validations = {
        'Tn': (15, 50),      # Min temp: 15-50°C
        'Tx': (20, 50),      # Max temp: 20-50°C
        'Tavg': (20, 45),    # Avg temp: 20-45°C
        'RH_avg': (0, 100),  # Humidity: 0-100%
        'RR': (0, 500),      # Rainfall: 0-500mm
        'ss': (0, 12),       # Sunshine: 0-12 hours
        'ff_x': (0, 30),     # Wind speed max: 0-30 m/s
        'ff_avg': (0, 20)    # Wind speed avg: 0-20 m/s
    }
    
    for col, (min_val, max_val) in validations.items():
        if col in df.columns:
            value = df[col].iloc[0]
            if value < min_val or value > max_val:
                print(f"Validation failed: {col} = {value} (expected {min_val}-{max_val})")
                return False
    
    return True


def log_prediction(input_data, prediction, probability, risk_level):
    """Log prediction to file for monitoring"""
    
    try:
        log_dir = 'logs'
        os.makedirs(log_dir, exist_ok=True)
        
        log_file = os.path.join(log_dir, f'predictions_{datetime.now().strftime("%Y%m%d")}.log')
        
        with open(log_file, 'a') as f:
            log_entry = {
                'timestamp': datetime.now().isoformat(),
                'input': input_data,
                'prediction': int(prediction),
                'probability': float(probability),
                'risk_level': risk_level
            }
            f.write(f"{log_entry}\n")
    
    except Exception as e:
        print(f"Logging error: {e}")


@app.errorhandler(404)
def not_found(error):
    return jsonify({
        'success': False,
        'error': 'Endpoint not found'
    }), 404


@app.errorhandler(500)
def internal_error(error):
    return jsonify({
        'success': False,
        'error': 'Internal server error'
    }), 500


if __name__ == '__main__':
    print("=" * 60)
    print("🌊 FLOODGUARD ML SERVICE")
    print("=" * 60)
    print(f"Starting Flask server...")
    print(f"Models directory: {os.path.abspath(MODEL_DIR)}")
    print(f"Server will run on: http://localhost:5000")
    print("=" * 60)
    
    # Run Flask app
    app.run(
        host='0.0.0.0',
        port=5000,
        debug=True  # Set to False in production
    )
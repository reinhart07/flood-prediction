<?php 
session_start();
// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}
$title = "Register - FloodGuard Jakarta";
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
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0a2463 0%, #1e3a8a 100%);
            padding: 2rem;
        }
        
        .auth-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            max-width: 500px;
            width: 100%;
            overflow: hidden;
        }
        
        .auth-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: #f1f5f9;
            padding: 2rem;
            text-align: center;
        }
        
        .auth-header h1 {
            margin: 0;
            font-size: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .auth-header p {
            margin: 0.5rem 0 0 0;
            color: #cbd5e1;
        }
        
        .auth-body {
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.5rem;
        }
        
        .form-group input {
            width: 100%;
            padding: 0.875rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            background: #f8fafc;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .password-toggle {
            position: relative;
        }
        
        .password-toggle button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 0.5rem;
        }
        
        .btn-auth {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%);
            color: #f1f5f9;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4);
        }
        
        .btn-auth:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            transform: none;
        }
        
        .auth-footer {
            text-align: center;
            padding: 1.5rem 2rem;
            background: #f1f5f9;
            border-top: 1px solid #e2e8f0;
        }
        
        .auth-footer a {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
        }
        
        .auth-footer a:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: none;
        }
        
        .alert.show {
            display: block;
        }
        
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }
        
        .back-home {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #f1f5f9;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .back-home:hover {
            transform: translateX(-5px);
        }
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 0.5rem;
            background: #e2e8f0;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
        }
        
        .strength-weak { background: #ef4444; width: 33%; }
        .strength-medium { background: #f59e0b; width: 66%; }
        .strength-strong { background: #10b981; width: 100%; }
    </style>
</head>
<body>
    <div class="auth-container">
        <a href="../index.php" class="back-home">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>
        
        <div class="auth-card">
            <div class="auth-header">
                <h1><i class="fas fa-shield-alt"></i> FloodGuard</h1>
                <p>Daftar akun baru</p>
            </div>
            
            <div class="auth-body">
                <div id="alert" class="alert"></div>
                
                <form id="registerForm">
                    <div class="form-group">
                        <label for="full_name">
                            <i class="fas fa-id-card"></i> Nama Lengkap
                        </label>
                        <input 
                            type="text" 
                            id="full_name" 
                            name="full_name" 
                            placeholder="Contoh: John Doe"
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="username">
                            <i class="fas fa-user"></i> Username
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            placeholder="Contoh: johndoe"
                            required
                            autocomplete="username"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="Contoh: john@example.com"
                            required
                            autocomplete="email"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">
                            <i class="fas fa-phone"></i> No. Telepon (Opsional)
                        </label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            placeholder="Contoh: 081234567890"
                            autocomplete="tel"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div class="password-toggle">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Minimal 6 karakter"
                                required
                                autocomplete="new-password"
                            >
                            <button type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="strengthBar"></div>
                        </div>
                        <small id="strengthText" style="color: #64748b; font-size: 0.85rem;"></small>
                    </div>
                    
                    <button type="submit" class="btn-auth" id="registerBtn">
                        <i class="fas fa-user-plus"></i> Daftar
                    </button>
                </form>
            </div>
            
            <div class="auth-footer">
                Sudah punya akun? <a href="login.php">Masuk di sini</a>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            strengthBar.className = 'password-strength-bar';
            
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Password lemah';
                strengthText.style.color = '#ef4444';
            } else if (strength <= 4) {
                strengthBar.classList.add('strength-medium');
                strengthText.textContent = 'Password sedang';
                strengthText.style.color = '#f59e0b';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Password kuat';
                strengthText.style.color = '#10b981';
            }
        });

        // Show alert
        function showAlert(message, type) {
            const alert = document.getElementById('alert');
            alert.className = `alert alert-${type} show`;
            alert.innerHTML = `<i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}"></i> ${message}`;
            
            setTimeout(() => {
                alert.classList.remove('show');
            }, 5000);
        }

        // Register form
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const registerBtn = document.getElementById('registerBtn');
            const formData = new FormData(this);
            
            const data = {
                full_name: formData.get('full_name').trim(),
                username: formData.get('username').trim(),
                email: formData.get('email').trim(),
                phone: formData.get('phone').trim(),
                password: formData.get('password')
            };
            
            // Validate
            if (!data.full_name || !data.username || !data.email || !data.password) {
                showAlert('Mohon isi semua field yang wajib', 'error');
                return;
            }
            
            if (data.password.length < 6) {
                showAlert('Password minimal 6 karakter', 'error');
                return;
            }
            
            // Disable button
            registerBtn.disabled = true;
            registerBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mendaftar...';
            
            try {
                const response = await fetch('../backend/api/auth.php?action=register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showAlert('Registrasi berhasil! Mengalihkan...', 'success');
                    setTimeout(() => {
                        window.location.href = 'dashboard.php';
                    }, 1500);
                } else {
                    showAlert(result.error || 'Registrasi gagal', 'error');
                    registerBtn.disabled = false;
                    registerBtn.innerHTML = '<i class="fas fa-user-plus"></i> Daftar';
                }
                
            } catch (error) {
                console.error('Register error:', error);
                showAlert('Terjadi kesalahan koneksi', 'error');
                registerBtn.disabled = false;
                registerBtn.innerHTML = '<i class="fas fa-user-plus"></i> Daftar';
            }
        });
    </script>
</body>
</html>
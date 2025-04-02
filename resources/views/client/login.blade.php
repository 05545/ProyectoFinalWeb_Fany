<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Moderno</title>
  <!-- Bootstrap 4 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Custom CSS -->
  <style>
    :root {
      --purple-primary: #8e44ad;
      --purple-light: #9b59b6;
      --purple-dark: #6c3483;
      --purple-transparent: rgba(142, 68, 173, 0.2);
      --dark-bg: #1a1a2e;
      --dark-secondary: #16213e;
    }
    
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, var(--dark-bg), var(--dark-secondary), #2a1b3d);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .login-container {
      max-width: 420px;
      width: 100%;
      position: relative;
      overflow: hidden;
    }
    
    .login-card {
      background-color: rgba(26, 26, 46, 0.8);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5), 0 5px 15px rgba(142, 68, 173, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.1);
      animation: fadeIn 0.6s ease-out forwards;
    }
    
    .card-header {
      border-bottom: none;
      text-align: center;
      padding: 30px 20px 0;
      background-color: transparent;
    }
    
    .card-footer {
      background: linear-gradient(to right, var(--purple-light), var(--purple-primary), var(--purple-dark));
      height: 8px;
      padding: 0;
      border: none;
    }
    
    .icon-circle {
      width: 80px;
      height: 80px;
      background-color: var(--purple-primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: 0 10px 20px rgba(142, 68, 173, 0.3);
    }
    
    .form-control {
      background-color: rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(142, 68, 173, 0.3);
      color: white;
      border-radius: 8px;
      height: 50px;
      padding-left: 45px;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      background-color: rgba(0, 0, 0, 0.4);
      border-color: var(--purple-primary);
      box-shadow: 0 0 0 0.2rem rgba(142, 68, 173, 0.25);
      color: white;
    }
    
    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }
    
    .input-group-text {
      background-color: transparent;
      border: none;
      position: absolute;
      z-index: 10;
      height: 50px;
      color: rgba(255, 255, 255, 0.6);
      transition: color 0.3s ease;
    }
    
    .form-group {
      position: relative;
      margin-bottom: 20px;
    }
    
    .form-group:focus-within .input-group-text {
      color: var(--purple-light);
    }
    
    .btn-purple {
      background-color: var(--purple-primary);
      border: none;
      color: white;
      border-radius: 8px;
      padding: 12px;
      font-weight: 600;
      letter-spacing: 0.5px;
      box-shadow: 0 4px 15px rgba(142, 68, 173, 0.4);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    
    .btn-purple:hover {
      background-color: var(--purple-light);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(142, 68, 173, 0.6);
    }
    
    .btn-purple:active {
      transform: translateY(0);
      box-shadow: 0 4px 10px rgba(142, 68, 173, 0.4);
    }
    
    .btn-purple .spinner-border {
      width: 1.5rem;
      height: 1.5rem;
    }
    
    .custom-control-input:checked ~ .custom-control-label::before {
      background-color: var(--purple-primary);
      border-color: var(--purple-primary);
    }
    
    .custom-control-label {
      color: rgba(255, 255, 255, 0.8);
      font-size: 14px;
    }
    
    .custom-control-label::before {
      background-color: rgba(0, 0, 0, 0.3);
      border-color: rgba(142, 68, 173, 0.5);
    }
    
    .forgot-password {
      color: rgba(255, 255, 255, 0.8);
      font-size: 14px;
      transition: color 0.3s ease;
    }
    
    .forgot-password:hover {
      color: var(--purple-light);
      text-decoration: none;
    }
    
    .register-link {
      color: var(--purple-light);
      transition: color 0.3s ease;
    }
    
    .register-link:hover {
      color: white;
      text-decoration: none;
    }
    
    .password-toggle {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.6);
      cursor: pointer;
      z-index: 10;
      transition: color 0.3s ease;
    }
    
    .password-toggle:hover {
      color: var(--purple-light);
    }
    
    .error-message {
      color: #ff6b6b;
      font-size: 12px;
      margin-top: 5px;
      display: none;
      animation: slideIn 0.3s ease-out forwards;
    }
    
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-5px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .btn-icon {
      margin-left: 8px;
      transition: transform 0.3s ease;
    }
    
    .btn-purple:hover .btn-icon {
      transform: translateX(4px);
    }
    
    .ripple {
      position: absolute;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.4);
      transform: scale(0);
      animation: ripple 0.6s linear;
    }
    
    @keyframes ripple {
      to {
        transform: scale(2.5);
        opacity: 0;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="card login-card">
      <div class="card-header">
        <div class="icon-circle">
          <i class="fas fa-lock fa-2x text-white"></i>
        </div>
        <h3 class="text-white mb-2">Bienvenido de nuevo</h3>
        <p class="text-white-50">Ingresa tus credenciales para continuar</p>
      </div>
      
      <div class="card-body p-4">
        <form id="loginForm">
          <div class="form-group">
            <span class="input-group-text">
              <i class="fas fa-envelope"></i>
            </span>
            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
            <div class="error-message" id="emailError"></div>
          </div>
          
          <div class="form-group">
            <span class="input-group-text">
              <i class="fas fa-lock"></i>
            </span>
            <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
            <span class="password-toggle" id="passwordToggle">
              <i class="fas fa-eye"></i>
            </span>
            <div class="error-message" id="passwordError"></div>
          </div>
          
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="rememberMe">
              <label class="custom-control-label" for="rememberMe">Recordarme</label>
            </div>
            <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
          </div>
          
          <button type="submit" class="btn btn-purple btn-block" id="loginButton">
            <span id="buttonText">Iniciar sesión</span>
            <i class="fas fa-arrow-right btn-icon"></i>
            <span class="spinner-border spinner-border-sm d-none" id="loadingSpinner" role="status" aria-hidden="true"></span>
          </button>
        </form>
        
        <div class="text-center mt-4">
          <p class="text-white-50">
            ¿No tienes una cuenta? <a href="#" class="register-link">Regístrate</a>
          </p>
        </div>
      </div>
      
      <div class="card-footer"></div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
  
  <!-- Custom JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Elements
      const loginForm = document.getElementById('loginForm');
      const emailInput = document.getElementById('email');
      const passwordInput = document.getElementById('password');
      const emailError = document.getElementById('emailError');
      const passwordError = document.getElementById('passwordError');
      const passwordToggle = document.getElementById('passwordToggle');
      const loginButton = document.getElementById('loginButton');
      const buttonText = document.getElementById('buttonText');
      const loadingSpinner = document.getElementById('loadingSpinner');
      
      // Toggle password visibility
      passwordToggle.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Toggle eye icon
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
      });
      
      // Validate email
      function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
      }
      
      // Form validation
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        
        // Reset errors
        emailError.style.display = 'none';
        passwordError.style.display = 'none';
        
        // Validate email
        if (!emailInput.value) {
          emailError.textContent = 'El correo es requerido';
          emailError.style.display = 'block';
          isValid = false;
        } else if (!validateEmail(emailInput.value)) {
          emailError.textContent = 'Ingresa un correo válido';
          emailError.style.display = 'block';
          isValid = false;
        }
        
        // Validate password
        if (!passwordInput.value) {
          passwordError.textContent = 'La contraseña es requerida';
          passwordError.style.display = 'block';
          isValid = false;
        } else if (passwordInput.value.length < 6) {
          passwordError.textContent = 'La contraseña debe tener al menos 6 caracteres';
          passwordError.style.display = 'block';
          isValid = false;
        }
        
        // If valid, submit form
        if (isValid) {
          // Show loading state
          buttonText.textContent = 'Iniciando sesión';
          loadingSpinner.classList.remove('d-none');
          loginButton.disabled = true;
          
          // Simulate API call
          setTimeout(function() {
            console.log('Form submitted:', {
              email: emailInput.value,
              password: passwordInput.value,
              rememberMe: document.getElementById('rememberMe').checked
            });
            
            // Reset loading state
            buttonText.textContent = 'Iniciar sesión';
            loadingSpinner.classList.add('d-none');
            loginButton.disabled = false;
            
            // Here you would typically redirect or show success message
          }, 1500);
        }
      });
      
      // Add ripple effect to button
      loginButton.addEventListener('click', function(e) {
        const x = e.clientX - e.target.getBoundingClientRect().left;
        const y = e.clientY - e.target.getBoundingClientRect().top;
        
        const ripple = document.createElement('span');
        ripple.classList.add('ripple');
        ripple.style.left = `${x}px`;
        ripple.style.top = `${y}px`;
        
        this.appendChild(ripple);
        
        setTimeout(function() {
          ripple.remove();
        }, 600);
      });
      
      // Input focus effects
      const formControls = document.querySelectorAll('.form-control');
      formControls.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
          this.parentElement.classList.remove('focused');
        });
      });
    });
  </script>
</body>
</html>
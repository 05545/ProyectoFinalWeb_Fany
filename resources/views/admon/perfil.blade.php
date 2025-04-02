@extends('layouts.admin')

@section('content')
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tablero</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container-fluid mt-4">
    <div class="content-wrapper">
      <div class="container mt-4">
        <div class="row">
          <!-- Columna izquierda: Información del Usuario -->
          <div class="col-lg-4 mb-4">
            <div class="profile-card">
              <div class="profile-card-header">
                <h3 class="m-0 fw-bold fs-5">
                  <i class="fas fa-id-card me-2"></i> Tu perfil
                </h3>
              </div>
              <div class="card-body text-center p-5">
                <div class="position-relative mx-auto mb-4">
                  <div class="avatar-container position-relative mx-auto">
                    <img src="{{ asset('storage/' . (Auth::user()->imagen_usuario ?? 'default-avatar.png')) }}" alt="Foto de perfil">
                  </div>
                </div>
  
                <h2 class="fw-bold mb-1">{{ Auth::user()->nombre_usuario }}</h2>
                <p class="fs-5 text-muted mb-2">{{ Auth::user()->ap_usuario . ' ' . Auth::user()->am_usuario }}</p>
                <div class="d-flex justify-content-center align-items-center mb-4">
                  <span class="role-badge">
                    <i class="fas fa-crown"></i> {{ Auth::user()->id_rol == 745 ? 'Administrador' : 'Operador' }}
                  </span>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Columna derecha: Pestañas -->
          <div class="col-lg-8">
            <ul class="nav nav-tabs nav-tabs-modern mb-4" id="profileTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="info-tab" data-bs-toggle="tab"
                  data-bs-target="#info" type="button" role="tab" aria-selected="true">
                  <i class="fas fa-user-circle me-2 text-primary"></i>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="editar-tab" data-bs-toggle="tab"
                  data-bs-target="#editar" type="button" role="tab" aria-selected="false">
                  <i class="fas fa-pencil-alt me-2 text-primary"></i>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="password-tab" data-bs-toggle="tab"
                  data-bs-target="#password" type="button" role="tab" aria-selected="false">
                  <i class="fas fa-lock me-2 text-primary"></i>
                </button>
              </li>
            </ul>
  
            <!-- Contenido de las pestañas -->
            <div class="tab-content" id="profileTabsContent">
              <!-- Información personal -->
              <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                <div class="profile-card">
                  <div class="card-body p-4">
                    <h3 class="fw-bold mb-4 border-bottom pb-3 ">Detalles de la cuenta</h3>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex">
                        <div class="info-icon-container">
                          <i class="fas fa-user"></i>
                        </div>
                        <div class="flex-grow-1">
                          <span class="info-label">Nombre completo</span>
                          <span class="info-value d-block text-danger">{{ Auth::user()->nombre_usuario . ' ' . Auth::user()->ap_usuario . ' ' . Auth::user()->am_usuario }}</span>
                        </div>
                      </li>
                      <li class="list-group-item d-flex">
                        <div class="info-icon-container">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <div class="flex-grow-1">
                          <span class="info-label">Correo electrónico</span>
                          <span class="info-value d-block text-danger">{{ Auth::user()->email_usuario }}</span>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
  
              <!-- Editar perfil -->
              <div class="tab-pane fade" id="editar" role="tabpanel" aria-labelledby="editar-tab">
                <div class="profile-card">
                  <div class="card-body p-4">
                    <h3 class="fw-bold mb-4 border-bottom pb-3">Editar información</h3>
                    <form id="form-editar-usuario" action="{{ route('admin.perfil.update', Auth::user()->id_usuario) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
  
                      <!-- Nombre -->
                      <div class="mb-4">
                        <label for="nombre_usuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" 
                               value="{{ Auth::user()->nombre_usuario }}" required>
                      </div>
  
                      <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                          <label for="ap_usuario" class="form-label">Apellido paterno</label>
                          <input type="text" class="form-control" id="ap_usuario" name="ap_usuario" 
                                 value="{{ Auth::user()->ap_usuario }}" required>
                        </div>
                        <div class="col-md-6">
                          <label for="am_usuario" class="form-label">Apellido materno</label>
                          <input type="text" class="form-control" id="am_usuario" name="am_usuario" 
                                 value="{{ Auth::user()->am_usuario }}">
                        </div>
                      </div>
  
                      <!-- Correo electrónico -->
                      <div class="mb-4">
                        <label for="email_usuario" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email_usuario" name="email_usuario" 
                               value="{{ Auth::user()->email_usuario }}" required>
                      </div>
  
                      <!-- Foto de perfil -->
                      <div class="mb-4">
                        <label for="imagen_usuario" class="form-label">Foto de perfil</label>
                        <input type="file" class="form-control" id="imagen_usuario" name="imagen_usuario">
                      </div>
  
                      <!-- Botón de guardar cambios -->
                      <div class="text-end mt-5">
                        <button id="btn-guardar-info" type="submit" class="btn btn-success btn-lg px-4">
                          <i class="fas fa-save me-2"></i>Guardar cambios
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
  
              <!-- Cambiar contraseña -->
              <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                <div class="profile-card">
                  <div class="card-body p-4">
                    <h3 class="fw-bold mb-4 border-bottom pb-3">Cambiar contraseña</h3>
                    <form id="form-cambiar-password" action="{{ route('admin.perfil.update_password', Auth::user()->id_usuario) }}" method="POST">
                      @csrf
                      @method('PUT')
                    
                      <div class="mb-4">
                        <label for="current_password" class="form-label">Contraseña actual</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                      </div>
                    
                      <div class="mb-4">
                        <label for="new_password" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                        <small id="password_error" class="text-danger"></small>
                      </div>
                    
                      <div class="mb-4">
                        <label for="new_password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        <small id="confirm_error" class="text-danger"></small>
                      </div>
                    
                      <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                        <button type="submit" class="btn btn-success btn-lg px-5">
                          <i class="fas fa-key me-2"></i>Cambiar contraseña
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Fin de pestañas -->
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const newPassword = document.getElementById('new_password');
      const newPasswordConfirmation = document.getElementById('new_password_confirmation');
      const confirmError = document.getElementById('confirm_error');
      const passwordError = document.getElementById('password_error');
      function validatePasswords() {
          const password = newPassword.value;
          const confirmPass = newPasswordConfirmation.value;
          // Verifica que la contraseña tenga más de 8 caracteres y contenga letras y números o símbolos
          const passwordPattern = /^(?=.*[A-Za-z])(?=.*[\d\W]).{8,}$/;
          passwordError.textContent = '';
          confirmError.textContent = '';
          if (!passwordPattern.test(password)) {
              passwordError.textContent = 'La contraseña debe tener al menos 8 caracteres e incluir letras y números o símbolos.';
              return false;
          }
          if (password !== confirmPass) {
              confirmError.textContent = 'Las contraseñas no coinciden.';
              return false;
          }
          return true;
      }
      newPassword.addEventListener('input', validatePasswords);
      newPasswordConfirmation.addEventListener('input', validatePasswords);
  });
  
</script>

<style>
  /* Estilos para la validación de contraseñas con tema RGB */
:root {
  /* Colores RGB vibrantes */
  --purple-primary: #9d00ff;
  --purple-light: #c17fff;
  --purple-dark: #6a00b0;
  --purple-glow: #b347ff;
  
  /* Colores RGB complementarios */
  --rgb-blue: #4d7cff;
  --rgb-pink: #ff3dbd;
  --rgb-cyan: #00e5ff;
  --rgb-yellow: #ffcc00;
  --rgb-green: #00ff88;
  
  /* Colores de fondo */
  --bg-dark: #0a0a0a;
  --bg-darker: #050505;
  --bg-card: #111111;
  
  /* Colores de texto */
  --text-light: #ffffff;
  --text-muted: #a0a0a0;
  
  /* Colores de borde */
  --border-color: #222222;
  --glow-intensity: 5px;
}

/* Estilos para el formulario de contraseña */
.profile-card {
  background-color: var(--bg-card);
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
  margin-bottom: 30px;
  border: 1px solid var(--border-color);
  position: relative;
}

.profile-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: linear-gradient(90deg, var(--purple-primary), var(--rgb-pink), var(--rgb-blue));
  background-size: 300% 100%;
  animation: gradient-move 5s ease infinite;
}

@keyframes gradient-move {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.card-body {
  padding: 2rem !important;
}

.form-label {
  color: var(--purple-light);
  font-weight: 600;
  margin-bottom: 0.5rem;
  font-family: 'Rajdhani', sans-serif;
  letter-spacing: 0.5px;
}

.form-control {
  background-color: rgba(10, 10, 10, 0.7);
  border: 1px solid var(--border-color);
  color: var(--text-light);
  border-radius: 8px;
  padding: 12px 15px;
  transition: all 0.3s ease;
  font-family: 'Rajdhani', sans-serif;
}

.form-control:focus {
  background-color: rgba(10, 10, 10, 0.9);
  color: var(--text-light);
  border-color: var(--purple-primary);
  box-shadow: 0 0 0 0.25rem rgba(157, 0, 255, 0.25);
}

/* Estilos para los requisitos de contraseña */
.password-requirements {
  background-color: rgba(10, 10, 10, 0.5);
  border-radius: 10px;
  padding: 15px;
  margin-top: 15px;
  border: 1px solid var(--border-color);
}

.requirements-list {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.requirement-item {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
  padding: 8px 12px;
  border-radius: 6px;
  transition: all 0.3s ease;
  color: var(--text-muted);
}

.requirement-item:last-child {
  margin-bottom: 0;
}

.req-icon {
  margin-right: 10px;
  width: 20px;
  text-align: center;
  transition: all 0.3s ease;
}

.requirement-met {
  color: var(--rgb-green);
  background-color: rgba(0, 255, 136, 0.1);
}

.requirement-met .req-icon {
  color: var(--rgb-green);
}

.requirement-failed {
  color: var(--text-muted);
  background-color: transparent;
}

/* Indicador de fortaleza de contraseña */
.password-strength-meter {
  margin-top: 15px;
}

.strength-meter-bar {
  height: 8px;
  background-color: var(--border-color);
  border-radius: 4px;
  overflow: hidden;
  margin-bottom: 8px;
}

.strength-meter-fill {
  height: 100%;
  width: 0;
  border-radius: 4px;
  transition: width 0.3s ease, background-color 0.3s ease;
}

.strength-very-weak {
  background: linear-gradient(90deg, #ff3d3d, #ff5252);
  box-shadow: 0 0 10px rgba(255, 61, 61, 0.5);
}

.strength-weak {
  background: linear-gradient(90deg, #ff7e3d, #ffaa52);
  box-shadow: 0 0 10px rgba(255, 126, 61, 0.5);
}

.strength-medium {
  background: linear-gradient(90deg, #ffcc00, #ffe066);
  box-shadow: 0 0 10px rgba(255, 204, 0, 0.5);
}

.strength-strong {
  background: linear-gradient(90deg, #00cc88, #00ff88);
  box-shadow: 0 0 10px rgba(0, 204, 136, 0.5);
}

.strength-very-strong {
  background: linear-gradient(90deg, #00cc88, #00ffaa);
  box-shadow: 0 0 10px rgba(0, 255, 170, 0.5);
}

.strength-text {
  font-size: 0.85rem;
  text-align: right;
  color: var(--text-muted);
  font-weight: 600;
  transition: color 0.3s ease;
}

/* Botón para mostrar/ocultar contraseña */
.password-toggle-btn {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: var(--text-muted);
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 5;
}

.password-toggle-btn:hover {
  color: var(--purple-light);
}

/* Estilos para el botón de envío */
.btn-success {
  background: linear-gradient(45deg, var(--rgb-green), #00cc6a) !important;
  border: none;
  color: var(--bg-dark) !important;
  font-weight: 600;
  letter-spacing: 1px;
  padding: 12px 30px;
  border-radius: 8px;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  z-index: 1;
  box-shadow: 0 5px 15px rgba(0, 255, 136, 0.3);
}

.btn-success::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(45deg, #00cc6a, var(--rgb-green));
  z-index: -1;
  transition: opacity 0.3s ease;
  opacity: 0;
}

.btn-success:hover::before {
  opacity: 1;
}

.btn-success:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0, 255, 136, 0.4);
}

/* Animaciones */
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
  20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.shake-animation {
  animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
}

.animated-alert {
  animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.fade-out {
  animation: fadeOut 0.5s ease forwards;
}

@keyframes fadeOut {
  from { opacity: 1; transform: translateY(0); }
  to { opacity: 0; transform: translateY(-10px); }
}

/* Estilos para las pestañas */
.nav-tabs-modern {
  border-bottom: 1px solid var(--border-color);
}

.nav-tabs-modern .nav-link {
  color: var(--text-muted);
  border: none;
  padding: 12px 20px;
  margin-right: 5px;
  border-radius: 8px 8px 0 0;
  transition: all 0.3s ease;
  position: relative;
  font-weight: 600;
  letter-spacing: 0.5px;
}

.nav-tabs-modern .nav-link::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: linear-gradient(90deg, var(--purple-primary), var(--rgb-pink));
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.nav-tabs-modern .nav-link:hover {
  color: var(--text-light);
  background-color: rgba(157, 0, 255, 0.1);
}

.nav-tabs-modern .nav-link.active {
  color: var(--text-light);
  background-color: transparent;
  border: none;
}

.nav-tabs-modern .nav-link.active::after {
  transform: scaleX(1);
}

.nav-tabs-modern .nav-link i {
  margin-right: 8px;
}

/* Estilos para mensajes de error */
.text-danger {
  color: var(--rgb-pink) !important;
  font-size: 0.85rem;
  margin-top: 5px;
  display: block;
}

/* Estilos para el avatar */
.avatar-container {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  overflow: hidden;
  border: 3px solid var(--purple-primary);
  box-shadow: 0 0 15px rgba(157, 0, 255, 0.5);
}

.avatar-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Estilos para la tarjeta de perfil */
.profile-card-header {
  background: linear-gradient(45deg, var(--purple-dark), var(--purple-primary));
  color: var(--text-light);
  padding: 15px 20px;
  border-bottom: 1px solid var(--border-color);
}

.role-badge {
  background: linear-gradient(45deg, var(--purple-primary), var(--rgb-pink));
  color: var(--text-light);
  padding: 8px 15px;
  border-radius: 20px;
  font-size: 0.9rem;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  box-shadow: 0 0 10px rgba(157, 0, 255, 0.3);
}

.role-badge i {
  margin-right: 8px;
}

/* Estilos para la información del usuario */
.info-icon-container {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: linear-gradient(45deg, var(--purple-dark), var(--purple-primary));
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 15px;
  color: var(--text-light);
  box-shadow: 0 0 10px rgba(157, 0, 255, 0.3);
}

.list-group-item {
  background-color: transparent;
  border-color: var(--border-color);
  padding: 15px;
}

.info-label {
  color: var(--text-muted);
  font-size: 0.9rem;
  display: block;
  margin-bottom: 5px;
}

.info-value {
  color: var(--text-light);
  font-weight: 600;
  font-size: 1.1rem;
}
</style>

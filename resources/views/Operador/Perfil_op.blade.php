@extends('layouts.appOp')

@section('content')
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="glow-text neon-text">Perfil</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container-fluid mt-4">
    <!-- Aquí puedes agregar tarjetas de estadísticas, gráficos, reportes, etc. -->
    <div class="col-lg-12 col-md-8 col-sm-12">
      <div class="card border-0 shadow-lg rounded-lg overflow-hidden">
        <div class="card-header bg-white p-0 border-0">
          <ul class="nav nav-tabs nav-tabs-modern" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active px-4 py-3" id="info-tab" data-bs-toggle="tab"
                data-bs-target="#info" type="button" role="tab" aria-selected="true">
                <i class="fas fa-user-circle me-2 text-teal-600 bg-dark"></i>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link px-4 py-3" id="editar-tab" data-bs-toggle="tab"
                data-bs-target="#editar" type="button" role="tab" aria-selected="false">
                <i class="fas fa-pencil-alt me-2 text-teal-600 bg-dark" ></i>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link px-4 py-3" id="password-tab" data-bs-toggle="tab"
                data-bs-target="#password" type="button" role="tab" aria-selected="false">
                <i class="fas fa-lock me-2 text-teal-600 bg-dark"></i>
              </button>
            </li>
          </ul>
        </div>

        <!-- Contenido de las pestañas -->
        <div class="tab-content p-4" id="profileTabsContent">
          <!-- Información personal -->
          <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
            <h3 class="fw-bold mb-4 pb-3 border-bottom text-light d-flex align-items-center">
              <i class="fas fa-info-circle text-teal-600 me-2"></i>
              Detalles de la cuenta
            </h3>
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="card bg-light border-0 h-100">
                  <div class="card-body p-4">
                    <h5 class="card-title text-teal-600 mb-3 text-dark d-flex align-items-center">
                      <i class="fas fa-user me-2"></i>Información personal
                    </h5>
                    
                    <div class="mb-3">
                      <div class="text-muted small mb-1">Nombre completo</div>
                      <div class="fw-medium fs-5 text-dark">{{ Auth::user()->nombre_usuario . ' ' . Auth::user()->ap_usuario . ' ' . Auth::user()->am_usuario }}</div>
                    </div>
                    
                    <div class="mb-3">
                      <div class="text-muted small mb-1">Correo electrónico</div>
                      <div class="fw-medium text-dark d-flex align-items-center">
                        <i class="fas fa-envelope-open text-teal-600 me-2"></i>
                        {{ Auth::user()->email_usuario }}
                      </div>
                    </div>
                    
                    <div>
                      <div class="text-muted small mb-1">Rol de usuario</div>
                      <div class="fw-medium">
                        <span class="badge bg-teal-50 text-teal-600 px-3 py-2 rounded-pill text-dark">
                          <i class="fas fa-crown me-1 text-danger"></i>
                          {{ Auth::user()->id_rol == 125 ? 'Operador' : 'Administrador' }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="text-end mt-3">
              <button class="btn btn-teal px-4" id="btn-edit-profile ">
                <i class="fas fa-pencil-alt me-2"></i>Editar información
              </button>
            </div>
          </div>

          <!-- Editar perfil -->
          <div class="tab-pane fade" id="editar" role="tabpanel" aria-labelledby="editar-tab  text-light">
            <h3 class="fw-bold mb-4 pb-3 border-bottom d-flex align-items-center text-light">
              <i class="fas fa-pencil-alt text-teal-600 me-2  text-light"></i>
              Editar información
            </h3>
            <form id="form-editar-usuario" action="{{ route('operador.perfil.update', Auth::user()->id_usuario) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              
              <div class="row mb-4">
                <div class="col-md-12 mb-4">
                  <div class="text-center">
                    <div class="position-relative d-inline-block">
                      <img src="{{ asset('storage/' . (Auth::user()->imagen_usuario ?? 'default-avatar.png')) }}" 
                           alt="Foto de perfil" 
                           class="rounded-circle border border-3 border-teal-100"
                           style="width: 120px; height: 120px; object-fit: cover;">
                      <label for="imagen_usuario" class="position-absolute bottom-0 end-0 bg-teal-600 text-white rounded-circle d-flex align-items-center justify-content-center cursor-pointer shadow-sm"
                             style="width: 36px; height: 36px; border: 3px solid white; cursor: pointer;">
                        <i class="fas fa-camera"></i>
                      </label>
                    </div>
                    <div class="mt-2 text-muted small">Haz clic en el ícono para cambiar tu foto</div>
                    <input type="file" class="d-none" id="imagen_usuario" name="imagen_usuario">
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- Nombre -->
                <div class="col-md-4 mb-4">
                  <label for="nombre_usuario" class="form-label fw-medium text-success">
                    <i class="fas fa-user text-teal-600 me-2 text-light"></i>Nombre
                  </label>
                  <input type="text" class="form-control border-teal-200" id="nombre_usuario" name="nombre_usuario" 
                         value="{{ Auth::user()->nombre_usuario }}" required>
                </div>

                <!-- Apellidos -->
                <div class="col-md-4 mb-4">
                  <label for="ap_usuario" class="form-label fw-medium text-success">
                    <i class="fas fa-id-card text-teal-600 me-2 text-light"></i>Apellido paterno
                  </label>
                  <input type="text" class="form-control border-teal-200" id="ap_usuario" name="ap_usuario" 
                         value="{{ Auth::user()->ap_usuario }}" required>
                </div>
                
                <div class="col-md-4 mb-4">
                  <label for="am_usuario" class="form-label fw-medium text-success">
                    <i class="fas fa-id-card-alt text-teal-600 me-2 text-light"></i>Apellido materno
                  </label>
                  <input type="text" class="form-control border-teal-200" id="am_usuario" name="am_usuario" 
                         value="{{ Auth::user()->am_usuario }}">
                </div>
              </div>

              <!-- Correo electrónico -->
              <div class="mb-4">
                <label for="email_usuario" class="form-label fw-medium text-success">
                  <i class="fas fa-envelope text-teal-600 me-2 text-light"></i>Correo electrónico
                </label>
                <input type="email" class="form-control border-teal-200" id="email_usuario" name="email_usuario" 
                       value="{{ Auth::user()->email_usuario }}" required>
              </div>

              <!-- Botones de acción -->
              <div class="d-flex justify-content-between mt-5">
                <button type="button" class="btn btn-light px-4" id="btn-cancel-edit">
                  <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button id="btn-guardar-info" type="submit" class="btn btn-teal px-4 py-2">
                  <i class="fas fa-save me-2"></i>Guardar cambios
                </button>
              </div>
            </form>
          </div>

          <!-- Cambiar contraseña -->
          <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
            <h3 class="fw-bold mb-4 pb-3 border-bottom text-light d-flex align-items-center">
              <i class="fas fa-lock text-teal-600 me-2 text-light"></i>
              Cambiar contraseña
            </h3>
            <div class="alert alert-info bg-teal-50 border-0 text-teal-600 d-flex align-items-center mb-4">
              <i class="fas fa-info-circle me-3 fa-lg"></i>
              <div>
                Para mayor seguridad, tu contraseña debe tener al menos 8 caracteres e incluir letras mayúsculas, minúsculas, números y símbolos especiales.
              </div>
            </div>
            
            <form id="form-cambiar-password" action="{{ route('operador.perfil.update_password', Auth::user()->id_usuario) }}" method="POST" onsubmit="return validatePasswordForm()">
              @csrf
              @method('PUT')
            
              <div class="mb-4">
                <label for="current_password" class="form-label fw-medium text-success">
                  <i class="fas fa-key text-teal-600 me-2 text-light"></i>Contraseña actual
                </label>
                <div class="input-group">
                  <input type="password" class="form-control border-teal-200" id="current_password" name="current_password" required>
                  <button class="btn btn-outline-secondary border-teal-200 toggle-password" type="button" data-target="current_password">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
              </div>
            
              <div class="mb-4">
                <label for="new_password" class="form-label fw-medium text-success">
                  <i class="fas fa-lock text-teal-600 me-2 text-light"></i>Nueva contraseña
                </label>
                <div class="input-group">
                  <input type="password" class="form-control border-teal-200" id="new_password" name="new_password" required>
                  <button class="btn btn-outline-secondary border-teal-200 toggle-password" type="button" data-target="new_password">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
                <small id="password_error" class="text-danger"></small>
                
                <div class="password-strength mt-3">
                  <div class="d-flex justify-content-between mb-1">
                    <span class="small">Seguridad de la contraseña</span>
                    <span class="small text-teal-600" id="password-strength-text">Débil</span>
                  </div>
                  <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-danger" id="password-strength-bar" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                
                <div class="password-requirements mt-3">
                  <p class="text-muted small mb-2">La contraseña debe contener:</p>
                  <ul class="list-unstyled small">
                    <!--Mensajes de erro-->
                    <li class="mb-1 d-flex align-items-center" id="req-length">
                      <i class="fas fa-circle text-muted me-2" style="font-size: 8px;"></i>
                      Al menos 8 caracteres
                    </li>
                    <li class="mb-1 d-flex align-items-center" id="req-uppercase">
                      <i class="fas fa-circle text-muted me-2" style="font-size: 8px;"></i>
                      Al menos una letra mayúscula
                    </li>
                    <li class="mb-1 d-flex align-items-center" id="req-lowercase">
                      <i class="fas fa-circle text-muted me-2" style="font-size: 8px;"></i>
                      Al menos una letra minúscula
                    </li>
                    <li class="mb-1 d-flex align-items-center" id="req-number">
                      <i class="fas fa-circle text-muted me-2" style="font-size: 8px;"></i>
                      Al menos un número
                    </li>
                    <li class="d-flex align-items-center" id="req-special">
                      <i class="fas fa-circle text-muted me-2" style="font-size: 8px;"></i>
                      Al menos un carácter especial
                    </li>
                  </ul>
                </div>
              </div>
            
              <div class="mb-4">
                <label for="new_password_confirmation" class="form-label fw-medium text-success">
                  <i class="fas fa-check-circle text-teal-600 me-2 text-light"></i>Confirmar contraseña
                </label>
                <div class="input-group">
                  <input type="password" class="form-control border-teal-200" id="new_password_confirmation" name="new_password_confirmation" required>
                  <button class="btn btn-outline-secondary border-teal-200 toggle-password" type="button" data-target="new_password_confirmation">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
                <small id="confirm_error" class="text-danger"></small>
              </div>
            
              <div class="d-flex justify-content-between mt-5">
                <button type="button" class="btn btn-light px-4" id="btn-cancel-password">
                  <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-teal px-4 py-2" id="btn-change-password">
                  <i class="fas fa-key me-2"></i>Cambiar contraseña
                </button>
              </div>
            </form>
          </div>

          <!-- Actividad -->
          <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
            <h3 class="fw-bold mb-4 pb-3 border-bottom text-dark d-flex align-items-center">
              <i class="fas fa-history text-teal-600 me-2"></i>
              Actividad reciente
            </h3>
            <div class="timeline">
              <div class="timeline-item mb-4 pb-4 border-bottom">
                <div class="d-flex">
                  <div class="timeline-icon bg-teal-600 text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                       style="width: 40px; height: 40px; min-width: 40px;">
                    <i class="fas fa-sign-in-alt"></i>
                  </div>
                </div>
              </div>
              
              <div class="timeline-item mb-4 pb-4 border-bottom">
                <div class="d-flex">
                  <div class="timeline-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                       style="width: 40px; height: 40px; min-width: 40px;">
                    <i class="fas fa-user-edit"></i>
                  </div>
                </div>
              </div>
              
              <div class="timeline-item mb-4 pb-4 border-bottom">
                <div class="d-flex">
                  <div class="timeline-icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                       style="width: 40px; height: 40px; min-width: 40px;">
                    <i class="fas fa-lock"></i>
                  </div>

                </div>
              </div>
              
              <div class="timeline-item">
                <div class="d-flex">
                  <div class="timeline-icon bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                       style="width: 40px; height: 40px; min-width: 40px;">
                    <i class="fas fa-user-plus"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- Fin de tab-content -->
      </div>
    </div>

    <!-- Gráficos, reportes, actividad reciente, etc. -->
  </div>
@endsection
<link rel="stylesheet" href="{{ asset('resources/operador/css/perfil-style.css') }}">
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const toggleButtons = document.querySelectorAll('.toggle-password');
    
    toggleButtons.forEach(button => {
      button.addEventListener('click', function() {
        const targetId = this.getAttribute('data-target');
        const passwordInput = document.getElementById(targetId);
        
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Toggle eye icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
      });
    });
    
    // Password validation
    const newPassword = document.getElementById('new_password');
    const newPasswordConfirmation = document.getElementById('new_password_confirmation');
    const confirmError = document.getElementById('confirm_error');
    const passwordError = document.getElementById('password_error');
    const passwordStrengthBar = document.getElementById('password-strength-bar');
    const passwordStrengthText = document.getElementById('password-strength-text');
    
    // Password requirement elements
    const reqLength = document.getElementById('req-length');
    const reqUppercase = document.getElementById('req-uppercase');
    const reqLowercase = document.getElementById('req-lowercase');
    const reqNumber = document.getElementById('req-number');
    const reqSpecial = document.getElementById('req-special');
    
    function validatePasswords() {
      const password = newPassword.value;
      const confirmPass = newPasswordConfirmation.value;
      
      // Reset error messages
      passwordError.textContent = '';
      confirmError.textContent = '';
      
      // Check individual requirements
      const hasLength = password.length >= 8;
      const hasUppercase = /[A-Z]/.test(password);
      const hasLowercase = /[a-z]/.test(password);
      const hasNumber = /[0-9]/.test(password);
      const hasSpecial = /[^A-Za-z0-9]/.test(password);
      
      // Update requirement indicators
      updateRequirement(reqLength, hasLength);
      updateRequirement(reqUppercase, hasUppercase);
      updateRequirement(reqLowercase, hasLowercase);
      updateRequirement(reqNumber, hasNumber);
      updateRequirement(reqSpecial, hasSpecial);
      
      // Update password strength indicator
      let strength = 0;
      let strengthClass = 'bg-danger';
      let strengthText = 'Débil';
      
      if (password.length > 0) {
        strength = 10; // Starting strength for any input
        
        // Add strength based on criteria
        if (hasLength) strength += 20;
        if (hasUppercase) strength += 15;
        if (hasLowercase) strength += 15;
        if (hasNumber) strength += 20;
        if (hasSpecial) strength += 20;
        
        // Determine strength level
        if (strength >= 80) {
          strengthClass = 'bg-success';
          strengthText = 'Fuerte';
        } else if (strength >= 50) {
          strengthClass = 'bg-warning';
          strengthText = 'Media';
        }
      }
      
      // Update strength UI
      passwordStrengthBar.style.width = strength + '%';
      passwordStrengthBar.className = 'progress-bar ' + strengthClass;
      passwordStrengthText.textContent = strengthText;
      
      // Check if all requirements are met
      const isValid = hasLength && hasUppercase && hasLowercase && hasNumber && hasSpecial;
      
      // Check if passwords match
      if (password !== confirmPass && confirmPass.length > 0) {
        confirmError.textContent = 'Las contraseñas no coinciden.';
        return false;
      }
      
      return isValid;
    }
    
    function updateRequirement(element, isValid) {
      if (isValid) {
        element.classList.add('valid');
        element.querySelector('i').classList.remove('text-muted');
        element.querySelector('i').classList.add('text-teal-600');
        element.querySelector('i').classList.remove('fa-circle');
        element.querySelector('i').classList.add('fa-check-circle');
      } else {
        element.classList.remove('valid');
        element.querySelector('i').classList.add('text-muted');
        element.querySelector('i').classList.remove('text-teal-600');
        element.querySelector('i').classList.add('fa-circle');
        element.querySelector('i').classList.remove('fa-check-circle');
      }
    }
    
    // Form validation before submit
    function validatePasswordForm() {
      const isValid = validatePasswords();
      
      if (!isValid) {
        passwordError.textContent = 'La contraseña debe cumplir con todos los requisitos de seguridad.';
        return false;
      }
      
      if (newPassword.value !== newPasswordConfirmation.value) {
        confirmError.textContent = 'Las contraseñas no coinciden.';
        return false;
      }
      
      return true;
    }
    
    // Add event listeners
    if (newPassword) {
      newPassword.addEventListener('input', validatePasswords);
      newPassword.addEventListener('keyup', validatePasswords);
    }
    
    if (newPasswordConfirmation) {
      newPasswordConfirmation.addEventListener('input', validatePasswords);
      newPasswordConfirmation.addEventListener('keyup', validatePasswords);
    }
    
    // Make validatePasswordForm available globally
    window.validatePasswordForm = validatePasswordForm;
    
    // Tab navigation via buttons
    const btnEditProfile = document.getElementById('btn-edit-profile');
    if (btnEditProfile) {
      btnEditProfile.addEventListener('click', function() {
        document.getElementById('editar-tab').click();
      });
    }
    
    const btnCancelEdit = document.getElementById('btn-cancel-edit');
    if (btnCancelEdit) {
      btnCancelEdit.addEventListener('click', function() {
        document.getElementById('info-tab').click();
      });
    }
    
    const btnCancelPassword = document.getElementById('btn-cancel-password');
    if (btnCancelPassword) {
      btnCancelPassword.addEventListener('click', function() {
        document.getElementById('info-tab').click();
      });
    }
    
    // Custom file input
    const avatarLabel = document.querySelector('label[for="imagen_usuario"]');
    const avatarInput = document.getElementById('imagen_usuario');
    
    if (avatarLabel && avatarInput) {
      avatarLabel.addEventListener('click', function() {
        avatarInput.click();
      });
    }
    
    // Initialize validation on page load
    if (newPassword && newPassword.value) {
      validatePasswords();
    }
  });
</script>
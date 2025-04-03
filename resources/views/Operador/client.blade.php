@extends('layouts.appOp')

@section('content')
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="glow-text neon-text">Clientes</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container-fluid mt-4">
    <div class="card-body p-4">
      <form action="{{ route('operador.client.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
          <!-- Nombre -->
          <div class="col-md-4 mb-3">
            <div class="form-group">
              <label for="nombre_usuario" class="form-label fw-medium text-gray-700">
                <i class="fas fa-user  text-teal-600 me-2"></i>Nombre:
              </label>
              <div class="input-group">
                <span class="input-group-text bg-teal-50 border-teal-200">
                  <i class="fas fa-user text-teal-600"></i>
                </span>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control border-teal-200 focus-ring focus-ring-teal-200" placeholder="Ingrese nombre" required>
              </div>
            </div>
          </div>
          
          <!-- Apellido Paterno -->
          <div class="col-md-4 mb-3">
            <div class="form-group">
              <label for="ap_usuario" class="form-label fw-medium text-gray-700">
                <i class="fas fa-id-card text-teal-600 me-2"></i>Apellido Paterno:
              </label>
              <div class="input-group">
                <span class="input-group-text bg-teal-50 border-teal-200">
                  <i class="fas fa-id-card text-teal-600"></i>
                </span>
                <input type="text" name="ap_usuario" id="ap_usuario" class="form-control border-teal-200" placeholder="Apellido paterno" required>
              </div>
            </div>
          </div>
          
          <!-- Apellido Materno -->
          <div class="col-md-4 mb-3">
            <div class="form-group">
              <label for="am_usuario" class="form-label fw-medium text-gray-700">
                <i class="fas fa-id-card-alt text-teal-600 me-2"></i>Apellido Materno:
              </label>
              <div class="input-group">
                <span class="input-group-text bg-teal-50 border-teal-200">
                  <i class="fas fa-id-card-alt text-teal-600"></i>
                </span>
                <input type="text" name="am_usuario" id="am_usuario" class="form-control border-teal-200" placeholder="Apellido materno">
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <!-- Sexo -->
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="sexo_usuario" class="form-label fw-medium text-gray-700">
                <i class="fas fa-venus-mars text-teal-600 me-2"></i>Sexo:
              </label>
              <div class="input-group">
                <span class="input-group-text bg-teal-50 border-teal-200">
                  <i class="fas fa-venus-mars text-teal-600"></i>
                </span>
                <select name="sexo_usuario" id="sexo_usuario" class="form-select border-teal-200" required>
                  <option value="" selected disabled>Seleccione sexo</option>
                  <option value="1">Masculino</option>
                  <option value="0">Femenino</option>
                </select>
              </div>
            </div>
          </div>
          
          <!-- Email -->
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="email_usuario" class="form-label fw-medium text-gray-700">
                <i class="fas fa-envelope text-teal-600 me-2"></i>Email:
              </label>
              <div class="input-group">
                <span class="input-group-text bg-teal-50 border-teal-200">
                  <i class="fas fa-envelope text-teal-600"></i>
                </span>
                <input type="email" name="email_usuario" id="email_usuario" class="form-control border-teal-200" placeholder="ejemplo@correo.com" required>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Contraseña -->
        <div class="mb-3">
          <div class="form-group">
            <label for="password_usuario" class="form-label fw-medium text-gray-700">
              <i class="fas fa-lock text-teal-600 me-2"></i>Contraseña:
            </label>
            <div class="input-group">
              <span class="input-group-text bg-teal-50 border-teal-200">
                <i class="fas fa-lock text-teal-600"></i>
              </span>
              <input type="password" name="password_usuario" id="password_usuario" class="form-control border-teal-200" placeholder="Ingrese contraseña" required>
              <button class="btn btn-outline-secondary border-teal-200" type="button" id="togglePassword">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            <div class="form-text text-muted">La contraseña debe tener al menos 8 caracteres.</div>
          </div>
        </div>
        
        <div class="row">
          <!-- Imagen de Usuario -->
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="imagen_usuario" class="form-label fw-medium text-gray-700">
                <i class="fas fa-image text-teal-600 me-2"></i>Imagen de Usuario:
              </label>
              <div class="input-group">
                <span class="input-group-text bg-teal-50 border-teal-200">
                  <i class="fas fa-image text-teal-600"></i>
                </span>
                <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control border-teal-200" accept="image/*">
              </div>
              <div class="form-text text-muted text-dark">Formatos permitidos: JPG, PNG (máx. 2MB)</div>
            </div>
          </div>
          
          <!-- Estatus -->
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="estatus_usuario" class="form-label fw-medium text-gray-700">
                <i class="fas fa-toggle-on text-teal-600 me-2"></i>Estatus:
              </label>
              <div class="input-group">
                <span class="input-group-text bg-teal-50 border-teal-200">
                  <i class="fas fa-toggle-on text-teal-600"></i>
                </span>
                <select name="estatus_usuario" id="estatus_usuario" class="form-select border-teal-200">
                  <option value="1" selected>Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between mt-4 text-center">
          <button type="submit" class="btn btn-teal px-4 py-2 text-light bg-success fw-bold">
            <i class="fas fa-save me-2 text-light"></i>Guardar Cliente  
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection

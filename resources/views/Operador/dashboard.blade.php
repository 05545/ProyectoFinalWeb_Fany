@extends('layouts.appOp')

@section('content')
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="glow-text neon-text">TABLERO</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container-fluid mt-4">
     
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="table_cliente">
          <thead class="bg-light">
            <tr>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-user text-teal-600 me-2"></i>Nombre
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-id-card text-teal-600 me-2"></i>Apellido
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-envelope text-teal-600 me-2"></i>Correo
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-toggle-on text-teal-600 me-2"></i>Status
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-cogs text-teal-600 me-2"></i>Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($usuarios as $cliente)
            <tr class="border-bottom">
              <td class="py-3 px-4">
                <div class="d-flex align-items-center">
                  <div class="avatar-sm me-3">
                    <img src="{{ asset('storage/' . ($cliente->imagen_usuario ?? 'default-avatar.png')) }}" 
                         alt="{{ $cliente->nombre_usuario }}" 
                         class="rounded-circle" 
                         width="40" height="40"
                         style="object-fit: cover;">
                  </div>
                  <span class="fw-medium">{{ $cliente->nombre_usuario }}</span>
                </div>
              </td>
              <td class="py-3 px-4">{{ $cliente->ap_usuario }} {{ $cliente->am_usuario }}</td>
              <td class="py-3 px-4">
                <span class="text-muted">
                  <i class="fas fa-envelope-open me-1 text-teal-600"></i>
                  {{ $cliente->email_usuario }}
                </span>
              </td>
              <td class="py-3 px-4">
                @if ($cliente->estatus_usuario == 1)
                  <span class="badge bg-success-soft text-success px-3 py-2 rounded-pill">
                    <i class="fas fa-check-circle me-1"></i>Activo
                  </span>
                @else
                  <span class="badge bg-danger-soft text-danger px-3 py-2 rounded-pill">
                    <i class="fas fa-times-circle me-1"></i>Inactivo
                  </span>
                @endif
              </td>
              <td class="py-3 px-4">
                <div class="d-flex gap-2">
                  <button class="btn btn-teal btn-sm bg-warning rounded-circle" data-bs-toggle="modal" data-bs-target="#Update_user_{{ $cliente->id_usuario }}" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-danger btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#Delete_user_{{ $cliente->id_usuario }}" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </div>
              </td>
            </tr>
            
            <!-- Modal para Editar Cliente -->
            <div class="modal fade" id="Update_user_{{ $cliente->id_usuario }}" tabindex="-1" aria-labelledby="updateUserLabel_{{ $cliente->id_usuario }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                  <div class="modal-header bg-gradient-to-r from-teal-600 to-cyan-600 text-white">
                    <h5 class="modal-title" id="updateUserLabel_{{ $cliente->id_usuario }}">
                      <i class="fas fa-user-edit me-2"></i>Actualizar Usuario
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                  </div>
                  <div class="modal-body p-4">
                    <div class="text-center mb-4">
                      <div class="avatar-lg mx-auto mb-3">
                        <img src="{{ asset('storage/' . ($cliente->imagen_usuario ?? 'default-avatar.png')) }}" 
                             alt="{{ $cliente->nombre_usuario }}" 
                             class="rounded-circle border border-3 border-teal-200" 
                             width="100" height="100"
                             style="object-fit: cover;">
                      </div>
                      <h5 class="mb-1 text-dark">{{ $cliente->nombre_usuario }} {{ $cliente->ap_usuario }}</h5>
                      <p class="text-muted">ID: {{ $cliente->id_usuario }}</p>
                    </div>
                    
                    <form action="{{ route('operador.client.update', ['id' => $cliente->id_usuario]) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label for="nombre_usuario_{{ $cliente->id_usuario }}" class="form-label text-dark fw-medium">
                              <i class="fas fa-user text-teal-600 me-2 text-dark"></i>Nombre:
                            </label>
                            <input type="text" name="modal_nombre_usuario" id="nombre_usuario_{{ $cliente->id_usuario }}" 
                                  value="{{ $cliente->nombre_usuario }}" class="form-control border-teal-200" required>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label for="ap_usuario_{{ $cliente->id_usuario }}" class="form-label fw-medium text-dark">
                              <i class="fas fa-id-card text-teal-600 me-2 text-dark"></i>Apellido Paterno:
                            </label>
                            <input type="text" name="modal_ap_usuario" id="ap_usuario_{{ $cliente->id_usuario }}" 
                                  value="{{ $cliente->ap_usuario }}" class="form-control border-teal-200" required>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label for="am_usuario_{{ $cliente->id_usuario }}" class="form-label fw-medium text-dark">
                              <i class="fas fa-id-card-alt text-teal-600 me-2 text-dark"></i>Apellido Materno:
                            </label>
                            <input type="text" name="modal_am_usuario" id="am_usuario_{{ $cliente->id_usuario }}" 
                                  value="{{ $cliente->am_usuario }}" class="form-control border-teal-200">
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label for="sexo_usuario_{{ $cliente->id_usuario }}" class="form-label text-dark fw-medium">
                              <i class="fas fa-venus-mars text-teal-600 me-2 text-dark"></i>Sexo:
                            </label>
                            <select name="modal_sexo_usuario" id="sexo_usuario_{{ $cliente->id_usuario }}" 
                                   class="form-select border-teal-200" required>
                              <option value="1" {{ $cliente->sexo_usuario == 1 ? 'selected' : '' }}>Masculino</option>
                              <option value="0" {{ $cliente->sexo_usuario == 0 ? 'selected' : '' }}>Femenino</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="email_usuario_{{ $cliente->id_usuario }}" class="form-label fw-medium text-dark">
                            <i class="fas fa-envelope text-teal-600 me-2 text-dark"></i>Email:
                          </label>
                          <input type="email" name="modal_email_usuario" id="email_usuario_{{ $cliente->id_usuario }}" 
                                value="{{ $cliente->email_usuario }}" class="form-control border-teal-200" required>
                        </div>
                      </div>
                      
                      <div class="mb-3">
                        <div class="form-group">
                          <label for="password_usuario_{{ $cliente->id_usuario }}" class="form-label text-dark fw-medium">
                            <i class="fas fa-lock text-teal-600 me-2 text-dark"></i>Nueva Contraseña:
                          </label>
                          <div class="input-group">
                            <input type="password" name="modal_password_usuario" id="password_usuario_{{ $cliente->id_usuario }}" 
                                  class="form-control border-teal-200" placeholder="Dejar en blanco para mantener la actual">
                            <button class="btn btn-outline-secondary border-teal-200 toggle-password" type="button" 
                                   data-target="password_usuario_{{ $cliente->id_usuario }}">
                              <i class="fas fa-eye"></i>
                            </button>
                          </div>
                          <div class="form-text">Dejar en blanco para mantener la contraseña actual</div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label for="imagen_usuario_{{ $cliente->id_usuario }}" class="form-label text-dark fw-medium">
                              <i class="fas fa-image text-teal-600 me-2 text-dark"></i>Imagen de Usuario:
                            </label>
                            <input type="file" name="modal_imagen_usuario" id="imagen_usuario_{{ $cliente->id_usuario }}" 
                                  class="form-control border-teal-200">
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label for="estatus_usuario_{{ $cliente->id_usuario }}" class="form-label text-dark fw-medium">
                              <i class="fas fa-toggle-on text-teal-600 me-2 text-dark"></i>Estatus:
                            </label>
                            <select name="modal_estatus_usuario" id="estatus_usuario_{{ $cliente->id_usuario }}" 
                                   class="form-select border-teal-200">
                              <option value="1" {{ $cliente->estatus_usuario == 1 ? 'selected' : '' }}>Activo</option>
                              <option value="0" {{ $cliente->estatus_usuario == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                          <i class="fas fa-times me-2 bg-danger"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-teal px-4 bg-success">
                          <i class="fas fa-save me-2"></i>Actualizar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Fin Modal Editar Cliente -->
            
            <!-- Modal para Eliminar Cliente -->
            <div class="modal fade" id="Delete_user_{{ $cliente->id_usuario }}" tabindex="-1" aria-labelledby="deleteUserLabel_{{ $cliente->id_usuario }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0 shadow">
                  <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteUserLabel_{{ $cliente->id_usuario }}">
                      <i class="fas fa-trash-alt me-2"></i>Eliminar Usuario
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                  </div>
                  <div class="modal-body p-4 text-center">
                    <div class="avatar-lg mx-auto mb-3">
                      <img src="{{ asset('storage/' . ($cliente->imagen_usuario ?? 'default-avatar.png')) }}" 
                           alt="{{ $cliente->nombre_usuario }}" 
                           class="rounded-circle border border-3 border-danger-soft" 
                           width="100" height="100"
                           style="object-fit: cover;">
                    </div>
                    <h5 class="mb-1">{{ $cliente->nombre_usuario }} {{ $cliente->ap_usuario }}</h5>
                    <p class="text-muted mb-4">{{ $cliente->email_usuario }}</p>
                    
                    <div class="alert alert-danger">
                      <i class="fas fa-exclamation-triangle me-2"></i>
                      ¿Está seguro que desea eliminar este usuario? Esta acción no se puede deshacer.
                    </div>
                    
                    <form action="{{ route('operador.client.delete', ['id' => $cliente->id_usuario]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <div class="d-flex justify-content-center gap-2 mt-4">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                          <i class="fas fa-times me-2"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger px-4">
                          <i class="fas fa-trash-alt me-2"></i>Eliminar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Fin Modal Eliminar Cliente -->
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="card-footer bg-light p-3">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-muted">Mostrando {{ count($usuarios) }} clientes</span>
        </div>
        <div>
          <!-- Aquí puedes agregar paginación si es necesario -->
        </div>
      </div>
    </div>
  </div>
@endsection

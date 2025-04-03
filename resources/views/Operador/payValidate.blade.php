@extends('layouts.appOp')

@section('content')
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="glow-text neon-text">Pagos</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container-fluid mt-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-user text-teal-600 me-2"></i>Cliente
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-envelope text-teal-600 me-2"></i>Correo
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-credit-card text-teal-600 me-2"></i>Tarjeta
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-calendar-alt text-teal-600 me-2"></i>Fecha
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-tag text-teal-600 me-2"></i>Plan
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-dollar-sign text-teal-600 me-2"></i>Monto
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-toggle-on text-teal-600 me-2"></i>Estado
              </th>
              <th class="py-3 px-4 fw-semibold text-uppercase text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-cogs text-teal-600 me-2"></i>Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pagos as $pay)
            <tr class="border-bottom">
              <td class="py-3 px-4">
                <div class="d-flex align-items-center">
                  <div class="avatar-sm me-3 bg-teal-50 rounded-circle d-flex align-items-center justify-content-center">
                    <span class="text-teal-600 fw-bold">{{ substr($pay->nombre_usuario, 0, 1) }}</span>
                  </div>
                  <span class="fw-medium">{{ $pay->nombre_usuario . ' ' . $pay->ap_usuario . ' ' . $pay->am_usuario }}</span>
                </div>
              </td>
              <td class="py-3 px-4">
                <span class="text-muted">
                  <i class="fas fa-envelope-open me-1 text-teal-600"></i>
                  {{ $pay->email_usuario }}
                </span>
              </td>
              <td class="py-3 px-4">
                <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                  <i class="fas fa-credit-card me-1 text-teal-600"></i>
                  •••• {{ substr($pay->tarjeta_pago, -4) }}
                </span>
              </td>
              <td class="py-3 px-4">
                <span class="text-muted">
                  <i class="fas fa-calendar-day me-1 text-teal-600"></i>
                  {{ $pay->fecha_registro_pago }}
                </span>
              </td>
              <td class="py-3 px-4">
                <span class="badge bg-teal-50 text-teal-600 px-3 py-2 rounded-pill text-dark">
                  {{ $pay->nombre_plan }}
                </span>
              </td>
              <td class="py-3 px-4">
                <span class="fw-bold">
                  ${{ $pay->monto_pago }}
                </span>
              </td>
              <td class="py-3 px-4">
                <form id="toggle-status-{{ $pay->id_pago }}" action="{{ route('operador.pagos.update', $pay->id_pago) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn {{ $pay->estatus_pago == 1 ? 'btn-success' : 'btn-warning' }} btn-sm px-3 py-2 rounded-pill">
                    <i class="fas {{ $pay->estatus_pago == 1 ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                    {{ $pay->estatus_pago == 1 ? 'Habilitado' : 'Deshabilitado' }}
                  </button>
                </form>
              </td>
              <td class="py-3 px-4">
                <button type="button" class="btn btn-teal btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#info-modal-{{ $pay->id_pago }}" title="Ver detalles">
                  <i class="fas fa-info-circle text-info"></i>
                </button>
              </td>
            </tr>
            
            <!-- Modal para mostrar información del pago -->
            <div class="modal fade" id="info-modal-{{ $pay->id_pago }}" tabindex="-1" aria-labelledby="infoModalLabel-{{ $pay->id_pago }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                  <div class="modal-header bg-gradient-to-r from-teal-600 to-cyan-600 text-white">
                    <h5 class="modal-title" id="infoModalLabel-{{ $pay->id_pago }}">
                      <i class="fas fa-info-circle me-2"></i>Información del pago
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                  </div>
                  <div class="modal-body p-4">
                    <div class="text-center mb-4">
                      <div class="avatar-lg mx-auto mb-3 bg-teal-50 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fas fa-credit-card text-dark fa-2x text-teal-600"></i>
                      </div>
                      <h5 class="mb-1 text-dark">Pago #{{ $pay->id_pago }}</h5>
                      <p class="text-muted text-dark">{{ $pay->fecha_registro_pago }}</p>
                    </div>
                    
                    <div class="card bg-light border-0 mb-4">
                      <div class="card-body">
                        <h6 class="card-title text-dark  mb-3">
                          <i class="fas fa-user text-dark me-2"></i>Información del cliente
                        </h6>
                        <div class="row mb-2">
                          <div class="col-4 text-muted">Nombre:</div>
                          <div class="col-8 fw-medium text-dark">{{ $pay->nombre_usuario . ' ' . $pay->ap_usuario . ' ' . $pay->am_usuario }}</div>
                        </div>
                        <div class="row">
                          <div class="col-4 text-muted">Correo:</div>
                          <div class="col-8 text-dark">{{ $pay->email_usuario }}</div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="card bg-light border-0 mb-4">
                      <div class="card-body">
                        <h6 class="card-title text-dark mb-3">
                          <i class="fas fa-credit-card text-dark me-2"></i>Información del pago
                        </h6>
                        <div class="row mb-2">
                          <div class="col-4 text-muted">Tarjeta:</div>
                          <div class="col-8 text-dark">•••• •••• •••• {{ substr($pay->tarjeta_pago, -4) }}</div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-4 text-muted">Plan:</div>
                          <div class="col-8 fw-bold text-dark">{{ $pay->nombre_plan }}</div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-4 text-muted">Monto:</div>
                          <div class="col-8 fw-bold text-dark">${{ $pay->monto_pago }}</div>
                        </div>
                        <div class="row">
                          <div class="col-4 text-muted">Estatus:</div>
                          <div class="col-8">
                            <span class="badge {{ $pay->estatus_pago == 1 ? 'bg-success' : 'bg-warning' }} px-3 py-2 rounded-pill">
                              <i class="fas {{ $pay->estatus_pago == 1 ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                              {{ $pay->estatus_pago == 1 ? 'Habilitado' : 'Deshabilitado' }}
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-4">
                      <form id="modal-toggle-status-{{ $pay->id_pago }}" action="{{ route('operador.pagos.update', $pay->id_pago) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $pay->estatus_pago == 1 ? 'btn-warning' : 'btn-success' }} px-4">
                          <i class="fas {{ $pay->estatus_pago == 1 ? 'fa-ban' : 'fa-check' }} me-2"></i>
                          {{ $pay->estatus_pago == 1 ? 'Deshabilitar' : 'Habilitar' }}
                        </button>
                      </form>
                        <form id="delete-form-{{ $pay->id_pago }}" action="{{ route('operador.pagos.delete', $pay->id_pago) }}" method="POST" style="display: none;">
                        @csrf 
                        @method('DELETE')
                        </form>
                        <button type="submit" class="btn btn-danger px-4" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $pay->id_pago }}').submit();">
                        <i class="fas fa-trash-alt me-2"></i>Eliminar
                        </button>
                      </button>
                      <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cerrar
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Fin Modal -->
            @endforeach        
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="card-footer bg-light p-3">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-muted">Mostrando {{ count($pagos) }} pagos</span>
        </div>
        <div>
          <!-- Aquí puedes agregar paginación si es necesario -->
        </div>
      </div>
    </div>
  </div>
@endsection

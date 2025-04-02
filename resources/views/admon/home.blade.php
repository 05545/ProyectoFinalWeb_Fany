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

  <!-- Main Content -->
  <div class="container-fluid mt-4">
   <!-- Tabla de Usuarios -->
  <div class="row mt-5">
    <div class="col-md-12">
      <h3>Tabla de Usuarios</h3>
      <table class="table table-light">
        <thead class="thead-light">
          <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Estatus</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($usuarios as $User)
          <tr>
            <td>
              <img class="img-fluid rounded" src="{{ asset($User->imagen_usuario) }}" alt="User" style="max-width: 50px;">
            </td>
            <td>{{ $User->nombre_usuario }}</td>
            <td>{{ $User->ap_usuario . ' ' . $User->am_usuario }}</td>
            <td>{{ $User->email_usuario }}</td>
            <td>
              <span class="{{ $User->estatus_usuario === 1 ? 'text-success' : 'text-warning' }}">
                {{ $User->estatus_usuario === 1 ? 'Habilitado' : 'Deshabilitado' }}
              </span>
            </td>
            <td>
              <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#Update_user_{{ $User->id_usuario }}">
                <i class="fas fa-edit"></i>
              </a>
              <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Delete_user_{{ $User->id_usuario }}">
                <i class="fas fa-trash-alt"></i>
              </a>
            </td>
          </tr>

          <!-- Modal para editar usuario -->
          <div class="modal fade" id="Update_user_{{ $User->id_usuario }}" tabindex="-1" aria-labelledby="UpdateUserLabel_{{ $User->id_usuario }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="UpdateUserLabel_{{ $User->id_usuario }}">Editar Usuario</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('admin.usuarios.update', ['id' => $User->id_usuario ])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="nombre_usuario">Nombre:</label>
                      <input type="text" name="modal_nombre_usuario" value="{{ $User->nombre_usuario }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="ap_usuario">Apellido Paterno:</label>
                      <input type="text" name="modal_ap_usuario" value="{{ $User->ap_usuario }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="am_usuario">Apellido Materno:</label>
                      <input type="text" name="modal_am_usuario" value="{{ $User->am_usuario }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="modal_sexo_usuario">Sexo</label>
                      <select name="modal_sexo_usuario" class="form-control" required>
                        <option value="1" {{ $User->sexo_usuario == '1' ? 'selected' : '' }}>Masculino</option>
                        <option value="0" {{ $User->sexo_usuario == '0' ? 'selected' : '' }}>Femenino</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="email_usuario">Correo Electrónico:</label>
                      <input type="email" name="modal_email_usuario" value="{{ $User->email_usuario }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="password_usuario">Nueva Contraseña:</label>
                      <input type="password" name="modal_password_usuario" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="imagen_usuario">Imagen de Usuario:</label>
                      <input type="file" name="modal_imagen_usuario" class="form-control-file">
                    </div>
                    <div class="form-group">
                      <label for="estatus_usuario">Rol:</label>
                      <select name="modal_id_rol" class="form-control">
                        @foreach ($roles as $rol)
                          <option value="{{ $rol->id_rol }}" {{ $User->id_rol == $rol->id_rol ? 'selected' : '' }}>
                            {{ $rol->nombre_rol }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="estatus_usuario">Estatus:</label>
                      <select name="modal_estatus_usuario" class="form-control">
                        <option value="1" {{ $User->estatus_usuario == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $User->estatus_usuario == 0 ? 'selected' : '' }}>Inactivo</option>
                      </select>
                    </div>
                    <div class="text-center mt-4">
                      <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal para eliminar usuario -->
          <div class="modal fade" id="Delete_user_{{ $User->id_usuario }}" tabindex="-1" aria-labelledby="DeleteUserLabel_{{ $User->id_usuario }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="DeleteUserLabel_{{ $User->id_usuario }}">Eliminar Usuario</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ¿Está seguro de que desea eliminar al usuario "{{ $User->nombre_usuario }}"?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.usuarios.destroy', ['id' => $User->id_usuario]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tabla de Streamings -->
  <div class="row">
    <div class="col-md-12">
      <h3>Tabla de Streamings</h3>
      <table class="table table-light">
        <thead class="thead-light">
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Duración</th>
            <th>Temporadas</th>
            <th>Clasificación</th>
            <th>Estatus</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($streamings as $streaming)
          <tr>
            <td><img src="{{ asset('Peliculas/imagen/' . $streaming->caratula_streaming) }}" alt="Carátula" width="100"></td>
            <td>{{ $streaming->nombre_streaming }}</td>
            <td>{{ $streaming->duracion_streaming }}</td>
            <td>{{ $streaming->temporadas_streaming }}</td>
            <td>{{ $streaming->clasificacion_streaming }}</td>
            <td>
              <span class="{{ $streaming->estatus_streaming == 1 ? 'text-success' : 'text-warning' }}">
                {{ $streaming->estatus_streaming == 1 ? 'Habilitado' : 'Deshabilitado' }}
              </span>
            </td>
            <td>
              <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#Modal_update_{{ $streaming->id_streaming }}">
                <i class="fas fa-edit"></i>
              </a>
              <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Modal_delete_{{ $streaming->id_streaming }}">
                <i class="fas fa-trash-alt"></i>
              </a>
            </td>
          </tr>

          <!-- Modal para editar streaming -->
          <div class="modal fade" id="Modal_update_{{ $streaming->id_streaming }}" tabindex="-1" aria-labelledby="UpdateStreamingLabel_{{ $streaming->id_streaming }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="UpdateStreamingLabel_{{ $streaming->id_streaming }}">Editar Streaming</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('admin.streaming.update', ['id' => $streaming->id_streaming]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Campos para actualizar streaming -->
                    <div class="form-group">
                      <label for="modal_nombre_streaming_{{ $streaming->id_streaming }}">Nombre del Streaming:</label>
                      <input type="text" name="modal_nombre_streaming" id="modal_nombre_streaming_{{ $streaming->id_streaming }}" class="form-control" value="{{ $streaming->nombre_streaming }}" required>
                    </div>
                    <div class="form-group">
                      <label for="modal_fecha_lanzamiento_streaming_{{ $streaming->id_streaming }}">Fecha de Lanzamiento:</label>
                      <input type="date" name="modal_fecha_lanzamiento_streaming" id="modal_fecha_lanzamiento_streaming_{{ $streaming->id_streaming }}" class="form-control" value="{{ $streaming->fecha_lanzamiento_streaming }}" required>
                    </div>
                    <div class="form-group">
                      <label for="modal_duracion_streaming_{{ $streaming->id_streaming }}">Duración:</label>
                      <input type="text" name="modal_duracion_streaming" id="modal_duracion_streaming_{{ $streaming->id_streaming }}" class="form-control" value="{{ $streaming->duracion_streaming }}">
                    </div>
                    <div class="form-group">
                      <label for="modal_temporadas_streaming_{{ $streaming->id_streaming }}">Temporadas:</label>
                      <input type="text" name="modal_temporadas_streaming" id="modal_temporadas_streaming_{{ $streaming->id_streaming }}" class="form-control" value="{{ $streaming->temporadas_streaming }}" placeholder="Cantidad de temporadas">
                    </div>
                    <div class="form-group">
                      <label for="modal_caratula_streaming_{{ $streaming->id_streaming }}">Carátula:</label>
                      <input type="file" name="modal_caratula_streaming" id="modal_caratula_streaming_{{ $streaming->id_streaming }}" class="form-control-file">
                    </div>
                    <div class="form-group">
                      <label for="modal_trailer_streaming_{{ $streaming->id_streaming }}">Trailer:</label>
                      <input type="file" name="modal_trailer_streaming" id="modal_trailer_streaming_{{ $streaming->id_streaming }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="modal_clasificacion_streaming_{{ $streaming->id_streaming }}">Clasificación:</label>
                      <input type="text" name="modal_clasificacion_streaming" id="modal_clasificacion_streaming_{{ $streaming->id_streaming }}" class="form-control" value="{{ $streaming->clasificacion_streaming }}" placeholder="Ej: PG-13" required>
                    </div>
                    <div class="form-group">
                      <label for="modal_sipnosis_streaming_{{ $streaming->id_streaming }}">Sinopsis:</label>
                      <textarea name="modal_sipnosis_streaming" id="modal_sipnosis_streaming_{{ $streaming->id_streaming }}" class="form-control" rows="3" placeholder="Sin descripción por el momento">{{ $streaming->sipnosis_streaming }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="modal_fecha_estreno_streaming_{{ $streaming->id_streaming }}">Fecha de Estreno:</label>
                      <input type="date" name="modal_fecha_estreno_streaming" id="modal_fecha_estreno_streaming_{{ $streaming->id_streaming }}" class="form-control" value="{{ $streaming->fecha_estreno_streaming }}" required>
                    </div>
                    <div class="form-group">
                      <label for="modal_id_genero_{{ $streaming->id_streaming }}">Género:</label>
                      <select name="modal_id_genero" id="modal_id_genero_{{ $streaming->id_streaming }}" class="form-control" required>
                        @foreach($generos as $genero)
                          <option value="{{ $genero->id_genero }}" {{ $streaming->id_genero == $genero->id_genero ? 'selected' : '' }}>
                            {{ $genero->nombre_genero }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="modal_estatus_streaming_{{ $streaming->id_streaming }}">Estatus:</label>
                      <select name="modal_estatus_streaming" id="modal_estatus_streaming_{{ $streaming->id_streaming }}" class="form-control">
                        <option value="1" {{ $streaming->estatus_streaming == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $streaming->estatus_streaming == 0 ? 'selected' : '' }}>Inactivo</option>
                      </select>
                    </div>
                    <div class="text-center mt-4">
                      <button type="submit" class="btn btn-primary">Actualizar Streaming</button>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal para eliminar streaming -->
          <div class="modal fade" id="Modal_delete_{{ $streaming->id_streaming }}" tabindex="-1" aria-labelledby="DeleteStreamingLabel_{{ $streaming->id_streaming }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="DeleteStreamingLabel_{{ $streaming->id_streaming }}">Eliminar Streaming</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ¿Está seguro de que desea eliminar el streaming "{{ $streaming->nombre_streaming }}"?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.streaming.destroy', ['id' => $streaming->id_streaming]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tabla de Videos -->
  <div class="row mt-5">
    <div class="col-md-12">
      <h3>Tabla de Videos</h3>
      <table class="table table-light">
        <thead class="thead-light">
          <tr>
            <th>Streaming</th>
            <th>Nombre de temporada</th>
            <th>Capítulo</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($videos as $video)
          <tr>
            <td>{{ $video->nombre_streaming }}</td>
            <td>{{ $video->nombre_temporada }}</td>
            <td>{{ $video->capitulo_temporada }}</td>
            <td>{{ $video->descripcion_capitulo_temporada }}</td>
            <td>
              <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#Modal_update_video_{{ $video->id_video }}">
                <i class="fas fa-edit"></i>
              </a>
              <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Modal_delete_video_{{ $video->id_video }}">
                <i class="fas fa-trash-alt"></i>
              </a>
            </td>
          </tr>

          <!-- Modal para editar video -->
          <div class="modal fade" id="Modal_update_video_{{ $video->id_video }}" tabindex="-1" aria-labelledby="UpdateVideoLabel_{{ $video->id_video }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="UpdateVideoLabel_{{ $video->id_video }}">Editar Video</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.streaming.update-video', ['id' => $video->id_video]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="modal_video_{{ $video->id_video }}">Video:</label>
                      <input type="text" name="modal_video" id="modal_video_{{ $video->id_video }}" class="form-control" value="{{ $video->video }}" required>
                    </div>
                    <div class="form-group">
                      <label for="modal_nombre_temporada_{{ $video->id_video }}">Nombre de Temporada:</label>
                      <input type="text" name="modal_nombre_temporada" id="modal_nombre_temporada_{{ $video->id_video }}" class="form-control" value="{{ $video->nombre_temporada }}">
                    </div>
                    <div class="form-group">
                      <label for="modal_video_temporada_{{ $video->id_video }}">Video Temporada:</label>
                      <input type="number" name="modal_video_temporada" id="modal_video_temporada_{{ $video->id_video }}" class="form-control" value="{{ $video->video_temporada }}">
                    </div>
                    <div class="form-group">
                      <label for="modal_capitulo_temporada_{{ $video->id_video }}">Capítulo de la Temporada:</label>
                      <input type="number" name="modal_capitulo_temporada" id="modal_capitulo_temporada_{{ $video->id_video }}" class="form-control" value="{{ $video->capitulo_temporada }}">
                    </div>
                    <div class="form-group">
                      <label for="modal_descripcion_capitulo_temporada_{{ $video->id_video }}">Descripción del Capítulo:</label>
                      <textarea name="modal_descripcion_capitulo_temporada" id="modal_descripcion_capitulo_temporada_{{ $video->id_video }}" class="form-control" rows="3">{{ $video->descripcion_capitulo_temporada }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="modal_id_streaming_video_{{ $video->id_video }}">Streaming:</label>
                      <select name="modal_id_streaming" id="modal_id_streaming_video_{{ $video->id_video }}" class="form-control" required>
                        @foreach ($streamings as $streaming)
                          <option value="{{ $streaming->id_streaming }}" {{ $video->id_streaming == $streaming->id_streaming ? 'selected' : '' }}>
                            {{ $streaming->nombre_streaming }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="modal_estatus_video_{{ $video->id_video }}">Estatus:</label>
                      <select name="modal_estatus_video" id="modal_estatus_video_{{ $video->id_video }}" class="form-control">
                        <option value="1" {{ $video->estatus_video == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $video->estatus_video == 0 ? 'selected' : '' }}>Inactivo</option>
                      </select>
                    </div>
                    <div class="text-center mt-4">
                      <button type="submit" class="btn btn-primary">Actualizar Video</button>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal para eliminar video -->
          <div class="modal fade" id="Modal_delete_video_{{ $video->id_video }}" tabindex="-1" aria-labelledby="DeleteVideoLabel_{{ $video->id_video }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="DeleteVideoLabel_{{ $video->id_video }}">Eliminar Video</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ¿Está seguro de que desea eliminar este video?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.streaming.destroy-video', ['id' => $video->id_video]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </div>
          </div>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tabla de Planes -->
  <div class="row mt-5">
    <div class="col-md-12">
      <h3 class="text-center text-dark mb-3">Listado de Planes</h3>
      <table class="table table-light table-striped table-responsive">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Límite</th>
            <th>Estatus</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($planes as $plan)
          <tr>
            <td>{{ $plan->id_plan }}</td>
            <td>{{ $plan->nombre_plan }}</td>
            <td>{{ $plan->precio_plan }}</td>
            <td>{{ $plan->cantidad_limite_plan }}</td>
            <td>
              <span class="badge {{ $plan->estatus_plan == 1 ? 'badge-success' : ($plan->estatus_plan == 0 ? 'badge-warning' : 'badge-secondary') }}">
                {{ $plan->estatus_plan == 1 ? 'Habilitado' : ($plan->estatus_plan == 0 ? 'Deshabilitado' : 'Sin definir') }}
              </span>
            </td>
            <td>
              <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#Modal_plan_update_{{ $plan->id_plan }}">
                <i class="fas fa-edit"></i>
              </a>
              <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Modal_plan_delete_{{ $plan->id_plan }}">
                <i class="fas fa-trash-alt"></i>
              </a>
            </td>
          </tr>

          <!-- Modal para editar Plan -->
          <div class="modal fade" id="Modal_plan_update_{{ $plan->id_plan }}" tabindex="-1" aria-labelledby="UpdatePlanLabel_{{ $plan->id_plan }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="UpdatePlanLabel_{{ $plan->id_plan }}">Editar Plan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('admin.planes.update', ['id' => $plan->id_plan]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="modal_nombre_plan_{{ $plan->id_plan }}">Nombre del Plan:</label>
                      <input type="text" name="modal_nombre_plan" id="modal_nombre_plan_{{ $plan->id_plan }}" class="form-control" value="{{ $plan->nombre_plan }}" required>
                    </div>
                    <div class="form-group">
                      <label for="modal_precio_plan_{{ $plan->id_plan }}">Precio del Plan:</label>
                      <input type="text" name="modal_precio_plan" id="modal_precio_plan_{{ $plan->id_plan }}" class="form-control" value="{{ $plan->precio_plan }}" required>
                    </div>
                    <div class="form-group">
                      <label for="modal_cantidad_limite_plan_{{ $plan->id_plan }}">Límite de Alquiler:</label>
                      <input type="number" name="modal_cantidad_limite_plan" id="modal_cantidad_limite_plan_{{ $plan->id_plan }}" class="form-control" value="{{ $plan->cantidad_limite_plan }}" required>
                    </div>
                    <div  class="form-group">
                        <label for="modal_tipo_plan">Tipo de plan</label>
                        <select name="modal_tipo_plan" id="modal_tipo_plan" class="form-control" required>
                            <option value="8" {{ $plan->tipo_plan == 8 ? 'selected' : '' }}>Basico</option>
                            <option value="16" {{ $plan->tipo_plan == 16 ? 'selected' : '' }}>Estandar</option>
                            <option value="32" {{ $plan->tipo_plan == 32 ? 'selected' : '' }}>Premium</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="modal_estatus_plan_{{ $plan->id_plan }}">Estatus:</label>
                      <select name="modal_estatus_plan" id="modal_estatus_plan_{{ $plan->id_plan }}" class="form-control">
                        <option value="1" {{ $plan->estatus_plan == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $plan->estatus_plan == 0 ? 'selected' : '' }}>Inactivo</option>
                      </select>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal para eliminar Plan -->
          <div class="modal fade" id="Modal_plan_delete_{{ $plan->id_plan }}" tabindex="-1" aria-labelledby="DeletePlanLabel_{{ $plan->id_plan }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-danger">
                  <h5 class="modal-title" id="DeletePlanLabel_{{ $plan->id_plan }}">Eliminar Plan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>¿Estás seguro que deseas eliminar el plan <strong>{{ $plan->nombre_plan }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.planes.destroy', ['id' => $plan->id_plan]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tabla de Géneros -->
  <div class="row mt-5">
    <div class="col-md-12">
      <h3 class="text-center text-dark mb-3">Listado de Géneros</h3>
      <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-light table-striped">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Estatus</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($generos as $genero)
            <tr>
              <td>{{ $genero->id_genero }}</td>
              <td>{{ $genero->nombre_genero }}</td>
              <td>{{ $genero->descripcion_genero }}</td>
              <td>
          <span class="badge {{ $genero->estatus_genero === 1 ? 'badge-success' : ($genero->estatus_genero === 0 ? 'badge-warning' : 'badge-secondary') }}">
            {{ $genero->estatus_genero === 1 ? 'Activo' : ($genero->estatus_genero === 0 ? 'Inactivo' : 'Sin definir') }}
          </span>
              </td>
              <td>
          <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#Update_genero_{{ $genero->id_genero }}">
            <i class="fas fa-edit"></i>
          </a>
          <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Delete_genero_{{ $genero->id_genero }}">
            <i class="fas fa-trash-alt"></i>
          </a>
              </td>
            </tr>

            <!-- Modal para editar género -->
            <div class="modal fade" id="Update_genero_{{ $genero->id_genero }}" tabindex="-1" aria-labelledby="UpdateGeneroLabel_{{ $genero->id_genero }}" aria-hidden="true">
              <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="UpdateGeneroLabel_{{ $genero->id_genero }}">Actualizar Género</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.generos.update', ['id' => $genero->id_genero]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
            <label for="modal_nombre_genero_{{ $genero->id_genero }}">Nombre del Género:</label>
            <input type="text" name="modal_nombre_genero" id="modal_nombre_genero_{{ $genero->id_genero }}" class="form-control" value="{{ $genero->nombre_genero }}" required>
                </div>
                <div class="form-group">
            <label for="modal_descripcion_genero_{{ $genero->id_genero }}">Descripción del Género:</label>
            <textarea name="modal_descripcion_genero" id="modal_descripcion_genero_{{ $genero->id_genero }}" class="form-control" rows="3">{{ $genero->descripcion_genero }}</textarea>
                </div>
                <div class="form-group">
            <label for="modal_estatus_genero_{{ $genero->id_genero }}">Estatus:</label>
            <select name="modal_estatus_genero" id="modal_estatus_genero_{{ $genero->id_genero }}" class="form-control">
              <option value="1" {{ $genero->estatus_genero === 1 ? 'selected' : '' }}>Activo</option>
              <option value="0" {{ $genero->estatus_genero === 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
                </div>
                <div class="text-center">
            <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
              </form>
            </div>
          </div>
              </div>
            </div>

            <!-- Modal para eliminar género -->
            <div class="modal fade" id="Delete_genero_{{ $genero->id_genero }}" tabindex="-1" aria-labelledby="DeleteGeneroLabel_{{ $genero->id_genero }}" aria-hidden="true">
              <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title" id="DeleteGeneroLabel_{{ $genero->id_genero }}">Eliminar Género</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>¿Estás seguro que deseas eliminar el género <strong>{{ $genero->nombre_genero }}</strong>?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.generos.destroy', ['id' => $genero->id_genero]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </form>
            </div>
          </div>
              </div>
            </div>
            @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              {{ $generos->links('pagination::bootstrap-4') }}
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection

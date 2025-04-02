@extends('layouts.admin')

@section('content')
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Usuarios</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container-fluid mt-4">

  <form action="{{ route('admin.usuarios.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
   
    <div class="form-group">
      <label for="nombre_usuario">Nombre</label>
      <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required maxlength="50">
    </div>

    <div class="form-group">
      <label for="ap_usuario">Apellido Paterno</label>
      <input type="text" name="ap_usuario" id="ap_usuario" class="form-control" required maxlength="50">
    </div>

    <div class="form-group">
      <label for="am_usuario">Apellido Materno</label>
      <input type="text" name="am_usuario" id="am_usuario" class="form-control" maxlength="50">
    </div>

    <div class="form-group">
      <label for="sexo_usuario">Sexo</label>
      <select name="sexo_usuario" id="sexo_usuario" class="form-control" required>
        <option value="1">Masculino</option>
        <option value="0">Femenino</option>
      </select>
    </div>

    <div class="form-group">
      <label for="email_usuario">Correo Electrónico</label>
      <input type="email" name="email_usuario" id="email_usuario" class="form-control" required maxlength="70">
    </div>

    <div class="form-group">
      <label for="password_usuario">Contraseña</label>
      <input type="password" name="password_usuario" id="password_usuario" class="form-control" required maxlength="64">
    </div>

    <div class="form-group">
      <label for="imagen_usuario">Imagen de Usuario</label>
      <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control">
    </div>

    <div class="form-group">
      <label for="id_rol">Rol</label>
      <select name="id_rol" id="id_rol" class="form-control" required>
        @foreach ($roles as $rol)
        <option value="{{$rol->id_rol}}">{{$rol->nombre_rol}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="estatus_usuario">Estatus Usuario</label>
      <select name="estatus_usuario" id="estatus_usuario" class="form-control">
        <option value="-1">Inactivo</option>
        <option value="1">Activo</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
  </form>
  </div>
@endsection

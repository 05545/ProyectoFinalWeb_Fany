@extends('layouts.admin')

@section('content')
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 >Generos</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container-fluid mt-4">
    <div class="col-md-6">
      <h3 class="mb-3">Nuevo Género</h3>
      <form action="{{ route('admin.generos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="nombre_genero" class="form-label">Nombre del Género:</label>
          <input type="text" name="nombre_genero" id="nombre_genero" class="form-control" placeholder="Ingrese el nombre del género" required>
        </div>
        <div class="mb-3">
          <label for="descripcion_genero" class="form-label">Descripción del Género:</label>
          <textarea name="descripcion_genero" id="descripcion_genero" class="form-control" rows="3" placeholder="Ingrese la descripción"></textarea>
        </div>
        <div class="mb-3">
          <label for="estatus_genero" class="form-label">Estatus:</label>
          <select name="estatus_genero" id="estatus_genero" class="form-select">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
@endsection

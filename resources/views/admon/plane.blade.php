@extends('layouts.admin')

@section('content')
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Planes</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container-fluid mt-4">
    <form action="{{ route('admin.planes.store') }}" method="POST">
      @csrf
      <!-- Nombre del Plan -->
      <div class="form-group">
        <label for="nombre_plan" class="font-weight-bold">Nombre del Plan:</label>
        <input type="text" name="nombre_plan" id="nombre_plan" class="form-control" placeholder="Ingrese el nombre del plan" required>
      </div>
      <!-- Precio del Plan -->
      <div class="form-group">
        <label for="precio_plan" class="font-weight-bold">Precio del Plan:</label>
        <input type="text" name="precio_plan" id="precio_plan" class="form-control" placeholder="734" step="0.01" required>
      </div>
      <!-- Límite de Alquiler -->
      <div class="form-group">
        <label for="cantidad_limite_plan" class="font-weight-bold">Límite de Alquiler:</label>
        <input type="number" name="cantidad_limite_plan" id="cantidad_limite_plan" class="form-control" placeholder="Ingrese el límite de alquiler" required>
      </div>
      <!-- Tipo de Plan -->
      <div class="form-group">
        <label for="tipo_plan" class="font-weight-bold">Tipo de Plan:</label>
        <select name="tipo_plan" id="tipo_plan" class="form-control">
          <option value="8">Básico</option>
          <option value="16">Estándar</option>
          <option value="32">Premium</option>
        </select>
      </div>
      <!-- Estatus del Plan -->
      <div class="form-group">
        <label for="estatus_plan" class="font-weight-bold">Estatus del Plan:</label>
        <select name="estatus_plan" id="estatus_plan" class="form-control">
          <option value="1">Activo</option>
          <option value="0">Inactivo</option>
          <option value="-1">Sin definir</option>
        </select>
      </div>
      <!-- Botón de Envío -->
      <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg">Guardar Plan</button>
      </div>
    </form>
  </div>
@endsection

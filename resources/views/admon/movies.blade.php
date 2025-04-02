@extends('layouts.admin')

@section('content')
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Publicacion de peliculas\Series</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container-fluid mt-4">
    <div class="container mt-5">
      <h1 class="mb-4 page-title">Gestión de Contenido</h1>
    
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" id="contentTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="streaming-tab" data-bs-toggle="tab" data-bs-target="#streaming" type="button" role="tab" aria-controls="streaming" aria-selected="true">
            Registrar Streaming
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab" aria-controls="video" aria-selected="false">
            Registrar Video
          </button>
        </li>
      </ul>
    
      <!-- Tab panes -->
      <div class="tab-content pt-4" id="contentTabsContent">
        <!-- Pestaña de Streaming -->
        <div class="tab-pane fade show active" id="streaming" role="tabpanel" aria-labelledby="streaming-tab">
          <div class="row">
            <!-- Columna para el formulario de Streaming -->
            <div class="col-md-6">
              <h3>Formulario de Streaming</h3>
              <form action="{{ route('admin.streaming.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
    
                <!-- Nombre del Streaming -->
                <div class="mb-3">
                  <label for="nombre_streaming" class="form-label">Nombre del Streaming:</label>
                  <input type="text" name="nombre_streaming" id="nombre_streaming" class="form-control" placeholder="Ingrese el nombre" required>
                </div>
    
                <!-- Fecha de Lanzamiento -->
                <div class="mb-3">
                  <label for="fecha_lanzamiento_streaming" class="form-label">Fecha de Lanzamiento:</label>
                  <input type="date" name="fecha_lanzamiento_streaming" id="fecha_lanzamiento_streaming" class="form-control" required>
                </div>
    
                <!-- Botón para seleccionar Película o Serie -->
                <div class="mb-3">
                  <label class="form-label">Tipo:</label>
                  <div class="btn-group" data-toggle="buttons">
                  <label class="btn btn-primary active">
                    <input type="radio" name="tipo_streaming" id="tipo_pelicula" value="pelicula" checked onchange="toggleFields()"> Película
                  </label>
                  <label class="btn btn-primary">
                    <input type="radio" name="tipo_streaming" id="tipo_serie" value="serie" onchange="toggleFields()"> Serie
                  </label>
                  </div>
                </div>

                <!-- Duración -->
                <div class="mb-3" id="duracion_field">
                  <label for="duracion_streaming" class="form-label">Duración:</label>
                  <input type="text" name="duracion_streaming" id="duracion_streaming" class="form-control">
                </div>

                <!-- Temporadas -->
                <div class="mb-3" id="temporadas_field" style="display: none;">
                  <label for="temporadas_streaming" class="form-label">Temporadas:</label>
                  <input type="text" name="temporadas_streaming" id="temporadas_streaming" class="form-control" placeholder="Cantidad de temporadas">
                </div>

        <script>
          function toggleFields() {
          const isPelicula = document.getElementById('tipo_pelicula').checked;
          document.getElementById('duracion_field').style.display = isPelicula ? 'block' : 'none';
          document.getElementById('temporadas_field').style.display = isPelicula ? 'none' : 'block';
          }

          document.addEventListener('DOMContentLoaded', function () {
          toggleFields(); // Initialize the visibility on page load
          });
        </script>
    
                <!-- Carátula -->
                <div class="mb-3">
                  <label for="caratula_streaming" class="form-label">Carátula:</label>
                  <input type="file" name="caratula_streaming" id="caratula_streaming" class="form-control" required>
                </div>
    
                <!-- Trailer -->
                <div class="mb-3">
                  <label for="trailer_streaming" class="form-label">Trailer:</label>
                  <input type="file" name="trailer_streaming" id="trailer_streaming" class="form-control" required>
                </div>
    
                <!-- Clasificación -->
                <div class="mb-3">
                  <label for="clasificacion_streaming" class="form-label">Clasificación:</label>
                  <input type="text" name="clasificacion_streaming" id="clasificacion_streaming" class="form-control" placeholder="Ej: PG-13" required>
                </div>
    
                <!-- Sinopsis -->
                <div class="mb-3">
                  <label for="sipnosis_streaming" class="form-label">Sinopsis:</label>
                  <textarea name="sipnosis_streaming" id="sipnosis_streaming" class="form-control" rows="3" placeholder="Sin descripción por el momento"></textarea>
                </div>
    
                <!-- Fecha de Estreno -->
                <div class="mb-3">
                  <label for="fecha_estreno_streaming" class="form-label">Fecha de Estreno:</label>
                  <input type="date" name="fecha_estreno_streaming" id="fecha_estreno_streaming" class="form-control" required>
                </div>
    
                <!-- Género -->
                <div class="mb-3">
                  <label for="id_genero" class="form-label">Género:</label>
                  <select name="id_genero" id="id_genero" class="form-control" required>
                    @foreach($generos as $genero)
                      <option value="{{ $genero->id_genero }}">{{ $genero->nombre_genero }}</option>
                    @endforeach
                  </select>
                </div>
    
                <!-- Estatus -->
                <div class="mb-3">
                  <label for="estatus_streaming" class="form-label">Estatus:</label>
                  <select name="estatus_streaming" id="estatus_streaming" class="form-control">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>
    
                <!-- Botón -->
                <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary">Guardar Streaming</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    
        <!-- Pestaña de Video -->
        <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
          <div class="row">
            <!-- Columna para el formulario de Video -->
            <div class="col-md-6">
              <h3>Formulario de Video</h3>
              <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
    
                <!-- Video (ruta o identificador del video) -->
                <div class="mb-3">
                  <label for="video" class="form-label">Video:</label>
                  <input type="text" name="video" id="video" class="form-control" placeholder="Ingrese URL o identificador del video" required>
                </div>
    
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        Pelicula
                        <input type="checkbox" name="is_pelicula" id="is_pelicula" checked autocomplete="off" onchange="toggleTemporadaFields()">
                    </label>
                </div>
    
    <script>
        function toggleTemporadaFields() {
            const isPelicula = document.getElementById('is_pelicula').checked;
            const temporadaFields = document.querySelectorAll('#nombre_temporada, #video_temporada, #capitulo_temporada, #descripcion_capitulo_temporada');
    
            temporadaFields.forEach(field => {
                field.closest('.mb-3').style.display = isPelicula ? 'none' : 'block';
            });
        }
    
        document.addEventListener('DOMContentLoaded', function () {
            toggleTemporadaFields(); // Initialize the visibility on page load
        });
    </script>
                <!-- Nombre de la Temporada -->
                <div class="mb-3">
                  <label for="nombre_temporada" class="form-label">Nombre de la Temporada:</label>
                  <input type="text" name="nombre_temporada" id="nombre_temporada" class="form-control" placeholder="Ingrese el nombre de la temporada">
                </div>
    
                <!-- Video Temporada -->
                <div class="mb-3">
                  <label for="video_temporada" class="form-label">Video Temporada:</label>
                  <input type="number" name="video_temporada" id="video_temporada" class="form-control" placeholder="Ingrese el número de video de la temporada">
                </div>
    
                <!-- Capítulo de la Temporada -->
                <div class="mb-3">
                  <label for="capitulo_temporada" class="form-label">Capítulo de la Temporada:</label>
                  <input type="number" name="capitulo_temporada" id="capitulo_temporada" class="form-control" placeholder="Ingrese el capítulo de la temporada">
                </div>
    
                <!-- Descripción del Capítulo -->
                <div class="mb-3">
                  <label for="descripcion_capitulo_temporada" class="form-label">Descripción del Capítulo:</label>
                  <textarea name="descripcion_capitulo_temporada" id="descripcion_capitulo_temporada" class="form-control" rows="3" placeholder="Ingrese una descripción del capítulo"></textarea>
                </div>
    
                <!-- Streaming --> 
                <div class="mb-3">
                  <label for="id_streaming_video" class="form-label">Streaming:</label>
                  <select name="id_streaming" id="id_streaming_video" class="form-control" required>
                    @foreach ($streamings as $streaming)
                      <option value="{{ $streaming->id_streaming }}">{{ $streaming->nombre_streaming }}</option>
                    @endforeach
                  </select>
                </div>
    
                <!-- Estatus del Video -->
                <div class="mb-3">
                  <label for="estatus_video" class="form-label">Estatus del Video:</label>
                  <select name="estatus_video" id="estatus_video" class="form-control">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>
    
                <!-- Botón de Envío -->
                <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary">Guardar Video</button>
                </div>
              </form>
            </div>
      
            <!-- Aquí podrías agregar otra columna, por ejemplo, una tabla de videos, si lo requieres -->
      
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

<script>
  // En Bootstrap 5, los tabs usan data-bs-toggle y data-bs-target. Si se necesita que se muestren los tabs correctamente:
  document.addEventListener('DOMContentLoaded', function () {
    var triggerTabList = [].slice.call(document.querySelectorAll('#contentTabs button'));
    triggerTabList.forEach(function(triggerEl) {
      var tabTrigger = new bootstrap.Tab(triggerEl);
      triggerEl.addEventListener('click', function (event) {
        event.preventDefault();
        tabTrigger.show();
      });
    });
  });
</script>

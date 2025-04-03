@extends('layouts.appClient')    
@section('css')
    <style>
        .video-container {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        .progress {
            height: 10px;
            background-color: #000000;
        }

        .progress-bar {
            background-color: #8A2BE2;
        }

        .detail-card {
            background: linear-gradient(145deg, #1a1a1a, #222222);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            margin-bottom: 25px;
            border: 1px solid rgba(138, 43, 226, 0.1);
            transition: all 0.3s ease;
        }

        .detail-card:hover {
            box-shadow: 0 12px 25px rgba(138, 43, 226, 0.2);
        }

        .episode-card {
            background: linear-gradient(145deg, #1a1a1a, #222222);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            margin-bottom: 15px;
            cursor: pointer;
            border-left: 3px solid transparent;
        }

        .episode-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(138, 43, 226, 0.3);
            border-left: 3px solid #8A2BE2;
        }

        .episode-card .card-body {
            padding: 15px;
        }

        .episode-title {
            color: white;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .episode-info {
            color: #ccc;
            font-size: 14px;
        }
        
        .feature-badge {
            background-color: rgba(138, 43, 226, 0.2);
            color: #8A2BE2;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 20px;
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        
        .accordion-button:not(.collapsed) {
            background-color: #8A2BE2 !important;
            color: white !important;
        }
        
        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(138, 43, 226, 0.25);
        }
        
        .poster-container {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }
        
        .poster-container:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 25px rgba(138, 43, 226, 0.3);
        }
        
        .play-btn {
            border-radius: 50px;
            padding: 15px 30px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(138, 43, 226, 0.3);
        }
        
        .play-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(138, 43, 226, 0.5);
        }
        
        .info-label {
            color: #8A2BE2;
            font-weight: 600;
            margin-right: 5px;
        }
        
        .video-placeholder {
            background: linear-gradient(145deg, #1a1a1a, #222222);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            border-radius: 12px;
        }
        
        /* Personalizar la barra de video */
        video::-webkit-media-controls-panel {
            background-color: rgba(138, 43, 226, 0.2);
        }
        
        video::-webkit-media-controls-play-button {
            background-color: #8A2BE2;
            border-radius: 50%;
        }
        
        /* Estilo para el acordeón */
        .accordion-item {
            border-radius: 10px !important;
            margin-bottom: 10px;
            overflow: hidden;
            border: none !important;
        }
    </style>
@endsection

@section('content')
    <main class="main" style="background-color: #000000; color: white;">
        <div class="container py-5">

        <div class="row" style="padding-top:30px;">
                <!-- Carátula y tiempo restante -->
                <div class="col-lg-4 col-md-5 mb-4">
                    <div class="poster-container mb-4">
                        <img src="{{ $streaming->caratula_streaming ? asset($streaming->caratula_streaming) : '/api/placeholder/350/525' }}"
                            class="img-fluid" alt="{{ $streaming->nombre_streaming }}" style="width: 100%;">
                    </div>

                    <div class="mb-4">
                        @if($alquilado)
                            <!-- Si ya está alquilado -->
                            <div id="already-rented">
                            </div>
                        @endif
                    </div>
                    
                    <div class="detail-card">
                        <h3 style="color: white; font-size: 18px; margin-bottom: 15px; border-bottom: 1px solid rgba(138, 43, 226, 0.3); padding-bottom: 10px;">
                            <i class="bi bi-info-circle me-2" style="color: #8A2BE2;"></i> Detalles
                        </h3>
                        
                        <div class="mb-3">
                            <span class="info-label">Tipo:</span>
                            <span>{{ $streaming->temporadas_streaming > 0 ? 'Serie' : 'Película' }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="info-label">Género:</span>
                            <span>{{ $streaming->genero ? $streaming->genero->nombre_genero : 'No especificado' }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="info-label">Clasificación:</span>
                            <span>{{ $streaming->clasificacion_streaming }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="info-label">Duración:</span>
                            <span>{{ $streaming->duracion_streaming }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="info-label">Estreno:</span>
                            <span>{{ \Carbon\Carbon::parse($streaming->fecha_estreno_streaming)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Información del streaming -->
                <div class="col-lg-8 col-md-7">
                    <h1 style="color: white; margin-bottom: 5px; font-weight: 700;">{{ $streaming->nombre_streaming }}</h1>
                    
                    <div class="mb-4">
                        <span class="feature-badge">{{ $streaming->temporadas_streaming > 0 ? 'Serie' : 'Película' }}</span>
                        @if($streaming->genero)
                            <span class="feature-badge">{{ $streaming->genero->nombre_genero }}</span>
                        @endif
                        <span class="feature-badge">{{ $streaming->clasificacion_streaming }}</span>
                    </div>

                    <div class="detail-card mb-4">
                        <h3 style="color: white; font-size: 20px; margin-bottom: 15px; border-bottom: 1px solid rgba(138, 43, 226, 0.3); padding-bottom: 10px;">
                            <i class="bi bi-card-text me-2" style="color: #8A2BE2;"></i> Sinopsis
                        </h3>
                        <p style="line-height: 1.7; color: #ddd;">{{ $streaming->sipnosis_streaming }}</p>
                    </div>

                    <!-- Episode List for Series -->
                    @if($streaming->temporadas_streaming > 0 && isset($videos) && count($videos) > 0)
                        <div class="detail-card">
                            <h3 style="color: white; font-size: 20px; margin-bottom: 20px; border-bottom: 1px solid rgba(138, 43, 226, 0.3); padding-bottom: 10px;">
                                <i class="bi bi-collection-play me-2" style="color: #8A2BE2;"></i> Episodios
                            </h3>

                            @php
                                $episodes = $videos->groupBy('video_temporada');
                            @endphp

                            <!-- Bootstrap Accordion for Seasons -->
                            <div class="accordion" id="seasonAccordion">
                                @foreach($episodes as $temporada => $episodios)
                                    <div class="accordion-item bg-dark text-white">
                                        <h2 class="accordion-header" id="heading{{ $temporada }}">
                                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $temporada }}"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $temporada }}"
                                                style="background-color: #222; color: white; font-weight: 600;">
                                                <i class="bi bi-collection me-2"></i> Temporada {{ $temporada }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $temporada }}"
                                            class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $temporada }}" data-bs-parent="#seasonAccordion">
                                            <div class="accordion-body p-3" style="background-color: #111111;">
                                                @foreach($episodios as $episodio)
                                                    <div class="episode-card video-item" data-video="{{ asset($episodio->video) }}">
                                                        <div class="card-body d-flex align-items-center">
                                                            <div class="me-3 d-flex align-items-center justify-content-center" 
                                                                style="width: 40px; height: 40px; min-width: 40px; background-color: rgba(138, 43, 226, 0.2); border-radius: 50%;">
                                                                <span style="color: #8A2BE2; font-weight: bold;">{{ $episodio->capitulo_temporada }}</span>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="episode-title">{{ $episodio->nombre_temporada }}</h6>
                                                                <p class="episode-info mb-0">{{ $episodio->descripcion_capitulo_temporada }}</p>
                                                            </div>
                                                            <div class="ms-3">
                                                                <div style="width: 32px; height: 32px; background-color: #8A2BE2; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="bi bi-play-fill text-white"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($alquilado)
                <!-- Video Player Section -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="video-container ratio ratio-16x9">
                            @if(isset($videos) && count($videos) > 0)
                                <video id="videoPlayer" controls class="w-100">
                                    <source src="{{ asset($videos[0]->video) }}" type="video/mp4">
                                    Tu navegador no soporta videos HTML5.
                                </video>
                            @else
                                <div class="video-placeholder">
                                    <div class="text-center">
                                        <div style="font-size: 3.5rem; color: #8A2BE2; margin-bottom: 1.5rem;">
                                            <i class="bi bi-film"></i>
                                        </div>
                                        <h4 style="color: white; margin-bottom: 10px;">No hay videos disponibles</h4>
                                        <p style="color: #999; max-width: 400px;">No se encontraron episodios o películas para este contenido</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const videoPlayer = document.getElementById('videoPlayer');
            const playButton = document.getElementById('playButton');
            const videoItems = document.querySelectorAll('.video-item');

            // Añadir clase activa al episodio actual
            function setActiveEpisode(element) {
                videoItems.forEach(item => {
                    item.classList.remove('active');
                    item.style.borderLeft = '3px solid transparent';
                });
                
                if (element) {
                    element.classList.add('active');
                    element.style.borderLeft = '3px solid #8A2BE2';
                }
            }

            if (playButton) {
                playButton.addEventListener('click', function () {
                    if (videoPlayer) {
                        if (videoPlayer.paused) {
                            videoPlayer.play();
                            playButton.innerHTML = '<i class="bi bi-pause-fill me-2"></i> Pausar';
                        } else {
                            videoPlayer.pause();
                            playButton.innerHTML = '<i class="bi bi-play-fill me-2"></i> Reproducir ahora';
                        }
                    }

                    videoPlayer.scrollIntoView({ behavior: 'smooth' });
                });
            }

            videoItems.forEach(item => {
                item.addEventListener('click', function () {
                    const videoSrc = this.getAttribute('data-video');

                    if (videoPlayer && videoSrc) {
                        videoPlayer.src = videoSrc;
                        videoPlayer.load();
                        videoPlayer.play();

                        if (playButton) {
                            playButton.innerHTML = '<i class="bi bi-pause-fill me-2"></i> Pausar';
                        }
                        
                        setActiveEpisode(this);
                        videoPlayer.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
            
            // Establecer el primer episodio como activo por defecto
            if (videoItems.length > 0) {
                setActiveEpisode(videoItems[0]);
            }
            
            // Eventos para el reproductor de video
            if (videoPlayer) {
                videoPlayer.addEventListener('play', function() {
                    if (playButton) {
                        playButton.innerHTML = '<i class="bi bi-pause-fill me-2"></i> Pausar';
                    }
                });
                
                videoPlayer.addEventListener('pause', function() {
                    if (playButton) {
                        playButton.innerHTML = '<i class="bi bi-play-fill me-2"></i> Reproducir ahora';
                    }
                });
                
                videoPlayer.addEventListener('ended', function() {
                    if (playButton) {
                        playButton.innerHTML = '<i class="bi bi-play-fill me-2"></i> Reproducir de nuevo';
                    }
                });
            }
        });
    </script>
@endsection
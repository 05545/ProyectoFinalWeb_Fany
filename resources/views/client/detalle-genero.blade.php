@extends('layouts.appClient')    
@section('content')
    <main class="main" style="background-color: #000;">
        <!-- Hero del Género -->
        <div class="genre-hero" style="position: relative; padding: 100px 0; background: linear-gradient(135deg, rgba(106, 13, 173, 0.8) 0%, rgba(28, 28, 28, 0.9) 100%);">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="genre-header" data-aos="fade">
                            <h1 style="color: #BA68C8; font-weight: 800; text-align: center; margin-bottom: 20px; font-size: 3rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                                {{ $genero->nombre_genero }}
                            </h1>
                            <p class="genre-description" style="color: #CE93D8; font-size: 1.2rem; max-width: 700px; margin: 0 auto 40px;">
                                {{ $genero->descripcion_genero }}
                            </p>
                            <div class="stats-badge" style="background-color: rgba(156, 39, 176, 0.3); border: 1px solid #9C27B0; border-radius: 20px; padding: 8px 20px; display: inline-block;">
                                <span style="color: #E1BEE7; font-weight: 600;">
                                    {{ $genero->streamings->count() }} {{ $genero->streamings->count() === 1 ? 'título' : 'títulos' }} disponibles
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Streamings - Diseño Mosaico -->
        <div class="container py-5">
            @if($genero->streamings->count() > 0)
            <div class="masonry-grid">
                @foreach($genero->streamings as $streaming)
                <div class="masonry-item" 
                     style="position: relative;
                            border-radius: 12px;
                            overflow: hidden;
                            margin-bottom: 25px;
                            background-color: #1A1A1A;
                            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
                            transition: all 0.3s ease;">
                    
                    <!-- Portada con efecto hover -->
                    <div class="streaming-cover" style="position: relative; overflow: hidden; height: 350px;">
                        <img src="{{ $streaming->caratula_streaming ?? '/api/placeholder/300/450' }}" 
                             class="img-fluid" 
                             alt="{{ $streaming->nombre_streaming }}"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                        
                        <!-- Overlay de información -->
                        <div class="info-overlay" 
                             style="position: absolute;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background: linear-gradient(to top, rgba(0,0,0,0.9) 20%, transparent 70%);
                                    padding: 20px;
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: flex-end;">
                            
                            <h3 style="color: #E1BEE7; margin-bottom: 10px; font-size: 1.5rem;">{{ $streaming->nombre_streaming }}</h3>
                            
                            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <span class="badge" style="background-color: #7B1FA2; color: white; border-radius: 4px;">
                                    {{ $streaming->clasificacion_streaming }}
                                </span>
                                <span style="color: #CE93D8; font-size: 0.9rem;">
                                    {{ $streaming->duracion_streaming }} min
                                </span>
                            </div>
                            
                            <p style="color: #B39DDB; font-size: 0.95rem; margin-bottom: 20px;">
                                {{ \Illuminate\Support\Str::limit($streaming->sipnosis_streaming, 120) }}
                            </p>
                            
                            @if(auth()->check())
                                <a href="{{ route('client.alquiler.streaming', $streaming->id_streaming) }}" 
                                   class="rent-btn"
                                   style="display: inline-block;
                                          padding: 10px 20px;
                                          background-color: #9C27B0;
                                          color: white;
                                          text-decoration: none;
                                          border-radius: 30px;
                                          font-weight: 600;
                                          text-align: center;
                                          transition: all 0.3s ease;">
                                    Alquilar ahora
                                </a>
                            @else
                                <a href="{{ route('client.login') }}" 
                                   class="rent-btn"
                                   style="display: inline-block;
                                          padding: 10px 20px;
                                          background-color: #9C27B0;
                                          color: white;
                                          text-decoration: none;
                                          border-radius: 30px;
                                          font-weight: 600;
                                          text-align: center;
                                          transition: all 0.3s ease;">
                                    Inicia sesión para alquilar
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state text-center py-5">
                <div style="max-width: 500px; margin: 0 auto; padding: 40px; background-color: #1A1A1A; border-radius: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#BA68C8" viewBox="0 0 16 16" style="margin-bottom: 20px;">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg>
                    <h3 style="color: #BA68C8; margin-bottom: 15px;">No hay títulos disponibles</h3>
                    <p style="color: #CE93D8;">Actualmente no hay contenido en esta categoría.</p>
                </div>
            </div>
            @endif
        </div>
    </main>

    <style>
        .masonry-grid {
            columns: 4;
            column-gap: 25px;
        }
        
        .masonry-item {
            break-inside: avoid;
            margin-bottom: 25px;
        }
        
        .masonry-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(156, 39, 176, 0.4) !important;
        }
        
        .masonry-item:hover .streaming-cover img {
            transform: scale(1.05);
        }
        
        .rent-btn:hover {
            background-color: #7B1FA2 !important;
            transform: translateY(-2px);
        }
        
        @media (max-width: 1200px) {
            .masonry-grid {
                columns: 3;
            }
        }
        
        @media (max-width: 768px) {
            .masonry-grid {
                columns: 2;
            }
            
            .genre-hero {
                padding: 60px 0;
            }
            
            .genre-header h1 {
                font-size: 2.2rem !important;
            }
        }
        
        @media (max-width: 576px) {
            .masonry-grid {
                columns: 1;
            }
        }
    </style>
@endsection
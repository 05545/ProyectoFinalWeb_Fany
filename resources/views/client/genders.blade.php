@extends('layouts.appClient')
@section('content')
        <div class="page-title" data-aos="fade" style="position: relative; z-index: 1; padding: 100px 0;">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <div class="section-title">
                                <h1
                                    style="color: #9C27B0; font-weight: 700; text-align: center; margin-bottom: 50px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                                    Géneros
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <main class="main" style="background-color: #000000; color: white; background-image: https://media.istockphoto.com/id/1348168490/photo/black-and-dark-abstract-studio-room-interior-texture.jpg?s=612x612&w=0&k=20&c=YJPgz18vleT0ORn9gmo50-sqh9U0n44XFLDbC8dcbpo=;">
        <!-- Géneros Grid -->
        <div class="container py-5">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse($generos as $genero)
                <div class="col">
                    <div class="card h-100" style="background-color: #1A1A1A; border: 1px solid #9C27B0;">
                        <div class="card-body">
                            <h2 class="card-title" style="color: #BA68C8; font-size: 24px; margin-bottom: 15px;">{{ $genero->nombre_genero }}</h2>
                            <p style="color: #CE93D8; font-weight: bold; margin-bottom: 20px;">
                                {{ $genero->streamings_count }} títulos disponibles
                            </p>
                            <div class="row row-cols-3 g-2 mb-3">
                                @forelse($genero->miniaturasStreaming as $streaming)
                                <div class="col">
                                    <img src="{{ $streaming->caratula_streaming ?? '/api/placeholder/150/225' }}" 
                                         class="img-fluid rounded" alt="Carátula {{ $streaming->nombre_streaming }}">
                                </div>
                                @empty
                                    @for ($i = 1; $i <= 3; $i++)
                                    <div class="col">
                                        <img src="/api/placeholder/150/225" class="img-fluid rounded" alt="Placeholder {{ $i }}">
                                    </div>
                                    @endfor
                                @endforelse
                                
                                @if(count($genero->miniaturasStreaming) > 0 && count($genero->miniaturasStreaming) < 3)
                                    @for($i = count($genero->miniaturasStreaming); $i < 3; $i++)
                                    <div class="col">
                                        <img src="/api/placeholder/150/225" class="img-fluid rounded" alt="Placeholder">
                                    </div>
                                    @endfor
                                @endif
                            </div>
                            <a href="{{ route('genero.detalle', $genero->id_genero) }}" class="btn btn-lg w-100"
                                style="background-color: #9C27B0; color: white; font-weight: bold;">Ver todos</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <h3 style="color: #BA68C8;">No hay géneros disponibles en este momento.</h3>
                </div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
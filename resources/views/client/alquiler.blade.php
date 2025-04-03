@extends('layouts.appClient')
@section('content')

    <div
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-image: url('https://img.pikbest.com/wp/202408/movie-theater-concept-of-entertainment-3d-abstract-blank-cinema-screen-in_9750180.jpg!w700wp'); background-size: cover; background-position: center; opacity: 0.2; z-index: -1; filter: grayscale(50%);">
    </div>

    <div class="page-title" data-aos="fade" style="position: relative; z-index: 1; padding: 60px 0;">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="section-title">
                            <h1
                                style="color: #8A2BE2; font-weight: 700; text-align: center; margin-bottom: 30px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                                Mis alquileres
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="main" style="background-color: #000000; color: white;">

        <div class="container py-5">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="filter-buttons d-flex justify-content-center">
                        <button class="btn active me-3"
                            style="background-color: #8A2BE2; color: #ffffff; border: none; padding: 10px 25px; border-radius: 30px; transition: all 0.3s ease;" data-filter="en-proceso">
                            En proceso
                        </button>
                        <button class="btn me-3"
                            style="background-color: transparent; color: white; border: 2px solid #8A2BE2; padding: 10px 25px; border-radius: 30px; transition: all 0.3s ease;" data-filter="culminados">
                            Culminados
                        </button>
                        <button class="btn"
                            style="background-color: transparent; color: white; border: 2px solid #8A2BE2; padding: 10px 25px; border-radius: 30px; transition: all 0.3s ease;" data-filter="cancelados">
                            Cancelados
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                @if(isset($enProceso) && $enProceso->count() > 0)
                    @foreach($enProceso as $alquiler)
                        <div class="col-md-6 col-lg-4 mb-4 rental-item en-proceso">
                            <div class="rental-card"
                                style="background-color: #111111; border-radius: 15px; overflow: hidden; height: 100%; box-shadow: 0 5px 15px rgba(138, 43, 226, 0.2); transition: transform 0.3s ease;">
                                <div class="rental-image" style="position: relative; height: 220px; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $alquiler->streaming->caratula_streaming) }}" 
                                         alt="{{ $alquiler->streaming->nombre_streaming }}" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                    <div style="position: absolute; top: 10px; right: 10px;">
                                        <span class="status-badge"
                                            style="background-color: #8A2BE2; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                            En proceso
                                        </span>
                                    </div>
                                </div>
                                <div class="rental-info p-4">
                                    <h4 style="color: white; font-size: 1.3rem; margin-bottom: 15px;">{{ $alquiler->streaming->nombre_streaming }}</h4>
                                    <div class="rental-details mb-3">
                                        @php
                                            $diasRestantes = (int) \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($alquiler->fecha_fin_alquiler), false);
                                        @endphp
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div style="width: 100%; background-color: #333; height: 6px; border-radius: 3px;">
                                                @php
                                                    $totalDias = \Carbon\Carbon::parse($alquiler->fecha_inicio_alquiler)->diffInDays(\Carbon\Carbon::parse($alquiler->fecha_fin_alquiler));
                                                    $diasPasados = $totalDias - $diasRestantes;
                                                    $porcentajeCompletado = max(0, min(100, ($diasPasados / $totalDias) * 100));
                                                @endphp
                                                <div style="width: {{ $porcentajeCompletado }}%; background-color: #8A2BE2; height: 100%; border-radius: 3px;"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="mb-2" style="font-size: 0.9rem;"><span style="color: #8A2BE2; font-weight: bold;">Inicio:</span><br>
                                                {{ \Carbon\Carbon::parse($alquiler->fecha_inicio_alquiler)->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-2" style="font-size: 0.9rem;"><span style="color: #8A2BE2; font-weight: bold;">Vence:</span><br>
                                                {{ \Carbon\Carbon::parse($alquiler->fecha_fin_alquiler)->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                        
                                        <p class="mt-2" style="font-size: 1.1rem; font-weight: bold;">
                                            <span style="color: #8A2BE2;">Días restantes:</span> {{ $diasRestantes > 0 ? $diasRestantes : 0 }}
                                        </p>
                                    </div>
                                    <div class="rental-actions d-flex justify-content-between mt-3">
                                        <a href="{{ route('cliente.streaming.show', ['id' => $alquiler->id_streaming]) }}" class="btn"
                                            style="background-color: #8A2BE2; color: white; border: none; border-radius: 30px; padding: 8px 20px; flex-grow: 1; margin-right: 10px; transition: all 0.3s ease;">
                                            <i class="fas fa-play me-2"></i> Reproducir
                                        </a>
                                        <form action="{{ route('cliente.alquiler.cancelar', ['idAlquiler' => $alquiler->id_alquiler]) }}" method="POST" class="d-inline" style="flex-grow: 0;">
                                            @csrf
                                            <button type="submit" class="btn"
                                                style="background-color: transparent; color: white; border: 2px solid #8A2BE2; border-radius: 30px; padding: 8px 10px; transition: all 0.3s ease;"
                                                onclick="return confirm('¿Estás seguro de que deseas cancelar este alquiler?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if(isset($culminados) && $culminados->count() > 0)
                    @foreach($culminados as $alquiler)
                        <div class="col-md-6 col-lg-4 mb-4 rental-item culminados" style="display: none;">
                            <div class="rental-card"
                                style="background-color: #111111; border-radius: 15px; overflow: hidden; height: 100%; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s ease;">
                                <div class="rental-image" style="position: relative; height: 220px; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $alquiler->streaming->caratula_streaming) }}" 
                                         alt="{{ $alquiler->streaming->nombre_streaming }}"
                                         onerror="this.src='#'"
                                         style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(50%);">
                                    <div style="position: absolute; top: 10px; right: 10px;">
                                        <span class="status-badge"
                                            style="background-color: #666666; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                            Culminado
                                        </span>
                                    </div>
                                </div>
                                <div class="rental-info p-4">
                                    <h4 style="color: white; font-size: 1.3rem; margin-bottom: 15px;">{{ $alquiler->streaming->nombre_streaming }}</h4>
                                    <div class="rental-details mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="mb-2" style="font-size: 0.9rem;"><span style="color: #8A2BE2; font-weight: bold;">Inicio:</span><br>
                                                {{ \Carbon\Carbon::parse($alquiler->fecha_inicio_alquiler)->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-2" style="font-size: 0.9rem;"><span style="color: #8A2BE2; font-weight: bold;">Venció:</span><br>
                                                {{ \Carbon\Carbon::parse($alquiler->fecha_fin_alquiler)->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-3 text-center">
                                            <a href="{{ route('catalogo') }}" class="btn"
                                                style="background-color: #8A2BE2; color: white; border: none; border-radius: 30px; padding: 8px 20px; transition: all 0.3s ease;">
                                                Alquilar de nuevo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if(isset($cancelados) && $cancelados->count() > 0)
                    @foreach($cancelados as $alquiler)
                        <div class="col-md-6 col-lg-4 mb-4 rental-item cancelados" style="display: none;">
                            <div class="rental-card"
                                style="background-color: #111111; border-radius: 15px; overflow: hidden; height: 100%; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s ease;">
                                <div class="rental-image" style="position: relative; height: 220px; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $alquiler->streaming->caratula_streaming) }}" 
                                         alt="{{ $alquiler->streaming->nombre_streaming }}"
                                         style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(70%);">
                                    <div style="position: absolute; top: 10px; right: 10px;">
                                        <span class="status-badge"
                                            style="background-color: #990000; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                            Cancelado
                                        </span>
                                    </div>
                                </div>
                                <div class="rental-info p-4">
                                    <h4 style="color: white; font-size: 1.3rem; margin-bottom: 15px;">{{ $alquiler->streaming->nombre_streaming }}</h4>
                                    <div class="rental-details mb-3">
                                        <p class="mb-2" style="font-size: 0.9rem;"><span style="color: #8A2BE2; font-weight: bold;">Fecha de alquiler:</span><br>
                                        {{ \Carbon\Carbon::parse($alquiler->fecha_inicio_alquiler)->format('d/m/Y') }}</p>
                                        
                                        <div class="mt-3 text-center">
                                            <a href="{{ route('catalogo') }}" class="btn"
                                                style="background-color: #8A2BE2; color: white; border: none; border-radius: 30px; padding: 8px 20px; transition: all 0.3s ease;">
                                                Volver a alquilar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="no-results text-center py-5" style="display: none;">
                <div style="max-width: 500px; margin: 0 auto; background-color: #111111; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(138, 43, 226, 0.2);">
                    <i class="fas fa-film" style="font-size: 3rem; color: #8A2BE2; margin-bottom: 20px;"></i>
                    <h3 style="color: white; margin-bottom: 15px;">No tienes alquileres en esta categoría</h3>
                    <p style="color: #999999; margin-bottom: 25px;">Explora nuestro catálogo para encontrar los mejores servicios de streaming</p>
                    <a href="{{ route('catalogo') }}" class="btn" 
                       style="background-color: #8A2BE2; color: white; border: none; border-radius: 30px; padding: 10px 30px; transition: all 0.3s ease;">
                       Ver catálogo
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-buttons .btn');
            
            // Añadir efecto hover a las tarjetas
            document.querySelectorAll('.rental-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            function filterRentals(filterType) {
                document.querySelectorAll('.rental-item').forEach(item => {
                    item.style.display = 'none';
                });
                
                const visibleItems = document.querySelectorAll('.rental-item.' + filterType);
                visibleItems.forEach(item => {
                    item.style.display = 'block';
                });
                
                const noResultsContainer = document.querySelector('.no-results');
                if (visibleItems.length === 0) {
                    noResultsContainer.style.display = 'block';
                } else {
                    noResultsContainer.style.display = 'none';
                }
            }
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    filterButtons.forEach(btn => {
                        btn.classList.remove('active');
                        btn.style.backgroundColor = 'transparent';
                        btn.style.color = 'white';
                        btn.style.border = '2px solid #8A2BE2';
                    });
                    
                    this.classList.add('active');
                    this.style.backgroundColor = '#8A2BE2';
                    this.style.color = 'white';
                    this.style.border = 'none';
                    
                    const filterType = this.getAttribute('data-filter');
                    filterRentals(filterType);
                });
                
                // Añadir efecto hover a los botones de filtro
                button.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = 'rgba(138, 43, 226, 0.2)';
                    }
                });
                
                button.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = 'transparent';
                    }
                });
            });
            
            const defaultFilterButton = document.querySelector('.filter-buttons .btn.active');
            if (defaultFilterButton) {
                const filterType = defaultFilterButton.getAttribute('data-filter');
                filterRentals(filterType);
            }
        });
    </script>
@endsection
@extends('layouts.appClient')
@section('content')
    <main class="main" style="background-color: #000;">
        <!-- Banner Promocional Planes - Estilo Moderno -->
        <section id="planes-promocional" class="section"
            style="padding: 80px 0; background: linear-gradient(135deg, #6A0DAD 0%, #9C27B0 100%); color: white;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10" data-aos="fade-up">
                        <h2
                            style="font-size: 36px; margin-bottom: 30px; text-align: center; font-weight: 800; text-transform: uppercase; letter-spacing: 2px;">
                            <span style="border-bottom: 3px solid #BA68C8; padding-bottom: 5px;">Nuestros Planes</span>
                        </h2>

                        <div class="row justify-content-center">
                            @php
                                $planesDestacados = $planes->take(3);
                                $planContador = 0;
                            @endphp

                            @forelse($planesDestacados as $index => $plan)
                                                    @php
                                                        $planContador++;
                                                        $esDestacado = ($planContador == 2);
                                                    @endphp
                                                    <div class="col-md-4 mb-4" style="padding: 15px;">
                                                        <div class="plan-card" style="background-color: {{ $esDestacado ? '#1A1A1A' : '#2A2A2A' }};
                                                                            border-radius: 15px;
                                                                            padding: 30px;
                                                                            height: 100%;
                                                                            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
                                                                            transition: all 0.3s ease;
                                                                            border: 1px solid {{ $esDestacado ? '#9C27B0' : 'transparent' }};
                                                                            {{ $esDestacado ? 'transform: translateY(-10px);' : '' }}">
                                                            <h3 style="font-size: 24px; color: #BA68C8; text-align: center; margin-bottom: 20px;">
                                                                {{ strtoupper($plan->nombre_plan) }}
                                                            </h3>
                                                            <div style="text-align: center; margin-bottom: 25px;">
                                                                <span style="font-size: 14px; color: #CE93D8;">Desde solo</span>
                                                                <p style="font-size: 42px; font-weight: bold; margin: 5px 0; color: #E1BEE7;">
                                                                    ${{ number_format($plan->precio_plan, 2) }}
                                                                    <span style="font-size: 16px; color: #CE93D8;">/mes</span>
                                                                </p>
                                                            </div>
                                                            <div style="text-align: center;">
                                                                <a href="#" class="btn-plan" style="background-color: #9C27B0; 
                                                                                  color: white; 
                                                                                  padding: 10px 25px;
                                                                                  border-radius: 30px;
                                                                                  font-weight: 600;
                                                                                  text-transform: uppercase;
                                                                                  letter-spacing: 1px;
                                                                                  transition: all 0.3s ease;">
                                                                    Suscribirse
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                            @empty
                                <div class="col-12 text-center">
                                    <p style="color: #BA68C8; font-size: 18px;">No hay planes disponibles en este momento.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Banner Promocional Planes -->
<!-- Novedades - Diseño Alternativo en Mosaico -->
<section id="novedades" class="section" style="padding: 80px 0; background-color: #000;">
            <div class="container">
                <div class="section-header" style="text-align: center; margin-bottom: 50px;">
                    <h2 style="font-size: 36px; color: #BA68C8; position: relative; display: inline-block; font-weight: 800;">
                        <span style="display: inline-block; position: relative;">
                            NOVEDADES
                            <span style="position: absolute; bottom: -10px; left: 0; width: 100%; height: 3px; background: linear-gradient(90deg, #9C27B0, transparent);"></span>
                        </span>
                    </h2>
                    <p style="color: #CE93D8; max-width: 600px; margin: 15px auto 0; font-size: 16px;">
                        Explora nuestro catálogo más reciente
                    </p>
                </div>

                <!-- Diseño alternativo tipo masonry -->
                <div class="row" data-aos="fade-up">
                    <!-- Estreno destacado en formato horizontal -->
                    @if($estreno)
                    <div class="col-12 mb-4">
                        <div class="featured-horizontal" 
                             style="position: relative; 
                                    border-radius: 12px; 
                                    overflow: hidden; 
                                    height: 300px;
                                    display: flex;
                                    box-shadow: 0 15px 30px rgba(156, 39, 176, 0.3);">
                            <div style="flex: 1; min-width: 50%;">
                                <img src="{{ asset('streaming/imagen/' . ($estreno->caratula_streaming ?? 'placeholder.png')) }}"
                                    alt="{{ $estreno->nombre_streaming }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div style="flex: 1; padding: 30px; background: linear-gradient(to right, #1A1A1A, #2A2A2A);">
                                <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                    <span style="background-color: #9C27B0; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: bold;">ESTRENO</span>
                                    <span style="margin-left: 10px; color: #CE93D8; font-size: 14px;">
                                        {{ $estreno->temporadas_streaming > 0 ? 'Serie' : 'Película' }}
                                    </span>
                                </div>
                                <h3 style="margin: 0 0 15px; font-size: 28px; color: white;">{{ $estreno->nombre_streaming }}</h3>
                                <p style="margin-bottom: 20px; font-size: 15px; color: #E1BEE7; line-height: 1.5;">
                                    {{ \Illuminate\Support\Str::limit($estreno->sipnosis_streaming, 200) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Grid de novedades en diseño staggered -->
                    <div class="col-12">
                        <div class="row staggered-grid">
                            @php
                                $sizes = ['tall', 'wide', 'regular', 'regular', 'tall', 'wide'];
                                $sizeIndex = 0;
                            @endphp

                            @forelse($recientes as $reciente)
                                @php
                                    $size = $sizes[$sizeIndex % count($sizes)];
                                    $sizeIndex++;
                                @endphp
                                
                                <div class="col-md-4 mb-4 {{ $size === 'wide' ? 'col-lg-8' : '' }} {{ $size === 'tall' ? 'staggered-tall' : '' }}">
                                    <div class="staggered-item {{ $size }}"
                                         style="position: relative;
                                                border-radius: 10px;
                                                overflow: hidden;
                                                height: {{ $size === 'tall' ? '500px' : ($size === 'wide' ? '300px' : '250px') }};
                                                background-color: #1A1A1A;
                                                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                                                transition: all 0.3s ease;">
                                        @if($reciente->caratula_streaming)
                                        <img src="{{ $reciente->caratula_streaming }}"
                                             alt="{{ $reciente->nombre_streaming }}"
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                            <p style="color: #BA68C8;">{{ $reciente->nombre_streaming }}</p>
                                        </div>
                                        @endif
                                        
                                        <div class="staggered-overlay"
                                             style="position: absolute;
                                                    bottom: 0;
                                                    left: 0;
                                                    right: 0;
                                                    padding: 20px;
                                                    background: linear-gradient(transparent, rgba(0,0,0,0.9));">
                                            <h5 style="margin: 0 0 5px; font-size: 18px; color: white;">{{ $reciente->nombre_streaming }}</h5>
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <span style="font-size: 12px; color: #CE93D8;">
                                                    {{ $reciente->genero ? $reciente->genero->nombre_genero : 'Sin género' }}
                                                </span>
                                                <div class="play-icon-small" 
                                                     style="width: 30px; height: 30px; background-color: rgba(156, 39, 176, 0.8); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <div style="background-color: #1A1A1A; border-radius: 10px; padding: 40px;">
                                        <p style="color: #BA68C8; font-size: 18px;">No hay novedades disponibles</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .plan-card:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 15px 30px rgba(156, 39, 176, 0.4) !important;
        }

        .btn-plan:hover {
            background-color: #7B1FA2 !important;
            transform: translateY(-2px);
        }

        .new-item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(156, 39, 176, 0.3) !important;
        }

        .new-item-card:hover .play-icon {
            opacity: 1;
        }

        .featured-horizontal:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(156, 39, 176, 0.4) !important;
        }
        
        .staggered-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(156, 39, 176, 0.4) !important;
        }
        
        .staggered-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .staggered-grid > div {
            flex: 1 1 calc(33.333% - 20px);
            min-width: 250px;
        }
        
        .staggered-tall {
            flex: 1 1 calc(50% - 20px) !important;
        }
        
        @media (max-width: 992px) {
            .featured-horizontal {
                flex-direction: column;
                height: auto !important;
            }
            
            .featured-horizontal > div {
                min-width: 100% !important;
            }
            
            .staggered-grid > div {
                flex: 1 1 calc(50% - 20px) !important;
            }
        }
        
        @media (max-width: 768px) {
            .staggered-grid > div {
                flex: 1 1 100% !important;
            }
        }
    </style>
@endsection
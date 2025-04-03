@extends('layouts.appClient')    
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #000;
            color: #E1BEE7;
        }

        .plan-box {
            transition: all 0.3s ease;
            background: linear-gradient(145deg, #1A1A1A, #2A2A2A);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            border: none;
        }

        .plan-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(156, 39, 176, 0.4);
        }

        .plan-box.featured {
            border-top: 5px solid #BA68C8;
            transform: scale(1.05);
            z-index: 10;
        }

        .featured-badge {
            background: #9C27B0 !important;
            color: white !important;
        }

        .subscribe-btn {
            background-color: #9C27B0;
            color: white !important;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .subscribe-btn:hover {
            transform: scale(1.05);
            background-color: #7B1FA2 !important;
        }

        .modal-content {
            background-color: #1A1A1A;
            border: 1px solid #9C27B0;
        }

        .modal-header {
            border-bottom: 1px solid #333;
        }

        .modal-footer {
            border-top: 1px solid #333;
        }

        .form-control {
            background-color: #222;
            border: 1px solid #444;
            color: white;
        }

        .form-label {
            color: #BA68C8 !important;
        }

        .alert-info {
            background-color: rgba(156, 39, 176, 0.2) !important;
            border-color: #9C27B0;
            color: #E1BEE7;
        }

        .current-plan-card {
            border: 2px solid #BA68C8 !important;
            background: linear-gradient(145deg, #1A1A1A, #2A2A2A);
        }

        .page-title h1 {
            color: #BA68C8 !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .plan-price {
            color: #E1BEE7 !important;
        }

        .plan-period {
            color: #CE93D8 !important;
        }

        @media (max-width: 768px) {
            .plan-box.featured {
                transform: scale(1);
                margin: 30px 0;
            }
            
            .masonry-grid {
                columns: 1 !important;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="hero-section" style="position: relative; padding: 120px 0; background: linear-gradient(rgba(106, 13, 173, 0.7), rgba(0, 0, 0, 0.7)), url('https://img.pikbest.com/wp/202408/movie-theater-concept-of-entertainment-3d-abstract-blank-cinema-screen-in_9750180.jpg!w700wp'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 style="color: #BA68C8; font-weight: 800; font-size: 3rem; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                        Planes Disponibles
                    </h1>
                    <p style="color: #CE93D8; font-size: 1.2rem;">
                        Elige el plan que mejor se adapte a tus necesidades
                    </p>
                </div>
            </div>
        </div>
    </div>

    <main class="main" style="background-color: #000;">
        <!-- Current Plan Section -->
        @if(auth()->check())
            <section class="py-5" style="background-color: #111;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center mb-4">
                            <h2 style="color: #BA68C8; font-weight: 700;">Tu Plan Actual</h2>
                        </div>

                        @if($planContratado)
                            <div class="col-lg-6">
                                <div class="current-plan-card card text-white p-4">
                                    <div class="card-body text-center">
                                        <h3 style="color: #BA68C8;">{{ $planContratado->plan->nombre_plan }}</h3>
                                        <div class="plan-details mt-4">
                                            <div class="detail-item mb-3">
                                                <span style="color: #CE93D8;">Precio:</span>
                                                <span class="plan-price">${{ number_format($planContratado->plan->precio_plan, 2) }} / mes</span>
                                            </div>
                                            <div class="detail-item mb-3">
                                                <span style="color: #CE93D8;">Inicio:</span>
                                                <span>{{ $planContratado->fecha_registro_plan->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="detail-item mb-3">
                                                <span style="color: #CE93D8;">Vencimiento:</span>
                                                <span>{{ $planContratado->fecha_fin_plan->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="detail-item">
                                                <span style="color: #CE93D8;">Días restantes:</span>
                                                <span class="remaining-days" style="color: #E1BEE7; font-weight: 600;">
                                                    {{ (int) now()->diffInDays($planContratado->fecha_fin_plan) }} días
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6">
                                <div class="alert alert-info text-center py-4">
                                    <h4 style="color: #BA68C8;">No tienes un plan activo</h4>
                                    <p style="color: #E1BEE7;">Suscríbete a uno de nuestros planes para disfrutar de todos los beneficios</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        <!-- Plans Section -->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    @if(count($planes) > 0)
                        @foreach($planes as $index => $plan)
                            @php
                                $isFeatured = count($planes) >= 3 ? $index == 1 : false;
                                $planWidth = count($planes) == 1 ? '12' : (count($planes) == 2 ? '6' : '4');
                            @endphp

                            <div class="col-lg-{{ $planWidth }} col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="{{ 100 + ($index * 100) }}">
                                <div class="plan-box h-100 p-4 {{ $isFeatured ? 'featured' : '' }}">
                                    @if($isFeatured)
                                        <div class="text-center mb-3">
                                            <span class="featured-badge px-3 py-1">MÁS POPULAR</span>
                                        </div>
                                    @endif

                                    <div class="text-center mb-4">
                                        <h3 style="color: #BA68C8; font-weight: 700;">{{ $plan->nombre_plan }}</h3>
                                    </div>

                                    <div class="text-center my-4">
                                        <h2 class="plan-price">${{ number_format($plan->precio_plan, 2) }}</h2>
                                        <span class="plan-period">
                                            @if ($plan->tipo_plan == 8)
                                                /semana
                                            @elseif ($plan->tipo_plan == 16)
                                                /mes
                                            @elseif ($plan->tipo_plan == 32)
                                                /año
                                            @endif
                                        </span>
                                    </div>

                                    <div class="text-center mb-4">
                                        <span style="color: #CE93D8;">
                                            @if ($plan->tipo_plan == 8)
                                                Plan Semanal
                                            @elseif ($plan->tipo_plan == 16)
                                                Plan Mensual
                                            @elseif ($plan->tipo_plan == 32)
                                                Plan Anual
                                            @else
                                                Personalizado
                                            @endif
                                        </span>
                                    </div>

                                    <div class="text-center mt-4">
                                        @if(auth()->check())
                                            <button type="button" class="subscribe-btn btn-lg px-4" data-toggle="modal"
                                                data-target="#planModal{{ $plan->id_plan }}">
                                                Suscribirse
                                            </button>
                                        @else
                                            <a href="{{ route('client.login') }}" class="subscribe-btn btn-lg px-4">
                                                Suscribirse
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            @if(auth()->check())
                                <div class="modal fade" id="planModal{{ $plan->id_plan }}" tabindex="-1" role="dialog"
                                    aria-labelledby="planModalLabel{{ $plan->id_plan }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" style="color: #BA68C8;">
                                                    Suscribirse a {{ $plan->nombre_plan }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" style="color: #E1BEE7;">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('client.planes.contrato') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_plan" value="{{ $plan->id_plan }}">
                                                <div class="modal-body">
                                                    <div class="form-group mb-3">
                                                        <label for="tarjeta_pago" class="form-label">Número de Tarjeta</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" style="background-color: #222; border-color: #444; color: #E1BEE7;">
                                                                    <i class="fas fa-credit-card"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" id="tarjeta_pago_{{ $plan->id_plan }}"
                                                                name="tarjeta_pago" placeholder="XXXX XXXX XXXX XXXX" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="fecha_expiracion" class="form-label">Fecha de Expiración</label>
                                                                <input type="text" class="form-control"
                                                                    id="fecha_expiracion_{{ $plan->id_plan }}" name="fecha_expiracion"
                                                                    placeholder="MM/AA" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="cvv" class="form-label">CVV</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" style="background-color: #222; border-color: #444; color: #E1BEE7;">
                                                                            <i class="fas fa-lock"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="password" class="form-control" id="cvv_{{ $plan->id_plan }}"
                                                                        name="cvv" placeholder="•••" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3">
                                                        <label for="nombre_tarjeta" class="form-label">Nombre en la Tarjeta</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" style="background-color: #222; border-color: #444; color: #E1BEE7;">
                                                                    <i class="fas fa-user"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" id="nombre_tarjeta"
                                                                name="nombre_tarjeta" placeholder="Nombre completo" required>
                                                        </div>
                                                    </div>

                                                    <div class="alert alert-info mt-4">
                                                        <i class="fas fa-info-circle mr-2"></i> Se te cobrará 
                                                        <strong>${{ number_format($plan->precio_plan, 2) }}</strong>
                                                        @if ($plan->tipo_plan == 8)
                                                            semanalmente
                                                        @elseif ($plan->tipo_plan == 16)
                                                            mensualmente
                                                        @elseif ($plan->tipo_plan == 32)
                                                            anualmente
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        style="background-color: #333; border: none;">Cancelar</button>
                                                    <button type="submit" class="subscribe-btn">
                                                        Confirmar Suscripción
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-film" style="font-size: 3rem; color: #BA68C8; margin-bottom: 20px;"></i>
                                <h3 style="color: #BA68C8;">No hay planes disponibles</h3>
                                <p style="color: #CE93D8;">Por favor, vuelve a intentarlo más tarde</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            AOS.init();
            
            // Form validation and formatting (same as before)
            $('form').submit(function (event) {
                let planId = $(this).find('input[name="id_plan"]').val();
                let tarjeta = $(this).find('#tarjeta_pago_' + planId).val().replace(/\D/g, '');
                let cvv = $(this).find('#cvv_' + planId).val().replace(/\D/g, '');
                let fechaExp = $(this).find('#fecha_expiracion_' + planId).val();

                if (tarjeta.length !== 16) {
                    alert('El número de tarjeta debe tener 16 dígitos');
                    event.preventDefault();
                    return false;
                }

                if (cvv.length < 3 || cvv.length > 4) {
                    alert('El CVV debe tener entre 3 y 4 dígitos');
                    event.preventDefault();
                    return false;
                }

                let fechaRegex = /^(0[1-9]|1[0-2])\/([0-9]{2})$/;
                if (!fechaRegex.test(fechaExp)) {
                    alert('La fecha de expiración debe tener el formato MM/AA');
                    event.preventDefault();
                    return false;
                }

                return true;
            });

            $('[id^="tarjeta_pago_"]').on('input', function () {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 16) value = value.slice(0, 16);

                let formattedValue = '';
                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) formattedValue += ' ';
                    formattedValue += value[i];
                }

                $(this).val(formattedValue);
            });

            $('[id^="fecha_expiracion_"]').on('input', function () {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 4) value = value.slice(0, 4);

                if (value.length > 2) {
                    $(this).val(value.slice(0, 2) + '/' + value.slice(2));
                } else {
                    $(this).val(value);
                }
            });

            $('[id^="cvv_"]').on('input', function () {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 4) value = value.slice(0, 4);
                $(this).val(value);
            });
        });
    </script>
@endsection
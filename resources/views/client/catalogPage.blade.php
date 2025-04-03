@extends('layouts.appClient')    
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #000000;
            color: #ffffff;
        }

        .plan-box:hover {
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .plan-box {
            transition: all 0.3s ease;
        }

        .subscribe-btn:hover {
            transform: scale(1.05);
        }

        .cta-btn:hover {
            background-color: #ffffff;
            color: #0073E6;
        }

        .table {
            color: #ffffff;
        }

        .accordion-button::after {
            filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(93deg) brightness(103%) contrast(103%);
        }

        /* Estilos para el modal */
        .modal-content {
            background-color: #111111;
            color: #ffffff;
            border: 1px solid #333333;
        }

        .modal-header {
            border-bottom: 1px solid #333333;
        }

        .modal-footer {
            border-top: 1px solid #333333;
        }

        .close {
            color: #ffffff;
        }

        .form-control {
            background-color: #222222;
            border: 1px solid #444444;
            color: #ffffff;
        }

        .form-label {
            color: #FFCC00;
        }

        @media (max-width: 768px) {
            .plan-box.featured {
                transform: scale(1);
                margin-top: 30px;
                margin-bottom: 30px;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
@endsection

@section('content')
    <!-- Page Title -->
    <div
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-image: url('https://img.pikbest.com/wp/202408/movie-theater-concept-of-entertainment-3d-abstract-blank-cinema-screen-in_9750180.jpg!w700wp'); background-size: cover; background-position: center; opacity: 0.3; z-index: -1;">
    </div>
    <div class="page-title" data-aos="fade" style="position: relative; z-index: 1; padding: 100px 0;">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="section-title">
                            <h1
                                style="color: #FFCC00; font-weight: 700; text-align: center; margin-bottom: 50px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                                Planes disponibles
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="main" style="background-color: #000000; color: #ffffff;">
        <!-- Sección de plan actual -->
        @if(auth()->check())
            <section class="current-plan py-5" style="background-color: #111111;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            <h2 style="color: #FFCC00; font-weight: 700;">Tu Plan Actual</h2>
                        </div>

                        @if($planContratado)
                            <div class="col-md-8 mx-auto">
                                <div class="card bg-dark text-white" style="border: 2px solid #FFCC00;">
                                    <div class="card-body text-center">
                                        <h3 class="card-title" style="color: #FFCC00;">{{ $planContratado->plan->nombre_plan }}</h3>
                                        <p class="card-text">
                                            <strong>Precio:</strong> ${{ number_format($planContratado->plan->precio_plan, 2) }} /
                                            mes
                                        </p>
                                        <p class="card-text">
                                            <strong>Fecha de inicio:</strong>
                                            {{ $planContratado->fecha_registro_plan->format('d/m/Y') }}
                                        </p>
                                        <p class="card-text">
                                            <strong>Fecha de vencimiento:</strong>
                                            {{ $planContratado->fecha_fin_plan->format('d/m/Y') }}
                                        </p>
                                        <p class="card-text">
                                            <strong>Días restantes:</strong>
                                            {{ (int) now()->diffInDays($planContratado->fecha_fin_plan) }} días
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 text-center">
                                <div class="alert alert-info" style="background-color: #0073E6; color: white;">
                                    <h4>No tienes ningún plan activo en este momento</h4>
                                    <p>Suscríbete a uno de nuestros planes para disfrutar de todos los beneficios</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        <!-- Sección de planes -->
        <section id="services" class="services section" style="padding: 60px 0; background-color: #000000;">
            <div class="container" data-aos="fade-up">

                <!-- Comparativa de planes en formato tarjetas -->
                <div class="row plans-container">
                    @if(count($planes) > 0)
                                @foreach($planes as $index => $plan)
                                            @php
                                                $isFeatured = count($planes) >= 3 ? $index == 1 : false;
                                            @endphp

                                            <div class="col-lg-{{ 12 / count($planes) }} col-md-6 mt-4 mt-md-0" data-aos="zoom-in"
                                                data-aos-delay="{{ 100 + ($index * 100) }}">
                                                <div class="plan-box {{ $isFeatured ? 'featured' : '' }}"
                                                    style="background: #111111; border-radius: 10px; box-shadow: 0 5px 25px rgba(255, 255, 255, {{ $isFeatured ? '0.15' : '0.1' }}); padding: 30px; height: 100%; border-top: 5px solid {{ $isFeatured ? '#FFCC00' : '#0073E6' }}; {{ $isFeatured ? 'transform: scale(1.05); position: relative; z-index: 10;' : '' }}">

                                                    @if($isFeatured)
                                                        <span class="featured-badge"
                                                            style="position: absolute; top: -15px; right: 30px; background: #FFCC00; color: #000000; padding: 5px 15px; border-radius: 50px; font-weight: 600; font-size: 14px;">Popular</span>
                                                    @endif

                                                    <h3 style="color: #FFCC00; font-weight: 700; margin-bottom: 15px; text-align: center;">
                                                        {{ $plan->nombre_plan }}
                                                    </h3>
                                                    <h4
                                                        style="color: #0073E6; font-size: 32px; font-weight: 700; margin: 20px 0; text-align: center;">
                                                        ${{ number_format($plan->precio_plan, 2) }}
                                                        <span style="font-size: 16px; color: #aaaaaa; font-weight: 400;">
                                                            @if ($plan->tipo_plan == 8)
                                                                /semana
                                                            @elseif ($plan->tipo_plan == 16)
                                                                /mes
                                                            @elseif ($plan->tipo_plan == 32)
                                                                /año
                                                            @endif
                                                        </span>
                                                    </h4>

                                                    <h5 style="color: #FFCC00; font-weight: 200; margin-bottom: 15px; text-align: center;">
                                                        @if ($plan->tipo_plan == 8)
                                                            Semanal
                                                        @elseif ($plan->tipo_plan == 16)
                                                            Mensual
                                                        @elseif ($plan->tipo_plan == 32)
                                                            Anual
                                                        @else
                                                            Por definirse
                                                        @endif
                                                    </h5>

                                                    <div class="text-center">
                                                        @if(auth()->check())
                                                            <button type="button" class="subscribe-btn" data-toggle="modal"
                                                                data-target="#planModal{{ $plan->id_plan }}"
                                                                style="display: inline-block; padding: 12px 30px; background-color: #FFCC00; color: #000000; text-decoration: none; border-radius: 50px; font-weight: 600; transition: all 0.3s ease; border: none; cursor: pointer;">
                                                                Suscribirse
                                                            </button>
                                                        @else
                                                            <a href="{{ route('login') }}" class="subscribe-btn"
                                                                style="display: inline-block; padding: 12px 30px; background-color: #FFCC00; color: #000000; text-decoration: none; border-radius: 50px; font-weight: 600; transition: all 0.3s ease;">
                                                                Suscribirse
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal para cada plan -->
                                            @if(auth()->check())
                                                <div class="modal fade" id="planModal{{ $plan->id_plan }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="planModalLabel{{ $plan->id_plan }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="planModalLabel{{ $plan->id_plan }}" style="color: #FFCC00;">
                                                                    Suscripción a {{ $plan->nombre_plan }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true" style="color: #ffffff;">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('cliente.planes.contrato') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id_plan" value="{{ $plan->id_plan }}">
                                                                <div class="modal-body">
                                                                    <div class="form-group mb-3">
                                                                        <label for="tarjeta_pago" class="form-label">Número de Tarjeta</label>
                                                                        <input type="text" class="form-control" id="tarjeta_pago_{{ $plan->id_plan }}"
                                                                            name="tarjeta_pago" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group mb-3">
                                                                                <label for="fecha_expiracion" class="form-label">Fecha de
                                                                                    Expiración</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="fecha_expiracion_{{ $plan->id_plan }}" name="fecha_expiracion"
                                                                                    placeholder="MM/AA" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group mb-3">
                                                                                <label for="cvv" class="form-label">CVV</label>
                                                                                <input type="text" class="form-control" id="cvv_{{ $plan->id_plan }}"
                                                                                    name="cvv" placeholder="123" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="nombre_tarjeta" class="form-label">Nombre en la Tarjeta</label>
                                                                        <input type="text" class="form-control" id="nombre_tarjeta"
                                                                            name="nombre_tarjeta" placeholder="Nombre completo" required>
                                                                    </div>

                                                                    <div class="alert alert-info"
                                                                        style="background-color: #0073E6; color: white; margin-top: 15px;">
                                                                        <p class="mb-0"><i class="fas fa-info-circle mr-2"></i> Se te cobrará
                                                                            <strong>${{ number_format($plan->precio_plan, 2) }}</strong>
                                                                            @if ($plan->tipo_plan == 8)
                                                                                semanalmente
                                                                            @elseif ($plan->tipo_plan == 16)
                                                                                mensualmente
                                                                            @elseif ($plan->tipo_plan == 32)
                                                                                anualmente
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                                        style="background-color: #333333; border: none;">Cancelar</button>
                                                                    <button type="submit" class="btn"
                                                                        style="background-color: #FFCC00; color: #000000; font-weight: 600;">Confirmar
                                                                        Suscripción</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p>No hay planes disponibles en este momento</p>
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
            @if(session('error'))
                swalWithDarkStyle.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    background: '#222',
                    color: '#fff',
                    confirmButtonColor: '#0073E6'
                });
            @endif

            // Verificar si hay mensajes de éxito
            @if(session('success'))
                swalWithDarkStyle.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    background: '#222',
                    color: '#fff',
                    confirmButtonColor: '#FFCC00'
                });
            @endif

            // Verificar si hay mensajes de información
            @if(session('info'))
                swalWithDarkStyle.fire({
                    icon: 'info',
                    title: 'Información',
                    text: '{{ session('info') }}',
                    background: '#222',
                    color: '#fff',
                    confirmButtonColor: '#0073E6'
                });
            @endif

            @if(session('warning'))
                swalWithDarkStyle.fire({
                    icon: 'warning',
                    title: 'Advertencia',
                    text: '{{ session('warning') }}',
                    background: '#222',
                    color: '#fff',
                    confirmButtonColor: '#FFCC00'
                });
            @endif

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
                    if (i > 0 && i % 4 === 0) {
                        formattedValue += '-';
                    }
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
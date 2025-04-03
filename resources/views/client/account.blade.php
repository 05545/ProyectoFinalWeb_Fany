@extends('layouts.appClient')

@section('content')
    <main class="main" style="background-color: #000; color: #E1BEE7; min-height: 100vh; padding-bottom: 50px;">
        <!-- Alertas -->
        @if(session('success'))
            <div style="background-color: #4CAF50; color: white; padding: 15px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background-color: #F44336; color: white; padding: 15px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
                <ul style="list-style: none; padding: 0; margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Hero del Perfil -->
        <div class="profile-hero" style="padding: 60px 0; background: linear-gradient(135deg, rgba(106, 13, 173, 0.8) 0%, rgba(28, 28, 28, 0.9) 100%);">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="profile-avatar" style="
                            display: inline-block; 
                            width: 120px; 
                            height: 120px; 
                            border-radius: 50%; 
                            overflow: hidden; 
                            background-color: #1A1A1A; 
                            border: 3px solid #9C27B0;
                            margin-bottom: 20px;
                            position: relative;
                        ">
                            <img src="{{ $usuario->imagen_usuario ? asset('imagenes/usuarios/'.$usuario->imagen_usuario) : asset('imagenes/usuario.png') }}" 
                                 alt="Foto de perfil" 
                                 style="width: 100%; height: 100%; object-fit: cover;" 
                                 id="profileImage">

                            <div class="avatar-edit" 
                                 style="position: absolute; bottom: 0; right: 0; background-color: #9C27B0; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;"
                                 onclick="document.getElementById('photoInput').click()">
                                <i class="fas fa-camera" style="color: white;"></i>
                            </div>
                            <form id="profileImageForm" action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" id="photoInput" name="imagen_usuario" style="display: none;" accept="image/*"
                                    onchange="document.getElementById('profileImageForm').submit()">
                            </form>
                        </div>

                        <h1 style="color: #BA68C8; font-weight: 800; margin-bottom: 10px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                            Mi Perfil
                        </h1>
                        <h3 style="color: #E1BEE7; font-size: 1.5rem;">{{ $nombreCompleto }}</h3>
                        <p style="color: #CE93D8; font-style: italic;">Miembro desde: {{ $fechaRegistro }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido Principal -->
        <div class="container" style="margin-top: 40px;">
            <div class="row">
                <!-- Columna de Información Personal -->
                <div class="col-lg-12 mb-4">
                    <div class="info-card" style="
                        margin-bottom: 25px; 
                        padding: 25px; 
                        border-radius: 12px; 
                        background-color: #1A1A1A; 
                        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                        border-left: 4px solid #BA68C8;
                    ">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h2 style="color: #BA68C8; margin: 0;">Información Personal</h2>
                        </div>

                        <div id="personalInfoView">
                            <div class="info-item" style="margin-bottom: 15px;">
                                <p style="color: #CE93D8; margin-bottom: 5px;">Nombre completo:</p>
                                <p style="font-size: 1.1rem; color: #E1BEE7;">{{ $nombreCompleto }}</p>
                            </div>
                            <div class="info-item" style="margin-bottom: 15px;">
                                <p style="color: #CE93D8; margin-bottom: 5px;">Email:</p>
                                <p style="font-size: 1.1rem; color: #E1BEE7;">{{ $usuario->email_usuario }}</p>
                            </div>
                            <div class="info-item" style="margin-bottom: 15px;">
                                <p style="color: #CE93D8; margin-bottom: 5px;">Teléfono:</p>
                                <p style="font-size: 1.1rem; color: #E1BEE7;">{{ $usuario->telefono_usuario ?? 'No registrado' }}</p>
                            </div>
                            <div class="info-item" style="margin-bottom: 15px;">
                                <p style="color: #CE93D8; margin-bottom: 5px;">Sexo:</p>
                                <p style="font-size: 1.1rem; color: #E1BEE7;">{{ $usuario->sexo_usuario }}</p>
                            </div>
                        </div>
                        
                        <form id="personalInfoForm" action="#" method="POST">
                            @csrf
                            <div id="personalInfoEdit" style="display: none;">
                                <div style="margin-bottom: 15px;">
                                    <label style="color: #CE93D8; margin-bottom: 5px; display: block;">Nombre:</label>
                                    <input type="text" name="nombre_usuario" value="{{ $usuario->nombre_usuario }}" 
                                           style="width: 100%; padding: 10px; background-color: #222; color: #E1BEE7; border: 1px solid #444; border-radius: 5px;">
                                </div>
                                <div style="margin-bottom: 15px;">
                                    <label style="color: #CE93D8; margin-bottom: 5px; display: block;">Apellido Paterno:</label>
                                    <input type="text" name="ap_usuario" value="{{ $usuario->ap_usuario }}" 
                                           style="width: 100%; padding: 10px; background-color: #222; color: #E1BEE7; border: 1px solid #444; border-radius: 5px;">
                                </div>
                                <div style="margin-bottom: 15px;">
                                    <label style="color: #CE93D8; margin-bottom: 5px; display: block;">Apellido Materno:</label>
                                    <input type="text" name="am_usuario" value="{{ $usuario->am_usuario }}" 
                                           style="width: 100%; padding: 10px; background-color: #222; color: #E1BEE7; border: 1px solid #444; border-radius: 5px;">
                                </div>
                                <div style="margin-bottom: 15px;">
                                    <label style="color: #CE93D8; margin-bottom: 5px; display: block;">Email:</label>
                                    <input type="email" name="email_usuario" value="{{ $usuario->email_usuario }}" 
                                           style="width: 100%; padding: 10px; background-color: #222; color: #E1BEE7; border: 1px solid #444; border-radius: 5px;">
                                </div>
                                <div style="margin-bottom: 15px;">
                                    <label style="color: #CE93D8; margin-bottom: 5px; display: block;">Sexo:</label>
                                    <select name="sexo_usuario" style="width: 100%; padding: 10px; background-color: #222; color: #E1BEE7; border: 1px solid #444; border-radius: 5px;">
                                        <option value="Femenino" {{ $usuario->sexo_usuario == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Masculino" {{ $usuario->sexo_usuario == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Otro" {{ $usuario->sexo_usuario == 'Otro' ? 'selected' : '' }}>Otro</option>
                                        <option value="Prefiero no decirlo" {{ $usuario->sexo_usuario == 'Prefiero no decirlo' ? 'selected' : '' }}>Prefiero no decirlo</option>
                                    </select>
                                </div>
                                <div style="display: flex; gap: 10px; margin-top: 20px;">
                                    <button type="submit" class="btn-save" 
                                            style="flex: 1; padding: 10px; background-color: #9C27B0; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                        Guardar
                                    </button>
                                    <button type="button" class="btn-cancel" 
                                            style="flex: 1; padding: 10px; background-color: #444; color: white; border: none; border-radius: 5px; cursor: pointer;"
                                            onclick="toggleEditMode('personalInfo')">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal para cambiar contraseña -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #1A1A1A; color: #E1BEE7; border: 1px solid #9C27B0;">
                <div class="modal-header" style="border-bottom: 1px solid #333;">
                    <h5 class="modal-title" id="passwordModalLabel" style="color: #BA68C8;">Cambiar Contraseña</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="passwordForm" action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label" style="color: #CE93D8;">Contraseña Actual</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required 
                                   style="background-color: #222; color: #E1BEE7; border: 1px solid #444;">
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label" style="color: #CE93D8;">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required 
                                   style="background-color: #222; color: #E1BEE7; border: 1px solid #444;">
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label" style="color: #CE93D8;">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required 
                                   style="background-color: #222; color: #E1BEE7; border: 1px solid #444;">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn" style="background-color: #9C27B0; color: white;">Actualizar Contraseña</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleEditMode(section) {
            if (section === 'personalInfo') {
                const viewDiv = document.getElementById('personalInfoView');
                const editDiv = document.getElementById('personalInfoEdit');
                
                if (viewDiv.style.display === 'none') {
                    viewDiv.style.display = 'block';
                    editDiv.style.display = 'none';
                } else {
                    viewDiv.style.display = 'none';
                    editDiv.style.display = 'block';
                }
            }
        }
        
        function showPasswordModal() {
            const modal = new bootstrap.Modal(document.getElementById('passwordModal'));
            modal.show();
        }
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .btn-save:hover {
            background-color: #7B1FA2 !important;
        }
        
        .btn-cancel:hover {
            background-color: #555 !important;
        }
        
        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(156, 39, 176, 0.3);
        }
        
        .info-card, .rentals-card {
            transition: all 0.3s ease;
        }
        
        .info-card:hover, .rentals-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(156, 39, 176, 0.4) !important;
        }
        
        @media (max-width: 768px) {
            .profile-hero {
                padding: 40px 0 !important;
            }
            
            .stat-box {
                padding: 10px !important;
            }
            
            .stat-box h3 {
                font-size: 1.5rem !important;
            }
        }
    </style>
@endsection
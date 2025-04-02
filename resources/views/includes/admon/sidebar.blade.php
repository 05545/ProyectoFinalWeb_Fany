<aside class="main-sidebar" id="sidebar">
  <!-- Brand Logo -->
  <a href="index.html" class="brand-link">
    <img src="https://via.placeholder.com/40/d8c2ef/4a4a4a?text=A" alt="Logo" class="brand-image">
    <span class="brand-text">Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- User Panel -->
    <div class="user-panel">
      <div class="image">
        <img src="{{ asset('storage/' . Auth::user()->imagen_usuario) }}" alt="User Image">
      </div>
      <div class="info">
        <a href="#">{{Auth::user()->nombre_usuario}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-3">
      <ul class="nav nav-sidebar">
      <li class="nav-item">
        <a href="{{route('admin.tablero')}}" class="nav-link {{ request()->routeIs('admin.tablero') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Tablero</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.usuarios')}}" class="nav-link {{ request()->routeIs('admin.usuarios') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Usuarios</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.generos')}}" class="nav-link {{ request()->routeIs('admin.generos') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tags"></i>
        <p>Tipo de Géneros</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.planes')}}" class="nav-link {{ request()->routeIs('admin.planes') ? 'active' : '' }}">
        <i class="nav-icon fas fa-layer-group"></i>
        <p>Planes</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.streaming')}}" class="nav-link {{ request()->routeIs('admin.streaming') ? 'active' : '' }}">
        <i class="nav-icon fas fa-video"></i>
        <p>Streaming</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.perfil')}}" class="nav-link {{ request()->routeIs('admin.perfil') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Perfil</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('client.logout')}}" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Salir</p>
        </a>
      </li>
      </ul>
    </nav>
    
    
  </div>
</aside>

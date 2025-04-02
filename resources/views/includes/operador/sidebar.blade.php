<aside class="main-sidebar" id="sidebar">
    <!-- Brand Logo -->
    <a href="index.html" class="brand-link">
      <img src="https://via.placeholder.com/40/9d00ff/ffffff?text=P" alt="Logo" class="brand-image">
      <span class="brand-text">PURPLE ADMIN</span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- User Panel -->
      <div class="user-panel">
        <div class="image">
          <img src="https://via.placeholder.com/40/c17fff/ffffff?text=U" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('operador.Perfil')}}">Alexander Pierce</a>
        </div>
      </div>
  
      <!-- Sidebar Menu -->
      <nav class="mt-3">
        <ul class="nav nav-sidebar">
          <li class="nav-item">
        <a href="{{route('operador.home')}}" class="nav-link {{ request()->routeIs('operador.home') ? 'active' : '' }}">
          <i class="nav-icon fas fa-home"></i>
          <p>Tablero</p>
        </a>
          </li>
          <li class="nav-item">
        <a href="{{route('operador.client')}}" class="nav-link {{ request()->routeIs('operador.client') ? 'active' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>Clientes</p>
        </a>
          </li>
          <li class="nav-item">
        <a href="{{route('operador.pagos')}}" class="nav-link {{ request()->routeIs('operador.pagos') ? 'active' : '' }}">
          <i class="nav-icon fas fa-money-bill-wave"></i>
          <p>Pagos</p>
        </a>
          </li>
          <li class="nav-item">
        <a href="{{route('operador.Perfil')}}" class="nav-link {{ request()->routeIs('operador.Perfil') ? 'active' : '' }}">
          <i class="nav-icon fas fa-clipboard-list"></i>
          <p>Perfil</p>
        </a>
          </li>
          <li class="nav-item">
        <a href="{{route('client.logout')}}" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Cerrar</p>
        </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  
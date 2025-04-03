<!-- ***** Preloader Start ***** -->
<div id="js-preloader" class="js-preloader">
  <div class="preloader-inner">
    <span class="dot"></span>
    <div class="dots">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="main-nav">
          <!-- ***** Logo Start ***** -->
          <a href="index.html" class="logo"
            style="padding-top: 9px; font-size: 24px; font-weight: bold; color:rgb(19, 94, 255); text-transform: uppercase; text-decoration: none; font-family: Arial, sans-serif; letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); display: flex; align-items: center; height: 100%;">
            BlockBuster
          </a>


          <!-- ***** Logo End ***** -->
          <!-- ***** Menu Start ***** -->
          <ul class="nav">
            <li><a href="{{ route('client.home') }}">INICIO</a></li>
            <li><a href="{{ route('client.gender') }}">GENEROS</a></li>
            <li><a href="{{ route('client.planning') }}">PLANES</a></li>

            @if(Auth::check())
                    <li><a href="{{ route('client.streaming') }}">CONTENIDO</a></li>
                    <li><a href="{{ route('client.alquiler') }}">ALQUILERES</a></li>
                    <li><a href="{{ route('client.pagos') }}">PAGOS</a></li>
                    <li><a href="{{ route('client.perfil') }}">PERFIL</a></li>
                    <li>
                        <a href="{{ route('client.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            CERRAR SESIÓN
                        </a>
                        <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @elseif(Auth::check())
                    {{-- Opciones para usuarios autenticados pero que no son clientes --}}
                    <li><a href="#" class="{{ request()->routeIs('perfil') ? 'active' : '' }}">PERFIL</a></li>
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            CERRAR SESIÓN
                        </a>
                        <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                   <li><a href="{{ route('client.login') }}">Iniciar Sesión</a></li>
                @endif
          </ul>
          <a class='menu-trigger'>
            <span>Menu</span>
          </a>
          <!-- ***** Menu End ***** -->
        </nav>
      </div>
    </div>
  </div>
</header>
<!-- ***** Header Area End ***** -->
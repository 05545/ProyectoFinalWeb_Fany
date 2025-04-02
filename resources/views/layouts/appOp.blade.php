<!DOCTYPE html>
<html lang="es">
<head>
  @include('includes.operador.head')
</head>
<body class="hold-transition">
  <div class="wrapper">
    @include('includes.operador.preloader')
    @include('includes.operador.header')
    @include('includes.operador.sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper animated-bg">
      <!-- Content Header (breadcrumb, título, etc.) se puede incluir aquí si lo deseas -->
      @yield('content')
    </div>

    
  </div>

  @include('includes.operador.scripts')
</body>
</html>

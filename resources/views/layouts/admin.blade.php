<!DOCTYPE html>
<html lang="es">

<head>
  @include('includes.admon.head')
</head>

<body class="hold-transition">
  <div class="wrapper">
    @include('includes.admon.header')
    @include('includes.admon.sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      @yield('content')
    </div>

  </div>

  @include('includes.admon.scripts')
</body>

</html>
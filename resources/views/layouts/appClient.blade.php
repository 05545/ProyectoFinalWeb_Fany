<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="author" content="templatemo">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <title>BLockBuster | ProyectoWeb</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('resources/client/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('resources/client/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/client/css/templatemo-liberty-market.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/client/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/client/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    @yield('css')
</head>

<body>
    @include('includes.client.header')

    @yield('contents')

    @include('includes.client.footer')
    @yield('js')

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('resources/client/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('resources/client/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('resources/client/js/isotope.min.js') }}"></script>
    <script src="{{ asset('resources/client/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('resources/client/js/tabs.js') }}"></script>
    <script src="{{ asset('resources/client/js/popup.js') }}"></script>
    <script src="{{ asset('resources/client/js/custom.js') }}"></script>

</body>

</html>
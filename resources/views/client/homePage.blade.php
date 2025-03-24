@extends('layouts.appClient')    
@section('contents')
    <!-- ***** Área del Banner Principal ***** -->
    <div class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="header-text">
                        <h6>Blockbuster Streaming</h6>
                        <h2>Disfruta de las Mejores Películas y Series.</h2>
                        <p>Blockbuster Streaming te ofrece la mejor selección de películas y series para disfrutar donde y cuando quieras. Con nuestros diferentes planes, podrás encontrar la opción perfecta que se adapte a tus necesidades de entretenimiento. ¡Regístrate hoy y comienza a disfrutar!</p>
                        <div class="buttons">
                            <div class="border-button">
                                <a href="explore.html">Explorar Catálogo</a>
                            </div>
                            <div class="main-button">
                                <a href="planes.html">Ver Nuestros Planes</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="owl-banner owl-carousel">
                        <div class="item">
                            <img src="{{ asset('resources/client/img/banner-01.png') }}" alt="Cartelera de películas destacadas">
                        </div>
                        <div class="item">
                            <img src="{{ asset('resources/client/img/banner-02.png') }}" alt="Cartelera de series destacadas">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Área del Banner Principal End ***** -->

    <div class="categories-collections">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="categories">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <div class="line-dec"></div>
                                    <h2>Explora Nuestros <em>Géneros</em> Disponibles.</h2>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="{{ asset('resources/client/img/icon-01.png') }}" alt="Acción">
                                    </div>
                                    <h4>Acción</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="{{ asset('resources/client/img/icon-02.png') }}" alt="Comedia">
                                    </div>
                                    <h4>Comedia</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="{{ asset('resources/client/img/icon-03.png') }}" alt="Drama">
                                    </div>
                                    <h4>Drama</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="{{ asset('resources/client/img/icon-04.png') }}" alt="Animadas">
                                    </div>
                                    <h4>Animadas</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="{{ asset('resources/client/img/icon-05.png') }}" alt="Terror">
                                    </div>
                                    <h4>Terror</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="{{ asset('resources/client/img/icon-06.png') }}" alt="Documental">
                                    </div>
                                    <h4>Documental</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="collections">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <div class="line-dec"></div>
                                    <h2>Explora Nuestras <em>Colecciones</em> Destacadas.</h2>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="owl-collection owl-carousel">
                                    <div class="item">
                                        <img src="{{ asset('resources/client/img/collection-01.jpg') }}" alt="Colección de Acción">
                                        <div class="down-content">
                                            <h4>Clásicos de Ciencia Ficción</h4>
                                            <span class="collection">Títulos en la Colección:<br><strong>25 Películas</strong></span>
                                            <span class="category">Categoría:<br><strong>Ciencia Ficción</strong></span>
                                            <div class="main-button">
                                                <a href="explore.html">Explorar Colección</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="{{ asset('resources/client/img/collection-01.jpg') }}" alt="Colección de Terror">
                                        <div class="down-content">
                                            <h4>Maratón de Terror</h4>
                                            <span class="collection">Títulos en la Colección:<br><strong>18 Películas</strong></span>
                                            <span class="category">Categoría:<br><strong>Terror</strong></span>
                                            <div class="main-button">
                                                <a href="explore.html">Explorar Colección</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="{{asset('resources/client/img/collection-01.jpg')}}" alt="Colección de Series">
                                        <div class="down-content">
                                            <h4>Series Premiadas</h4>
                                            <span class="collection">Títulos en la Colección:<br><strong>12 Series</strong></span>
                                            <span class="category">Categoría:<br><strong>Drama</strong></span>
                                            <div class="main-button">
                                                <a href="explore.html">Explorar Colección</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="{{ asset('resources/client/img/collection-01.jpg') }}" alt="Colección de Comedias">
                                        <div class="down-content">
                                            <h4>Comedias Imperdibles</h4>
                                            <span class="collection">Títulos en la Colección:<br><strong>20 Películas</strong></span>
                                            <span class="category">Categoría:<br><strong>Comedia</strong></span>
                                            <div class="main-button">
                                                <a href="explore.html">Explorar Colección</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="create-nft">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Únete a Blockbuster Streaming en 3 Simples Pasos.</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-button">
                        <a href="registro.html">Regístrate Ahora</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="item first-item">
                        <div class="number">
                            <h6>1</h6>
                        </div>
                        <div class="icon">
                            <img src="{{ asset('resources/client/img/icon-02.png') }}" alt="Registro">
                        </div>
                        <h4>Regístrate y Elige tu Plan</h4>
                        <p>Crea tu cuenta en nuestra plataforma y selecciona el plan que mejor se adapte a tus necesidades y presupuesto. Contamos con diferentes opciones para todo tipo de usuarios.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="item second-item">
                        <div class="number">
                            <h6>2</h6>
                        </div>
                        <div class="icon">
                            <img src="{{ asset('resources/client/img/icon-04.png') }}" alt="Pago">
                        </div>
                        <h4>Realiza tu Pago</h4>
                        <p>Efectúa el pago de tu suscripción utilizando cualquiera de nuestros métodos de pago disponibles. El proceso es rápido, seguro y totalmente en línea.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="item">
                        <div class="icon">
                            <img src="{{ asset('resources/client/img/icon-06.png') }}" alt="Disfruta">
                        </div>
                        <h4>¡Comienza a Disfrutar!</h4>
                        <p>Una vez completado el registro y el pago, tendrás acceso inmediato a todo nuestro catálogo de películas y series. Podrás alquilar contenido según el límite de tu plan elegido.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="currently-market">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2><em>Contenido</em> Destacado del Momento.</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="filters">
                        <ul>
                            <li data-filter="*" class="active">Todo</li>
                            <li data-filter=".msc">Series</li>
                            <li data-filter=".dig">Películas</li>
                            <li data-filter=".blc">Nuevos Lanzamientos</li>
                            <li data-filter=".vtr">Más Vistos</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row grid">
                        <div class="col-lg-6 currently-market-item all msc">
                            <div class="item">
                                <div class="left-image">
                                    <img src="{{ asset('resources/client/img/market-01.jpg') }}" alt="Serie Popular"
                                        style="border-radius: 20px; min-width: 195px;">
                                </div>
                                <div class="right-content">
                                    <h4>Breaking Code</h4>
                                    <span class="author">
                                        <img src="{{ asset('resources/client/img/author.jpg') }}" alt="Director"
                                            style="max-width: 50px; border-radius: 50%;">
                                        <h6>Director<br><a href="#">@famosodirector</a></h6>
                                    </span>
                                    <div class="line-dec"></div>
                                    <span class="bid">
                                        Clasificación<br><strong>16+</strong><br><em>(Drama/Suspenso)</em>
                                    </span>
                                    <span class="ends">
                                        Temporadas<br><strong>5 Temporadas</strong><br><em>(60 Episodios)</em>
                                    </span>
                                    <div class="text-button">
                                        <a href="details.html">Ver Detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 currently-market-item all dig">
                            <div class="item">
                                <div class="left-image">
                                    <img src="{{ asset('resources/client/img/market-01.jpg') }}" alt="Película Popular"
                                        style="border-radius: 20px; min-width: 195px;">
                                </div>
                                <div class="right-content">
                                    <h4>El Último Horizonte</h4>
                                    <span class="author">
                                        <img src="{{ asset('resources/client/img/author.jpg') }}" alt="Director"
                                            style="max-width: 50px; border-radius: 50%;">
                                        <h6>Director<br><a href="#">@otrodirector</a></h6>
                                    </span>
                                    <div class="line-dec"></div>
                                    <span class="bid">
                                        Clasificación<br><strong>13+</strong><br><em>(Ciencia Ficción)</em>
                                    </span>
                                    <span class="ends">
                                        Duración<br><strong>2h 15min</strong><br><em>(2023)</em>
                                    </span>
                                    <div class="text-button">
                                        <a href="details.html">Ver Detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 currently-market-item all blc">
                            <div class="item">
                                <div class="left-image">
                                    <img src="{{ asset('resources/client/img/market-01.jpg') }}" alt="Nuevo Lanzamiento"
                                        style="border-radius: 20px; min-width: 195px;">
                                </div>
                                <div class="right-content">
                                    <h4>Mundos Paralelos</h4>
                                    <span class="author">
                                        <img src="{{ asset('resources/client/img/author.jpg') }}" alt="Director"
                                            style="max-width: 50px; border-radius: 50%;">
                                        <h6>Director<br><a href="#">@directorfamoso</a></h6>
                                    </span>
                                    <div class="line-dec"></div>
                                    <span class="bid">
                                        Clasificación<br><strong>16+</strong><br><em>(Aventura/Fantasía)</em>
                                    </span>
                                    <span class="ends">
                                        Duración<br><strong>2h 30min</strong><br><em>(2024)</em>
                                    </span>
                                    <div class="text-button">
                                        <a href="details.html">Ver Detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 currently-market-item all vtr">
                            <div class="item">
                                <div class="left-image">
                                    <img src="{{ asset('resources/client/img/market-01.jpg') }}" alt="Más Visto"
                                        style="border-radius: 20px; min-width: 195px;">
                                </div>
                                <div class="right-content">
                                    <h4>Héroes Sin Capa</h4>
                                    <span class="author">
                                        <img src="{{ asset('resources/client/img/author.jpg') }}" alt="Director"
                                            style="max-width: 50px; border-radius: 50%;">
                                        <h6>Director<br><a href="#">@granproductor</a></h6>
                                    </span>
                                    <div class="line-dec"></div>
                                    <span class="bid">
                                        Clasificación<br><strong>TP</strong><br><em>(Acción/Comedia)</em>
                                    </span>
                                    <span class="ends">
                                        Duración<br><strong>1h 58min</strong><br><em>(2023)</em>
                                    </span>
                                    <div class="text-button">
                                        <a href="details.html">Ver Detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 currently-market-item all vrt dig">
                            <div class="item">
                                <div class="left-image">
                                    <img src="{{ asset('resources/client/img/market-01.jpg') }}" alt="Película Popular"
                                        style="border-radius: 20px; min-width: 195px;">
                                </div>
                                <div class="right-content">
                                    <h4>Pesadillas Nocturnas</h4>
                                    <span class="author">
                                        <img src="{{ asset('resources/client/img/author.jpg') }}" alt="Director"
                                            style="max-width: 50px; border-radius: 50%;">
                                        <h6>Director<br><a href="#">@directorterror</a></h6>
                                    </span>
                                    <div class="line-dec"></div>
                                    <span class="bid">
                                        Clasificación<br><strong>18+</strong><br><em>(Terror/Suspenso)</em>
                                    </span>
                                    <span class="ends">
                                        Duración<br><strong>1h 45min</strong><br><em>(2023)</em>
                                    </span>
                                    <div class="text-button">
                                        <a href="details.html">Ver Detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 currently-market-item all msc blc">
                            <div class="item">
                                <div class="left-image">
                                    <img src="{{asset('resources/client/img/market-01.jpg')}}" alt="Serie Nueva"
                                        style="border-radius: 20px; min-width: 195px;">
                                </div>
                                <div class="right-content">
                                    <h4>Historias del Ayer</h4>
                                    <span class="author">
                                        <img src="assets/images/author.jpg" alt="Director"
                                            style="max-width: 50px; border-radius: 50%;">
                                        <h6>Director<br><a href="#">@directorseries</a></h6>
                                    </span>
                                    <div class="line-dec"></div>
                                    <span class="bid">
                                        Clasificación<br><strong>16+</strong><br><em>(Drama/Historia)</em>
                                    </span>
                                    <span class="ends">
                                        Temporadas<br><strong>2 Temporadas</strong><br><em>(16 Episodios)</em>
                                    </span>
                                    <div class="text-button">
                                        <a href="details.html">Ver Detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Planes -->
    <div class="create-nft">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Nuestros Planes de Suscripción</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-button">
                        <a href="planes.html">Ver Todos los Planes</a>
                    </div>
                </div>
                
                <!-- Plan Básico -->
                <div class="col-lg-4">
                    <div class="item first-item">
                        <div class="number">
                            <h6>Básico</h6>
                        </div>
                        <div class="icon">
                            <img src="{{ asset('resources/client/img/icon-02.png') }}" alt="Plan Básico">
                        </div>
                        <h4>$9.99 / mes</h4>
                        <p>Acceso a películas y series de nuestro catálogo con límite de 5 alquileres mensuales. Ideal para usuarios ocasionales.</p>
                        <div class="main-button">
                            <a href="registro.html">Elegir Plan</a>
                        </div>
                    </div>
                </div>
                
                <!-- Plan Estándar -->
                <div class="col-lg-4">
                    <div class="item second-item">
                        <div class="number">
                            <h6>Estándar</h6>
                        </div>
                        <div class="icon">
                            <img src="{{ asset('resources/client/img/icon-04.png') }}" alt="Plan Estándar">
                        </div>
                        <h4>$14.99 / mes</h4>
                        <p>Acceso a todo nuestro catálogo con límite de 10 alquileres mensuales. Perfecto para familias pequeñas o usuarios regulares.</p>
                        <div class="main-button">
                            <a href="registro.html">Elegir Plan</a>
                        </div>
                    </div>
                </div>
                
                <!-- Plan Premium -->
                <div class="col-lg-4">
                    <div class="item">
                        <div class="number">
                            <h6>Premium</h6>
                        </div>
                        <div class="icon">
                            <img src="{{ asset('resources/client/img/icon-06.png') }}" alt="Plan Premium">
                        </div>
                        <h4>$19.99 / mes</h4>
                        <p>Acceso ilimitado a nuestro catálogo completo, incluidos estrenos exclusivos. Sin límite de alquileres mensuales.</p>
                        <div class="main-button">
                            <a href="registro.html">Elegir Plan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
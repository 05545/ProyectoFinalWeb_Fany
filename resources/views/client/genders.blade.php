@extends('layouts.appClient')
@section('contents')
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
                                        <img src="{{ asset('resources/client/img/collection-01.jpg') }}"
                                            alt="Colección de Acción">
                                        <div class="down-content">
                                            <h4>Clásicos de Ciencia Ficción</h4>
                                            <span class="collection">Títulos en la Colección:<br><strong>25
                                                    Películas</strong></span>
                                            <span class="category">Categoría:<br><strong>Ciencia Ficción</strong></span>
                                            <div class="main-button">
                                                <a href="explore.html">Explorar Colección</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="{{ asset('resources/client/img/collection-01.jpg') }}"
                                            alt="Colección de Terror">
                                        <div class="down-content">
                                            <h4>Maratón de Terror</h4>
                                            <span class="collection">Títulos en la Colección:<br><strong>18
                                                    Películas</strong></span>
                                            <span class="category">Categoría:<br><strong>Terror</strong></span>
                                            <div class="main-button">
                                                <a href="explore.html">Explorar Colección</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="{{asset('resources/client/img/collection-01.jpg')}}"
                                            alt="Colección de Series">
                                        <div class="down-content">
                                            <h4>Series Premiadas</h4>
                                            <span class="collection">Títulos en la Colección:<br><strong>12
                                                    Series</strong></span>
                                            <span class="category">Categoría:<br><strong>Drama</strong></span>
                                            <div class="main-button">
                                                <a href="explore.html">Explorar Colección</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="{{ asset('resources/client/img/collection-01.jpg') }}"
                                            alt="Colección de Comedias">
                                        <div class="down-content">
                                            <h4>Comedias Imperdibles</h4>
                                            <span class="collection">Títulos en la Colección:<br><strong>20
                                                    Películas</strong></span>
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
@endsection
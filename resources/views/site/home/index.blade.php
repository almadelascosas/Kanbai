@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
<!-- END SERVICES -->
<section class="section-agents section-t8">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active desk">
                <img src="{{ asset('images/banners/bannerdesk.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item active banner-mobile">
                <img src="{{ asset('images/banners/banner-mobile.png') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container">
        <div class="row mt-5 mb-3 text-center">
            <h2 class="mt-5 mb-5 titles-home-categories tittle-home-cat">Categorías únicas</h2>
        </div>
        <div class="row">
            @foreach($categories as $item)
            <div class="col-md-2 col-4 categories-home text-center" onclick="location.href='/catalogo/{{$item->slug}}'">
                <div class="btn-categories">
                    <img class="image-subcategory-list-product" src="{{ asset('images/categories/'.$item->file.'') }}" alt="{{ $item->name }}">
                </div>
                {{ $item->name }}
            </div>
            @endforeach
        </div>
    </div>
    <div class="row mt-5" style="margin-right: initial;">
        <h2 class="mt-5 mb-5 titles-home">
            Empresas que <div class="d-block d-sm-block d-md-none"><br></div> <strong>confían en nosotros</strong>
        </h2>
        <div class="swiper mySwiperclientes ">
            <div class="swiper-wrapper">
                @foreach($imagesFactory as $img)
                <div class="swiper-slide empresas-slide">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <img src="{{ asset($img.'?'.rand()) }}" alt="{{ $img }}" class="img-d img-fluid">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="swiper mySwiperclientesmobile ">
            <div class="swiper-wrapper">              
                @foreach($imagesFactory as $img)
                <div class="swiper-slide empresas-slide">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <img src="{{ asset($img.'?'.rand()) }}" alt="{{ $img }}" class="img-d img-fluid">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <h2 class="mt-5 mb-5 titles-home title-nosotros"><strong>Por que nosotros?</strong></h2>
            <div class="row mt-5">
                <div class="col-md-3 mb-3 itemnosotros">
                    <div class="card-nosotros">
                        <img src="{{ asset('images/iconocheck.png') }}" alt="Razas" class="img-d img-nosotros">
                        Todo lo que necesita tu empresa en un solo lugar. Reunimos las mejores empresas de categorías no core todos verificados y con capacidad de cumplimiento.
                    </div>
                </div>
                <div class="col-md-3 mb-3 itemnosotros">
                    <div class="card-nosotros ">
                        <img src="{{ asset('images/iconocheck.png') }}" alt="Razas" class="img-d img-nosotros">
                        Ahórale dinero a tu empresa reduciendo los tiempos de investigación, vinculación y contratación.
                    </div>
                </div>
                <div class="col-md-3 mb-3 itemnosotros">
                    <div class="card-nosotros">
                        <img src="{{ asset('images/iconocheck.png') }}" alt="Razas" class="img-d img-nosotros">
                        Damos acompañamiento permanente a tus proyectos y los respaldamos con contratos de cumplimiento que aseguran el abastecimiento del bien.
                    </div>
                </div>
                <div class="col-md-3 mb-3 itemnosotros">
                    <div class="card-nosotros">
                        <img src="{{ asset('images/iconocheck.png') }}" alt="Razas" class="img-d img-nosotros">
                        La mejor relación costo beneficio. Monitoreamos el mercado para ofrecer lo mejor a los mejores precios.
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 news-products">
            <h2 class="mt-5 mb-5 titles-home title-new-products"><strong>Nuevos productos</strong></h4>
                <p class="text-center">Productos nuevos todas las semanas</p>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($newproducts as $item)
                        <div class="swiper-slide list-products-desk">
                            <a href="/catalogo/producto/{{$item->id}}/{{$item->name}}">
                                <div class="mb-3">
                                    <div class="card-body card-product-home">
                                        <div class="row">
                                            <div class="col-md-12 col-12 ">
                                                @if(count($item->gallery)>0)
                                                <img src="{{ asset('images/products/'.$item->gallery[0]->file.'') }}" alt="{{$item->name}}" class="img-d img-fluid image-list-home">
                                                @endif
                                                <div class="cont-tile-product-home">
                                                    <h4 class="title-product-home">{{$item->name}}<label>${{number_format($item->price_min, 0, 0, '.')}}</label></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
        </div>
    </div>
</section>
<!-- ======= Testimonials Section ======= -->
<section class="section-testimonials nav-arrow-a testimonials">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="mt-5 mb-5 titles-home title-nosotros"><b>¿Que dicen nuestros clientes?</b></h2>
            </div>
        </div>
        <div class="row mt-5">
            <div id="testimonial-carousel" class="swiper">
                <div class="swiper-wrapper">
                    <div class="carousel-item-a swiper-slide">
                        <div class="testimonials-box">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="testimonial-author-box">
                                        <center>
                                            <img src="{{ asset('assets/images/avatars/1.png') }}" alt="" class="testimonial-avatar">
                                        </center>
                                        <p class="testimonial-author">
                                            <span class="testimonial-name">Albertk & Erika</span>
                                            <span class="testimonial-star">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                            <br>
                                            <span class="testimonial-date">1 de Septiembre 2022</span>
                                        </p>
                                    </div>
                                    <div class="testimonials-content">
                                        <p class="testimonial-text">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, cupiditate ea nam praesentium
                                            debitis hic ber quibusdam
                                            voluptatibus officia expedita corpori.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End carousel item -->
                </div>
            </div>
        </div>
        <div class="testimonial-carousel-pagination carousel-pagination"></div>
    </div>
</section>
<!-- End Testimonials Section -->

<section class="section-testimonials nav-arrow-a testimonials">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">&nbsp;<hr>&nbsp;</div>
            <div class="col-sm-12 text-center">
                <h2 class="mt-5 mb-5 titles-home title-nosotros"><strong>Agendemos una reunión</strong></h2>
                <p>Tomemos un espacio para que conoscas como podemos ayudar a tu empresa</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 contenedor-agenda">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="circle-logo">
                            <img src="{{ asset('images/purple-calendar.png?'.rand()) }}" alt="{{ $img }}" class="img-agenda">
                        </div>
                    </div>
                    <div class="col-12 divinput">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nombre" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text icon-append" id=""><i class="bi bi-x-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-12 divinput">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Email" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text icon-append" id=""><i class="bi bi-x-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-12 divinput">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Telefono" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text icon-append" id=""><i class="bi bi-x-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-12 divinput">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Organizacion" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text icon-append" id=""><i class="bi bi-x-circle"></i></span>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="button" class="btn-suscribe">Suscribirse</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
$(document).ready(function() {

    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 30,
        loop: true,
        loopFillGroupWithBlank: true,


        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

    });

    var swiper = new Swiper(".mySwiperclientesmobile", {
        slidesPerView: 3,
        spaceBetween: 15,
        loop: true,
        loopFillGroupWithBlank: true,

        autoplay: {
            delay: 500,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

    });

    var swiper = new Swiper(".mySwiperclientes", {
        slidesPerView: 7,
        spaceBetween: 15,
        loop: true,
        loopFillGroupWithBlank: true,

        autoplay: {
            delay: 500,
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

    });




    var splide = new Splide('#main-slider', {
        pagination: false,
    });


    var thumbnails = document.getElementsByClassName('thumbnail');
    var current;


    for (var i = 0; i < thumbnails.length; i++) {
        initThumbnail(thumbnails[i], i);
    }


    function initThumbnail(thumbnail, index) {
        thumbnail.addEventListener('click', function() {
            splide.go(index);
        });
    }


    splide.on('mounted move', function() {
        var thumbnail = thumbnails[splide.index];


        if (thumbnail) {
            if (current) {
                current.classList.remove('is-active');
            }


            thumbnail.classList.add('is-active');
            current = thumbnail;
        }
    });


    splide.mount();
});

</script>
@endpush

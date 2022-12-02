@extends('layouts.app')
@section('title', 'Inicio')
@section('content')


    <!-- ======= product Section ======= -->
    <section class="section-agents section-t8 mt-5 product-desk">
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-6">
            <div class="row">
              <div class="col-2">
                <ul id="thumbnails" class="thumbnails">
                  @foreach($product->gallery as $item)
                  <li class="thumbnail">
                    <img src="{{ asset('images/products/thumbnail/list/'.$item->file.'') }}" />
                  </li>
                  @endforeach                 
                </ul>
              </div>
              <div class="col-10">
                <div id="main-slider" class="splide">
                  <div class="splide__track">
                    <ul class="splide__list">
                    @foreach($product->gallery as $item)
                      <li class="splide__slide">
                        <img src="{{ asset('images/products/thumbnail/'.$item->file.'') }}" />
                      </li>
                      @endforeach 
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            @if(count($product->questions)>0)
            <div class="col-md-12 mt-5">
            <h2 class="title-product-view mb-3 title-question">Preguntas Frecuentes</h2>
            <div class="accordion" id="accordionExample">
              @foreach($product->questions as $q)
              <div class="accordion-item item-acordeon">
                <h2 class="accordion-header" id="heading{{$q->id}}">
                  <button class="accordion-button title-question" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$q->id}}" aria-expanded="true" aria-controls="collapse{{$q->id}}">
                    {{$q->question}}
                  </button>
                </h2>
                <div id="collapse{{$q->id}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$q->id}}" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                  {{$q->answer}}
                  </div>
                </div>
              </div>
              @endforeach              
              
            </div>
          </div>
          @endif
          </div>
          <div class="col-md-6 content-info-product">
            <h2 class="title-product-view mb-3">{{$product->name}}</h2>
            {!! $product->description !!}
            <p class="price">
              <img src="{{ asset('images/Precio_Icono.png') }}" alt="Rango de precio" class="img-d img-fluid">
              Rango de precio: <span>${{number_format($product->price_min, 0, 0, '.')}} - ${{number_format($product->price_max, 0, 0, '.')}}</span> 
            </p>
            <p class="quantity">
              <img src="{{ asset('images/Cantidad_Icono.png') }}" alt="Pedido minímo" class="img-d img-fluid">
              Pedido minímo: <span>{{$product->quantity_min }} </span>
            </p>
            <div class="mt-4">
              <a href="/catalogo/cotizacion/porducto/{{$product->id}}"  class="btn btn-go-quotation btn-lg">Solicitar Cotización</a>
            </div>
          </div>

        </div>  
        
        <div class="row mt-5">          
          <h2 class="mt-5 mb-5 title-related">Productos relacionados</h4>  
          <div class="swiper mySwiper">  
            <div class="swiper-wrapper">
              @foreach($related as $item)
              <div class="swiper-slide list-products-desk">
                <a href="/catalogo/producto/{{$item->id}}/{{$item->name}}">
                  <div class="card mb-3 card-related" >
                    <div class="card-body padding-0">
                      <div class="row">
                        <div class="col-md-12 col-12 padding-0">
                        @if(count($item->gallery)>0)
                          <img src="{{ asset('images/products/'.$item->gallery[0]->file.'') }}" alt="{{$item->name}}" class="img-d img-fluid image-list image-products-related">
                        @endif
                        </div>
                        <div class="col-md-12 mt-3 info-related">
                          <h4 class="title-product-related">{{$item->name}}</h4>
                          <p class="vendido-po-desk">por {{$item->user->name}}</p>
                          <p class="price">
                            <img src="{{ asset('images/Precio_Icono.png') }}" alt="Rango de precio" class="img-d img-fluid">
                            Rango de precio: <span>${{number_format($item->price_min, 0, 0, '.')}} - ${{number_format($item->price_max, 0, 0, '.')}}</span> 
                          </p>
                          <p class="quantity">
                            <img src="{{ asset('images/Cantidad_Icono.png') }}" alt="Pedido minímo" class="img-d img-fluid">
                            Pedido minímo: <span>{{$item->quantity_min }} </span>
                          </p>
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
    </section><!-- End product Section -->

    <!-- ======= product Section ======= -->
    <section class="section-agents section-t8 mt-3 product-mobile">
      <div class="container">
        <div class="row ">
          <div class="col-md-12 ">
            <h2 class="title-product-view mb-3 mt-3">{{$product->name}}</h2>
          </div>
          <div class="col-md-12">

            <div id="galleryproduct" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
              @foreach($product->gallery as $key=>$item)
                <button type="button" data-bs-target="#galleryproduct" data-bs-slide-to="{{$key}}" class="@if($key==0) active @endif"  aria-label="Slide {{$key}}"></button>
              @endforeach             
              </div>
              <div class="carousel-inner">
                @foreach($product->gallery as $key=>$item)
                <div class="carousel-item @if($key==0) active @endif">
                  <img src="{{ asset('images/products/thumbnail/'.$item->file.'') }}" alt="{{$item->name}}" class="img-d img-fluid image-list" style="max-height: initial;">
                </div>
                @endforeach
              
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#galleryproduct" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#galleryproduct" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
              </button>
            </div>

          </div>
          <div class="col-md-12 mt-3">
            <p class="price">
              <img src="{{ asset('images/Precio_Icono.png') }}" alt="Rango de precio" class="img-d img-fluid">
              Rango de precio: <span>${{number_format($product->price_min, 0, 0, '.')}} - ${{number_format($product->price_max, 0, 0, '.')}}</span> 
            </p>
            <p class="quantity">
              <img src="{{ asset('images/Cantidad_Icono.png') }}" alt="Pedido minímo" class="img-d img-fluid">
              Pedido minímo: <span>{{$product->quantity_min }} </span>
            </p>
          </div>
          <div class="col-md-12 mt-3">
            <hr>
          </div>
          <div class="col-md-12 mt-3">
            <h2 class="title-product-view mb-3">Especificaciones</h2>
            {!! $product->description !!}
            <div class="mt-4">
              <a href="/catalogo/cotizacion/porducto/{{$product->id}}"  class="btn btn-go-quotation btn-lg">Solicitar Cotización</a>
            </div>
          </div>
          <div class="col-md-12 mt-3">
            <hr>
          </div>
          @if(count($product->questions)>0)
          <div class="col-md-12">
            <h2 class="title-product-view mb-3 title-question">Preguntas Frecuentes</h2>
            <div class="accordion" id="accordionExample">
              @foreach($product->questions as $q)
              <div class="accordion-item item-acordeon">
                <h2 class="accordion-header" id="heading{{$q->id}}">
                  <button class="accordion-button title-question" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$q->id}}" aria-expanded="true" aria-controls="collapse{{$q->id}}">
                    {{$q->question}}
                  </button>
                </h2>
                <div id="collapse{{$q->id}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$q->id}}" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                  {{$q->answer}}
                  </div>
                </div>
              </div>
              @endforeach              
              
            </div>
          </div>
          @endif

        </div>  
        
      

      </div>

      <div class="container">
        <div class="row mt-5">          
          <h2 class="mt-5 mb-5 titles-home title-nosotros"><strong>Por que nosotros?</strong></h4> 
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

    </section><!-- End product Section -->

 

@endsection

@push('scripts')

<script>

  
$(document).ready(function() {


  var myCarousel = document.querySelector('#galleryproduct')
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 2000,
  wrap: false
})


  var swiper = new Swiper(".mySwiper", {        
        slidesPerView: 4,        
        spaceBetween: 15,        
        loop: true,
        loopFillGroupWithBlank: true,   
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
   
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
   
      });


  var splide = new Splide( '#main-slider', {
  pagination: false,
} );


var thumbnails = document.getElementsByClassName( 'thumbnail' );
var current;


for ( var i = 0; i < thumbnails.length; i++ ) {
  initThumbnail( thumbnails[ i ], i );
}


function initThumbnail( thumbnail, index ) {
  thumbnail.addEventListener( 'click', function () {
    splide.go( index );
  } );
}


splide.on( 'mounted move', function () {
  var thumbnail = thumbnails[ splide.index ];


  if ( thumbnail ) {
    if ( current ) {
      current.classList.remove( 'is-active' );
    }


    thumbnail.classList.add( 'is-active' );
    current = thumbnail;
  }
} );


splide.mount();
});
    </script>
@endpush

          





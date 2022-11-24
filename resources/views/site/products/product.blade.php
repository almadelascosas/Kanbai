@extends('layouts.app')
@section('title', 'Inicio')
@section('content')


    <!-- ======= product Section ======= -->
    <section class="section-agents section-t8 mt-5">
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
          </div>
          <div class="col-md-6">
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
                  <div class="card mb-3" >
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-12">
                        @if(count($item->gallery)>0)
                          <img src="{{ asset('images/products/'.$item->gallery[0]->file.'') }}" alt="{{$item->name}}" class="img-d img-fluid image-list">
                        @endif
                        </div>
                        <h4 class="title-product-desk">{{$item->name}}</h4>
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

 

@endsection

@push('scripts')

<script>

  
$(document).ready(function() {

  var swiper = new Swiper(".mySwiper", {        
        slidesPerView: 4,        
        spaceBetween: 30,        
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

          





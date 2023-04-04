@extends('layouts.appwhitoutheader')
@section('title', 'Cotización')
@section('content')
<!-- ======= product Section ======= -->
<section class="section-agents section-t3 quotation">
    <div class="container">
        <div class="row no-gutters justify-content-center">
            <form class="form" role="form" action="javascript:void(0)" enctype="multipart/form-data" id="main-form" autocomplete="off">
                <input type="hidden" id="_url" value="{{ url('cotizacion') }}">
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="row mb-3 back-info-quotation">
                    <div class="col-4">
                        <img style="max-height: 244px;" class="image-quotation" src="{{ asset('images/products/'.$product->gallery[0]->file.'') }}" />
                    </div>
                    <div class="col-8">
                        <h2 class="title-product-quotation title-quotation-mobile">{{$product->name}}</h2>
                        <p class="price-quotation-mobile">
                            <img src="{{ asset('images/Precio_Icono.png') }}" alt="Rango" class="img-d img-fluid image-quotation-mobile">
                            Rango: <span>${{number_format($product->price_min, 0, 0, '.')}} - ${{number_format($product->price_max, 0, 0, '.')}}</span>
                        </p>
                        <p class="price-quotation-mobile">
                            <img src="{{ asset('images/Cantidad_Icono.png') }}" alt="Pedido minímo" class="img-d img-fluid image-quotation-mobile">
                            Pedido minímo: <span>{{$product->quantity_min }} </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-2 col-logo logo-quotation">
                    <a class="logo-desck" href="/">
                        <img class="logo" src="{{ asset('images/logo/logo-kanbai-color.png').'?'.rand() }}" />
                        <!--Marce<span class="color-b">Pets</span>-->
                    </a>                    
                </div>
                
                <ul class="nav nav-tabs justify-content-center" id="cotizacion" role="tablist">
                    @if(!Auth::user())
                    <li class="nav-item" role="presentation" style="display:none">
                        <button class="nav-link active" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="true">Tus Datos</button>
                    </li>
                    @endif
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Tus Datos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Condiciones</button>
                    </li>
                </ul>
                <div class="tab-content" id="cotizacionContent">
                    @if(!Auth::user())
                    <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="register-tab">
                        
                    <div class="row mt-5">
                            <div class="col-md-7">
                                
                                <div class="row conten-form">
                                    <div class="row ">
                                        <div class="col-6"><h2 class="title-25">Registrarse</h2></div>
                                        <div class="col-6"><a  class="btn btn-link text-gray btn-link-register" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">¿Ya tienes una cuenta? <strong>Ingresa</strong></a></div>
                                    </div>  
                                    

                                   

                                    <div class="col-md-12 col-12">
                                        <input type="hidden" id="_url_validate" value="{{ route('validaremail') }}">
                                        <div class="mb-3 mb-3 mt-1rem">
                                            <label for="email-user" class="form-label">{{ __('E-Mail Address') }}</label>
                                            <input type="email" class="form-control input-cotizacion" id="email-user" name="email_user" >
                                            <span class="missing_alert text-danger" id="email-user_alert"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="input-group mb-3"> 
                                            <label for="password" class="form-label" style="display: block;width: 100%;">Contraseña *</label>                              
                                            <input class="form-control password input-login @error('password') is-invalid @enderror" id="password"  type="password" name="password" />
                                            <span class="input-group-text togglePassword eye-login" id="">
                                                <i class="fa fa-eye" aria-hidden="true" style="cursor: pointer"></i>
                                            </span>
                                            <span class="missing_alert text-danger" id="password_alert"></span>

                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="input-group mb-3">
                                            <label for="password-confirm" class="form-label" style="display: block;width: 100%;">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control password-confirm input-login" name="password_confirmation"  autocomplete="new-password"> 
                                            <span class="input-group-text togglePassword-confirm eye-login" id="">
                                                <i class="fa fa-eye" aria-hidden="true" style="cursor: pointer"></i>
                                            </span> 
                                            <span class="missing_alert text-danger" id="password-confirm_alert"></span>                          
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3">
                                            <label for="name-user" class="form-label">Tu nombre completo</label>                            
                                            <input id="name-user" type="text" class="form-control input-cotizacion @error('name-user') is-invalid @enderror" name="name_user" value="{{ old('name-user') }}"  autocomplete="name-user" autofocus>
                                            <span class="missing_alert text-danger" id="name-user_alert"></span>                         
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3">
                                            <label for="name_business" class="form-label">Nombre de tu empresa</label>                            
                                            <input id="name_business" type="text" class="form-control input-cotizacion @error('name_business') is-invalid @enderror" name="name_business" value="{{ old('name_business') }}"  autocomplete="name_business" autofocus>
                                            <span class="missing_alert text-danger" id="name_business_alert"></span>                              
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3">
                                            <label for="phone"  class="form-label label-display-block">Número de celular</label>                            
                                            <input  type="text" id="phone" class="form-control input-cotizacion @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone" autofocus>
                                            <span class="missing_alert text-danger" id="phone_alert"></span>                         
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 mb-5">
                                        <a class="btn waves-effect waves-float waves-light ajax btn-go-quotation btn-lg" id="next-datos">Continuar al siguiente paso</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 info-desk" style="padding-left: 45px;">
                                <img style="max-height: 244px;" class="image-quotation" src="{{ asset('images/products/'.$product->gallery[0]->file.'') }}" />
                                <h2 class="title-product-quotation mb-4 mt-3">{{$product->name}}</h2>
                                <p class="price-quotation">
                                    <img src="{{ asset('images/Precio_Icono.png') }}" alt="Rango" class="img-d img-fluid">
                                    Rango: <span>${{number_format($product->price_min, 0, 0, '.')}} - ${{number_format($product->price_max, 0, 0, '.')}}</span>
                                </p>
                                <p class="quantity-quotation">
                                    <img src="{{ asset('images/Cantidad_Icono.png') }}" alt="Pedido minímo" class="img-d img-fluid">
                                    Pedido minímo: <span>{{$product->quantity_min }} </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="tab-pane fade show @if(Auth::user()) active @endif" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row mt-5">
                            <div class="col-md-7">
                                <div class="row conten-form">
                                    <h4 class="title-form-cotizacion mt-5 mb-5">Completa los pasos para recibir la propuesta comercial</h4>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3 mb-3 mt-1rem">
                                            <label class="form-label" for="name">Tu nombre o nombre de la empresa</label>
                                            <input type="text" class="form-control input-cotizacion" id="name" name="name" value="@if(Auth::user()){{Auth::user()->displayname}}@endif">
                                            <span class="missing_alert text-danger" id="name_alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3 mb-3 mt-1rem">
                                            <label class="form-label" for="email">Tu correo electrónico</label>
                                            <input type="email" class="form-control input-cotizacion" id="email" name="email" value="@if(Auth::user()){{Auth::user()->email}}@endif">
                                            <span class="missing_alert text-danger" id="email_alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3 mb-3 mt-1rem">
                                            <label class="form-label " for="cellphone">Número celular</label>
                                            <input type="text" class="form-control input-cotizacion" id="cellphone" name="cellphone" value="@if(Auth::user()){{Auth::user()->phone}}@endif">
                                            <span class="missing_alert text-danger" id="cellphone_alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 mb-5">
                                        <a class="btn waves-effect waves-float waves-light ajax btn-go-quotation btn-lg" id="next">Continuar al siguiente paso</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 info-desk" style="padding-left: 45px;">
                                <img style="max-height: 244px;" class="image-quotation" src="{{ asset('images/products/'.$product->gallery[0]->file.'') }}" />
                                <h2 class="title-product-quotation mb-4 mt-3">{{$product->name}}</h2>
                                <p class="price-quotation">
                                    <img src="{{ asset('images/Precio_Icono.png') }}" alt="Rango" class="img-d img-fluid">
                                    Rango: <span>${{number_format($product->price_min, 0, 0, '.')}} - ${{number_format($product->price_max, 0, 0, '.')}}</span>
                                </p>
                                <p class="quantity-quotation">
                                    <img src="{{ asset('images/Cantidad_Icono.png') }}" alt="Pedido minímo" class="img-d img-fluid">
                                    Pedido minímo: <span>{{$product->quantity_min }} </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row mt-5">
                            <div class="col-md-7">
                                <div class="row conten-form">
                                    <h4 class="title-form-cotizacion mt-5 mb-5">Completa los pasos para recibir la propuesta comercial</h4>
                                    <div class="col-md-6 col-6">
                                        <div class="mb-3 mt-1rem">
                                            <label class="form-label" for="quantity">Cantidad</label>
                                            <input type="number" class="form-control input-cotizacion" id="quantity" name="quantity">
                                            <span class="missing_alert text-danger" id="quantity_alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="mb-3 mb-3 mt-1rem">
                                            <label class="form-label" for="date_delivery">Fecha de entrega</label>
                                            <input type="date" class="form-control input-cotizacion" id="date_delivery" name="date_delivery">
                                            <span class="missing_alert text-danger" id="date_delivery_alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3 mb-3 mt-1rem">
                                            <label class="form-label" for="address">Ubicación de entrega</label>
                                            <input type="text" class="form-control input-cotizacion" id="address" name="address">
                                            <span class="missing_alert text-danger" id="address_alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3 mb-3 mt-1rem">
                                            <label class="form-label" for="observations">Observaciones a tener en cuenta</label>
                                            <textarea class="form-control input-cotizacion" id="observations" name="observations"></textarea>
                                            <span class="missing_alert text-danger" id="observations_alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 mb-5">
                                        <button class="btn waves-effect waves-float waves-light ajax btn-go-quotation btn-lg" id="next">Listo! Solicitar Cotización</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 info-desk" style="padding-left: 45px;">
                                <img style="max-height: 244px;" class="image-quotation" src="{{ asset('images/products/'.$product->gallery[0]->file.'') }}" />
                                <h2 class="title-product-quotation mb-4 mt-3">{{$product->name}}</h2>
                                <p class="price-quotation">
                                    <img src="{{ asset('images/Precio_Icono.png') }}" alt="Rango" class="img-d img-fluid">
                                    Rango: <span>${{number_format($product->price_min, 0, 0, '.')}} - ${{number_format($product->price_max, 0, 0, '.')}}</span>
                                </p>
                                <p class="quantity-quotation">
                                    <img src="{{ asset('images/Cantidad_Icono.png') }}" alt="Pedido minímo" class="img-d img-fluid">
                                    Pedido minímo: <span>{{$product->quantity_min }} </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('site.modales.login')
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

</section><!-- End product Section -->
@endsection
@push('scripts')
<script src="{{ asset('js/app/quotation/create.js').'?'.rand() }}"></script>
<script>


   var input = document.querySelector("#phone");
    window.intlTelInput(input, {
    initialCountry: "auto",
    geoIpLookup: function(callback) {
        $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
        var countryCode = (resp && resp.country) ? resp.country : "co";
        callback(countryCode);
        });
    },
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // just for formatting/placeholders etc
    });

    feather.replace({ 'aria-hidden': 'true' });

$(".togglePassword").click(function (e) {
      e.preventDefault();
      var type = $(this).parent().parent().find(".password").attr("type");
      if(type == "password"){
          $("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
          $(this).parent().parent().find(".password").attr("type","text");
      }else if(type == "text"){
          $("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
          $(this).parent().parent().find(".password").attr("type","password");
      }
  });

  $(".togglePassword-confirm").click(function (e) {
      e.preventDefault();
      var type = $(this).parent().parent().find(".password-confirm").attr("type");
      if(type == "password"){
          $("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
          $(this).parent().parent().find(".password-confirm").attr("type","text");
      }else if(type == "text"){
          $("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
          $(this).parent().parent().find(".password-confirm").attr("type","password");
      }
  });
    </script>
@endpush

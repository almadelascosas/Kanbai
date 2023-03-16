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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Tus Datos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Condiciones</button>
                    </li>
                </ul>
                <div class="tab-content" id="cotizacionContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row mt-5">
                            <div class="col-md-7">
                                <div class="row conten-form">
                                    <h4 class="title-form-cotizacion mt-5 mb-5">Completa los pasos para recibir la propuesta comercial</h4>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3 mb-3 mt-1rem">
                                            <label class="form-label" for="name">Tu nombre o nombre de la empresa</label>
                                            <input type="text" class="form-control input-cotizacion" id="name" name="name" value="{{Auth::user()->displayname}}">
                                            <span class="missing_alert text-danger" id="name_alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3 mb-3 mt-1rem">
                                            <label class="form-label" for="email">Tu correo electrónico</label>
                                            <input type="email" class="form-control input-cotizacion" id="email" name="email" value="{{Auth::user()->email}}">
                                            <span class="missing_alert text-danger" id="email_alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="mb-3 mb-3 mt-1rem">
                                            <label class="form-label " for="cellphone">Número celular</label>
                                            <input type="text" class="form-control input-cotizacion" id="cellphone" name="cellphone" value="{{Auth::user()->phone}}">
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
</section><!-- End product Section -->
@endsection
@push('scripts')
<script src="{{ asset('js/app/quotation/create.js').'?'.rand() }}"></script>
<script>
$("#next").click(function() {

    if ($('#main-form #name').val() === '') {
        $('#main-form #name_alert').text('Ingrese tu nombre o nombre de la empresa').show();
        $('#main-form #name').focus();
        return false;
    }

    if ($('#main-form #email').val() === '') {
        $('#main-form #email_alert').text('Ingrese tu correo electrónico').show();
        $('#main-form #email').focus();
        return false;
    }
    if (!$('#main-form #email').val().match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/)) {
        $('#main-form #email_alert').text('Ingrese correo electrónico válido').show();
        $('#main-form #email').focus();
        return false;
    }


    if ($('#main-form #cellphone').val() === '') {
        $('#main-form #cellphone_alert').text('Ingrese número celular').show();
        $('#main-form #cellphone').focus();
        return false;
    }
    $('#profile-tab').click();


});

</script>
@endpush

@extends('layouts.app')
@section('title', 'Cotización')
@section('content')


    <!-- ======= product Section ======= -->
    <section class="section-agents section-t8 mt-5">
      <div class="container">
        <div class="row no-gutters justify-content-center">     
          <div class="col-sm-8 col-lg-8 col-xxl-8 align-self-center order-2 order-sm-1">
            <div class="row">
              <div class="col-md-4"> 
                  <img class="image-quotation" src="{{ asset('images/products/'.$product->gallery[0]->file.'') }}" /> 
              </div>
              <div class="col-md-8">
                <h2 class="title-product-quotation mb-4">{{$product->name}}</h2>
                <p class="price-quotation">
                  <img src="{{ asset('images/Precio_Icono.png') }}" alt="Rango de precio" class="img-d img-fluid">
                  Rango de precio: <span>${{number_format($product->price_min, 0, 0, '.')}} - ${{number_format($product->price_max, 0, 0, '.')}}</span> 
                </p>
                <p class="quantity-quotation">
                  <img src="{{ asset('images/Cantidad_Icono.png') }}" alt="Pedido minímo" class="img-d img-fluid">
                  Pedido minímo: <span>{{$product->quantity_min }} </span>
                </p>
              </div>

            </div>
          </div>
        </div>

        <!--Formulario-->
        <div class="row no-gutters justify-content-center mt-5">     
          <div class="col-sm-8 col-lg-8 col-xxl-8 align-self-center order-2 order-sm-1 panel-form-quotation">
            <h4 class="mt-4 mb-4">Completa la siguiente información para recibir propuesta comercial</h4>
            <form class="form" role="form" action="javascript:void(0)" enctype="multipart/form-data" id="main-form" autocomplete="off">
              <input type="hidden" id="_url" value="{{ url('cotizacion') }}">
              <input type="hidden" id="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="email">Tu correo electrónico</label>
                      <input type="email" class="form-control" id="email" name="email">
                      <span class="missing_alert text-danger" id="email_alert"></span>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="name">Tu nombre o nombre de la empresa</label>
                      <input type="text" class="form-control" id="name" name="name">
                      <span class="missing_alert text-danger" id="name_alert"></span>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="cellphone">Número celular</label>
                      <input type="text" class="form-control" id="cellphone" name="cellphone">
                      <span class="missing_alert text-danger" id="cellphone_alert"></span>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="quantity">Cantidad</label>
                      <input type="number" class="form-control" id="quantity" name="quantity">
                      <span class="missing_alert text-danger" id="quantity_alert"></span>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="address">Ubicación de entrega</label>
                      <input type="text" class="form-control" id="address" name="address">
                      <span class="missing_alert text-danger" id="address_alert"></span>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="date_delivery">Fecha de entrega</label>
                      <input type="date" class="form-control" id="date_delivery" name="date_delivery">
                      <span class="missing_alert text-danger" id="date_delivery_alert"></span>
                    </div>
                  </div>
                  <div class="col-md-12 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="observations">Observaciones a tener en cuenta</label>
                      <textarea  class="form-control" id="observations" name="observations"></textarea>
                      <span class="missing_alert text-danger" id="observations_alert"></span>
                    </div>
                  </div>
                  <div class="col-12 mt-3 mb-5">
                      <button type="submit" class="btn waves-effect waves-float waves-light ajax btn-go-quotation btn-lg" id="submit"><i id="ajax-icon" class="fa fa-save"></i> Solicitar cotización</button>
                  </div>
                </div>
              </form>
          </div>
        </div>


       
      

      </div>  
        
        
  </div>
</section><!-- End product Section -->

 

@endsection

@push('scripts')
  <script src="{{ asset('js/app/quotation/create.js') }}"></script>     
@endpush
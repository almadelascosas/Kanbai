@extends('layouts.admin')

@section('title', 'Cotizaciones')
@section('page_title', 'Editar Cotizacion')
@section('page_subtitle', 'Editar')
@section('content')


<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Editar: #{{ $quotation->id }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/home">Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/quotes">Cotizaciones &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Editar: #{{ $quotation->id }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <ul class="list-group-horizontal">
    @foreach($quotation->history as $item)
    <li class="list-group-item arrowRight">
    @if($item->state==0)En Espera @endif
    @if($item->state==1)Aprobado  @endif
    @if($item->state==2)Cancelado @endif
    </li>
    @endforeach
    
    </ul>
</div>
<div class="content-body">
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header header-solicitud">
                        <div class="col-md-5">
                            <h4 class="card-title title-solicitud">Número de solicitud: {{ $quotation->id }}</h4>
                        </div>
                        <div class="col-md-7">
                            <!-- Button trigger modal -->
                            @if($quotation->state!=1)
                            <button type="button" class="btn btn-admin-succes-quotation" data-bs-toggle="modal" data-bs-target="#aprovarsolicitud">
                                Aprobar solicitud
                            </button>
                            @endif
                            @if($quotation->state!=2)
                            <button type="button" class="btn btn-admin-danger-quotation" data-bs-toggle="modal" data-bs-target="#cancelarsolicitud">
                                Rechazar solicitud
                            </button>
                            @endif

                            <!-- Modal -->
                            <div class="modal fade" id="aprovarsolicitud" tabindex="-1" aria-labelledby="aprovarsolicitudLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="aprovarsolicitudLabel">Aprobar Solicitud</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @include('admin.quotations.partials.aporbarsolicitud',['quotation'=>$quotation])
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="cancelarsolicitud" tabindex="-1" aria-labelledby="cancelarsolicitudLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cancelarsolicitudLabel">Rechazar Solicitud</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @include('admin.quotations.partials.rechazarsolicitud',['quotation'=>$quotation])
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
</div>
                    <div class="card-body">
                        <div class="row mt-4 mb-4 info-product-solicitud">
                            <div class="col-md-2">
                                @if(count($quotation->producto->gallery)>0)
                                <img  class="image-solicitud" src="{{ asset('images/products/thumbnail/list/'.$quotation->producto->gallery[0]->file.'') }}">
                                @endif
                            </div>
                            <div class="col-md-5">
                                <h4 class="titleproduct-solicitud mt-2">{{$quotation->producto->name}}</h4> 
                                <p class="price-solicitud mt-2">                                   
                                    Rango de precio: <span>${{number_format($quotation->producto->price_min, 0, 0, '.')}} - ${{number_format($quotation->producto->price_max, 0, 0, '.')}}</span> 
                                    </p>
                                <p class="price-solicitud mt-2">                                   
                                    Pedido minímo: <span>{{$quotation->producto->quantity_min }} </span>
                                </p> 
                            </div>
                            <div class="col-md-5">
                                {!!$quotation->producto->description !!}
                            </div>
                        
                        </div>
                        <form class="form" role="form" id="main-form" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" id="_url" value="{{ url('quotes',[$quotation->encode_id]) }}">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="product_id" value="{{ $quotation->product_id }}">

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="col-md-12 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name">Nombre</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$quotation->name}}" readonly>
                                            <span class="missing_alert text-danger" id="name_alert"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="email">Correo Electronico</label>
                                                <input type="text" class="form-control" id="email" name="email" value="{{$quotation->email}}" readonly>
                                                <span class="missing_alert text-danger" id="email_alert"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="cellphone">Número celular</label>
                                                <input type="text" class="form-control" id="cellphone" name="cellphone" value="{{$quotation->cellphone}}" readonly>
                                                <span class="missing_alert text-danger" id="cellphone_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="quantity">Cantidad</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity"  value="{{$quotation->quantity}}" readonly>
                                                <span class="missing_alert text-danger" id="quantity_alert"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="address">Ubicación de entrega</label>
                                                <input type="text" class="form-control" id="address" name="address"  value="{{$quotation->address}}" readonly>
                                                <span class="missing_alert text-danger" id="address_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="date_delivery">Fecha de entrega</label>
                                                <input type="date" class="form-control" id="date_delivery" name="date_delivery"  value="{{$quotation->date_delivery}}" readonly>
                                                <span class="missing_alert text-danger" id="date_delivery_alert"></span>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 col-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="producto">Producto</label>
                                                <input type="text" class="form-control" id="producto" name="producto"  value="{{$quotation->producto->name}}" readonly>
                                                <span class="missing_alert text-danger" id="producto_alert"></span>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">                                        
                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="observations">Observaciones a tener en cuenta</label>
                                                <textarea  name="observations" class="form-control" id="observations" rows="10" cols="80" readonly>{!! $quotation->observations  !!}</textarea>
                                                <span class="missing_alert text-danger" id="observations_alert"></span>
                                            </div>
                                        </div> 
                                    </div>  
                                    
                                    <div class="row">                                        
                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="state">Estado</label>
                                                <select  id="state" name="state" class="form-control">
                                                    <option value="0" {{ ($quotation->state==0) ? "selected" : "" }}>Sin gestionar</option>
                                                    <option value="1" {{ ($quotation->state==1) ? "selected" : "" }}>Gestionado</option>
                                                    <option value="2" {{ ($quotation->state==2) ? "selected" : "" }}>Cancelado</option>
                                                    
                                                </select>
                                                <span class="missing_alert text-danger" id="state_alert"></span>
                                            </div>
                                        </div> 
                                    </div> 
                                  

                                </div>
                             

                             


                                <!--<div class="col-12">
                                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light ajax" id="submit"><i id="ajax-icon" class="fa fa-save"></i> Guardar</button>
                                </div>-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
@push('scripts')

<script src="{{ asset('js/admin/quotations/edit.js') }}"></script>

@endpush

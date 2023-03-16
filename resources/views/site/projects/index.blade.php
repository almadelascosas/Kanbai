@extends('layouts.app')
@section('title', 'Registro')
@section('content')

@section('content')
<section class="section-agents section-t8 mt-5 product-desk">
    <div class="container">
        <div class="row mt-5">

        <div class="d-flex align-items-start mt-5">
            
            <div class="nav flex-column nav-pills me-3 wth-30" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <div class="row">
                    <div class="col-4 icon-profile">
                        <label class="content-icon-profile"><i class="bi bi-person"></i></label>
                    </div>
                    <div class="col-8">
                        <h4 class="mb-0">Hola, {{ Auth::user()->name}} </h4>
                    </div>
                
                </div>
                <hr>
                
                <button class="nav-link menu-user" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-square squere-menu-user" aria-hidden="true"></i> Mi Información <i class="fa fa-chevron-right float-right icon-net-menu-user" aria-hidden="true"></i></button>
                <button class="nav-link menu-user" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-square squere-menu-user" aria-hidden="true"></i> Mis Proyectos <i class="fa fa-chevron-right float-right icon-net-menu-user" aria-hidden="true"></i></button>
                <button class="nav-link menu-user" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-square squere-menu-user" aria-hidden="true"></i> Balance Financielo <i class="fa fa-chevron-right float-right icon-net-menu-user" aria-hidden="true"></i></button>
                <button class="nav-link menu-user" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-square squere-menu-user" aria-hidden="true"></i> Cerrar Sesión <i class="fa fa-chevron-right float-right icon-net-menu-user" aria-hidden="true"></i></button>
            </div>
            <div class="tab-content wth-70 back-tap" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-prject" role="tabpanel" aria-labelledby="v-pills-prject-tab">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="info-project">
                                <h4 class="card-title mb-4">Información general:</h4>
                                <table>
                                    <tr>
                                        <td><strong>Orden # {{ $project->id }}</strong></td>
                                        <td>
                                            @if($project->state==0) <span class="badge  text-white bg-warning">En Espera</span> @endif
                                            @if($project->state==1) <span class="badge  text-white bg-warning">En Ejecución</span> @endif
                                            @if($project->state==9) <span class="badge  text-white bg-success">Finalizado</span> @endif
                                            @if($project->state==2) <span class="badge  text-white bg-danger">Cancelado</span> @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fecha de inicio</strong></td>
                                        <td>{{ $project->created_at }}</td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="row mt-4">
                                    <div class="col-4">
                                        @if($project->type==2)
                                            <input type="hidden" value="{{$customRequest = App\Models\CustomRequest::where('id',$project->id_type)->first()}}">
                                            <img style="max-width: 100%; border-radius: 30px;" class="mb-1" src="{{ asset('images/custom_request/'.$customRequest->file.'') }}">
                                        @endif
                                        @if($project->type==1)
                                            <input type="hidden" value="{{$quotation = App\Models\ProductQuotation::with('producto','producto.gallery')->where('id',$project->id_type)->first()}}">
                                            <img style="max-width: 100%; border-radius: 30px;" class="mb-1" src="{{ asset('images/products/thumbnail/list/'.$quotation->producto->gallery[0]->file.'') }}">
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <p class="nameproject">{{$project->name}}</p>
                                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> Envio desde {{ $project->ubication }}</p>
                                        <p><strong>${{number_format($project->price, 0, 0, '.')}}</strong></p>
                                    </div>
                                </div>
                                <hr>
                                <table>
                                    <tr>
                                        <td><strong>Cantidad</strong></td>
                                        <td>{{ $project->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Valor contrato</strong></td>
                                        <td>${{number_format($project->price*$project->quantity, 0, 0, '.')}} </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Valor envio</strong></td>
                                        <td>${{number_format($project->price_delivery, 0, 0, '.')}} </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Entrega Pactada</strong></td>
                                        <td>{{ $project->delivery_date }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h4 class="card-title mb-4">Timeline del proyecto:</h4>
                            <ul class="timeline timeline-kn container">
                                @if(count($project->timeline)>0)                                                    
                                    @foreach($project->timeline as $key=>$item)
                                        <li class="timeline-item element" id='div_{{$key+2}}'>
                                            <span class="timeline-point timeline-point-indicator  timeline-kanbai-active">{{$key+2}}</span>
                                            <div class="timeline-event row">
                                                <div class="col-md-9">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                        <h6>{{$item->description}}</h6>                                                                
                                                    </div>
                                                    <p>{{$project->created_at}}</p>
                                                    @if($item->file!=null)
                                                        <img style="max-width: 100%; border-radius: 30px;" class="mb-1" src="{{ asset('images/projects/'.$item->file.'') }}">
                                                    @endif
                                                </div>                                                            
                                            </div>
                                        </li> 
                                    @endforeach
                                @endif                                                
                            </ul>
                        </div>
                    </div>
               
                </div>
                <div class="tab-pane fade show " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                @include('site.business.forms.edituser',['user'=>$user])
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                @include('site.business.forms.projects',['projects'=>$projects])
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
            </div>
        </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
    
    <script src="{{ asset('js/app/user/create.js') }}"></script>
@endpush

@extends('layouts.admin')

@section('title', 'Solicitudes personalizadas')
@section('page_title', 'Editar Solicitud personalizada')
@section('page_subtitle', 'Editar')
@section('content')


<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Editar: #{{ $project->id }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/home">Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/solicituded-personalizadas">Solicitudes personalizadas &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Editar: #{{ $project->id }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                        <form class="form" role="form" id="main-form" autocomplete="off" enctype="multipart/form-data">
                            <!--<input type="hidden" id="_url" value="{{ url('solicitud-personalizada',[$project->encode_id]) }}">-->
                            <input type="hidden" id="_url" value="{{ route('updateproyect') }}">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $project->encode_id }}">

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card">
                                            <div class="card-header mb-2">
                                                <h4 class="card-title">Información general:</h4>
                                            </div>
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
                                    <div class="col-md-7">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Timeline del proyecto:</h4>
                                            </div>
                                            <div class="card-body">
                                                <ul class="timeline timeline-kn container">
                                                    <li class="timeline-item element" id='div_1'>
                                                        <span class="timeline-point timeline-point-indicator @if($project->state==1) timeline-kanbai-active @else timeline-kanbai @endif">1</span>
                                                        <div class="timeline-event row">
                                                            <div class="col-md-9">
                                                            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                                <h6>Pedido confirmado</h6>                                                                
                                                            </div>
                                                            <p>{{$project->created_at}}</p>
                                                            @if($project->state!=1)
                                                            <div class="d-flex flex-row align-items-center">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox" id="confirmed" name="confirmed" value="1" >
                                                                    <label class="form-check-label" for="confirmed">Confirmar pedido</label>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            </div>
                                                            <div class="col-md-3 col-12 pt-2 ">                                           
                                                                <a href="#" title="Agregar" class="btn btn-success add"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>  
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
                                </div>                           
                                    
                                    <div class="row">         
                                        <div class="col-md-6 col-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="state">Estado</label>
                                                <select  id="state" name="state" class="form-control">
                                                    <option value="0" {{ ($project->state==0) ? "selected" : "" }}>En Espera</option>
                                                    <option value="1" {{ ($project->state==1) ? "selected" : "" }}>En Ejecución</option>
                                                    <option value="2" {{ ($project->state==2) ? "selected" : "" }}>Cancelado</option>
                                                    <option value="2" {{ ($project->state==9) ? "selected" : "" }}>Finalizado</option>
                                                </select>
                                                <span class="missing_alert text-danger" id="state_alert"></span>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 col-12">
                                            <button style="margin-top: 25px;" type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light ajax" id="submit"><i id="ajax-icon" class="fa fa-save"></i> Guardar</button>
                                        </div>
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

<script src="{{ asset('js/admin/solicitudpersonalizada/edit.js') }}"></script>
<script>
    
$(document).ready(function() {
 
    var iCnt=1;
// Crear un elemento div añadiendo estilos CSS
        var container = $(document.createElement('div'));

        $('#btAdd').click(function() {
            if (iCnt <= 19) {
                iCnt = iCnt + 1;
                // Añadir caja de texto.
                $(container).append('<div class="row" id="tb'+iCnt +'"><div class="col-md-6 col-12"><div class="mb-1"><label class="form-label" for="question">Pegunta</label><input type="text" class="form-control"  name="question[]" ></div></div><div class="col-md-6 col-12"><div class="mb-1"><label class="form-label" for="answer">Respuesta</label><textarea class="form-control"  name="answer[]" ></textarea></div></div></div>');

                if (iCnt == 1) {   

                var divSubmit = $(document.createElement('div'));
                    

                }

        $('#main').after(container, divSubmit); 
            }
            else {      //se establece un limite para añadir elementos, 20 es el limite
                
                $(container).append('<label>Limite Alcanzado</label>'); 
                $('#btAdd').attr('class', 'bt-disable'); 
                $('#btAdd').attr('disabled', 'disabled');

            }
        });

        $('#btRemove').click(function() {   // Elimina un elemento por click
            if (iCnt != 0) { $('#tb' + iCnt).remove(); iCnt = iCnt - 1; }
        
            if (iCnt == 0) { $(container).empty(); 
        
                $(container).remove(); 
                $('#btSubmit').remove(); 
                $('#btAdd').removeAttr('disabled'); 
                $('#btAdd').attr('class', 'bt btn-success btn') 

            }
        });
        
    });

    // Obtiene los valores de los textbox al dar click en el boton "Enviar"
    var divValue, values = '';

    function GetTextValue() {

        $(divValue).empty(); 
        $(divValue).remove(); values = '';

        $('.input').each(function() {
            divValue = $(document.createElement('div')).css({
                padding:'5px', width:'200px'
            });
            values += this.value + '<br />'
        });

        $(divValue).append('<p><b>Tus valores añadidos</b></p>' + values);
        $('body').append(divValue);

    }

$(document).ready(function(){

// Add new element
$(".add").click(function(){

 // Finding total number of elements added
 var total_element = $(".element").length;

 // last <div> with element class id
 var lastid = $(".element:last").attr("id");
 var split_id = lastid.split("_");
 var nextindex = Number(split_id[1]) + 1;

 var max = 15-{{count($project->timeline)}};
 // Check total number elements
 if(total_element < max ){
  // Adding new div container after last occurance of element class
  $(".element:last").after("<li class='timeline-item element' id='div_"+ nextindex +"'></li>");

  // Adding element to <div>
  $("#div_" + nextindex).append('<span class="timeline-point timeline-point-indicator timeline-kanbai ">'+nextindex+'</span><div class="row"><div class="col-md-8 col-12"><label class="form-label" for="description">Descripcion</label><input type="text" class="form-control" id="description" name="description[]" ><span class="missing_alert text-danger" id="description_alert"></span><label class="form-label" for="image">Imagen</label><input type="file" name="image[]"  class="form-control" placeholder="xxxx" id="txt_1" ></div><div class="col-md-4 col-12 pt-2 "><a href="#" id="remove_'+nextindex+'" class="btn btn-danger remove" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></div> ');

 }

});

// Remove element
$('.container').on('click','.remove',function(){

 var id = this.id;
 var split_id = id.split("_");
 var deleteindex = split_id[1];

 // Remove <div> with id
 $("#div_" + deleteindex).remove();

}); 
});

</script>

@endpush

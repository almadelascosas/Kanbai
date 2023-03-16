@extends('layouts.admin')

@section('title', 'Productos')
@section('page_title', 'Editar Productos')
@section('page_subtitle', 'Editar')
@section('content')


<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Editar: {{ $product->title }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/home">Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/products">Productos &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Editar: {{ $product->title }}</li>
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
                    <div class="card-header">
                        <h4 class="card-title">Editar Producto</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" role="form" id="main-form" autocomplete="off" enctype="multipart/form-data">
                            <!--<input type="hidden" id="_url" value="{{ url('categories',[$product->encode_id]) }}">-->
                            <input type="hidden" id="_url" value="{{ route('updateproduct') }}">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $product->encode_id }}">

                            <div class="row">
                                <div class="col-md-7 col-12">
                                    <div class="col-md-12 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name">Nombre</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                                            <span class="missing_alert text-danger" id="name_alert"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="price_min">Precio Mínimo</label>
                                                <input type="number" class="form-control" id="price_min" name="price_min" placeholder="1000000" value="{{$product->price_min}}">
                                                <span class="missing_alert text-danger" id="price_min_alert"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="price_max">Precio Máximo</label>
                                                <input type="number" class="form-control" id="price_max" name="price_max" placeholder="1000000" value="{{$product->price_max}}">
                                                <span class="missing_alert text-danger" id="price_max_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="quantity_min">Cantidad Mínima</label>
                                                <input type="number" class="form-control" id="quantity_min" name="quantity_min" placeholder="10" value="{{$product->quantity_min}}">
                                                <span class="missing_alert text-danger" id="quantity_min_alert"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="delivery_time">Tiempo de entrega</label>
                                                <input type="text" class="form-control" id="delivery_time" name="delivery_time" placeholder="1 día" value="{{$product->delivery_time}}">
                                                <span class="missing_alert text-danger" id="delivery_time_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="description">Descripción</label>
                                                <textarea  name="description" class="ckeditor" id="description" rows="10" cols="80">{!! $product->description  !!}</textarea>
                                                <span class="missing_alert text-danger" id="description_alert"></span>
                                            </div>
                                        </div> 
                                    </div>

                                    <div id="main">
                                        <input type="button" id="btAdd" value="Agregar pregunta frecuente" class="bt btn-success btn" />
                                        <input type="button" id="btRemove" value="Eliminar pregunta frecuente" class="bt btn-danger btn" />
                                        
                                    </div>
                                    @if(count($product->questions)>0)
                                    @foreach($product->questions as $key=>$item)
                                    <div>
                                        <div class="row" id="tb{{$key}}">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="question">Pegunta</label>
                                                    <input type="text" class="form-control" name="question[]" value="{{$item->question}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="answer">Respuesta</label>
                                                    <textarea class="form-control" name="answer[]" >{{$item->answer}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif

                                </div>
                             

                                <div class="col-md-5 col-12">
                                <h5>Imagenes actuales</h5>
                                <div class='row'>  
                                @if(count($product->gallery)>0)
                                    @foreach($product->gallery as $item)
                                    <div class="col-md-2 col-12">
                                        <img style="max-width: 100%;" class="mb-1" src="{{ asset('images/products/'.$item->file.'') }}">
                                        <form method="POST" action="">
                                                <div class="form-group">
                                                    <button type="submit" data-token="{{ csrf_token() }}" data-attr="{{ url('productsgallery',[$item->encode_id]) }}" class="btn btn-danger waves-effect waves-float waves-light delete-user" value="Delete user"><i data-feather='trash-2'></i></button>
                                                </div>
                                        </form>
                                    </div> 
                                    @endforeach 
                                @endif
                                </div> 

                                    <div class="container mb-3 mt-3" style="padding: 0px;" >
                                        <div class='element row' id='div_1'>                                        
                                            <div class="col-md-8 col-12">
                                                <label class="form-label" for="image">Imagen</label>
                                                <input type="file" class="form-control" id="image" name="image[]" >
                                                <span class="missing_alert text-danger" id="image_alert"></span>
                                            </div>
                                            <div class="col-md-4 col-12 pt-2 ">                                           
                                                <a href="#" title="Agregar" class="btn btn-success add"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'> 
                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="shipping_price">Valor Envio</label>
                                                <input type="text" class="form-control" id="shipping_price" name="shipping_price" value="{{$product->shipping_price}}">
                                                <span class="missing_alert text-danger" id="shipping_price_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'> 
                                        <div class="col-md-12 col-12">
                                            <label class="form-label" for="Categorias">Categorías</label>
                                            <div class="list-group">
                                                @foreach ($categories as $item)
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" name="category_id[]" value="{{ $item->id }}" @foreach ($product->productcategories as $cat) {{ $item->id  === $cat->category->id ? 'checked' : ''   }} @endforeach>
                                                    {{ $item->name }}
                                                    <div class="list-group">
                                                        @foreach ($item->subcategories as $x)
                                                        <label class="list-group-item item-subcategory">
                                                            <input class="form-check-input me-1" type="checkbox" name="subcategory_id[]" value="{{ $x->id }}"  @foreach ($product->productsubcategories as $subcat) {{ $x->id  === $subcat->subcategory->id ? 'checked' : ''   }} @endforeach>
                                                            {{ $x->name }}
                                                        </label>
                                                        @endforeach                                                         
                                                    </div>

                                                </label>
                                                @endforeach                                                
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-md-12 col-12 mt-3">
                                    <div class="mb-1">
                                        <label class="form-label" for="user_id">Vendido por</label>
                                        <select  id="user_id" name="user_id" class="form-control">
                                            <option value="" >Seleccione</option>
                                            <option value="1" {{ ($product->user_id==1) ? "selected" : "" }}>Alama de las cosas</option>
                                            @foreach( $comercios as $key => $value )
                                            <option value="{{ $value->id }}" {{ ($product->user_id==$value->id) ? "selected" : "" }}>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="missing_alert text-danger" id="user_id_alert"></span>
                                    </div>
                                </div>

                                </div>


                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light ajax" id="submit"><i id="ajax-icon" class="fa fa-save"></i> Guardar</button>
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

<script src="{{ asset('js/admin/products/edit.js') }}"></script>
<script>

$(document).ready(function() {
    var iCnt = {{count($product->questions)}};
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

 var max = 10-{{count($product->gallery)}};
 // Check total number elements
 if(total_element < max ){
  // Adding new div container after last occurance of element class
  $(".element:last").after("<div class='element row' id='div_"+ nextindex +"'></div>");

  // Adding element to <div>
  $("#div_" + nextindex).append('<div class="col-md-8 col-12"><label class="form-label" for="image">Imagen</label><input type="file" name="image[]"  class="form-control" placeholder="xxxx" id="txt_1" ></div><div class="col-md-4 col-12 pt-2 "><a href="#" id="remove_'+nextindex+'" class="btn btn-danger remove" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div> ');

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

$('.delete-user').click(function(e){

e.preventDefault();
var _target=e.target;
let href = $(this).attr('data-attr');// Don't post the form, unless confirmed
let token = $(this).attr('data-token');
var data=$(e.target).closest('form').serialize();
Swal.fire({
title: 'Seguro que desea eliminar la imagen?',
text: "",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Aceptar',
cancelButtonText: 'Cancelar',
}).then((result) => {
if (result.isConfirmed) {
    $.ajax({
      url: href,
      headers: {'X-CSRF-TOKEN': token},
      type: 'DELETE',
      cache: false,
      data: data,
      success: function (response) {
        var json = $.parseJSON(response);
        console.log(json);
        Swal.fire(
            'Muy bien!',
            'Imagen eliminada correctamente',
            'success'
            ).then((result) => {
                location.reload();
            });

      },error: function (data) {
        var errors = data.responseJSON;
        console.log(errors);

      }
   });

}
})

});
</script>
@endpush

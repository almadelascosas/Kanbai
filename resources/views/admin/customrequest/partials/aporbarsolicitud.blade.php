<form method="POST" action="">
  <input type="hidden" name="customrequest_id" value="{{$customrequest->id}}">
  <input type="hidden" name="state" value="1">
    <div class="row">

      <div class="col-md-12 col-12">
        <div class="mb-1">
          <label class="form-label" for="price_finish">Precio Final</label>
          <input type="text" class="form-control" id="price_finish" name="price_finish"  value="{{$customrequest->price_finish}}" >
          <span class="missing_alert text-danger" id="price_finish_alert"></span>
        </div>
      </div> 
      <div class="col-md-6 col-6">
          <div class="mb-1">
              <label class="form-label" for="shipping_from">Enviado desde</label>
              <input type="text" class="form-control" id="shipping_from" name="shipping_from"  value="{{$customrequest->shipping_from}}" >
              <span class="missing_alert text-danger" id="shipping_from_alert"></span>
          </div>
      </div> 
      <div class="col-md-6 col-6">
         <div class="mb-1">
            <label class="form-label" for="product">Nombre Producto</label>
            <input type="text" class="form-control" id="product" name="product"  value="{{$customrequest->product}}" >
            <span class="missing_alert text-danger" id="product_alert"></span>
          </div>
      </div> 
      <div class="col-md-6 col-6">
        <div class="mb-1">
            <label class="form-label" for="date_delivery_ok">Fecha entrega pactada</label>
            <input type="date" class="form-control" id="date_delivery_ok" name="date_delivery_ok"  value="{{$customrequest->date_delivery_ok}}" >
            <span class="missing_alert text-danger" id="date_delivery_ok_alert"></span>
        </div>
      </div> 
      <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="price_shiping">Valor envio para la cantidad solicitada</label>
          <input type="text" class="form-control" id="price_shiping" name="price_shiping"  value="{{$customrequest->price_shiping}}" >
          <span class="missing_alert text-danger" id="price_shiping_alert"></span>
        </div>
      </div>
      <div class="col-md-12 col-12">
        <div class="mb-1">
          <label class="form-label" for="comment">Escribe algun comentario</label>
          <textarea class="form-control" id="comment" name="comment"  >{{$customrequest->comment}}</textarea>
          
        </div>
      </div>  

    </div>    
    <div class="col-12 mt-3">
      <button type="submit" data-token="{{ csrf_token() }}" data-attr="{{ url('solicitud-personalizada',[$customrequest->encode_id]) }}" class="btn btn-primary waves-effect waves-float waves-light add-ingredient-size" value="Delete user"><i id="ajax-icon" class="fa fa-save"></i> Guardar</button>
    </div>        
</form>



@push('scripts')
<script>


$('.add-ingredient-size').click(function(e){

e.preventDefault();
var _target=e.target;
let href = $(this).attr('data-attr');// Don't post the form, unless confirmed
let token = $(this).attr('data-token');
var data=$(e.target).closest('form').serialize();
if ($('#price_finish').val() === '') {
    $('#price_finish_alert').text('Ingrese el precio final').show();
    $('#price_finish').focus();
    return false;
}
if ($('#shipping_from').val() === '') {
    $('#shipping_from_alert').text('Ingrese el lugar de donde se envia').show();
    $('#shipping_from').focus();
    return false;
}
if ($('#product').val() === '') {
    $('#product_alert').text('Ingrese un nombre para el producto').show();
    $('#product').focus();
    return false;
}
if ($('#date_delivery_ok').val() === '') {
    $('#date_delivery_ok_alert').text('Seleccione la fecha de entrega').show();
    $('#date_delivery_ok').focus();
    return false;
}
if ($('#price_shiping').val() === '') {
    $('#price_shiping_alert').text('Ingrese el valor del envio en caso contrario ingrese 0 ').show();
    $('#price_shiping').focus();
    return false;
}
Swal.fire({
title: 'Seguro que desea aprobar la solicitud personalizada',
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
      type: 'PUT',
      cache: false,
      data: data,
      success: function (response) {
        var json = $.parseJSON(response);
        console.log(json);
        Swal.fire(
            'Muy bien!',
            'Solicitud perzonalizada aprobada correctamente',
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
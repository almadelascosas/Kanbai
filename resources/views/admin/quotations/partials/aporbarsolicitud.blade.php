<form method="POST" action="">
  <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
  <input type="hidden" name="state" value="1">
    <div class="row">

      <div class="col-md-12 col-12">
        <div class="mb-1">
          <label class="form-label" for="price_finish">Precio Final</label>
          <input type="text" class="form-control" id="price_finish" name="price_finish"  value="{{$quotation->price_finish}}" >
          <span class="missing_alert text-danger" id="price_finish_alert"></span>
        </div>
      </div> 
      <div class="col-md-12 col-12">
        <div class="mb-1">
          <label class="form-label" for="iva">Iva</label>
          <select  class="form-control" id="iva" name="iva"   >
            <option value="0" {{ ($quotation->iva==0) ? "selected" : "" }} >Ninguno - (0%)</option>
            <option value="0.5" {{ ($quotation->iva==0.5) ? "selected" : "" }} >IVA - (5%)</option>
            <option value="0.19" {{ ($quotation->iva==0.19) ? "selected" : "" }} >IVA - (19%)</option>
            <option value="0.8" {{ ($quotation->iva==0.8) ? "selected" : "" }} >IVA - (8%)</option>
           
          </select>
          <span class="missing_alert text-danger" id="iva_alert"></span>
        </div>
      </div> 
      <div class="col-md-12 col-12">
        <div class="mb-1">
          <label class="form-label" for="price_shiping">Valor envio para la cantidad solicitada</label>
          <input type="text" class="form-control" id="price_shiping" name="price_shiping"  value="{{$quotation->price_shiping}}" >
          <span class="missing_alert text-danger" id="price_shiping_alert"></span>
        </div>
      </div>
      <div class="col-md-12 col-12">
        <div class="mb-1">
          <label class="form-label" for="comment">Escribe algun comentario</label>
          <textarea class="form-control" id="comment" name="comment"  >{{$quotation->comment}}</textarea>
          
        </div>
      </div>  

    </div>    
    <div class="col-12 mt-3">
      <button type="submit" data-token="{{ csrf_token() }}" data-attr="{{ url('quotes',[$quotation->encode_id]) }}" class="btn btn-primary waves-effect waves-float waves-light add-ingredient-size" value="Delete user"><i id="ajax-icon" class="fa fa-save"></i> Guardar</button>
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
if ($('#price_shiping').val() === '') {
    $('#price_shiping_alert').text('Ingrese el valor del envio').show();
    $('#price_shiping').focus();
    return false;
}
Swal.fire({
title: 'Seguro que desea aprobar la solicitud',
text: "",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Aceptar',
cancelButtonText: 'Cancelar',
}).then((result) => {
if (result.isConfirmed) {
  $('#ajax-icon').removeClass('fa fa-save').addClass('fa fa-spin fa-refresh');
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
            'Solicitud aprobada correctamente',
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
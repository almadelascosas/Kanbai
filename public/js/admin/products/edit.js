$(document).ready(function(){

  $('#main-form').submit(function(){

        $('.missing_alert').css('display', 'none');

        if ($('#main-form #name').val() === '') {
          $('#main-form #name_alert').text('Ingrese un nombre de producto').show();
          $('#main-form #name').focus();
          return false;
      }

      if ($('#main-form #price_min').val() === '') {
          $('#main-form #price_min_alert').text('Ingrese un precio mínimo').show();
          $('#main-form #price_min').focus();
          return false;
      }
      if ($('#main-form #price_max').val() === '') {
          $('#main-form #price_max_alert').text('Ingrese un precio máximo').show();
          $('#main-form #price_max').focus();
          return false;
      }
      if ($('#main-form #quantity_min').val() === '') {
          $('#main-form #quantity_min_alert').text('Ingrese una cantinad mínima').show();
          $('#main-form #quantity_min').focus();
          return false;
      }
      if ($('#main-form #delivery_time').val() === '') {
          $('#main-form #delivery_time_alert').text('Ingrese un tiempo de entrega').show();
          $('#main-form #delivery_time').focus();
          return false;
      }

      if ($('#main-form #size').val() === '') {
          $('#main-form #size_alert').text('Seleccione un tamaño').show();
          $('#main-form #size').focus();
          return false;
      }
      if ($('#main-form #shipping_price').val() === '') {
          $('#main-form #shipping_price_alert').text('Ingrese un valor de envio').show();
          $('#main-form #shipping_price').focus();
          return false;
      }
      var description=CKEDITOR.instances.description.getData();
        if (description === '') {
          $('#main-form #description_alert').text('Ingrese una descripción').show();
          $('#main-form #description').focus();
          return false;
      }
      if ($('#main-form #user_id').val() === '') {
          $('#main-form #user_id_alert').text('Seleccione el comercio que vende el producto').show();
          $('#main-form #user_id').focus();
          return false;
      }
      

      //var data = $('#main-form').serialize();
      for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();

      var formData = new FormData($("#main-form")[0]);
        //$('input').iCheck('disable');
        $('#main-form input, #main-form button').attr('disabled','true');
        $('#ajax-icon').removeClass('fa fa-edit').addClass('fa fa-spin fa-refresh');

        Pace.track(function () {
            $.ajax({
              url: $('#main-form #_url').val(),
    		      headers: {'X-CSRF-TOKEN': $('#main-form #_token').val()},
    		      type: 'POST',
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
               success: function (response) {
                var json = $.parseJSON(response);
                if(json.success){
                  $('#main-form #submit').hide();
                  $('#main-form #edit-button').attr('href', $('#main-form #_url').val() + '/' + json.user_id + '/edit');
                  $('#main-form #edit-button').removeClass('hide');
                  //toastr.success('Datos modificados exitosamente');
                  _alertGeneric('success','Muy bien! ','Producto actualizado correctamente','/products');
                }
              },error: function (data) {
                var errors = data.responseJSON;
                console.log(errors);
                $.each( errors.errors, function( key, value ) {
                  toastr.error(value);
                  return false;
                });
                $('input').iCheck('enable');
                $('#main-form input, #main-form button').removeAttr('disabled');
                $('#ajax-icon').removeClass('fa fa-spin fa-refresh').addClass('fa fa-save');
              }
           });
        });

       return false;

    });
});

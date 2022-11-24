$(document).ready(function(){

  $('#main-form').submit(function(){

        $('.missing_alert').css('display', 'none');

        if ($('#main-form #email').val() === '') {
            $('#main-form #email_alert').text('Ingrese tu correo electrónico').show();
            $('#main-form #email').focus();
            return false;
        }
        if (! $('#main-form #email').val().match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/)) {
          $('#main-form #email_alert').text('Ingrese correo electrónico válido').show();
          $('#main-form #email').focus();
          return false;
        }       

        if ($('#main-form #name').val() === '') {
          $('#main-form #name_alert').text('Ingrese tu nombre o nombre de la empresa').show();
          $('#main-form #name').focus();
          return false;
        }

        if ($('#main-form #cellphone').val() === '') {
          $('#main-form #cellphone_alert').text('Ingrese número celular').show();
          $('#main-form #cellphone').focus();
          return false;
        }
        if ($('#main-form #quantity').val() === '') {
          $('#main-form #quantity_alert').text('Ingrese cantidad').show();
          $('#main-form #quantity').focus();
          return false;
        }
        if ($('#main-form #address').val() === '') {
          $('#main-form #address_alert').text('Ingrese ubicación de entrega').show();
          $('#main-form #address').focus();
          return false;
        }

        if ($('#main-form #date_delivery').val() === '') {
          $('#main-form #date_delivery_alert').text('Ingrese fecha de entrega').show();
          $('#main-form #date_delivery').focus();
          return false;
        }
        

  

        //var data = $('#main-form').serialize();
        var formData = new FormData($("#main-form")[0]);
        //$('input').iCheck('disable');
        $('#main-form input, #main-form button').attr('disabled','true');
        $('#ajax-icon').removeClass('fa fa-save').addClass('fa fa-spin fa-refresh');
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
                  //notifications.success('Servicio ingresado exitosamente');
                  _alertGeneric('success','Listo! Hemos recibido tu solicitud ','Número de solicitud #'+json.id,'/');
                }
              },error: function (data) {
                var errors = data.responseJSON;
                console.log(errors);
                $.each( errors.errors, function( key, value ) {
                  notifications.error(value);
                  return false;
                });
                $('input').iCheck('enable');
                $('#main-form input, #main-form button').removeAttr('disabled');
                $('#ajax-icon').removeClass('fa fa-spin fa-refresh').addClass('fa fa-save');
              }
           });
        

       return false;

    });
});

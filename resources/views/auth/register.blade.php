@extends('layouts.appregister')


@section('content')

<section class="section-agents section-t8 mt-5">
    <div class="container mt-5">
        <div class="row mt-5 ">
            <div class="col-md-6 conten-form">
                <div class="">               

                    <div class="card-body ">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control input-cotizacion @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}  <a  class="btn btn-link text-gray btn-link-register" href="/home">¿Ya tienes una cuenta? <strong>Ingresa</strong></a></strong>
                                    </span>
                                    <script>
                                        $( document ).ready(function() {
                                            _alertLogin('info','Informacón', {{ $message }}, '/login')
                                        });
                                    </script>
                                @enderror                            
                            </div>

                            <div class="input-group mb-3"> 
                                <label for="password" class="form-label" style="display: block;width: 100%;">Contraseña *</label>                              
                                <input class="form-control password input-login @error('password') is-invalid @enderror" id="password"  type="password" name="password" />
                                <span class="input-group-text togglePassword eye-login" id="">
                                    <i class="fa fa-eye" aria-hidden="true" style="cursor: pointer"></i>
                                </span>
                               

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                            
                            </div>

                            <div class="input-group mb-3">
                                <label for="password-confirm" class="form-label" style="display: block;width: 100%;">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control password-confirm input-login" name="password_confirmation" required autocomplete="new-password"> 
                                <span class="input-group-text togglePassword-confirm eye-login" id="">
                                    <i class="fa fa-eye" aria-hidden="true" style="cursor: pointer"></i>
                                </span>                           
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Tu nombre completo</label>                            
                                <input id="name" type="text" class="form-control input-cotizacion @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                            </div>

                            <div class="mb-3">
                                <label for="name_business" class="form-label">Nombre de tu empresa</label>                            
                                <input id="name_business" type="text" class="form-control input-cotizacion @error('name_business') is-invalid @enderror" name="name_business" value="{{ old('name_business') }}" required autocomplete="name_business" autofocus>
                                @error('name_business')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                            </div>

                            <div class="mb-3">
                                <label for="phone"  class="form-label label-display-block">Número de celular</label>                            
                                <input  type="text" id="phone" class="form-control input-cotizacion @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                            </div>
                            

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary btn-go-quotation color-purple">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-4 create-account">
                                <div class="col-md-6 offset-md-3">
                                    <a  class="btn btn-link text-gray btn-link-register" href="/home">¿Ya tienes una cuenta? <strong>Ingresa</strong></a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 image-register-desk">
                <img src="{{ asset('images/registro.png') }}" alt="registro" class="img-register">
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')


<script>
   
   var input = document.querySelector("#phone");
    window.intlTelInput(input, {
    initialCountry: "auto",
    geoIpLookup: function(callback) {
        $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
        var countryCode = (resp && resp.country) ? resp.country : "co";
        callback(countryCode);
        });
    },
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // just for formatting/placeholders etc
    });

         feather.replace({ 'aria-hidden': 'true' });

$(".togglePassword").click(function (e) {
      e.preventDefault();
      var type = $(this).parent().parent().find(".password").attr("type");
      if(type == "password"){
          $("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
          $(this).parent().parent().find(".password").attr("type","text");
      }else if(type == "text"){
          $("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
          $(this).parent().parent().find(".password").attr("type","password");
      }
  });

  $(".togglePassword-confirm").click(function (e) {
      e.preventDefault();
      var type = $(this).parent().parent().find(".password-confirm").attr("type");
      if(type == "password"){
          $("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
          $(this).parent().parent().find(".password-confirm").attr("type","text");
      }else if(type == "text"){
          $("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
          $(this).parent().parent().find(".password-confirm").attr("type","password");
      }
  });
    </script>


@endpush

@extends('layouts.adminfront')


@section('title', 'Login')

@section('content')

  <div class="container-fluid p-0">
     <div class="row no-gutters justify-content-center">
     
        <div class="col-sm-6 col-lg-5 col-xxl-4  align-self-center order-2 order-sm-1">
        <img src="{{ asset('images/logo/logo.png') }}" alt="AdminLTE Logo" class="brand-image " style="opacity: .8; max-width: 100%;height: 140px;display: block; margin: 0 auto;margin-top: 25px;">
            <div class="card-group">
            
                <div class="card p-4 mt-5 elevation-1 card-login">
                    <div class="card-body px-lg-5 py-lg-5">
                   

                        <p class="text-muted">Ingresa tu cuenta</p>
                         <form id="main-form" autocomplete="off" action="javascript:void(0)"><br>
                          <input type="hidden" id="_url" value="{{ url('login') }}">
                          <input type="hidden" id="_redirect" value="{{ url('/home') }}">
                          <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <div class="input-group mb-3">
                                <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control" autofocus placeholder="Ingrese el usuario">
                                <span class="invalid-feedback" id="username_alert" role="alert" style="font-size: 100%;"></span>
                            </div>

                            <div class="input-group mb-4">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                <span class="invalid-feedback" id="password_alert" role="alert" style="font-size: 100%;"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-default" id="boton">
                                        <i class="fas fa-sign-in-alt text-white" id="ajax-icon"></i> <span class="text-white ml-3">{{ __('Acceder') }}</span>
                                    </button>
                                </div>
                                

                            </div>
                        </form>
                    </div>
                </div><br>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/admin/auth/login.js') }}"></script>
@endpush


@extends('layouts.app')
@section('title', 'Registro')
@section('content')

@section('content')
<section class="section pb-5">
    <div class="container">
        <h2>Registro</h2>
        <form class="form" role="form" action="javascript:void(0)" enctype="multipart/form-data" id="main-form" autocomplete="off">
            <input type="hidden" id="_url" value="{{ url('registercustomer') }}">
            <input type="hidden" id="_token" value="{{ csrf_token() }}">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">Nombre</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre">
                    <span class="missing_alert text-danger" id="first_name_alert"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Apellido</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Apellido">
                    <span class="missing_alert text-danger" id="last_name_alert"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="mb-1">
                        <label class="form-label" for="city-column">Género</label>
                        <div class="demo-inline-spacing">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genero" id="inlineRadio1" value="M" checked="">
                                <label class="form-check-label" for="inlineRadio1">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genero" id="inlineRadio2" value="F">
                                <label class="form-check-label" for="inlineRadio2">Femenino</label>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="type">Tipo</label>
                    <select  id="type" name="type" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="PERSONA_JURIDICA">Persona Juridica</option>
                        <option value="PERSONA_NATURAL">Persona Natural</option>
                    </select>
                    <span class="missing_alert text-danger" id="type_alert"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="identification_type">Tipo Documento</label>
                    <select  id="identification_type" name="identification_type" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="CC">Cédula</option>
                        <option value="NIT">Nit</option>
                        <option value="PASAPORTE">Pasaporte</option>
                        <option value="RC">RC</option>
                        <option value="TI">TI</option>
                        <option value="TE">TE</option>
                        <option value="CE">CE</option>
                        <option value="IE">IE</option>
                        <option value="NIT_OTRO_PAIS">Nit otro país</option>
                    </select>
                    <span class="missing_alert text-danger" id="identification_type_alert"></span>
                </div>
            </div>   
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="identification">Identificación</label>
                    <input type="number" id="identification" name="identification" class="form-control" placeholder="Identificación">
                    <span class="missing_alert text-danger" id="identification_alert"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="departament_id">Departamento</label>
                    <select  id="departament_id" name="departament_id" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach( $deptos as $key => $value )
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                    <span class="missing_alert text-danger" id="departament_id_alert"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city_id">Ciudad</label>
                    <select  id="city_id" name="city_id" class="form-control">
                        <option value="">Seleccione</option>
                    </select>
                    <span class="missing_alert text-danger" id="city_id_alert"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Teléfono</label>
                    <input type="number" id="phone" name="phone" class="form-control" placeholder="Teléfono">
                    <span class="missing_alert text-danger" id="phone_alert"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="address_line">Dirección</label>
                    <input type="text" id="address_line" name="address_line" class="form-control" placeholder="Dirección">
                    <span class="missing_alert text-danger" id="address_line_alert"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="E-mail">
                    <span class="missing_alert text-danger" id="email_alert"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="username">Usuario</label>
                    <input type="text"  class="form-control" id="username" name="username" placeholder="Usuario">
                    <span class="missing_alert text-danger" id="username_alert"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Contraseña</label>
                    <input type="password"  class="form-control" id="password" name="password" placeholder="Contraseña">
                    <span class="missing_alert text-danger" id="password_alert"></span>
                </div>
                
            </div>
            <div class="form-row">
               
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password"  class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Contraseña">
                    <span class="missing_alert text-danger" id="password_confirmation_alert"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light ajax" id="submit"><i id="ajax-icon" class="fa fa-save"></i> Registrar</button>
                </div>
            </div>  
        </form>
    </div>
</section>

@endsection

@push('scripts')
    
    <script src="{{ asset('js/app/user/create.js') }}"></script>
@endpush

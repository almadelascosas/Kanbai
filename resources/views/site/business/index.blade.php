@extends('layouts.app')
@section('title', 'Mi perfil')
@section('content')

@section('content')
<section class="section-agents section-t8 mt-5 product-desk">
    <div class="container">
        <div class="row mt-5">

        <div class="d-flex align-items-start">
            
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
                <button class="nav-link menu-user active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-square squere-menu-user" aria-hidden="true"></i> Mi Información <i class="fa fa-chevron-right float-right icon-net-menu-user" aria-hidden="true"></i></button>
                <button class="nav-link menu-user" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-square squere-menu-user" aria-hidden="true"></i> Mis Proyectos <i class="fa fa-chevron-right float-right icon-net-menu-user" aria-hidden="true"></i></button>
                <button class="nav-link menu-user" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-square squere-menu-user" aria-hidden="true"></i> Balance Financielo <i class="fa fa-chevron-right float-right icon-net-menu-user" aria-hidden="true"></i></button>
                <button  onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link menu-user" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                    <i class="fa fa-square squere-menu-user" aria-hidden="true"></i> Cerrar Sesión <i class="fa fa-chevron-right float-right icon-net-menu-user" aria-hidden="true"></i>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </button>
            </div>
            <div class="tab-content wth-70" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
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

<section class="section-agents section-t8 mt-5 profile-mobile">
    <div class="container">
        <div class="row">
            <div class="col-4 icon-profile">
                <label class="content-icon-profile"><i class="bi bi-person"></i></label>
            </div>
            <div class="col-8">
                <h4 class="mb-0">Hola, {{ Auth::user()->name}} </h4>
            </div>
                
        </div>
        <div class="row mt-2 content-menu-profile">
            
            <div class="d-flex align-items-start">
                <ul class="menu-profile-mobile">
                    <li>
                        <i class="bi bi-info menu-p-mobil"></i>
                        <a href="/">Inicio</a>
                        <i class="fa fa-chevron-right float-right " aria-hidden="true"></i>
                    </li>
                    <li>
                        <i class="bi bi-person menu-p-mobil"></i>
                        <a href="/mi-informacion">Mi información</a>
                        <i class="fa fa-chevron-right float-right " aria-hidden="true"></i>
                    </li>    
                    <li>
                        <i class="bi bi-folder menu-p-mobil"></i>
                        <a href="/mis-proyectos">Mis proyectos</a>
                        <i class="fa fa-chevron-right float-right " aria-hidden="true"></i>
                    </li>
                    <li><i class="bi bi-person menu-p-mobil"></i><a>Balance financiero</a><i class="fa fa-chevron-right float-right " aria-hidden="true"></i></li> 
                    <li><button  onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link menu-user" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                    <i class="bi bi-box-arrow-right menu-p-mobil"></i> Cerrar Sesión 
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </button></li>                 
                <ul>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    
    <script src="{{ asset('js/app/user/create.js') }}"></script>
@endpush

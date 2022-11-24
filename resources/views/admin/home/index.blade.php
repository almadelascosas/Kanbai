@extends('layouts.admin')
@section('title', 'Inicio')
@section('content')
<section class="container">
    @if ( Auth::user()->hasRole('Administrador'))
      
  <div class="row match-height">
    <div class="col-md-3 col-xl-3">
      <div class="card card-congratulation-medal">
        <div class="card-body">
          <h5>Usuarios registrados.</h5>
          <h3 class="mb-75 mt-2 pt-50"><a href="#" target="_self" class="">{{ App\Models\User::count() }} Usuarios</a></h3>
          <a href="/user" class="btn btn-primary"> Ver </a>        
        </div>
      </div>
    </div>
    
    <div class="col-md-3 col-xl-3">
      <div class="card card-congratulation-medal">
        <div class="card-body">
          <h5>Clientes registrados</h5>
          <h3 class="mb-75 mt-2 pt-50"><a href="#" target="_self" class="">{{ App\Models\Customers::count() }} Clientes</a></h3>
          <a href="/customers" class="btn btn-primary"> Ver </a>        
        </div>
      </div>
    </div>
   
  </div>





@else 
<div class="row">
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button" data-tooltip="tooltip" title="Toggle"></a>
</div>  
@endif



</section>
@endsection
 @if ( Auth::user()->hasRole('Administrador'))

@else

@endif

@extends('layouts.app')
@section('title', 'Productos')
@section('content')


    <!-- ======= list products Section ======= -->
    <section class="section-agents section-t8">
    @if($info['namesubcategory']!=null)
      <div class="miga-pan">
        <div class="container">
          <a href="/catalogo/{{ $info['slugcategory'] }}">< Volver a {{$info['namecategory']}}</a>
        </div>
      </div>
      @endif
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              
             
            </div>
          </div>
        </div>
        
        @livewire('productos',['info'=>$info])
          
         
      </div>
    </section><!-- End list products Section -->

 

@endsection




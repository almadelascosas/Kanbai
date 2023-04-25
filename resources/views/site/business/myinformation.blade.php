@extends('layouts.app')
@section('title', 'Mi perfil')
@section('content')

@section('content')

<section class="section-agents section-t8 mt-5 profile-mobile">
    <div class="container">
        <a href="/mi-perfil" class="previos-profile"><i class="bi bi-arrow-left-circle"></i> Volver </a>
    @include('site.business.forms.edituser',['user'=>$user])
    </div>
</section>
@endsection

@push('scripts')
    
    <script src="{{ asset('js/app/user/create.js') }}"></script>
@endpush

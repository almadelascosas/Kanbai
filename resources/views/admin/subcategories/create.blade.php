@extends('layouts.admin')

@section('title', 'Sub Categorías')
@section('page_title', 'Agregar Sub Categoría')
@section('page_subtitle', 'Guardar')
@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Nueva Sub Categoría</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/home">Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/subcategories">Sub Categorías &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Nueva Sub Categoría</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Crear Sub Categoría</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" role="form" action="javascript:void(0)" enctype="multipart/form-data" id="main-form" autocomplete="off">
                            <input type="hidden" id="_url" value="{{ url('subcategories') }}">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <div class="row">

                            <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="category_id">Categoria Pradre</label>
                                        <select  id="category_id" name="category_id" class="form-control">
                                            <option value="">Seleccione</option>
                                            @foreach( $categories as $key => $value )
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="missing_alert text-danger" id="category_id_alert"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="name">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre Sub Categoria">
                                        <span class="missing_alert text-danger" id="name_alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="file">Imagen</label>
                                        <input type="file" class="form-control" id="file" name="file" >
                                        <span class="missing_alert text-danger" id="file_alert"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="city-column">Estado</label>
                                        <div class="demo-inline-spacing">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="state" id="status1" value="1">
                                                <label class="form-check-label" for="status1">Activada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="state" id="status2" value="0">
                                                <label class="form-check-label" for="status2">Desactivada</label>
                                            </div>
                                        </div>
                                        <span class="missing_alert text-danger" id="state_alert"></span>
                                    </div>
                                </div>
                              

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light ajax" id="submit"><i id="ajax-icon" class="fa fa-save"></i> Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')

    <script src="{{ asset('js/admin/subcategories/create.js') }}"></script>
@endpush

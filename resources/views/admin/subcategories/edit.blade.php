@extends('layouts.admin')

@section('title', 'Sub Categorías')
@section('page_title', 'Editar Sub Categoría')
@section('page_subtitle', 'Editar')
@section('content')


<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Editar: {{ $subcategory->name }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/home">Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/subcategories">Sub Categorías &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Editar: {{ $subcategory->name }}</li>
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
                        <h4 class="card-title">Editar Sub Categoría</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" role="form" id="main-form" autocomplete="off" enctype="multipart/form-data">
                            <!--<input type="hidden" id="_url" value="{{ url('categories',[$subcategory->encode_id]) }}">-->
                            <input type="hidden" id="_url" value="{{ route('updatesubcategory') }}">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $subcategory->encode_id }}">
                            <div class="row">
                            <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="category_id">Categoria Pradre</label>
                                        <select  id="category_id" name="category_id" class="form-control">
                                            @foreach( $categories as $key => $value )
                                            <option value="{{ $value->id }}" {{ ($subcategory->category_id==$value->id) ? "selected" : "" }} >{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="missing_alert text-danger" id="category_id_alert"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="name">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre Sub Categoria" value="{{ $subcategory->name }}">
                                        <span class="missing_alert text-danger" id="name_alert"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="file">Foto</label>
                                        <input type="file" class="form-control" id="file" name="file" >
                                        <img style="max-height: 70px;" src="{{ asset('images/subcategories/'.$subcategory->file.'') }}" alt="Imagen">
                                        <span class="missing_alert text-danger" id="file_alert"></span>
                                    </div>
                                </div>
                               
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="city-column">Estado</label>
                                        <div class="demo-inline-spacing">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="state" id="status1" value="1" {{ ($subcategory->state=="1")? "checked" : "" }} >
                                                <label class="form-check-label" for="status1">Activa</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="state" id="status2" value="0" {{ ($subcategory->state=="0")? "checked" : "" }} >
                                                <label class="form-check-label" for="status2">Desactivada</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light ajax" id="submit"><i id="ajax-icon" class="fa fa-save"></i> Actualizar</button>
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

    <script src="{{ asset('js/admin/subcategories/edit.js') }}"></script>
@endpush

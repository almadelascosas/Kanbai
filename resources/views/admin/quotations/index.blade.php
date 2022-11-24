@extends('layouts.admin')
@section('title','Lista de Cotizaciones')
@section('page_title', 'Listado de Cotizaciones')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Cotizaciones</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/home">Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Cotizaciones</li>
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
                        <h4 class="card-title">Cotizaciones</h4>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                            <table class="table" id="datatables" >
                                <thead class="table-light">
                                    <tr >
                                        <th class="sorting"  rowspan="1" colspan="1">Opciones</th>
                                        <th class="sorting"  rowspan="1" colspan="1">#</th>
                                        <th class="sorting"  rowspan="1" colspan="1">Estado</th>
                                        <th class="sorting"  rowspan="1" colspan="1">Producto</th>
                                        <th class="sorting"  rowspan="1" colspan="1">E-mail</th>
                                        <th class="sorting"  rowspan="1" colspan="1">Cliente</th>
                                        <th class="sorting"  rowspan="1" colspan="1">Celular</th>
                                        <th class="sorting"  rowspan="1" colspan="1">Cantidad requerida</th>
                                        <th class="sorting"  rowspan="1" colspan="1">Dirección</th>
                                        <th class="sorting"  rowspan="1" colspan="1">Fecha de entrega</th>
                                        <th class="sorting"  rowspan="1" colspan="1">Observaciones</th>
                                        <th class="sorting"  rowspan="1" colspan="1">Fecha creación</th>
                                        <th class="sorting"  rowspan="1" colspan="1">Fecha actualización</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($quotations as $item)
                                    <tr class="odd row{{ $item->id }}">
                                        <td>
                                            <a  class="mb-1 btn btn-warning waves-effect waves-float waves-light" href="{{ url('quotes', [$item->encode_id,'edit']) }}" title="Editar"><i data-feather='edit-3'></i> </a>
                                            <form method="POST" action="">

                                                <div class="form-group">
                                                    <button type="submit" data-token="{{ csrf_token() }}" data-attr="{{ url('quotes',[$item->encode_id]) }}" class="btn btn-danger waves-effect waves-float waves-light delete-user" value="Delete user"><i data-feather='trash-2'></i></button>
                                                </div>
                                            </form>
                                        </td>

                                        <td>{{ $item->id }}</td>
                                        <td>@if($item->state==0) <span class="badge  text-white bg-warning">Sin gestionar</span> @endif
                                        @if($item->state==1) <span class="badge  text-white bg-success">Gestionado</span> @endif
                                        @if($item->state==2) <span class="badge  text-white bg-danger">Cancelado</span> @endif</td>
                                        <td>{{ $item->producto->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->cellphone }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->date_delivery }}</td>
                                        <td>{{ $item->observations }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                      
                                        

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script>
    $('.delete-user').click(function(e){

        e.preventDefault();
        var _target=e.target;
        let href = $(this).attr('data-attr');// Don't post the form, unless confirmed
        let token = $(this).attr('data-token');
        var data=$(e.target).closest('form').serialize();
        Swal.fire({
        title: 'Seguro que desea eliminar la cotización?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
              url: href,
              headers: {'X-CSRF-TOKEN': token},
              type: 'DELETE',
              cache: false,
    	      data: data,
              success: function (response) {
                var json = $.parseJSON(response);
                console.log(json);
                Swal.fire(
                    'Muy bien!',
                    'Cotización eliminado correctamente',
                    'success'
                    ).then((result) => {
                        location.reload();
                    });

              },error: function (data) {
                var errors = data.responseJSON;
                console.log(errors);

              }
           });

        }
        })

    });
</script>

@endpush



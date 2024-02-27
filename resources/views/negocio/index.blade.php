@extends('layouts.master')
@section('title')
{{ __('Negocio') }}
@endsection
@section('css')
    <!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Negocio') }}
        @endslot
        @slot('title')
        {{ __('Negocio') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">                                 
                                    <a href="{{ route('negocio.create') }}" class="btn btn-primary">Nuevo Negocio</a>
                                </div>
                                <table id="tableNegocio" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th data-ordering="false">ID</th>
                                            <th>Nombre</th>
                                            <th>Nombre Encargado</th>
                                            <th>Distrito</th>
                                            <th>Dirección</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($negocios as $negocio)
                                            <tr>
                                                <td>{{ $negocio->id }}</td>
                                                <td>{{ $negocio->name }}</td>
                                                <td>{{ $negocio->user->name }} | {{ $negocio->name_encargado }}</td>
                                                <td>{{ $negocio->distritos->name }}</td>
                                                <td>{{ $negocio->address }}</td>
                                                <td>{{ $negocio->phone }}</td>
                                                <td>{{ $negocio->email }}</td>
                                                <td class="d-flex justify-items-center">
                                                    <a href="{{ route('negocio.edit', $negocio) }}"  class="btn btn-warning waves-effect waves-light"> Editar</a>
                                                    <form action="{{ route('negocio.destroy', $negocio)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger waves-effect waves-light"> Eliminar </button>
                                                    </form>
                                                </td>
                                            </tr>                                            
                                        @endforeach                                       
                                    </tbody>
                                </table>
                            </div> <!-- end card-body-->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
    </div> <!-- end row-->

@endsection
@section('script')
    <!-- datatable js -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- responsive datatable js -->
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <!-- Datatables init -->
    <script>
        $(document).ready(function() {
            $('#tableNegocio').DataTable( {
                responsive: true
            } );
        } );
    </script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
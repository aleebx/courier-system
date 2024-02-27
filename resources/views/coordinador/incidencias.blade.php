@extends('layouts.master')
@section('title')
{{ __('Incidencias') }}
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
        {{ __('Incidencias') }}
        @endslot
        @slot('title')
        {{ __('Incidencias') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @else
                                        <div class="alert alert-danger" style="display: none;">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                </div>
                                <table id="tableIncidencias" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                            <th data-ordering="false">ID</th>
                                            <th>Negocio</th>
                                            <th>Destinatario</th>
                                            <th>Teléfono</th>
                                            <th>Distrito</th>
                                            <th>Monto Cobrar</th>
                                            <th>Fecha Entrega</th>
                                            <th>Servicio</th>
                                            <th>Incidencia</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pedidos as $pedido)
                                            <tr>
                                                <td>{{ $pedido->id }}</td>
                                                <td>{{ $pedido->negocio->name }}</td>                                        
                                                <td>{{ $pedido->destinatario->namefull }}</td>
                                                <td>{{ $pedido->destinatario->phone }}</td>
                                                <td>{{ $pedido->destinatario->distritos->name }}</td>
                                                <td>{{ $pedido->pedido_detalles->monto_cobrar }}</td>
                                                <td>{{ date('d-m-Y', strtotime($pedido->fecha_entrega)) }}</td>
                                                <td>{{ $pedido->servicio }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <h5><span class="badge border border-warning text-warning"> {{ $pedido->pedido_incidencias->last()->incidencia->name }}</span></h5>
                                                </td>
                                                <td><span class="badge bg-light {!! $pedido->pedido_seguimientos->last()->seguimientos->color !!}">{!! $pedido->pedido_seguimientos->last()->seguimientos->icon !!} {{ $pedido->pedido_seguimientos->last()->seguimientos->name }}</span></td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('pedido.edit', $pedido) }}"  class="btn btn-warning waves-effect waves-light"> Editar</a>
                                                    {{-- <form action="{{ route('pedido.destroy', $pedido)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger waves-effect waves-light"> Eliminar </button>
                                                    </form> --}}
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
    <!-- Datatables init -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
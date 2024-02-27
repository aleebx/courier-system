@extends('layouts.master')
@section('title')
{{ __('Pedidos') }}
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
        {{ __('Pedidos') }}
        @endslot
        @slot('title')
        {{ __('Pedidos') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @dump($errors)
                                <div class="mb-3">                                    
                                    <a class="btn btn-primary addRow"><i class="mdi mdi-plus"></i>  Agregar fila</a>
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
                                <form action="{{ route('pedido.guardar') }}" method="POST">
                                    @csrf
                                <div class="mb-3">                                    
                                    <select name="negocio_id" class="form-select">
                                        @foreach ($negocios as $negocio)
                                            <option value="{{ $negocio->id }}">{{ $negocio->name }} | {{ $negocio->address }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <table id="tablePedidos" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tipo Pedido</th>
                                            <th>Nombre destinatario</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            {{-- <th>Departamento</th>
                                            <th>Provincia</th> --}}
                                            <th style="width: 10%">Distrito</th>
                                            <th>Dirección de entrega</th>
                                            <th>Fecha de entrega</th>
                                            <th>Detalle</th>
                                            <th>Monto Cobrar</th>
                                            <th>Metodo de Pago</th>
                                            <th>Observación</th>
                                            <th>Tipo paquete</th>
                                            <th>Largo</th>
                                            <th>Ancho</th>
                                            <th>Alto</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="tbodyPedido">
                                            <tr>
                                            <td>1</td>
                                            <td style="padding: 0%">
                                                <select name="type_pedido_id[]" class="form-select">
                                                    @foreach ($type_pedidos as $type_pedido)
                                                        <option value="{{ $type_pedido->id }}">{{ $type_pedido->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="namefull[]" value="">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="phone[]" value="">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="email[]" value="">
                                            </td>
                                            <td style="padding: 0%">
                                                <select name="distrito_id[]" class="form-select distrito_idUno" data-row="1">
                                                    <option value="">Selecciona un Distrito</option>
                                                    @foreach ($distritos as $distrito)
                                                        <option value="{{ $distrito->id }}" data-dep="{{ $distrito->departamento_id }}" data-pro="{{ $distrito->provincia_id }}">{{ $distrito->name }}</option>
                                                    @endforeach                                                 
                                                </select>
                                                <input type="hidden" class="form-control" id="departamento_id" name="departamento_id[]">
                                                <input type="hidden" class="form-control" id="provincia_id" name="provincia_id[]">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="address[]" value="">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="date" class="form-control vRe" name="fecha_entrega[]" value="">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="detalle[]" value="">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="monto_cobrar[]" value="">
                                            </td>
                                            <td style="padding: 0%">
                                                <select name="metodo_pago_id[]" class="form-select">
                                                    @foreach ($metodos_pago as $metodo_pago)
                                                        <option value="{{ $metodo_pago->id }}">{{ $metodo_pago->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="observacion[]" value="">
                                            </td>
                                            <td style="padding: 0%">
                                                <select name="type_paquete[]" class="form-select">
                                                    <option value="1">Estadar</option>
                                                    <option value="2">Extra</option>
                                                </select>
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="medida_largo[]" value="20">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="medida_ancho[]" value="20">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="medida_alto[]" value="10">
                                            </td>
                                            <td style="padding: 0%">
                                                {{-- <a class="btn btn-danger removeRow"><i class="mdi mdi-delete"></i></a> --}}
                                            </td>
                                        </tr>                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="18"><button type="submit" class="btn btn-primary">Guardar</button></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                            </div> <!-- end card-body-->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
    </div> <!-- end row-->

@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- datatable js -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- responsive datatable js -->
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <!-- Datatables init -->
    <script src="{{ URL::asset('build/js/dev/addPedido.js?v2') }}"></script>
    <script src="{{ URL::asset('build/js/dev/obtenerDistrito.js?v1') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
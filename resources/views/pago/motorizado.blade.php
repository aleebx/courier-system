@extends('layouts.master')
@section('title')
{{ $motorizado->namefull }} {{ __('Pagos') }}
@endsection
@section('css')
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Pagos') }}
        @endslot
        @slot('title')
        {{ __('Pagos') }} {{ $motorizado->namefull }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Pagos {{ $motorizado->namefull }} </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tabla-pagos" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Motorizado</th>
                                                <th>Negocio</th>                                               
                                                <th>Destinatario</th>
                                                <th>Telefono</th>
                                                <th>Distrito</th>
                                                <th>Estado</th>
                                                <th>Monto a cobrar</th>
                                                @foreach ($metodos_pago as $metodo_pago)
                                                    <th>{{ $metodo_pago->name }}</th>
                                                @endforeach                                               
                                                <th>Diferencia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pedidos as $pedido)
                                                <tr>
                                                    @php $pedido->fecha_asignado = date('Y-m-d', strtotime($pedido->fecha_asignado)); @endphp
                                                    <td>{{ $pedido->fecha_asignado }}</td>
                                                    <td>{{ $motorizado->namefull }}</td>
                                                    <td>{{ $pedido->negocio->name }}</td>
                                                    <td>{{ $pedido->destinatario->namefull }}</td>
                                                    <td>{{ $pedido->destinatario->phone }}</td>
                                                    <td>{{ $pedido->destinatario->distritos->name }}</td>
                                                    <td><span class="badge bg-light {!! $pedido->pedido_seguimientos->last()->seguimientos->color !!}">{!! $pedido->pedido_seguimientos->last()->seguimientos->icon !!} {{ $pedido->pedido_seguimientos->last()->seguimientos->name }}</span></td>
                                                    <td>{{ $pedido->pedido_detalles->monto_cobrar }}</td>
                                                    @foreach ($metodos_pago as $metodo_pago)
                                                        <td align="right">
                                                            @if ($pedido->pedido_pagos->where('metodo_pago_id', $metodo_pago->id)->count() > 0)
                                                                {{ $pedido->pedido_pagos->where('metodo_pago_id', $metodo_pago->id)->first()->monto }}
                                                            @else
                                                                {{-- <i class="mdi mdi-close"></i> --}}
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                    <td>
                                                        @if ($pedido->pedido_pagos->count() > 0)
                                                            @php
                                                                $monto_cobrar = $pedido->pedido_detalles->monto_cobrar;
                                                                $monto_pagado = $pedido->pedido_pagos->sum('monto');
                                                            @endphp
                                                            @if ($monto_cobrar > $monto_pagado)
                                                                <span class="badge bg-danger">{{ $monto_cobrar - $monto_pagado }}</span>
                                                            @else
                                                                <span class="text-success">{{ $monto_pagado - $monto_cobrar }}</span>
                                                            @endif
                                                        @else
                                                            <i class="mdi mdi-close"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="7" style="text-align:right">Total:</th>
                                                <th></th>
                                                @foreach ($metodos_pago as $metodo_pago)
                                                    <th align="right">
                                                        @php
                                                            $monto_total = 0;
                                                            foreach ($pedidos as $pedido) {
                                                                if ($pedido->pedido_pagos->where('metodo_pago_id', $metodo_pago->id)->count() > 0) {
                                                                    $monto_total += $pedido->pedido_pagos->where('metodo_pago_id', $metodo_pago->id)->first()->monto;
                                                                }
                                                            }
                                                        @endphp
                                                        {{ $monto_total }}
                                                    </th>
                                                @endforeach
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div> <!-- end card body -->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
        </div>
    </div> <!-- end row-->

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="{{ URL::asset('build/js/dev/pago.js?v2') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
@extends('layouts.master')
@section('title')
{{ __('Rutas') }}
@endsection
@section('css')
    <!--datatable css-->
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Rutas') }}
        @endslot
        @slot('title')
        {{ __('Rutas') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="row row-cols-md-3 row-cols-1">
                                <div class="col col-lg border-end">
                                    <div class="py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Cantidad de pedidos
                                        </h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-package-variant-closed display-6 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $pedidos->count() }}">1</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col col-lg border-end">
                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Motorizados Activos 
                                        </h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-motorbike-electric display-6 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $motorizados->count() }}">1</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col col-lg border-end">
                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Distritos Activos
                                        </h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-earth-plus display-6 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $distritos->count() }}">1</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col col-lg border-end">
                                    <div class="mt-3 mt-lg-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Media x Motorizado
                                        </h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-table-column-plus-after display-6 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                @php
                                                $media = $pedidos->count() / $motorizados->count();
                                                @endphp
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ round($media) }}">1</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col col-lg">
                                    <div class="mt-3 mt-lg-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Media x Distrito
                                        </h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-table-column-plus-before display-6 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                @php
                                                $mediad = $pedidos->count() / $distritos->count();
                                                @endphp
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ round($mediad) }}">1</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div>
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
                <div class="row">
                    <div class="col-5">
                    <form id="form-guardar">
                    @csrf
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Distrito con pedidos cargados</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="distrito_id" class="form-label">Distritos</label>
                                    <select class="form-select" id="distrito_id" name="distrito_id">
                                        <option value="0">Seleccione un distrito</option>
                                        @foreach ($distritos as $distrito)
                                            <option value="{{ $distrito->id }}">{{ $distrito->name }} {{ $distrito->total }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div> <!-- end col-->  
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Motorizados activos</h5>
                            </div>
                            <div class="card-body">
                                <label for="motorizado_id" class="form-label">Motorizado</label>
                                <select class="form-select" id="motorizado_id" name="motorizado_id">
                                    <option value="0">Seleccione un motorizado</option>
                                    @foreach ($motorizados as $motorizado)
                                        <option value="{{ $motorizado->id }}">{{ $motorizado->namefull }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div> <!-- end col-->
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Cantidad de pedidos asignar</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="monto_cobrar" class="form-label">Cantidad de pedidos</label>
                                    <input type="number" step="any" class="form-control" placeholder="Ingresar monto a cobrar" name="cantidad_pedidos" value="">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Asignar</button>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div> <!-- end col-->
                </form>
                </div> <!-- end row-->
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Rutas asignadas</h5>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="{{ csrf_token() }}" id="csrf_token" name="csrf_token">
                            <div class="table-responsive" id="tabla-pedidos">
                                <table class="table table-hover table-centered table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Destinatario</th>
                                            <th scope="col">Teléf</th>
                                            <th scope="col">Distrito</th>
                                            <th scope="col">Fecha Entrega</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
            </div>
            </div>
    </div> <!-- end row-->

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ URL::asset('build/js/dev/ruta.js?v2') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
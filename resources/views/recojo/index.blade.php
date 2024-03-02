@extends('layouts.master')
@section('title')
{{ __('Recojo') }}
@endsection
@section('css')
    <!--datatable css-->
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Recojo') }}
        @endslot
        @slot('title')
        {{ __('Recojo') }}
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
                                        <h5 class="text-muted text-uppercase fs-13">Negocios Registrados
                                        </h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-earth-plus display-6 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $negocios->count() }}">1</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div>
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
                <form action="{{ route('recojo.asignarRecojo')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Negocios pedidos</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="negocio_id" class="form-label">Negocio</label>
                                    <select name="negocio_id" id="negocio_id" class="form-select">
                                        <option value="">Seleccione un negocio</option>
                                        @foreach ($negocios as $negocio)
                                            <option value="{{ $negocio->negocio_id }}">{{ $negocio->nombre }} | {{$negocio->distrito_nombre}} [{{ $negocio->total }}]</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div> <!-- end col-->  
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Motorizados activos</h5>
                            </div>
                            <div class="card-body">
                                <label for="motorizado_id" class="form-label">Motorizado</label>
                                <select class="form-select" id="motorizado_id" name="motorizado_id">
                                    <option value="0">Seleccione un motorizado</option>
                                    @foreach ($motorizados as $motorizado)
                                        <option value="{{ $motorizado->id }}">{{ $motorizado->namefull }} [{{ $motorizado->distritos->name }}]</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div> <!-- end col-->  
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Asignar Recojos</h5>
                            </div>
                            <div class="card-body">
                                <button type="submit" class="btn btn-flat btn-primary">Asignar</button>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div> <!-- end col-->  
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Listado de pedidos a recoger</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group" id="lista-checkbox">
                                    
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </form>
            </div>
    </div> <!-- end row-->

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ URL::asset('build/js/dev/asignarRecojo.js?v2') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
@extends('layouts.master')
@section('title')
{{ __('Editar Pedido')}}
@endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Editar Pedido')}}
        @endslot
        @slot('title')
        {{ __('Editar Pedido')}}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    {{-- @$segui = $detalle->pedido_seguimientos->last()->seguimiento_id; --}}
                    <div class="card-title flex-grow-1 mb-0">Detalles del Pedido <span class="badge bg-primary-subtle text-primary">{{ $detalle->pedido_seguimientos->last()->seguimientos->name }}</span></div>
                    <div class="flex-shrink-0 mt-2 mt-sm-0">
                        <form action="{{ route('pedido.anular', $detalle )}}" method="POST">
                        @csrf
                        @method('PUT')
                            <input type="hidden" name="pedido_id" value="{{ $detalle->id }}">
                                {{-- <a href="javascript:void(0);" class="btn btn-soft-info btn-sm mt-2 mt-sm-0 shadow-none"><i class="ri-map-pin-line align-middle me-1"></i> Change Address</a> --}}
                                <button type="sunmit" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0 shadow-none"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Anular pedido</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    {{-- @dump($errors) --}}
                    @if ($success = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $success }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($anulado = Session::get('anulado'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $anulado }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('pedido.update', $detalle )}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="negocio_id" class="form-label">Mis negocios</label>
                                    <select name="negocio_id" class="form-select">
                                        @foreach ($negocios as $negocio)
                                            <option value="{{ $negocio->id }}" @if ($negocio->id == $detalle->negocio_id) selected @endif>{{ $negocio->name }} | {{ $negocio->address }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="type_pedido_id" class="form-label">Tipo de pedido</label>
                                    <select name="type_pedido_id" id="type_pedido_id" class="form-select">
                                        @foreach ($type_pedidos as $type_pedido)
                                            <option value="{{ $type_pedido->id }}" @if ($type_pedido->id == $detalle->type_pedido_id) @endif>{{ $type_pedido->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-9">
                                <div class="mb-3">
                                    <label for="namefull" class="form-label">Nombre del destinatario</label>
                                    <input type="text" class="form-control vRe" placeholder="Ingresar estinatario del Pedido" name="namefull" value="{{ old('namefull', $detalle->destinatario->namefull) }}">
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Teléfono del destinatario</label>
                                    <input type="tel" class="form-control vRe" placeholder="Ingresar Teléfono" name="phone" value="{{ old('phone', $detalle->destinatario->phone) }}">
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo del destinatario <small>(Opcional)</small></label>
                                    <input type="email" class="form-control vRe" placeholder="Ingresar Correo electronico" name="email" value="{{ old('email', $detalle->destinatario->email) }}">
                                </div>
                            </div><!--end col-->
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="distrito_id" class="form-label">Distrito</label>
                                    <select name="distrito_id" id="distrito_id" class="form-select">
                                       <option value="">Selecciona un Distrito</option>
                                        @foreach ($distritos as $distrito)
                                            <option value="{{ $distrito->id }}" @if ($distrito->id == $detalle->destinatario->distrito_id) selected @endif>{{ $distrito->name }}</option>
                                        @endforeach                                                 
                                    </select>
                                    <input type="hidden" name="departamento_id" value="{{ old('departamento_id', $detalle->destinatario->departamento_id) }}">
                                    <input type="hidden" name="provincia_id" value="{{ old('provincia_id', $detalle->destinatario->provincia_id) }}">
                                </div>
                            </div><!--end col-->
                            <div class="col-9">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Dirección del destinatario</label>
                                    <input type="text" class="form-control vRe" placeholder="Ingresar dirección" name="address" value="{{ old('address', $detalle->destinatario->address) }}">
                                </div>
                            </div><!--end col-->   
                            <div class="col-4">
                                @php
                                    $fecha_entrega = date('Y-m-d', strtotime($detalle->fecha_entrega));
                                @endphp
                                <div class="mb-3">
                                    <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                                    <input type="date" class="form-control vRe" placeholder="Ingresar fecha de entrega" name="fecha_entrega" value="{{ old('fecha_entrega', $fecha_entrega) }}">
                                </div>
                            </div><!--end col-->
                            <div class="col-8">
                                <div class="mb-3">
                                    <label for="detalle" class="form-label">¿Qué envia?</label>
                                    <input type="text" class="form-control vRe" placeholder="Ingresar lo que envia en el paquete" name="detalle" value="{{ old('detalle', $detalle->pedido_detalles->detalle) }}">
                                </div>
                            </div><!--end col-->    
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="monto_cobrar" class="form-label">Monto a cobrar</label>
                                    <input type="number" step="any" class="form-control vRe" placeholder="Ingresar monto a cobrar" name="monto_cobrar" value="{{ old('monto_cobrar', $detalle->pedido_detalles->monto_cobrar) }}">
                                </div>
                            </div><!--end col-->    
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="metodo_pago_id" class="form-label">Metodo de pago</label>
                                    <select name="metodo_pago_id" id="metodo_pago_id" class="form-select">
                                        @foreach ($metodos_pago as $metodo_pago)
                                            <option value="{{ $metodo_pago->id }}" @if ($metodo_pago->id == $detalle->pedido_detalles->metodo_pago_id) selected @endif>{{ $metodo_pago->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!--end col-->   
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="observacion" class="form-label">Observación</label>
                                    <input type="text" class="form-control vRe" placeholder="Ingresar Observación" name="observacion" value="{{ old('observacion', $detalle->pedido_detalles->observacion) }}">
                                </div>
                            </div><!--end col--> 
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="type_paquete" class="form-label">Tipo de paquete</label>
                                    <select name="type_paquete" id="type_paquete" class="form-select">                                                   
                                        <option value="1" @if ($detalle->pedido_detalles->type_paquete == 1)selected @endif>Estandar</option>
                                        <option value="2" @if ($detalle->pedido_detalles->type_paquete == 2)selected @endif>>Extra Grande</option>
                                    </select>
                                </div>
                            </div><!--end col-->                                             
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="medida_largo" class="form-label">Largo del paquete</label>
                                    <input type="number" class="form-control vRe" placeholder="Ingresar Largo del paquete" name="medida_largo" value="{{ old('medida_largo', $detalle->pedido_detalles->medida_largo) }}">
                                </div>
                            </div><!--end col-->                                             
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="medida_alto" class="form-label">Alto del paquete</label>
                                    <input type="number" class="form-control vRe" placeholder="Ingresar Alto del paquete" name="medida_alto" value="{{ old('medida_alto', $detalle->pedido_detalles->medida_alto) }}">
                                </div>
                            </div><!--end col-->                                             
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="medida_ancho" class="form-label">Ancho del paquete</label>
                                    <input type="number" class="form-control vRe" placeholder="Ingresar Ancho del paquete" name="medida_ancho" value="{{ old('medida_ancho', $detalle->pedido_detalles->medida_ancho) }}">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    @if ($detalle->pedido_seguimientos->last()->seguimiento_id == 1)                              
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                    @else
                                    <button type="submit" class="btn btn-primary" disabled>Actualizar</button>
                                    @endif
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div> <!-- end card-body-->
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Seguimiento del Pedido</h4>
                </div>
                <div class="card-body">
                    @foreach ($detalle->pedido_seguimientos as $seguimiento)
                    <div class="profile-timeline">                        
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 avatar-xs">
                                <div class="avatar-title bg-light {{ $seguimiento->seguimientos->color }} rounded-circle shadow">
                                    {!! $seguimiento->seguimientos->icon !!}
                                </div>
                            </div>
                            @php
                                $fecha = date('d/m/Y h:i:s a', strtotime($seguimiento->created_at));
                            @endphp
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fs-14 mb-0 fw-semibold">{{ $seguimiento->seguimientos->name }} - {{$fecha}}</h6>
                                <small class="">{{ $seguimiento->seguimientos->descripcion }} - {{$seguimiento->observacion}}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach 
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
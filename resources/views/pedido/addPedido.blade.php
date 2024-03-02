@extends('layouts.master')
@section('title')
{{ __('Nuevo Pedido') }}
@endsection
@section('css')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Nuevo Pedido') }}
        @endslot
        @slot('title')
        {{ __('Nuevo Pedido') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="">
                                    <a href="{{ route('pedido.index') }}" class="btn btn-primary">Lista de Pedidos</a>
                                </div>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="btn-close" data-bs-dismiss="alert"></button>
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif
                            <div class="card-body">
                                {{-- @dump($errors) --}}
                                <form action="{{ route('pedido.store')}}" method="POST">
                                    @csrf
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title">Datos del destinatario</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="negocio_id" class="form-label">Mis negocios</label>
                                                        <select name="negocio_id" class="form-select" required>
                                                            @foreach ($negocios as $negocio)
                                                                <option value="{{ $negocio->id }}">{{ $negocio->name }} | {{ $negocio->address }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="type_pedido_id" class="form-label">Tipo de pedido</label>
                                                        <select name="type_pedido_id" id="type_pedido_id" class="form-select">
                                                            @foreach ($type_pedidos as $type_pedido)
                                                                <option value="{{ $type_pedido->id }}">{{ $type_pedido->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        {{-- <label for="type_pedido_pedido" class="form-label">¿Esto es un pedido?</label> --}}
                                                        <!-- Inline Radios -->
                                                        <div class="form-check form-check">
                                                            <input class="form-check-input" type="radio" name="pedido_pedido" id="pNuevo" value="1" checked>
                                                            <label class="form-check-label" for="pNuevo">Nuevo</label>
                                                        </div>
                                                        <div class="form-check form-check">
                                                            <input class="form-check-input" type="radio" name="pedido_pedido" id="pReutilizado" value="2">
                                                            <label class="form-check-label" for="pReutilizado">Reutilizado</label>
                                                        </div>
                                                        <div class="form-check form-check">
                                                            <input class="form-check-input" type="radio" name="pedido_pedido" id="pReagendado" value="3">
                                                            <label class="form-check-label" for="pReagendado">Reagendado</label>
                                                        </div>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="listPedidos" class="form-label">Pedidos</label>
                                                        <div id="selectContainer">
                                                            <select name="listPedidos" class="form-select" disabled>
                                                                <option value="">Selecciona un pedido</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="namefull" class="form-label">Nombre del destinatario</label>
                                                        <input type="text" class="form-control vRe" placeholder="Ingresar estinatario del Pedido" name="namefull" value="{{ old('namefull') }}" required>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label">Teléfono del destinatario</label>
                                                        <input type="tel" class="form-control vRe" placeholder="Ingresar Teléfono" name="phone" pattern="[0-9]{9}" value="{{ old('phone') }}" required>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Correo del destinatario <small>(Opcional)</small></label>
                                                        <input type="email" class="form-control vRe" placeholder="Ingresar Correo electronico" name="email" value="{{ old('email') }}">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="distrito_id" class="form-label">Distrito</label>
                                                        <select name="distrito_id" id="distrito_id" class="form-select distrito_idUno" required>
                                                        <option value="">Selecciona un Distrito</option>
                                                        @foreach ($distritos as $distrito)
                                                                <option value="{{ $distrito->id }}" data-dep="{{ $distrito->departamento_id }}" data-pro="{{ $distrito->provincia_id }}" data-tarifa="{{ $distrito->tarifa }}">{{ $distrito->name }}</option>
                                                            @endforeach                                    
                                                        </select>
                                                        <input type="hidden" name="departamento_id" id="departamento_id" value="" required>
                                                        <input type="hidden" name="provincia_id" id="provincia_id" value="" required>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-9">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Dirección del destinatario</label>
                                                        <input type="text" class="form-control vRe" placeholder="Ingresar dirección" name="address" value="{{ old('address') }}" required>
                                                    </div>
                                                </div><!--end col-->   
                                                <div class="col-4">
                                                    <div class="mb-3">
                                                        @php
                                                            $fechahoy = date('Y-m-d');
                                                        @endphp
                                                        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                                                        <input type="date" class="form-control vRe" placeholder="Ingresar fecha de entrega" name="fecha_entrega" value="{{ old('fecha_entrega', $fechahoy) }}" max="{{ date('Y-m-d', strtotime('+7 days')) }}" min="{{ date('Y-m-d')}}" required>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-8">
                                                    <div class="mb-3">
                                                        <label for="detalle" class="form-label">¿Qué envia?</label>
                                                        <input type="text" class="form-control vRe" placeholder="Ingresar lo que envia en el paquete" name="detalle" value="{{ old('detalle') }}" required>
                                                    </div>
                                                </div><!--end col-->    
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="monto_cobrar" class="form-label">Monto a cobrar</label>
                                                        <input type="number" step="any" class="form-control vRe" placeholder="Ingresar monto a cobrar" name="monto_cobrar" value="{{ old('monto_cobrar') }}" required>
                                                    </div>
                                                </div><!--end col-->    
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="metodo_pago_id" class="form-label">Metodo de pago</label>
                                                        <select name="metodo_pago_id" id="metodo_pago_id" class="form-select">
                                                            @foreach ($metodos_pago as $metodo_pago)
                                                                <option value="{{ $metodo_pago->id }}">{{ $metodo_pago->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div><!--end col-->   
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="observacion" class="form-label">Observación</label>
                                                        <input type="text" class="form-control vRe" placeholder="Ingresar Observación" name="observacion" value="{{ old('observacion') }}">
                                                    </div>
                                                </div><!--end col--> 
                                        </div><!--end row-->
                                    </div><!--end card-body-->
                                </div><!--end card-->
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title">Medidas del paquete</h4>
                                    </div>
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="medida_largo" class="form-label">Largo del paquete (cm)</label>
                                                <input type="number" class="form-control vRe" placeholder="Ingresar Largo del paquete" name="medida_largo" id="medida_largo" value="{{ old('medida_largo', 30) }}" required>
                                            </div>
                                        </div><!--end col-->                                             
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="medida_alto" class="form-label">Alto del paquete (cm)</label>
                                                <input type="number" class="form-control vRe" placeholder="Ingresar Alto del paquete" name="medida_alto" id="medida_alto" value="{{ old('medida_alto', 20) }}" required>
                                            </div>
                                        </div><!--end col-->                                             
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="medida_ancho" class="form-label">Ancho del paquete (cm)</label>
                                                <input type="number" class="form-control vRe" placeholder="Ingresar Ancho del paquete" name="medida_ancho" id="medida_ancho"  value="{{ old('medida_ancho', 15) }}" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="medida_peso" class="form-label">Peso del paquete (kg)</label>
                                                <input type="number" class="form-control vRe" placeholder="Ingresar Peso del paquete" name="medida_peso" id="medida_peso" value="{{ old('medida_peso', 1) }}" required>
                                            </div>
                                        </div>
                                    </div><!--end row-->
                                </div><!--end card-body-->
                                </div><!--end card-->
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title">Costo del servicio</h4>
                                            </div>
                                            <div class="card-body">
                                            <div class="row">                                         
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="servicioIgv">Servicio adicionales</label>
                                                <div class="form-check">
                                                    <input class="form-check-input adicional" type="checkbox" name="adiccional[]" id="servicioIgv" value="igv" data-status="1">
                                                    <label class="form-check-label" for="servicioIgv">IGV</label>
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-3">
                                            <label for="servicio" class="form-label">Costo servicio</label>
                                            <div class="input-group">
                                                <span class="input-group-text">S/</span>
                                                <input type="number" class="form-control vRe" placeholder="Servicio de entrega" name="servicio" id="servicio" value="{{ old('servicio', 0) }}" disabled>
                                                <input type="hidden" class="form-control vRe" name="servicio2" id="servicio2" value="{{ old('servicio2', 0) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="extra" class="form-label">Adicional</label>
                                            <div class="input-group">
                                                <span class="input-group-text">S/</span>
                                                <input type="number" class="form-control vRe" placeholder="extra" name="extra" id="extra" value="{{ old('extra', 0) }}" disabled>
                                                <input type="hidden" class="form-control vRe" name="extra2" id="extra2" value="{{ old('extra2', 0) }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-3">
                                            <label for="total" class="form-label">Total a pagar</label>
                                            <div class="input-group">
                                                <span class="input-group-text">S/</span>
                                                <input type="number" class="form-control vRe" placeholder="Total a pagar" id="total" name="total" value="{{ old('total', 0) }}" disabled>
                                                <input type="hidden" class="form-control vRe" id="total2" name="total2" value="{{ old('total2', 0) }}">
                                                <input type="hidden" class="form-control vRe" id="type_paquete" name="type_paquete" value="{{ old('type_paquete', 1) }}">
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end card-body-->
                                <div class="card-footer">
                                    <p class="text-muted">* Todos los campos son requeridos</p>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Nuevo pedido</button>
                                    </div>
                                </div>
                                </div><!--end card-->

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
    <!-- Datatables init -->
    <script src="{{ URL::asset('build/js/dev/addPedido.js?v2') }}"></script>
    <script src="{{ URL::asset('build/js/dev/obtenerDistrito.js?v1') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
@extends('layouts.master')
@section('title')
{{ __('Pedidos') }}
@endsection
@section('css')
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
                                    {{-- <a class="btn btn-primary addRow"><i class="mdi mdi-plus"></i>  Agregar fila</a> --}}
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
                                <div id="nombre">
                                    <span>Nombre: </span>
                                    <input id="nombre_fruta" class="texto" type="text"><button type="button" class="agregar">Agregar</button>
                                </div>
                                <div id="listado_frutas">
                                    <ul>
                                        <li>
                                            Pera <button type="button">Borrar</button>
                                        </li>
                                        <li>
                                            Manzana <button type="button">Borrar</button>
                                        </li>
                                        <li>
                                            Naranja <button type="button">Borrar</button>
                                        </li>
                                    </ul>
                                </div>
                                
                                {{-- <table id="tablePedidos" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tipo Pedido</th>
                                            <th>Nombre destinatario</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th style="width: 10%">Distrito</th>
                                            <th>Dirección de entrega</th>
                                            <th>Fecha de entrega</th>
                                            <th>Detalle</th>
                                            <th>Monto Cobrar</th>
                                            <th>Metodo de Pago</th>
                                            <th>Observación</th>
                                            <th>Largo</th>
                                            <th>Ancho</th>
                                            <th>Alto</th>
                                            <th>Peso</th>
                                            <th>Adicional</th>
                                            <th>Servicio</th>
                                            <th>Extra</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="tbodyPedido">
                                        @for($i = 1;$i <= 50; $i++)
                                            <tr>
                                            <td>{{ $i }}</td>
                                            <td style="padding: 0%">
                                                <select name="type_pedido_id[]" class="form-select">
                                                    @foreach ($type_pedidos as $type_pedido)
                                                        <option value="{{ $type_pedido->id }}">{{ $type_pedido->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="namefull[]" value="{{ old('namefull[$i]') }}">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="phone[]" value="">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe" name="email[]" value="">
                                            </td>
                                            <td style="padding: 0%">
                                                <select name="distrito_id[]" class="form-select distritoSel slc{{$i}}" data-row="{{$i}}">
                                                    <option value="">Selecciona un Distrito</option>
                                                    @foreach ($distritos as $distrito)
                                                        <option value="{{ $distrito->id }}" data-dep="{{ $distrito->departamento_id }}" data-pro="{{ $distrito->provincia_id }}" data-tarifa="{{ $distrito->tarifa }}">{{ $distrito->name }}</option>
                                                    @endforeach                                                 
                                                </select>
                                                <input type="hidden" class="form-control" id="departamento_id{{$i}}" name="departamento_id[]">
                                                <input type="hidden" class="form-control" id="provincia_id{{$i}}" name="provincia_id[]">
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
                                                <input type="text" class="form-control vRe largoMax" name="medida_largo[]" id="medida_largo{{$i}}" value="0" data-row="{{$i}}">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe anchoMax" name="medida_ancho[]" value="0" id="medida_ancho{{$i}}" data-row="{{$i}}">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe altoMax" name="medida_alto[]" value="0" id="medida_alto{{$i}}" data-row="{{$i}}">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="text" class="form-control vRe pesoMax" name="medida_peso[]" value="1" id="medida_peso{{$i}}" data-row="{{$i}}">
                                            </td>
                                            <td style="padding: 0%">
                                                <input class="form-check-input adicionalMax adicionalMaxT{{$i}}" type="checkbox" name="adiccional[{{$i}}][]" id="servicioIgv{{$i}}" value="igv" data-status="1" data-row="{{$i}}">
                                                <label class="form-check-label" for="servicioIgv">IGV</label>
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="number" class="form-control vRe" placeholder="Servicio de entrega" name="servicio[]" id="servicio{{$i}}" data-row="{{$i}}" value="{{ old('servicio', 0) }}" disabled>
                                                <input type="hidden" class="form-control vRe" name="servicioT[]" id="servicioT{{$i}}" value="{{ old('servicio2', 0) }}" data-row="{{$i}}">
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="number" class="form-control vRe" placeholder="extra" name="extra[]" id="extra{{$i}}" value="{{ old('extra', 0) }}" data-row="{{$i}}" disabled>
                                                <input type="hidden" class="form-control vRe" name="extraT[]" id="extraT{{$i}}" value="{{ old('extra2', 0) }}" data-row="{{$i}}"> 
                                            </td>
                                            <td style="padding: 0%">
                                                <input type="number" class="form-control vRe" placeholder="Total a pagar" id="total{{$i}}" name="total[]" value="{{ old('total', 0) }}" data-row="{{$i}}" disabled>
                                                <input type="hidden" class="form-control vRe" id="totalT{{$i}}" name="totalT[]" value="0" data-row="{{$i}}">
                                                <input type="hidden" class="form-control vRe" id="type_paquete{{$i}}" name="type_paquete[]" value="1" data-row="{{$i}}">
                                            </td>
                                        </tr>
                                        @endfor                                   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="18"><button type="submit" class="btn btn-primary">Guardar</button></th>
                                        </tr>
                                    </tfoot>
                                </table> --}}
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
    <script>
        $(document).on('click','.agregar', function () {
            var nombre_fruta = $('#nombre_fruta').val();
            if (nombre_fruta !== ""){
                $("#listado_frutas ul").append("<li>"+nombre_fruta+ "<button type='button'>Borrar</button></li>");
                $('#nombre_fruta').val('');
            }else{
                alert("El campo 'Nombre' es obligatorio");
            }
        });
        $(document).on('click','#listado_frutas ul li button', function () {
            $(this).parent().remove();
        });
    </script>
    <!-- Datatables init -->
    <script src="{{ URL::asset('build/js/dev/addPedidoMax.js?v2') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
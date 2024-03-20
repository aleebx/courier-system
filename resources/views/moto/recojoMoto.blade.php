@extends('layouts.master')
@section('title')
{{ __('Pedido - Motorizado') }}
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('build/libs/filepond/filepond.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
@endsection
@section('content')

    <div class="row g-4 mb-3">
        <div class="col-sm">
            <div class="justify-content-sm-end gap-3">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search...">
                    <i class="ri-search-line search-icon"></i>
                </div>                
            </div>
        </div>
    </div> 
    {{-- @dump($errors) --}}
    <div class="row pedidosCont">
        @php
            $seguimientos = [1, 2, 3];
        @endphp
        @foreach($pedidos as $pedido)
        <div class="col-xxl-3 col-sm-6 divPedido" id="{{ $pedido->id }}">
            <div class="card">
                <div class="card-body">
                    <div class="p-3 mt-n3 mx-n3 bg-info-subtle rounded-top">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="mb-0 fs-14"><a class="text-body"><i class="mdi mdi-account-heart"></i> {{ $pedido->destinatario->namefull }}</a></h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="d-flex gap-1 align-items-center my-n2">
                                    <span class="badge bg-light {!! $pedido->pedido_seguimientos->last()->seguimientos->color !!}">{!! $pedido->pedido_seguimientos->last()->seguimientos->icon !!} {{ $pedido->pedido_seguimientos->last()->seguimientos->name }}</span>
                                    S/ {{ $pedido->pedido_detalles->monto_cobrar }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="row gy-3">
                            <div class="col-12">
                                <div><i class="mdi mdi-phone"></i> {{ $pedido->destinatario->phone }}</div>                                        
                                <div><i class="mdi mdi-storefront"></i> {{ $pedido->negocio->name }} @if ($pedido->negocio->pos == 1) <span class="badge bg-danger">Asume %5</span> @endif</div>
                                <div><i class="mdi mdi-map-marker-radius-outline"></i> {{ $pedido->destinatario->distritos->name }} {{ $pedido->destinatario->address }}</div>
                                <div><i class="mdi mdi-package"></i> {{ $pedido->pedido_detalles->detalle }}</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="https://www.google.com/maps/dir/?api=1&destination=" class="btn btn-primary waves-effect waves-light"><i class="ri-map-pin-line"></i></a>
                            <a href="https://wa.me/51{{ $pedido->destinatario->phone }}?text=%20*Por%20favor%20Leer%20todo%20el%20mensaje:*%0A%0ABuenos%20días%20estimado/a%20{{ $pedido->destinatario->name }}!%20Somos%20Dinsides%20Courier%20encargados%20de%20la%20entrega%20de%20la%20tienda%20{{ $pedido->negocio->name }}%20y%20se%20trata%20de%20{{ $pedido->pedido_detalles->detalle }}.%0A @if( $pedido->pedido_detalles->monto_cobrar > 0)Monto%20a%20pagar%20S/{{ $pedido->pedido_detalles->monto_cobrar }}.%20*debe%20hacer%20el%20abono%20%20únicamente%20%20a%20las%20cuentas%20que%20le%20proporcione%20al%20llegar,%20de%20lo%20contrario%20el%20pago%20no%20se%20podra%20validar*%20y%20debe%20tener%20a%20mano%20el%20pago%20exacto%20de%20ser%20efectivo.@endif%0ALa%20dirección%20de%20entrega%20es:%20{{ $pedido->destinatario->address }}%20-%20{{ $pedido->destinatario->distritos->name }}.%20*POR%20FAVOR%20CONFIRME%20SI%20ES%20CORRECTO*.%20Envíenos%20su%20UBICACIÓN%20ACTUAL%20para%20mayor%20precisión%20en%20su%20dirección%20y%20asi%20pueda%20ser%20entregado%20con%20exito.%0A%0AEstamos%20atentos%20a%20su%20confirmaci%C3%B3n" class="btn btn-primary waves-effect waves-light"><i class="ri-whatsapp-line"></i></a>
                            <a href="tel:+51{{ $pedido->destinatario->phone }}" class="btn btn-primary waves-effect waves-light"><i class="ri-phone-line"></i></a>
                            <a class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modelIntercambio" data-id="{{ $pedido->id }}" data-metodo="{{ $pedido->pedido_detalles->metodo_pago_id }}" data-montopago="{{ $pedido->pedido_detalles->monto_cobrar }}" data-dest="{{ $pedido->destinatario->namefull }} | {{ $pedido->destinatario->phone }}"><i class="ri-repeat-line"></i> Intercambiar</a>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
                @if ($pedido->pedido_incidencias->count() > 0)
                    <div class="d-flex justify-content-center gap-2">
                        @foreach($pedido->pedido_incidencias as $pedido_incidencia)
                        <div class="alert alert-warning shadow" role="alert">
                            <strong>¡Incidencia!</strong> {{ $pedido_incidencia->incidencia->name }} 
                        </div>
                        @endforeach
                    </div>
                @endif
                <div class="card-footer bg-transparent border-top-dashed py-2 @if (!in_array($pedido->pedido_seguimientos->last()->seguimientos->id, $seguimientos)) d-none @endif">
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modelStatus" data-id="{{ $pedido->id }}" data-metodo="{{ $pedido->pedido_detalles->metodo_pago_id }}" data-montopago="{{ $pedido->pedido_detalles->monto_cobrar }}" data-dest="{{ $pedido->destinatario->namefull }} | {{ $pedido->destinatario->phone }}">
                            <i class="ri-check-line me-1"></i>Entregado
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modelRechazado2" data-id="{{ $pedido->id }}" data-metodo="{{ $pedido->pedido_detalles->metodo_pago_id }}" data-montopago="{{ $pedido->pedido_detalles->monto_cobrar }}" data-dest="{{ $pedido->destinatario->namefull }} | {{ $pedido->destinatario->phone }}">
                            <i class="ri-close-line me-1"></i>Rechazado
                        </button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modelincidenciaN" data-id="{{ $pedido->id }}" data-metodo="{{ $pedido->pedido_detalles->metodo_pago_id }}" data-montopago="{{ $pedido->pedido_detalles->monto_cobrar }}" data-dest="{{ $pedido->destinatario->namefull }} | {{ $pedido->destinatario->phone }}">
                            <i class="ri-close-line me-1"></i>Incidencia
                        </button>
                    </div>
                </div>
                @if ($pedido->pedido_pagos->count() > 0)
                <div class="card-footer bg-transparent border-top-dashed py-2">
                    <div class="d-flex flex-wrap">
                        <table class="table table-borderless table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Método de pago</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedido->pedido_pagos as $pedido_pago)
                                <tr>
                                    <td>
                                    {{ $pedido_pago->metodo_pago->name }}
                                    </td>
                                    <td>
                                        {{ $pedido_pago->monto }}                                
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div>
                        @if ($pedido->pedido_detalles->photo)
                        <img class="rounded shadow" alt="200x200" width="200" src="{{ URL::asset('images/pedidos')}}/{{ $pedido->pedido_detalles->photo }}">
                        @endif
                    </div> --}}
                    <form action="{{ route('moto.reiniciar')}}" method="POST">
                        <div class="vstack gap-2">
                            @csrf
                            <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                            <button type="submit" class="btn btn-dark" data-id="{{ $pedido->id }}"><i class="ri-refresh-line me-1"></i>Reiniciar</button>
                        </div>
                    </form>
                </div>
                @endif
                <!-- end card footer -->
            </div>
            <!-- end card -->
        </div>
        @endforeach
    </div>
    </div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
{{-- jQuery UI Sortable --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
{{-- FilePond --}}

<script src="{{ URL::asset('build/libs/filepond/filepond.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
</script>
<script
    src="{{ URL::asset('build/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
</script>
<script
    src="{{ URL::asset('build/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
</script>
<script src="{{ URL::asset('build/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>

<script src="{{ URL::asset('build/js/dev/moto.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
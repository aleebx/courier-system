@extends('layouts.master')
@section('title')
{{ __('Nuevo Negocio') }}
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
        {{ __('Nuevo Negocio') }}
        @endslot
        @slot('title')
        {{ __('Nuevo Negocio') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @dump($errors)
                                <form action="{{ route('negocio.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Datos del Negocio</h4>
                                        </div>
                                        <div class="col-8">
                                            <div class="mb-3">
                                                <div>
                                                    <label for="photo" class="form-label">Logo Negocio</label>
                                                    <input class="form-control" type="file" name="photo">
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="pos" checked>
                                                    <label class="form-check-label" for="pos">¿Acepta el 5% de PoS?</label>
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nombre del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Nombre" name="name" value="{{ old('name') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="name_encargado" class="form-label">Nombre del Encargado del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Encargado del Negocio" name="name_encargado" value="{{ old('name_encargado') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Teléfono del Negocio</label>
                                                <input type="tel" class="form-control" placeholder="Ingresar Teléfono" name="phone" value="{{ old('phone') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Correo del Negocio</label>
                                                <input type="tel" class="form-control" placeholder="Ingresar Correo electronico" name="email" value="{{ old('email') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="type_negocio" class="form-label">Tipo de Negocio</label>
                                                <select name="type_negocio" class="form-select">
                                                    @foreach ($type_negocios as $type_negocio)
                                                        <option value="{{ $type_negocio->id }}">{{ $type_negocio->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="type_document" class="form-label">Tipo de Documento</label>
                                                <select name="type_document" class="form-select">
                                                    @foreach ($type_documents as $type_document)
                                                        <option value="{{ $type_document->id }}">{{ $type_document->abbreviation }} | {{ $type_document->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="document" class="form-label">Documento del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Documento" name="document" value="{{ old('document') }}">
                                            </div>
                                        </div><!--end col-->                              
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="distrito_id" class="form-label">Distrito</label>
                                                <select name="distrito_id" id="distrito_id" class="form-select distrito_idUno">
                                                   <option value="">Selecciona un Distrito</option>
                                                   @foreach ($distritos as $distrito)
                                                        <option value="{{ $distrito->id }}" data-dep="{{ $distrito->departamento_id }}" data-pro="{{ $distrito->provincia_id }}">{{ $distrito->name }}</option>
                                                    @endforeach                                    
                                                </select>
                                                <input type="hidden" name="departamento_id" id="departamento_id" value="">
                                                <input type="hidden" name="provincia_id" id="provincia_id" value="">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-9">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Dirección del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar dirección" name="address" value="{{ old('address') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="coordenate_x" class="form-label">Coordenada X del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Coordenada X del Negocio" name="coordenate_x" value="{{ old('coordenate_x') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="coordenate_y" class="form-label">Coordenada Y del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Coordenada Y del Negocio" name="coordenate_y" value="{{ old('coordenate_y') }}">
                                            </div>
                                        </div><!--end col-->                                                             
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Nuevo negocio</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>
                            </div> <!-- end card-body-->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
    </div> <!-- end row-->
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ URL::asset('build/js/dev/addNegocio.js?v2') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
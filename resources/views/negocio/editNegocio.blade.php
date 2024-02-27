@extends('layouts.master')
@section('title')
{{ __('Editar Negocio')}}
@endsection
@section('css')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Editar Negocio')}}
        @endslot
        @slot('title')
        {{ __('Editar Negocio')}}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @dump($errors)
                                <form action="{{ route('negocio.update', $negocio) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Datos del Negocio</h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3 d-flex justify-items-center">
                                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                    <img src="{{ URL::asset('images/negocios')}}/{{ $negocio->photo }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
                                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                        <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                                <i class="ri-camera-fill"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-8">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nombre del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Nombre" name="name" value="{{ old('name',$negocio->name) }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="name_encargado" class="form-label">Nombre del Encargado del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Encargado del Negocio" name="name_encargado" value="{{ old('name_encargado', $negocio->name_encargado) }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Teléfono del Negocio</label>
                                                <input type="tel" class="form-control" placeholder="Ingresar Teléfono" name="phone" value="{{ old('phone', $negocio->phone) }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Correo del Negocio</label>
                                                <input type="tel" class="form-control" placeholder="Ingresar Correo electronico" name="email" value="{{ old('email', $negocio->email) }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="type_negocio" class="form-label">Tipo de Negocio</label>
                                                <select name="type_negocio" class="form-select">
                                                    @foreach ($type_negocios as $type_negocio)
                                                        <option value="{{ $type_negocio->id }}" @if ($type_negocio->id == $negocio->type_negocio) @selected(true) @endif>{{ $type_negocio->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="type_document" class="form-label">Tipo de Documento</label>
                                                <select name="type_document" class="form-select">
                                                    @foreach ($type_documents as $type_document)
                                                        <option value="{{ $type_document->id }}" @if ($type_document->id == $negocio->type_document) @selected(true) @endif>{{ $type_document->abbreviation }} | {{ $type_document->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="document" class="form-label">Documento del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Documento" name="document" value="{{ old('document', $negocio->document) }}">
                                            </div>
                                        </div><!--end col-->  
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="distrito_id" class="form-label">Distrito</label>
                                                <select name="distrito_id" id="distrito_id" class="form-select">
                                                    @foreach ($distritos as $distrito)
                                                        <option value="{{ $distrito->id }}" @if ($distrito->id == $negocio->id_distrito) @selected(true) @endif>{{ $distrito->name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="departamento_id" id="departamento_id" value="{{ $negocio->departamento_id }}">
                                                <input type="hidden" name="provincia_id" id="provincia_id" value="{{ $negocio->provincia_id }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-9">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Dirección del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar dirección" name="address" value="{{ old('address', $negocio->address) }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="coordenate_x" class="form-label">Coordenada X del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Coordenada X del Negocio" name="coordenate_x" value="{{ old('coordenate_x', $negocio->coordenate_x) }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="coordenate_y" class="form-label">Coordenada Y del Negocio</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Coordenada Y del Negocio" name="coordenate_y" value="{{ old('coordenate_y', $negocio->coordenate_y) }}">
                                            </div>
                                        </div><!--end col-->                                                             
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Editar negocio</button>
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
    <script src="{{ URL::asset('build/js/app.js', $negocio->name) }}"></script>
@endsection
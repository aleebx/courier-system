
@extends('layouts.master')
@section('title')
{{ __('Nuevo Motorizado') }}
@endsection
@section('css')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Nuevo Motorizado') }}
        @endslot
        @slot('title')
        {{ __('Nuevo Motorizado') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @dump($errors)
                                <form action="{{ route('moto.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Datos del Motorizado</h4>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <div>
                                                    <label for="photo" class="form-label">Foto del Motorizado</label>
                                                    <input class="form-control" type="file" name="photo">
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nick del Motorizado</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Nick" name="name" value="{{ old('name') }}" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="namefull" class="form-label">Nombre Completo del Motorizado</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Nombre Completo" name="namefull" value="{{ old('namefull') }}" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Teléfono del Motorizado</label>
                                                <input type="tel" class="form-control" placeholder="Ingresar Teléfono" name="phone" value="{{ old('phone') }}" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Correo del Motorizado</label>
                                                <input type="tel" class="form-control" placeholder="Ingresar Correo electronico" name="email" value="{{ old('email') }}" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="type_document" class="form-label">Tipo de Documento</label>
                                                <select name="type_document" class="form-select" required>
                                                    @foreach ($type_documents as $type_document)
                                                        <option value="{{ $type_document->id }}">{{ $type_document->abbreviation }} | {{ $type_document->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="document" class="form-label">Documento del Motorizado</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Documento" name="document" value="{{ old('document') }}" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <div>
                                                    <label for="photo_document" class="form-label">Foto del Documento</label>
                                                    <input class="form-control" type="file" name="photo_document" required>
                                                </div>
                                            </div>
                                        </div><!--end col-->  
                                        {{-- <div class="col-4">
                                            <div class="mb-3">
                                                <label for="id_departamento" class="form-label">Departamento</label>
                                                <select name="id_departamento" id="id_departamento" class="form-select">
                                                    @foreach ($departamentos as $departamento)
                                                        <option value="{{ $departamento->id }}">{{ $departamento->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="id_provincia" class="form-label">Provincia</label>
                                                <select name="id_provincia" id="id_provincia" class="form-select">
                                                    @foreach ($provincias as $provincia)
                                                        <option value="{{ $provincia->id }}">{{ $provincia->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!--end col--> --}}
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
                                                <label for="address" class="form-label">Dirección del Motorizado</label>
                                                <input type="text" class="form-control" placeholder="Ingresar dirección" name="address" value="{{ old('address') }}" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-12">
                                            <h4>Información de moto</h4>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="brand" class="form-label">Marca</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Marca" name="brand" value="{{ old('brand') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="model" class="form-label">Modelo</label>
                                                <input type="text" class="form-control" placeholder="Ingresar modelo" name="model" value="{{ old('model') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="year" class="form-label">Año</label>
                                                <input type="number" class="form-control" max="2024" onKeyPress="if(this.value.length==4) return false;" placeholder="Ingresar Año" name="year" value="{{ old('year') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="color" class="form-label">Color</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Color" name="color" value="{{ old('color') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-4">
                                                <label for="placa" class="form-label">Placa</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Placa" name="placa" value="{{ old('placa') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="license_expiration" class="form-label">Expiración de Licencia</label>
                                                <input type="date" class="form-control" placeholder="Ingresar Expiración de Licencia" name="license_expiration" value="{{ old('license_expiration') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <div>
                                                    <label for="photo_license" class="form-label">Foto de Licencia</label>
                                                    <input class="form-control" type="file" name="photo_license">
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="soat_expiration" class="form-label">Expiración del SOAT</label>
                                                <input type="date" class="form-control" placeholder="Ingresar Expiración de Licencia" name="soat_expiration" value="{{ old('soat_expiration') }}">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <div>
                                                    <label for="photo_soat" class="form-label">Foto del SOAT</label>
                                                    <input class="form-control" type="file" name="photo_soat">
                                                </div>
                                            </div>
                                        </div><!--end col-->                                       
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Nuevo motorizado</button>
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
    <script src="{{ URL::asset('build/js/dev/addMoto.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
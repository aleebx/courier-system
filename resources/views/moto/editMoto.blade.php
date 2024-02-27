
@extends('layouts.master')
@section('title')
{{ __('Editar Motorizado') }}
@endsection
@section('css')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Editar Motorizado') }}
        @endslot
        @slot('title')
        {{ __('Editar Motorizado') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- @dump($errors) --}}
                                <form action="{{ route('moto.update', $motorizado)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Datos del Motorizado</h4>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                    <img src="{{ URL::asset('images/motorizado')}}/{{ $motorizado->photo }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
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
                                        <div class="col-5">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nick del Motorizado</label>
                                                <input type="text" class="form-control" disabled placeholder="Ingresar Nick" value="{{ $motorizado->user->name }}" name="name">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-5">
                                            <div class="mb-3">
                                                <label for="namefull" class="form-label">Nombre Completo del Motorizado</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Nombre Completo" value="{{ $motorizado->namefull }}" name="namefull">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Teléfono del Motorizado</label>
                                                <input type="tel" class="form-control" placeholder="Ingresar Teléfono" value="{{ $motorizado->phone }}" name="phone">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Correo del Motorizado</label>
                                                <input type="tel" class="form-control"  disabled placeholder="Ingresar Correo electronico" value="{{ $motorizado->user->email }}" name="email">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                    <img src="{{ URL::asset('images/motorizado')}}/{{ $motorizado->photo_document }}" class="shadow img-thumbnail" alt="Foto Documento">
                                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                        <input id="photo_document" name="photo_document" type="file" class="profile-img-file-input">
                                                        <label for="photo_document" class="profile-photo-edit avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                                <i class="ri-camera-fill"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div><!--end col-->  
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="type_document" class="form-label">Tipo de Documento</label>
                                                <select value="{{ $motorizado->type_document }}" name="type_document" class="form-select">
                                                    <option value="1" @if ($motorizado->type_document == 1) @selected(true) @endif>DNI</option>
                                                    <option value="2" @if ($motorizado->type_document == 2) @selected(true) @endif>PTP</option>
                                                    <option value="3" @if ($motorizado->type_document == 3) @selected(true) @endif>PASAPORTE</option>
                                                    <option value="4" @if ($motorizado->type_document == 4) @selected(true) @endif>CARNET DE EXTRANJERIA</option>
                                                </select>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="document" class="form-label">Documento del Motorizado</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Documento" value="{{ $motorizado->document }}" name="document">
                                            </div>
                                        </div><!--end col--> 
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="id_departamento" class="form-label">Departamento</label>
                                                <select value="{{ $motorizado->id_departamento }}" name="id_departamento" id="id_departamento" class="form-select">
                                                    <option value="1" @if ($motorizado->id_departamento == 1) @selected(true) @endif>Lima</option>
                                                    <option value="2" @if ($motorizado->id_departamento == 2) @selected(true) @endif>Callao</option>
                                                </select>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="id_provincia" class="form-label">Provincia</label>
                                                <select value="{{ $motorizado->id_provincia }}" name="id_provincia" id="id_provincia" class="form-select">
                                                    <option value="1" @if ($motorizado->id_provincia == 1) @selected(true) @endif>Lima</option>
                                                    <option value="2" @if ($motorizado->id_provincia == 2) @selected(true) @endif>Callao</option>
                                                </select>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="id_distrito" class="form-label">Distrito</label>
                                                <select value="{{ $motorizado->id_distrito }}" name="id_distrito" id="id_distrito" class="form-select">
                                                    <option value="1" @if ($motorizado->id_distrito == 1) @selected(true) @endif>Lima</option>
                                                    <option value="2" @if ($motorizado->id_distrito == 2) @selected(true) @endif>Callao</option>
                                                </select>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Dirección del Motorizado</label>
                                                <input type="text" class="form-control" placeholder="Ingresar dirección" value="{{ $motorizado->address }}" name="address">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-12">
                                            <h4>Información de moto</h4>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="brand" class="form-label">Marca</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Marca" value="{{ $motorizado->brand }}" name="brand">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="model" class="form-label">Modelo</label>
                                                <input type="text" class="form-control" placeholder="Ingresar modelo" value="{{ $motorizado->model }}" name="model">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="year" class="form-label">Año</label>
                                                <input type="number" class="form-control" max="2024" onKeyPress="if(this.value.length==4) return false;" placeholder="Ingresar Año" value="{{ $motorizado->year }}" name="year">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="color" class="form-label">Color</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Color" value="{{ $motorizado->color }}" name="color">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-4">
                                            <div class="mb-4">
                                                <label for="placa" class="form-label">Placa</label>
                                                <input type="text" class="form-control" placeholder="Ingresar Placa" value="{{ $motorizado->placa }}" name="placa">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                @php
                                                    $license_expiration = date('Y-m-d', strtotime($motorizado->license_expiration));
                                                @endphp
                                                <label for="license_expiration" class="form-label">Expiración de Licencia</label>
                                                <input type="date" class="form-control" placeholder="Ingresar Expiración de Licencia" value="{{ $license_expiration }}" name="license_expiration">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                    <img src="{{ URL::asset('images/motorizado')}}/{{ $motorizado->photo_license }}" class="shadow img-thumbnail" alt="Foto Licencia">
                                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                        <input id="photo_license" name="photo_license" type="file" class="profile-img-file-input">
                                                        <label for="photo_license" class="profile-photo-edit avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                                <i class="ri-camera-fill"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                @php
                                                    $soat_expiration = date('Y-m-d', strtotime($motorizado->soat_expiration));
                                                @endphp
                                                <label for="soat_expiration" class="form-label">Expiración del SOAT</label>
                                                <input type="date" class="form-control" placeholder="Ingresar Expiración de Licencia" value="{{ $soat_expiration }}" name="soat_expiration">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                    <img src="{{ URL::asset('images/motorizado')}}/{{ $motorizado->photo_soat }}" class="shadow img-thumbnail" alt="Foto SOAT">
                                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                        <input id="photo_soat" name="photo_soat" type="file" class="profile-img-file-input">
                                                        <label for="photo_soat" class="profile-photo-edit avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                                <i class="ri-camera-fill"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--end col-->                                       
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Editar motorizado</button>
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

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
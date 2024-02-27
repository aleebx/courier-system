@extends('layouts.master')
@section('title')
{{ __('Roles y RolePermiso') }}
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
        {{ __('Roles y RolePermiso') }}
        @endslot
        @slot('title')
        {{ __('Roles y RolePermiso') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>{{$role->name}}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('roles.update', $role)}}" method="POST">
                                @method('PUT')
                                @csrf
                                @foreach ($permisos as $permiso)
                                <div class="form-check mb-3">
                                    <input class="form-check-input" name="permisos[]" type="checkbox" @if ($role->hasPermissionTo($permiso->id) ? : false) checked @endif id="check{{ $permiso->id }}" value="{{ $permiso->id }}" >
                                    <label class="form-check-label" for="check{{ $permiso->id }}">
                                        {{ $permiso->name }} 
                                    </label>
                                </div>
                                @endforeach
                                <button type="submit" class="btn btn-success waves-effect waves-light">Asignar permisos</button>
                                </form>
                            </div> <!-- end card-body-->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
    </div> <!-- end row-->
    <!-- Default Modals -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Crear nuevo permiso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form action=" {{ route('permisos.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nuevo permiso</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa nuevo permiso">
                        </div>
                        <button type="submit" class="btn btn-primary ">Guardar</button>
                    </form>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('script')
    <!-- datatable js -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- responsive datatable js -->
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <!-- Datatables init -->
    <script>
        $(document).ready(function() {
            $('#tableRolePermiso').DataTable( {
                responsive: true
            } );
        } );
    </script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
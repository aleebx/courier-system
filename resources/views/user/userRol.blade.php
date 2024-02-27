@extends('layouts.master')
@section('title')
{{ __('Permisos de Usuarios') }}
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
        {{ __('Permisos de Usuarios') }}
        @endslot
        @slot('title')
        {{ __('Permisos de Usuarios') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>{{$user->name}}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('asignar.update', $user)}}" method="POST">
                                @method('PUT')
                                @csrf
                                @foreach ($roles as $role)
                                <div class="form-check mb-3">
                                    <input class="form-check-input" name="roles[]" type="checkbox" @if ($user->hasAnyRole($role->id) ? : false) checked @endif id="check{{ $role->id }}" value="{{ $role->id }}" >
                                    <label class="form-check-label" for="check{{ $role->id }}">
                                        {{ $role->name }} 
                                    </label>
                                </div>
                                @endforeach
                                <button type="submit" class="btn btn-success waves-effect waves-light">Asignar roles</button>
                                </form>
                            </div> <!-- end card-body-->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
    </div> <!-- end row-->
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
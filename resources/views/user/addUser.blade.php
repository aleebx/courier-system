@extends('layouts.master')
@section('title')
{{ __('Nuevo Usuario') }}
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
        {{ __('Nuevo Usuario') }}
        @endslot
        @slot('title')
        {{ __('Nuevo Usuario') }}
        @endslot
    @endcomponent

    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="needs-validation" novalidate method="POST" action="{{ route('register2') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" id="email" name="email"
                                            placeholder="Enter email address" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="invalid-feedback">
                                            {{ __('Please enter email') }}
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">{{ __('Username') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" name="name" placeholder="Enter username" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="invalid-feedback">
                                            {{ __('Please enter username') }}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">{{ __('Password') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="password" name="password" placeholder="Enter password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="invalid-feedback">
                                            {{ __('Please enter password') }}
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" id="password_confirmation" name="password_confirmation"
                                            placeholder="Enter Confirm Password" required>
                                    </div>

                                    @foreach ($roles as $role)
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" name="roles[]" type="checkbox" id="check{{ $role->id }}" value="{{ $role->id }}" >
                                            <label class="form-check-label" for="check{{ $role->id }}">
                                                {{ $role->name }} 
                                            </label>
                                        </div>
                                    @endforeach

                                    <div class="mt-3">
                                        <button class="btn btn-success w-100" type="submit">{{ __('Register') }}</button>
                                    </div>
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
            $('#tableNuevo Usuario').DataTable( {
                responsive: true
            } );
        } );
    </script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
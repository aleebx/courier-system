@extends('layouts.master')
@section('title')
{{ __('Dashboards') }}
@endsection
@section('css')

    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet">

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Dashboards') }}
        @endslot
        @slot('title')
        {{ __('Dashboards') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xxl-5">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                 @if(is_null(Auth::user()->email_verified_at))
                                <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center"
                                    role="alert">
                                    <i data-feather="alert-triangle" class="text-warning me-2 icon-sm"></i>
                                    <div class="flex-grow-1 text-truncate">
                                        Por favor verifica tu correo electronico <b>{{Auth::user()->email}}</b> <a href="verify-email">has click aquí</a>
                                    </div>
                                </div>
                                @endif
                            </div> <!-- end card-body-->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
        </div> <!-- end col-->
    </div> <!-- end row-->
@endsection
@section('script')
    <!-- apexcharts -->
    {{-- <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script> --}}

    <!-- dashboard init -->
    <script src="{{ URL::asset('build/js/pages/dashboard-analytics.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection


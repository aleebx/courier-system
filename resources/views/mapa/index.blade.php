@extends('layouts.master')
@section('title')
{{ __('Map') }}
@endsection
@section('css')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://use.fontawesome.com/releases/v6.2.0/js/all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/togeojson/0.16.0/togeojson.min.js"></script>
<style>
    /* HTML marker styles */
.price-tag {
  background-color: #00e400ce;
  border-radius: 8px;
  color: #000000;
  font-size: 14px;
  padding: 10px 15px;
  position: relative;
}

.price-tag::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 100%;
  transform: translate(-50%, 0);
  width: 0;
  height: 0;
  border-left: 8px solid transparent;
  border-right: 8px solid transparent;
  border-top: 8px solid #f44242;
}
</style>


@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        {{ __('Map') }}
        @endslot
        @slot('title')
        {{ __('Map') }}
        @endslot
    @endcomponent
       
    <div class="row">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body"><div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="address" placeholder="Dirección">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitud</label>
                                        <input type="text" class="form-control" id="lat" placeholder="Latitud">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitud</label>
                                        <input type="text" class="form-control" id="lng" placeholder="Longitud">
                                    </div>
                                </div>
                                {{-- <div class="col-2">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" id="loadCoo">Cargar</button>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div id="map" class="gmaps"></div>
                                    </div>
                                </div>
                            </div> <!-- end card-body-->
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
    </div> <!-- end row-->
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&libraries=marker&libraries=places&v=beta" defer></script>
    {{-- <script src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}"></script> --}}
    <script src="{{ URL::asset('build/js/pages/gmaps.init.js') }}"></script>
    <script src="{{ URL::asset('build/libs/gmaps/gmaps.min.js') }}"></script>
    {{-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script> --}}
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
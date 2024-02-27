@extends('layouts.master-without-nav')
@section('title')
    @lang('translation.verify-email')
@endsection
@section('content')
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index" class="d-inline-block auth-logo">
                                    {{-- <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="20"> --}}
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium"></p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Verificar correo electronico</h5>
                                    <p>Gracias por registrarte! Antes de comenzar, ¿podría verificar su dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar por correo electrónico? Si no recibió el correo electrónico, con gusto le enviaremos otro.</p>
                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop"
                                        colors="primary:#0ab39c" class="avatar-xl">
                                    </lord-icon>

                                </div>

                                @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-borderless alert-success text-center mb-2 mx-2" role="alert">
                                    Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro.
                                </div>
                                @endif
                                <div class="p-2">
                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf
                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" type="submit">Verificar correo electronico</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                                <div class="p-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <div class="text-center mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Cerrar sesión</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Velzon. Crafted with <i
                                    class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
@endsection
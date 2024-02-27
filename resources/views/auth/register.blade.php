@extends('layouts.master-without-nav')
@section('title')
{{ __('Register') }}
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
                                <a href="/" class="d-inline-block auth-logo">
                                    <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="50">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">{{ __('Admin & Dashboard') }}</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">{{ __('Create New Account') }}</h5>
                                    <p class="text-muted">{{ __('Get your free velzon account now') }}</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
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

                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <p class="mb-0 fs-12 text-muted fst-italic">{{ __('By registering you agree to the Dinsides Courier') }} <a href="#"
                                                    class="text-primary text-decoration-underline fst-normal fw-medium">{{ __('Terms of Use') }}</a></p>
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-success w-100" type="submit">{{ __('Register') }}</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">{{ __('Already have an account?') }} <a href="{{ route('login') }}"
                                    class="fw-semibold text-primary text-decoration-underline"> {{ __('Login') }}</a> </p>
                        </div>

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
    <script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>
@endsection
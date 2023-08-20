<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<head>

    <meta charset="utf-8" />
    <title>Sign In | {{@$setting_data->website_name}} - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@if(!empty(@$setting_data->website_description)) {{ucwords(@$setting_data->website_description)}} @else Canosoft Technology. Lets make IT happen. @endif">
    <meta name="author" content="Canosoft Technology" />
    <!-- App favicon -->
    <link rel="shortcut icon" type="image/x-icon"  href="<?php if(@$setting_data->favicon){?>{{asset('/images/uploads/settings/'.@$setting_data->favicon)}}<?php }else{ echo "assets/backend/images/canosoft-favicon.png"; }?>">
    <link rel="canonical" href="https://www.canosoft.com.np/" />

    <!-- Layout config Js -->
    <script src="{{asset('assets/backend/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/backend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/backend/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/backend/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('assets/backend/css/custom.min.css')}}" rel="stylesheet" type="text/css" />


</head>

<body>

<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
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
                                <img src="<?php if(@$setting_data->logo_white){?>{{asset('/images/settings/'.@$setting_data->logo_white)}}<?php }else{ echo 'assets/backend/images/canosoft-logo.png'; }?>" alt="Logo" height="80">
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium">Admin Dashboard Access</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to dashboard.</p>
                            </div>
                            @error('email')
                            <div class="alert alert-warning alert-border-left alert-dismissible fade show" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle text-warning me-2 icon-sm"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>

                                <strong> {{$message}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            @if(session('error'))
                                <div class="alert alert-warning alert-border-left alert-dismissible fade show" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle text-warning me-2 icon-sm"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>

                                    <strong> {{session('error')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="p-2 mt-2">
                                <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation"  novalidate="">
                                    @csrf

                                    <div class="mb-3 position-relative">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email" required autocomplete="email" autofocus >
                                        <div class="invalid-tooltip">
                                            Please enter a valid email.
                                        </div>
                                    </div>
                                    <div class="mb-2 position-relative">
                                        @if (Route::has('password.change'))
                                            <div class="float-end">
                                                <a href="{{ route('password.change') }}" class="text-muted">{{ __('Forgot Password?') }}</a>
                                            </div>
                                        @endif
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-2">
                                            <input type="password" class="form-control pe-5" placeholder="Enter password" id="password-input" name="password" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            <div class="invalid-tooltip">
                                                Please enter a valid password.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">{{ __('Sign In') }}</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> Crafted with <i class="mdi mdi-heart text-danger"></i> by Canosoft Technology</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

<script src="{{asset('assets/backend/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/backend/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/backend/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/backend/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/backend/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('assets/backend/js/plugins.js')}}"></script>


<script src="{{asset('assets/backend/libs/particles.js/particles.js')}}"></script>

<script src="{{asset('assets/backend/js/pages/particles.app.js')}}"></script>
<!-- password-addon init -->
<script src="{{asset('assets/backend/js/pages/password-addon.init.js')}}"></script>

<!-- prismjs plugin -->
<script src="{{asset('assets/backend/libs/prismjs/prism.js')}}"></script>

<script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>


<script src="{{asset('assets/backend/js/app.js')}}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Workcheck</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico')}}">

        <!-- App css -->
        <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-primary-subtle">
        <!-- Begin page -->
        <div class="account-page">
            <div class="container-fluid p-0">
                <div class="row align-items-center g-0">

                    <div class="col-xl-5">
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <div class="card p-3 mb-0">
                                    <div class="card-body">

                                        <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                                            <div class="mb-4 p-0 text-center">
                                                <a href="index.html" class="auth-logo">
                                                    {{-- <img src="{{asset('admin/assets/images/logo-dark.png')}}" alt="logo-dark" class="mx-auto" height="28" /> --}}
                                                </a>
                                            </div>

                                            <div class="auth-title-section mb-3 text-center"> 
                                                <h3 class="text-dark fs-20 fw-medium mb-2">Welcome back</h3>
                                                <p class="text-dark text-capitalize fs-14 mb-0">Sign in to continue to smart absen.</p>
                                            </div>

                                             <form method="POST" action="{{ route('login')}}" class="my-4">
                                                @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="email" class="form-label @error('email') is-invalid @enderror ">Email address</label>
                                                        <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror"  
                                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                        
                                                    <div class="form-group mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" 
                                                        required autocomplete="current-password">

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                        
                                                    <div class="form-group d-flex mb-3">
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 text-end">
                                                            <a class='text-muted fs-14' href='auth-recoverpw.html'>Forgot password?</a>                             
                                                        </div>
                                                    </div>
                                        <div class="form-group mb-0 row">
                                                        <div class="col-12">
                                                            <div class="d-grid">
                                                                <button class="btn btn-primary" type="submit"> Log In </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                    </form>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-7">
                        <div class="account-page-bg p-md-5 p-4">
                            <div class="text-center">
                                <div class="auth-image">
                                    <img src="{{asset('admin/assets/images/auth-images.svg')}}" class="mx-auto img-fluid"  alt="images">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <!-- END wrapper -->

        <!-- Vendor -->
        <script src="{{('admin/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{('admin/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{('admin/assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
        <script src="{{('admin/assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
        <script src="{{('admin/assets/libs/feather-icons/feather.min.js')}}"></script>

        <!-- App js-->
        <script src="{{('admin/assets/js/app.js')}}"></script>
        
    </body>
</html>
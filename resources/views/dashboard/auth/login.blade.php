<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('assets/plugins/toastr/toastr.min.css')}}">
    <style>
            .login-page {
            background-image: url('https://www.coworker.com/mag/wp-content/uploads/2017/10/NEST-@-TRYP-hotel-1280x640.jpg');
            background-size: cover;
            background-position: center;
            }
    </style>

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Hubs</b>System</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                        @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fas fa-ban"></i>
                        <span>Login Failed:</span>
                        <span>Your Email or password is incorrect!</span>
                    </div>
                     @endif
                <form action="{{route('cms.login')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" id="email" value="{{old('email')}}" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required
                            id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <p class="mb-1">
                        <a href="{{route('password.request')}}">I forgot my password</a>
                    </p>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        {{-- <script src="{{asset('js/axios.js')}}"></script> --}}
        <!-- Toastr -->
        <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>

        <script>
            function performLogin(){
                axios.post('/cms/login', {
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    remember: document.getElementById('remember').checked,
                })
                .then(function(response) {  
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/cms/admin/';
                })
                .catch(function(error) {
                    console.log(error.response);    
                    toastr.error(error.response.data.message);
                });
    }
        </script>
    </body>

    </html>
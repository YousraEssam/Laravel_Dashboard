<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Register</title>

    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">IN+</h1>

            </div>
            <h3>{{ __('Register to IN+') }}</h3>
            <p>Create account to see it in action.</p>
            <form class="m-t" role="form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" 
                        placeholder="First Name" value="{{ old('first_name') }}" required="" autocomplete="first_name" autofocus>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                        placeholder="Last Name" value="{{ old('last_name') }}" required="" autocomplete="last_name" autofocus>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                     placeholder="Email" value="{{ old('email') }}" required="" autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="tel" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" 
                    placeholder="Phone Number" value="{{ old('phone_number') }}" required="" autocomplete="phone_number" autofocus>
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror   
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" value="{{ old('password') }}" required="" autocomplete="password" autofocus>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror   
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control"
                    placeholder="Confirm Password" required="" autocomplete="new-password" autofocus>
                </div>
                <div class="form-group">
                    <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">{{ __('Register') }}</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('theme/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('theme/js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>

@extends('layouts.basic')

@section('recaptcha')
{!! htmlScriptTagJsApi() !!}
@endsection

@section('content')

    <h3>Welcome to IN+</h3>
    <p>{{ __('Login') }}</p>

    <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Email or Phone Number" name="email" required="" autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Password" name="password" required="" autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    {!! htmlFormSnippet() !!}
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary block full-width m-b">{{ __('Login') }}</button>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}"><small>  {{ __('Forgot Your Password?') }}</small></a>
        @endif
        <p class="text-muted text-center"><small>Do not have an account?</small></p>
        <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">{{ __('Create an account') }}</a>

    </form>
    <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
@endsection

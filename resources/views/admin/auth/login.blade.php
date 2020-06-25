@extends('admin.layouts.app')

@section('title', 'E-SHOP - Admin Login')

@section('content')

<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">{{ __('E-SHOP') }} <span class="tx-info tx-normal">{{ __('ADMIN') }}</span></div>
        <div class="tx-center mg-b-60">Enter your Email and Password for login</div>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div><!-- form-group -->

            <div class="form-group">
                <input  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter your password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group mt-3">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="pb-0" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                @if (Route::has('password.request'))
                <a href="{{ route('admin.password.request') }}" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
                @endif
            </div><!-- form-group -->

            <button type="submit" class="btn btn-info btn-block">Sign In</button>
        </form>
    </div><!-- login-wrapper -->
</div><!-- d-flex -->
@endsection

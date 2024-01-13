@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
    <section id="login">
        <div class="login-container container bg-white rounded-3 p-sm-3">
            <h3 class="login-title">Login</h3>
            <div class="login-form-container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="sec-mail inpt-flid">
                        <label class="login-label-mail" for="email">Email</label>
                        <input class="w-100 rounded p-2 border login-mail @error('email') is-invalid @enderror" type="email" id="email"
                            name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email"
                            autofocus />
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inpt-flid-pws">
                        <label class="login-password-mail" for="password">Password</label>
                        <div class="d-flex border rounded login-password-flex">
                            <input id="passInput" class="w-100 rounded p-2 border-0 login-password @error('password') is-invalid @enderror"
                                type="password" name="password" placeholder="Password" required
                                autocomplete="current-password" />
                            <span id="btn-show" class="btn-show">Show</span>
                        </div>
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn-login-page">Login</button>
                </form>
                @if (Route::has('password.request'))
                    <a class="forgot-password-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                @endif
                <p class="open-account">Don't have an account yet? <a class="sign-up"
                        href="{{ route('register') }}">Register</a></p>
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
@endsection

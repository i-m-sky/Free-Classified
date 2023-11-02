@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
    <section class="section-forgot-password">
        <div class="forgot-bg-color">
            <div class="form-container">
                <h4>Forgotten Password</h4>
                <p>Please enter your registered email address</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-rest-password">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="sec-mail inpt-flid">
                            <label class="email-label" for="email">Email</label>
                            <input type="email" id="email" placeholder="Email"
                                class="mail-input-field  @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn-reset">Reset Password</button>
                    </form>
                </div>
                <a href="{{ route('login') }}" class="cancel">Cancel</a>
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
@endsection

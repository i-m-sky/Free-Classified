@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
    <section class="section-forgot-password">
        <div class="forgot-bg-color">
            <div class="form-container">
                <h4>Reset Password</h4>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-rest-password">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->token }}">
                        <label class="email-label" for="email">Email</label>
                        <input type="email" id="email" placeholder="Email"
                            class="mail-input-field  @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        <label class="email-label" for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="mail-input-field @error('password') is-invalid @enderror" autocomplete="new-password"
                            required>
                        <div class="error">Error Message</div>
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        <label class="email-label" for="password-confirm">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password-confirm"
                            placeholder="Confirm Password" class="mail-input-field  @error('password') is-invalid @enderror"
                            autocomplete="new-password" required>
                        <button type="submit" class="btn-reset">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
@endsection

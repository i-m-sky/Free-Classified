@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
    <section class="section-forgot-password">
        <div class="forgot-bg-color">
            <div class="form-container">
                <h4>Verify Your Email Address</h4>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        @if (session('status') == 'verification-link-sent')
                            Verification link sent in your email Id, Please check your email.
                        @else
                            {{ session('status') }}
                        @endif
                    </div>
                @endif
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-reset">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
@endsection

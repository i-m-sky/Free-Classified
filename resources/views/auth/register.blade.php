@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
    <section class="section-loging-page">
        <div class="ragister-container">
            <h3 class="login-title">Register</h3>
            <div class="register-form-container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="sec-mail inpt-flid">
                        <label class="login-label-mail" for="name">User Name</label>
                        <input class="login-mail @error('name') is-invalid @enderror" type="text" name="name"
                            id="name" placeholder="Username" autocomplete="name" autofocus
                            value="{{ old('name') }}" />
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sec-mail inpt-flid">
                        <label class="login-label-mail" for="email">Email</label>
                        <input class="login-mail @error('email') is-invalid @enderror" type="email" name="email"
                            id="email" placeholder="Email" autocomplete="email" value="{{ old('email') }}" />
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sec-mail inpt-flid">
                        <label class="login-label-mail" for="phone">Phone <span class="optional-color">( Optional
                                )</span></label>
                        <div class="login-phone-box d-flex">
                            <span  style="width: 60px;height: 42px;" class="border d-flex align-items-center justify-content-center">+91</span>
                            <input class="login-mail" type="number"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1').slice(0, 10);" maxlength="10" placeholder="Phone Number" name="phone"
                            value="{{ old('phone') }}" />
                            @error('phone')
                        </div>        
                            <div class="error" style="bottom: 0;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="pws-strength">
                        <label class="login-password-mail" for="password">Password</label>
                        <div class="login-password-flex">
                            <input id="passInput" class="login-password @error('password') is-invalid @enderror"
                                type="password" name="password" placeholder="Password" autocomplete="new-password"
                                wire:model="password" />
                            <span id="btn-show" class="btn-show">Show</span>
                        </div>
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        <div class="password-strength" id="password-strength" style="display: none">
                            <p>Required</p>
                            <ul class="password-strength">
                                <li class="" id="password-length">Atleast 8 characters</li>
                                <li class="" id="password-capital">1 Uppercase character</li>
                                <li class="" id="password-small">1 Lowercase character</li>
                                <li class="" id="password-symbol"> 1 Symbol</li>
                                <li class="" id="password-number">1 Number</li>
                            </ul>
                        </div>

                    </div>
                    <div class="sec-mail inpt-flid-pws">
                        <label class="login-label-mail mt-3" for="password-confirm">Confirm Password</label>
                        <div class="login-password-flex">
                        <input type="password"  name="password_confirmation" id="password-confirm"
                            placeholder="Confirm Password" style="border: none;" class="login-mail mb-0  @error('password') is-invalid @enderror"
                            autocomplete="new-password"/>
                            <!-- <span id="btn-show" style="min-width: 63px;" class="btn-show">Show</span> -->
                        </div>

                        @error('password_confirmation')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="allow-term-condition">
                        <input class="check-box" type="checkbox" name="tnc" id="tnc" value="1"
                            {{ old('tnc') ? 'checked' : '' }} @error('tnc') is-invalid @enderror /><span>I have ready the
                            <a href="{{ route('terms-condition') }}" target="_blank">Terms &
                                Condtion</a> of use and <a href="{{ route('privacy-policy') }}" target="_blank"> privacy
                                policy</a> and
                            hereby authorize the
                            proessing of my personal data for the purness of providing this web service.</span>
                    </div>
                    @error('tnc')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn-login-page btn-register">REGISTER NOW</button>
                </form>
                <div class="aur">----------------------OR----------------------</div>
                <p class="open-account">Already registred? <a class="sign-up" href="{{ route('login') }}">Sign in!</a></p>
            </div>

        </div>
    </section>
@endsection
@section('bodyend')
@endsection

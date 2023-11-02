<div class="custom-pop">
    <div class="form-popup">
        <button type="button" class="back-btn closeotp-btn"
            wire:click.prevent="$emit('openModal', 'modals.phone-number-verify')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="30px" height="30px">
                <path fill-rule="evenodd"
                    d="M11.03 3.97a.75.75 0 010 1.06l-6.22 6.22H21a.75.75 0 010 1.5H4.81l6.22 6.22a.75.75 0 11-1.06 1.06l-7.5-7.5a.75.75 0 010-1.06l7.5-7.5a.75.75 0 011.06 0z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        <form class="form-container  ver_size" method="post" wire:submit.prevent="verifyOtp">
            <h2>Enter verification code</h2>
            <h3>Please enter the OTP sent to {{ $phone }} 
                <div class="d-flex W_90 justify-content-end "> <a href="#"
                    wire:click.prevent="$emit('openModal', 'modals.phone-number-verify')">Change</a></div></h3>
                <div class="dash-fields-container">
                    <input type="text" class="dash-inputfields onlyNumber popup_input_feild W_90 ml-1" wire:model.defer="otp"
                        id="otp" maxlength="6" minlength="6" placeholder="Verification code" />
                    @error('otp')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    @if(!empty($errorMessage))
                    <div class="error">{{ $errorMessage }}</div>
                    @endif
                </div>
                <button type="submit" class="btn-dash-submit popup_submit">Continue</button>
                <div class="resend_link mb-4">
                    <a href="#" wire:click.prevent="resendOTP">Resend OTP</a>
                </div>
        </form>
    </div>
</div>

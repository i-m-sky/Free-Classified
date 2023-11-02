<div class="custom-pop">
    <div class="form-popup">
        <button type="button" class="close-btn closePhone-btn" wire:click="closeAllModal">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                width="30px" height="30px">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <form class="form-container" method="post" wire:submit.prevent="updatePhoneNumber">
            <h2>Enter your phone number to get verified</h2>
            <div class="confimation">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#00242f" width="10px"
                    height="10px">
                    <path fill-rule="evenodd"
                        d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                        clip-rule="evenodd" />
                </svg>

                <h3>We will send a confimation code to your number</h3>
            </div>
            <div class="dash-fields-container">
                <div class="common_input password_input popup_input">
                    <span>+91</span>
                    <input type="text" class="dash-inputfields onlyNumber popup_input_feild" wire:model.defer="phone"
                        id="phone" maxlength="10" minlength="10" placeholder="Mobile Number"/>
                    @error('phone')
                        <div class="error error-phone-opt">{{ $message }}</div>
                    @enderror
                    @if(!empty($errorMessage))
                    <div class="error error-phone-opt">{{ $errorMessage }}</div>
                    @endif
                </div>
                <p class="phone-opt-p">The phone number you provide here is only used to verify. we never use it shared with extemal parties
                </p>
            </div>
            <button type="submit" class="btn-dash-submit popup_submit mb-3">Continue</button>
        </form>
    </div>
</div>

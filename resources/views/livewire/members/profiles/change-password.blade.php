<div class="rst-passwd-details">
    <p class="reset-heading">Reset Password</p>
    <form method="post" wire:submit.prevent="update()">
        @if ($isSuccess == true)
            Your password has been updated successfully.
        @endif
        <div class="dash-fields-container">
            <label for="current_password" class="dash-labels">Current Password</label>
            <div class="common_input">
                <input type="{{ $isVisibleCPassword == true ? 'text' : 'password' }}" class="dash-inputfields"
                    class="form-control @error('current_password') is-invalid @enderror" id="password" maxlength="125"
                    wire:model="current_password">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" width="16px" height="16px" wire:click="toggleVisibleCPassword()">
                    @if ($isVisibleCPassword == true)
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    @endif
                </svg>
            </div>
            @error('current_password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="dash-fields-container">
            <label for="password" class="dash-labels">New Password</label>
            <div class="common_input">
                <input type="{{ $isVisibleNPassword == true ? 'text' : 'password' }}"
                    class="dash-inputfields @error('password') is-invalid @enderror" id="password" maxlength="125"
                    wire:model="password">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" width="16px" height="16px" wire:click="toggleVisibleNPassword()">
                    @if ($isVisibleNPassword == true)
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    @endif
                </svg>
            </div>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="dash-fields-container">
            <label for="password-confirmation" class="dash-labels">Confirm Password</label>
            <div class="common_input">
                <input type="{{ $isVisibleCFPassword == true ? 'text' : 'password' }}"
                    class="dash-inputfields  @error('password_confirmation') is-invalid @enderror"
                    id="password-confirmation" maxlength="125" wire:model="password_confirmation">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" width="16px" height="16px" wire:click="toggleVisibleCFPassword()">
                    @if ($isVisibleCFPassword == true)
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    @endif
                </svg>
            </div>
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn-dash-submit">Submit</button>
    </form>
</div>

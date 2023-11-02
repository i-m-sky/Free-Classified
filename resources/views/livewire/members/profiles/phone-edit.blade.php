<div class="dash-fields-container verify-number">
    <label for="#" class="dash-labels label-margin">Phone
        Number</label>
    <div class="common_input password_input">
        <span>+91</span>
        <input type="text" class="dash-inputfields input-width phone-num-input onlyNumber" wire:model.defer="phone"
            id="phone" readonly wire:click="$emit('openModal', 'modals.phone-number-verify')" />
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            width="16px" height="16px">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>
    </div>
    @if ($isVissibleVerified == true)
    <span class="check-icon {{ empty($phoneVerifiedAt) ? 'span-red' : '' }}">{!! !empty($phoneVerifiedAt)
        ? '<i class="fa fa-check" aria-hidden="true"></i>'
        : '<i class="fa fa-close" aria-hidden="true"></i>' !!}</span>
    <span
        class="verified-text {{ !empty($phoneVerifiedAt) ? 'span-red' : '' }}">{{ !empty($phoneVerifiedAt) ? 'Verified' : 'Unverified' }}</span>
    @endif
    @error('phone')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div>
    <a href="#" wire:click.prevent='$emit("openModal", "modals.my-account-delete-confirmation")'  class="deleteAccount mb-3">Delete Account</a>

</div>
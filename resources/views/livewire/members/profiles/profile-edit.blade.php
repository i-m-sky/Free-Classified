<form method="post" wire:submit.prevent="updateProfile()">
    @if ($isSuccess == true)
        Your profile has been updated successfully.
    @endif
    <div class="dash-fields-container">
        <label for="name" class="dash-labels">Name</label>
        <input type="text" class="dash-inputfields input-width  @error('name') is-invalid @enderror"
            wire:model.defer="name" maxlength="50">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="dash-fields-container">
        <label for="email" class="dash-labels label-margin">Email</label>
        <input type="email" class="my_Width dash-inputfields  @error('email') is-invalid @enderror"
            wire:model.defer="email">
        <span class="check-icon {{ empty($emailVerifiedAt) ? 'span-red' : '' }}">{!! !empty($emailVerifiedAt)
            ? '<i class="fa fa-check" aria-hidden="true"></i>'
            : '<i class="fa fa-close" aria-hidden="true"></i>' !!}</span>
        <span
            class="verified-text {{ !empty($emailVerifiedAt) ? 'span-red' : '' }}">{{ !empty($emailVerifiedAt) ? 'Verified' : 'Unverified' }}</span>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    @php $locationMessage = ''; @endphp
    @error('location')
        @php $locationMessage = $message;  @endphp
    @enderror
    @error('locationType')
        @php $locationMessage = $message; @endphp
    @enderror
    @error('locationId')
        @php $locationMessage = $message; @endphp
    @enderror
    <div class="dash-fields-container">
        <label for="#" class="dash-labels">Location</label>
        <input type="text" class="dash-inputfields input-width  @if (!empty($locationMessage)) is-invalid @endif "
            wire:model.defer="location" id="search-box-post">
        <div class="search-loc" id="suggesstion-box"></div>
        @if (!empty($locationMessage))
            <div class="error">{{ $locationMessage }}</div>
        @endif
    </div>
    <div class="dash-fields-container">
        <label for="#" class="dash-labels">Information About Yourself</label>
        <textarea class="dash-text-area input-width @error('about') is-invalid @enderror" cols="45" rows="4"
            wire:model.defer="about"></textarea>
        @error('about')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn-dash-submit submit-active">Submit</button>
</form>
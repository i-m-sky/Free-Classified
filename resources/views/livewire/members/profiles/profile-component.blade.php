<div class="bg-color-form">
    <livewire:members.profiles.header key="header-{{ now()->timestamp }}" />
    <div class="form-main-container">
        <div class="form-container-flex">
            <div class="form-right-side">
                <div id="mobile-view">
                    <livewire:members.profiles.profile-image key="profile-image-{{ now()->timestamp }}" />
                </div>
                <div class="right-input-fields">
                    <livewire:members.profiles.profile-edit key="profile-edit-{{ now()->timestamp }}" />
                    <livewire:members.profiles.phone-edit key="phone-edit-{{ now()->timestamp }}" />
                </div>
            </div>
            <div class="form-left-side">
                <div id="non-mobile-view">
                    <livewire:members.profiles.profile-image key="profile-image-{{ now()->timestamp }}" />
                </div>
                <livewire:members.profiles.change-password key="change-password-{{ now()->timestamp }}" />
            </div>
        </div>
    </div>
</div>
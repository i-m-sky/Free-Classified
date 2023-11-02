<div class="digital-plannner">
    <div class="header-dashboard">
        <span class="user-icon">
            <div class="file-upload-icon-circle">
                <img src="{{ config('global_variables.asset_url') }}{{ isset($user) && !empty($user) && !empty($user->photo) ? '/storage/cms/userprofile/' . $user->photo : '' }}"
                    onerror="this.src='/img/user-upload.png'"
                    alt="{{ isset($user) && !empty($user) && !empty($user->name) ? $user->name : '' }}" />
            </div>
        </span>
        <div class="profile_detail">
            <h6>{{ $user->name }}</h6>
            <div>
                <span>
                    <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </span>
                <p>{{ date('F j, Y', strtotime($user->created_at)) }}</p>
            </div>
        </div>
    </div>
</div>

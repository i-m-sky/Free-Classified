<div class="upload-box">
    <div class="upload-image"> {{-- fileupload --}}
        <div class="main-area__content__top__game__info__detail__inner">
            <div class="rate__chat rate__chat--js">
                <svg class="circle-chart" viewbox="0 0 33.83098862 33.83098862" width="250" height="250"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle class="circle-chart__background" stroke-width="3" fill="none" cx="16.91549431"
                        cy="17.91549431" r="13.91549431" />
                    {{-- stroke="#00D0FD" --}}
                    <circle class="circle-chart__circle" stroke="" stroke-width="3" stroke-dasharray="25,90"
                        stroke-linecap="round" fill="none" cx="15.91549431" cy="16.91549431" r="14.91549431" />
                </svg>
                <g class="circle-chart__info rate__chat__info">
                    {{-- <img src="placeholder.jpg" /> --}}
                    <img src="{{ config('global_variables.asset_url') }}{{ isset($user) && !empty($user) && !empty($user->photo) ? '/storage/cms/userprofile/' . $user->photo : '' }}"
                        onerror="this.src='{{ config('global_variables.asset_url') }}/img/placeholder.jpg'"
                        class="img-circle" alt="{{ Auth::user()->name }}" />
                </g>

                {{-- fileupload --}}
                <div class="img__upload fileupload">
                    <a href="javascript::void(0)" class="d-flex align-center" id="channel-user-profile-img-a"
                        title="Upload(Dimension 150 x 150)/File size allowed upto 5MB">
                        <img src="{{ config('global_variables.asset_url') }}/img/file.svg" />
                    </a>
                    <input id="user-file-upload" type="file" accept=" image/jpeg, image/png" style="display: none;">
                </div>
            </div>
        </div>
    </div>
    <!-- <a href="{{ route('user-profile', ['userId' => Auth::id()]) }}" class="view-profile">View my profile</a> -->
    <a href="javascript::void(0)" class="profile_upload_btn" id="profile_upload_btn">Upload</a>
    <!-- <a href="{{ route('remove-user-profie-image')}}" class="Remove-btn" id="Remove-btn">Remove</a> -->
    <a href="#" onclick="event.preventDefault(); document.getElementById('remove-form').submit();" class="Remove-btn justify-content-center d-flex">Remove</a>

    <form id="remove-form" action="{{ route('remove-user-profie-image') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
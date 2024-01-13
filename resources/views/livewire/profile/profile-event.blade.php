@php
    $postUrl = Request::url(); 
    $facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=".$postUrl;
    $twitterUrl = "http://twitter.com/share?url=".$postUrl;
    $emailUrl = "mailto:?subject=adpost.me&amp;&body=".$postUrl;
    $whatsappUrl = "whatsapp://send?text=".$postUrl;
@endphp    
    
<div class="">
    <div class="contact-person-flex pb-3"><a href="#">
            <div class="contact-person-details">
                <div class="user-icon-profile-icn"><img class="login-img-pro"
                        src="{{ config('global_variables.asset_url') }}{{ isset($user) && !empty($user) && !empty($user['photo']) ? '/storage/cms/userprofile/' . $user['photo'] : '' }}"
                        onerror="this.src='{{ config('global_variables.asset_url') }}/img/user-upload.png'"
                        alt="{{ isset($user) && !empty($user) && !empty($user['name']) ? $user['name'] : '' }}"></div>
                <div class="contact-person-info">
                    <h5>{{ $user['name'] }}</h5>
                    <p>Member Since {{ date('F j, Y', strtotime($user['created_at'])) }}</p>
                </div>
            </div>
        </a>
    </div>
    <div class="d-flex justify-content-between py-4 border-bottom-sty">
        <div class="social-link">
            <!-- <ul>
                <li>Share:</li>
                <li>
                    {{-- <div class="sharethis-inline-share-buttons"></div> --}}
                    <div class="button share-button facebook-share-button">share</div>
                    <div class="button share-button twitter-share-button">tweet</div>
                </li>
            </ul> -->

            <ul>
                <li>Share:</li>
                <li><a href="{{$facebookUrl}}" class="facebook-bg-color" target="_blank"><i class="fa fa-facebook"
                            aria-hidden="true"></i></a></li>
                <li><a href="{{$twitterUrl}}" class="twitter-bg-color" target="_blank"><i class="fa fa-twitter"
                            aria-hidden="true"></i></a></li>
                <li><a href="{{$whatsappUrl}}" class="whatsapp-bg-color" data-action="share/whatsapp/share"
                        target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                <li><a href="{{$emailUrl}}" class="envelope-bg-color" target="_blank"><i
                            class="fa-solid fa-envelope"></i></a></li>
            </ul>
        </div>
        @if (Auth::check())
        <button wire:click="$emit('openModal', 'modals.report-user', {{ json_encode(['user' => $user]) }})"
            class="btn-reportad">Report User</button>
        @else
        <a href="{{ route('login') }}" class="report-add-a"><button type="button" class="btn-reportad">Report
                User</button></a>
        @endif
    </div>
    @if (isset($user['phone']) &&
    !empty($user['phone']) &&
    isset($user['phone_verified_at']) &&
    !empty($user['phone_verified_at']))
    <!-- <div class="contact-with mt-0 py-4">
            <h5><span>Contact</span> {{ $user['name'] }}</h5>
            <div class="contact-devices pt-2">
                <a class="phone"
                    @if ($phone == 'Telephone') href="#" wire:click.prevent="showTelephone()" @else href="tel:{{ str_replace('-', '', $phone) }}" @endif>
                    <i class="fa-solid fa-phone-volume"></i>
                    {{ $phone }}
                </a>
                @if (isset($user['phone']) && $user['isWhatsApp'] == 1)
                    <a class="whats-app-handle"
                        @if ($whatsAppNumber == 'Whatsapp') href="#" wire:click="showWhatsApp" @else
                        href="https://api.whatsapp.com/send?phone=+91{{ str_replace('-', '', $user['phone']) }}&text={{ urlencode('Hi I saw your Ad on Ad Post' . $user['name'] . '') }}"
                        target="_blank" @endif>
                        <i class="icons_wt fa-brands fa-whatsapp"></i>
                        {{ $whatsAppNumber }}
                    </a>
                @endif
            </div>
        </div> -->
    @endif
</div>
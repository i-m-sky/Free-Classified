<div>
    <header class="header">
        <div class="wrapper">
            <div class="d-flex justify-content-between mt-35">
                <div class="logo d-flex justify-content-between"><a class="logo_display" href="{{ route('welcome') }}"><img
                            src="{{ config('global_variables.asset_url') }}/img/adpost.png" alt="logo" /></a>

                </div>
                @if (Route::currentRouteName() == 'login' ||
                        Route::currentRouteName() == 'register' ||
                        Route::currentRouteName() == 'password.request' ||
                        Route::currentRouteName() == 'password.email' ||
                        Route::currentRouteName() == 'password.reset' ||
                        Route::currentRouteName() == 'home' ||
                        Route::currentRouteName() == 'profile' ||
                        Route::currentRouteName() == 'my-post' ||
                        Route::currentRouteName() == 'new-post' ||
                        Route::currentRouteName() == 'new-post-step-2' ||
                        Route::currentRouteName() == 'edit-post' 
                        )
                @else
                    <div class="serach_btn">
                        <svg id="search-button" xmlns="httserach_btnp://www.w3.org/2000/svg" width="30px"
                            height="30px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                @endif
                <div class="header-links">
                    @auth
                        <div class="dash-login-box">
                            <div class="login-img-position">
                                <img src="{{ config('global_variables.asset_url') }}{{ isset($user) && !empty($user) && !empty($user->photo) ? '/storage/cms/userprofile/' . $user->photo : '' }}"
                                    onerror="this.src='{{ config('global_variables.asset_url') }}/img/user-upload.png'"
                                    alt="{{ isset($user) && !empty($user) && !empty($user->name) ? $user->name : '' }}"
                                    class="login-img" />
                            </div>
                            <div class="admin-name">{{ $user->name }} <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px"
                                    height="14px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            <div class="login-select-box">
                                {{-- <div class="header-dashboard">
                                    <span class="user-icon">
                                        <div class="file-upload-icon">
                                            <img src="{{ config('global_variables.asset_url') }}{{ isset($user) && !empty($user) && !empty($user->photo) ? '/storage/cms/userprofile/' . $user->photo : '' }}"
                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/user-upload.png'"
                                                alt="{{ isset($user) && !empty($user) && !empty($user->name) ? $user->name : '' }}"
                                                class="login-img" />
                                        </div>
                                    </span>
                                    <div class="profile_detail">
                                        <h6>{{ $user->name }} </h6>
                                        <div>
                                            <span>
                                                <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                </svg>
                                            </span>
                                            <p>Adpost since {{ date('F j, Y', strtotime($user->created_at)) }}</p>
                                        </div>
                                    </div>
                                </div> --}}
                                <ul>
                                    <li><a href="{{ route('home') }}"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="18px"
                                                height="18px">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                            </svg>Dashboard</a></li>
                                    <li><a href="{{ route('profile') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" width="18px" height="18px">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                                <path
                                                    d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                            </svg>My Profile</a></li>
                                    <li><a href="{{ route('my-post') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                width="18px">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
                                            </svg>My Ads</a></li>
                                    <li><a class="d-flex justify-content-start" href="{{ route('my-wallet') }}">
                                            <i class="fa fa-wallet"></i>
                                            <span class="ml-1">My Wallet</span>
                                        </a>
                                    </li>
                                    <li><a class="d-flex justify-content-start" href="{{ route('my-order') }}">
                                            <i class="fa fa-exchange"></i>
                                            <span class="ml-1">My Orders</span>
                                        </a>
                                    </li>
                                    <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form-sidebar-left-menu').submit();"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                width="18px" height="18px">
                                                <path fill-rule="evenodd"
                                                    d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                                                    clip-rule="evenodd" />
                                            </svg>Logout</a>
                                    </li>
                                    <!-- <li><a href="#"
                                            wire:click.prevent='$emit("openModal", "modals.my-account-delete-confirmation")'><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                width="18px" height="18px">
                                                <path fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                                    clip-rule="evenodd" />
                                            </svg>Delete Account</a></li> -->
                                </ul>
                            </div>
                        </div>
                    @else
                        <span class="login-link"><i class="fa-solid fa-user"></i><a href="{{ route('login') }}"
                                class="login-link-a login-link-a-mr">Login</a> /
                            <a href="{{ route('register') }}" class="login-link-a login-link-a-ml">Register</a></span>
                    @endauth

                    <a href="{{ route('new-post') }}" class="post-link">Post ad</a>
                </div>
                <button class="tgmenu">Menu</button>
            </div>
        </div>
    </header>
    <div class="mobile-menu">
        @if (Auth::check())
            <div class="d-flex justify-content-start login_nav_design">
                <div class="nav_bar_circl">
                    <img class="nav_bar_profile"
                        src="{{ config('global_variables.asset_url') }}{{ isset($user) && !empty($user) && !empty($user->photo) ? '/storage/cms/userprofile/' . $user->photo : '' }}"
                        onerror="this.src='{{ config('global_variables.asset_url') }}/img/user-upload.png'"
                        alt="{{ isset($user) && !empty($user) && !empty($user->name) ? $user->name : '' }}" />
                </div>
                <div class="d-flex align-items-center justify-content-between w-100">

            
                <div class="ml-1 user-navbar-profile">
                    <h1 class="mb-2">{{ isset($user) && !empty($user) && !empty($user->name) ? $user->name : '' }}
                    </h1>
                    
                    <span class="d-flex justify-content-start">
                        {{-- <svg class="mt-1 mr-1" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                        </svg> --}}
                        {{ isset($user) && !empty($user) && !empty($user->email) ? $user->email : '' }}
                        {{-- <p class="mt-1">Adpost since 2023</p> --}}
                    </span>
                </div>
                <div style="cursor: pointer;" class="header-cross-button mr-0"></div>
            </div>
            </div>
        @endif
        @if (!Auth::check())
            <div class="top_nav_bar_des">
                <a href="/"><img src="/img/adpost.png"
                        alt="logo" style="width:190px"></a>
                <div class="header-cross-button"></div>
            </div>
            <ul>
                <li><a class="d-flex justify-content-start" href="{{ route('welcome') }}">
                        <svg class="mt-2 " xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="ml-1">Home</span>
                    </a>
                </li>
                <li><a class="d-flex justify-content-start" href="{{ route('login') }}">
                        <svg class="mt-2 " xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        <span class="ml-1">Login</span>
                    </a>
                </li>
                <li><a class="d-flex justify-content-start" href="{{ route('register') }}">
                        <svg class="mt-2 " xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span class="ml-1">Register</span>
                    </a>
                </li>
                <a class="d-flex justify-content-center btn-dash-submit mt-3" href="{{ route('new-post') }}">
                    <!-- <svg class="mt-1 mr-2 " xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg> -->
                    Post ad
                </a>
                <!-- <li><a href="{{ route('new-post') }}">Post Free Ads</a></li>
            <li><a href="{{ route('new-post') }}">Post Free Ads</a></li> -->
            </ul>
        @endif
        @if (Auth::check())
            <ul class="mt-1">
                <li><a class="d-flex justify-content-start" href="{{ route('home') }}">
                        <svg class="mt-2 " xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                        <span class="ml-1">Dashboard</span>
                    </a>
                </li>
                <li><a class="d-flex justify-content-start" href="{{ route('profile') }}">
                        <svg class="mt-2 " xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span class="ml-1">My Profile</span>
                    </a>
                </li>
                <li><a class="d-flex justify-content-start" href="{{ route('my-post') }}">
                        <svg class="mt-2 " xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
                        </svg>
                        <span class="ml-1">My Ads</span>
                    </a>
                </li>
                <li><a class="d-flex justify-content-start" href="{{ route('my-wallet') }}">
                        <i class="fa fa-wallet mt-3"></i>
                        <span class="ml-1">My Wallet</span>
                    </a>
                </li>
                <li><a class="d-flex justify-content-start" href="{{ route('my-order') }}">
                        <i class="fa fa-exchange mt-3"></i>
                        <span class="ml-1">My Orders</span>
                    </a>
                </li>
                <li><a class="d-flex justify-content-start" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-sidebar-left-menu').submit();">
                        <svg class="mt-2 " xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        <span class="ml-1">Logout</span>
                    </a>
                </li>
                <li><a class="d-flex justify-content-start" href="#"
                        wire:click.prevent='$emit("openModal", "modals.my-account-delete-confirmation")'>
                        <svg class="mt-2 " xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" />
                        </svg>
                        <span class="ml-1">Delete Accountt</span>
                    </a>
                </li>
                <a class="d-flex justify-content-center btn-dash-submit mt-5" href="{{ route('new-post') }}">
                    <!-- <svg class="mt-1 mr-2 " xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg> -->
                    Post ad
                </a>
            </ul>
        @endif
    </div>
    <form id="logout-form-sidebar-left-menu" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

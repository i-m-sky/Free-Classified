@extends('layouts.app')
@section('headend')
@endsection

@section('bodyclass', 'bg-img')
@section('content')
    @php
        $locationUrlName = '';
        $locationSlug = '';
        if (!empty($post->locality_id)) {
            $locationUrlName = $post->locality->name;
            $locationSlug = $post->locality->slug;
        } elseif (!empty($post->city_id)) {
            $locationUrlName = $post->city->name;
            $locationSlug = $post->city->slug;
        } elseif (!empty($post->state_id)) {
            $locationUrlName = $post->state->name;
            $locationSlug = $post->state->slug;
        }
    @endphp
    <livewire:shared.search-post />
    <section class="bread-crums">
        <div class="wrapper">
            <div class="bread-crums-links">
                <ul>
                    <li class="home-arrow"><a href="{{ route('welcome') }}">Home <i class="fa fa-angle-right"
                                aria-hidden="true"></i></a>
                    </li>

                    @if (count($catNav))
                        @foreach (collect($catNav)->sortKeysDesc() as $navItem)
                            <li><a
                                    href="{{ route('post-list', ['location' => $locationSlug, 'category' => $navItem['slug']]) }}">
                                    {{ $navItem['name'] }} @if (!$loop->last)
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </section>
    <!-- -------NEW SECTION--------- -->
    <section class="section-details">
        <div class="wrapper">
            <div class="detail-bg-color">
                <div class="luxry-appartment">
                    <h1>{{ $post->name }}</h1>
                </div>
                <div class="details-flex-box">
                    <div class="details-container">
                        <div class="view-details">
                            <ul>
                                <li><a class="view-details-link" href="#"><i class="fa-solid fa-location-dot"></i>
                                        {{ $locationUrlName }}</a></li>
                                <li><a class="view-details-link" href="#"><i class="fa-regular fa-clock"></i>
                                        {{ date('Y-m-d', strtotime($post->created_at)) }}</a></li>
                                <li><a class="view-details-link" href="#"><i class="fa-regular fa-eye"></i> View:
                                        {{ !empty($post->page_view) ? number_format($post->page_view) : '0' }}</a></li>
                            </ul>
                            <div class="ads-txt">AD ID: {{ $post->id }}</div>
                        </div>

                        <div class="advertisment-container">
                            <div class="advertisment-screen">
                              <!--  <div class="wrapper">
                                    <div class="image-gallery">
                                        <aside class="thumbnails">
                                            <a href="#" class="selected thumbnail"
                                                data-big="http://placekitten.com/420/600">
                                                <div class="thumbnail-image"
                                                    style="background-image: url(http://placekitten.com/420/600)"></div>
                                            </a>
                                            <a href="#" class="thumbnail" data-big="http://placekitten.com/450/600">
                                                <div class="thumbnail-image"
                                                    style="background-image: url(http://placekitten.com/450/600)"></div>
                                            </a>
                                            <a href="#" class="thumbnail" data-big="http://placekitten.com/460/700">
                                                <div class="thumbnail-image"
                                                    style="background-image: url(http://placekitten.com/460/700)"></div>
                                            </a>
                                             <a href="#" class="thumbnail" data-big="http://placekitten.com/460/700">
                                                <div class="thumbnail-image"
                                                    style="background-image: url(http://placekitten.com/460/700)"></div>
                                            </a>
                                             <a href="#" class="thumbnail" data-big="http://placekitten.com/460/700">
                                                <div class="thumbnail-image"
                                                    style="background-image: url(http://placekitten.com/460/700)"></div>
                                            </a>
                                        </aside>

                                        <main class="primary"
                                            style="background-image: url('http://placekitten.com/420/600');"></main>
                                    </div>
                                </div>-->
                                <div class="slider-main">
                                            @if (
                                                !empty($post->image_path_1) ||
                                                    !empty($post->image_path_2) ||
                                                    !empty($post->image_path_3) ||
                                                    !empty($post->image_path_4) ||
                                                    !empty($post->image_path_5))
                                                @if (!empty($post->image_path_1))
    <div class="item">
                                                        <a href="#img_popup1"> <img
                                                                src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_1 }}"
                                                                alt="{{ $post->name }}"
                                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'"></a>
                                                    </div>
    @endif
                                                @if (!empty($post->image_path_2))
    <div class="item">
                                                        <a href="#img_popup2"> <img
                                                                src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_2 }}"
                                                                alt="{{ $post->name }}"
                                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'"></a>
                                                    </div>
    @endif
                                                @if (!empty($post->image_path_3))
    <div class="item">
                                                        <a href="#img_popup3"> <img
                                                                src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_3 }}"
                                                                alt="{{ $post->name }}"
                                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'"></a>
                                                    </div>
    @endif
                                                @if (!empty($post->image_path_4))
    <div class="item">
                                                        <a href="#img_popup4"> <img
                                                                src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_4 }}"
                                                                alt="{{ $post->name }}"
                                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'"></a>
                                                    </div>
    @endif
                                                @if (!empty($post->image_path_5))
    <div class="item">
                                                        <a href="#img_popup5"> <img
                                                                src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_5 }}"
                                                                alt="{{ $post->name }}"
                                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'"></a>
                                                    </div>
    @endif
@else
    @endif
                                        </div> 
                            </div>
                            <div class="slider-box">
                                        <div class="slider">
                                            @if (
                                                !empty($post->image_path_1) ||
                                                    !empty($post->image_path_2) ||
                                                    !empty($post->image_path_3) ||
                                                    !empty($post->image_path_4) ||
                                                    !empty($post->image_path_5))
                                                @if (!empty($post->image_path_1))
    <div class="item">
                                                        <a href="#img_popup1"> <img
                                                                src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_1 }}"
                                                                alt="{{ $post->name }}"
                                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'"></a>
                                                    </div>
    @endif
                                                @if (!empty($post->image_path_2))
    <div class="item">
                                                        <a href="#img_popup2"> <img
                                                                src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_2 }}"
                                                                alt="{{ $post->name }}"
                                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'"></a>
                                                    </div>
    @endif
                                                @if (!empty($post->image_path_3))
    <div class="item">
                                                        <a href="#img_popup3"> <img
                                                                src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_3 }}"
                                                                alt="{{ $post->name }}"
                                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'"></a>
                                                    </div>
    @endif
                                                @if (!empty($post->image_path_4))
    <div class="item">
                                                        <a href="#img_popup4"> <img
                                                                src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_4 }}"
                                                                alt="{{ $post->name }}"
                                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'"></a>
                                                    </div>
    @endif
                                                @if (!empty($post->image_path_5))
    <div class="item">
                                                        <a href="#img_popup5"> <img
                                                                src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_5 }}"
                                                                alt="{{ $post->name }}"
                                                                onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'"></a>
                                                    </div>
    @endif
@else
    @endif
                                        </div>
                                    </div>


                        </div>
                        <div class="detail-form">
                            <h5>Details</h5>
                            <div class="details-flex-box">
                                <ul class="detail-box-one">
                                    @if (!empty($post->salary_period) && !empty($post->salaryPeriod))
                                        <li class="detail-about-product">
                                            <p>Salary period</p>
                                            <p>{{ $post->salaryPeriod->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->education_level) && !empty($post->educationLevel))
                                        <li class="detail-about-product">
                                            <p>Education level</p>
                                            <p>{{ $post->educationLevel->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->position_type) && !empty($post->positionType))
                                        <li class="detail-about-product">
                                            <p>Position type</p>
                                            <p>{{ $post->positionType->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->experience_year) && !empty($post->experienceYear))
                                        <li class="detail-about-product">
                                            <p>Years of experience</p>
                                            <p>{{ $post->experienceYear->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->salary_from) && !empty($post->salary_to))
                                        <li class="detail-about-product">
                                            <p>Salary</p>
                                            <p><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;{{ $post->salary_from }}
                                                - <i
                                                    class="fa-solid fa-indian-rupee-sign"></i>&nbsp;{{ $post->salary_to }}
                                            </p>
                                        </li>
                                    @elseif (!empty($post->salary_from))
                                        <li class="detail-about-product">
                                            <p>Salary</p>
                                            <p><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;{{ $post->salary_from }}
                                            </p>
                                        </li>
                                    @elseif (!empty($post->salary_to))
                                        <li class="detail-about-product">
                                            <p>Salary</p>
                                            <p><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;{{ $post->salary_to }}
                                            </p>
                                        </li>
                                    @endif
                                    @if (!empty($post->bedroom) && !empty($post->bedroomM))
                                        <li class="detail-about-product">
                                            <p>Bedroom</p>
                                            <p>{{ $post->bedroomM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->bathroom) && !empty($post->bathroomM))
                                        <li class="detail-about-product">
                                            <p>Bathroom</p>
                                            <p>{{ $post->bathroomM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->furnishing) && !empty($post->furnishingM))
                                        <li class="detail-about-product">
                                            <p>Furnishing</p>
                                            <p>{{ $post->furnishingM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->listed_by) && !empty($post->listedByM))
                                        <li class="detail-about-product">
                                            <p>Listed by</p>
                                            <p>{{ $post->listedByM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->super_builtup_area))
                                        <li class="detail-about-product">
                                            <p>Super Builtup area</p>
                                            <p>{{ $post->super_builtup_area }}<span class="square-feet">
                                                    ft<sup>2</sup></span></p>
                                        </li>
                                    @endif
                                    @if (!empty($post->carpet_area))
                                        <li class="detail-about-product">
                                            <p>Carpet Area</p>
                                            <p>{{ $post->carpet_area }}<span class="square-feet"> ft<sup>2</sup></span>
                                            </p>
                                        </li>
                                    @endif
                                    @if ($post->is_bachelors_allowed === 0 || $post->is_bachelors_allowed === 1)
                                        <li class="detail-about-product">
                                            <p>Bachelors Allowed</p>
                                            <p>{{ $post->is_bachelors_allowed == 1 ? 'Yes' : 'No' }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->total_floor))
                                        <li class="detail-about-product">
                                            <p>Total Floors</p>
                                            <p>{{ $post->total_floor }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->floor_number))
                                        <li class="detail-about-product">
                                            <p>Floor No</p>
                                            <p>{{ $post->floor_number }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->car_parking) && !empty($post->carParkingM))
                                        <li class="detail-about-product">
                                            <p>Car Parking</p>
                                            <p>{{ $post->carParkingM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->facing) && !empty($post->facingM))
                                        <li class="detail-about-product">
                                            <p>Facing</p>
                                            <p>{{ $post->facingM->name }}</p>
                                        </li>
                                    @endif

                                    @if (!empty($post->plot_area))
                                        <li class="detail-about-product">
                                            <p>Plot Area</p>
                                            <p>{{ $post->plot_area }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->length))
                                        <li class="detail-about-product">
                                            <p>Length</p>
                                            <p>{{ $post->length }}</p>
                                        </li>
                                    @endif

                                    @if (!empty($post->breadth))
                                        <li class="detail-about-product">
                                            <p>Breadth</p>
                                            <p>{{ $post->breadth }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->washroom))
                                        <li class="detail-about-product">
                                            <p>Washrooms</p>
                                            <p>{{ $post->washroom }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->construction_status) && !empty($post->constructionStatusM))
                                        <li class="detail-about-product">
                                            <p>Construction status</p>
                                            <p>{{ $post->constructionStatusM->name }}</p>
                                        </li>
                                    @endif
                                    @if ($post->is_meal_included === 0 || $post->is_meal_included === 1)
                                        <li class="detail-about-product">
                                            <p>Meals Included</p>
                                            <p>{{ $post->is_meal_included == 1 ? 'Yes' : 'No' }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->registration_year))
                                        <li class="detail-about-product">
                                            <p>Reg. Year</p>
                                            <p>{{ $post->registration_year }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->fuel_type) && !empty($post->fuelTypeM))
                                        <li class="detail-about-product">
                                            <p>Fuel type</p>
                                            <p>{{ $post->fuelTypeM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->km_driven))
                                        <li class="detail-about-product">
                                            <p>KM driven</p>
                                            <p>{{ $post->km_driven }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->owner) && !empty($post->ownerM))
                                        <li class="detail-about-product">
                                            <p>No. of Owners</p>
                                            <p>{{ $post->ownerM->name }}</p>
                                        </li>
                                    @endif

                                    @if (!empty($post->hp_power) && !empty($post->hpPowerM))
                                        <li class="detail-about-product">
                                            <p>HP Power</p>
                                            <p>{{ $post->hpPowerM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->transmission) && !empty($post->transmissionM))
                                        <li class="detail-about-product">
                                            <p>Transmission</p>
                                            <p>{{ $post->transmissionM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->body_type) && !empty($post->bodyTypeM))
                                        <li class="detail-about-product">
                                            <p>Body Type</p>
                                            <p>{{ $post->bodyTypeM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->vehicle_parts_accessory_type) && !empty($post->vehiclePartsAccessoryTypeM))
                                        <li class="detail-about-product">
                                            <p>Types</p>
                                            <p>{{ $post->vehiclePartsAccessoryTypeM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->pet_age) && !empty($post->petAgeM))
                                        <li class="detail-about-product">
                                            <p>Age</p>
                                            <p>{{ $post->petAgeM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->pet_gender) && !empty($post->petGenderM))
                                        <li class="detail-about-product">
                                            <p>Gender</p>
                                            <p>{{ $post->petGenderM->name }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->pet_breed))
                                        <li class="detail-about-product">
                                            <p>Breed</p>
                                            <p>{{ $post->pet_breed }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->pet_colour))
                                        <li class="detail-about-product">
                                            <p>Colour</p>
                                            <p>{{ $post->pet_colour }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->community_age))
                                        <li class="detail-about-product">
                                            <p>Age</p>
                                            <p>{{ $post->community_age }}</p>
                                        </li>
                                    @endif
                                    @if (!empty($post->community_date_from) && !empty($post->community_date_to))
                                        <li class="detail-about-product">
                                            <p>Date</p>
                                            <p>{{ Carbon\Carbon::createFromFormat('Y-m-d', $post->community_date_from)->format('m/d/Y') }}
                                                -
                                                {{ Carbon\Carbon::createFromFormat('Y-m-d', $post->community_date_to)->format('m/d/Y') }}
                                            </p>
                                        </li>
                                    @elseif (!empty($post->community_date_from))
                                        <li class="detail-about-product">
                                            <p>Date</p>
                                            <p>{{ Carbon\Carbon::createFromFormat('Y-m-d', $post->community_date_from)->format('m/d/Y') }}
                                            </p>
                                        </li>
                                    @elseif (!empty($post->community_date_to))
                                        <li class="detail-about-product">
                                            <p>Date</p>
                                            <p>{{ Carbon\Carbon::createFromFormat('Y-m-d', $post->community_date_to)->format('m/d/Y') }}
                                            </p>
                                        </li>
                                    @endif
                                    @if (!empty($post->condition) && !empty($post->conditionM))
                                        <li class="detail-about-product">
                                            <p>Condition</p>
                                            <p>{{ $post->conditionM->name }}</p>
                                        </li>
                                    @endif

                                </ul>

                            </div>
                        </div>
                        <hr class="mt-4">
                        <div class="detail-discription">
                            <h5>Description</h5>
                            <p>{!! strip_tags($post->description, '<br>') !!}</p>
                        </div>
                        <livewire:posts.detail-post-list key="detail-post-list-{{ now()->timestamp }}" :post="collect($post)->toArray()"
                            :catNav="$catNav" />
                    </div>
                    <div class="contact-conatiner">
                        <div class="social-flex-box">
                            <div class="social-link">
                                {{-- <ul>
                                    <li>Share:</li>
                                    <li><a class="facebook-bg-color" href="#"><i class="fa fa-facebook"
                                                aria-hidden="true"></i></a></li>
                                    <li><a class="twitter-bg-color" href="#"><i class="fa fa-twitter"
                                                aria-hidden="true"></i></a></li>
                                    <li><a class="whatsapp-bg-color" href="#"><i class="fa fa-whatsapp"
                                                aria-hidden="true"></i></a></li>
                                    <li><a class="envelope-bg-color" href="#"><i
                                                class="fa-solid fa-envelope"></i></a></li>
                                </ul> --}}
                                <div class="button share-button facebook-share-button">share</div>
                                <div class="button share-button twitter-share-button">tweet</div>


                            </div>
                            @if (Auth::check())
                                <button
                                    onclick="Livewire.emit('openModal', 'modals.post-detail-repost-add',{{ json_encode(['post' => $post]) }})"
                                    class="btn-reportad">Report this Ad</button>
                            @else
                                <a href="{{ route('login') }}" class="report-add-a"> <button type="button"
                                        class="btn-reportad">Report this Ad</button>
                                </a>
                            @endif
                        </div>
                        @if (!empty($post->price))
                            <div class="detail-price-bg-color">
                                <div class="itemp-prices"><i class="fa-solid fa-indian-rupee-sign"></i>
                                    {{ getMoneyFormat($post->price, 0) }}</div>
                            </div>
                        @endif
                        <div class="contact-further-details">
                            @if (!empty($post->user))
                                <a href="{{ route('user-profile', ['userId' => $post->user->id]) }}">
                                    <div class="contact-person-flex">
                                        @if (!empty($post->user))
                                            <div class="contact-person-details">
                                                <div class="user-icon-profile-icn"><img class="login-img-pro"
                                                        src="{{ config('global_variables.asset_url') }}{{ isset($user) && !empty($user) && !empty($user->photo) ? '/storage/cms/userprofile/' . $user->photo : '' }}"
                                                        onerror="this.src='{{ config('global_variables.asset_url') }}/img/user-upload.png'"
                                                        alt="{{ isset($user) && !empty($user) && !empty($user->name) ? $user->name : '' }}">
                                                </div>
                                                <div class="contact-person-info">
                                                    <h5>{{ Str::limit($post->user->name, 50, '...') }}</h5>
                                                    @if (!empty($post->user->created_at))
                                                        <p>Member Since
                                                            {{ date('F d, Y', strtotime($post->user->created_at)) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        <div class="ancle-right">
                                            <a href="#">
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            @endif
                            <livewire:posts.post-detail-events key="post-detail-events-{{ now()->timestamp }}"
                                :post="collect($post)->toArray()" />

                        </div>
                        <livewire:posts.stay-safe-list key="stay-safe-list-{{ now()->timestamp }}" />
                    </div>
                </div>
            </div>
            {{-- /image show img_popup --}}
            @if (
                !empty($post->image_path_1) ||
                    !empty($post->image_path_2) ||
                    !empty($post->image_path_3) ||
                    !empty($post->image_path_4) ||
                    !empty($post->image_path_5))

                @if (!empty($post->image_path_1))
                    <div id="img_popup1" class="overlay">
                        <div class="img_popup">
                            <span class="img_popup-clos-bt">
                                <a class="close" href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </span>
                             <a class="left" href="#img_popup5"> < </a>
                            <a class="right" href="#img_popup2"> > </a>
                            <div class="content">
                                <a class="cancel" href="#"></a>
                                <img src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_1 }}"
                                    alt="{{ $post->name }}"
                                    onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'" />
                            </div>
                        </div>
                    </div>
                @endif
                @if (!empty($post->image_path_2))
                    <div id="img_popup2" class="overlay">
                        <div class="img_popup">
                            <span class="img_popup-clos-bt">
                                <a class="close" href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </span>
                             <a class="left" href="#img_popup1"> < </a>
                            <a class="right" href="#img_popup3"> > </a>
                            <div class="content">
                                <a class="cancel" href="#"></a>
                                <img src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_2 }}"
                                    alt="{{ $post->name }}"
                                    onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'" />
                            </div>
                        </div>
                    </div>
                @endif
                @if (!empty($post->image_path_3))
                    <div id="img_popup3" class="overlay">
                        <div class="img_popup">
                            <span class="img_popup-clos-bt">
                                <a class="close" href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </span>
                             <a class="left" href="#img_popup2"> < </a>
                            <a class="right" href="#img_popup4"> > </a>
                            <div class="content">
                                <a class="cancel" href="#"></a>
                                <img src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_3 }}"
                                    alt="{{ $post->name }}"
                                    onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'" />
                            </div>
                        </div>
                    </div>
                @endif
                @if (!empty($post->image_path_4))
                    <div id="img_popup4" class="overlay">
                        <div class="img_popup">
                            <span class="img_popup-clos-bt">
                                <a class="close" href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </span>
                             <a class="left" href="#img_popup3"> < </a>
                            <a class="right" href="#img_popup5"> > </a>
                            <div class="content">
                                <a class="cancel" href="#"></a>
                                <img src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_4 }}"
                                    alt="{{ $post->name }}"
                                    onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'" />
                            </div>
                        </div>
                    </div>
                @endif
                @if (!empty($post->image_path_5))
                    <div id="img_popup5" class="overlay">
                        <div class="img_popup">
                            <span class="img_popup-clos-bt">
                                <a class="close" href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </span>
                             <a class="left" href="#img_popup4"> < </a>
                            <a class="right" href="#img_popup1"> > </a>
                            <div class="content">
                                <a class="cancel" href="#"></a>
                                <img src="{{ config('global_variables.asset_url') }}/storage/cms/post/detail/{{ $post->image_path_5 }}"
                                    alt="{{ $post->name }}"
                                    onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'" />
                            </div>
                        </div>
                    </div>
                @endif
            @else
            @endif



            {{-- image show img_popup --}}
    </section>
    <section class="section-more">
        <div class="wrapper">
            <div class="more-option">
                <livewire:shared.find-out-more />
            </div>
        </div>
    </section>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/magnific-img_popup.js/1.1.0/jquery.magnific-img_popup.min.js'>
    </script>
    <script>
        //         $(document).ready(function(){

        // var HZperPage = 1,//number of results per page
        //    HZwrapper = 'paginationTable',//wrapper class
        //    HZlines   = 'tableItem',//items class
        //    HZpaginationId ='pagination-container',//id of pagination container
        //    HZpaginationArrowsClass = 'paginacaoCursor',//set the class of pagination arrows
        //    HZpaginationColorDefault =  '#880e4f',//default color for the pagination numbers
        //    HZpaginationColorActive = '#311b92', //color when page is clicked
        //    HZpaginationCustomClass = 'customPagination'; //custom class for styling the pagination (css)


        // /*-------F/ AHMED HIJAZI /*-------*/
        // function paginationShow() {
        // 	if($("#" + HZpaginationId).children().length > 8) {
        // 		var a = $(".activePagination").attr("data-valor");
        // 		if(a >= 4) {
        // 			var i = parseInt(a) - 3,
        // 				o = parseInt(a) + 2;
        // 			$(".paginacaoValor").hide(), exibir2 = $(".paginacaoValor").slice(i, o).show()
        // 		} else $(".paginacaoValor").hide(), exibir2 = $(".paginacaoValor").slice(0, 5).show()
        // 	}
        // }
        // paginationShow(), $("#beforePagination").hide(), $("." + HZlines).hide();
        // for(var tamanhotabela = $("." + HZwrapper).children().length, porPagina = HZperPage, paginas = Math.ceil(tamanhotabela / porPagina), i = 1; i <= paginas;) 
        // $("#" + HZpaginationId).append("<p class='paginacaoValor "+ HZpaginationCustomClass + "' data-valor=" + i + ">" + i + "</p>"), i++, $(".paginacaoValor").hide(), exibir2 = $(".paginacaoValor").slice(0, 5).show();
        // $(".paginacaoValor:eq(0)").css("background", "" + HZpaginationColorActive).addClass("activePagination");
        // var exibir = $("." + HZlines).slice(0, porPagina).show();
        // $(".paginacaoValor").on("click", function() {
        // $(".paginacaoValor").css("background", "" + HZpaginationColorDefault).removeClass("activePagination"), $(this).css("background", "" + HZpaginationColorActive).addClass("activePagination");
        // var a = $(this).attr("data-valor"),
        // 	i = a * porPagina,
        // 	o = i - porPagina;
        // $("." + HZlines).hide(), exibir = $("." + HZlines).slice(o, i).show(), "1" === a ? $("#beforePagination").hide() : $("#beforePagination").show(), a === "" + $(".paginacaoValor:last").attr("data-valor") ? $("#afterPagination").hide() : $("#afterPagination").show(), paginationShow()
        // }), $(".paginacaoValor").last().after($("#afterPagination")), $("#beforePagination").on("click", function() {
        // var a = $(".activePagination").attr("data-valor"),
        // 	i = parseInt(a) - 1;
        // $("[data-valor=" + i + "]").click(), paginationShow()
        // }), $("#afterPagination").on("click", function() {
        // var a = $(".activePagination").attr("data-valor"),
        // 	i = parseInt(a) + 1;
        // $("[data-valor=" + i + "]").click(), paginationShow()
        // }), $(".paginacaoValor").css("float", "left"), $("." + HZpaginationArrowsClass).css("float", "left");
        // })



        $(document).ready(function() {
            $(".divs div").each(function(e) {
                if (e != 0)
                    $(this).hide();
            });

            $("#next").click(function() {
                if ($(".divs div:visible").next().length != 0)
                    $(".divs div:visible").next().show().prev().hide();
                else {
                    $(".divs div:visible").hide();
                    $(".divs div:first").show();
                }
                return false;
            });

            $("#prev").click(function() {
                if ($(".divs div:visible").prev().length != 0)
                    $(".divs div:visible").prev().show().next().hide();
                else {
                    $(".divs div:visible").hide();
                    $(".divs div:last").show();
                }
                return false;
            });
        });



        $('.thumbnail').on('click', function() {
            var clicked = $(this);
            var newSelection = clicked.data('big');
            var $img = $('.primary').css("background-image", "url(" + newSelection + ")");
            clicked.parent().find('.thumbnail').removeClass('selected');
            clicked.addClass('selected');
            $('.primary').empty().append($img.hide().fadeIn('slow'));
        });
    </script>
@endsection
@section('bodyend')
@endsection

@php
$jobCat = $post->category_id==2?"link-container-job":""
@endphp

<div class="link-container {{$jobCat}}">
    <!-- {{$post}} -->
    @if(!empty($post->image_path_1) ||
        !empty($post->image_path_2) ||
        !empty($post->image_path_3) ||
        !empty($post->image_path_4) ||
        !empty($post->image_path_5))
    <button class="urgent-btn mb-1 mt-1">Urgent</button>
    @endif
    @php
        $locationListName = '';
        if (!empty($post->locality_id)) {
            $locationListName = !empty($post->locality) ? $post->locality->name : '';
        } elseif (!empty($post->city_id)) {
            $locationListName = !empty($post->city) ? $post->city->name : '';
        } elseif (!empty($post->state_id)) {
            $locationListName = !empty($post->state) ? $post->state->name : '';
        }
    @endphp
    <a href="{{ route('post-detail', ['slug' => Str::slug($post->name, '-'), 'id' => $post->id]) }}">
        <h3>{{ $post->name }}</h3>
        <div class="luton-town">
            @if ($parentNavCatId != 2 && $post->category_id != 2)
                <div class="product-img">
                    @if (
                        !empty($post->image_path_1) ||
                            !empty($post->image_path_2) ||
                            !empty($post->image_path_3) ||
                            !empty($post->image_path_4) ||
                            !empty($post->image_path_5))
                        @php
                            $imgSrc = '';
                            $imgCount = 0;
                            if (!empty($post->image_path_5)) {
                                $imgSrc = $post->image_path_5;
                                $imgCount++;
                            }
                            if (!empty($post->image_path_4)) {
                                $imgSrc = $post->image_path_4;
                                $imgCount++;
                            }
                            if (!empty($post->image_path_3)) {
                                $imgSrc = $post->image_path_3;
                                $imgCount++;
                            }
                            if (!empty($post->image_path_2)) {
                                $imgSrc = $post->image_path_2;
                                $imgCount++;
                            }
                            if (!empty($post->image_path_1)) {
                                $imgSrc = $post->image_path_1;
                                $imgCount++;
                            }
                        @endphp
                        <img src="{{ config('global_variables.asset_url') }}/storage/cms/post/list/{{ $imgSrc }}"
                            alt="{{ $post->name }}"
                            onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'" />
                        @if ($imgCount > 1)
                            <span class="room-pictures">
                                <i class="fa-solid fa-camera"></i> {{ $imgCount - 1 }}
                            </span>
                        @endif
                    @else
                        <img src="{{ config('global_variables.asset_url') }}/img/no-post-list.jpg"
                            alt="{{ $post->name }}" />
                    @endif

                </div>
            @endif
            <div class="product-text">
                @if (in_array($parentNavCatId, [1, 2, 7]) || in_array($post->category_id, [1, 2, 7]))
                @else
                    @if ($post->price > 0)
                        <div class="itemp--list-prices"><i class="fa-solid fa-indian-rupee-sign"></i>
                            {{ getMoneyFormat($post->price, 0) }}</div>
                    @endif
                @endif
                <div class="location-gurgaon"><i class="fa-solid fa-location-dot"></i>
                    {{ $locationListName }} |
                    {{ !empty($post->created_at) ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d/m/Y') : '' }}
                </div>
                <p class="post-description-desktop">
                    {{ Str::limit(str_replace('<br />', ' ', $post->description), 300, '...') }}
                </p>
                @if (in_array($parentNavCatId, [1, 9, 10, 11, 2, 7]) || in_array($post->category_id, [1, 9, 10, 11, 2, 7]))
                    <p class="post-description-mobile">
                        {{ Str::limit(str_replace('<br />', ' ', $post->description), 150, '...') }}
                    </p>
                @endif

                <div class="room-sizes">
                    <ul>
                        @if ($parentNavCatId == 2 || $post->category_id == 2)
                            {{-- For Jobs --}}
                            @if (!empty($post->salary_from) && !empty($post->salary_to))
                                <li>
                                    <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;{{ $post->salary_from }} -
                                    <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;{{ $post->salary_to }}
                                </li>
                            @elseif (!empty($post->salary_from))
                                <li>
                                    <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;{{ $post->salary_from }}
                                </li>
                            @elseif (!empty($post->salary_to))
                                <li>
                                    <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;{{ $post->salary_to }}
                                </li>
                            @endif
                            @if (!empty($post->salary_period) && !empty($post->salaryPeriod))
                                <li>
                                    {{ $post->salaryPeriod->name }}
                                </li>
                            @endif
                            @if (!empty($post->position_type) && !empty($post->positionType))
                                <li>
                                    {{ $post->positionType->name }}
                                </li>
                            @endif
                            {{-- @if (!empty($post->education_level) && !empty($post->educationLevel))
                            <li>
                                {{ $post->educationLevel->name }}
                            </li>
                        @endif

                        @if (!empty($post->experience_year) && !empty($post->experienceYear))
                            <li>
                                {{ $post->experienceYear->name }}
                            </li>
                        @endif --}}
                        @elseif ($parentNavCatId == 6 || $post->category_id == 6)
                            {{-- For For Sale --}}
                            @if (!empty($post->condition) && !empty($post->conditionM))
                                <li>
                                    Condition: {{ $post->conditionM->name }}
                                </li>
                            @endif
                        @elseif (in_array($parentNavCatId, [9, 11]) || in_array($post->category_id, [9, 11]))
                            {{-- For Friendship and Dating  => 9
                             For Matrimonials  => 11
                            --}}
                            @if (!empty($post->community_age))
                                <li>
                                    Age: {{ $post->community_age }} years
                                </li>
                            @endif
                        @elseif ($parentNavCatId == 10 || $post->category_id == 10)
                            {{-- For Classes and Tuition --}}
                        @elseif (in_array($post->category_id, [14]))
                            {{-- For Property > Property To Share  => 14
                                --}}
                            @if (!empty($post->bedroom) && !empty($post->bedroomM))
                                <li>
                                    {{ $post->bedroomM->name }} Bds
                                </li>
                            @endif
                            @if (!empty($post->bathroom) && !empty($post->bathroomM))
                                <li>
                                    {{ $post->bathroomM->name }} Ba
                                </li>
                            @endif
                            @if (!empty($post->super_builtup_area))
                                <li>
                                    {{ $post->super_builtup_area }} ft2
                                </li>
                            @endif
                            @if (!empty($post->owner) && !empty($post->ownerM))
                                <li>
                                    {{ $post->ownerM->name }}
                                </li>
                            @endif
                        @elseif (in_array($post->category_id, [15, 16, 20, 21]))
                            {{-- 
                                    For Houses for Sale  => 15
                                    For Flats for Sale => 16
                                    For Houses for Rent => 20
                                    For Flats for Rent => 21
                                    Property > Property For Sale > Houses for Sale/Flats for Sale/Houses for Rent/Flats for Rent
                                --}}
                            @if (!empty($post->bedroom) && !empty($post->bedroomM))
                                <li>
                                    {{ $post->bedroomM->name }} Bds
                                </li>
                            @endif
                            @if (!empty($post->bathroom) && !empty($post->bathroomM))
                                <li>
                                    {{ $post->bathroomM->name }} Ba
                                </li>
                            @endif
                            @if (!empty($post->super_builtup_area))
                                <li>
                                    {{ $post->super_builtup_area }} ft2
                                </li>
                            @endif
                            @if (!empty($post->listed_by) && !empty($post->listedByM))
                                <li>
                                    {{ $post->listedByM->name }}
                                </li>
                            @endif
                        @elseif (in_array($post->category_id, [17, 24]))
                            {{-- 
                                    For Land for Sale  => 17
                                    For Land for Rent  => 24
                                    Property > Property For Sale > Land for Sale/Land for Rent
                                            --}}
                            @if (!empty($post->plot_area))
                                <li>
                                    {{ $post->plot_area }} ft2
                                </li>
                            @endif
                            @if (!empty($post->listed_by) && !empty($post->listedByM))
                                <li>
                                    {{ $post->listedByM->name }}
                                </li>
                            @endif
                        @elseif (in_array($post->category_id, [18, 23]))
                            {{-- 
                                    For Parking for Sale  => 18
                                    For Parking for Rent  => 23
                                    Property > Property For Sale > Parking for Sale/Parking for Rent
                                --}}
                            @if (!empty($post->plot_area))
                                <li>
                                    {{ $post->plot_area }} ft2
                                </li>
                            @endif
                            @if (!empty($post->listed_by) && !empty($post->listedByM))
                                <li>
                                    {{ $post->listedByM->name }}
                                </li>
                            @endif
                        @elseif (in_array($post->category_id, [19]))
                            {{-- 
                                    For Commercial Space for Sale  => 19

                                            --}}
                            @if (!empty($post->furnishing) && !empty($post->furnishingM))
                                <li>
                                    {{ $post->furnishingM->name }}
                                </li>
                            @endif
                            @if (!empty($post->listed_by) && !empty($post->listedByM))
                                <li>
                                    {{ $post->listedByM->name }}
                                </li>
                            @endif
                            @if (!empty($post->super_builtup_area))
                                <li>
                                    {{ $post->super_builtup_area }} ft2
                                </li>
                            @endif
                            @if (!empty($post->washroom))
                                <li>
                                    {{ $post->washroom }} Wash
                                </li>
                            @endif
                        @elseif (in_array($post->category_id, [25]))
                            {{-- 
                                  Property > Property For Sale > Commercial Space for Sale/Commercial Space for Rent
                                            --}}
                            @if (!empty($post->furnishing) && !empty($post->furnishingM))
                                <li>
                                    {{ $post->furnishingM->name }}
                                </li>
                            @endif
                            @if (!empty($post->listed_by) && !empty($post->listedByM))
                                <li>
                                    {{ $post->listedByM->name }}
                                </li>
                            @endif
                            @if (!empty($post->super_builtup_area))
                                <li>
                                    {{ $post->super_builtup_area }} ft2
                                </li>
                            @endif
                            @if (!empty($post->washroom))
                                <li>
                                    {{ $post->washroom }} Wash
                                </li>
                            @endif
                        @elseif ($post->category_id == 22)
                            {{-- For Property > Property For Rent > Roommates & Rooms for Rent --}}
                            @if (!empty($post->bedroom) && !empty($post->bedroomM))
                                <li>
                                    {{ $post->bedroomM->name }} Bds
                                </li>
                            @endif
                            @if (!empty($post->bathroom) && !empty($post->bathroomM))
                                <li>
                                    {{ $post->bathroomM->name }} Ba
                                </li>
                            @endif
                            @if (!empty($post->super_builtup_area))
                                <li>
                                    {{ $post->super_builtup_area }} ft2
                                </li>
                            @endif
                            @if (!empty($post->listed_by) && !empty($post->listedByM))
                                <li>
                                    {{ $post->listedByM->name }}
                                </li>
                            @endif
                        @elseif ($post->category_id == 26)
                            {{-- For Property > Property To Share > Houses for Share --}}
                            @if (!empty($post->bedroom) && !empty($post->bedroomM))
                                <li>
                                    {{ $post->bedroomM->name }} Bds
                                </li>
                            @endif
                            @if (!empty($post->bathroom) && !empty($post->bathroomM))
                                <li>
                                    {{ $post->bathroomM->name }} Ba
                                </li>
                            @endif
                            @if (!empty($post->super_builtup_area))
                                <li>
                                    {{ $post->super_builtup_area }} ft2
                                </li>
                            @endif
                            @if (!empty($post->listed_by) && !empty($post->listedByM))
                                <li>
                                    {{ $post->listedByM->name }}
                                </li>
                            @endif
                        @elseif (in_array($post->category_id, [27]))
                            {{-- 
                                    For Flats for Share  => 27
                                            --}}
                            @if (!empty($post->bedroom) && !empty($post->bedroomM))
                                <li>
                                    {{ $post->bedroomM->name }} Bds
                                </li>
                            @endif
                            @if (!empty($post->bathroom) && !empty($post->bathroomM))
                                <li>
                                    {{ $post->bathroomM->name }} Ba
                                </li>
                            @endif
                            @if (!empty($post->super_builtup_area))
                                <li>
                                    {{ $post->super_builtup_area }} ft2
                                </li>
                            @endif
                            @if (!empty($post->listed_by) && !empty($post->listedByM))
                                <li>
                                    {{ $post->listedByM->name }}
                                </li>
                            @endif
                        @elseif (in_array($post->category_id, [28]))
                            {{-- 
                                    For Commercial Space for Shared  => 28

                                            --}}

                            @if (!empty($post->furnishing) && !empty($post->furnishingM))
                                <li>
                                    {{ $post->furnishingM->name }}
                                </li>
                            @endif
                            @if (!empty($post->super_builtup_area))
                                <li>
                                    {{ $post->super_builtup_area }} ft2
                                </li>
                            @endif
                            @if (!empty($post->washroom))
                                <li>
                                    {{ $post->washroom }} Wash
                                </li>
                            @endif
                            @if (!empty($post->listed_by) && !empty($post->listedByM))
                                <li>
                                    {{ $post->listedByM->name }}
                                </li>
                            @endif
                        @elseif ($post->category_id == 29)
                            {{-- For Property > Guest Houses & PG --}}
                            @if (!empty($post->furnishing) && !empty($post->furnishingM))
                                <li>
                                    {{ $post->furnishingM->name }}
                                </li>
                            @endif
                            @if (!empty($post->listed_by) && !empty($post->listedByM))
                                <li>
                                    {{ $post->listedByM->name }}
                                </li>
                            @endif
                            @if ($post->is_meal_included === 0 || $post->is_meal_included === 1)
                                <li>
                                    Meal Included: {{ $post->is_meal_included == 1 ? 'Yes' : 'No' }}
                                </li>
                            @endif
                        @elseif ($parentNavCatId == 30 || $post->category_id == 30)
                            {{-- For Pets for Sale --}}
                            @if (!empty($post->pet_breed))
                                <li>
                                    {{ $post->pet_breed }}
                                </li>
                            @endif
                            @if (!empty($post->pet_age) && !empty($post->petAgeM))
                                <li>
                                    Age: {{ $post->petAgeM->name }}
                                </li>
                            @endif
                            @if (!empty($post->pet_gender) && !empty($post->petGenderM))
                                <li>
                                    {{ $post->petGenderM->name }}
                                </li>
                            @endif
                            {{-- @if (!empty($post->pet_colour))
                                <li>
                                    {{ $post->pet_colour }}
                                </li>
                            @endif --}}
                        @elseif (in_array($parentNavCatId, [36, 37, 38, 40, 41, 42]) || in_array($post->category_id, [36, 37, 38, 40, 41, 42]))
                            {{-- For Cars  => 36
                                 For Motorcycles  => 37
                                 For Scooters  => 38
                                 For Tractors  => 40
                                 For Buses  => 41
                                 For Trucks  => 42
                                --}}
                            @if (!empty($post->registration_year))
                                <li>
                                    {{ $post->registration_year }}
                                </li>
                            @endif
                            @if (!empty($post->km_driven))
                                <li>
                                    {{ number_format($post->km_driven, 0) }} km
                                </li>
                            @endif
                            @if (!empty($post->fuel_type) && !empty($post->fuelTypeM))
                                <li>
                                    {{ $post->fuelTypeM->name }}
                                </li>
                            @endif
                            @if (!empty($post->owner) && !empty($post->ownerM))
                                <li>
                                    {{ $post->ownerM->name }}
                                </li>
                            @endif
                        @elseif ($parentNavCatId == 39 || $post->category_id == 39)
                            {{-- For Bicycles --}}
                            @if (!empty($post->km_driven))
                                <li>
                                    {{ number_format($post->km_driven, 0) }} km
                                </li>
                            @endif
                            @if (!empty($post->fuel_type) && !empty($post->fuelTypeM))
                                <li>
                                    {{ $post->fuelTypeM->name }}
                                </li>
                            @endif
                        @else
                            {{-- @if (!empty($post->carpet_area))
                                <li>
                                    {{ $post->carpet_area }}<span class="square-feet"> ft<sup>2</sup></span>

                                </li>
                            @endif
                            @if ($post->is_bachelors_allowed === 0 || $post->is_bachelors_allowed === 1)
                                {{ $post->is_bachelors_allowed == 1 ? 'Yes' : 'No' }}
                            @endif
                            @if (!empty($post->total_floor))
                                {{ $post->total_floor }}
                            @endif
                            @if (!empty($post->floor_number))
                                {{ $post->floor_number }}
                            @endif
                            @if (!empty($post->car_parking) && !empty($post->carParkingM))
                                <li>
                                    {{ $post->carParkingM->name }}
                                </li>
                            @endif
                            @if (!empty($post->facing) && !empty($post->facingM))
                                <li>
                                    {{ $post->facingM->name }}
                                </li>
                            @endif


                            @if (!empty($post->length))
                                <li>
                                    {{ $post->length }}
                                </li>
                            @endif

                            @if (!empty($post->breadth))
                                <li>
                                    {{ $post->breadth }}
                                </li>
                            @endif

                            @if (!empty($post->construction_status) && !empty($post->constructionStatusM))
                                <li>
                                    {{ $post->constructionStatusM->name }}
                                </li>
                            @endif
                            @if (!empty($post->hp_power) && !empty($post->hpPowerM))
                                <li>
                                    {{ $post->hpPowerM->name }}
                                </li>
                            @endif
                            @if (!empty($post->transmission) && !empty($post->transmissionM))
                                <li>
                                    {{ $post->transmissionM->name }}
                                </li>
                            @endif
                            @if (!empty($post->body_type) && !empty($post->bodyTypeM))
                                <li>
                                    {{ $post->bodyTypeM->name }}
                                </li>
                            @endif
                            @if (!empty($post->vehicle_parts_accessory_type) && !empty($post->vehiclePartsAccessoryTypeM))
                                <li>
                                    {{ $post->vehiclePartsAccessoryTypeM->name }}
                                </li>
                            @endif
                            @if (!empty($post->community_date_from) && !empty($post->community_date_to))
                                <li>
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $post->community_date_from)->format('m/d/Y') }}
                                    -
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $post->community_date_to)->format('m/d/Y') }}
                                </li>
                            @elseif (!empty($post->community_date_from))
                                {{ Carbon\Carbon::createFromFormat('Y-m-d', $post->community_date_from)->format('m/d/Y') }}

                                </li>
                            @elseif (!empty($post->community_date_to))
                                <li>
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $post->community_date_to)->format('m/d/Y') }}

                                </li>
                            @endif --}}
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </a>
</div>

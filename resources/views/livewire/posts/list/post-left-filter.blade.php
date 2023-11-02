<div class="car-details-bg-color">
    @if (!empty($category))
        <div class="box-1 categories-list">
            <div class="heading">Categories:</div>
            <ul>
                @if ($category == 'all')
                    <li class="highlight highlight-l1-item">
                        <a href="{{ route('post-list', ['location' => $location]) }}"></a>
                        All Categories
                    </li>
                @elseif(!empty($catRow) && count($catRow) > 0)
                    <ul>
                        <li>
                            <a href="{{ route('post-list', ['location' => $location]) }}" class="category-selected">
                                All Categories
                                <span class="count">
                                </span>
                            </a>
                        </li>
                        @if (count($catNav) > 0)
                            @php
                                $lastCatNav = '';
                            @endphp
                            @foreach (collect($catNav)->sortKeysDesc() as $navItem)
                                @if (!$loop->last)
                                    @php
                                        $lastCatNav = $navItem['slug'];
                                    @endphp
                                    <li><a class="category-selected"
                                            href="{{ route('post-list', ['location' => $location, 'category' => $navItem['slug']]) }}">
                                            {{ $navItem['name'] }}<span class="count">
                                            </span></a>
                                    </li>
                                @else
                                    @if (empty($lastCatNav))
                                        <li class="highlight highlight-l1-item">
                                            <a href="{{ route('post-list', ['location' => $location]) }}">
                                                x</a>
                                            {{ $navItem['name'] }}
                                        </li>
                                    @else
                                        <li class="highlight highlight-l1-item">
                                            <a
                                                href="{{ route('post-list', ['location' => $location, 'category' => $lastCatNav]) }}">
                                                x</a>
                                            {{ $navItem['name'] }}
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                @endif
                @if (count($childCategories) > 0)
                    @php
                        $i = 0;
                    @endphp
                    <ul>
                        @foreach ($childCategories as $index => $catItem)
                            {{-- @if ($catItem['total'] > 0) --}}
                            @php
                                $i++;
                            @endphp
                            <li class="{{ $i > 5 ? 'cat-hide' : '' }}">
                                <a href="{{ route('post-list', ['location' => $location, 'category' => $catItem['slug']]) }}"
                                    class="category-selected l2-item">
                                    {{ $catItem['name'] }}
                                    <span class="count">
                                        ({{ number_format($catItem['total']) }})
                                    </span>
                                </a>
                            </li>
                            {{-- @endif --}}
                        @endforeach
                        @if ($i > 5)
                            <li class="view-more collapsing-filter jsonly view-more-cat"><a
                                    href="javascript:void(0)">View More Options... <i
                                        class="fa-solid fa-arrow-down"></i></a></li>
                            <li class="view-more collapsing-filter jsonly view-few-cat"><a
                                    href="javascript:void(0)">Fewer Options <i class="fa fa-arrow-up"
                                        aria-hidden="true"></i></a></li>
                        @endif
                    </ul>
                @endif

                @if (!empty($catRow) && count($catRow) > 0)
            </ul>
    @endif
    </ul>
</div>
@endif
@if (!empty($location))
    <div class="box-1 locations">
        <div class="heading">Location:</div>
        <ul role="group" aria-labelledby="location-menu">
            @if ($location == 'india')
                <li class="highlight highlight-l1-item">
                    @if ($category == 'all')
                        <a href="{{ route('post-list', ['location' => 'india']) }}"></a>
                    @else
                        <a href="{{ route('post-list', ['location' => 'india', 'category' => $category]) }}"></a>
                    @endif
                    India
                </li>
            @elseif(!empty($locRow) && count($locRow) > 0)
                <ul>
                    <li>
                        @if ($category == 'all')
                            <a href="{{ route('post-list', ['location' => 'india']) }}" class="category-selected">
                                India
                                <span class="count">
                                </span>
                            </a>
                        @else
                            <a href="{{ route('post-list', ['location' => 'india', 'category' => $category]) }}"
                                class="category-selected">
                                India
                                <span class="count">
                                </span>
                            </a>
                        @endif
                    </li>
                    @if (!empty($stateRow) && count($stateRow) > 0)
                        <li>
                            @if ($category == 'all')
                                <a class="category-selected"
                                    href="{{ route('post-list', ['location' => $stateRow['slug']]) }}">
                                    {{ $stateRow['name'] }}
                                    <span class="count">
                                    </span>
                                </a>
                            @else
                                <a class="category-selected"
                                    href="{{ route('post-list', ['location' => $stateRow['slug'], 'category' => $category]) }}">
                                    {{ $stateRow['name'] }}
                                    <span class="count">
                                    </span>
                                </a>
                            @endif
                        </li>
                    @endif
                    @if (!empty($cityRow) && count($cityRow) > 0)
                        <li>
                            @if ($category == 'all')
                                <a class="category-selected"
                                    href="{{ route('post-list', ['location' => $cityRow['slug']]) }}">
                                    {{ $cityRow['name'] }}
                                    <span class="count">
                                    </span>
                                </a>
                            @else
                                <a class="category-selected"
                                    href="{{ route('post-list', ['location' => $cityRow['slug'], 'category' => $category]) }}">
                                    {{ $cityRow['name'] }}
                                    <span class="count">
                                    </span>
                                </a>
                            @endif
                        </li>
                    @endif
                    <li class="highlight highlight-l1-item">
                        @php
                            if (!empty($cityRow) && count($cityRow) > 0) {
                                $lastLocNav = $cityRow['slug'];
                            } elseif (!empty($stateRow) && count($stateRow) > 0) {
                                $lastLocNav = $stateRow['slug'];
                            } else {
                                $lastLocNav = 'india';
                            }
                        @endphp
                        @if ($category == 'all')
                            <a href="{{ route('post-list', ['location' => $lastLocNav]) }}">x</a>
                        @else
                            <a
                                href="{{ route('post-list', ['location' => $lastLocNav, 'category' => $category]) }}">x</a>
                        @endif
                        {{ $locRow['name'] }}
                    </li>
            @endif
            @if (count($childLocations) > 0)
                @php
                    $j = 0;
                @endphp
                <ul>
                    @foreach ($childLocations as $index => $locItem)
                        @if ($locItem['total'] > 0)
                            @php
                                $j++;
                            @endphp
                            <li class="{{ $j > 5 ? 'loc-hide' : '' }}">
                                @if ($category == 'all')
                                    <a href="{{ route('post-list', ['location' => $locItem['slug']]) }}"
                                        class="location-selected l1-item">
                                        {{ $locItem['name'] }}
                                        <span class="count">
                                            ({{ number_format($locItem['total']) }})
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ route('post-list', ['location' => $locItem['slug'], 'category' => $category]) }}"
                                        class="location-selected l1-item">
                                        {{ $locItem['name'] }}
                                        <span class="count">
                                            ({{ number_format($locItem['total']) }})
                                        </span>
                                    </a>
                                @endif
                            </li>
                        @endif
                    @endforeach
                    @if ($j > 5)
                        <li class="view-more collapsing-filter jsonly view-more-loc"><a href="javascript:void(0)">View
                                More Options... <i class="fa-solid fa-arrow-down"></i></a></li>
                        <li class="view-more collapsing-filter jsonly view-few-loc"><a href="javascript:void(0)">Fewer
                                Options <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        </li>
                    @endif
                </ul>
            @endif
            @if (!empty($locRow) && count($locRow) > 0)
        </ul>
@endif
</ul>
</div>
@endif
@if (in_array($parentNavCatId, [1, 2, 7]))
@else
    <div class="box-1 locations">
        <form method="post" wire:submit.prevent="filterParams()">
            <div class="heading">Price:</div>
            <div class="update-price">
                <div class="input-bx-1">
                    <label for="">From</label>
                    <input type="text" wire:model.defer="minPrice">
                </div>
                <div class="input-bx-1">
                    <label for="">To</label>
                    <input type="text" wire:model.defer="maxPrice">
                </div>
                <div class="input-bx-2">
                    <input type="submit" value="Go">
                </div>
            </div>
        </form>
    </div>
@endif
{{-- 
    For Sales => 6
--}}
@if (in_array($parentNavCatId, [6]))
    @if (count($mCondition) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Condition:</div>
            <ul>
                @php
                    $condUrl = str_replace('&condition=new', '', $currentRoute);
                    $condUrl = str_replace('&condition=used', '', $condUrl);
                    $condUrl = str_replace('&condition=all', '', $condUrl);
                    $condUrl = str_replace('condition=new', '', $condUrl);
                    $condUrl = str_replace('condition=used', '', $condUrl);
                    $condUrl = str_replace('condition=all', '', $condUrl);
                    $condUrl = str_replace('?&', '?', $condUrl);
                @endphp
                <li class="{{ $condition == 'all' || empty($condition) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $condUrl }}"
                        class="{{ $condition == 'all' || empty($condition) ? 'category-selected' : '' }}">
                        {{ $condition == 'all' || empty($condition) ? '' : 'Any' }}
                        <span class="count">
                        </span>
                    </a> {{ $condition == 'all' || empty($condition) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mCondition as $item)
                        @if ($condition == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item"> <a
                                    href="{{ $condUrl }}condition={{ generateQueryParam($item['name']) }}"
                                    class="category-selected">
                                </a> {{ $item['name'] }}</li>
                        @else
                            <li><a href="{{ $condUrl }}condition={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a> </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
    Jobs => 2
--}}
@if (in_array($parentNavCatId, [2]))
    <div class="box-1 locations">
        <form method="post" wire:submit.prevent="filterParams()">
            <div class="heading">Salary:</div>
            <div class="update-price">
                <div class="input-bx-1">
                    <label for="">From</label>
                    <input type="text" wire:model.defer="minSalary">
                </div>
                <div class="input-bx-1">
                    <label for="">To</label>
                    <input type="text" wire:model.defer="maxSalary">
                </div>
                <div class="input-bx-2">
                    <input type="submit" value="Go">
                </div>
            </div>
        </form>
    </div>
    @if (count($mSalaryPeriods) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Salary Period:</div>
            @php
                $speriodUrl = str_replace('&speriod=all', '', $currentRoute);
                $speriodUrl = str_replace('&speriod=hourly', '', $speriodUrl);
                $speriodUrl = str_replace('&speriod=weekly', '', $speriodUrl);
                $speriodUrl = str_replace('&speriod=monthly', '', $speriodUrl);
                $speriodUrl = str_replace('&speriod=yearly', '', $speriodUrl);
                $speriodUrl = str_replace('?speriod=all', '?', $speriodUrl);
                $speriodUrl = str_replace('?speriod=hourly', '?', $speriodUrl);
                $speriodUrl = str_replace('?speriod=weekly', '?', $speriodUrl);
                $speriodUrl = str_replace('?speriod=monthly', '?', $speriodUrl);
                $speriodUrl = str_replace('?speriod=yearly', '?', $speriodUrl);
                $speriodUrl = str_replace('?&', '?', $speriodUrl);
            @endphp
            <ul>
                <li class="{{ $sPeriod == 'all' || empty($sPeriod) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $speriodUrl }}">{{ $sPeriod == 'all' || empty($sPeriod) ? '' : 'Any' }}</a>
                    {{ $sPeriod == 'all' || empty($sPeriod) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mSalaryPeriods as $item)
                        @if ($sPeriod == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $speriodUrl }}speriod={{ generateQueryParam($item['name']) }}"></a>
                                {{ $item['name'] }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $speriodUrl }}speriod={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
    @if (count($mPositionTypes) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Position Type:</div>
            <ul>
                @php
                    $spositionUrl = str_replace('&sposition=all', '', $currentRoute);
                    $spositionUrl = str_replace('&sposition=contract', '', $spositionUrl);
                    $spositionUrl = str_replace('&sposition=full-time', '', $spositionUrl);
                    $spositionUrl = str_replace('&sposition=part-time', '', $spositionUrl);
                    $spositionUrl = str_replace('&sposition=temporary', '', $spositionUrl);
                    $spositionUrl = str_replace('&sposition=internship', '', $spositionUrl);
                    $spositionUrl = str_replace('?sposition=contract', '?', $spositionUrl);
                    $spositionUrl = str_replace('?sposition=full-time', '?', $spositionUrl);
                    $spositionUrl = str_replace('?sposition=part-time', '?', $spositionUrl);
                    $spositionUrl = str_replace('?sposition=temporary', '?', $spositionUrl);
                    $spositionUrl = str_replace('?sposition=internship', '?', $spositionUrl);
                    $spositionUrl = str_replace('?&', '?', $spositionUrl);
                @endphp
                <li class="{{ $sPosition == 'all' || empty($sPosition) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $speriodUrl }}">{{ $sPosition == 'all' || empty($sPosition) ? '' : 'Any' }}</a>
                    {{ $sPosition == 'all' || empty($sPosition) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mPositionTypes as $item)
                        @if ($sPosition == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $spositionUrl }}sposition={{ generateQueryParam($item['name']) }}"></a>
                                {{ $item['name'] }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $spositionUrl }}sposition={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif

{{-- 
    Pets > Pets for Sale => 30
--}}
@if (in_array($parentPetsForSaleCatId, [30]))
    @if (count($mPetAges) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Pet Age:</div>
            @php
                $petAgeUrl = str_replace('&petage=all', '', $currentRoute);
                $petAgeUrl = str_replace('&petage=0-6-weeks', '', $petAgeUrl);
                $petAgeUrl = str_replace('&petage=6-10-months', '', $petAgeUrl);
                $petAgeUrl = str_replace('&petage=10-16-months', '', $petAgeUrl);
                $petAgeUrl = str_replace('&petage=16-17-years', '', $petAgeUrl);
                $petAgeUrl = str_replace('&petage=17-19-years', '', $petAgeUrl);
                $petAgeUrl = str_replace('&petage=19-21-years', '', $petAgeUrl);
                $petAgeUrl = str_replace('&petage=6+years', '', $petAgeUrl);
                $petAgeUrl = str_replace('?petage=all', '?', $petAgeUrl);
                $petAgeUrl = str_replace('?petage=0-6-weeks', '?', $petAgeUrl);
                $petAgeUrl = str_replace('?petage=6-10-months', '?', $petAgeUrl);
                $petAgeUrl = str_replace('?petage=10-16-months', '?', $petAgeUrl);
                $petAgeUrl = str_replace('?page=16-17-years', '?', $petAgeUrl);
                $petAgeUrl = str_replace('?petage=17-19-years', '?', $petAgeUrl);
                $petAgeUrl = str_replace('?petage=6+years', '?', $petAgeUrl);
                $petAgeUrl = str_replace('?&', '?', $petAgeUrl);
            @endphp
            <ul>
                <li class="{{ $petAge == 'all' || empty($petAge) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $petAgeUrl }}">{{ $petAge == 'all' || empty($petAge) ? '' : 'Any' }}</a>
                    {{ $petAge == 'all' || empty($petAge) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mPetAges as $key => $value)
                        @if ($sPosition == generateQueryParam($key))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $petAgeUrl }}petage={{ generateQueryParam($key) }}"></a>
                                {{ $value }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $petAgeUrl }}petage={{ generateQueryParam($key) }}"
                                    class="category-selected l2-item">
                                    {{ $value }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
    @if (count($mPetGenders) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Gender:</div>
            @php
                $petGenderUrl = str_replace('&pgender=all', '', $currentRoute);
                $petGenderUrl = str_replace('&pgender=male', '', $currentRoute);
                $petGenderUrl = str_replace('&pgender=female', '', $petGenderUrl);
                $petGenderUrl = str_replace('&pgender=mix', '', $petGenderUrl);
                $petGenderUrl = str_replace('?pgender=all', '?', $petGenderUrl);
                $petGenderUrl = str_replace('?pgender=male', '?', $petGenderUrl);
                $petGenderUrl = str_replace('?pgender=female', '?', $petGenderUrl);
                $petGenderUrl = str_replace('?pgender=mix', '?', $petGenderUrl);
                $petGenderUrl = str_replace('?&', '?', $petGenderUrl);
            @endphp
            <ul>
                <li class="{{ $pGender == 'all' || empty($pGender) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $petGenderUrl }}">{{ $pGender == 'all' || empty($pGender) ? '' : 'Any' }}</a>
                    {{ $pGender == 'all' || empty($pGender) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mPetGenders as $item)
                        @if ($pGender == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $petGenderUrl }}pgender={{ generateQueryParam($item['name']) }}"></a>
                                {{ $item['name'] }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $petGenderUrl }}pgender={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
//Vehicles > Cars => 36
//Vehicles > Motorcycles => 37
//Vehicles > Scooters => 38
//Vehicles > Tractors => 40
//Vehicles > Buses => 41
//Vehicles > Trucks => 42
--}}
@if (in_array($parentVehicleSecondCatId, [36, 37, 38, 40, 41, 42]))
    <div class="box-1 locations">
        <form method="post" wire:submit.prevent="filterParams()">
            <div class="heading">Year:</div>
            <div class="update-price">
                <div class="input-bx-1">
                    <label for="">From</label>
                    <input type="text" wire:model.defer="minYear">
                </div>
                <div class="input-bx-1">
                    <label for="">To</label>
                    <input type="text" wire:model.defer="maxYear">
                </div>
                <div class="input-bx-2">
                    <input type="submit" value="Go">
                </div>
            </div>
        </form>
    </div>
@endif
{{-- 
//Vehicles > Cars => 36
//Vehicles > Motorcycles => 37
//Vehicles > Scooters => 38
 //Vehicles > Bicycles => 39
 //Vehicles > Tractors => 40
//Vehicles > Buses => 41
//Vehicles > Trucks => 42
--}}
@if (in_array($parentVehicleSecondCatId, [36, 37, 38, 39, 40, 41, 42]))
    <div class="box-1 locations">
        <form method="post" wire:submit.prevent="filterParams()">
            <div class="heading">Kilometers:</div>
            <div class="update-price">
                <div class="input-bx-1">
                    <label for="">From</label>
                    <input type="text" wire:model.defer="minKm">
                </div>
                <div class="input-bx-1">
                    <label for="">To</label>
                    <input type="text" wire:model.defer="maxKm">
                </div>
                <div class="input-bx-2">
                    <input type="submit" value="Go">
                </div>
            </div>
        </form>
    </div>
@endif
{{--
//Vehicles > Tractors => 40
--}}
@if (in_array($parentVehicleSecondCatId, [40]))
    @if (count($mHpPowers) > 0)
        <div class="box-1 categories-list">
            <div class="heading">HP Power:</div>
            @php
                $hpUrl = str_replace('&hp=all', '', $currentRoute);
                $hpUrl = str_replace('&hp=1-20-hp', '', $hpUrl);
                $hpUrl = str_replace('&hp=21-30-hp', '', $hpUrl);
                $hpUrl = str_replace('&hp=31-40-hp', '', $hpUrl);
                $hpUrl = str_replace('&hp=41-50-hp', '', $hpUrl);
                $hpUrl = str_replace('&hp=51-70-hp', '', $hpUrl);
                $hpUrl = str_replace('&hp=71-150-hp', '', $hpUrl);
                $hpUrl = str_replace('?hp=all', '?', $hpUrl);
                $hpUrl = str_replace('?hp=1-20-hp', '?', $hpUrl);
                $hpUrl = str_replace('?hp=21-30-hp', '?', $hpUrl);
                $hpUrl = str_replace('?hp=31-40-hp', '?', $hpUrl);
                $hpUrl = str_replace('?hp=41-50-hp', '?', $hpUrl);
                $hpUrl = str_replace('?hp=51-70-hp', '?', $hpUrl);
                $hpUrl = str_replace('?hp=71-150-hp', '?', $hpUrl);
                $hpUrl = str_replace('?&', '?', $hpUrl);
            @endphp
            <ul>
                <li class="{{ $hp == 'all' || empty($hp) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $hpUrl }}">{{ $hp == 'all' || empty($hp) ? '' : 'Any' }}</a>
                    {{ $hp == 'all' || empty($hp) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mHpPowers as $key => $value)
                        @if ($hp == generateQueryParam($key))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $hpUrl }}hp={{ generateQueryParam($key) }}"></a>
                                {{ $value }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $hpUrl }}hp={{ generateQueryParam($key) }}"
                                    class="category-selected l2-item">
                                    {{ $value }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
//Vehicles > Cars => 36
//Vehicles > Motorcycles => 37
//Vehicles > Scooters => 38
 //Vehicles > Bicycles => 39
//Vehicles > Tractors => 40
//Vehicles > Buses => 41
//Vehicles > Trucks => 42
--}}
@if (in_array($parentVehicleSecondCatId, [36, 37, 38, 39, 40, 41, 42]))
    @if (count($mFuelTypes) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Fuel Type:</div>
            @php
                $fuelTypeUrl = str_replace('&ftype=all', '', $currentRoute);
                $fuelTypeUrl = str_replace('&ftype=petrol', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=diesel', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=lpg', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=electric', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=hybrid', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=hydrogen', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=cng', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=other', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=all', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=petrol', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=diesel', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=lpg', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=electric', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=hybrid', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=hydrogen', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=cng', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=other', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?&', '?', $fuelTypeUrl);
            @endphp
            <ul>
                <li class="{{ $fType == 'all' || empty($fType) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $fuelTypeUrl }}">{{ $fType == 'all' || empty($fType) ? '' : 'Any' }}</a>
                    {{ $fType == 'all' || empty($fType) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mFuelTypes as $item)
                        @if ($fType == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $fuelTypeUrl }}ftype={{ generateQueryParam($item['name']) }}"></a>
                                {{ $item['name'] }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $fuelTypeUrl }}ftype={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{--
//Vehicles > Cars => 36
//Vehicles > Buses => 41
//Vehicles > Trucks => 42
--}}
@if (in_array($parentVehicleSecondCatId, [36, 41, 42]))
    @if (count($mTransmissions) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Transmission:</div>
            @php
                $transmissionUrl = str_replace('&transmission=all', '', $currentRoute);
                $transmissionUrl = str_replace('&transmission=automatic', '', $transmissionUrl);
                $transmissionUrl = str_replace('&transmission=manual', '', $transmissionUrl);
                $transmissionUrl = str_replace('?transmission=all', '?', $transmissionUrl);
                $transmissionUrl = str_replace('?transmission=automatic', '?', $transmissionUrl);
                $transmissionUrl = str_replace('?transmission=manual', '?', $transmissionUrl);
                $transmissionUrl = str_replace('?&', '?', $transmissionUrl);
            @endphp
            <ul>
                <li
                    class="{{ $transmission == 'all' || empty($transmission) ? 'highlight highlight-l1-item' : '' }}">
                    <a
                        href="{{ $transmissionUrl }}">{{ $transmission == 'all' || empty($transmission) ? '' : 'Any' }}</a>
                    {{ $transmission == 'all' || empty($transmission) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mTransmissions as $item)
                        @if ($transmission == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item">
                                <a
                                    href="{{ $transmissionUrl }}transmission={{ generateQueryParam($item['name']) }}"></a>
                                {{ $item['name'] }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $transmissionUrl }}transmission={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
//Vehicles > Cars => 36
//Vehicles > Motorcycles => 37
//Vehicles > Scooters => 38
//Vehicles > Tractors => 40
//Vehicles > Buses => 41
//Vehicles > Trucks => 42
--}}
@if (in_array($parentVehicleSecondCatId, [36, 37, 38, 40, 41, 42]))
    @if (count($mOwners) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Owners:</div>
            @php
                $ownerUrl = str_replace('&owner=all', '', $currentRoute);
                $ownerUrl = str_replace('&owner=1st-owner', '', $ownerUrl);
                $ownerUrl = str_replace('&owner=2nd-owner', '', $ownerUrl);
                $ownerUrl = str_replace('&owner=3rd-owner', '', $ownerUrl);
                $ownerUrl = str_replace('&owner=4th-owner', '', $ownerUrl);
                $ownerUrl = str_replace('?owner=all', '?', $ownerUrl);
                $ownerUrl = str_replace('?owner=1st-owner', '?', $ownerUrl);
                $ownerUrl = str_replace('?owner=2nd-owner', '?', $ownerUrl);
                $ownerUrl = str_replace('?owner=3rd-owner', '?', $ownerUrl);
                $ownerUrl = str_replace('?owner=4th-owner', '?', $ownerUrl);
                $ownerUrl = str_replace('?&', '?', $ownerUrl);
            @endphp
            <ul>
                <li class="{{ $owner == 'all' || empty($owner) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $ownerUrl }}">{{ $owner == 'all' || empty($owner) ? '' : 'Any' }}</a>
                    {{ $owner == 'all' || empty($owner) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mOwners as $item)
                        @if ($owner == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $ownerUrl }}owner={{ generateQueryParam($item['name']) }}"></a>
                                {{ $item['name'] }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $ownerUrl }}owner={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{--
 //Vehicles > Buses => 41
//Vehicles > Trucks => 42
--}}
@if (in_array($parentVehicleSecondCatId, [41, 42]))
    @if (count($mbodyTypes) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Body Type:</div>
            @php
                $bTypeUrl = str_replace('&btype=all', '', $currentRoute);
                $bTypeUrl = str_replace('&btype=school', '', $bTypeUrl);
                $bTypeUrl = str_replace('&btype=staff', '', $bTypeUrl);
                $bTypeUrl = str_replace('&btype=sleeper', '', $bTypeUrl);
                $bTypeUrl = str_replace('&btype=route-permit', '', $bTypeUrl);
                $bTypeUrl = str_replace('?btype=all', '?', $bTypeUrl);
                $bTypeUrl = str_replace('?btype=school', '?', $bTypeUrl);
                $bTypeUrl = str_replace('?btype=staff', '?', $bTypeUrl);
                $bTypeUrl = str_replace('?btype=sleeper', '?', $bTypeUrl);
                $bTypeUrl = str_replace('?btype=route-permit', '?', $bTypeUrl);
                $bTypeUrl = str_replace('?&', '?', $bTypeUrl);
            @endphp
            <ul>
                <li class="{{ $bType == 'all' || empty($bType) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $bTypeUrl }}">{{ $bType == 'all' || empty($bType) ? '' : 'Any' }}</a>
                    {{ $bType == 'all' || empty($bType) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mbodyTypes as $item)
                        @if ($bType == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $bTypeUrl }}btype={{ generateQueryParam($item['name']) }}"></a>
                                {{ $item['name'] }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $bTypeUrl }}btype={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
    //Property > Property For Sale > Houses for Sale => 15
    //Property > Property For Sale > Flats for Sale => 16 
    //Property > Property For Rent > Houses for Rent => 20
    //Property > Property For Rent > Flats for Rent => 21
    //Property > Property For Rent > Roommates & Rooms for Rent => 22
    //Property > Property To Share > Houses for Share => 26
    //Property > Property To Share > Flats for Share => 27
--}}
@if (in_array($parentPropertySecondThirdCatId, [15, 16, 20, 21, 22, 26, 27]))
    @if (count($mBedrooms) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Bedroom:</div>
            @php
                $bedroomUrl = str_replace('&bedroom=all', '', $currentRoute);
                $bedroomUrl = str_replace('&bedroom=1-bhk', '', $bedroomUrl);
                $bedroomUrl = str_replace('&bedroom=2-bhk', '', $bedroomUrl);
                $bedroomUrl = str_replace('&bedroom=3-bhk', '', $bedroomUrl);
                $bedroomUrl = str_replace('&bedroom=4-bhk', '', $bedroomUrl);
                $bedroomUrl = str_replace('&bedroom=5-bhk', '', $bedroomUrl);
                $bedroomUrl = str_replace('?bedroom=all', '?', $bedroomUrl);
                $bedroomUrl = str_replace('?bedroom=1-bhk', '?', $bedroomUrl);
                $bedroomUrl = str_replace('?bedroom=2-bhk', '?', $bedroomUrl);
                $bedroomUrl = str_replace('?bedroom=3-bhk', '?', $bedroomUrl);
                $bedroomUrl = str_replace('?bedroom=4-bhk', '?', $bedroomUrl);
                $bedroomUrl = str_replace('?bedroom=5-bhk', '?', $bedroomUrl);
                $bedroomUrl = str_replace('?&', '?', $bedroomUrl);
            @endphp
            <ul>
                <li class="{{ $bedroom == 'all' || empty($bedroom) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $bedroomUrl }}">{{ $bedroom == 'all' || empty($bedroom) ? '' : 'Any' }}</a>
                    {{ $bedroom == 'all' || empty($bedroom) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mBedrooms as $item)
                        @if ($bedroom == generateQueryParam($item['id']) . '-bhk')
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $bedroomUrl }}bedroom={{ generateQueryParam($item['id']) }}-bhk"></a>
                                {{ $item['name'] }} BHK
                            </li>
                        @else
                            <li>
                                <a href="{{ $bedroomUrl }}bedroom={{ $item['id'] }}-bhk"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }} BHK
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
    @if (count($mBathrooms) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Bathroom:</div>
            @php
                $bathroomUrl = str_replace('&bathroom=all', '', $currentRoute);
                $bathroomUrl = str_replace('&bathroom=1-bathroom', '', $currentRoute);
                $bathroomUrl = str_replace('&bathroom=2-bathroom', '', $bathroomUrl);
                $bathroomUrl = str_replace('&bathroom=3-bathroom', '', $bathroomUrl);
                $bathroomUrl = str_replace('&bathroom=4-bathroom', '', $bathroomUrl);
                $bathroomUrl = str_replace('?bathroom=all', '?', $bathroomUrl);
                $bathroomUrl = str_replace('?bathroom=1-bathroom', '?', $bathroomUrl);
                $bathroomUrl = str_replace('?bathroom=2-bathroom', '?', $bathroomUrl);
                $bathroomUrl = str_replace('?bathroom=3-bathroom', '?', $bathroomUrl);
                $bathroomUrl = str_replace('?bathroom=4-bathroom', '?', $bathroomUrl);
                $bathroomUrl = str_replace('?&', '?', $bathroomUrl);
            @endphp
            <ul>
                <li class="{{ $bathroom == 'all' || empty($bathroom) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $bathroomUrl }}">{{ $bathroom == 'all' || empty($bathroom) ? '' : 'Any' }}</a>
                    {{ $bathroom == 'all' || empty($bathroom) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mBathrooms as $item)
                        @if ($bathroom == generateQueryParam($item['id']) . '-bathroom')
                            <li class="highlight highlight-l1-item">
                                <a
                                    href="{{ $bathroomUrl }}bathroom={{ generateQueryParam($item['id']) }}-bathroom"></a>
                                {{ $item['name'] }} Bathroom
                            </li>
                        @else
                            <li>
                                <a href="{{ $bathroomUrl }}bathroom={{ $item['id'] }}-bathroom"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }} Bathroom
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
//Property > Property For Sale > Houses for Sale => 15
//Property > Property For Sale > Flats for Sale => 16 
//Property > Property For Sale > Commercial Space for Sale => 19
//Property > Property For Rent > Houses for Rent => 20
//Property > Property For Rent > Flats for Rent => 21
//Property > Property For Rent > Roommates & Rooms for Rent => 22
//Property > Property For Rent > Commercial Space for Rent => 25
//Property > Property To Share > Houses for Share => 26
//Property > Property To Share > Flats for Share => 27
//Property > Property To Share > Commercial Space for Shared => 28
//Property > Guest Houses & PG => 29
--}}
@if (in_array($parentPropertySecondThirdCatId, [15, 16, 19, 20, 21, 22, 25, 26, 27, 28, 29]))
    @if (count($mFurnishing) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Furnishing:</div>
            @php
                $furnishingUrl = str_replace('&furnishing=all', '', $currentRoute);
                $furnishingUrl = str_replace('&furnishing=unfurnished', '', $furnishingUrl);
                $furnishingUrl = str_replace('&furnishing=semi-furnished', '', $furnishingUrl);
                $furnishingUrl = str_replace('&furnishing=fully-furnished', '', $furnishingUrl);
                $furnishingUrl = str_replace('?furnishing=all', '?', $furnishingUrl);
                $furnishingUrl = str_replace('?furnishing=unfurnished', '?', $furnishingUrl);
                $furnishingUrl = str_replace('?furnishing=semi-furnished', '?', $furnishingUrl);
                $furnishingUrl = str_replace('?furnishing=fully-furnished', '?', $furnishingUrl);
                $furnishingUrl = str_replace('?&', '?', $furnishingUrl);
            @endphp
            <ul>
                <li class="{{ $furnishing == 'all' || empty($furnishing) ? 'highlight highlight-l1-item' : '' }}">
                    <a
                        href="{{ $furnishingUrl }}">{{ $furnishing == 'all' || empty($furnishing) ? '' : 'Any' }}</a>
                    {{ $furnishing == 'all' || empty($furnishing) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mFurnishing as $item)
                        @if ($furnishing == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item">
                                <a
                                    href="{{ $furnishingUrl }}furnishing={{ generateQueryParam($item['name']) }}"></a>
                                {{ $item['name'] }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $furnishingUrl }}furnishing={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
//Property > Property For Sale > Houses for Sale => 15
//Property > Property For Sale > Flats for Sale => 16 
//Property > Property For Sale > Land for Sale => 17
//Property > Property For Sale > Parking for Sale => 18
//Property > Property For Sale > Commercial Space for Sale => 19
//Property > Property For Rent > Houses for Rent => 20
//Property > Property For Rent > Flats for Rent => 21
//Property > Property For Rent > Roommates & Rooms for Rent => 22
//Property > Property For Rent > Parking for Rent => 23
//Property > Property For Rent > Land for Rent => 24
//Property > Property For Rent > Commercial Space for Rent => 25
//Property > Property To Share > Houses for Share => 26
//Property > Property To Share > Flats for Share => 27
//Property > Property To Share > Commercial Space for Shared => 28
//Property > Guest Houses & PG => 29
--}}
@if (in_array($parentPropertySecondThirdCatId, [15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29]))
    @if (count($mListedBy) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Listed By:</div>
            @php
                $listedByUrl = str_replace('&listedby=all', '', $currentRoute);
                $listedByUrl = str_replace('&listedby=builder', '', $listedByUrl);
                $listedByUrl = str_replace('&listedby=dealer', '', $listedByUrl);
                $listedByUrl = str_replace('&listedby=owner', '', $listedByUrl);
                $listedByUrl = str_replace('?listedby=all', '?', $listedByUrl);
                $listedByUrl = str_replace('?listedby=builder', '?', $listedByUrl);
                $listedByUrl = str_replace('?listedby=dealer', '?', $listedByUrl);
                $listedByUrl = str_replace('?listedby=owner', '?', $listedByUrl);
                $listedByUrl = str_replace('?&', '?', $listedByUrl);
            @endphp
            <ul>
                <li class="{{ $listedBy == 'all' || empty($listedBy) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $listedByUrl }}">{{ $listedBy == 'all' || empty($listedBy) ? '' : 'Any' }}</a>
                    {{ $listedBy == 'all' || empty($listedBy) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mListedBy as $item)
                        @if ($listedBy == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $listedByUrl }}listedby={{ generateQueryParam($item['name']) }}"></a>
                                {{ $item['name'] }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $listedByUrl }}listedby={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
--}}
<!--
    //Property > Property For Sale > Houses for Sale => 15
    //Property > Property For Sale > Flats for Sale => 16
    //Property > Property For Sale > Commercial Space for Sale => 19
    //Property > Property For Rent > Houses for Rent => 20
    //Property > Property For Rent > Flats for Rent => 21
    //Property > Property For Rent > Commercial Space for Rent => 25
    //Property > Property To Share > Houses for Share => 26
    //Property > Property To Share > Flats for Share => 27
    //Property > Property To Share > Commercial Space for Shared => 28
    //Property > Guest Houses & PG => 29 -->
@if (in_array($this->parentPropertySecondThirdCatId, [100]))
    @if (count($mCarParking) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Car Parking:</div>
            @php
                $fuelTypeUrl = str_replace('&ftype=all', '', $currentRoute);
                $fuelTypeUrl = str_replace('&ftype=1', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=2', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=3', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=4', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=5', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=6', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=7', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('&ftype=8', '', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=all', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=1', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=2', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=3', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=4', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=5', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=6', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=7', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?ftype=8', '?', $fuelTypeUrl);
                $fuelTypeUrl = str_replace('?&', '?', $fuelTypeUrl);
            @endphp
            <ul>
                <li class="{{ $fuelTypeUrl == 'all' || empty($listedBy) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $fuelTypeUrl }}">{{ $fuelTypeUrl == 'all' ? '' : 'Any' }}</a>
                    {{ $fuelTypeUrl == 'all' ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mCarParking as $item)
                        <li>
                            <a href="{{ $fuelTypeUrl }}ftype={{ $item['id'] }}"
                                class="category-selected l2-item">
                                {{ $item['name'] }}
                                <span class="count">
                                    
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
--}}
<!--
    //Property > Property For Sale > Land for Sale => 17
    //Property > Property For Sale > Parking for Sale => 18
    //Property > Property For Sale > Houses for Sale => 15
    //Property > Property For Sale > Flats for Sale => 16
    //Property > Property For Rent > Houses for Rent => 20
    //Property > Property For Rent > Flats for Rent => 21
    //Property > Property For Rent > Parking for Rent => 23
    //Property > Property For Rent > Land for Rent => 24
    //Property > Property To Share > Houses for Share => 26
    //Property > Property To Share > Flats for Share => 27
-->
@if (in_array($this->parentPropertySecondThirdCatId, [100]))
    @if (count($mFacing) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Facing:</div>
            <ul>
                <li class="highlight highlight-l1-item">
                    <a href="#">x</a>
                    All Adds
                </li>
                <ul>
                    @php
                        $fuelTypeUrl = str_replace('&ftype=1', '', $currentRoute);
                        $fuelTypeUrl = str_replace('&ftype=2', '', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('&ftype=3', '', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('&ftype=4', '', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('&ftype=5', '', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('&ftype=6', '', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('&ftype=7', '', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('&ftype=8', '', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('?ftype=1', '?', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('?ftype=2', '?', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('?ftype=3', '?', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('?ftype=4', '?', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('?ftype=5', '?', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('?ftype=6', '?', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('?ftype=7', '?', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('?ftype=8', '?', $fuelTypeUrl);
                        $fuelTypeUrl = str_replace('?&', '?', $fuelTypeUrl);
                    @endphp
                    @foreach ($mFacing as $item)
                        <li>
                            <a href="{{ $fuelTypeUrl }}ftype={{ $item['id'] }}"
                                class="category-selected l2-item">
                                {{ $item['name'] }}
                                <span class="count">
                                    
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
//Property > Property For Sale > Houses for Sale => 15
//Property > Property For Sale > Flats for Sale => 16 
//Property > Property For Sale > Commercial Space for Sale => 19
--}}
@if (in_array($this->parentPropertySecondThirdCatId, [15, 16, 19]))
    @if (count($mConstructionStatus) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Construction Status:</div>
            @php
                $cstatusUrl = str_replace('&cstatus=all', '', $currentRoute);
                $cstatusUrl = str_replace('&cstatus=new-launch', '', $cstatusUrl);
                $cstatusUrl = str_replace('&cstatus=ready-to-move', '', $cstatusUrl);
                $cstatusUrl = str_replace('&cstatus=under-construction', '', $cstatusUrl);
                $cstatusUrl = str_replace('?cstatus=all', '?', $cstatusUrl);
                $cstatusUrl = str_replace('?cstatus=new-launch', '?', $cstatusUrl);
                $cstatusUrl = str_replace('?cstatus=ready-to-move', '?', $cstatusUrl);
                $cstatusUrl = str_replace('?cstatus=under-construction', '?', $cstatusUrl);
                $cstatusUrl = str_replace('?&', '?', $cstatusUrl);
            @endphp
            <ul>
                <li
                    class="{{ $constructionStatus == 'all' || empty($constructionStatus) ? 'highlight highlight-l1-item' : '' }}">
                    <a
                        href="{{ $cstatusUrl }}">{{ $constructionStatus == 'all' || empty($constructionStatus) ? '' : 'Any' }}</a>
                    {{ $constructionStatus == 'all' || empty($constructionStatus) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($mConstructionStatus as $item)
                        @if ($constructionStatus == generateQueryParam($item['name']))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $cstatusUrl }}cstatus={{ generateQueryParam($item['name']) }}"></a>
                                {{ $item['name'] }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $cstatusUrl }}cstatus={{ generateQueryParam($item['name']) }}"
                                    class="category-selected l2-item">
                                    {{ $item['name'] }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
{{-- 
//Property > Property For Sale > Houses for Sale => 15
//Property > Property For Sale > Flats for Sale => 16 
//Property > Property For Sale > Commercial Space for Sale => 19
//Property > Property For Rent > Houses for Rent => 20
//Property > Property For Rent > Flats for Rent => 21
 //Property > Property For Rent > Roommates & Rooms for Rent => 22
//Property > Property For Rent > Commercial Space for Rent => 25
 //Property > Property To Share > Houses for Share => 26
//Property > Property To Share > Flats for Share => 27
 //Property > Property To Share > Commercial Space for Shared => 28
--}}
@if (in_array($parentPropertySecondThirdCatId, [15, 16, 19, 20, 21, 22, 25, 26, 27, 28]))

    @if (count($superBuiltupAreaRange) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Super Builtup Area:</div>
            @php
                $spBultUpArea = str_replace('&sparea=all', '', $currentRoute);
                $spBultUpArea = str_replace('&sparea=0-50-sp-feet', '', $spBultUpArea);
                $spBultUpArea = str_replace('&sparea=501-1250-sp-feet', '', $spBultUpArea);
                $spBultUpArea = str_replace('&sparea=1251-2000-sp-feet', '', $spBultUpArea);
                $spBultUpArea = str_replace('&sparea=2001-3000-sp-feet', '', $spBultUpArea);
                $spBultUpArea = str_replace('&sparea=3001-5000-sp-feet', '', $spBultUpArea);
                $spBultUpArea = str_replace('&sparea=more-than-5000-sp-feet', '', $spBultUpArea);
                $spBultUpArea = str_replace('?sparea=all', '?', $spBultUpArea);
                $spBultUpArea = str_replace('?sparea=0-50-sp-feet', '?', $spBultUpArea);
                $spBultUpArea = str_replace('?sparea=501-1250-sp-feet', '?', $spBultUpArea);
                $spBultUpArea = str_replace('?sparea=1251-2000-sp-feet', '?', $spBultUpArea);
                $spBultUpArea = str_replace('?sparea=2001-3000-sp-feet', '?', $spBultUpArea);
                $spBultUpArea = str_replace('?sparea=3001-5000-sp-feet', '?', $spBultUpArea);
                $spBultUpArea = str_replace('?sparea=more-than-5000-sp-feet', '?', $spBultUpArea);
                $spBultUpArea = str_replace('?&', '?', $spBultUpArea);
            @endphp
            <ul>
                <li
                    class="{{ $superBuiltupArea == 'all' || empty($superBuiltupArea) ? 'highlight highlight-l1-item' : '' }}">
                    <a
                        href="{{ $spBultUpArea }}">{{ $superBuiltupArea == 'all' || empty($superBuiltupArea) ? '' : 'Any' }}</a>
                    {{ $superBuiltupArea == 'all' || empty($superBuiltupArea) ? 'Any' : '' }}
                </li>
                <ul>

                    @foreach ($superBuiltupAreaRange as $key => $value)
                        @if ($superBuiltupArea == generateQueryParam($key))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $spBultUpArea }}sparea={{ generateQueryParam($key) }}"></a>
                                {{ $value }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $spBultUpArea }}sparea={{ generateQueryParam($key) }}"
                                    class="category-selected l2-item">
                                    {{ $value }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif


{{-- 
//Property > Property For Sale > Land for Sale => 17
//Property > Property For Sale > Parking for Sale => 18
//Property > Property For Rent > Parking for Rent => 23
//Property > Property For Rent > Land for Rent => 24
--}}
@if (in_array($parentPropertySecondThirdCatId, [17, 18, 23, 24]))

    @if (count($plotAreaRange) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Plot Area:</div>
            @php
                $plotAreaUrl = str_replace('&parea=all', '', $currentRoute);
                $plotAreaUrl = str_replace('&parea=1', '', $plotAreaUrl);
                $plotAreaUrl = str_replace('&parea=2', '', $plotAreaUrl);
                $plotAreaUrl = str_replace('&parea=3', '', $plotAreaUrl);
                $plotAreaUrl = str_replace('&parea=4', '', $plotAreaUrl);
                $plotAreaUrl = str_replace('&parea=5', '', $plotAreaUrl);
                $plotAreaUrl = str_replace('&parea=6', '', $plotAreaUrl);
                $plotAreaUrl = str_replace('&parea=7', '', $plotAreaUrl);
                $plotAreaUrl = str_replace('&parea=8', '', $plotAreaUrl);
                $plotAreaUrl = str_replace('?parea=all', '?', $plotAreaUrl);
                $plotAreaUrl = str_replace('?parea=1', '?', $plotAreaUrl);
                $plotAreaUrl = str_replace('?parea=2', '?', $plotAreaUrl);
                $plotAreaUrl = str_replace('?parea=3', '?', $plotAreaUrl);
                $plotAreaUrl = str_replace('?parea=4', '?', $plotAreaUrl);
                $plotAreaUrl = str_replace('?parea=5', '?', $plotAreaUrl);
                $plotAreaUrl = str_replace('?parea=6', '?', $plotAreaUrl);
                $plotAreaUrl = str_replace('?parea=7', '?', $plotAreaUrl);
                $plotAreaUrl = str_replace('?parea=8', '?', $plotAreaUrl);
                $plotAreaUrl = str_replace('?&', '?', $plotAreaUrl);
            @endphp
            <ul>
                <li class="{{ $plotArea == 'all' || empty($plotArea) ? 'highlight highlight-l1-item' : '' }}">
                    <a href="{{ $plotAreaUrl }}">{{ $plotArea == 'all' || empty($plotArea) ? '' : 'Any' }}</a>
                    {{ $plotArea == 'all' || empty($plotArea) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($plotAreaRange as $key => $value)
                        @if ($plotArea == generateQueryParam($key))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $plotAreaUrl }}parea={{ generateQueryParam($key) }}"></a>
                                {{ $value }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $plotAreaUrl }}parea={{ generateQueryParam($key) }}"
                                    class="category-selected l2-item">
                                    {{ $value }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif


{{-- 
//Property > Property For Rent > Houses for Rent => 20
//Property > Property For Rent > Flats for Rent => 21
//Property > Property To Share > Houses for Share => 26
//Property > Property To Share > Flats for Share => 27
--}}
@if (in_array($parentPropertySecondThirdCatId, [20, 21, 26, 27]))

    @if (count($bachelorsAllowedOption) > 0)
        <div class="box-1 categories-list">
            <div class="heading">Bachelors Allowed:</div>
            @php
                $bachelorsAllowedUrl = str_replace('&ballowed=all', '', $currentRoute);
                $bachelorsAllowedUrl = str_replace('&ballowed=no', '', $bachelorsAllowedUrl);
                $bachelorsAllowedUrl = str_replace('&ballowed=yes', '', $bachelorsAllowedUrl);
                $bachelorsAllowedUrl = str_replace('?ballowed=all', '?', $bachelorsAllowedUrl);
                $bachelorsAllowedUrl = str_replace('?ballowed=no', '?', $bachelorsAllowedUrl);
                $bachelorsAllowedUrl = str_replace('?ballowed=yes', '?', $bachelorsAllowedUrl);
                $bachelorsAllowedUrl = str_replace('?&', '?', $bachelorsAllowedUrl);
            @endphp
            <ul>
                <li
                    class="{{ $bachelorsAllowed == 'all' || empty($bachelorsAllowed) ? 'highlight highlight-l1-item' : '' }}">
                    <a
                        href="{{ $bachelorsAllowedUrl }}">{{ $bachelorsAllowed == 'all' || empty($bachelorsAllowed) ? '' : 'Any' }}</a>
                    {{ $bachelorsAllowed == 'all' || empty($bachelorsAllowed) ? 'Any' : '' }}
                </li>
                <ul>
                    @foreach ($bachelorsAllowedOption as $key => $value)
                        @if ($bachelorsAllowed == generateQueryParam($key))
                            <li class="highlight highlight-l1-item">
                                <a href="{{ $bachelorsAllowedUrl }}ballowed={{ generateQueryParam($key) }}"></a>
                                {{ $value }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $bachelorsAllowedUrl }}ballowed={{ generateQueryParam($key) }}"
                                    class="category-selected l2-item">
                                    {{ $value }}
                                    <span class="count">
                                        
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </div>
    @endif
@endif
</div>

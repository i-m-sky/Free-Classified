@php

$category = [
     "community"=>"fa-solid fa-users",
    "jobs"=>"fa-solid fa-briefcase",
    "property"=>"fa-solid fa-building",
    "pets"=>"fa-solid fa-dog",
    "rent"=>"fa-solid fa-building",
    "for sale"=>"fa-solid fa-chart-simple",
    "services"=>"fa-solid fa-gears fa-rotate-270",
    "vehicles"=>"fa-solid fa-car"
]

@endphp

<div class="company-product">
    @if (count($categories) > 0)
        @foreach ($categories as $key => $item)
            <div class="banner-card  {{ $key > 3 ? 'row-changes' : '' }}">
                <a href="{{ route('post-list', ['location' => 'india', 'category' => $item['slug']])  }}">
                    <!-- <img src="{{ config('global_variables.asset_url') }}/img/{{ $item['image'] }}"
                            alt="{{ $item['name'] }}"> -->
                    <i class="{{$category[strtolower($item['name'])]}}"></i> 
                   <h3 class="banner-card-titles">{{ $item['name'] }}</h3>
                </a>
            </div>
        @endforeach
    @endif
</div>
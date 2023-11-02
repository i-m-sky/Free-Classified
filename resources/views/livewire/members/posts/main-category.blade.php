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

<div class="post-container-flex">
    <div class="company-product">
        @if (count($categories) > 0)
            @foreach ($categories as $key => $item)
                <div class="banner-card {{ $key > 3 ? 'row-changes' : '' }}">
                    <a href="{{ route('new-post') }}" wire:click.prevent="selectCategory('{{ $item['id'] }}')">
                        <!-- <img src="{{ config('global_variables.asset_url') }}/img/{{$item['image']}}"
                            alt="{{ $item['name'] }}"> -->
                        <i class="{{$category[strtolower($item['name'])]}}"></i> 
                        <div class="banner-card-titles">{{ $item['name'] }}</div>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    <div class="banner-ads">
        <div class="post-ads-container">
            <div wire:loading>
                Loading...
            </div>
            @if (isset($selectedCatId) && !empty($selectedCatId))
                <livewire:members.posts.sub-category :selectedCatId="$selectedCatId" :catSlug2="$catSlug2" :catSlug3="$catSlug3"
                    key="sub-category-{{ now()->timestamp }}" />
            @endif
        </div>
    </div>
</div>

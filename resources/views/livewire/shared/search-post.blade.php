
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


<section class="section-search">
    <div class="wrapper">
        <input type="hidden" id="locationUrl" value="{{ route('search-location') }}" />
        <input type="hidden" id="catgeroyUrl" value="{{ route('search-categories') }}" />
        <div class="search-fields" style="width: 100%">
            <div class="cities" style="width: 49%;margin-right:1%;">
                <input class="field-cities" type="text" placeholder="All India" id="search-box-locaction"
                    wire:model.defer="locaton" />
                <div class="search-box-locaction" id="suggesstion-box-search-locaction"></div>
            </div>
            <div class="categories" style="width: 49%; margin-left:1%;">
                <div style="margin:15px 0" class='category-search-wrap'>
                    <select class="select2-icon dashboard-select-dropdown field-categories" name="icon" wire:model="category" id="category">
                        <option value="all" data-icon="fa-solid fa-layer-group">All categories</option>
                        @if (count($categories) > 0)
                            @foreach ($categories as $item)
                                <option  value="{{ $item['slug'] }}" data-icon="{{$category[strtolower($item['name'])]}}">{{ $item['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                

                <!-- <select class="field-categories"  name="icon" wire:model="category" id="category">
                    <option value="all">All categories</option>
                    @if (count($categories) > 0)
                        @foreach ($categories as $item)
                            <option value="{{ $item['slug'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    @endif
                </select> -->
                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg> -->
            </div>
            <div class="search-tag" style="width: 100%">
                <input style="width: 78%" class="field-search-tag field-search-bar" type="text" placeholder="What are you looking for?" wire:model.defer="search"
                    id="search-box-category" />
                <div class="search-box-category" id="suggesstion-box-search-category"></div>
                <button style="width: 20%" type="submit" class="input-field-search" wire:click="searchPost">
                    <i class="fa-solid fa-magnifying-glass"></i>&nbsp;
                    <span class="search-label">Search</span>
                </button>
                    
            </div>
        </div>
    </div>

   <!--  <script>
        function formatText (icon) {
            return $('<span><i class="fas ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
        };

        $('.select2-icon').select2({
            width: "100%",
            templateSelection: formatText,
            templateResult: formatText
        }); 
    </script> -->
</section>
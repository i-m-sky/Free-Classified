@php
$query = Request::query();
@endphp
<section class="list-products list-page">
    @php
        $categoryTitle = getCategoryTitle('meta', $locationType, $location, $locRow, $stateRow, $cityRow, $category, $catRow, $catNav, $search, $minPrice, $maxPrice, $minSalary, $maxSalary, $condition, $sPeriod, $sPosition, $petAge, $pGender, $minKm, $maxKm, $minYear, $maxYear, $fType, $transmission, $owner, $hp, $bType, $bedroom, $bathroom, $furnishing, $listedBy, $constructionStatus, $superBuiltupArea, $plotArea, $bachelorsAllowed);
        $h1Title = getCategoryTitle('h1', $locationType, $location, $locRow, $stateRow, $cityRow, $category, $catRow, $catNav, $search, $minPrice, $maxPrice, $minSalary, $maxSalary, $condition, $sPeriod, $sPosition, $petAge, $pGender, $minKm, $maxKm, $minYear, $maxYear, $fType, $transmission, $owner, $hp, $bType, $bedroom, $bathroom, $furnishing, $listedBy, $constructionStatus, $superBuiltupArea, $plotArea, $bachelorsAllowed);
    @endphp
    @section('metatags')
        <title>{{ $categoryTitle }}</title>
        <meta name="description" content="{{ $categoryTitle }}" />
        <meta name="keywords" content="{{ $categoryTitle }}" />
        <meta property="og:title" content="{{ $categoryTitle }}">
    @endsection
    <div class="wrapper">
        <div class="list-container">
            <div class="show-results">
                <h1>
                    {{ $h1Title }}
                </h1>
                <div class="result-txt">- {{ number_format($posts->total()) }} Results</div>
                <div class="select-box">
                    <select wire:model="orderBy">
                        <option value="new">Newest First</option>
                        <option value="old">Oldest First</option>
                        @if (in_array($parentNavCatId, [1, 2, 7]))
                        @else
                            <option value="phigh">Price: Low to High</option>
                            <option value="plow">Price: High to Low</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="list-box">
                <div class="products-details">
                    <div class="d-flex justify-content-between flex-mob-dir">
                        <div class="select-box">
                            <select wire:model="orderBy">
                                <option value="new">Newest First</option>
                                <option value="old">Oldest First</option>
                                @if (in_array($parentNavCatId, [1, 2, 7]))
                                @else
                                    <option value="phigh">Price: Low to High</option>
                                    <option value="plow">Price: High to Low</option>
                                @endif
                            </select>
                        </div>
                        <div class="filter-button">
                            <button class="d-flex justify-content-between fillterBtn">Filter Results
                                <span class="filter-result-quantity2"><span class="filter-result-quantity">{{ number_format($posts->total()) }}</span>
                                    <!-- <svg class="ml-2" fill="#000000" height="20px" width="10px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                         viewBox="0 0 330 330" xml:space="preserve">
                                        <path id="XMLID_225_" d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393
                                        c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393
                                        s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z"/>
                                    </svg> -->
                                    <img class="ml-2 filter-result-quantity-img" src="http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png">
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="clr"></div>
                    <livewire:posts.list.post-left-filter key="post-left-filter-{{ now()->timestamp }}"
                        :locationType="$locationType" :location="$location" :locRow="$locRow" :stateRow="$stateRow" :cityRow="$cityRow"
                        :category="$category" :catRow="$catRow" :catNav="$catNav" :search="$search" :minPrice="$minPrice"
                        :maxPrice="$maxPrice" :minSalary="$minSalary" :maxSalary="$maxSalary" :condition="$condition" :sPeriod="$sPeriod"
                        :sPosition="$sPosition" :petAge="$petAge" :pGender="$pGender" :minKm="$minKm" :maxKm="$maxKm"
                        :minYear="$minYear" :maxYear="$maxYear" :fType="$fType" :transmission="$transmission" :owner="$owner"
                        :hp="$hp" :bType="$bType" :bedroom="$bedroom" :bathroom="$bathroom" :furnishing="$furnishing"
                        :listedBy="$listedBy" :constructionStatus="$constructionStatus" :superBuiltupArea="$superBuiltupArea" :plotArea="$plotArea"
                        :bachelorsAllowed="$bachelorsAllowed" />
                </div>
                <div class="products-links products-links-cat ">
                    <!-- <div class="selected-tag mb-3 mt-md-01"> -->
                    @if(count($query) > 0)
                    <div class="selected-tag mt-md-01">
                        @php  $filterCount = 0; @endphp
                        {{-- @if (!empty($category) && $category != 'all')
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Category: {{ $catRow['name'] }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('category')">&times;</span></span>
                        @endif
                        @if (!empty($location) && $location !== 'india')
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Location: {{ $locRow['name'] }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('location')">&times;</span></span>
                        @endif --}}
                        @if (!empty($minPrice))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Minimum Price: {{ $minPrice }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('minPrice')">&times;</span></span>
                        @endif
                        @if (!empty($maxPrice))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Maximum Price: {{ $maxPrice }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('maxPrice')">&times;</span></span>
                        @endif
                        @if (!empty($minSalary))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Minimum Salary: {{ $minSalary }}<span
                                    class="close-tag-btn"
                                    wire:click="removeFilterByField('minSalary')">&times;</span></span>
                        @endif
                        @if (!empty($maxSalary))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Maximum Salary: {{ $maxSalary }}<span
                                    class="close-tag-btn"
                                    wire:click="removeFilterByField('maxSalary')">&times;</span></span>
                        @endif
                        @if (!empty($condition))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Condition: {{ $condition }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('condition')">&times;</span></span>
                        @endif
                        @if (!empty($sPeriod))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Salary Period: {{ $sPeriod }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('sPeriod')">&times;</span></span>
                        @endif
                        @if (!empty($sPosition))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Position Type: {{ $sPosition }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('sPosition')">&times;</span></span>
                        @endif
                        @if (!empty($petAge))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Pet Age: {{ $petAge }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('petAge')">&times;</span></span>
                        @endif
                        @if (!empty($pGender))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Gender: {{ $pGender }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('pGender')">&times;</span></span>
                        @endif
                        @if (!empty($minKm))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Minimum Kilometers: {{ $minKm }}<span
                                    class="close-tag-btn"
                                    wire:click="removeFilterByField('minKm')">&times;</span></span>
                        @endif
                        @if (!empty($maxKm))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Maximum Kilometers: {{ $maxKm }}<span
                                    class="close-tag-btn"
                                    wire:click="removeFilterByField('maxKm')">&times;</span></span>
                        @endif
                        @if (!empty($minYear))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Year From: {{ $minYear }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('minYear')">&times;</span></span>
                        @endif
                        @if (!empty($maxYear))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Year To: {{ $maxYear }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('maxYear')">&times;</span></span>
                        @endif
                        @if (!empty($fType))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Fuel Type: {{ $fType }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('fType')">&times;</span></span>
                        @endif
                        @if (!empty($transmission))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Transmission: {{ $transmission }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('transmission')">&times;</span></span>
                        @endif
                        @if (!empty($owner))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Owners: {{ $owner }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('owner')">&times;</span></span>
                        @endif
                        @if (!empty($hp))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">HP Power: {{ $hp }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('hp')">&times;</span></span>
                        @endif
                        @if (!empty($bType))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Body Type: {{ $bType }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('bType')">&times;</span></span>
                        @endif
                        @if (!empty($bedroom))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Bedroom: {{ $bedroom }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('bedroom')">&times;</span></span>
                        @endif
                        @if (!empty($bathroom))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Bathroom: {{ $bathroom }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('bathroom')">&times;</span></span>
                        @endif
                        @if (!empty($furnishing))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Furnishing: {{ $furnishing }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('furnishing')">&times;</span></span>
                        @endif
                        @if (!empty($listedBy))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Listed By: {{ $listedBy }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('listedBy')">&times;</span></span>
                        @endif
                        @if (!empty($constructionStatus))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Construction Status: {{ $constructionStatus }}<span
                                    class="close-tag-btn"
                                    wire:click="removeFilterByField('constructionStatus')">&times;</span></span>
                        @endif
                        @if (!empty($superBuiltupArea))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Super Builtup Area: {{ $superBuiltupArea }}<span
                                    class="close-tag-btn"
                                    wire:click="removeFilterByField('superBuiltupArea')">&times;</span></span>
                        @endif
                        @if (!empty($plotArea))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Plot Area: {{ $plotArea }}<span class="close-tag-btn"
                                    wire:click="removeFilterByField('plotArea')">&times;</span></span>
                        @endif
                        @if (!empty($bachelorsAllowed))
                            @php $filterCount++; @endphp
                            <span class="tags-btn-filter">Bachelors Allowed: {{ $bachelorsAllowed }}<span
                                    class="close-tag-btn"
                                    wire:click="removeFilterByField('bachelorsAllowed')">&times;</span></span>
                        @endif
                        @if ($filterCount >= 2)
                            <span class="tags-btn-filter">Remove All<span class="close-tag-btn"
                                    wire:click="removeAllFilterFied()">&times;</span></span>
                        @endif
                    </div>
                    @endif
                    <div class="property-links">
                        <div wire:loading>
                            Loading...
                        </div>
                        <livewire:posts.list.post-list key="post-list-{{ now()->timestamp }}" :posts="$posts->items()"
                            :catRow="$catRow" :catNav="$catNav" />
                        @if (count($posts) > 0)
                            @if ($posts->hasPages())
                                {{ $posts->links() }}
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="list-products profile-page">
    <div class="wrapper">
        <div class="list-container">
            <div class="list-box mt-3">
                <div class="products-details">
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
                    <button class="d-flex justify-content-between fillterBtn">Filter Results
                                <span class="filter-result-quantity2"><span class="filter-result-quantity">{{ number_format($posts->total()) }}</span>
                                    <img class="ml-2 filter-result-quantity-img" src="http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png">
                                </span>
                            </button>
                    <!-- <button class="fillterBtn">Filter Results <span> {{ number_format($posts->total()) }}
                            Results</span></button> -->
                    <div class="clr"></div>
                    <livewire:profile.profile-left-filter key="profile-left-filter-{{ now()->timestamp }}"
                        :user="$user" :category="$category" :catRow="$catRow" :catNav="$catNav" />
                </div>
                <div class="products-links mt-0">
                    <div class="show-results" style="padding:15px 0 15px">
                        <h1 hidden>House for Rent in Delhi </h1>
                        <div class="result-txt">{{ number_format($posts->total()) }} Results
                        </div>
                        <div class="select-box" style="margin-top:1px">
                            <select class="my_option" wire:model="orderBy">
                                <option value="new">Newest First</option>
                                <option class="m_option" value="old">Oldest First</option>
                                @if (in_array($parentNavCatId, [1, 2, 7]))
                                @else
                                    <option value="phigh">Price: Low to High</option>
                                    <option value="plow">Price: High to Low</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="property-links">
                        <div wire:loading>
                            Loading...
                        </div>
                        <div wire:loading.remove>
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
    </div>
</section>

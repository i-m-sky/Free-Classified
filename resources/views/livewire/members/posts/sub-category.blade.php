<div>
    @if (count($mainCategories) > 0)
        <div class="post-flex-box">
            <div class="post-select-box">
                <select wire:change="selectCategory($event.target.value)">
                    <option value="">Select Category</option>
                    @foreach ($mainCategories as $mainItem)
                        <option value="{{ $mainItem['id'] }}" {{ $selectedChildCatId == $mainItem['id'] ? 'selected' : '' }}>
                            {{ $mainItem['name'] }}</option>
                    @endforeach
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                </svg>
            </div>
            @if (isset($selectedChildCatId) && !empty($selectedChildCatId))
                <button class="chek-img">
                    <img src="{{ config('global_variables.asset_url') }}/img/tick.png" alt="check-mark" />
                </button>
            @endif
        </div>
    @endif
    @if (count($childCategories) > 0)
        @if (isset($selectedChildCatId) && !empty($selectedChildCatId))
            <livewire:members.posts.sub-category :selectedCatId="$selectedChildCatId" :catSlug2="$catSlug2" :catSlug3="$catSlug3"
                key="sub-category-{{ $selectedChildCatId }}-{{ now()->timestamp }}" />
        @endif
    @endif
    @if (count($childCategories) == 0 && isset($selectedChildCatId) && !empty($selectedChildCatId))
        <button class="next-step" type="button" wire:click="nextStep('{{ $selectedChildCatId }}')">Next step: Creat your
            ad</button>
    @endif

    <div wire:loading>
        Loading...
    </div>

</div>

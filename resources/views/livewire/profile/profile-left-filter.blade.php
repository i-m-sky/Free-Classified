<div class="car-details-bg-color">
    <livewire:profile.profile-event :user="$user" />
    <div class="box-1 categories-list mt-3">
        <div class="heading">Categories:</div>
        <ul>
            @if ($category == 'all')
                <li class="highlight highlight-l1-item" wire:click="$emit('changeCategory', 'all')">
                    <a>x</a>
                    All categories
                </li>
            @elseif(!empty($catRow) && count($catRow) > 0)
                <ul>
                    <li>
                        <a class="category-selected">
                            All categories
                            <span class="count">
                            </span>
                        </a>
                    </li>
                    @if (count($catNav) > 0)
                        @php
                            $lastCatNav = '';
                            $catId = '';
                        @endphp
                        @foreach (collect($catNav)->sortKeysDesc() as $navItem)
                            @if (!$loop->last)
                                @php
                                    $lastCatNav = $navItem['slug'];
                                @endphp
                                <li><a class="category-selected">
                                        {{ $navItem['name'] }}<span class="count">
                                        </span></a>
                                </li>
                            @else
                                @if (empty($lastCatNav))
                                    <li class="highlight highlight-l1-item">
                                        <a href="#" wire:click.prevent="$emit('changeCategory', 'all')">
                                            x</a>
                                        {{ $navItem['name'] }}
                                    </li>
                                @else
                                    <li class="highlight highlight-l1-item">
                                        <a href="#"
                                            wire:click.prevent="$emit('changeCategory', '{{ $catId }}')">
                                            x</a>
                                        {{ $navItem['name'] }}
                                    </li>
                                @endif
                            @endif
                            @php $catId =  $navItem['id'] ;   @endphp
                        @endforeach
                    @endif
            @endif
            @if (count($childCategories) > 0)
                @php
                    $i = 0;
                @endphp
                <ul>
                    @foreach ($childCategories as $index => $catItem)
                        @if ($catItem['total'] > 0)
                            @php
                                $i++;
                            @endphp
                            <li class="{{ $i > 5 ? 'cat-hide' : '' }}">
                                <a class="category-selected l2-item" href="#"
                                    wire:click.prevent="$emit('changeCategory', '{{ $catItem['id'] }}')">
                                    {{ $catItem['name'] }}
                                    <span class="count">
                                        ({{ number_format($catItem['total']) }})
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                    @if ($i > 5)
                        <li class="view-more collapsing-filter jsonly view-more-cat"><a href="javascript:void(0)">View
                                More Options... <i class="fa-solid fa-arrow-down"></i></a></li>
                        <li class="view-more collapsing-filter jsonly view-few-cat"><a href="javascript:void(0)">Fewer
                                Options <i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                    @endif
                </ul>
            @endif
            @if (!empty($catRow) && count($catRow) > 0)
        </ul>
        @endif
        </ul>
    </div>
</div>

<section class="browse">
    <div class="wrapper">
        @if (count($states) > 0 || count($cities) > 0)
            <div class="browse-container">
                <div class="location-heading"><span>Browse Adverts In</span> Poular Locations</div>
                <div class="acc">
                    @if (count($states) > 0)
                        <div class="acc__card">
                            <div class="acc__title">Top States</div>
                            <div class="acc__panel">
                                <ul class="slide">
                                    @foreach ($states as $item)
                                        <li><a
                                                href="{{ route('post-list', ['location' => $item['slug']]) }}">{{ $item['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if (count($cities) > 0)
                        <div class="acc__card">
                            <div class="acc__title">Top Cities</div>
                            <div class="acc__panel">
                                <ul class="slide">
                                    @foreach ($cities as $item)
                                        <li><a
                                                href="{{ route('post-list', ['location' => $item['slug']]) }}">{{ $item['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>

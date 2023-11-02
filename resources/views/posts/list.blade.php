@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
    <livewire:shared.search-post />
    <section class="bread-crums">
        <div class="wrapper">
            <div class="bread-crums-links">
                <ul>
                    <li class="home-arrow"><a href="{{ route('welcome') }}">Home <i class="fa fa-angle-right"
                                aria-hidden="true"></i></a>
                    </li>
                    @if ($catNavType == true)
                        @if (count($catNav) > 0)
                            @foreach (collect($catNav)->sortKeysDesc() as $navItem)
                                @if (!$loop->last)
                                    <li><a
                                            href="{{ route('post-list', ['location' => $location, 'category' => $navItem['slug']]) }}">
                                            {{ $navItem['name'] }} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                @else
                                    <li> {{ $navItem['name'] }}</li>
                                @endif
                            @endforeach
                        @else
                            <li>All categories</li>
                        @endif
                    @else
                        <li>All categories</li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
    <!-- -------NEW SECTION--------- -->
    <livewire:posts.list.post-component key="post-component-{{ now()->timestamp }}" :locationType="$locationType" :location="$location"
        :locRow="collect($locRow)->toArray()" :stateRow="$stateRow" :cityRow="$cityRow" :category="$category" :catRow="collect($catRow)->toArray()" :catNav="$catNav"
        :search="$search" />
    <section class="section-more">
        <div class="wrapper">
            <div class="more-option">
                <livewire:shared.find-out-more key="find-out-more -{{ now()->timestamp }}" :page="$page"
                    :location="$location" :catRow="collect($catRow)->toArray()" />
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
@endsection

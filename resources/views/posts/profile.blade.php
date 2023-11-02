@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
    <livewire:shared.search-post />
    <section class="bread-crums mb-25">
        <div class="wrapper">
            <div class="bread-crums-links">
                <ul>
                    <li class="home-arrow"><a href="{{ route('welcome') }}">Home <i class="fa fa-angle-right"
                                aria-hidden="true"></i></a>
                    </li>
                    <li class="searc-arrow "><a href="{{ route('welcome') }}">Profile <i class="fa fa-angle-right"
                                aria-hidden="true"></i></a>
                    </li>
                    <li><a href="{{ route('user-profile', ['userId' => $user->id]) }}">{{ $user->id }}</a></li>
                </ul>
            </div>
        </div>
    </section>
    <livewire:profile.profile-component key="profile-component-{{ now()->timestamp }}" :user="$user->toArray()" />
@endsection
@section('bodyend')
@endsection

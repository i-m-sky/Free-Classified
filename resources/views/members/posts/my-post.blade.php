@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
    <section class="list-products" style="margin-top: 149px;">
        <div class="wrapper">
            <div class="list-container">
                <div class="list-box">
                    <livewire:members.shared.left-nav key="left-nav-{{ now()->timestamp }}" :row="collect($row)->toArray()" />
                    <livewire:members.posts.my-post key="my-post-{{ now()->timestamp }}" />
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
@endsection

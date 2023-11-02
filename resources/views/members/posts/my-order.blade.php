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
                    <div class="products-links">
                        <livewire:members.posts.my-order key="my-order-{{ now()->timestamp }}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
@endsection
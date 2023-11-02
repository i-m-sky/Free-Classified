@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
<section class="section-post-ad">
    <section class="section-banner post-padding-tp">
        <div class="wrapper">
            <div class="post-ad-bx">
                <div class="border-container">
                <p class="proAdDesc">Your Order (3 items)</p>
                    <livewire:members.posts.cart-page key="cart-page-{{ now()->timestamp }}" />
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
@section('bodyend')
@endsection
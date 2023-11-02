@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
<section class="section-post-ad">
    <section class="section-banner post-padding-tp">
        <div class="wrapper">
            <div class="post-ad-bx">
                <div class="post-title">
                    <h1 class="text-center mb-4">Promote Your Ad</h1>
                    <p class="proAdDesc">Enhance your ad's visibility by choosing one of the options below to stand out
                        from the crowd</p>
                </div>
                <div class="border-container">
                    <!-- <form action="{{ route('cart-page') }}" method="POST">
                        @crsf -->
                        <livewire:members.posts.promote-ad key="promote-ad-{{ now()->timestamp }}" />
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
@section('bodyend')
@endsection
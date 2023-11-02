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
                        <h1>Post Your Ad</h1>
                    </div>
                    <div class="border-container">
                        <h5>Choose a Category</h5>
                        <livewire:members.posts.main-category key="main-category-{{ now()->timestamp }}" 
                           :catSlug="$catSlug"
                           :catSlug2="$catSlug2"
                           :catSlug3="$catSlug3"
                        />
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
@section('bodyend')
@endsection

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
                        <div class="bg-color-form">
                            <!-- <div class="digital-plannner">
                                                        Dashboard
                                                    </div> -->
                            <div class="form-main-container pt-0">
                                <!-- ---------- -->
                                <div class="row dash-card-bg g-6 mb-6">
                                    <div class="col-xl-3 col-sm-6 col-12 mb-3 ">
                                        <div class="card shadow border-0">
                                            <div class="card-body dash-card-blue">
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="h6 font-semibold text-sm d-block text-white mb-2">All
                                                            Ads </span>
                                                        <span
                                                            class="h5 font-bold mb-0 text-white">{{ isset($post) && count($post) > 0 ? number_format($post[0]->total) : 0 }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="card-icon-circle">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25px"
                                                                height="25px" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-3">
                                        <div class="card shadow border-0">
                                            <div class="card-body dash-card-green">
                                                <div class="row">
                                                    <div class="col">
                                                        <span
                                                            class="h6 font-semibold text-sm d-block text-white mb-2">Active
                                                            Ads </span>
                                                        <span
                                                            class="h5 font-bold mb-0 text-white">{{ isset($post) && count($post) > 0 ? number_format($post[0]->activePost) : 0 }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="card-icon-circle">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25px"
                                                                height="25px" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-3">
                                        <div class="card shadow border-0">
                                            <div class="card-body dash-card-purple">
                                                <div class="row">
                                                    <div class="col">
                                                        <span
                                                            class="h6 font-semibold text-sm d-block text-white mb-2">Pending
                                                            Ads </span>
                                                        <span
                                                            class="h5 font-bold mb-0 text-white">{{ isset($post) && count($post) > 0 ? number_format($post[0]->pendingPost) : 0 }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="card-icon-circle">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25px"
                                                                height="25px" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-3">
                                        <div class="card shadow border-0">
                                            <div class="card-body dash-card-mahron">
                                                <div class="row">
                                                    <div class="col">
                                                        <span
                                                            class="h6 font-semibold text-sm d-block text-white mb-2">Expire
                                                            Ads </span>
                                                        <span
                                                            class="h5 font-bold mb-0 text-white">{{ isset($post) && count($post) > 0 ? number_format($post[0]->expiredPost) : 0 }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="card-icon-circle">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25px"
                                                                height="25px" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <livewire:members.dashboard.analytics key="analytics-{{ now()->timestamp }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
@endsection

@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img')
@section('content')
    <livewire:shared.search-post key="search-post-{{ now()->timestamp }}" />
    <?php $images = glob(public_path('/img/Categories/*.jpeg')); ?>
    <section class="container my-5">S
        <div id="carousel-section" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($images as $index => $image)
                    <li data-target="#carousel-section" data-slide-to="{{ $index }}"
                        class="{{ $loop->first ? 'active' : '' }}">
                    </li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($images as $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('/img/Categories/' . basename($image)) }}" class="d-block w-100"
                            alt="Home Slider Images">
                        <div class="carousel-caption d-md-block">
                            <div class="content-box w-100">
                                <h1 class="sec-1-text">
                                    <span>Discover The</span><br />
                                    <span class="break-text">World </span><br />
                                    <span class="break-text">Around You</span>
                                </h1>
                                <p class="sec-1-para">Buy.&nbsp;Sell.&nbsp;Rent</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carousel-section" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-section" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!-- <section class="sec-1 bg-olor">
                        <div class="wrapper">
                            <div class="main-container">
                                <div class="content-box">
                                    <h1 class="sec-1-text">
                                        <span>Discover The</span><br />
                                        <span class="break-text">World </span><br />
                                        <span class="break-text">Around You</span>
                                    </h1>
                                </div>
                                <div class="img-box">
                                    <img src="{{ config('global_variables.asset_url') }}/img/banner-img.webp" alt="" />
                                </div>
                            </div>
                        </div>
                    </section> -->
    <section class="section-banner padding-tp">
        <div class="wrapper">
            <div class="banner-container">
                <livewire:home.category-list key="find-out-more -{{ now()->timestamp }}" />
                <div class="banner-ads">
                    <div class="ads-links">
                        <img class='d-none' src="{{ config('global_variables.asset_url') }}/img/adds-new.jpg"
                            alt="computer" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <livewire:home.location-list key="location-list-{{ now()->timestamp }}" />
    <section class="section-more">
        <div class="wrapper">
            <div class="more-option">
                {{-- <div class="location-heading"><span>Find out</span> More</div>
            <div class="engine">
                <h2 class="more-title">Engines</h2>
                <h4>Used cars - Used motorcycles - Used electric cars - Used hybrid cars - Used diesel cars - Ford -
                    Mercedes - Opel - Alfa Romeo - Jeep - Hyundai - Toyota - Ducati - Harley Davidson - Honda -
                    Kawasaki - KTM - Piaggio - Suzuki - Aprilia</h4>
            </div>
            <div class="car-modals">
                <h2 class="sm-title">Fiat</h2>
                <h4>Fiat 500 - Fiat Panda - Fiat Doblo - Fiat Punto - Fiat 600 - Fiat Tipo - Fiat 500l - Fiat Panda
                    4x4 - Fiat Scudo - Fiat Ducato</h4>
                <h2 class="sm-title">Renault</h2>
                <h4>Renault Captur - Renault Clio - Renault Kadjar - Renault Trafic - Renault Twingo - Renault
                    Kangoo - Renault Scenic - Renault 4 - Renault Megane - Renault Zoe</h4>
                <h2 class="sm-title">Peogeot</h2>
                <h4>Peugeot 3008 - Peugeot 208 - Peugeot 2008 - Peugeot 308 - Peugeot 5008 - Peugeot 107 - Peugeot
                    Rifter - Peugeot Partner - Peugeot 207 - Peugeot Traveler</h4>
                <h2 class="sm-title">BMW</h2>
                <h4>Bmw x1 - Bmw 1 series - Bmw x3 - Bmw Motorrad - Bmw x4 - Bmw z4 - Bmw x2 - Bmw 3 series - Bmw x5
                </h4>
                <h2 class="sm-title">Volkswagen</h2>
                <h4>Volkswagen Polo - Volkswagen Tiguan - Volkswagen Up - Volkswagen Golf - Volkswagen California -
                    Volkswagen T roc - Volkswagen Transporter - Volkswagen T cross - Volkswagen Caddy - Volkswagen
                    Passat</h4>
                <h2 class="sm-title">Audi</h2>
                <h4 class="audi-para">Audi A1 - Audi A3 - Audi Q3 - Audi TT - Audi Q5 - Audi A4 - Audi Q2 - Audi A5
                    - Audi A6 - Audi Q3 Sportback</h4>
            </div> --}}
                <livewire:shared.find-out-more />
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
@endsection

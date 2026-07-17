@extends('layouts.app')

@section('content')

<div class="container">

    <!-- =========================
         HERO SECTION
    ========================== -->

    <section class="hero">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <span class="badge badge-light px-3 py-2 mb-3">
                    💊 Nepal's Trusted Online Pharmacy
                </span>

                <h1>
                    Your Health,
                    <br>
                    Delivered Faster.
                </h1>

                <p>
                    Order genuine medicines from trusted pharmacies and get
                    them delivered safely to your doorstep.
                </p>

                <form action="{{ route('medicine.search') }}" method="GET">

                    <div class="search-box">

                        <div class="input-group">

                            <input
                                type="text"
                                class="form-control"
                                name="keyword"
                                placeholder="Search medicines...">

                            <div class="input-group-append">

                                <button class="btn btn-main">

                                    <i class="fa fa-search"></i>

                                    Search

                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <div class="col-lg-6 text-center hero-image">

                <img
                    src="{{ asset('images/hero/pharmacy.png') }}"
                    class="img-fluid"
                    alt="Online Pharmacy">

            </div>

        </div>

    </section>

    <!-- =========================
         FEATURES
    ========================== -->

    <div class="row mb-5">

        <div class="col-md-4">

            <div class="feature-card">

                <i class="fas fa-shipping-fast text-success"></i>

                <h5>Fast Delivery</h5>

                <p>
                    Get medicines delivered quickly and safely.
                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="feature-card">

                <i class="fas fa-clinic-medical text-primary"></i>

                <h5>Verified Pharmacies</h5>

                <p>
                    We partner only with licensed pharmacies.
                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="feature-card">

                <i class="fas fa-headset text-warning"></i>

                <h5>24/7 Support</h5>

                <p>
                    Our team is here whenever you need help.
                </p>

            </div>

        </div>

    </div>

    <!-- =========================
         CATEGORIES
    ========================== -->

    <h2 class="section-title">

        Browse Categories

    </h2>

    <div class="row">

        @php

            $icons = [

                'fas fa-capsules',
                'fas fa-heartbeat',
                'fas fa-syringe',
                'fas fa-baby',
                'fas fa-leaf',
                'fas fa-pills',
                'fas fa-stethoscope',
                'fas fa-prescription-bottle'

            ];

            $colors = [
                'bg1',
                'bg2',
                'bg3',
                'bg4',
                'bg5',
                'bg6'
            ];

        @endphp

        @foreach(App\Category::where('name','!=','Any')->get() as $index => $category)

            <div class="col-lg-2 col-md-3 col-6">

                <div class="category-card">

                    <div class="category-icon {{ $colors[$index % count($colors)] }}">

                        <i class="{{ $icons[$index % count($icons)] }}"></i>

                    </div>

                    <h6>

                        {{ $category->name }}

                    </h6>

                </div>

            </div>

        @endforeach

    </div>

    <!-- =========================
         MEDICINES
    ========================== -->

    <h2 class="section-title mt-5">

        Featured Medicines

    </h2>

    <div class="row">

        @forelse($medicines as $medicine)

            <div class="col-lg-4 col-md-6">

                <div class="medicine-card">

                    <span class="badge-new">

                        New

                    </span>

                    <div class="wishlist">

                        <i class="far fa-heart"></i>

                    </div>

                    <div class="medicine-image">

                        @if($medicine->image)

                            <img
                                src="{{ asset('storage/'.$medicine->image) }}"
                                class="img-fluid">

                        @else

                            <i class="fas fa-capsules"></i>

                        @endif

                    </div>

                    <div class="card-body">

                        <small>

                            {{ optional($medicine->category)->name }}

                        </small>

                        <h4>

                            {{ $medicine->name }}

                        </h4>

                        <p>

                            {{ $medicine->company }}

                        </p>

                        <div class="rating">

                            ★★★★★

                            <span>

                                (4.8)

                            </span>

                        </div>

                        <div class="price mt-2">

                            Rs. {{ number_format($medicine->price,2) }}

                        </div>

                        <div class="stock {{ $medicine->quantity < 20 ? 'low' : '' }}">

                            {{ $medicine->quantity }} in stock

                        </div>

                        <div class="pharmacy-name">

                            <i class="fas fa-store"></i>

                            {{ optional($medicine->pharmacy)->name }}

                        </div>

                        <div class="mt-4">

                            <a
                                href="{{ route('orders.create.medicine',$medicine->id) }}"
                                class="btn btn-cart">

                                <i class="fas fa-shopping-cart"></i>

                                Add to Cart

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    No medicines available.

                </div>

            </div>

        @endforelse

    </div>

        <!-- =========================
         STATISTICS
    ========================== -->

    <section class="stats">

        <div class="row">

            <div class="col-md-3">

                <div class="stat-box">

                    <h2>31+</h2>

                    <p>Medicines</p>

                </div>

            </div>

            <div class="col-md-3">

                <div class="stat-box">

                    <h2>5+</h2>

                    <p>Pharmacies</p>

                </div>

            </div>

            <div class="col-md-3">

                <div class="stat-box">

                    <h2>500+</h2>

                    <p>Happy Customers</p>

                </div>

            </div>

            <div class="col-md-3">

                <div class="stat-box">

                    <h2>24/7</h2>

                    <p>Customer Support</p>

                </div>

            </div>

        </div>

    </section>

    <!-- =========================
         WHY CHOOSE US
    ========================== -->

    <section class="why-section">

        <h2 class="section-title text-center mb-5">

            Why Choose MedInventory?

        </h2>

        <div class="row">

            <div class="col-lg-4 mb-4">

                <div class="why-card">

                    <i class="fas fa-shield-alt"></i>

                    <h4>100% Genuine Medicines</h4>

                    <p>

                        All medicines are supplied by verified and licensed
                        pharmacies.

                    </p>

                </div>

            </div>

            <div class="col-lg-4 mb-4">

                <div class="why-card">

                    <i class="fas fa-truck"></i>

                    <h4>Fast Delivery</h4>

                    <p>

                        Receive your medicines safely and quickly at your
                        doorstep.

                    </p>

                </div>

            </div>

            <div class="col-lg-4 mb-4">

                <div class="why-card">

                    <i class="fas fa-user-md"></i>

                    <h4>Trusted Healthcare</h4>

                    <p>

                        Connecting patients with trusted pharmacies across
                        Nepal.

                    </p>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection
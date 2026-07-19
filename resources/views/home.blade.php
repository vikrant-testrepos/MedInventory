@extends('layouts.app')

@section('content')

@if(session('success'))

<div class="container mt-3">

    <div class="alert alert-success alert-dismissible fade show">

        <strong>

            <i class="fas fa-check-circle mr-1"></i>

            {{ session('success') }}

        </strong>

        <button
            type="button"
            class="close"
            data-dismiss="alert">

            <span>&times;</span>

        </button>

    </div>

</div>

@endif

<div class="container">

    <!-- =======================================
            HERO SECTION
    ======================================== -->

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

                    Order genuine medicines from verified pharmacies across Nepal and receive them safely at your doorstep.

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

                                    <i class="fas fa-search"></i>

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

        <!-- =======================================
            FEATURES
    ======================================== -->

    <section class="mt-5">

        <div class="row">

            <div class="col-md-4 mb-4">

                <div class="feature-card text-center">

                    <i class="fas fa-shipping-fast fa-3x text-success mb-3"></i>

                    <h5>Fast Delivery</h5>

                    <p>

                        Get medicines delivered safely and quickly right to your doorstep.

                    </p>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="feature-card text-center">

                    <i class="fas fa-clinic-medical fa-3x text-primary mb-3"></i>

                    <h5>Verified Pharmacies</h5>

                    <p>

                        Buy medicines only from licensed and verified pharmacies.

                    </p>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="feature-card text-center">

                    <i class="fas fa-headset fa-3x text-warning mb-3"></i>

                    <h5>24/7 Support</h5>

                    <p>

                        Our support team is always available to help you.

                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- =======================================
            CATEGORIES
    ======================================== -->

    <section class="mt-5">

        <h2 class="section-title">

            Browse Categories

        </h2>

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

        <div class="row">

            @foreach(App\Category::where('name','!=','Any')->get() as $index => $category)

                <div class="col-lg-2 col-md-3 col-6 mb-4">

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

    </section>

    <!-- =======================================
            FEATURED MEDICINES
    ======================================= -->

    <section class="mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="section-title mb-0">

                Featured Medicines

            </h2>

            <a href="#" class="btn btn-outline-success">

                View All

            </a>

        </div>

        <div class="row">

            @forelse($medicines as $medicine)

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="medicine-card shadow-sm">

                        {{-- New Badge --}}

                        <span class="badge-new">

                            New

                        </span>

                        {{-- Wishlist --}}

                        <div class="wishlist">

                            <i class="far fa-heart"></i>

                        </div>

                        {{-- Medicine Image --}}

                        <div class="medicine-image">

                            @if($medicine->image)

                                <img
                                    src="{{ asset('storage/'.$medicine->image) }}"
                                    class="img-fluid"
                                    alt="{{ $medicine->name }}">

                            @else

                                <i class="fas fa-capsules fa-5x text-success"></i>

                            @endif

                        </div>

                        <div class="card-body">

                            {{-- Category --}}

                            <small class="text-success font-weight-bold">

                                {{ optional($medicine->category)->name }}

                            </small>

                            {{-- Medicine Name --}}

                            <h4 class="mt-2">

                                {{ $medicine->name }}

                            </h4>

                            {{-- Company --}}

                            <p class="text-muted mb-2">

                                {{ $medicine->company }}

                            </p>

                            {{-- Rating --}}

                            <div class="rating mb-2">

                                ⭐⭐⭐⭐⭐

                                <span class="text-muted">

                                    (4.8)

                                </span>

                            </div>

                            {{-- Price --}}

                            <div class="price mb-2">

                                <span class="text-muted">

                                    Starting From

                                </span>

                                <br>

                                <strong class="text-success h5">

                                    Rs.
                                    {{ number_format($medicine->price,2) }}

                                </strong>

                            </div>

                            {{-- Stock --}}

                            <div class="stock mb-2">

                                @if($medicine->quantity > 0)

                                    <span class="badge badge-success">

                                        <i class="fas fa-check-circle"></i>

                                        {{ $medicine->quantity }} Available

                                    </span>

                                @else

                                    <span class="badge badge-danger">

                                        Out of Stock

                                    </span>

                                @endif

                            </div>

                            {{-- Pharmacy --}}

                            <div class="pharmacy-name">

                                <i class="fas fa-store text-success"></i>

                                <strong>

                                    {{ optional($medicine->pharmacy)->name }}

                                </strong>

                            </div>

                            <hr>

                            {{-- Buttons --}}

                            <div class="medicine-actions">

                                <a
                                    href="{{ route('patient.medicine.show',$medicine->id) }}"
                                        class="btn btn-outline-primary btn-block">

                                        <i class="fas fa-eye"></i>

                                        View Details

                                </a>

                                <form
                                    action="{{ route('cart.store') }}"
                                    method="POST">

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="medicine_id"
                                        value="{{ $medicine->id }}">

                                    <button
                                        class="btn btn-success btn-block">

                                        <i class="fas fa-shopping-cart"></i>

                                        Add to Cart

                                    </button>

                                </form>

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

    </section>

    <!-- =======================================
            STATISTICS
    ======================================= -->

    <section class="stats mt-5">

        <div class="row">

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="stat-box">

                    <i class="fas fa-capsules fa-2x text-success mb-3"></i>

                    <h2>

                        {{ App\Medicine::count() }}+

                    </h2>

                    <p>

                        Medicines

                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="stat-box">

                    <i class="fas fa-clinic-medical fa-2x text-primary mb-3"></i>

                    <h2>

                        {{ App\Pharmacy::count() }}+

                    </h2>

                    <p>

                        Verified Pharmacies

                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="stat-box">

                    <i class="fas fa-users fa-2x text-warning mb-3"></i>

                    <h2>

                        {{ App\User::where('role','patient')->count() }}+

                    </h2>

                    <p>

                        Happy Patients

                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="stat-box">

                    <i class="fas fa-headset fa-2x text-danger mb-3"></i>

                    <h2>

                        24/7

                    </h2>

                    <p>

                        Customer Support

                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- =======================================
        WHY CHOOSE US
======================================= -->

<section class="why-section mt-5 mb-5">

    <h2 class="section-title text-center">

        Why Choose MedInventory?

    </h2>

    <div class="row mt-5">

        <div class="col-lg-4 mb-4">

            <div class="why-card h-100">

                <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>

                <h4>

                    Genuine Medicines

                </h4>

                <p>

                    Every medicine available on MedInventory comes from licensed pharmacies approved by our administration.

                </p>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="why-card h-100">

                <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>

                <h4>

                    Nearby Pharmacies

                </h4>

                <p>

                    Find medicines available in pharmacies closest to your current location.

                </p>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="why-card h-100">

                <i class="fas fa-route fa-3x text-warning mb-3"></i>

                <h4>

                    Navigation Support

                </h4>

                <p>

                    Open an interactive map and navigate directly to your selected pharmacy.

                </p>

            </div>

        </div>

    </div>

</section>

</div>

@endsection
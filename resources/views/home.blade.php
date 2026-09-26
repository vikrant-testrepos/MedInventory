@extends('layouts.app')

@section('content')

<!-- ========================= HERO ========================= -->

<div class="container mt-5">

    <section class="hero">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <span class="badge badge-light hero-badge">

                    <i class="fas fa-shield-alt mr-2"></i>

                    Trusted Medicine Delivery

                </span>

                <h1>

                    Find Medicines

                    <br>

                    From Nearby

                    <span class="text-warning">

                        Pharmacies

                    </span>

                </h1>

                <p>

                    Search thousands of medicines available in nearby pharmacies,
                    compare prices and order instantly from trusted medical stores.

                </p>

                <form
                    action="{{ route('medicine.search') }}"
                    method="GET"
                    class="search-box">

                    <div class="input-group">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Search medicine...">

                        <div class="input-group-append">

                            <button
                                class="btn btn-main"
                                type="submit">

                                <i class="fas fa-search mr-2"></i>

                                Search

                            </button>

                        </div>

                    </div>

                </form>

                <div class="hero-features">

                    <div>

                        <i class="fas fa-check-circle"></i>

                        Genuine Medicines

                    </div>

                    <div>

                        <i class="fas fa-map-marker-alt"></i>

                        Nearby Pharmacies

                    </div>

                    <div>

                        <i class="fas fa-truck"></i>

                        Fast Delivery

                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="hero-image text-center">

                    <img src="{{ asset('images/hero/pharmacy.png') }}"
                        class="img-fluid"
                        alt="Medicine">

                </div>

            </div>

        </div>

    </section>

</div>

<!-- ========================= CATEGORIES ========================= -->

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="section-title">

            Shop by Category

        </h2>

    </div>

    <div class="row">

        @foreach($categories as $category)

            <div class="col-lg-2 col-md-4 col-6 mb-4">

                <div class="category-card">

                    <div class="category-icon bg{{ ($loop->iteration % 6) ?: 6 }}">

                        <i class="fas fa-capsules"></i>

                    </div>

                    <h6>

                        {{ $category->name }}

                    </h6>

                </div>

            </div>

        @endforeach

    </div>

</div>

<!-- ========================= FEATURED MEDICINES ========================= -->

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="section-title">

            Featured Medicines

        </h2>

        <a href="{{ route('medicine.search') }}"
           class="btn btn-outline-success">

            View All

        </a>

    </div>

    <div class="row">

    @foreach($medicines as $medicine)

        <div class="col-lg-4 col-md-6 mb-4">

            <div class="medicine-card">

                     <a href="{{ route('patient.medicine.show',$medicine->id) }}"
                         class="medicine-card-link"
                         aria-label="View {{ $medicine->name }} details">

                     <div class="medicine-image">

                    @if($medicine->image)

                        <img src="{{ $medicine->image_url }}"
                            alt="{{ $medicine->name }}">

                    @else

                        <i class="fas fa-prescription-bottle-alt"></i>

                    @endif

                    <span class="badge-new">NEW</span>

                    <div class="wishlist">
                        <i class="far fa-heart"></i>
                    </div>

                </div>

                </a>

                <div class="card-body">

                    <span class="category-pill">
                        {{ optional($medicine->category)->name ?? 'Medicine' }}
                    </span>

                    <h4 class="medicine-title">
                        <a href="{{ route('patient.medicine.show',$medicine->id) }}">
                            {{ $medicine->name }}
                        </a>
                    </h4>

                    <div class="company">
                        {{ $medicine->manufacturer ?? 'Unknown Manufacturer' }}
                    </div>

                    <div class="rating">
                        ★★★★★
                        <span>4.8</span>
                    </div>

                    <div class="price">
                        रु. {{ number_format($medicine->price,2) }}
                    </div>

                    @if($medicine->quantity>10)

                        <span class="stock-green">
                            In Stock
                        </span>

                    @elseif($medicine->quantity>0)

                        <span class="stock-orange">
                            Few Left
                        </span>

                    @else

                        <span class="stock-red">
                            Out of Stock
                        </span>

                    @endif

                    <div class="pharmacy mt-3">
                        <i class="fas fa-store"></i>

                        {{ optional($medicine->pharmacy)->name ?? 'MedInventory Pharmacy' }}
                    </div>

                    <div class="buttons mt-4">

                        <a href="{{ route('patient.medicine.show',$medicine->id) }}"
                        class="btn btn-view">

                            <i class="fas fa-eye"></i>

                            View Details

                        </a>

                        <form action="{{ route('cart.store') }}" method="POST">

                            @csrf

                            <input type="hidden"
                                name="medicine_id"
                                value="{{ $medicine->id }}">

                            <button class="btn btn-cart">

                                <i class="fas fa-shopping-cart"></i>

                                Add To Cart

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    @endforeach

    </div>

</div>

<!-- ========================= WHY CHOOSE US ========================= -->

<div class="container why-section">

    <h2 class="section-title text-center mb-5">

        Why Choose MedInventory?

    </h2>

    <div class="row">

        <div class="col-lg-4 mb-4">

            <div class="why-card">

                <i class="fas fa-clinic-medical"></i>

                <h4>

                    Trusted Pharmacies

                </h4>

                <p>

                    Buy medicines only from verified and registered pharmacies.

                </p>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="why-card">

                <i class="fas fa-shipping-fast"></i>

                <h4>

                    Fast Delivery

                </h4>

                <p>

                    Find nearby pharmacies and receive medicines quickly.

                </p>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="why-card">

                <i class="fas fa-user-shield"></i>

                <h4>

                    Secure Ordering

                </h4>

                <p>

                    Safe ordering process with reliable pharmacies.

                </p>

            </div>

        </div>

    </div>

</div>

<!-- ========================= STATS ========================= -->

<div class="container">

    <section class="stats">

        <div class="row">

            <div class="col-md-3">

                <div class="stat-box">

                    <h2>

                        {{ $medicines->count() }}

                    </h2>

                    <p>

                        Medicines

                    </p>

                </div>

            </div>

            <div class="col-md-3">

                <div class="stat-box">

                    <h2>

                        {{ $categories->count() }}

                    </h2>

                    <p>

                        Categories

                    </p>

                </div>

            </div>

            <div class="col-md-3">

                <div class="stat-box">

                    <h2>

                        {{ $pharmacies->count() }}

                    </h2>

                    <p>

                        Pharmacies

                    </p>

                </div>

            </div>

            <div class="col-md-3">

                <div class="stat-box">

                    <h2>

                        24/7

                    </h2>

                    <p>

                        Support

                    </p>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection
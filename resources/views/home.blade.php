@extends('layouts.app')

@section('content')

<style>
    .hero {
        background: linear-gradient(135deg, #1abc9c, #16a085);
        color: white;
        border-radius: 25px;
        padding: 70px 50px;
        margin: 35px 0;
        overflow: hidden;
    }

    .hero h1 {
        font-size: 48px;
        font-weight: 700;
    }

    .hero p {
        font-size: 18px;
        opacity: .95;
    }

    .search-box {
        background: white;
        padding: 10px;
        border-radius: 50px;
        margin-top: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,.15);
    }

    .search-box input {
        border: none;
        box-shadow: none;
        font-size: 17px;
    }

    .search-box input:focus {
        box-shadow: none;
    }

    .hero-image img {
        max-height: 380px;
    }

    .section-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .category-card {
        background: white;
        border-radius: 18px;
        padding: 25px;
        text-align: center;
        transition: .3s;
        cursor: pointer;
        box-shadow: 0 5px 20px rgba(0,0,0,.08);
        margin-bottom: 25px;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,.15);
    }

    .category-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto auto 15px;
        font-size: 28px;
        color: white;
    }

    .bg1{background:#1abc9c;}
    .bg2{background:#3498db;}
    .bg3{background:#9b59b6;}
    .bg4{background:#e67e22;}
    .bg5{background:#e74c3c;}
    .bg6{background:#2ecc71;}

    .medicine-card{
        position:relative;
        background:#fff;
        border-radius:20px;
        overflow:hidden;
        transition:.35s;
        box-shadow:0 8px 25px rgba(0,0,0,.08);
        margin-bottom:30px;
    }

    .medicine-card:hover{
        transform:translateY(-10px);
        box-shadow:0 18px 40px rgba(0,0,0,.18);
    }

    .medicine-image{
        height:220px;
        background:linear-gradient(135deg,#e8f8f5,#d5f5e3);
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .medicine-image i{
        font-size:85px;
        color:#16a085;
    }

    .badge-discount{
        position:absolute;
        top:15px;
        left:15px;
        background:#ff4d4f;
        color:#fff;
        padding:6px 14px;
        border-radius:30px;
        font-size:12px;
        font-weight:600;
    }

    .favorite-btn{
        position:absolute;
        top:15px;
        right:15px;
        width:42px;
        height:42px;
        background:#fff;
        border-radius:50%;
        display:flex;
        justify-content:center;
        align-items:center;
        color:#ff4d4f;
        box-shadow:0 6px 15px rgba(0,0,0,.15);
        cursor:pointer;
    }

    .category-tag{
        display:inline-block;
        background:#eefaf7;
        color:#16a085;
        padding:6px 12px;
        border-radius:20px;
        font-size:12px;
        margin-bottom:10px;
    }

    .company{
        color:#888;
        font-size:14px;
    }

    .rating{
        color:#f39c12;
        margin-top:8px;
    }

    .price{
        color:#16a085;
        font-size:24px;
        font-weight:bold;
        margin-top:12px;
    }

    .old-price{
        color:#999;
        text-decoration:line-through;
        font-size:14px;
    }

    .stock{
        display:inline-block;
        background:#d4edda;
        color:#155724;
        padding:6px 14px;
        border-radius:30px;
        font-size:13px;
        margin-top:12px;
    }

    .delivery{
        color:#777;
        font-size:13px;
        margin-top:12px;
    }

    .btn-cart{
        background:#16a085;
        color:#fff;
        border-radius:30px;
        width:100%;
        padding:11px;
        transition:.3s;
    }

    .btn-cart:hover{
        background:#13856f;
        color:#fff;
    }
</style>

<div class="container">

    <!-- Hero -->

    <div class="hero">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <h1>Your Health, Delivered Faster.</h1>

                <p>
                    Order medicines from trusted pharmacies with fast delivery
                    right to your doorstep.
                </p>

                <form action="{{ route('medicine.search') }}" method="GET">

                    <div class="search-box">

                        <div class="input-group">

                            <input
                                type="text"
                                name="keyword"
                                class="form-control"
                                placeholder="Search medicines...">

                            <div class="input-group-append">

                                <button class="btn btn-success px-4">

                                    <i class="fa fa-search"></i>

                                    Search

                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <div class="col-lg-5 text-center hero-image">

                <img
                    src="{{ asset('images/hero/pharmacy.png') }}"
                    class="img-fluid"
                    alt="Online Pharmacy">

            </div>

        </div>

    </div>

    <!-- Features -->

    <div class="row text-center mb-5">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <i class="fas fa-shipping-fast fa-3x text-success mb-3"></i>

                    <h5>Fast Delivery</h5>

                    <p class="text-muted">
                        Medicines delivered quickly to your doorstep.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <i class="fas fa-clinic-medical fa-3x text-primary mb-3"></i>

                    <h5>Trusted Pharmacies</h5>

                    <p class="text-muted">
                        Verified pharmacies with genuine medicines.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <i class="fas fa-headset fa-3x text-warning mb-3"></i>

                    <h5>24/7 Support</h5>

                    <p class="text-muted">
                        We're always ready to help you.
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- Categories -->

    <h2 class="section-title">Browse Categories</h2>

    <div class="row">

        @foreach([
            ['capsules','Pain Relief','bg1'],
            ['heartbeat','Heart Care','bg2'],
            ['syringe','Diabetes','bg3'],
            ['baby','Baby Care','bg4'],
            ['leaf','Herbal','bg5'],
            ['pills','Vitamins','bg6']
        ] as $cat)

        <div class="col-md-2 col-6">

            <div class="category-card">

                <div class="category-icon {{ $cat[2] }}">

                    <i class="fas fa-{{ $cat[0] }}"></i>

                </div>

                <h6>{{ $cat[1] }}</h6>

            </div>

        </div>

        @endforeach

    </div>

    <!-- Medicines -->

    <h2 class="section-title mt-5">

        Featured Medicines

    </h2>

    <div class="row">

        @forelse($medicines as $medicine)

        <div class="col-lg-4 col-md-6">

            <div class="medicine-card">

                <div class="badge-discount">
                    10% OFF
                </div>

                <div class="favorite-btn">
                    <i class="far fa-heart"></i>
                </div>

                <div class="medicine-image">

                    <i class="fas fa-capsules"></i>

                </div>

                <div class="card-body">

                    <div class="category-tag">
                        {{ optional($medicine->category)->name }}
                    </div>

                    <h4>{{ $medicine->name }}</h4>

                    <div class="company">
                        {{ $medicine->company }}
                    </div>

                    <div class="rating">
                        ★★★★★
                        <span class="text-muted">(4.8)</span>
                    </div>

                    <div class="price">
                        Rs. {{ number_format($medicine->price,2) }}
                    </div>

                    <div class="old-price">
                        Rs. {{ number_format($medicine->price * 1.10,2) }}
                    </div>

                    <div class="stock">
                        {{ $medicine->quantity }} Available
                    </div>

                    <div class="delivery">
                        🚚 Free Delivery Today
                    </div>

                    <div class="mt-4">

                        <a href="{{ route('orders.create.medicine',$medicine->id) }}"
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

</div>

<!-- Popular Pharmacies -->

<h2 class="section-title mt-5">
    Popular Pharmacies
</h2>

<div class="row">

    @foreach($pharmacies as $pharmacy)

    <div class="col-lg-4 mb-4">

        <div class="card border-0 shadow-lg h-100">

            <div class="card-body text-center">

                <div class="mb-3">

                    <i class="fas fa-clinic-medical fa-4x text-success"></i>

                </div>

                <h4>{{ $pharmacy->name }}</h4>

                <p class="text-muted">

                    {{ $pharmacy->address }}

                </p>

                <div class="mb-2">

                    ⭐⭐⭐⭐⭐

                    <span class="text-muted">
                        (4.8)
                    </span>

                </div>

                <span class="badge badge-success p-2">

                    Free Delivery

                </span>

                <div class="mt-4">

                    <a href="#"
                       class="btn btn-success btn-block">

                        Visit Pharmacy

                    </a>

                </div>

            </div>

        </div>

    </div>

    @endforeach

</div>

@endsection
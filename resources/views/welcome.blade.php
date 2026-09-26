<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedInventory - Pharmacy Management System</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/entry.css') }}" rel="stylesheet">

    <style>

        body{
            background:#f8fafc;
            font-family:'DM Sans', sans-serif;
        }

        .navbar{
            box-shadow:0 2px 10px rgba(0,0,0,.08);
        }

        .hero{
            background:linear-gradient(135deg,#0d6efd,#20c997);
            color:white;
            padding:90px 0;
        }

        .hero h1{
            font-size:50px;
            font-weight:bold;
        }

        .hero p{
            font-size:20px;
            margin-top:20px;
        }

        .section-title{
            text-align:center;
            margin:60px 0 40px;
            font-weight:bold;
        }

        .medicine-card{
            transition:.3s;
            border:none;
            box-shadow:0 3px 12px rgba(0,0,0,.08);
        }

        .medicine-card:hover{
            transform:translateY(-6px);
        }

        .medicine-image{
            height:200px;
            object-fit:cover;
        }

        .feature-box{
            text-align:center;
            padding:30px;
        }

        .feature-icon{
            font-size:45px;
            margin-bottom:15px;
        }

        footer{
            background:#212529;
            color:white;
            padding:30px;
            margin-top:70px;
            text-align:center;
        }

    </style>

</head>

<body class="entry-page">

<nav class="navbar navbar-expand-lg navbar-light">

    <div class="container">

        <a class="navbar-brand" href="{{ route('welcome') }}">
            <i class="fa-solid fa-prescription-bottle-medical"></i>
            MedInventory
        </a>

        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#rootNavbar"
                aria-controls="rootNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="rootNavbar">

            <ul class="navbar-nav ml-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('medicine.search') }}">Medicines</a>
                </li>

                @auth

                    @if(Auth::user()->role == 'patient')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fa-solid fa-cart-shopping"></i> Cart
                                @if($cartCount > 0)
                                    <span class="cart-count" aria-label="{{ $cartCount }} items in cart">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('patient.orders.index') }}">Orders</a>
                        </li>
                    @endif

                    <li class="nav-item ml-2">
                        <a class="btn btn-main" href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : (Auth::user()->role == 'pharmacy' ? route('pharmacy.dashboard') : route('patient.dashboard')) }}">Dashboard</a>
                    </li>

                @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item ml-2">
                        <a class="btn btn-main" href="{{ route('register') }}">Register</a>
                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>

<section class="hero">

    <div class="container text-center">

        <h1>Welcome to MedInventory</h1>

        <p>

            Manage medicines, inventory and pharmacy orders easily.

        </p>

        <br>

        <a href="{{ route('medicine.search') }}" class="btn btn-light btn-lg">

            Browse Medicines

        </a>

    </div>

</section>

<div class="container">

    <h2 class="section-title" id="medicines">

        Featured Medicines

    </h2>

    <div class="row">

        @forelse($medicines as $medicine)

            <div class="col-md-4 mb-4">

                <div class="card medicine-card">

                    <a href="{{ route('medicine.search', ['keyword' => $medicine->name]) }}"
                       class="medicine-card-link"
                       aria-label="Search for {{ $medicine->name }}">

                    @if($medicine->image)

                        <img src="{{ $medicine->image_url }}"
                             class="card-img-top medicine-image">

                    @else

                        <img src="https://via.placeholder.com/400x200?text=Medicine"
                             class="card-img-top medicine-image">

                    @endif

                    </a>

                    <div class="card-body">

                        <h4>
                            <a href="{{ route('medicine.search', ['keyword' => $medicine->name]) }}">
                                {{ $medicine->name }}
                            </a>
                        </h4>

                        <p>

                            {{ $medicine->company }}

                        </p>

                        <h5 class="text-success">

                            रु. {{ number_format($medicine->price,2) }}

                        </h5>

                        @if(auth()->check() && auth()->user()->role === 'patient')
                            <form action="{{ route('cart.store') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="medicine_id" value="{{ $medicine->id }}">
                                <button type="submit" class="btn btn-main btn-block">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        @elseif(!auth()->check())
                            <a href="{{ route('login') }}" class="btn btn-outline-success btn-block mt-3">
                                Login to Add to Cart
                            </a>
                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-md-12">

                <div class="alert alert-info">

                    No medicines available.

                </div>

            </div>

        @endforelse

    </div>

</div>

<div class="container">

    <h2 class="section-title">

        Why Choose Us?

    </h2>

    <div class="row">

        <div class="col-md-3">

            <div class="feature-box">

                <div class="feature-icon">💊</div>

                <h5>Genuine Medicines</h5>

            </div>

        </div>

        <div class="col-md-3">

            <div class="feature-box">

                <div class="feature-icon">📦</div>

                <h5>Local Pharmacies</h5>

            </div>

        </div>

        <div class="col-md-3">

            <div class="feature-box">

                <div class="feature-icon">🚚</div>

                <h5>Easy Ordering</h5>

            </div>

        </div>

        <div class="col-md-3">

            <div class="feature-box">

                <div class="feature-icon">🔒</div>

                <h5>Secure Service</h5>

            </div>

        </div>

    </div>

</div>

<footer>

    <h5>MedInventory</h5>

    <p>

        Pharmacy Management System

    </p>

    <small>

        © {{ date('Y') }} MedInventory. All Rights Reserved.

    </small>

</footer>

</body>
</html>
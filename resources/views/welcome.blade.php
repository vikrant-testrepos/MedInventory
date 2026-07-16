<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedInventory - Pharmacy Management System</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>

        body{
            background:#f8fafc;
            font-family:Arial, Helvetica, sans-serif;
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

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container">

        <a class="navbar-brand" href="/">
            💊 MedInventory
        </a>

        <div class="ml-auto">

            @guest

                <a href="{{ route('login') }}" class="btn btn-light mr-2">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn btn-warning">
                    Register
                </a>

            @else

                @if(Auth::user()->role == 'admin')

                    <a href="/admin" class="btn btn-light">
                        Dashboard
                    </a>

                @else

                    <a href="/home" class="btn btn-light">
                        Dashboard
                    </a>

                @endif

            @endguest

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

        <a href="#medicines" class="btn btn-light btn-lg">

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

                    @if($medicine->image)

                        <img src="{{ asset('uploads/medicines/'.$medicine->image) }}"
                             class="card-img-top medicine-image">

                    @else

                        <img src="https://via.placeholder.com/400x200?text=Medicine"
                             class="card-img-top medicine-image">

                    @endif

                    <div class="card-body">

                        <h4>{{ $medicine->name }}</h4>

                        <p>

                            {{ $medicine->company }}

                        </p>

                        <h5 class="text-success">

                            Rs. {{ number_format($medicine->price,2) }}

                        </h5>

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

                <h5>Easy Inventory</h5>

            </div>

        </div>

        <div class="col-md-3">

            <div class="feature-box">

                <div class="feature-icon">🚚</div>

                <h5>Fast Service</h5>

            </div>

        </div>

        <div class="col-md-3">

            <div class="feature-box">

                <div class="feature-icon">🔒</div>

                <h5>Secure Ordering</h5>

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
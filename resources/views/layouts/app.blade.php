<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'MedInventory') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/patient.css') }}" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f8fb;
        }

        .navbar {
            background: #fff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, .08);
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: #16a085 !important;
        }

        .nav-link {
            color: #555 !important;
            margin-left: 15px;
            font-weight: 500;
            transition: .3s;
        }

        .nav-link:hover {
            color: #16a085 !important;
        }

        .btn-main {
            background: #16a085;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 22px;
        }

        .btn-main:hover {
            background: #13856f;
            color: white;
        }

        footer {
            background: white;
            margin-top: 60px;
            padding: 20px;
            text-align: center;
            color: #666;
            border-top: 1px solid #eee;
        }
    </style>

    <link href="{{ asset('css/patient-refresh.css') }}" rel="stylesheet">

    <style>
        .auth-shell { max-width: 760px; margin: 56px auto 90px; padding: 0 18px; }
        .auth-card { border: 1px solid #e4e9ee; border-radius: 12px; overflow: hidden; box-shadow: 0 18px 45px rgba(20,45,67,.10); }
        .auth-intro { background: #142d43; color: #fff; padding: 34px 40px; }
        .auth-intro h1 { margin: 8px 0; font: 700 32px 'Space Grotesk', sans-serif; }
        .auth-intro p { margin: 0; color: #c5d5dc; }
        .auth-kicker { color: #80d4c8; font-size: 12px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        .auth-card .card-body { padding: 34px 40px; }
        .auth-card .btn-primary { background: #ef765f; border-color: #ef765f; }
        @media(max-width:576px) { .auth-intro, .auth-card .card-body { padding: 26px 22px; } .auth-shell { margin-top: 28px; } }
    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light">

    <div class="container">

        <a class="navbar-brand" href="{{ route('welcome') }}">
            <i class="fa-solid fa-prescription-bottle-medical"></i>
            MedInventory
        </a>

        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ml-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('medicine.search') }}">
                        Medicines
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Cart
                        @if($cartCount > 0)
                            <span class="cart-count" aria-label="{{ $cartCount }} items in cart">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patient.orders.index') }}">                        Orders
                    </a>
                </li>

                @auth

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle"
                           href="{{ route('patient.dashboard') }}"
                           id="navbarDropdown"
                           role="button"
                           data-toggle="dropdown">

                            <i class="fa-solid fa-user"></i>
                            {{ Auth::user()->name }}

                        </a>

                        <div class="dropdown-menu dropdown-menu-right">

                            <a class="dropdown-item"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">

                                Logout

                            </a>

                            <form id="logout-form"
                                  action="{{ route('logout') }}"
                                  method="POST"
                                  style="display:none;">

                                @csrf

                            </form>

                        </div>

                    </li>

                @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>

                    <li class="nav-item ml-2">
                        <a class="btn btn-main" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>

<main>
    @yield('content')
</main>

<footer>

    © {{ date('Y') }} MedInventory

    <br>

    Your Trusted Online Pharmacy

</footer>

<script src="{{ asset('js/app.js') }}"></script>

@stack('scripts')

</body>

</html>
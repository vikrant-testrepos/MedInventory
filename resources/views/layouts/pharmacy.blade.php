<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MedInventory Pharmacy</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/pharmacy.css') }}" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    @stack('styles')

</head>

<body>

<div class="wrapper">

    {{-- Sidebar --}}
    @include('components.pharmacy-sidebar')

    {{-- Main Content --}}
    <div class="content">

        {{-- Topbar --}}
        <div class="topbar">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h4 class="mb-0">

                        @yield('title','Pharmacy Dashboard')

                    </h4>

                    <small class="text-muted">

                        Welcome back,
                        {{ Auth::user()->name }}

                    </small>

                </div>

                <div class="d-flex align-items-center">

                    <button class="btn btn-light mr-3">

                        <i class="fas fa-bell"></i>

                    </button>

                    <div class="dropdown">

                        <button
                            class="btn btn-light dropdown-toggle"
                            data-toggle="dropdown">

                            <i class="fas fa-user-circle"></i>

                            {{ Auth::user()->name }}

                        </button>

                        <div class="dropdown-menu dropdown-menu-right">

                            <a class="dropdown-item" href="#">

                                <i class="fas fa-user"></i>

                                Profile

                            </a>

                            <div class="dropdown-divider"></div>

                            <form action="{{ route('logout') }}"
                                  method="POST">

                                @csrf

                                <button class="dropdown-item text-danger">

                                    <i class="fas fa-sign-out-alt"></i>

                                    Logout

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Page Content --}}
        <div class="main">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            @if(session('error'))

                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>

            @endif

            @yield('content')

        </div>

    </div>

</div>

<script src="{{ asset('js/app.js') }}"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@stack('scripts')

</body>

</html>
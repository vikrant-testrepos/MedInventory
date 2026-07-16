<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MedInventory')</title>

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>

        body{
            margin:0;
            background:#f4f6f9;
            font-family:'Segoe UI',sans-serif;
        }

        .wrapper{
            display:flex;
            min-height:100vh;
        }

        .main-content{
            flex:1;
            margin-left:250px;
            display:flex;
            flex-direction:column;
            min-height:100vh;
        }

        .page-content{
            padding:25px;
            flex:1;
        }

        .card{
            border:none;
            border-radius:12px;
            box-shadow:0 3px 10px rgba(0,0,0,.08);
        }

        @media(max-width:991px){

            .main-content{

                margin-left:0;

            }

        }

    </style>

    @stack('styles')

</head>

<body>

<div class="wrapper">

    @include('partials.sidebar')

    <div class="main-content">

        @include('partials.navbar')

        <main class="page-content">

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

        </main>

        @include('partials.footer')

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@stack('scripts')

</body>
</html>
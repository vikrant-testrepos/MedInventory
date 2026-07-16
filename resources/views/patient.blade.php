<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedInventory Patient</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body{
            margin:0;
            font-family:Arial,Helvetica,sans-serif;
            background:#f4f6f9;
        }

        .wrapper{
            display:flex;
            min-height:100vh;
        }

        .sidebar{
            width:240px;
            background:#28a745;
            color:#fff;
        }

        .sidebar h3{
            padding:20px;
            margin:0;
            background:#218838;
            text-align:center;
        }

        .sidebar a{
            display:block;
            color:#fff;
            text-decoration:none;
            padding:15px 20px;
        }

        .sidebar a:hover{
            background:#1e7e34;
        }

        .content{
            flex:1;
        }

        .topbar{
            background:#fff;
            padding:15px 20px;
            border-bottom:1px solid #ddd;
        }

        .main{
            padding:25px;
        }

        .card{
            border:none;
            border-radius:8px;
            box-shadow:0 2px 8px rgba(0,0,0,.1);
        }
    </style>

</head>

<body>

<div class="wrapper">

    <div class="sidebar">

        <h3>💊 MedInventory</h3>

        <a href="{{ route('home') }}">🏠 Dashboard</a>

        <a href="{{ route('home') }}">💊 Browse Medicines</a>

        <a href="{{ route('orders.index') }}">🛒 My Orders</a>

        <hr>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">

            🚪 Logout

        </a>

        <form id="logout-form"
              method="POST"
              action="{{ route('logout') }}"
              style="display:none;">

            @csrf

        </form>

    </div>

    <div class="content">

        <div class="topbar">

            Welcome,
            <strong>{{ Auth::user()->name }}</strong>

        </div>

        <div class="main">

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>
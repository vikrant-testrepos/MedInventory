<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedInventory Admin</title>

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
            width:250px;
            background:#343a40;
            color:#fff;
        }

        .sidebar h3{
            padding:20px;
            margin:0;
            background:#212529;
            text-align:center;
        }

        .sidebar a{
            display:block;
            color:#ddd;
            padding:15px 20px;
            text-decoration:none;
        }

        .sidebar a:hover{
            background:#495057;
            color:#fff;
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

        <a href="/admin">Dashboard</a>
        <a href="#">Medicines</a>
        <a href="{{ route('categories.index') }}">Categories</a>
        <a href="#">Inventory</a>
        <a href="#">Orders</a>
        <a href="#">Reports</a>

        <hr style="background:#666">

        <a href="{{ route('logout') }}"
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
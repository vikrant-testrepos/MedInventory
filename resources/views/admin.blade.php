<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedInventory</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#eef2f7;
            font-family:'Segoe UI',sans-serif;
        }

        .sidebar{

            position:fixed;

            width:250px;

            height:100vh;

            background:#1E293B;

            color:white;

        }

        .logo{

            padding:25px;

            text-align:center;

            font-size:24px;

            font-weight:bold;

            background:#0F172A;

        }

        .logo i{

            color:#22C55E;

        }

        .menu{

            margin-top:20px;

        }

        .menu a{

            display:block;

            color:#CBD5E1;

            padding:15px 25px;

            text-decoration:none;

            transition:.3s;

        }

        .menu a:hover{

            background:#2563EB;

            color:white;

            padding-left:35px;

        }

        .menu i{

            width:25px;

        }

        .main{

            margin-left:250px;

        }

        .navbar{

            background:white;

            height:70px;

            padding:20px 35px;

            display:flex;

            justify-content:space-between;

            align-items:center;

            box-shadow:0 2px 10px rgba(0,0,0,.08);

        }

        .content{

            padding:35px;

        }

        .card{

            border:none;

            border-radius:12px;

            box-shadow:0 5px 15px rgba(0,0,0,.08);

        }

        .stat-card{

            color:white;

            padding:25px;

        }

        .blue{
            background:#2563EB;
        }

        .green{
            background:#22C55E;
        }

        .orange{
            background:#F97316;
        }

        .purple{
            background:#7C3AED;
        }

        table{

            background:white;

        }

    </style>

</head>

<body>

<div class="sidebar">

    <div class="logo">

        <i class="fas fa-capsules"></i>

        MedInventory

    </div>

    <div class="menu">

        <a href="{{ url('/admin') }}">
            <i class="fas fa-chart-line"></i>
            Dashboard
        </a>

        <a href="{{ route('categories.index') }}">
            <i class="fas fa-tags"></i>
            Categories
        </a>

        <a href="#">
            <i class="fas fa-pills"></i>
            Medicines
        </a>

        <a href="#">
            <i class="fas fa-warehouse"></i>
            Inventory
        </a>

        <a href="#">
            <i class="fas fa-cart-plus"></i>
            Orders
        </a>

        <a href="#">
            <i class="fas fa-chart-bar"></i>
            Reports
        </a>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">

            <i class="fas fa-sign-out-alt"></i>

            Logout

        </a>

        <form id="logout-form"
              action="{{ route('logout') }}"
              method="POST"
              style="display:none">

            @csrf

        </form>

    </div>

</div>

<div class="main">

    <div class="navbar">

        <h4>Pharmacy Inventory System</h4>

        <div>

            <i class="fas fa-user-circle fa-lg"></i>

            {{ Auth::user()->name }}

        </div>

    </div>

    <div class="content">

        @yield('content')

    </div>

</div>

</body>

</html>
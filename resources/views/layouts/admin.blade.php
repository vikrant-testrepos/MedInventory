<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <title>MEDINVENTORY Admin</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        body{
            background:#f5f7fb;
        }

        .sidebar{

            width:250px;
            height:100vh;
            background:#2563EB;
            position:fixed;
            color:white;
            padding-top:20px;

        }

        .sidebar a{

            color:white;
            display:block;
            padding:15px 25px;
            text-decoration:none;

        }

        .sidebar a:hover{

            background:rgba(255,255,255,.15);

        }

        .content{

            margin-left:250px;
            padding:30px;

        }

        .card{

            border:none;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,.08);

        }

    </style>

</head>

<body>

<div class="sidebar">

<h3 class="text-center mb-4">
MEDINVENTORY
</h3>

<a href="/admin">
<i class="fa fa-home"></i>
Dashboard
</a>

<a href="/categories">
<i class="fa fa-list"></i>
Categories
</a>

<a href="/medicines">
<i class="fa fa-capsules"></i>
Medicines
</a>

<a href="/orders">
<i class="fa fa-shopping-cart"></i>
Orders
</a>

<a href="/">
<i class="fa fa-globe"></i>
Website
</a>

<a href="/logout">
<i class="fa fa-sign-out-alt"></i>
Logout
</a>

</div>

<div class="content">

@yield('content')

</div>

</body>
</html>
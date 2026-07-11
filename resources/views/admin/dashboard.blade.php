@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Dashboard</h2>

<div class="row">

    <div class="col-md-3 mb-4">

        <div class="card bg-primary text-white shadow">

            <div class="card-body">

                <h6>Total Medicines</h6>

                <h2>{{ \App\Medicine::count() }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card bg-success text-white shadow">

            <div class="card-body">

                <h6>Categories</h6>

                <h2>{{ \App\Category::count() }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card bg-warning text-white shadow">

            <div class="card-body">

                <h6>Orders</h6>

                <h2>0</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card bg-danger text-white shadow">

            <div class="card-body">

                <h6>Stock</h6>

                <h2>0</h2>

            </div>

        </div>

    </div>

</div>

@endsection
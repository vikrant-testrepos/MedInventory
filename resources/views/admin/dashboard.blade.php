@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Dashboard</h2>

<div class="mb-4">

    <a href="{{ route('categories.create') }}" class="btn btn-success mr-2">
        + Add Category
    </a>

    <a href="{{ route('medicines.create') }}" class="btn btn-primary mr-2">
        + Add Medicine
    </a>

    <a href="{{ route('orders.create') }}" class="btn btn-warning text-dark">
        + New Order
    </a>

</div>

<div class="row">

    <!-- Medicines -->

    <div class="col-md-3 mb-4">

        <a href="{{ route('medicines.index') }}" style="text-decoration:none;">

            <div class="card bg-primary text-white shadow">

                <div class="card-body text-center">

                    <h6>Total Medicines</h6>

                    <h2>{{ $medicineCount }}</h2>

                    <hr style="background:white">

                    <small>View Medicines →</small>

                </div>

            </div>

        </a>

    </div>

    <!-- Categories -->

    <div class="col-md-3 mb-4">

        <a href="{{ route('categories.index') }}" style="text-decoration:none;">

            <div class="card bg-success text-white shadow">

                <div class="card-body text-center">

                    <h6>Categories</h6>

                    <h2>{{ $categoryCount }}</h2>

                    <hr style="background:white">

                    <small>View Categories →</small>

                </div>

            </div>

        </a>

    </div>

    <!-- Orders -->

    <div class="col-md-3 mb-4">

        <a href="{{ route('orders.index') }}" style="text-decoration:none;">

            <div class="card bg-warning text-dark shadow">

                <div class="card-body text-center">

                    <h6>Total Orders</h6>

                    <h2>{{ $orderCount }}</h2>

                    <hr>

                    <small>Manage Orders →</small>

                </div>

            </div>

        </a>

    </div>

    <!-- Inventory -->

    <div class="col-md-3 mb-4">

        <a href="{{ route('inventory.index') }}" style="text-decoration:none;">

            <div class="card bg-danger text-white shadow">

                <div class="card-body text-center">

                    <h6>Low Stock Items</h6>

                    <h2>{{ $lowStock }}</h2>

                    <hr style="background:white">

                    <small>Manage Inventory →</small>

                </div>

            </div>

        </a>

    </div>

</div>

@if($lowStock > 0)

<div class="alert alert-warning mt-3">

    <strong>Warning!</strong>

    There are {{ $lowStock }} medicine(s) with low stock.

    <a href="{{ route('inventory.index') }}" class="btn btn-sm btn-danger float-right">

        View Inventory

    </a>

</div>

@endif

@endsection
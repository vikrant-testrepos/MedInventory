@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Reports</h2>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h6>Total Medicines</h6>
                    <h2>{{ $totalMedicines }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h6>Categories</h6>
                    <h2>{{ $totalCategories }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <h6>Orders</h6>
                    <h2>{{ $totalOrders }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                    <h6>Out of Stock</h6>
                    <h2>{{ $outOfStock }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5>Inventory Alert</h5>
            <p>
                Medicines with low stock (<strong>10 or less</strong>):
                <strong>{{ $lowStock }}</strong>
            </p>
        </div>
    </div>
@endsection

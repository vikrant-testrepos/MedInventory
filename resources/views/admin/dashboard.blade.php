@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">
            Dashboard
        </h2>

        <p class="text-muted mb-0">
            Welcome back, {{ Auth::user()->name }} 👋
        </p>
    </div>

</div>


{{-- Statistics Cards --}}

<div class="row">

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Medicines
                        </small>

                        <h2 class="mb-0">
                            {{ $totalMedicines }}
                        </h2>

                    </div>

                    <div class="rounded-circle bg-primary text-white p-3">

                        <i class="fas fa-pills fa-lg"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Categories
                        </small>

                        <h2 class="mb-0">
                            {{ $totalCategories }}
                        </h2>

                    </div>

                    <div class="rounded-circle bg-success text-white p-3">

                        <i class="fas fa-tags fa-lg"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Orders
                        </small>

                        <h2 class="mb-0">
                            {{ $totalOrders }}
                        </h2>

                    </div>

                    <div class="rounded-circle bg-warning text-white p-3">

                        <i class="fas fa-shopping-cart fa-lg"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Pharmacies
                        </small>

                        <h2 class="mb-0">
                            {{ $totalPharmacies }}
                        </h2>

                    </div>

                    <div class="rounded-circle bg-danger text-white p-3">

                        <i class="fas fa-clinic-medical fa-lg"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row">

    {{-- Recent Orders --}}

    <div class="col-lg-8 mb-4">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <strong>
                    Recent Orders
                </strong>

            </div>

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="thead-light">

                        <tr>

                            <th>#</th>

                            <th>Patient</th>

                            <th>Medicine</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($recentOrders as $order)

                        <tr>

                            <td>#{{ $order->id }}</td>

                            <td>
                                {{ optional($order->user)->name }}
                            </td>

                            <td>
                                {{ optional($order->medicine)->name }}
                            </td>

                            <td>

                                @if($order->status=="Pending")

                                    <span class="badge badge-warning">

                                        Pending

                                    </span>

                                @elseif($order->status=="Preparing")

                                    <span class="badge badge-info">

                                        Preparing

                                    </span>

                                @elseif($order->status=="Delivered")

                                    <span class="badge badge-success">

                                        Delivered

                                    </span>

                                @else

                                    <span class="badge badge-danger">

                                        Cancelled

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center">

                                No orders found.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Low Stock --}}

    <div class="col-lg-4 mb-4">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <strong>

                    Low Stock Medicines

                </strong>

            </div>

            <div class="card-body">

                @forelse($lowStock as $medicine)

                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <div>

                            <strong>

                                {{ $medicine->name }}

                            </strong>

                        </div>

                        <span class="badge badge-danger">

                            {{ $medicine->quantity }}

                        </span>

                    </div>

                @empty

                    <p class="text-muted mb-0">

                        No low stock medicines.

                    </p>

                @endforelse

            </div>

        </div>

    </div>

</div>


<div class="row">

    {{-- Latest Pharmacies --}}

    <div class="col-lg-6 mb-4">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <strong>

                    Latest Pharmacies

                </strong>

            </div>

            <div class="card-body">

                @forelse($latestPharmacies as $pharmacy)

                    <div class="d-flex justify-content-between border-bottom py-2">

                        <span>

                            {{ $pharmacy->name }}

                        </span>

                        <small class="text-muted">

                            {{ $pharmacy->district }}

                        </small>

                    </div>

                @empty

                    <p class="text-muted">

                        No pharmacies available.

                    </p>

                @endforelse

            </div>

        </div>

    </div>


    {{-- Quick Actions --}}

    <div class="col-lg-6 mb-4">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <strong>

                    Quick Actions

                </strong>

            </div>

            <div class="card-body">

                <a href="{{ route('medicines.create') }}" class="btn btn-primary mb-2 btn-block">

                    <i class="fas fa-plus"></i>

                    Add Medicine

                </a>

                <a href="{{ route('categories.create') }}" class="btn btn-success mb-2 btn-block">

                    <i class="fas fa-folder-plus"></i>

                    Add Category

                </a>

                <a href="{{ route('pharmacies.create') }}" class="btn btn-info btn-block">

                    <i class="fas fa-clinic-medical"></i>

                    Add Pharmacy

                </a>

            </div>

        </div>

    </div>

</div>

@endsection
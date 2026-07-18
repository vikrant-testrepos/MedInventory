@extends('layouts.pharmacy')

@section('title','Pharmacy Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">
            Pharmacy Dashboard
        </h2>

        <p class="text-muted">
            Welcome back,
            <strong>{{ Auth::user()->name }}</strong>
        </p>

    </div>

</div>

<div class="row">

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">Medicines</small>

                    <h2>{{ $totalMedicines }}</h2>

                </div>

                <div class="stat-icon bg-primary">

                    <i class="fas fa-pills"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">Inventory</small>

                    <h2>{{ $totalInventory }}</h2>

                </div>

                <div class="stat-icon bg-success">

                    <i class="fas fa-boxes"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">Pending Orders</small>

                    <h2>{{ $pendingOrders }}</h2>

                </div>

                <div class="stat-icon bg-warning">

                    <i class="fas fa-clock"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">Completed</small>

                    <h2>{{ $completedOrders }}</h2>

                </div>

                <div class="stat-icon bg-info">

                    <i class="fas fa-check-circle"></i>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-lg-8 mb-4">

        <div class="card">

            <div class="card-header">

                Recent Orders

            </div>

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead>

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

                            <td>{{ optional($order->user)->name }}</td>

                            <td>{{ optional($order->medicine)->name }}</td>

                            <td>

                                @if($order->status=="Pending")

                                    <span class="badge badge-warning">Pending</span>

                                @elseif($order->status=="Preparing")

                                    <span class="badge badge-info">Preparing</span>

                                @elseif($order->status=="Ready")

                                    <span class="badge badge-primary">Ready</span>

                                @elseif($order->status=="Delivered")

                                    <span class="badge badge-success">Delivered</span>

                                @else

                                    <span class="badge badge-danger">Cancelled</span>

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

    <div class="col-lg-4">

        <div class="card mb-4">

            <div class="card-header">

                Low Stock

            </div>

            <div class="card-body">

                @forelse($lowStock as $item)

                    <div class="border-bottom py-2">

                        <strong>

                            {{ optional($item->medicine)->name }}

                        </strong>

                        <br>

                        <small>

                            {{ $item->stock }} Left

                        </small>

                    </div>

                @empty

                    <p class="text-muted mb-0">

                        No low stock medicines.

                    </p>

                @endforelse

            </div>

        </div>

        <div class="card">

            <div class="card-header">

                Quick Actions

            </div>

            <div class="card-body">

                <a href="#" class="btn btn-success btn-block mb-2">

                    <i class="fas fa-plus"></i>

                    Add Medicine

                </a>

                <a href="#" class="btn btn-primary btn-block mb-2">

                    <i class="fas fa-box"></i>

                    Inventory

                </a>

                <a href="#" class="btn btn-warning btn-block">

                    <i class="fas fa-shopping-cart"></i>

                    Orders

                </a>

            </div>

        </div>

    </div>

</div>

@endsection
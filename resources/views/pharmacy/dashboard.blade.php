@extends('layouts.pharmacy')

@section('title','Pharmacy Dashboard')

@section('content')

<div class="container-fluid">

    {{-- Dashboard Header --}}

    <div class="card shadow border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <h2 class="font-weight-bold mb-2">

                        <i class="fas fa-clinic-medical text-success"></i>

                        Pharmacy Dashboard

                    </h2>

                    <p class="text-muted mb-0">

                        Welcome back,

                        <strong>{{ Auth::user()->name }}</strong>

                    </p>

                </div>

                <div class="col-md-4 text-right">

                    <a href="{{ route('pharmacy.my-pharmacy') }}"
                       class="btn btn-success">

                        <i class="fas fa-store"></i>

                        My Pharmacy

                    </a>

                    <a href="{{ route('pharmacy.profile') }}"
                       class="btn btn-primary">

                        <i class="fas fa-user-edit"></i>

                        Edit Profile

                    </a>

                </div>

            </div>

        </div>

    </div>



    {{-- Statistics Cards --}}

    <div class="row">

        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <div class="mb-3">

                        <i class="fas fa-pills fa-3x text-primary"></i>

                    </div>

                    <h3 class="font-weight-bold">

                        {{ $totalMedicines }}

                    </h3>

                    <small class="text-muted">

                        Medicines

                    </small>

                </div>

            </div>

        </div>



        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <div class="mb-3">

                        <i class="fas fa-boxes fa-3x text-success"></i>

                    </div>

                    <h3 class="font-weight-bold">

                        {{ $totalInventory }}

                    </h3>

                    <small class="text-muted">

                        Inventory

                    </small>

                </div>

            </div>

        </div>



        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <div class="mb-3">

                        <i class="fas fa-shopping-cart fa-3x text-warning"></i>

                    </div>

                    <h3 class="font-weight-bold">

                        {{ $pendingOrders }}

                    </h3>

                    <small class="text-muted">

                        Pending Orders

                    </small>

                </div>

            </div>

        </div>



        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <div class="mb-3">

                        <i class="fas fa-check-circle fa-3x text-info"></i>

                    </div>

                    <h3 class="font-weight-bold">

                        {{ $completedOrders }}

                    </h3>

                    <small class="text-muted">

                        Completed

                    </small>

                </div>

            </div>

        </div>



        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <div class="mb-3">

                        <i class="fas fa-list fa-3x text-danger"></i>

                    </div>

                    <h3 class="font-weight-bold">

                        {{ $totalOrders }}

                    </h3>

                    <small class="text-muted">

                        Total Orders

                    </small>

                </div>

            </div>

        </div>



        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <div class="mb-3">

                        <i class="fas fa-rupee-sign fa-3x text-success"></i>

                    </div>

                    <h4 class="font-weight-bold">

                        Rs. {{ number_format($totalRevenue,2) }}

                    </h4>

                    <small class="text-muted">

                        Revenue

                    </small>

                </div>

            </div>

        </div>

    </div>

        {{-- Revenue Chart + Today's Summary --}}

    <div class="row">

        <div class="col-lg-8 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="fas fa-chart-line text-success"></i>

                        Monthly Revenue

                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="revenueChart" height="110"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="fas fa-chart-pie text-primary"></i>

                        Today's Summary

                    </h5>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">

                        <span>Total Orders</span>

                        <strong>{{ $totalOrders }}</strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Pending</span>

                        <span class="badge badge-warning">

                            {{ $pendingOrders }}

                        </span>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Completed</span>

                        <span class="badge badge-success">

                            {{ $completedOrders }}

                        </span>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>Total Revenue</span>

                        <strong class="text-success">

                            Rs. {{ number_format($totalRevenue,2) }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

        {{-- Recent Orders --}}

    <div class="card shadow border-0 mb-4">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">

                    <i class="fas fa-shopping-cart text-primary"></i>

                    Recent Orders

                </h5>

                <a href="{{ route('pharmacy.orders.index') }}"
                   class="btn btn-sm btn-success">

                    View All

                </a>

            </div>

        </div>

        <div class="table-responsive">

            <table class="table table-hover mb-0">

                <thead class="thead-light">

                <tr>

                    <th>#</th>

                    <th>Customer</th>

                    <th>Medicine</th>

                    <th>Qty</th>

                    <th>Total</th>

                    <th>Status</th>

                </tr>

                </thead>

                <tbody>

                @forelse($recentOrders as $order)

                    <tr>

                        <td>

                            <strong>#{{ $order->id }}</strong>

                        </td>

                        <td>

                            {{ optional($order->user)->name }}

                        </td>

                        <td>

                            {{ optional($order->medicine)->name }}

                        </td>

                        <td>

                            {{ $order->quantity }}

                        </td>

                        <td>

                            <strong>

                                Rs. {{ number_format($order->total_price,2) }}

                            </strong>

                        </td>

                        <td>

                            @if($order->status == 'Pending')

                                <span class="badge badge-warning">
                                    Pending
                                </span>

                            @elseif($order->status == 'Accepted')

                                <span class="badge badge-info">
                                    Accepted
                                </span>

                            @elseif($order->status == 'Preparing')

                                <span class="badge badge-primary">
                                    Preparing
                                </span>

                            @elseif($order->status == 'Ready')

                                <span class="badge badge-secondary">
                                    Ready
                                </span>

                            @elseif($order->status == 'Completed')

                                <span class="badge badge-success">
                                    Completed
                                </span>

                            @elseif($order->status == 'Rejected')

                                <span class="badge badge-danger">
                                    Rejected
                                </span>

                            @else

                                <span class="badge badge-dark">
                                    {{ $order->status }}
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-5">

                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>

                            <br>

                            No recent orders found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

        <div class="row">

        {{-- Low Stock Medicines --}}

        <div class="col-lg-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0 text-danger">

                        <i class="fas fa-exclamation-triangle"></i>

                        Low Stock Medicines

                    </h5>

                </div>

                <div class="card-body">

                    @forelse($lowStock as $item)

                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">

                            <div>

                                <strong>

                                    {{ optional($item->medicine)->name }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    Current Stock

                                </small>

                            </div>

                            @if($item->stock<=5)

                                <span class="badge badge-danger p-2">

                                    {{ $item->stock }} Left

                                </span>

                            @else

                                <span class="badge badge-warning p-2">

                                    {{ $item->stock }} Left

                                </span>

                            @endif

                        </div>

                    @empty

                        <div class="text-center py-5">

                            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>

                            <h5>

                                Great!

                            </h5>

                            <p class="text-muted">

                                No medicines are running low.

                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>



        {{-- Quick Actions --}}

        <div class="col-lg-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="fas fa-bolt text-warning"></i>

                        Quick Actions

                    </h5>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <a href="{{ route('pharmacy.medicines.create') }}"

                               class="btn btn-success btn-block btn-lg">

                                <i class="fas fa-plus-circle"></i>

                                <br>

                                Add Medicine

                            </a>

                        </div>

                        <div class="col-md-6 mb-3">

                            <a href="{{ route('pharmacy.inventory.index') }}"

                               class="btn btn-primary btn-block btn-lg">

                                <i class="fas fa-boxes"></i>

                                <br>

                                Inventory

                            </a>

                        </div>

                        <div class="col-md-6 mb-3">

                            <a href="{{ route('pharmacy.orders.index') }}"

                               class="btn btn-warning btn-block btn-lg">

                                <i class="fas fa-shopping-cart"></i>

                                <br>

                                Orders

                            </a>

                        </div>

                        <div class="col-md-6 mb-3">

                            <a href="{{ route('pharmacy.reports.index') }}"

                               class="btn btn-info btn-block btn-lg">

                                <i class="fas fa-chart-bar"></i>

                                <br>

                                Reports

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    var ctx = document.getElementById('revenueChart').getContext('2d');

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: [

                'Jan',

                'Feb',

                'Mar',

                'Apr',

                'May',

                'Jun',

                'Jul',

                'Aug',

                'Sep',

                'Oct',

                'Nov',

                'Dec'

            ],

            datasets: [{

                label: 'Revenue (Rs.)',

                data: @json($monthlyRevenue),

                borderColor: '#28a745',

                backgroundColor: 'rgba(40,167,69,0.15)',

                borderWidth: 3,

                fill: true,

                tension: 0.4,

                pointRadius: 5,

                pointBackgroundColor: '#28a745'

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: true

                }

            },

            scales: {

                y: {

                    beginAtZero: true

                }

            }

        }

    });

});

</script>

@endsection
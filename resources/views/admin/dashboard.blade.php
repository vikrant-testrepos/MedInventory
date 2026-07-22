@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="font-weight-bold">Admin Dashboard</h2>
            <p class="text-muted mb-0">
                Welcome back,
                <strong>{{ Auth::user()->name }}</strong>
            </p>
        </div>

        <a href="{{ route('reports.print') }}"
           class="btn btn-success">

            <i class="fas fa-file-pdf"></i>

            Download Report

        </a>

    </div>

    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card shadow border-left-primary h-100">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col">

                            <div class="text-xs text-primary text-uppercase mb-1">

                                Medicines

                            </div>

                            <div class="h3 font-weight-bold">

                                {{ $totalMedicines }}

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-pills fa-3x text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card shadow border-left-success h-100">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col">

                            <div class="text-xs text-success text-uppercase mb-1">

                                Orders

                            </div>

                            <div class="h3 font-weight-bold">

                                {{ $totalOrders }}

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-shopping-cart fa-3x text-success"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card shadow border-left-warning h-100">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col">

                            <div class="text-xs text-warning text-uppercase mb-1">

                                Revenue

                            </div>

                            <div class="h4 font-weight-bold">

                                Rs {{ number_format($totalRevenue,2) }}

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-wallet fa-3x text-warning"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card shadow border-left-danger h-100">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col">

                            <div class="text-xs text-danger text-uppercase mb-1">

                                Patients

                            </div>

                            <div class="h3 font-weight-bold">

                                {{ $totalPatients }}

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-users fa-3x text-danger"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-2 col-md-4 mb-3">

            <div class="card shadow border-left-warning">

                <div class="card-body text-center">

                    <h3>{{ $pendingOrders }}</h3>

                    <small>Pending</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 mb-3">

            <div class="card shadow border-left-primary">

                <div class="card-body text-center">

                    <h3>{{ $acceptedOrders }}</h3>

                    <small>Accepted</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 mb-3">

            <div class="card shadow border-left-info">

                <div class="card-body text-center">

                    <h3>{{ $preparingOrders }}</h3>

                    <small>Preparing</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 mb-3">

            <div class="card shadow border-left-secondary">

                <div class="card-body text-center">

                    <h3>{{ $readyOrders }}</h3>

                    <small>Ready</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 mb-3">

            <div class="card shadow border-left-success">

                <div class="card-body text-center">

                    <h3>{{ $completedOrders }}</h3>

                    <small>Completed</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 mb-3">

            <div class="card shadow border-left-danger">

                <div class="card-body text-center">

                    <h3>{{ $cancelledOrders }}</h3>

                    <small>Cancelled</small>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-8 mb-4">

            <div class="card shadow">

                <div class="card-header bg-white">

                    <strong>Monthly Revenue</strong>

                </div>

                <div class="card-body">

                    <canvas id="revenueChart" height="110"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card shadow">

                <div class="card-header bg-white">

                    <strong>Order Status</strong>

                </div>

                <div class="card-body">

                    <canvas id="statusChart"></canvas>

                </div>

            </div>

        </div>

    </div>

        <div class="row">

        <div class="col-lg-8 mb-4">

            <div class="card shadow">

                <div class="card-header bg-white">

                    <strong>Recent Orders</strong>

                </div>

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead class="thead-light">

                            <tr>

                                <th>ID</th>
                                <th>Patient</th>
                                <th>Medicine</th>
                                <th>Pharmacy</th>
                                <th>Total</th>
                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                        @forelse($recentOrders as $order)

                            <tr>

                                <td>#{{ $order->id }}</td>

                                <td>{{ optional($order->user)->name }}</td>

                                <td>{{ optional($order->medicine)->name }}</td>

                                <td>{{ optional($order->pharmacy)->name }}</td>

                                <td>

                                    Rs {{ number_format($order->total_price,2) }}

                                </td>

                                <td>

                                    @if($order->status=="Pending")

                                        <span class="badge badge-warning">
                                            Pending
                                        </span>

                                    @elseif($order->status=="Accepted")

                                        <span class="badge badge-primary">
                                            Accepted
                                        </span>

                                    @elseif($order->status=="Preparing")

                                        <span class="badge badge-info">
                                            Preparing
                                        </span>

                                    @elseif($order->status=="Ready")

                                        <span class="badge badge-secondary">
                                            Ready
                                        </span>

                                    @elseif($order->status=="Completed" || $order->status=="Delivered")

                                        <span class="badge badge-success">
                                            {{ $order->status }}
                                        </span>

                                    @else

                                        <span class="badge badge-danger">
                                            {{ $order->status }}
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    No Orders Found

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card shadow">

                <div class="card-header bg-white">

                    <strong>System Summary</strong>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between border-bottom py-2">

                        <span>Total Medicines</span>

                        <strong>{{ $totalMedicines }}</strong>

                    </div>

                    <div class="d-flex justify-content-between border-bottom py-2">

                        <span>Categories</span>

                        <strong>{{ $totalCategories }}</strong>

                    </div>

                    <div class="d-flex justify-content-between border-bottom py-2">

                        <span>Pharmacies</span>

                        <strong>{{ $totalPharmacies }}</strong>

                    </div>

                    <div class="d-flex justify-content-between border-bottom py-2">

                        <span>Patients</span>

                        <strong>{{ $totalPatients }}</strong>

                    </div>

                    <div class="d-flex justify-content-between border-bottom py-2">

                        <span>Total Orders</span>

                        <strong>{{ $totalOrders }}</strong>

                    </div>

                    <div class="d-flex justify-content-between pt-3">

                        <span class="font-weight-bold">

                            Revenue

                        </span>

                        <strong class="text-success">

                            Rs {{ number_format($totalRevenue,2) }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-6 mb-4">

            <div class="card shadow">

                <div class="card-header bg-white">

                    <strong>Low Stock Medicines</strong>

                </div>

                <div class="card-body">

                    @forelse($lowStock as $stock)

                        <div class="d-flex justify-content-between border-bottom py-2">

                            <div>

                                <strong>

                                    {{ optional($stock->medicine)->name }}

                                </strong>

                            </div>

                            <span class="badge badge-warning">

                                {{ $stock->stock }}

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

        <div class="col-lg-6 mb-4">

            <div class="card shadow">

                <div class="card-header bg-white">

                    <strong>Latest Pharmacies</strong>

                </div>

                <div class="card-body">

                    @forelse($latestPharmacies as $pharmacy)

                        <div class="border-bottom py-2">

                            <strong>

                                {{ $pharmacy->name }}

                            </strong>

                            <br>

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

    </div>

    <div class="card shadow mb-4">

    <div class="card-header bg-white">

        <strong>Quick Actions</strong>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-3 mb-2">

                <a href="{{ route('medicines.create') }}"
                   class="btn btn-primary btn-block">

                    <i class="fas fa-plus-circle"></i>

                    Add Medicine

                </a>

            </div>

            <div class="col-md-3 mb-2">

                <a href="{{ route('categories.create') }}"
                   class="btn btn-success btn-block">

                    <i class="fas fa-folder-plus"></i>

                    Add Category

                </a>

            </div>

            <div class="col-md-3 mb-2">

                <a href="{{ route('pharmacies.create') }}"
                   class="btn btn-info btn-block">

                    <i class="fas fa-clinic-medical"></i>

                    Add Pharmacy

                </a>

            </div>

            <div class="col-md-3 mb-2">

                <a href="{{ route('reports.print') }}"
                   class="btn btn-danger btn-block">

                    <i class="fas fa-file-pdf"></i>

                    Download Report

                </a>

            </div>

        </div>

    </div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById('revenueChart'), {

    type: 'line',

    data: {

        labels: [
            'Jan','Feb','Mar','Apr','May','Jun',
            'Jul','Aug','Sep','Oct','Nov','Dec'
        ],

        datasets: [{

            label: 'Revenue',

            data: [
                12000,
                15000,
                18000,
                21000,
                25000,
                29000,
                33000,
                36000,
                41000,
                45000,
                49000,
                {{ $totalRevenue }}
            ],

            borderColor: '#28a745',

            backgroundColor: 'rgba(40,167,69,.15)',

            fill: true,

            tension: .4

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                display: false

            }

        }

    }

});

new Chart(document.getElementById('statusChart'), {

    type: 'doughnut',

    data: {

        labels: [

            'Pending',

            'Accepted',

            'Preparing',

            'Ready',

            'Completed',

            'Cancelled'

        ],

        datasets: [{

            data: [

                {{ $pendingOrders }},

                {{ $acceptedOrders }},

                {{ $preparingOrders }},

                {{ $readyOrders }},

                {{ $completedOrders }},

                {{ $cancelledOrders }}

            ],

            backgroundColor: [

                '#ffc107',

                '#007bff',

                '#17a2b8',

                '#6c757d',

                '#28a745',

                '#dc3545'

            ]

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: true,

        plugins: {

            legend: {

                position: 'bottom'

            }

        }

    }

});

</script>

@endsection
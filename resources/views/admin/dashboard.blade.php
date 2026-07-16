@extends('layouts.dashboard')

@section('title','Admin Dashboard')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        Dashboard
    </h2>

    <div class="row">

        <div class="col-md-3 mb-4">

            <div class="card text-center">

                <div class="card-body">

                    <i class="fas fa-pills fa-2x text-primary mb-3"></i>

                    <h3>{{ $totalMedicines }}</h3>

                    <p>Total Medicines</p>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card text-center">

                <div class="card-body">

                    <i class="fas fa-tags fa-2x text-success mb-3"></i>

                    <h3>{{ $totalCategories }}</h3>

                    <p>Categories</p>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card text-center">

                <div class="card-body">

                    <i class="fas fa-shopping-cart fa-2x text-warning mb-3"></i>

                    <h3>{{ $totalOrders }}</h3>

                    <p>Total Orders</p>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card text-center">

                <div class="card-body">

                    <i class="fas fa-clinic-medical fa-2x text-danger mb-3"></i>

                    <h3>{{ $totalPharmacies }}</h3>

                    <p>Pharmacies</p>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-7">

            <div class="card">

                <div class="card-header">

                    <strong>Recent Orders</strong>

                </div>

                <div class="card-body p-0">

                    <table class="table table-hover mb-0">

                        <thead>

                        <tr>

                            <th>ID</th>

                            <th>Medicine</th>

                            <th>Patient</th>

                            <th>Status</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($recentOrders as $order)

                            <tr>

                                <td>{{ $order->id }}</td>

                                <td>{{ $order->medicine->name ?? '-' }}</td>

                                <td>{{ $order->user->name ?? '-' }}</td>

                                <td>

                                    <span class="badge badge-info">

                                        {{ $order->status }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center">

                                    No Orders

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="col-lg-5">

            <div class="card">

                <div class="card-header">

                    <strong>Low Stock Medicines</strong>

                </div>

                <div class="card-body">

                    @forelse($lowStock as $medicine)

                        <div class="d-flex justify-content-between border-bottom py-2">

                            <span>

                                {{ $medicine->name }}

                            </span>

                            <span class="badge badge-danger">

                                {{ $medicine->quantity }}

                            </span>

                        </div>

                    @empty

                        <p class="mb-0">

                            No low stock medicines.

                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
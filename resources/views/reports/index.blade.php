@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Reports Dashboard</h2>

<div class="mb-4">

    <a href="{{ route('reports.print') }}"
       target="_blank"
       class="btn btn-success">

        🖨 Print Report

    </a>

</div>

<div class="row">

    <div class="col-md-3 mb-3">

        <div class="card bg-primary text-white shadow">

            <div class="card-body text-center">

                <h6>Total Medicines</h6>

                <h2>{{ $totalMedicines }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card bg-success text-white shadow">

            <div class="card-body text-center">

                <h6>Total Categories</h6>

                <h2>{{ $totalCategories }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card bg-warning text-dark shadow">

            <div class="card-body text-center">

                <h6>Total Orders</h6>

                <h2>{{ $totalOrders }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card bg-info text-white shadow">

            <div class="card-body text-center">

                <h6>Total Stock</h6>

                <h2>{{ $totalStock }}</h2>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-6 mb-4">

        <div class="card shadow border-danger">

            <div class="card-header bg-danger text-white">

                Inventory Summary

            </div>

            <div class="card-body">

                <p>

                    <strong>Low Stock Medicines:</strong>

                    {{ $lowStock }}

                </p>

                <p>

                    <strong>Out of Stock:</strong>

                    {{ $outOfStock }}

                </p>

                <p>

                    <strong>Total Inventory Value:</strong>

                    Rs. {{ number_format($inventoryValue ?? 0,2) }}

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-6 mb-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                Low Stock Medicines

            </div>

            <div class="card-body p-0">

                <table class="table table-bordered mb-0">

                    <thead>

                        <tr>

                            <th>Medicine</th>

                            <th>Company</th>

                            <th>Stock</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($lowStockMedicines as $medicine)

                        <tr>

                            <td>{{ $medicine->name }}</td>

                            <td>{{ $medicine->company }}</td>

                            <td>

                                @if($medicine->quantity == 0)

                                    <span class="badge badge-danger">

                                        Out of Stock

                                    </span>

                                @else

                                    <span class="badge badge-warning">

                                        {{ $medicine->quantity }}

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="text-center">

                                No low stock medicines.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="card shadow mt-4">

    <div class="card-header bg-success text-white">

        Recent Orders

    </div>

    <div class="card-body p-0">

        <table class="table table-hover mb-0">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Medicine</th>

                    <th>Customer</th>

                    <th>Quantity</th>

                    <th>Total</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

            @forelse($recentOrders as $order)

                <tr>

                    <td>{{ $order->id }}</td>

                    <td>{{ $order->medicine->name ?? '-' }}</td>

                    <td>{{ $order->user->name ?? '-' }}</td>

                    <td>{{ $order->quantity }}</td>

                    <td>Rs. {{ number_format($order->total_price,2) }}</td>

                    <td>

                        @if($order->status == 'Pending')

                            <span class="badge badge-warning">

                                Pending

                            </span>

                        @elseif($order->status == 'Approved')

                            <span class="badge badge-info">

                                Approved

                            </span>

                        @else

                            <span class="badge badge-success">

                                Delivered

                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        No orders found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
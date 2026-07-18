@extends('layouts.pharmacy')

@section('title', 'Reports')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Reports</h2>
            <small class="text-muted">
                Sales & Order Summary
            </small>
        </div>

        <a href="{{ route('pharmacy.reports.print') }}"
           target="_blank"
           class="btn btn-success">

            <i class="fas fa-print"></i>
            Print Report

        </a>

    </div>

    <div class="row">

        <div class="col-md-3">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-body text-center">

                    <h2>{{ $totalOrders }}</h2>

                    <p class="mb-0">
                        Total Orders
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-body text-center">

                    <h2>{{ $pendingOrders }}</h2>

                    <p class="mb-0">
                        Pending Orders
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-body text-center">

                    <h2>{{ $completedOrders }}</h2>

                    <p class="mb-0">
                        Completed Orders
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-body text-center">

                    <h2>Rs. {{ number_format($totalRevenue,2) }}</h2>

                    <p class="mb-0">
                        Total Revenue
                    </p>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-header">

            <strong>Order Report</strong>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="thead-light">

                    <tr>

                        <th>#</th>
                        <th>Customer</th>
                        <th>Medicine</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($orders as $order)

                    <tr>

                        <td>{{ $order->id }}</td>

                        <td>{{ optional($order->user)->name }}</td>

                        <td>{{ optional($order->medicine)->name }}</td>

                        <td>{{ $order->quantity }}</td>

                        <td>
                            Rs. {{ number_format($order->total_price,2) }}
                        </td>

                        <td>

                            @switch($order->status)

                                @case('Pending')

                                    <span class="badge badge-warning">
                                        Pending
                                    </span>

                                    @break

                                @case('Accepted')

                                    <span class="badge badge-primary">
                                        Accepted
                                    </span>

                                    @break

                                @case('Preparing')

                                    <span class="badge badge-info">
                                        Preparing
                                    </span>

                                    @break

                                @case('Ready')

                                    <span class="badge badge-secondary">
                                        Ready
                                    </span>

                                    @break

                                @case('Completed')

                                    <span class="badge badge-success">
                                        Completed
                                    </span>

                                    @break

                                @case('Rejected')

                                    <span class="badge badge-danger">
                                        Rejected
                                    </span>

                                    @break

                                @default

                                    <span class="badge badge-dark">

                                        {{ $order->status }}

                                    </span>

                            @endswitch

                        </td>

                        <td>

                            {{ $order->created_at->format('d M Y') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            No Orders Found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
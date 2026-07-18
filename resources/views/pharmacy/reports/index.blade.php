@extends('layouts.pharmacy')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Reports</h2>
            <small class="text-muted">Sales & Order Summary</small>
        </div>

        <button onclick="window.print()" class="btn btn-success">
            <i class="fas fa-print"></i> Print Report
        </button>
    </div>

    <div class="row">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h3>{{ $totalOrders }}</h3>
                    <p>Total Orders</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h3>{{ $pendingOrders }}</h3>
                    <p>Pending Orders</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h3>{{ $completedOrders }}</h3>
                    <p>Completed Orders</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h3>Rs. {{ number_format($totalRevenue, 2) }}</h3>
                    <p>Total Revenue</p>
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
                            Rs. {{ number_format($order->total_price, 2) }}
                        </td>

                        <td>

                            @if($order->status == 'Completed')
                                <span class="badge badge-success">Completed</span>

                            @elseif($order->status == 'Ready')
                                <span class="badge badge-info">Ready</span>

                            @elseif($order->status == 'Preparing')
                                <span class="badge badge-warning">Preparing</span>

                            @elseif($order->status == 'Accepted')
                                <span class="badge badge-primary">Accepted</span>

                            @elseif($order->status == 'Rejected')
                                <span class="badge badge-danger">Rejected</span>

                            @else
                                <span class="badge badge-secondary">
                                    {{ $order->status }}
                                </span>
                            @endif

                        </td>

                        <td>{{ $order->created_at->format('d M Y') }}</td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            No orders found.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
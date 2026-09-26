@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Admin Reports</h2>
            <small class="text-muted">
                Overall System Summary
            </small>
        </div>

        <a href="{{ route('reports.print') }}" class="btn btn-success">
            <i class="fas fa-file-pdf"></i>
            Download PDF
        </a>

    </div>

    <div class="row">

        <div class="col-md-3 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h2>{{ $totalOrders }}</h2>

                    <p class="mb-0">Total Orders</p>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h2>{{ $totalMedicines }}</h2>

                    <p class="mb-0">Medicines</p>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h2>{{ $totalPharmacies }}</h2>

                    <p class="mb-0">Pharmacies</p>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h2>{{ $totalPatients }}</h2>

                    <p class="mb-0">Patients</p>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-4 mb-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h3>रु. {{ number_format($totalRevenue,2) }}</h3>

                    <p>Total Revenue</p>

                </div>

            </div>

        </div>

        <div class="col-md-8 mb-4">

            <div class="card shadow border-0">

                <div class="card-body">

                    <div class="row text-center">

                        <div class="col">
                            <strong>{{ $pendingOrders }}</strong>
                            <br>
                            Pending
                        </div>

                        <div class="col">
                            <strong>{{ $acceptedOrders }}</strong>
                            <br>
                            Accepted
                        </div>

                        <div class="col">
                            <strong>{{ $preparingOrders }}</strong>
                            <br>
                            Preparing
                        </div>

                        <div class="col">
                            <strong>{{ $readyOrders }}</strong>
                            <br>
                            Ready
                        </div>

                        <div class="col">
                            <strong>{{ $completedOrders }}</strong>
                            <br>
                            Completed
                        </div>

                        <div class="col">
                            <strong>{{ $rejectedOrders }}</strong>
                            <br>
                            Rejected
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow">

        <div class="card-header">

            <strong>Recent Orders</strong>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="thead-light">

                    <tr>

                        <th>#</th>
                        <th>Patient</th>
                        <th>Medicine</th>
                        <th>Pharmacy</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($recentOrders as $order)

                    <tr>

                        <td>{{ $order->id }}</td>

                        <td>{{ optional($order->user)->name }}</td>

                        <td>{{ optional($order->medicine)->name }}</td>

                        <td>{{ optional($order->pharmacy)->name }}</td>

                        <td>{{ $order->quantity }}</td>

                        <td>
                            रु. {{ number_format($order->total_price,2) }}
                        </td>

                        <td>

                            @if($order->status=="Completed")

                                <span class="badge badge-success">
                                    Completed
                                </span>

                            @elseif($order->status=="Pending")

                                <span class="badge badge-warning">
                                    Pending
                                </span>

                            @elseif($order->status=="Rejected")

                                <span class="badge badge-danger">
                                    Rejected
                                </span>

                            @else

                                <span class="badge badge-info">
                                    {{ $order->status }}
                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $order->created_at->format('d M Y') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center">

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
@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="font-weight-bold">
                <i class="fas fa-shopping-bag text-success"></i>
                My Orders
            </h2>

            <p class="text-muted mb-0">
                Track all your medicine orders.
            </p>
        </div>

        <a href="{{ route('patient.dashboard') }}" class="btn btn-success">
            <i class="fas fa-shopping-cart"></i>
            Continue Shopping
        </a>

    </div>

    @if($orders->count())

    <div class="card shadow border-0">

        <div class="table-responsive">

            <table class="table table-hover mb-0">

                <thead class="bg-success text-white">

                    <tr>

                        <th>#</th>

                        <th>Medicine</th>

                        <th>Quantity</th>

                        <th>Total</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($orders as $order)

                    <tr>

                        <td>{{ $order->id }}</td>

                        <td>

                            <strong>

                                {{ optional($order->medicine)->name }}

                            </strong>

                        </td>

                        <td>

                            {{ $order->quantity }}

                        </td>

                        <td>

                            Rs. {{ number_format($order->total_price,2) }}

                        </td>

                        <td>

                            @if($order->status=="Pending")

                                <span class="badge badge-warning">

                                    Pending

                                </span>

                            @elseif($order->status=="Processing")

                                <span class="badge badge-info">

                                    Processing

                                </span>

                            @elseif($order->status=="Delivered")

                                <span class="badge badge-success">

                                    Delivered

                                </span>

                            @else

                                <span class="badge badge-secondary">

                                    {{ $order->status }}

                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

    @else

    <div class="card shadow border-0">

        <div class="card-body text-center py-5">

            <i class="fas fa-box-open fa-4x text-secondary mb-3"></i>

            <h3>No Orders Yet</h3>

            <p class="text-muted">

                You haven't placed any orders yet.

            </p>

            <a href="{{ route('patient.dashboard') }}"
               class="btn btn-success">

                Browse Medicines

            </a>

        </div>

    </div>

    @endif

</div>

@endsection
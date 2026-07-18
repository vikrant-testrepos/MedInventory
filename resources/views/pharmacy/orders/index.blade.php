@extends('layouts.pharmacy')

@section('title','Orders')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Orders</h2>

        <p class="text-muted">
            Manage customer orders.
        </p>

    </div>

</div>

<div class="card shadow">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="thead-light">

                <tr>

                    <th>#</th>

                    <th>Patient</th>

                    <th>Medicine</th>

                    <th>Quantity</th>

                    <th>Total</th>

                    <th>Payment</th>

                    <th>Status</th>

                    <th>Date</th>

                    <th width="100">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($orders as $order)

                    <tr>

                        <td>{{ $order->id }}</td>

                        <td>{{ $order->user->name }}</td>

                        <td>{{ $order->medicine->name }}</td>

                        <td>{{ $order->quantity }}</td>

                        <td>Rs. {{ number_format($order->total_price,2) }}</td>

                        <td>{{ ucfirst($order->payment_method) }}</td>

                        <td>

                            @if($order->status=='Pending')

                                <span class="badge badge-warning">
                                    Pending
                                </span>

                            @elseif($order->status=='Accepted')

                                <span class="badge badge-info">
                                    Accepted
                                </span>

                            @elseif($order->status=='Preparing')

                                <span class="badge badge-primary">
                                    Preparing
                                </span>

                            @elseif($order->status=='Ready')

                                <span class="badge badge-success">
                                    Ready
                                </span>

                            @elseif($order->status=='Completed')

                                <span class="badge badge-success">
                                    Completed
                                </span>

                            @else

                                <span class="badge badge-danger">
                                    {{ $order->status }}
                                </span>

                            @endif

                        </td>

                        <td>{{ $order->created_at->format('d M Y') }}</td>

                        <td>

                            <a href="{{ route('pharmacy.orders.show',$order) }}"
                               class="btn btn-sm btn-primary">

                                <i class="fas fa-eye"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9"
                            class="text-center">

                            No orders found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{ $orders->links() }}

    </div>

</div>

@endsection
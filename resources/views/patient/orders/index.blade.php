@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>My Orders</h2>

            <p class="text-muted">
                View all your medicine orders
            </p>

        </div>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            @if($orders->count())

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>

                        <tr>

                            <th>#</th>

                            <th>Medicine</th>

                            <th>Pharmacy</th>

                            <th>Quantity</th>

                            <th>Total</th>

                            <th>Status</th>

                            <th></th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($orders as $order)

                            <tr>

                                <td>{{ $order->id }}</td>

                                <td>{{ $order->medicine->name }}</td>

                                <td>{{ optional($order->medicine->pharmacy)->name }}</td>

                                <td>{{ $order->quantity }}</td>

                                <td>रु. {{ number_format($order->total_price,2) }}</td>

                                <td>

                                    @if($order->status=="Pending")

                                        <span class="badge badge-warning">

                                            Pending

                                        </span>

                                    @elseif($order->status=="Accepted")

                                        <span class="badge badge-info">

                                            Accepted

                                        </span>

                                    @elseif($order->status=="Preparing")

                                        <span class="badge badge-primary">

                                            Preparing

                                        </span>

                                    @elseif($order->status=="Ready")

                                        <span class="badge badge-secondary">

                                            Ready

                                        </span>

                                    @elseif($order->status=="Completed")

                                        <span class="badge badge-success">

                                            Completed

                                        </span>

                                    @else

                                        <span class="badge badge-danger">

                                            Rejected

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('patient.orders.show',$order) }}"
                                       class="btn btn-sm btn-primary">

                                        View

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

                {{ $orders->links() }}

            @else

                <div class="alert alert-info">

                    You haven't placed any orders yet.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
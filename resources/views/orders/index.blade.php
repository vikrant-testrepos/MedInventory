@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Orders</h2>

    <a href="{{ route('orders.create') }}" class="btn btn-primary">
        + New Order
    </a>

</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="thead-dark">

                    <tr>

                        <th>ID</th>

                        <th>Medicine</th>

                        <th>Customer</th>

                        <th>Quantity</th>

                        <th>Total</th>

                        <th>Status</th>

                        <th width="170">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($orders as $order)

                    <tr>

                        <td>{{ $order->id }}</td>

                        <td>{{ $order->medicine->name ?? '-' }}</td>

                        <td>{{ $order->user->name ?? '-' }}</td>

                        <td>{{ $order->quantity }}</td>

                        <td>Rs. {{ number_format($order->total_price,2) }}</td>

                        <td>

                            @if($order->status=='Pending')

                                <span class="badge badge-warning">
                                    Pending
                                </span>

                            @elseif($order->status=='Approved')

                                <span class="badge badge-info">
                                    Approved
                                </span>

                            @else

                                <span class="badge badge-success">
                                    Delivered
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('orders.edit',$order->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('orders.destroy',$order->id) }}"
                                  method="POST"
                                  style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this order?')">

                                    Delete

                                </button>

                            </form>

                        </td>

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

        {{ $orders->links() }}

    </div>

</div>

@endsection
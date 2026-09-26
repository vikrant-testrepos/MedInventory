@extends('layouts.pharmacy')

@section('title','Order Details')

@section('content')

@if(session('success'))

<div class="alert alert-success">

    <i class="fas fa-check-circle"></i>

    {{ session('success') }}

</div>

@endif

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Order #{{ $order->id }}</h2>

        <p class="text-muted">

            Customer Order Details

        </p>

    </div>

    <a href="{{ route('pharmacy.orders.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Back

    </a>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="card shadow mb-4">

            <div class="card-header">

                Patient Information

            </div>

            <div class="card-body">

                <p>

                    <strong>Name:</strong>

                    {{ $order->user->name }}

                </p>

                <p>

                    <strong>Phone:</strong>

                    {{ $order->phone }}

                </p>

                <p>

                    <strong>District:</strong>

                    {{ $order->district }}

                </p>

                <p>

                    <strong>Address:</strong>

                    {{ $order->address }}

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card shadow mb-4">

            <div class="card-header">

                Order Information

            </div>

            <div class="card-body">

                <p>

                    <strong>Medicine:</strong>

                    {{ $order->medicine->name }}

                </p>

                <p>

                    <strong>Quantity:</strong>

                    {{ $order->quantity }}

                </p>

                <p>

                    <strong>Total:</strong>

                    रु. {{ number_format($order->total_price,2) }}

                </p>

                <p>

                    <strong>Payment:</strong>

                    {{ ucfirst($order->payment_method) }}

                </p>

                <p>

                    <strong>Status:</strong>

                    {{ $order->status }}

                </p>

            </div>

        </div>

    </div>

</div>

<div class="card shadow">

    <div class="card-header">

        Update Order Status

    </div>

    <div class="card-body">

        <form action="{{ route('pharmacy.orders.update',$order->id) }}"
              method="POST">

            @csrf

            @method('PUT')

            <div class="row">

                <div class="col-md-6">

                    <select
                        name="status"
                        class="form-control">

                        <option
                            {{ $order->status=='Pending'?'selected':'' }}>
                            Pending
                        </option>

                        <option
                            {{ $order->status=='Accepted'?'selected':'' }}>
                            Accepted
                        </option>

                        <option
                            {{ $order->status=='Preparing'?'selected':'' }}>
                            Preparing
                        </option>

                        <option
                            {{ $order->status=='Ready'?'selected':'' }}>
                            Ready
                        </option>

                        <option
                            {{ $order->status=='Completed'?'selected':'' }}>
                            Completed
                        </option>

                        <option
                            {{ $order->status=='Rejected'?'selected':'' }}>
                            Rejected
                        </option>

                    </select>

                </div>

                <div class="col-md-3">

                    <button
                        class="btn btn-success">

                        Update Status

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection
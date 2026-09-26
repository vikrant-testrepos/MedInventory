@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Update Order</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="card">

    <div class="card-body">

        <form action="{{ route('orders.update', $order->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">

                <label>Medicine</label>

                <input type="text"
                       class="form-control"
                       value="{{ $order->medicine->name }}"
                       readonly>

            </div>

            <div class="form-group">

                <label>Customer</label>

                <input type="text"
                       class="form-control"
                       value="{{ $order->user->name }}"
                       readonly>

            </div>

            <div class="form-group">

                <label>Quantity</label>

                <input type="text"
                       class="form-control"
                       value="{{ $order->quantity }}"
                       readonly>

            </div>

            <div class="form-group">

                <label>Total Price</label>

                <input type="text"
                       class="form-control"
                       value="रु. {{ number_format($order->total_price,2) }}"
                       readonly>

            </div>

            <div class="form-group">

                <label>Status</label>

                <select name="status" class="form-control">

                    <option value="Pending"
                        {{ $order->status == 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Approved"
                        {{ $order->status == 'Approved' ? 'selected' : '' }}>
                        Approved
                    </option>

                    <option value="Delivered"
                        {{ $order->status == 'Delivered' ? 'selected' : '' }}>
                        Delivered
                    </option>

                </select>

            </div>

            <button class="btn btn-primary">

                Update Order

            </button>

            <a href="{{ route('orders.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection
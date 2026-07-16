@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>New Order</h2>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
        Back
    </a>

</div>

@if($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

@if(session('error'))

<div class="alert alert-danger">

    {{ session('error') }}

</div>

@endif

<div class="card">

    <div class="card-body">

        <form action="{{ route('orders.store') }}" method="POST">

            @csrf

            <div class="form-group">

                <label>Medicine</label>

                <select name="medicine_id" class="form-control" required>

                    <option value="">-- Select Medicine --</option>

                    @foreach($medicines as $medicine)

                        <option value="{{ $medicine->id }}">

                            {{ $medicine->name }}
                            (Stock: {{ $medicine->quantity }})
                            - Rs. {{ number_format($medicine->price,2) }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">

                <label>Quantity</label>

                <input type="number"
                       name="quantity"
                       class="form-control"
                       min="1"
                       value="1"
                       required>

            </div>

            <button type="submit" class="btn btn-primary">

                Place Order

            </button>

            <a href="{{ route('orders.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection
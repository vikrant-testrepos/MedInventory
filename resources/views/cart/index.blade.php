@extends('layouts.app')

@section('content')

<div class="container my-5">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="row">

        <div class="col-lg-8">

            <h2 class="mb-4">

                <i class="fas fa-shopping-cart text-success"></i>

                My Shopping Cart

            </h2>

            @forelse($cartItems as $item)

                @php

                    $subtotal = $item->price * $item->quantity;

                @endphp

                <div class="card shadow-sm border-0 rounded-lg mb-4">

                    <div class="card-body">

                        <div class="row align-items-center">

                            <!-- Medicine Image -->

                            <div class="col-md-3 text-center">

                                @if($item->medicine->image)

                                    <img
                                        src="{{ $item->medicine->image_url }}"
                                        class="img-fluid"
                                        style="max-height:120px;">

                                @else

                                    <i class="fas fa-capsules text-success"
                                       style="font-size:80px;"></i>

                                @endif

                            </div>

                            <!-- Medicine Info -->

                            <div class="col-md-5">

                                <h4>

                                    {{ $item->medicine->name }}

                                </h4>

                                <p class="text-muted mb-1">

                                    {{ $item->medicine->company }}

                                </p>

                                <p class="mb-1">

                                    <span class="badge badge-info">

                                        {{ optional($item->medicine->category)->name }}

                                    </span>

                                </p>

                                <small class="text-primary">

                                    <i class="fas fa-store"></i>

                                    {{ optional($item->medicine->pharmacy)->name }}

                                </small>

                                <div class="mt-2">

                                    <span class="text-warning">

                                        ★★★★★

                                    </span>

                                    <small class="text-muted">

                                        (4.8)

                                    </small>

                                </div>

                            </div>

                            <!-- Quantity -->

                            <div class="col-md-2 text-center">

                                <h5>

                                    रु.
                                    {{ number_format($item->price,2) }}

                                </h5>

                                <div class="d-flex justify-content-center align-items-center mt-3">

                                    <form
                                        action="{{ route('cart.decrease',$item->id) }}"
                                        method="POST">

                                        @csrf

                                        @method('PATCH')

                                        <button class="btn btn-outline-secondary btn-sm">

                                            -

                                        </button>

                                    </form>

                                    <span class="mx-3 font-weight-bold">

                                        {{ $item->quantity }}

                                    </span>

                                    <form
                                        action="{{ route('cart.increase',$item->id) }}"
                                        method="POST">

                                        @csrf

                                        @method('PATCH')

                                        <button class="btn btn-outline-success btn-sm">

                                            +

                                        </button>

                                    </form>

                                </div>

                            </div>

                            <!-- Total -->

                            <div class="col-md-2 text-center">

                                <h5 class="text-success">

                                    रु.
                                    {{ number_format($subtotal,2) }}

                                </h5>

                                <form
                                    action="{{ route('cart.destroy',$item->id) }}"
                                    method="POST"
                                    class="mt-3">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="card shadow border-0">

                    <div class="card-body text-center py-5">

                        <i class="fas fa-shopping-cart text-muted"
                           style="font-size:90px;"></i>

                        <h3 class="mt-4">

                            Your cart is empty

                        </h3>

                        <p class="text-muted">

                            Browse medicines and add them to your cart.

                        </p>

                        <a
                            href="{{ route('patient.dashboard') }}"
                            class="btn btn-main">

                            Continue Shopping

                        </a>

                    </div>

                </div>

            @endforelse

        </div>

                <!-- Order Summary -->

        <div class="col-lg-4">

            <div class="card shadow border-0 rounded-lg sticky-top" style="top:20px;">

                <div class="card-body">

                    <h3 class="mb-4">

                        Order Summary

                    </h3>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">

                        <span>

                            Subtotal

                        </span>

                        <strong>

                            रु. {{ number_format($grandTotal,2) }}

                        </strong>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <span>

                            Delivery

                        </span>

                        <strong>

                            रु. 100.00

                        </strong>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <span>

                            Discount

                        </span>

                        <strong class="text-success">

                            रु. 0.00

                        </strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <h4>

                            Grand Total

                        </h4>

                        <h4 class="text-success">

                            रु. {{ number_format($grandTotal + 100,2) }}

                        </h4>

                    </div>

                    @if($cartItems->count())

                        <a
                            href="{{ route('checkout.index') }}"
                            class="btn btn-success btn-lg btn-block mt-4">

                            <i class="fas fa-credit-card"></i>

                            Proceed to Checkout

                        </a>

                        <a
                            href="{{ route('patient.dashboard') }}"
                            class="btn btn-outline-secondary btn-block mt-2">

                            <i class="fas fa-arrow-left"></i>

                            Continue Shopping

                        </a>

                    @else

                        <a
                            href="{{ route('patient.dashboard') }}"
                            class="btn btn-primary btn-block mt-4">

                            Browse Medicines

                        </a>

                    @endif

                    <div class="mt-4">

                        <small class="text-muted">

                            <i class="fas fa-lock"></i>

                            Secure checkout with encrypted order processing.

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
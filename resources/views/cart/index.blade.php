@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            <i class="fas fa-shopping-cart"></i>
            My Shopping Cart
        </h2>

        <a href="{{ route('home') }}" class="btn btn-primary">
            <i class="fas fa-search"></i>
            Continue Shopping
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @php
        $grandTotal = 0;
    @endphp

    @if($cartItems->count())

    <div class="card shadow">

        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">

                <thead class="thead-dark">

                    <tr>

                        <th>Medicine</th>

                        <th>Price</th>

                        <th width="120">Quantity</th>

                        <th>Total</th>

                        <th width="100">Action</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($cartItems as $item)

                    @php

                        $total = $item->price * $item->quantity;

                        $grandTotal += $total;

                    @endphp

                    <tr>

                        <td>

                            <strong>

                                {{ $item->medicine->name }}

                            </strong>

                            <br>

                            <small class="text-muted">

                                {{ $item->medicine->company }}

                            </small>

                        </td>

                        <td>

                            Rs. {{ number_format($item->price,2) }}

                        </td>

                        <td>

                            {{ $item->quantity }}

                        </td>

                        <td>

                            Rs. {{ number_format($total,2) }}

                        </td>

                        <td>

                            <form
                                action="{{ route('cart.destroy',$item->id) }}"
                                method="POST">

                                @csrf

                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <div class="card mt-4 shadow">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 offset-md-6">

                    <table class="table">

                        <tr>

                            <th>Subtotal</th>

                            <td>

                                Rs. {{ number_format($grandTotal,2) }}

                            </td>

                        </tr>

                        <tr>

                            <th>Delivery Charge</th>

                            <td>

                                Rs. 100.00

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Grand Total

                            </th>

                            <th class="text-success">

                                Rs. {{ number_format($grandTotal + 100,2) }}

                            </th>

                        </tr>

                    </table>

                    <a href="#" class="btn btn-success btn-lg btn-block">

                        <i class="fas fa-credit-card"></i>

                        Proceed to Checkout

                    </a>

                </div>

            </div>

        </div>

    </div>

    @else

        <div class="alert alert-info">

            <h4>Your cart is empty.</h4>

            <p>

                Search medicines and add them to your cart.

            </p>

            <a href="{{ route('home') }}" class="btn btn-primary">

                Browse Medicines

            </a>

        </div>

    @endif

</div>

@endsection
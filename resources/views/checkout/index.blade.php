@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <!-- Delivery Details -->
        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h4>Delivery Details</h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('checkout.store') }}" method="POST">

                        @csrf

                        <div class="form-group">

                            <label>Phone Number</label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                required>

                        </div>

                        <div class="form-group">

                            <label>District</label>

                            <input
                                type="text"
                                name="district"
                                class="form-control"
                                required>

                        </div>

                        <div class="form-group">

                            <label>Complete Address</label>

                            <textarea
                                name="address"
                                class="form-control"
                                rows="3"
                                required></textarea>

                        </div>

                        <div class="form-group">

                            <label>Payment Method</label>

                            <select
                                name="payment_method"
                                class="form-control">

                                <option value="Cash on Delivery">
                                    Cash on Delivery
                                </option>

                                <option value="eSewa">
                                    eSewa
                                </option>

                                <option value="Khalti">
                                    Khalti
                                </option>

                            </select>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success btn-lg btn-block">

                            Place Order

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- Order Summary -->
        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">

                    <h4>Order Summary</h4>

                </div>

                <div class="card-body">

                    @foreach($cartItems as $item)

                        <p>

                            <strong>

                                {{ $item->medicine->name }}

                            </strong>

                            <br>

                            {{ $item->quantity }} × Rs. {{ number_format($item->price, 2) }}

                        </p>

                        <hr>

                    @endforeach

                    <table class="table">

                        <tr>

                            <th>Subtotal</th>

                            <td>

                                Rs. {{ number_format($subtotal, 2) }}

                            </td>

                        </tr>

                        <tr>

                            <th>Delivery Charge</th>

                            <td>

                                Rs. {{ number_format($delivery, 2) }}

                            </td>

                        </tr>

                        <tr>

                            <th>Total</th>

                            <th class="text-success">

                                Rs. {{ number_format($grandTotal, 2) }}

                            </th>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
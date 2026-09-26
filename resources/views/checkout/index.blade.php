@extends('layouts.app')

@section('content')

<div class="container my-5">

    <div class="row">

        <!-- Checkout Form -->
        <div class="col-lg-8">

            <div class="card shadow border-0 rounded-lg">

                <div class="card-header bg-success text-white py-3">

                    <h3 class="mb-0">
                        <i class="fas fa-map-marker-alt"></i>
                        Delivery Information
                    </h3>

                </div>

                <div class="card-body p-4">

                    <form action="{{ route('checkout.store') }}" method="POST">

                        @csrf

                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <label><strong>Name</strong></label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ auth()->user()->name }}"
                                    readonly>

                            </div>

                            <div class="form-group col-md-6">

                                <label><strong>Email</strong></label>

                                <input
                                    type="email"
                                    class="form-control"
                                    value="{{ auth()->user()->email }}"
                                    readonly>

                            </div>

                        </div>

                        <div class="form-group">

                            <label><strong>Phone Number</strong></label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                placeholder="98XXXXXXXX"
                                required>

                        </div>

                        <div class="form-group">

                            <label><strong>District</strong></label>

                            <select
                                name="district"
                                class="form-control"
                                required>

                                <option value="">Select District</option>
                                <option>Kathmandu</option>
                                <option>Lalitpur</option>
                                <option>Bhaktapur</option>
                                <option>Pokhara</option>
                                <option>Chitwan</option>
                                <option>Biratnagar</option>
                                <option>Butwal</option>
                                <option>Dharan</option>
                                <option>Janakpur</option>
                                <option>Nepalgunj</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label><strong>Delivery Address</strong></label>

                            <textarea
                                name="address"
                                rows="4"
                                class="form-control"
                                placeholder="House No, Street, Area..."
                                required></textarea>

                        </div>

                        <div class="form-group">

                            <label><strong>Payment Method</strong></label>

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

                        <div class="form-group">

                            <label><strong>Order Notes (Optional)</strong></label>

                            <textarea
                                class="form-control"
                                rows="3"
                                placeholder="Any delivery instructions..."></textarea>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success btn-lg btn-block">

                            <i class="fas fa-check-circle"></i>

                            Place Order

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">

            <div class="card shadow border-0 rounded-lg sticky-top" style="top:20px;">

                <div class="card-body">

                    <h3 class="mb-4">

                        Order Summary

                    </h3>

                    <hr>

                    @foreach($cartItems as $item)

                        <div class="d-flex justify-content-between mb-3">

                            <div>

                                <strong>

                                    {{ $item->medicine->name }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    Qty: {{ $item->quantity }}

                                </small>

                            </div>

                            <strong>

                                रु. {{ number_format($item->price * $item->quantity,2) }}

                            </strong>

                        </div>

                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between mb-2">

                        <span>Subtotal</span>

                        <strong>

                            रु. {{ number_format($subtotal,2) }}

                        </strong>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span>Delivery</span>

                        <strong>

                            रु. {{ number_format($delivery,2) }}

                        </strong>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Discount</span>

                        <strong class="text-success">

                            रु. 0.00

                        </strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <h4>Total</h4>

                        <h4 class="text-success">

                            रु. {{ number_format($grandTotal,2) }}

                        </h4>

                    </div>

                    <div class="alert alert-light mt-4 mb-0">

                        <i class="fas fa-lock text-success"></i>

                        Secure Checkout

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
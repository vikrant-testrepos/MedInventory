@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow border-0">

                <div class="card-body text-center p-5">

                    <div class="mb-4">

                        <i class="fas fa-check-circle text-success"
                           style="font-size:90px;"></i>

                    </div>

                    <h2 class="text-success">

                        Order Placed Successfully!

                    </h2>

                    <p class="lead mt-3">

                        Thank you for ordering from

                        <strong>MedInventory</strong>.

                    </p>

                    <p>

                        Your order has been received and is now being processed.

                    </p>

                    <hr>

                    <div class="row mt-4">

                        <div class="col-md-4">

                            <i class="fas fa-box fa-2x text-primary"></i>

                            <h5 class="mt-2">

                                Order Confirmed

                            </h5>

                        </div>

                        <div class="col-md-4">

                            <i class="fas fa-truck fa-2x text-warning"></i>

                            <h5 class="mt-2">

                                Preparing Delivery

                            </h5>

                        </div>

                        <div class="col-md-4">

                            <i class="fas fa-home fa-2x text-success"></i>

                            <h5 class="mt-2">

                                Delivered Soon

                            </h5>

                        </div>

                    </div>

                    <div class="mt-5">

                        <a href="{{ route('patient.dashboard') }}"
                           class="btn btn-success btn-lg">

                            Continue Shopping

                        </a>

                        <a href="{{ route('patient.orders.index') }}"
                        class="btn btn-outline-primary btn-lg ml-2">

                            View My Orders

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
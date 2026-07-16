@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-4">

        <div class="col-md-12">

            <div class="jumbotron bg-white shadow-sm">

                <h2>Welcome, {{ Auth::user()->name }}</h2>

                <p class="text-muted">
                    Browse medicines and place your orders online.
                </p>

            </div>

        </div>

    </div>

    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card border-primary shadow-sm">

                <div class="card-body text-center">

                    <h5>Available Medicines</h5>

                    <h2>{{ \App\Medicine::count() }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-success shadow-sm">

                <div class="card-body text-center">

                    <h5>My Orders</h5>

                    <h2>{{ Auth::user()->orders()->count() }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-warning shadow-sm">

                <div class="card-body text-center">

                    <h5>Pending</h5>

                    <h2>
                        {{ Auth::user()->orders()->where('status','Pending')->count() }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-info shadow-sm">

                <div class="card-body text-center">

                    <h5>Delivered</h5>

                    <h2>
                        {{ Auth::user()->orders()->where('status','Delivered')->count() }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Available Medicines</h3>

        <a href="{{ route('orders.create') }}" class="btn btn-primary">
            Place New Order
        </a>

    </div>

    <div class="row">

        @forelse($medicines as $medicine)

            <div class="col-md-4 mb-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <h4>{{ $medicine->name }}</h4>

                        <p>

                            <strong>Company:</strong>

                            {{ $medicine->company }}

                        </p>

                        <p>

                            <strong>Category:</strong>

                            {{ optional($medicine->category)->name }}

                        </p>

                        <p>

                            <strong>Price:</strong>

                            Rs. {{ number_format($medicine->price,2) }}

                        </p>

                        <p>

                            <strong>Available Stock:</strong>

                            {{ $medicine->quantity }}

                        </p>

                    </div>

                    <div class="card-footer bg-white">

                        @if($medicine->quantity > 0)

                            <a href="{{ route('orders.create') }}"
                               class="btn btn-success btn-block">

                                Order Now

                            </a>

                        @else

                            <button class="btn btn-secondary btn-block" disabled>

                                Out of Stock

                            </button>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-md-12">

                <div class="alert alert-warning">

                    No medicines available.

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection
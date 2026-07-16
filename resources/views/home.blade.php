@extends('layouts.app')

@section('content')

<div class="container">

    {{-- Welcome Banner --}}
    <div class="row mb-4">

        <div class="col-md-12">

            <div class="jumbotron bg-white shadow-sm">

                <h2>

                    Welcome,

                    {{ Auth::user()->name }}

                </h2>

                <p class="text-muted">

                    Search medicines, compare pharmacies and place your orders online.

                </p>

            </div>

        </div>

    </div>

    {{-- Dashboard Statistics --}}
    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card border-primary shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-pills fa-2x text-primary mb-2"></i>

                    <h5>Available Medicines</h5>

                    <h2>

                        {{ \App\Medicine::count() }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-success shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-shopping-cart fa-2x text-success mb-2"></i>

                    <h5>My Orders</h5>

                    <h2>

                        {{ Auth::user()->orders()->count() }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-warning shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>

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

                    <i class="fas fa-check-circle fa-2x text-info mb-2"></i>

                    <h5>Delivered</h5>

                    <h2>

                        {{ Auth::user()->orders()->where('status','Delivered')->count() }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    {{-- Search Medicine --}}
    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <h4 class="mb-3">

                <i class="fas fa-search text-primary"></i>

                Search Medicines

            </h4>

            <form action="{{ route('medicine.search') }}" method="GET">

                <div class="input-group">

                    <input

                        type="text"

                        name="search"

                        class="form-control"

                        placeholder="Search medicine (Example: Paracetamol)"

                        required>

                    <div class="input-group-append">

                        <button class="btn btn-primary">

                            <i class="fas fa-search"></i>

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Medicines Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>

            Featured Medicines

        </h3>

        <a href="{{ route('orders.create') }}" class="btn btn-primary">

            <i class="fas fa-shopping-cart"></i>

            Place New Order

        </a>

    </div>

    {{-- Medicines --}}
    <div class="row">

        @forelse($medicines as $medicine)

            <div class="col-md-4 mb-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <h4>

                            {{ $medicine->name }}

                        </h4>

                        <hr>

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

                            <span class="text-success">

                                Rs.

                                {{ number_format($medicine->price,2) }}

                            </span>

                        </p>

                        <p>

                            <strong>Stock:</strong>

                            @if($medicine->quantity>10)

                                <span class="badge badge-success">

                                    {{ $medicine->quantity }}

                                </span>

                            @elseif($medicine->quantity>0)

                                <span class="badge badge-warning">

                                    {{ $medicine->quantity }}

                                </span>

                            @else

                                <span class="badge badge-danger">

                                    Out of Stock

                                </span>

                            @endif

                        </p>

                        @if($medicine->pharmacy)

                            <p>

                                <strong>Pharmacy:</strong>

                                {{ $medicine->pharmacy->name }}

                            </p>

                        @endif

                    </div>

                    <div class="card-footer bg-white">

                        @if($medicine->quantity>0)

                            <a

                                href="{{ route('orders.create') }}"

                                class="btn btn-success btn-block">

                                <i class="fas fa-shopping-cart"></i>

                                Order Now

                            </a>

                        @else

                            <button

                                class="btn btn-secondary btn-block"

                                disabled>

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
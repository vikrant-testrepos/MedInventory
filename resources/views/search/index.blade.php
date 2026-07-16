@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="row mb-4">

        <div class="col-md-12">

            <div class="card shadow">

                <div class="card-body">

                    <h3 class="mb-3">

                        <i class="fas fa-search"></i>

                        Search Medicines

                    </h3>

                    <form action="{{ route('medicine.search') }}" method="GET">

                        <div class="input-group">

                            <input
                                type="text"
                                name="search"
                                class="form-control form-control-lg"
                                placeholder="Enter medicine name..."
                                value="{{ request('search') }}">

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

        </div>

    </div>

    @if(request('search'))

    <div class="mb-4">

        <h4>

            Search Results for

            <span class="text-primary">

                "{{ request('search') }}"

            </span>

        </h4>

    </div>

    @endif

    <div class="row">

        @forelse($medicines as $medicine)

        <div class="col-lg-4 mb-4">

            <div class="card h-100 shadow-sm">

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

                        <strong>Pharmacy:</strong>

                        {{ optional($medicine->pharmacy)->name }}

                    </p>

                    <p>

                        <strong>District:</strong>

                        {{ optional($medicine->pharmacy)->district }}

                    </p>

                    <p>

                        <strong>Address:</strong>

                        {{ optional($medicine->pharmacy)->address }}

                    </p>

                    <p>

                        <strong>Price:</strong>

                        <span class="text-success">

                            Rs. {{ number_format($medicine->price,2) }}

                        </span>

                    </p>

                    <p>

                        <strong>Available:</strong>

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

                </div>

                <div class="card-footer bg-white">

                    href="{{ route('orders.create.medicine',$medicine->id) }}"

                       class="btn btn-success btn-block">

                        <i class="fas fa-shopping-cart"></i>

                        Order Now

                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-md-12">

            <div class="alert alert-warning">

                No medicines found.

            </div>

        </div>

        @endforelse

    </div>

    <div class="mt-4">

        {{ $medicines->links() }}

    </div>

</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Search Header -->

    <div class="hero">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <h1>Search Medicines</h1>

                <p>
                    Find medicines by name, company or category.
                </p>

                <form action="{{ route('medicine.search') }}" method="GET">

                    <div class="search-box">

                        <div class="input-group">

                            <input
                                type="text"
                                name="keyword"
                                class="form-control"
                                value="{{ $keyword }}"
                                placeholder="Search medicines...">

                            <div class="input-group-append">

                                <button class="btn btn-main">

                                    <i class="fas fa-search"></i>

                                    Search

                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <div class="col-lg-4 text-center">

                <i class="fas fa-search fa-8x text-white" style="opacity:.15;"></i>

            </div>

        </div>

    </div>

    <h2 class="section-title">

        Search Results

        <small class="text-muted">

            ({{ $medicines->total() }} medicines)

        </small>

    </h2>

    <div class="row">

        @forelse($medicines as $medicine)

            <div class="col-lg-4 col-md-6">

                <div class="medicine-card">

                    <span class="badge-new">

                        Available

                    </span>

                    <div class="wishlist">

                        <i class="far fa-heart"></i>

                    </div>

                    <div class="medicine-image">

                        @if($medicine->image)

                            <img
                                src="{{ asset('storage/'.$medicine->image) }}"
                                class="img-fluid">

                        @else

                            <i class="fas fa-capsules"></i>

                        @endif

                    </div>

                    <div class="card-body">

                        <small>

                            {{ optional($medicine->category)->name }}

                        </small>

                        <h4>

                            {{ $medicine->name }}

                        </h4>

                        <p>

                            {{ $medicine->company }}

                        </p>

                        <div class="rating">

                            ★★★★★

                            <span class="text-muted">

                                (4.8)

                            </span>

                        </div>

                        <div class="price mt-2">

                            Rs.
                            {{ number_format($medicine->price,2) }}

                        </div>

                        <div class="stock {{ $medicine->quantity < 20 ? 'low' : '' }}">

                            {{ $medicine->quantity }}

                            in stock

                        </div>

                        <div class="pharmacy-name mt-2">

                            <i class="fas fa-store"></i>

                            {{ optional($medicine->pharmacy)->name }}

                        </div>

                        <div class="mt-4">

                            <a
                                href="{{ route('orders.create.medicine',$medicine->id) }}"
                                class="btn btn-cart">

                                <i class="fas fa-shopping-cart"></i>

                                Add to Cart

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning text-center p-5">

                    <h3>

                        No medicines found

                    </h3>

                    <p>

                        Try searching with another keyword.

                    </p>

                </div>

            </div>

        @endforelse

    </div>

    <div class="mt-4 d-flex justify-content-center">

        {{ $medicines->appends(request()->query())->links() }}

    </div>

</div>

@endsection
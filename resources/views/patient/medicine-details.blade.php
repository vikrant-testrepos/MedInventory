@extends('layouts.app')

@section('content')

<div class="container py-5">

    <!-- Back Button -->

    <div class="mb-4">

        <a href="{{ route('patient.dashboard') }}"
           class="btn btn-outline-success">

            <i class="fas fa-arrow-left"></i>

            Back to Medicines

        </a>

    </div>

    <!-- Medicine Card -->

    <div class="card shadow border-0 rounded-lg">

        <div class="card-body p-5">

            <div class="row">

                <!-- Image -->

                <div class="col-lg-5 text-center">

                    @if($medicine->image)

                        <img
                            src="{{ asset('uploads/medicines/'.$medicine->image) }}"
                            class="img-fluid rounded"
                            style="max-height:350px;">

                    @else

                        <div class="display-1 text-success">

                            <i class="fas fa-capsules"></i>

                        </div>

                    @endif

                </div>

                <!-- Details -->

                <div class="col-lg-7">

                    <small class="text-success">

                        {{ optional($medicine->category)->name }}

                    </small>

                    <h2 class="font-weight-bold mt-2">

                        {{ $medicine->name }}

                    </h2>

                    <h5 class="text-muted">

                        {{ $medicine->company }}

                    </h5>

                    <div class="my-3">

                        ⭐⭐⭐⭐⭐

                        <span class="text-muted">

                            (4.8)

                        </span>

                    </div>

                    <h3 class="text-success font-weight-bold">

                        Rs. {{ number_format($medicine->price,2) }}

                    </h3>

                    <hr>

                                        <!-- Stock -->

                    <div class="mb-3">

                        @if($medicine->quantity > 0)

                            <span class="badge badge-success px-3 py-2">

                                <i class="fas fa-check-circle"></i>

                                {{ $medicine->quantity }} In Stock

                            </span>

                        @else

                            <span class="badge badge-danger px-3 py-2">

                                Out of Stock

                            </span>

                        @endif

                    </div>

                    <!-- Description -->

                    <h5 class="mt-4">

                        Description

                    </h5>

                    <p class="text-muted">

                        @if(!empty($medicine->description))

                            {{ $medicine->description }}

                        @else

                            No description available for this medicine.

                        @endif

                    </p>

                    <hr>

                    <!-- Pharmacy Information -->

                    <h4 class="mb-3">

                        <i class="fas fa-store text-success"></i>

                        Pharmacy Information

                    </h4>

                    <table class="table table-borderless">

                        <tr>

                            <th width="170">

                                Pharmacy

                            </th>

                            <td>

                                {{ optional($medicine->pharmacy)->name }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Owner

                            </th>

                            <td>

                                {{ optional($medicine->pharmacy)->owner_name }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Phone

                            </th>

                            <td>

                                {{ optional($medicine->pharmacy)->phone }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Email

                            </th>

                            <td>

                                {{ optional($medicine->pharmacy)->email }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                District

                            </th>

                            <td>

                                {{ optional($medicine->pharmacy)->district }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Opening Time

                            </th>

                            <td>

                                {{ optional($medicine->pharmacy)->opening_time }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Closing Time

                            </th>

                            <td>

                                {{ optional($medicine->pharmacy)->closing_time }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Address

                            </th>

                            <td>

                                {{ optional($medicine->pharmacy)->address }}

                            </td>

                        </tr>

                    </table>

                    <hr>

                                        <!-- Location & Actions -->

                    <div class="card bg-light border-0 mb-4">

                        <div class="card-body">

                            <h5>

                                <i class="fas fa-map-marker-alt text-danger"></i>

                                Pharmacy Location

                            </h5>

                            <p class="mb-2">

                                {{ optional($medicine->pharmacy)->address }}

                            </p>

                            <div class="row">

                                <div class="col-md-6">

                                    <strong>Estimated Distance</strong>

                                    <br>

                                    <span class="text-muted">

                                        Calculated on Map

                                    </span>

                                </div>

                                <div class="col-md-6">

                                    <strong>Estimated Time</strong>

                                    <br>

                                    <span class="text-muted">

                                        Calculated on Map

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <a href="{{ route('patient.map', $medicine->id) }}"
                                class="btn btn-primary btn-block">

                                    <i class="fas fa-map-marked-alt"></i>

                                    Open Interactive Map

                            </a>

                        </div>

                        <div class="col-md-6 mb-3">

                            <form action="{{ route('cart.store') }}"
                                  method="POST">

                                @csrf

                                <input
                                    type="hidden"
                                    name="medicine_id"
                                    value="{{ $medicine->id }}">

                                <button
                                    class="btn btn-success btn-block">

                                    <i class="fas fa-shopping-cart"></i>

                                    Add To Cart

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

        <!-- Related Medicines -->

    @if($relatedMedicines->count())

    <div class="mt-5">

        <h3 class="mb-4">

            Related Medicines

        </h3>

        <div class="row">

            @foreach($relatedMedicines as $item)

                <div class="col-lg-3 col-md-6 mb-4">

                    <div class="card shadow-sm h-100">

                        <div class="card-body text-center">

                            @if($item->image)

                                <img
                                    src="{{ asset('storage/'.$item->image) }}"
                                    class="img-fluid mb-3"
                                    style="height:120px;object-fit:contain;">

                            @else

                                <i class="fas fa-capsules fa-4x text-success mb-3"></i>

                            @endif

                            <h6>

                                {{ $item->name }}

                            </h6>

                            <p class="text-success">

                                Rs.
                                {{ number_format($item->price,2) }}

                            </p>

                            <a href="{{ route('patient.medicine.show',$item->id) }}"
                               class="btn btn-outline-success btn-sm btn-block">

                                View Details

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

    @endif

</div>

@endsection
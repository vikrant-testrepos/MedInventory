@extends('layouts.pharmacy')

@section('title','Add Inventory')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Add Inventory</h2>

        <p class="text-muted">

            Add stock for your medicines.

        </p>

    </div>

    <a href="{{ route('pharmacy.inventory.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Back

    </a>

</div>

@if($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('pharmacy.inventory.store') }}"
              method="POST">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Medicine</label>

                    <select name="medicine_id"
                            class="form-control"
                            required>

                        <option value="">Select Medicine</option>

                        @foreach($medicines as $medicine)

                            <option value="{{ $medicine->id }}">

                                {{ $medicine->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Batch Number</label>

                    <input
                        type="text"
                        name="batch_no"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Supplier</label>

                    <input
                        type="text"
                        name="supplier"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Stock Quantity</label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Purchase Price</label>

                    <input
                        type="number"
                        step="0.01"
                        name="purchase_price"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Selling Price</label>

                    <input
                        type="number"
                        step="0.01"
                        name="selling_price"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-4">

                    <label>Expiry Date</label>

                    <input
                        type="date"
                        name="expiry_date"
                        class="form-control"
                        required>

                </div>

            </div>

            <button class="btn btn-success">

                <i class="fas fa-save"></i>

                Save Inventory

            </button>

        </form>

    </div>

</div>

@endsection
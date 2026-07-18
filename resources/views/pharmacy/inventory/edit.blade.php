@extends('layouts.pharmacy')

@section('title','Edit Inventory')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Edit Inventory</h2>

        <p class="text-muted">

            Update inventory information.

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

        <form action="{{ route('pharmacy.inventory.update', $inventory->id) }}"
              method="POST">

            @csrf

            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Medicine</label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $inventory->medicine->name }}"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Batch Number</label>

                    <input
                        type="text"
                        name="batch_no"
                        value="{{ old('batch_no', $inventory->batch_no) }}"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Supplier</label>

                    <input
                        type="text"
                        name="supplier"
                        value="{{ old('supplier', $inventory->supplier) }}"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Stock Quantity</label>

                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock', $inventory->stock) }}"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Purchase Price</label>

                    <input
                        type="number"
                        step="0.01"
                        name="purchase_price"
                        value="{{ old('purchase_price', $inventory->purchase_price) }}"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Selling Price</label>

                    <input
                        type="number"
                        step="0.01"
                        name="selling_price"
                        value="{{ old('selling_price', $inventory->selling_price) }}"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-4">

                    <label>Expiry Date</label>

                    <input
                        type="date"
                        name="expiry_date"
                        value="{{ old('expiry_date', $inventory->expiry_date) }}"
                        class="form-control"
                        required>

                </div>

            </div>

            <button
                type="submit"
                class="btn btn-success">

                <i class="fas fa-save"></i>

                Update Inventory

            </button>

        </form>

    </div>

</div>

@endsection
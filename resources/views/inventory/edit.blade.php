@extends('layouts.admin')

@section('title','Edit Inventory')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">

            ✏ Edit Inventory

        </h2>

        <p class="text-muted mb-0">

            Update inventory details.

        </p>

    </div>

    <a href="{{ route('inventory.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Back

    </a>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <form action="{{ route('inventory.update', $inventory->id) }}" method="POST">

            @csrf

            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Medicine</label>

                    <select
                        name="medicine_id"
                        class="form-control"
                        required>

                        @foreach($medicines as $medicine)

                            <option
                                value="{{ $medicine->id }}"
                                {{ $inventory->medicine_id == $medicine->id ? 'selected' : '' }}>

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
                        value="{{ $inventory->batch_no }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Supplier</label>

                    <input
                        type="text"
                        name="supplier"
                        class="form-control"
                        value="{{ $inventory->supplier }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Stock Quantity</label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        min="0"
                        value="{{ $inventory->stock }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Purchase Price</label>

                    <input
                        type="number"
                        step="0.01"
                        name="purchase_price"
                        class="form-control"
                        value="{{ $inventory->purchase_price }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Selling Price</label>

                    <input
                        type="number"
                        step="0.01"
                        name="selling_price"
                        class="form-control"
                        value="{{ $inventory->selling_price }}"
                        required>

                </div>

                <div class="col-md-6 mb-4">

                    <label>Expiry Date</label>

                    <input
                        type="date"
                        name="expiry_date"
                        class="form-control"
                        value="{{ $inventory->expiry_date }}"
                        required>

                </div>

            </div>

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>

                Update Inventory

            </button>

        </form>

    </div>

</div>

@endsection
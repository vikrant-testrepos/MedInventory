@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Medicine</h2>
    <a href="{{ route('medicines.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Category</label>

                <select name="category_id" class="form-control">

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ $medicine->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label>Medicine Name</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ $medicine->name }}">
            </div>

            <div class="form-group">
                <label>Company</label>

                <input
                    type="text"
                    name="company"
                    class="form-control"
                    value="{{ $medicine->company }}">
            </div>

            <div class="form-group">
                <label>Price</label>

                <input
                    type="number"
                    step="0.01"
                    name="price"
                    class="form-control"
                    value="{{ $medicine->price }}">
            </div>

            <div class="form-group">
                <label>Quantity</label>

                <input
                    type="number"
                    name="quantity"
                    class="form-control"
                    value="{{ $medicine->quantity }}">
            </div>

            <div class="form-group">
                <label>Description</label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="4">{{ $medicine->description }}</textarea>
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Update Medicine
            </button>

        </form>

    </div>
</div>

@endsection
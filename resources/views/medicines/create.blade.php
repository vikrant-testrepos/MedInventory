@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-4">

    <h2>Add Medicine</h2>

    <a href="{{ route('medicines.index') }}" class="btn btn-secondary">
        Back
    </a>

</div>

<div class="card">

    <div class="card-body">

        <form action="{{ route('medicines.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-group">

                <label>Medicine Name</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       required>

            </div>

            <div class="form-group">

                <label>Category</label>

                <select name="category_id"
                        class="form-control"
                        required>

                    <option value="">Select Category</option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">

                <label>Company</label>

                <input type="text"
                       name="company"
                       class="form-control">

            </div>

            <div class="form-group">

                <label>Price</label>

                <input type="number"
                       step="0.01"
                       name="price"
                       class="form-control">

            </div>

            <div class="form-group">

                <label>Quantity</label>

                <input type="number"
                       name="quantity"
                       class="form-control">

            </div>

            <div class="form-group">

                <label>Description</label>

                <textarea
                        name="description"
                        class="form-control"
                        rows="4"></textarea>

            </div>

            <div class="form-group">

                <label>Medicine Image</label>

                <input type="file"
                       name="image"
                       class="form-control">

            </div>

            <button class="btn btn-primary">

                Save Medicine

            </button>

        </form>

    </div>

</div>

@endsection
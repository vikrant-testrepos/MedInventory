@extends('layouts.pharmacy')

@section('title','Add Medicine')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Add Medicine</h2>

        <p class="text-muted">

            Add a new medicine to your pharmacy.

        </p>

    </div>

    <a href="{{ route('pharmacy.medicines.index') }}"
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

<div class="card">

    <div class="card-body">

        <form action="{{ route('pharmacy.medicines.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Category</label>

                    <select name="category_id"
                            class="form-control"
                            required>

                        <option value="">

                            Select Category

                        </option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}">

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Medicine Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Company</label>

                    <input type="text"
                           name="company"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-3 mb-3">

                    <label>Price</label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-3 mb-3">

                    <label>Quantity</label>

                    <input type="number"
                           name="quantity"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-12 mb-3">

                    <label>Description</label>

                    <textarea name="description"
                              rows="4"
                              class="form-control"></textarea>

                </div>

                <div class="col-md-12 mb-4">

                    <label>Medicine Image</label>

                    <input type="file"
                           name="image"
                           class="form-control-file">

                </div>

            </div>

            <button class="btn btn-success">

                <i class="fas fa-save"></i>

                Save Medicine

            </button>

        </form>

    </div>

</div>

@endsection
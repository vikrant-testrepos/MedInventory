@extends('layouts.pharmacy')

@section('title','Edit Medicine')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Edit Medicine</h2>

        <p class="text-muted">

            Update medicine information.

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

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('pharmacy.medicines.update',$medicine->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Category</label>

                    <select name="category_id"
                            class="form-control"
                            required>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ $medicine->category_id == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Medicine Name</label>

                    <input type="text"
                           name="name"
                           value="{{ old('name',$medicine->name) }}"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Company</label>

                    <input type="text"
                           name="company"
                           value="{{ old('company',$medicine->company) }}"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-3 mb-3">

                    <label>Price</label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           value="{{ old('price',$medicine->price) }}"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-3 mb-3">

                    <label>Quantity</label>

                    <input type="number"
                           name="quantity"
                           value="{{ old('quantity',$medicine->quantity) }}"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-12 mb-3">

                    <label>Description</label>

                    <textarea name="description"
                              rows="4"
                              class="form-control">{{ old('description',$medicine->description) }}</textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Current Image</label>

                    <br>

                    @if($medicine->image)

                        <img src="{{ asset('uploads/medicines/'.$medicine->image) }}"
                             width="150"
                             class="img-thumbnail">

                    @else

                        <p class="text-muted">

                            No image uploaded.

                        </p>

                    @endif

                </div>

                <div class="col-md-6 mb-3">

                    <label>Change Image</label>

                    <input type="file"
                           name="image"
                           class="form-control-file">

                    <small class="text-muted">

                        Leave empty to keep the current image.

                    </small>

                </div>

            </div>

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>

                Update Medicine

            </button>

        </form>

    </div>

</div>

@endsection
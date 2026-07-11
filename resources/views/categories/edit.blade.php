@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Edit Category</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card p-4">

<form method="POST"
      action="{{ route('categories.update', $category) }}">

    @csrf
    @method('PUT')

    <div class="form-group">

        <label>Category Name</label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $category->name) }}"
            required>

    </div>

    <button class="btn btn-success">
        Update Category
    </button>

    <a href="{{ route('categories.index') }}"
       class="btn btn-secondary">
       Cancel
    </a>

</form>

</div>

@endsection
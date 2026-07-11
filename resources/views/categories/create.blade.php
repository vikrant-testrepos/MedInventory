@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Add Category</h2>

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

<form method="POST" action="{{ route('categories.store') }}">
    @csrf

    <div class="form-group">
        <label>Category Name</label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name') }}"
            required>
    </div>

    <button class="btn btn-primary">
        Save Category
    </button>

    <a href="{{ route('categories.index') }}"
       class="btn btn-secondary">
       Cancel
    </a>

</form>

</div>

@endsection
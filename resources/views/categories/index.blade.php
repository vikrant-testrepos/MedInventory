@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <h2>Categories</h2>

    <a href="{{ route('categories.create') }}"
       class="btn btn-primary">
       Add Category
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered bg-white">

    <thead>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th width="180">Action</th>
        </tr>

    </thead>

    <tbody>

    @forelse($categories as $category)

        <tr>

            <td>{{ $category->id }}</td>

            <td>{{ $category->name }}</td>

            <td>

                <a href="{{ route('categories.edit',$category) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('categories.destroy',$category) }}"
                      method="POST"
                      style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this category?')">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="3" class="text-center">
                No Categories Found
            </td>

        </tr>

    @endforelse

    </tbody>

</table>

@endsection
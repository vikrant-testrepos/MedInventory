@extends('layouts.pharmacy')

@section('title', 'My Medicines')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">💊 My Medicines</h2>

        <p class="text-muted mb-0">
            Manage your pharmacy medicines.
        </p>

    </div>

    <a href="{{ route('pharmacy.medicines.create') }}" class="btn btn-success">

        <i class="fas fa-plus"></i>

        Add Medicine

    </a>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button type="button" class="close" data-dismiss="alert">

        <span>&times;</span>

    </button>

</div>

@endif

<div class="card shadow">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="thead-light">

                    <tr>

                        <th>Image</th>

                        <th>Name</th>

                        <th>Category</th>

                        <th>Company</th>

                        <th>Price</th>

                        <th>Quantity</th>

                        <th width="170">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($medicines as $medicine)

                <tr>

                    <td>

                        @if($medicine->image)

                            <img src="{{ asset('uploads/medicines/'.$medicine->image) }}"
                                 width="60"
                                 class="rounded">

                        @else

                            <img src="https://via.placeholder.com/60"
                                 class="rounded">

                        @endif

                    </td>

                    <td>

                        <strong>{{ $medicine->name }}</strong>

                    </td>

                    <td>

                        {{ optional($medicine->category)->name }}

                    </td>

                    <td>

                        {{ $medicine->company }}

                    </td>

                    <td>

                        Rs. {{ number_format($medicine->price,2) }}

                    </td>

                    <td>

                        <span class="badge badge-primary">

                            {{ $medicine->quantity }}

                        </span>

                    </td>

                    <td>

                        <a href="{{ route('pharmacy.medicines.edit',$medicine->id) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>

                        <form action="{{ route('pharmacy.medicines.destroy',$medicine->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this medicine?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center text-muted py-5">

                        No medicines found.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $medicines->links() }}

        </div>

    </div>

</div>

@endsection
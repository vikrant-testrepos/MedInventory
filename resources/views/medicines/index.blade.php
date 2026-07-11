@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Medicines</h2>

    <a href="{{ route('medicines.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Medicine
    </a>

</div>

<div class="card">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="thead-dark">

            <tr>

                <th>ID</th>

                <th>Name</th>

                <th>Category</th>

                <th>Company</th>

                <th>Price</th>

                <th>Quantity</th>

                <th width="150">Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($medicines as $medicine)

                <tr>

                    <td>{{ $medicine->id }}</td>

                    <td>{{ $medicine->name }}</td>

                    <td>{{ $medicine->category->name ?? '-' }}</td>

                    <td>{{ $medicine->company }}</td>

                    <td>Rs. {{ $medicine->price }}</td>

                    <td>{{ $medicine->quantity }}</td>

                    <td>

                        <a href="{{ route('medicines.edit',$medicine->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        No medicines found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        {{ $medicines->links() }}

    </div>

</div>

@endsection
@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Medicines</h2>

    <a href="{{ route('medicines.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Medicine
    </a>

</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="thead-dark">

                    <tr>
                        <th width="90">Image</th>
                        <th>Medicine</th>
                        <th>Category</th>
                        <th>Company</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($medicines as $medicine)

                    <tr>

                        <td>

                            @if($medicine->image)

                                <img src="{{ asset('uploads/medicines/'.$medicine->image) }}"
                                     width="60"
                                     height="60"
                                     class="rounded border">

                            @else

                                <div class="text-center text-muted">
                                    <i class="fas fa-pills fa-2x"></i>
                                </div>

                            @endif

                        </td>

                        <td>
                            <strong>{{ $medicine->name }}</strong>
                        </td>

                        <td>
                            {{ $medicine->category->name ?? '-' }}
                        </td>

                        <td>
                            {{ $medicine->company }}
                        </td>

                        <td>
                            Rs. {{ number_format($medicine->price,2) }}
                        </td>

                        <td>
                            {{ $medicine->quantity }}
                        </td>

                        <td>

                            @if($medicine->quantity > 20)

                                <span class="badge badge-success">
                                    In Stock
                                </span>

                            @elseif($medicine->quantity > 0)

                                <span class="badge badge-warning">
                                    Low Stock
                                </span>

                            @else

                                <span class="badge badge-danger">
                                    Out of Stock
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('medicines.edit',$medicine->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form action="{{ route('medicines.destroy', $medicine->id) }}"
                                method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Delete this medicine?');">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center text-muted">

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
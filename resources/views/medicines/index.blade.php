@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">

            Medicines

        </h2>

        <p class="text-muted mb-0">

            Manage all medicines available in the inventory.

        </p>

    </div>

    <a href="{{ route('medicines.create') }}" class="btn btn-primary">

        <i class="fas fa-plus mr-1"></i>

        Add Medicine

    </a>

</div>

@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        {{ session('success') }}

        <button class="close" data-dismiss="alert">

            <span>&times;</span>

        </button>

    </div>

@endif

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="thead-light">

                    <tr>

                        <th width="90">Image</th>

                        <th>Medicine</th>

                        <th>Category</th>

                        <th>Company</th>

                        <th>Price</th>

                        <th>Stock</th>

                        <th>Status</th>

                        <th class="text-center" width="160">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($medicines as $medicine)

                    <tr>

                        <td>

                            @if($medicine->image)

                                <img
                                    src="{{ $medicine->image_url }}"
                                    class="rounded border"
                                    width="60"
                                    height="60"
                                    style="object-fit:cover;">

                            @else

                                <div class="text-center">

                                    <i class="fas fa-pills fa-2x text-secondary"></i>

                                </div>

                            @endif

                        </td>

                        <td>

                            <strong>

                                {{ $medicine->name }}

                            </strong>

                        </td>

                        <td>

                            {{ optional($medicine->category)->name }}

                        </td>

                        <td>

                            {{ $medicine->company }}

                        </td>

                        <td>

                            <strong>

                                रु. {{ number_format($medicine->price,2) }}

                            </strong>

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

                        <td class="text-center">

                            <a
                                href="{{ route('medicines.edit',$medicine->id) }}"
                                class="btn btn-sm btn-warning">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form
                                action="{{ route('medicines.destroy',$medicine->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Delete this medicine?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center py-5 text-muted">

                            <i class="fas fa-box-open fa-3x mb-3"></i>

                            <br>

                            No medicines found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $medicines->links() }}

        </div>

    </div>

</div>

@endsection
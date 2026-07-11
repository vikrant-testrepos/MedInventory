@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Inventory Management</h2>

</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="thead-dark">

                <tr>

                    <th>Medicine</th>

                    <th>Company</th>

                    <th>Current Stock</th>

                    <th>Status</th>

                    <th width="220">Update Stock</th>

                </tr>

                </thead>

                <tbody>

                @forelse($medicines as $medicine)

                    <tr>

                        <td>{{ $medicine->name }}</td>

                        <td>{{ $medicine->company }}</td>

                        <td>{{ $medicine->quantity }}</td>

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

                            <form action="{{ route('inventory.update',$medicine->id) }}"
                                  method="POST"
                                  class="form-inline">

                                @csrf

                                <input
                                    type="number"
                                    name="quantity"
                                    value="{{ $medicine->quantity }}"
                                    class="form-control mr-2"
                                    style="width:90px">

                                <button class="btn btn-primary btn-sm">

                                    Update

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            No medicines available.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{ $medicines->links() }}

    </div>

</div>

@endsection
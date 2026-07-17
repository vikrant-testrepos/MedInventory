@extends('layouts.admin')

@section('title', 'Inventory')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card shadow-sm border-left-primary">

                <div class="card-body">

                    <h6 class="text-muted">

                        Total Medicines

                    </h6>

                    <h2>

                        {{ $totalMedicines }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-left-warning">

                <div class="card-body">

                    <h6 class="text-muted">

                        Low Stock

                    </h6>

                    <h2>

                        {{ $lowStock }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-left-danger">

                <div class="card-body">

                    <h6 class="text-muted">

                        Out Of Stock

                    </h6>

                    <h2>

                        {{ $outOfStock }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm border-left-success">

                <div class="card-body">

                    <h6 class="text-muted">

                        Expiring Soon

                    </h6>

                    <h2>

                        {{ $expiringSoon }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div>
        <h2 class="mb-1">
            📦 Inventory
        </h2>

        <p class="text-muted mb-0">
            Manage medicine stock, batches and expiry dates.
        </p>
    </div>

    <a href="{{ route('inventory.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Stock
    </a>

</div>

<!-- Search Card -->

<div class="card mb-3">

    <div class="card-body">

        <form action="{{ route('inventory.index') }}" method="GET">

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search medicine..."
                    value="{{ request('search') }}">

                <div class="input-group-append">

                    <button class="btn btn-primary">

                        <i class="fas fa-search"></i>

                        Search

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- Inventory Table -->

<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>Medicine</th>
                        <th>Batch</th>
                        <th>Supplier</th>
                        <th>Stock</th>
                        <th>Purchase</th>
                        <th>Selling</th>
                        <th>Expiry</th>
                        <th>Status</th>
                        <th width="170">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($inventories as $inventory)

                    @php
                        $expiry = \Carbon\Carbon::parse($inventory->expiry_date);
                        $today = now();
                    @endphp

                    <tr>

                        <td>
                            <strong>{{ optional($inventory->medicine)->name }}</strong>
                        </td>

                        <td>{{ $inventory->batch_no }}</td>

                        <td>{{ $inventory->supplier }}</td>

                        <td>
                            <strong>{{ $inventory->stock }}</strong>
                        </td>

                        <td>
                            Rs. {{ number_format($inventory->purchase_price, 2) }}
                        </td>

                        <td>
                            Rs. {{ number_format($inventory->selling_price, 2) }}
                        </td>

                        <td>

                            {{ $expiry->format('d M Y') }}

                            <br>

                            @if($expiry->isPast())

                                <span class="badge badge-danger mt-1">
                                    Expired
                                </span>

                            @elseif($today->diffInDays($expiry) <= 30)

                                <span class="badge badge-warning mt-1">
                                    Expiring Soon
                                </span>

                            @else

                                <span class="badge badge-success mt-1">
                                    Valid
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($inventory->stock == 0)

                                <span class="badge badge-danger">
                                    Out of Stock
                                </span>

                            @elseif($inventory->stock <= 20)

                                <span class="badge badge-warning">
                                    Low Stock
                                </span>

                            @else

                                <span class="badge badge-success">
                                    In Stock
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('inventory.edit', $inventory->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form action="{{ route('inventory.destroy', $inventory->id) }}"
                                  method="POST"
                                  style="display:inline-block;"
                                  onsubmit="return confirm('Delete this stock record?');">

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

                        <td colspan="9" class="text-center text-muted py-5">

                            <i class="fas fa-box-open fa-3x mb-3"></i>

                            <br>

                            No inventory records found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $inventories->links() }}

        </div>

    </div>

</div>

@endsection
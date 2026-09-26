@extends('layouts.pharmacy')

@section('title','Inventory')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Inventory</h2>

        <p class="text-muted">

            Manage medicine inventory.

        </p>

    </div>

    <a href="{{ route('pharmacy.inventory.create') }}"
       class="btn btn-success">

        <i class="fas fa-plus"></i>

        Add Inventory

    </a>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card shadow">

    <div class="card-body table-responsive">

        <table class="table table-hover">

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

                    <th width="120">Action</th>

                </tr>

            </thead>

            <tbody>

            @forelse($inventories as $inventory)

                <tr>

                    <td>

                        {{ $inventory->medicine->name }}

                    </td>

                    <td>

                        {{ $inventory->batch_no }}

                    </td>

                    <td>

                        {{ $inventory->supplier ?: '-' }}

                    </td>

                    <td>

                        <span class="badge badge-primary">

                            {{ $inventory->stock }}

                        </span>

                    </td>

                    <td>

                        रु. {{ number_format($inventory->purchase_price,2) }}

                    </td>

                    <td>

                        रु. {{ number_format($inventory->selling_price,2) }}

                    </td>

                    <td>

                        {{ $inventory->expiry_date }}

                    </td>

                    <td>

                        @if(\Carbon\Carbon::parse($inventory->expiry_date)->isPast())

                            <span class="badge badge-danger">

                                Expired

                            </span>

                        @elseif($inventory->stock==0)

                            <span class="badge badge-dark">

                                Out of Stock

                            </span>

                        @elseif($inventory->stock<=10)

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

                        <a href="{{ route('pharmacy.inventory.edit',$inventory->id) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>

                        <form
                            action="{{ route('pharmacy.inventory.destroy',$inventory->id) }}"
                            method="POST"
                            style="display:inline-block">

                            @csrf

                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete inventory?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center">

                        No inventory found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $inventories->links() }}

        </div>

    </div>

</div>

@endsection
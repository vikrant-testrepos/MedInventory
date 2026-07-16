@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>🏥 Pharmacy Management</h2>

    <a href="{{ route('pharmacies.create') }}" class="btn btn-primary">
        + Add Pharmacy
    </a>

</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card shadow">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-striped table-hover">

                <thead class="thead-dark">

                <tr>

                    <th>ID</th>

                    <th>Pharmacy</th>

                    <th>Owner</th>

                    <th>District</th>

                    <th>Phone</th>

                    <th>Status</th>

                    <th width="180">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($pharmacies as $pharmacy)

                <tr>

                    <td>{{ $pharmacy->id }}</td>

                    <td>{{ $pharmacy->name }}</td>

                    <td>{{ $pharmacy->owner_name }}</td>

                    <td>{{ $pharmacy->district }}</td>

                    <td>{{ $pharmacy->phone }}</td>

                    <td>

                        @if($pharmacy->approved)

                            <span class="badge badge-success">
                                Approved
                            </span>

                        @else

                            <span class="badge badge-warning">
                                Pending
                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('pharmacies.edit',$pharmacy->id) }}"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form
                            action="{{ route('pharmacies.destroy',$pharmacy->id) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete Pharmacy?')">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center">

                        No pharmacies found.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{ $pharmacies->links() }}

    </div>

</div>

@endsection
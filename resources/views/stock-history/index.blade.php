@extends('layouts.admin')

@section('title','Stock History')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>📋 Stock History</h2>

        <p class="text-muted mb-0">

            View every inventory movement.

        </p>

    </div>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <form method="GET" class="mb-4">

            <div class="row">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search medicine...">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary">

                        <i class="fas fa-search"></i>

                        Search

                    </button>

                </div>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="thead-dark">

                <tr>

                    <th>Date</th>

                    <th>Medicine</th>

                    <th>Action</th>

                    <th>Qty</th>

                    <th>Before</th>

                    <th>After</th>

                    <th>User</th>

                    <th>Remarks</th>

                </tr>

                </thead>

                <tbody>

                @forelse($histories as $history)

                <tr>

                    <td>

                        {{ $history->created_at->format('d M Y H:i') }}

                    </td>

                    <td>

                        {{ optional($history->medicine)->name }}

                    </td>

                    <td>

                        <span class="badge badge-info">

                            {{ $history->action }}

                        </span>

                    </td>

                    <td>

                        {{ $history->quantity }}

                    </td>

                    <td>

                        {{ $history->stock_before }}

                    </td>

                    <td>

                        {{ $history->stock_after }}

                    </td>

                    <td>

                        {{ optional($history->user)->name ?? 'System' }}

                    </td>

                    <td>

                        {{ $history->remarks }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="text-center py-5">

                        No stock history found.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $histories->links() }}

        </div>

    </div>

</div>

@endsection
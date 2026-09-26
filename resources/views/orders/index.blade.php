@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">
                🛒 Order Management
            </h2>

            <p class="text-muted mb-0">
                Manage customer orders and update delivery status.
            </p>
        </div>

    </div>


    <!-- Success Message -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fas fa-check-circle"></i>

            {{ session('success') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert">

                <span>&times;</span>

            </button>

        </div>

    @endif



    <!-- Orders Table Card -->
    <div class="card shadow-sm border-0">

        <div class="card-body">


            <div class="table-responsive">

                <table class="table table-hover align-middle">


                    <thead class="thead-dark">

                        <tr>

                            <th>#</th>

                            <th>Patient</th>

                            <th>Medicine</th>

                            <th>Pharmacy</th>

                            <th>Qty</th>

                            <th>Total</th>

                            <th>Phone</th>

                            <th>Status</th>

                            <th width="250">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    @forelse($orders as $order)

                        <tr>


                            <!-- Order ID -->
                            <td>

                                <span class="badge badge-primary">

                                    #{{ $order->id }}

                                </span>

                            </td>



                            <!-- Patient -->
                            <td>

                                <strong>

                                    {{ optional($order->user)->name ?? '-' }}

                                </strong>

                            </td>



                            <!-- Medicine -->
                            <td>

                                {{ optional($order->medicine)->name ?? '-' }}

                            </td>



                            <!-- Pharmacy -->
                            <td>

                                {{ optional($order->pharmacy)->name ?? '-' }}

                            </td>



                            <!-- Quantity -->
                            <td>

                                {{ $order->quantity }}

                            </td>



                            <!-- Price -->
                            <td>

                                <strong>

                                    रु. {{ number_format($order->total_price,2) }}

                                </strong>

                            </td>



                            <!-- Phone -->
                            <td>

                                {{ $order->phone }}

                            </td>



                            <!-- Status -->
                            <td>


                                @switch($order->status)


                                    @case('Pending')

                                        <span class="badge badge-warning">

                                            <i class="fas fa-clock"></i>

                                            Pending

                                        </span>

                                    @break



                                    @case('Preparing')

                                        <span class="badge badge-info">

                                            <i class="fas fa-box"></i>

                                            Preparing

                                        </span>

                                    @break



                                    @case('Delivered')

                                        <span class="badge badge-success">

                                            <i class="fas fa-check"></i>

                                            Delivered

                                        </span>

                                    @break



                                    @default

                                        <span class="badge badge-danger">

                                            <i class="fas fa-times"></i>

                                            Cancelled

                                        </span>


                                @endswitch


                            </td>



                            <!-- Update Status -->
                            <td>


                                <form action="{{ route('orders.update',$order->id) }}"
                                      method="POST"
                                      class="d-flex">


                                    @csrf

                                    @method('PATCH')



                                    <select name="status"
                                            class="form-control form-control-sm mr-2">


                                        <option value="Pending"
                                            {{ $order->status == 'Pending' ? 'selected':'' }}>

                                            Pending

                                        </option>


                                        <option value="Preparing"
                                            {{ $order->status == 'Preparing' ? 'selected':'' }}>

                                            Preparing

                                        </option>


                                        <option value="Delivered"
                                            {{ $order->status == 'Delivered' ? 'selected':'' }}>

                                            Delivered

                                        </option>


                                        <option value="Cancelled"
                                            {{ $order->status == 'Cancelled' ? 'selected':'' }}>

                                            Cancelled

                                        </option>


                                    </select>



                                    <button type="submit"
                                            class="btn btn-success btn-sm">

                                        <i class="fas fa-save"></i>

                                    </button>


                                </form>


                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td colspan="9"
                                class="text-center py-5 text-muted">


                                <i class="fas fa-shopping-cart fa-3x mb-3"></i>

                                <br>

                                No orders found.


                            </td>

                        </tr>


                    @endforelse


                    </tbody>


                </table>


            </div>


            <!-- Pagination -->
            <div class="mt-3">

                {{ $orders->links() }}

            </div>


        </div>

    </div>


</div>


@endsection
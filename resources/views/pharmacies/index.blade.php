@extends('layouts.admin')

@section('content')


<div class="d-flex justify-content-between align-items-center mb-4">


    <div>

        <h2 class="mb-1">

            🏥 Pharmacy Management

        </h2>


        <p class="text-muted mb-0">

            Manage registered pharmacies and their approval status.

        </p>


    </div>



    <a href="{{ route('pharmacies.create') }}"
       class="btn btn-primary">


        <i class="fas fa-plus mr-1"></i>

        Add Pharmacy


    </a>


</div>




@if(session('success'))


<div class="alert alert-success alert-dismissible fade show">


    {{ session('success') }}


    <button type="button"
            class="close"
            data-dismiss="alert">

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


                    <th>ID</th>

                    <th>Pharmacy</th>

                    <th>Owner</th>

                    <th>District</th>

                    <th>Phone</th>

                    <th>Status</th>

                    <th width="200" class="text-center">

                        Action

                    </th>


                </tr>


                </thead>




                <tbody>


                @forelse($pharmacies as $pharmacy)


                <tr>


                    <td>

                        <span class="badge badge-primary">

                            #{{ $pharmacy->id }}

                        </span>

                    </td>




                    <td>

                        <strong>

                            {{ $pharmacy->name }}

                        </strong>

                    </td>




                    <td>

                        {{ $pharmacy->owner_name ?? '-' }}

                    </td>




                    <td>

                        {{ $pharmacy->district ?? '-' }}

                    </td>




                    <td>

                        {{ $pharmacy->phone ?? '-' }}

                    </td>




                    <td>


                        @if($pharmacy->approved)


                            <span class="badge badge-success">

                                <i class="fas fa-check"></i>

                                Approved

                            </span>


                        @else


                            <span class="badge badge-warning">

                                <i class="fas fa-clock"></i>

                                Pending

                            </span>


                        @endif



                    </td>




                    <td class="text-center">


                        <a href="{{ route('pharmacies.edit',$pharmacy->id) }}"
                           class="btn btn-warning btn-sm">


                            <i class="fas fa-edit"></i>

                            Edit


                        </a>





                        <form
                            action="{{ route('pharmacies.destroy',$pharmacy->id) }}"
                            method="POST"
                            class="d-inline">


                            @csrf

                            @method('DELETE')



                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete Pharmacy?')">


                                <i class="fas fa-trash"></i>

                                Delete


                            </button>



                        </form>


                    </td>


                </tr>


                @empty



                <tr>


                    <td colspan="7"
                        class="text-center py-5 text-muted">


                        <i class="fas fa-hospital fa-3x mb-3"></i>


                        <br>


                        No pharmacies found.



                    </td>


                </tr>



                @endforelse



                </tbody>



            </table>



        </div>




        <div class="mt-3">

            {{ $pharmacies->links() }}

        </div>



    </div>


</div>



@endsection
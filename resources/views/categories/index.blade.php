@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">
            Categories
        </h2>

        <p class="text-muted mb-0">
            Manage medicine categories.
        </p>

    </div>


    <a href="{{ route('categories.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus mr-1"></i>

        Add Category

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

            <table class="table table-hover">


                <thead class="thead-light">

                    <tr>

                        <th width="100">
                            ID
                        </th>

                        <th>
                            Category Name
                        </th>

                        <th width="200"
                            class="text-center">

                            Action

                        </th>

                    </tr>

                </thead>



                <tbody>


                @forelse($categories as $category)


                    <tr>


                        <td>

                            <span class="badge badge-primary">

                                #{{ $category->id }}

                            </span>

                        </td>



                        <td>

                            <strong>

                                {{ $category->name }}

                            </strong>

                        </td>



                        <td class="text-center">


                            <a href="{{ route('categories.edit',$category) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                                Edit

                            </a>



                            <form
                                action="{{ route('categories.destroy',$category) }}"
                                method="POST"
                                class="d-inline">


                                @csrf

                                @method('DELETE')


                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this category?')">


                                    <i class="fas fa-trash"></i>

                                    Delete


                                </button>


                            </form>


                        </td>


                    </tr>



                @empty


                    <tr>


                        <td colspan="3"
                            class="text-center py-5 text-muted">


                            <i class="fas fa-folder-open fa-3x mb-3"></i>

                            <br>

                            No Categories Found


                        </td>


                    </tr>


                @endforelse



                </tbody>


            </table>


        </div>


    </div>

</div>


@endsection
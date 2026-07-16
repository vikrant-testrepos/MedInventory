@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Edit Pharmacy</h2>

<form action="{{ route('pharmacies.update',$pharmacy->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="card">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Pharmacy Name</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ $pharmacy->name }}"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Owner Name</label>

                    <input
                        type="text"
                        name="owner_name"
                        value="{{ $pharmacy->owner_name }}"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Phone</label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ $pharmacy->phone }}"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>District</label>

                    <input
                        type="text"
                        name="district"
                        value="{{ $pharmacy->district }}"
                        class="form-control">

                </div>

                <div class="col-md-12 mb-3">

                    <label>Address</label>

                    <textarea
                        name="address"
                        class="form-control"
                        rows="3">{{ $pharmacy->address }}</textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Opening Time</label>

                    <input
                        type="time"
                        name="opening_time"
                        value="{{ $pharmacy->opening_time }}"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Closing Time</label>

                    <input
                        type="time"
                        name="closing_time"
                        value="{{ $pharmacy->closing_time }}"
                        class="form-control">

                </div>

            </div>

            <button class="btn btn-success">

                Update Pharmacy

            </button>

        </div>

    </div>

</form>

@endsection
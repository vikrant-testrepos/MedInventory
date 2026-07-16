@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Add New Pharmacy</h2>

    <a href="{{ route('pharmacies.index') }}" class="btn btn-secondary">
        ← Back
    </a>

</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('pharmacies.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Pharmacy Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Owner Name</label>
                    <input
                        type="text"
                        name="owner_name"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>License Number</label>
                    <input
                        type="text"
                        name="license_number"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>District</label>
                    <input
                        type="text"
                        name="district"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Opening Time</label>
                    <input
                        type="time"
                        name="opening_time"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Closing Time</label>
                    <input
                        type="time"
                        name="closing_time"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Latitude</label>
                    <input
                        type="text"
                        name="latitude"
                        class="form-control"
                        placeholder="27.7172">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Longitude</label>
                    <input
                        type="text"
                        name="longitude"
                        class="form-control"
                        placeholder="85.3240">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea
                        name="address"
                        rows="3"
                        class="form-control"
                        required></textarea>
                </div>

            </div>

            <button class="btn btn-success">
                Save Pharmacy
            </button>

        </form>

    </div>

</div>

@endsection
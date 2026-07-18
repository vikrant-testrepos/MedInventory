@extends('layouts.pharmacy')

@section('title','My Pharmacy')

@section('content')

<div class="container-fluid">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="row">

        <!-- ACCOUNT INFORMATION -->

        <div class="col-lg-5">

            <div class="card shadow mb-4">

                <div class="card-header bg-primary text-white">

                    <h5 class="mb-0">

                        <i class="fas fa-user-circle"></i>

                        Account Information

                    </h5>

                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('pharmacy.profile.account') }}">

                        @csrf

                        <div class="form-group">

                            <label>

                                <i class="fas fa-user"></i>

                                Username

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name',$user->name) }}"
                                required>

                        </div>

                        <div class="form-group">

                            <label>

                                <i class="fas fa-envelope"></i>

                                Email Address

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email',$user->email) }}"
                                required>

                        </div>

                        <hr>

                        <h6 class="text-muted">

                            Change Password

                        </h6>

                        <div class="form-group">

                            <label>

                                New Password

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control">

                        </div>

                        <div class="form-group">

                            <label>

                                Confirm Password

                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control">

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary btn-block">

                            <i class="fas fa-save"></i>

                            Save Account

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- PHARMACY INFORMATION -->

        <div class="col-lg-7">

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        <i class="fas fa-clinic-medical"></i>

                        Pharmacy Information

                    </h5>

                </div>

                <div class="card-body">

                    <form
                        method="POST"
                        action="{{ route('pharmacy.profile.details') }}"
                        enctype="multipart/form-data">

                        @csrf

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    <i class="fas fa-clinic-medical"></i>
                                    Pharmacy Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name',$pharmacy->name) }}"
                                    required>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    <i class="fas fa-user"></i>
                                    Owner Name
                                </label>

                                <input
                                    type="text"
                                    name="owner_name"
                                    class="form-control"
                                    value="{{ old('owner_name',$pharmacy->owner_name) }}"
                                    required>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>
                            <i class="fas fa-id-card"></i>
                            License Number
                        </label>

                        <input
                            type="text"
                            name="license_number"
                            class="form-control"
                            value="{{ old('license_number',$pharmacy->license_number) }}"
                            required>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    <i class="fas fa-phone"></i>
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone',$pharmacy->phone) }}"
                                    required>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    <i class="fas fa-envelope"></i>
                                    Pharmacy Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email',$pharmacy->email) }}"
                                    required>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>
                            <i class="fas fa-map"></i>
                            District
                        </label>

                        <input
                            type="text"
                            name="district"
                            class="form-control"
                            value="{{ old('district',$pharmacy->district) }}">

                    </div>

                    <div class="form-group">

                        <label>
                            <i class="fas fa-map-marker-alt"></i>
                            Address
                        </label>

                        <textarea
                            name="address"
                            rows="3"
                            class="form-control">{{ old('address',$pharmacy->address) }}</textarea>

                    </div>

                    <hr>

                    <h5 class="mb-3 text-success">

                        <i class="fas fa-map-marked-alt"></i>

                        Pharmacy Location

                    </h5>

                    <p class="text-muted">

                    Click anywhere on the map or drag the marker.

                    </p>

                    <div
                        id="map"
                        style="height:400px;
                            border-radius:10px;
                            border:1px solid #ddd;
                            margin-bottom:20px;">
                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Latitude</label>

                                <input
                                    type="text"
                                    id="latitude"
                                    name="latitude"
                                    class="form-control"
                                    value="{{ old('latitude',$pharmacy->latitude) }}"
                                    readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Longitude</label>

                                <input
                                    type="text"
                                    id="longitude"
                                    name="longitude"
                                    class="form-control"
                                    value="{{ old('longitude',$pharmacy->longitude) }}"
                                    readonly>

                            </div>

                        </div>

                    </div>

                    <button
                        type="button"
                        id="currentLocation"
                        class="btn btn-primary mb-4">

                        <i class="fas fa-crosshairs"></i>

                        Use Current Location

                    </button>

                    <hr>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Opening Time</label>

                                <input
                                    type="time"
                                    name="opening_time"
                                    class="form-control"
                                    value="{{ $pharmacy->opening_time }}">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Closing Time</label>

                                <input
                                    type="time"
                                    name="closing_time"
                                    class="form-control"
                                    value="{{ $pharmacy->closing_time }}">

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

    <label>

        <i class="fas fa-image"></i>

        Pharmacy Logo

    </label>

    <input
        type="file"
        name="logo"
        class="form-control-file">

</div>

@if($pharmacy->logo)

    <div class="mb-3">

        <label>Current Logo</label>

        <br>

        <img
            src="{{ asset('storage/'.$pharmacy->logo) }}"
            width="150"
            class="img-thumbnail shadow-sm">

    </div>

@endif

<button
    type="submit"
    class="btn btn-success btn-lg btn-block">

    <i class="fas fa-save"></i>

    Save Pharmacy Details

</button>

</form>

</div>

</div>

</div>

</div>

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    var lat = parseFloat(document.getElementById('latitude').value) || 27.7172;
    var lng = parseFloat(document.getElementById('longitude').value) || 85.3240;

    var map = L.map('map').setView([lat, lng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

        attribution: '&copy; OpenStreetMap contributors'

    }).addTo(map);

    var marker = L.marker([lat, lng], {

        draggable: true

    }).addTo(map);

    function updateLocation(position) {

        marker.setLatLng(position);

        document.getElementById('latitude').value = position.lat.toFixed(6);

        document.getElementById('longitude').value = position.lng.toFixed(6);

    }

    map.on('click', function(e){

        updateLocation(e.latlng);

    });

    marker.on('dragend', function(){

        updateLocation(marker.getLatLng());

    });

    document.getElementById('currentLocation').addEventListener('click', function(){

        if(navigator.geolocation){

            navigator.geolocation.getCurrentPosition(function(position){

                var current = {

                    lat: position.coords.latitude,

                    lng: position.coords.longitude

                };

                updateLocation(current);

                map.setView([current.lat, current.lng], 16);

            }, function(){

                alert('Unable to get your current location.');

            });

        }else{

            alert('Your browser does not support Geolocation.');

        }

    });

});

</script>

@endpush

@endsection
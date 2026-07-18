@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>
        <i class="fas fa-hospital"></i>
        Add New Pharmacy
    </h2>

    <a href="{{ route('pharmacies.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
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

                <div class="col-md-3 mb-3">

                    <label>Opening Time</label>

                    <input
                        type="time"
                        name="opening_time"
                        class="form-control">

                </div>

                <div class="col-md-3 mb-3">

                    <label>Closing Time</label>

                    <input
                        type="time"
                        name="closing_time"
                        class="form-control">

                </div>

                <div class="col-md-12 mb-3">

                    <label>Address</label>

                    <textarea
                        name="address"
                        rows="3"
                        class="form-control"
                        required></textarea>

                </div>

                <!-- SEARCH BOX -->

                <div class="col-md-12 mb-3">

                    <label>

                        <strong>

                            Search Pharmacy Location

                        </strong>

                    </label>

                    <div class="input-group">

                        <input
                            type="text"
                            id="addressSearch"
                            class="form-control"
                            placeholder="Example: Bharatpur, Chitwan">

                        <div class="input-group-append">

                            <button
                                type="button"
                                id="searchLocation"
                                class="btn btn-primary">

                                <i class="fas fa-search"></i>

                                Find Address

                            </button>

                        </div>

                    </div>

                </div>

                <!-- MAP -->

                <div class="col-md-12 mb-3">

                    <label>

                        <strong>

                            📍 Select Pharmacy Location

                        </strong>

                    </label>

                    <div
                        id="map"
                        style="height:450px;border-radius:10px;border:1px solid #ddd;">

                    </div>

                    <small class="text-muted">

                        Search the address, click on the map or drag the marker.

                    </small>

                </div>

                <!-- Coordinates -->

                <div class="col-md-6">

                    <label>Latitude</label>

                    <input
                        type="text"
                        id="latitude_display"
                        class="form-control"
                        readonly>

                </div>

                <div class="col-md-6">

                    <label>Longitude</label>

                    <input
                        type="text"
                        id="longitude_display"
                        class="form-control"
                        readonly>

                </div>

                <!-- Hidden -->

                <input
                    type="hidden"
                    id="latitude"
                    name="latitude">

                <input
                    type="hidden"
                    id="longitude"
                    name="longitude">

            </div>

            <hr>

            <button class="btn btn-success btn-lg">

                <i class="fas fa-save"></i>

                Save Pharmacy

            </button>

        </form>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    let defaultLat = 27.7172;
    let defaultLng = 85.3240;

    let map = L.map('map').setView([defaultLat, defaultLng], 13);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution:'© OpenStreetMap Contributors'
        }
    ).addTo(map);

    let marker = L.marker(
        [defaultLat, defaultLng],
        {
            draggable:true
        }
    ).addTo(map);

    updateCoordinates(defaultLat,defaultLng);

    function updateCoordinates(lat,lng){

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        document.getElementById('latitude_display').value = lat;
        document.getElementById('longitude_display').value = lng;

    }

    marker.on('dragend',function(){

        let p = marker.getLatLng();

        updateCoordinates(p.lat,p.lng);

    });

    map.on('click',function(e){

        marker.setLatLng(e.latlng);

        updateCoordinates(e.latlng.lat,e.latlng.lng);

    });

    document.getElementById('searchLocation').addEventListener('click',function(){

        let address=document.getElementById('addressSearch').value;

        if(address=="")
        {
            alert("Please enter an address.");
            return;
        }

        fetch("https://nominatim.openstreetmap.org/search?format=json&q="+encodeURIComponent(address))

        .then(res=>res.json())

        .then(data=>{

            if(data.length==0){

                alert("Address not found.");

                return;

            }

            let lat=parseFloat(data[0].lat);
            let lng=parseFloat(data[0].lon);

            map.setView([lat,lng],16);

            marker.setLatLng([lat,lng]);

            updateCoordinates(lat,lng);

        });

    });

});

</script>

@endsection
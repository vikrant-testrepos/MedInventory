@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row">

        <!-- Medicine Details -->

        <div class="col-lg-5">

            <div class="card shadow-lg border-0 rounded-lg">

                <div class="card-body">

                    <a href="{{ route('patient.dashboard') }}"
                       class="btn btn-outline-secondary mb-4">

                        <i class="fas fa-arrow-left"></i>

                        Back

                    </a>

                    <div class="text-center mb-4">

                        @if($medicine->image)

                            <img src="{{ $medicine->image_url }}"
                                 class="img-fluid rounded"
                                 style="max-height:250px;">

                        @else

                            <img src="{{ asset('images/default-medicine.png') }}"
                                 class="img-fluid"
                                 style="max-height:220px;">

                        @endif

                    </div>

                    <h2 class="font-weight-bold">

                        {{ $medicine->name }}

                    </h2>

                    <div class="mb-3">

                        <span class="text-warning">

                            ★★★★★

                        </span>

                        <span class="text-muted">

                            (4.8)

                        </span>

                    </div>

                    <h3 class="text-success mb-3">

                        रु. {{ number_format($medicine->price,2) }}

                    </h3>

                    <div class="mb-3">

                        @if($medicine->quantity > 20)

                            <span class="badge badge-success p-2">

                                In Stock ({{ $medicine->quantity }})

                            </span>

                        @elseif($medicine->quantity > 0)

                            <span class="badge badge-warning p-2">

                                Low Stock ({{ $medicine->quantity }})

                            </span>

                        @else

                            <span class="badge badge-danger p-2">

                                Out of Stock

                            </span>

                        @endif

                    </div>

                    <table class="table table-borderless">

                        <tr>

                            <th width="35%">

                                Category

                            </th>

                            <td>

                                {{ optional($medicine->category)->name }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Company

                            </th>

                            <td>

                                {{ $medicine->company }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Pharmacy

                            </th>

                            <td>

                                {{ optional($medicine->pharmacy)->name }}

                            </td>

                        </tr>

                    </table>

                    <hr>

                    <h5>

                        Description

                    </h5>

                    <p class="text-muted">

                        {{ $medicine->description ?? 'No description available.' }}

                    </p>

                    <form action="{{ route('cart.store') }}"
                          method="POST">

                        @csrf

                        <input
                            type="hidden"
                            name="medicine_id"
                            value="{{ $medicine->id }}">

                        <button
                            class="btn btn-success btn-lg btn-block">

                            <i class="fas fa-shopping-cart"></i>

                            Add to Cart

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- Right Side Starts -->

        <div class="col-lg-7">

                    <!-- Pharmacy Information -->

            <div class="card shadow-lg border-0 rounded-lg mb-4">

                <div class="card-header bg-success text-white">

                    <h4 class="mb-0">

                        <i class="fas fa-store"></i>

                        Pharmacy Information

                    </h4>

                </div>

                <div class="card-body">

                    <div class="text-center mb-4">

                        <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center"
                             style="width:90px;height:90px;font-size:35px;">

                            <i class="fas fa-clinic-medical"></i>

                        </div>

                    </div>

                    <h3 class="text-center">

                        {{ $medicine->pharmacy->name }}

                    </h3>

                    <p class="text-center text-muted">

                        Licensed Pharmacy

                    </p>

                    <hr>

                    <table class="table table-borderless">

                        <tr>

                            <th width="35%">

                                Owner

                            </th>

                            <td>

                                {{ $medicine->pharmacy->owner_name }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Phone

                            </th>

                            <td>

                                {{ $medicine->pharmacy->phone }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Email

                            </th>

                            <td>

                                {{ $medicine->pharmacy->email }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                District

                            </th>

                            <td>

                                {{ $medicine->pharmacy->district }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Address

                            </th>

                            <td>

                                {{ $medicine->pharmacy->address }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Opening

                            </th>

                            <td>

                                {{ $medicine->pharmacy->opening_time }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Closing

                            </th>

                            <td>

                                {{ $medicine->pharmacy->closing_time }}

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

                        <!-- Navigation -->

            <div class="card shadow-lg border-0 rounded-lg">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">

                        <i class="fas fa-map-marked-alt"></i>

                        Navigation

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row text-center mb-4">

                        <div class="col-md-6">

                            <small class="text-muted">

                                Estimated Distance

                            </small>

                            <h3 id="distance">

                                Calculating...

                            </h3>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted">

                                Estimated Time

                            </small>

                            <h3 id="time">

                                Calculating...

                            </h3>

                        </div>

                    </div>

                    <div id="map"
                         style="height:450px;
                                width:100%;
                                border-radius:15px;">

                    </div>

                    <div class="row mt-4">

                        <div class="col-md-6">

                            <button
                                class="btn btn-success btn-block"
                                onclick="locateUser()">

                                <i class="fas fa-location-arrow"></i>

                                Locate Me

                            </button>

                        </div>

                        <div class="col-md-6">

                            <button
                                class="btn btn-primary btn-block"
                                onclick="centerMap()">

                                <i class="fas fa-route"></i>

                                Center Route

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('styles')

<link rel="stylesheet"
      href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<link rel="stylesheet"
      href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css"/>

<style>

    body{
        background:#f5f7fb;
    }

    .card{
        border:none;
        border-radius:18px;
        overflow:hidden;
    }

    .card-header{
        font-size:20px;
        font-weight:600;
    }

    .table th{
        color:#555;
        width:35%;
    }

    .table td{
        color:#222;
    }

    #map{
        height:450px;
        width:100%;
        border-radius:18px;
        overflow:hidden;
        border:3px solid #fff;
        box-shadow:0 8px 25px rgba(0,0,0,.15);
    }

    .leaflet-container{
        border-radius:18px;
    }

    .leaflet-routing-container{
        display:none !important;
    }

    .btn{
        border-radius:12px;
        font-weight:600;
    }

    .btn-success{
        background:#16a34a;
        border:none;
    }

    .btn-success:hover{
        background:#15803d;
    }

    .btn-primary{
        background:#2563eb;
        border:none;
    }

    .btn-primary:hover{
        background:#1d4ed8;
    }

    .badge{
        font-size:14px;
        padding:8px 15px;
        border-radius:20px;
    }

    h2,h3,h4{
        font-weight:700;
    }

    .text-success{
        color:#16a34a!important;
    }

    .shadow-lg{
        box-shadow:0 15px 40px rgba(0,0,0,.08)!important;
    }

    img{
        border-radius:15px;
    }

</style>

@endpush


@push('scripts')

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>

let pharmacyLat = {{ $medicine->pharmacy->latitude }};
let pharmacyLng = {{ $medicine->pharmacy->longitude }};

let map = L.map('map').setView([pharmacyLat, pharmacyLng], 13);

L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
        attribution:'© OpenStreetMap',
        maxZoom:19
    }
).addTo(map);

let routingControl = null;

let userLat = null;
let userLng = null;

function locateUser(){

    if(!navigator.geolocation){

        alert("Geolocation is not supported.");

        return;

    }

    navigator.geolocation.getCurrentPosition(function(position){

        userLat = position.coords.latitude;
        userLng = position.coords.longitude;

        calculateDistance(userLat,userLng);

        if(routingControl){

            map.removeControl(routingControl);

        }

        routingControl = L.Routing.control({

            waypoints:[
                L.latLng(userLat,userLng),
                L.latLng(pharmacyLat,pharmacyLng)
            ],

            routeWhileDragging:false,

            addWaypoints:false,

            draggableWaypoints:false,

            fitSelectedRoutes:true,

            show:false,

            lineOptions:{
                styles:[
                    {
                        color:"#ffffff",
                        opacity:0.9,
                        weight:10
                    },
                    {
                        color:"#2A7FFF",
                        opacity:1,
                        weight:6
                    }
                ]
            },

            createMarker:function(i,wp){

                if(i===0){

                    return L.circleMarker(wp.latLng,{
                        radius:10,
                        color:"#fff",
                        weight:4,
                        fillColor:"#2196F3",
                        fillOpacity:1
                    }).bindPopup("📍 You");

                }

                return L.marker(wp.latLng,{
                    icon:L.icon({
                        iconUrl:"https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png",
                        shadowUrl:"https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",
                        iconSize:[30,48],
                        iconAnchor:[15,48]
                    })
                }).bindPopup("🏥 {{ $medicine->pharmacy->name }}");

            }

        }).addTo(map);

    });

}

function centerMap(){

    if(routingControl){

        map.fitBounds(routingControl.getWaypoints().map(function(w){

            return w.latLng;

        }));

    }else{

        locateUser();

    }

}

function calculateDistance(lat1,lng1){

    let R=6371;

    let dLat=(pharmacyLat-lat1)*Math.PI/180;
    let dLng=(pharmacyLng-lng1)*Math.PI/180;

    let a=
        Math.sin(dLat/2)*Math.sin(dLat/2)+
        Math.cos(lat1*Math.PI/180)*
        Math.cos(pharmacyLat*Math.PI/180)*
        Math.sin(dLng/2)*
        Math.sin(dLng/2);

    let c=2*Math.atan2(Math.sqrt(a),Math.sqrt(1-a));

    let distance=R*c;

    document.getElementById("distance").innerHTML=
        distance.toFixed(2)+" km";

    document.getElementById("time").innerHTML=
        Math.round(distance/30*60)+" mins";

}

locateUser();

</script>

@endpush
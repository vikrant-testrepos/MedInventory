@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="row">

        <div class="col-lg-3">

            <div class="card shadow border-0 rounded-lg">

                <div class="card-body">

                    <h4 class="font-weight-bold mb-4">

                        🧭 Navigation

                    </h4>

                    <div class="mb-4">

                        <small class="text-muted">

                            Current Location

                        </small>

                        <h6 class="mt-2">

                            📍 You

                        </h6>

                    </div>

                    <div class="text-center my-3">

                        <i class="fas fa-arrow-down text-primary fa-lg"></i>

                    </div>

                    <div class="mb-4">

                        <small class="text-muted">

                            Destination

                        </small>

                        <h5 class="mt-2">

                            🏥 {{ $medicine->pharmacy->name }}

                        </h5>

                    </div>

                    <hr>

                    <div class="mb-3">

                        <small class="text-muted">

                            Estimated Distance

                        </small>

                        <h3 id="distance">

                            Calculating...

                        </h3>

                    </div>

                    <div class="mb-4">

                        <small class="text-muted">

                            Estimated Time

                        </small>

                        <h4 id="time">

                            Calculating...

                        </h4>

                    </div>

                    <button
                        onclick="locateUser()"
                        class="btn btn-success btn-block">

                        <i class="fas fa-location-arrow"></i>

                        Refresh My Location

                    </button>

                    <button
                        onclick="centerMap()"
                        class="btn btn-primary btn-block mt-2">

                        <i class="fas fa-route"></i>

                        Center Route

                    </button>

                    <a
                        href="{{ route('patient.medicine.show',$medicine->id) }}"
                        class="btn btn-outline-secondary btn-block mt-3">

                        ← Back

                    </a>

                </div>

            </div>

        </div>

        <div class="col-lg-9">

            <div class="card shadow">

                <div class="card-body p-0">

                    <div id="map"
                         style="height:700px;width:100%;">

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

    .leaflet-routing-container{
        display:none !important;
    }

    .leaflet-control-container .leaflet-routing-container{
        display:none !important;
    }

    #map{
        border-radius:18px;
        overflow:hidden;
    }

    .leaflet-container{
        border-radius:18px;
    }

    .card{
        border-radius:18px;
    }

    .leaflet-popup-content{
        font-size:15px;
        font-weight:600;
    }

</style>

@endpush


@push('scripts')

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>

console.log("Map script loaded");

let pharmacyLat = {{ $medicine->pharmacy->latitude }};
let pharmacyLng = {{ $medicine->pharmacy->longitude }};

let map = L.map('map').setView([pharmacyLat, pharmacyLng], 13);

L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }
).addTo(map);

let pharmacyMarker = L.marker([pharmacyLat, pharmacyLng])
    .addTo(map)
    .bindPopup("{{ $medicine->pharmacy->name }}");

let userMarker = null;
let routingControl = null;

function locateUser() {

    if (!navigator.geolocation) {
        alert("Geolocation is not supported.");
        return;
    }

    navigator.geolocation.getCurrentPosition(function(position){

        let lat = position.coords.latitude;
        let lng = position.coords.longitude;

        if(userMarker){
            map.removeLayer(userMarker);
        }

        userMarker = L.marker([lat, lng])
            .addTo(map)
            .bindPopup("📍 You are here");

        calculateDistance(lat, lng);

        if(routingControl){
            map.removeControl(routingControl);
        }

        routingControl = L.Routing.control({

            waypoints: [
                L.latLng(lat, lng),
                L.latLng(pharmacyLat, pharmacyLng)
            ],

            routeWhileDragging: false,

            draggableWaypoints: false,

            addWaypoints: false,

            fitSelectedRoutes: true,

            show: false,

            lineOptions: {
                styles: [
                    {
                        color: "#ffffff",
                        opacity: 0.9,
                        weight: 10
                    },
                    {
                        color: "#2A7FFF",
                        opacity: 1,
                        weight: 6
                    }
                ]
            },

            createMarker: function(i, wp) {

                if(i === 0){

                    return L.circleMarker(wp.latLng,{
                        radius:10,
                        color:"#ffffff",
                        weight:4,
                        fillColor:"#1E88E5",
                        fillOpacity:1
                    }).bindPopup("📍 Your Location");

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

function centerMap() {

    if (userMarker) {

        let group = L.featureGroup([
            userMarker,
            pharmacyMarker
        ]);

        map.fitBounds(group.getBounds(), {
            padding: [80, 80]
        });

    } else {

        locateUser();

    }

}

function calculateDistance(lat1, lng1) {

    let R = 6371;

    let dLat = (pharmacyLat - lat1) * Math.PI / 180;
    let dLng = (pharmacyLng - lng1) * Math.PI / 180;

    let a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) *
        Math.cos(pharmacyLat * Math.PI / 180) *
        Math.sin(dLng / 2) *
        Math.sin(dLng / 2);

    let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    let distance = R * c;

    document.getElementById("distance").innerHTML =
        distance.toFixed(2) + " km";

    document.getElementById("time").innerHTML =
        Math.round(distance / 30 * 60) + " mins";

}

locateUser();

</script>

@endpush
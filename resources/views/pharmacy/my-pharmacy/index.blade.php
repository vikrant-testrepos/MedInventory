@extends('layouts.pharmacy')

@section('title','My Pharmacy')

@section('content')

<div class="container-fluid">

    {{-- Pharmacy Header --}}
    <div class="card shadow border-0 mb-4">

        <div class="card-body p-0">

            <div class="text-white p-5"
                 style="background:linear-gradient(135deg,#16a085,#27ae60);">

                <div class="row align-items-center">

                    <div class="col-md-2 text-center">

                        @if($pharmacy->logo)

                            <img src="{{ asset('storage/'.$pharmacy->logo) }}"
                                 class="rounded-circle shadow"
                                 width="120"
                                 height="120"
                                 style="object-fit:cover;border:5px solid rgba(255,255,255,.3);">

                        @else

                            <i class="fas fa-clinic-medical"
                               style="font-size:90px;"></i>

                        @endif

                    </div>

                    <div class="col-md-10">

                        <h2 class="font-weight-bold mb-2">

                            {{ $pharmacy->name }}

                        </h2>

                        <h5 class="mb-3">

                            Owner :
                            {{ $pharmacy->owner_name }}

                        </h5>

                        @if($pharmacy->approved)

                            <span class="badge badge-light text-success p-2">

                                <i class="fas fa-check-circle"></i>

                                Approved Pharmacy

                            </span>

                        @else

                            <span class="badge badge-warning p-2">

                                Pending Approval

                            </span>

                        @endif

                        <hr style="background:rgba(255,255,255,.3);">

                        <div class="row">

                            <div class="col-md-4">

                                <i class="fas fa-phone"></i>

                                {{ $pharmacy->phone }}

                            </div>

                            <div class="col-md-4">

                                <i class="fas fa-envelope"></i>

                                {{ $pharmacy->email }}

                            </div>

                            <div class="col-md-4">

                                <i class="fas fa-id-card"></i>

                                {{ $pharmacy->license_number }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Statistics --}}

    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card shadow border-left-primary">

                <div class="card-body text-center">

                    <i class="fas fa-pills fa-2x text-primary mb-2"></i>

                    <h3>{{ $totalMedicines }}</h3>

                    <small>Total Medicines</small>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow border-left-success">

                <div class="card-body text-center">

                    <i class="fas fa-shopping-cart fa-2x text-success mb-2"></i>

                    <h3>{{ $completedOrders }}</h3>

                    <small>Completed Orders</small>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow border-left-warning">

                <div class="card-body text-center">

                    <i class="fas fa-rupee-sign fa-2x text-warning mb-2"></i>

                    <h3>रु. {{ number_format($totalRevenue,2) }}</h3>

                    <small>Total Revenue</small>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        <i class="fas fa-info-circle"></i>

                        Pharmacy Information

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless">

                        <tr>

                            <th width="35%">District</th>

                            <td>{{ $pharmacy->district }}</td>

                        </tr>

                        <tr>

                            <th>Address</th>

                            <td>{{ $pharmacy->address }}</td>

                        </tr>

                        <tr>

                            <th>Opening</th>

                            <td>{{ date('h:i A',strtotime($pharmacy->opening_time)) }}</td>

                        </tr>

                        <tr>

                            <th>Closing</th>

                            <td>{{ date('h:i A',strtotime($pharmacy->closing_time)) }}</td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-header bg-primary text-white">

                    <h5 class="mb-0">

                        <i class="fas fa-map-marker-alt"></i>

                        Pharmacy Location

                    </h5>

                </div>

                <div class="card-body">

                    <div id="map"
                         style="height:350px;border-radius:10px;"></div>

                    <div class="row mt-3">

                        <div class="col-md-6">

                            <label>Latitude</label>

                            <input type="text"
                                   id="latitude"
                                   class="form-control"
                                   value="{{ $pharmacy->latitude }}"
                                   readonly>

                        </div>

                        <div class="col-md-6">

                            <label>Longitude</label>

                            <input type="text"
                                   id="longitude"
                                   class="form-control"
                                   value="{{ $pharmacy->longitude }}"
                                   readonly>

                        </div>

                    </div>

                    <a href="{{ route('pharmacy.profile') }}"
                       class="btn btn-success btn-block mt-4">

                        <i class="fas fa-user-edit"></i>

                        Edit Pharmacy Profile

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded',function(){

    var lat = parseFloat(document.getElementById('latitude').value) || 27.7172;
    var lng = parseFloat(document.getElementById('longitude').value) || 85.3240;

    var map = L.map('map').setView([lat,lng],14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
        attribution:'© OpenStreetMap'
    }).addTo(map);

    L.marker([lat,lng]).addTo(map);

});
</script>

@endpush

@endsection
@extends('layouts.app')

@section('content')

<div class="container">

    <div class="jumbotron text-center">

        <h2>Pharmacy Dashboard</h2>

        <p>Welcome {{ Auth::user()->name }}</p>

        <p>You are logged in as a Pharmacy.</p>

    </div>

</div>

@endsection
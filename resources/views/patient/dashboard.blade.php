@extends('layouts.app')

@section('content')

<div class="container">

    <div class="jumbotron text-center">

        <h2>Patient Dashboard</h2>

        <p>Welcome {{ Auth::user()->name }}</p>

        <p>You are logged in as a Patient.</p>

    </div>

</div>

@endsection
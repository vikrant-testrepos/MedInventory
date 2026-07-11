@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="jumbotron">

        <h1>Welcome {{ Auth::user()->name }}</h1>

        <p>You are successfully logged in.</p>

    </div>

</div>

@endsection
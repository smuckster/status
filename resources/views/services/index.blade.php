@extends('layout')

@section('body')

<h1>Services</h1>

@forelse($services as $service)
    <h2>{{ $service->name }}</h2>
    <p>{{ $service->description }}</p>
    <p>Status: {{ $service->status }}</p>

@empty
    <h2>No services found</h2>

@endforelse

@endsection

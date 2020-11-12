@extends('layout')

@section('body')

<h2>{{ $service->name }}</h2>
<p>{{ $service->description }}</p>
<p>Status: {{ $service->status }}</p>

@endsection

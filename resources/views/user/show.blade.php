@extends('layouts.simple')

@section('content')

		<h1>User Details</h1>

		<h2>{{ $user->email }} - # {{ $user->id }}</h2>

@endsection

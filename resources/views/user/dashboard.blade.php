@extends('layouts.app')

@section('content')
    <h1>Welcome to Dashboard {{ Auth::user()->first_name }}</h1>
@endsection
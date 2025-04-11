@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h3>Booking Details</h3>
    <table class="table table-bordered">
        <tr>
            <th>Customer Name</th>
            <td>{{ $booking->customer_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $booking->customer_email }}</td>
        </tr>
        <tr>
            <th>Booking Date</th>
            <td>{{ $booking->booking_date }}</td>
        </tr>
        <tr>
            <th>Type</th>
            <td>{{ ucfirst(str_replace('_', ' ', $booking->booking_type)) }}</td>
        </tr>
        <tr>
            <th>Slot</th>
            <td>{{ $booking->booking_slot ?? '-' }}</td>
        </tr>
        <tr>
            <th>Time</th>
            <td>{{ $booking->from_time }} - {{ $booking->to_time }}</td>
        </tr>
    </table>

    <a href="{{ route('account.booking_list') }}" class="btn btn-secondary">Back</a>
</div>
@endsection

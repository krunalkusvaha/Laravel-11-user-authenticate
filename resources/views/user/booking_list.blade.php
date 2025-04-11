@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="row">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <label for="booking_type" class="form-label">Booking List</label>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Slot</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->customer_name }}</td>
                                    <td>{{ $booking->customer_email }}</td>
                                    <td>{{ $booking->booking_date }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $booking->booking_type)) }}</td>
                                    <td>{{ $booking->booking_slot ?? '-' }}</td>
                                    <td>
                                        @if($booking)
                                            {{ $booking->from_time }} - {{ $booking->to_time }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('account.booking_show', $booking->id) }}" class="btn btn-info btn-sm">Show</a>
                                        <a href="{{ route('account.booking_edit', $booking->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6">No bookings found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
    </div>
@endsection
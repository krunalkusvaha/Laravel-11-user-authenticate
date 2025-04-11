@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                <div class="card border border-light-subtle rounded-4">
                    <div class="card-body p-3 p-md-4 p-xl-5">
                        <div class="row">
                            <div class="col-12">
                                @if (Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif

                                @if (Session::has('error'))
                                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                @endif
                                
                                <div class="mb-5">
                                    <h4 class="text-center">Booking Update</h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('account.update', $booking->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row gy-3 overflow-hidden">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                            value="{{ old('customer_name', $booking->customer_name) }}" name="customer_name"
                                            id="customer_name" placeholder="Enter your customer name">
                                        <label for="customer_name" class="form-label">Customer Name</label>
                                        @error('customer_name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('customer_email') is-invalid @enderror"
                                            value="{{ old('customer_email', $booking->customer_email) }}" name="customer_email"
                                            id="customer_email" placeholder="Enter your customer email">
                                        <label for="customer_email" class="form-label">Customer Email</label>
                                        @error('customer_email')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control @error('booking_date') is-invalid @enderror"
                                            value="{{ old('booking_date', $booking->booking_date) }}" name="booking_date"
                                            id="booking_date" placeholder="Enter your booking date">
                                        <label for="booking_date" class="form-label">Booking Date</label>
                                        @error('booking_date')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-control @error('booking_type') is-invalid @enderror" name="booking_type"
                                            id="booking_type">
                                            <option value="">Select Type</option>
                                            <option value="full_day" {{ old('booking_type', $booking->booking_type) == 'full_day' ? 'selected' : '' }}>Full Day</option>
                                            <option value="half_day" {{ old('booking_type', $booking->booking_type) == 'half_day' ? 'selected' : '' }}>Half Day</option>
                                            <option value="custom" {{ old('booking_type', $booking->booking_type) == 'custom' ? 'selected' : '' }}>Custom</option>
                                        </select>
                                        <label for="booking_type" class="form-label">Booking Type</label>
                                        @error('booking_type')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-control @error('booking_slot') is-invalid @enderror" name="booking_slot"
                                            id="booking_slot">
                                            <option value="">Select Slot</option>
                                            <option value="first_half" {{ old('booking_slot', $booking->booking_slot) == 'first_half' ? 'selected' : '' }}>First Half</option>
                                            <option value="second_half" {{ old('booking_slot', $booking->booking_slot) == 'second_half' ? 'selected' : '' }}>Second Half</option>
                                        </select>
                                        <label for="booking_slot" class="form-label">Booking Slot</label>
                                        @error('booking_slot')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control @error('booking_time_from') is-invalid @enderror"
                                            value="{{ old('booking_time_from', $booking->from_time) }}" name="booking_time_from"
                                            id="booking_time_from" placeholder="Enter your booking time">
                                        <label for="booking_time_from" class="form-label">From Time</label>
                                        @error('booking_time_from')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control @error('booking_time_to') is-invalid @enderror"
                                            value="{{ old('booking_time_to', $booking->to_time) }}" name="booking_time_to"
                                            id="booking_time_to" placeholder="Enter your to time">
                                        <label for="booking_time_to" class="form-label">To Time</label>
                                        @error('booking_time_to')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-success py-3" type="submit">Update Booking</button>
                                        <a href="{{ route('account.booking_list') }}" class="btn btn-secondary mt-2">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

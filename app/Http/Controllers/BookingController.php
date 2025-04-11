<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Crypt;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
{
    // This method will show booking page for user 
    public function index() {
        return view('user.booking');
    }

    // This method will list booking
    public function list (Request $request) {
        $bookings = Booking::latest()->limit(100)->get();
        return view('user.booking_list', compact('bookings'));
    }

    // This method will show the detail single record
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('user.booking_show', compact('booking'));
    }

    // This method will process the booking store in database
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'booking_date' => 'required|date',
            'booking_type' => 'required|in:full_day,half_day,custom',
            'booking_slot' => 'required_if:booking_type,half_day|nullable|in:first_half,second_half',
            'booking_time_from' => 'required_if:booking_type,custom',
            'booking_time_to' => 'required_if:booking_type,custom',
        ]);

        if ($validator->passes()) {

            $user_booking = new Booking();
            $user_booking->user_id = Auth::user()->id;
            $user_booking->customer_name = $request->customer_name;
            $user_booking->customer_email = $request->customer_email;
            $user_booking->booking_date = $request->booking_date;
            $user_booking->booking_type = $request->booking_type;
            $user_booking->booking_slot = $request->booking_slot;
            $user_booking->from_time = $request->booking_time_from;
            $user_booking->to_time = $request->booking_time_to;
            // dd($user_booking);
            $user_booking->save();

            return redirect()->back()->with('success', 'Booking created successfully!');
        } else {
            return redirect()->route('account.booking')->withInput()->withErrors($validator);
        }
    }

    // This method will fetch the data 
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('user.booking_edit', compact('booking'));
    }

    // This method will booking record update
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'booking_date' => 'required|date',
            'booking_type' => 'required|in:full_day,half_day,custom',
            'booking_slot' => 'required_if:booking_type,half_day|nullable|in:first_half,second_half',
            'booking_time_from' => 'required_if:booking_type,custom',
            'booking_time_to' => 'required_if:booking_type,custom',
            // add more validation rules if needed
        ]);

        $booking->update($request->all());

        return redirect()->route('account.booking_list')->with('success', 'Booking updated successfully.');
    }


    // This method will delete the booking record
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }
}

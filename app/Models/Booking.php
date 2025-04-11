<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'user_id', 'customer_name', 'customer_email', 'booking_date',
        'booking_type', 'booking_slot', 'from_time', 'to_time'
    ];
}

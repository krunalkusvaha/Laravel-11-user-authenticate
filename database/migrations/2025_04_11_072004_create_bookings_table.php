<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // To associate booking with the user
            $table->string('customer_name');
            $table->string('customer_email');
            $table->date('booking_date');
            $table->enum('booking_type', ['full_day', 'half_day', 'custom']);
            $table->enum('booking_slot', ['first_half', 'second_half'])->nullable();
            $table->time('from_time')->nullable();
            $table->time('to_time')->nullable();
            $table->index('booking_date'); // For faster search by date
            $table->timestamps();

            // Foreign key constraint to link bookings with users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

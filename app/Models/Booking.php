<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function up() {
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->date('booking_date');
        $table->string('package_name');
        $table->string('status')->default('pending'); // pending, confirmed, cancelled
        $table->timestamps();
    });
}
}

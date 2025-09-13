<?php

namespace App\Models;

use App\Enums\BookingStatusEnum;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'pid',
        'user_id',
        'bookable_type',
        'bookable_id',
        'start_datetime',
        'end_datetime',
        'total_amount',
        'status',
        'booking_reference',
        'notes',
    ];

    protected $casts = [
        'status' => BookingStatusEnum::class,
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookable()
    {
        return $this->morphTo();
    }
    
}

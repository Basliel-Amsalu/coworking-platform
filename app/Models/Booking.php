<?php

namespace App\Models;

use App\Enums\BookingStatusEnum;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'pid',
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

    protected static function booted()
    {
        static::creating(function ($booking) {
            if (empty($booking->pid)) {
                $booking->pid = (string) Str::orderedUuid();
            }
        });
    }

}

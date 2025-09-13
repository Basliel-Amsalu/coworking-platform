<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRooms extends Model
{
    use HasFactory;

    protected $fillables = [
        'pid',
        'space_id',
        'name',
        'capacity',
        'hourly_rate',
        'equipment',
        'status',
    ];

    protected $casts = [
        'status' => AssetStatusEnum::class,
    ];

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id');
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class);
    }
}

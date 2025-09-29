<?php

namespace App\Models;

use App\Enums\AssetStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MeetingRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'pid',
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

    protected static function booted()
    {
        static::creating(function ($meetingRoom) {
            if (empty($meetingRoom->pid)) {
                $meetingRoom->pid = (string) Str::orderedUuid();
            }
        });
    }
}

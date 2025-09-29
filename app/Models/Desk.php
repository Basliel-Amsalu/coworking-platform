<?php

namespace App\Models;

use App\Enums\AssetStatusEnum;
use App\Enums\DeskTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Desk extends Model
{
    use HasFactory;

    protected $fillable = [
        'pid',
        'name',
        'type',
        'hourly_rate',
        'daily_rate',
        'monthly_rate',
        'status',
   ];

    protected $casts = [
        'type' => DeskTypeEnum::class,
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

    protected static function booted()
    {
        static::creating(function ($desk) {
            if (empty($desk->pid)) {
                $desk->pid = (string) Str::orderedUuid();
            }
        });
    }
}

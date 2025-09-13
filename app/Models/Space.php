<?php

namespace App\Models;

use App\Enums\SpaceStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'pid',
        'manager_id',
        'name',
        'location',
        'description',
        'opening_hours',
        'status',
        'email',
        'phone',
        'website',
    ];

    protected $casts = [
        "status" => SpaceStatusEnum::class,
        "opening_hours" => 'array',
    ];

    public function manager()
    {
        return $this->belongsto(User::class, 'manager_id');
    }

    public function desks()
    {
        return $this->hasMany(Desk::class, 'space_id');
    }

    public function meeting_rooms()
    {
        return $this->hasMany(MeetingRooms::class, 'space_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }
}

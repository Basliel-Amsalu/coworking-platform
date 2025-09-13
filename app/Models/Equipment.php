<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pid',
        'name',
        'description'
    ];

    public function meeting_rooms()
    {
        return $this->belongsToMany(MeetingRooms::class);
    }
}

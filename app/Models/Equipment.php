<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        return $this->belongsToMany(MeetingRoom::class);
    }
    protected static function booted()
    {
        static::creating(function ($equipment) {
            if (empty($equipment->pid)) {
                $equipment->pid = (string) Str::orderedUuid();
            }
        });
    }
}

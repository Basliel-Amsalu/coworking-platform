<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Amenity extends Model
{
    use HasFactory;
    protected $fillable = [
        'pid',
        'name',
        'description',
    ];

    public function spaces()
    {
        return $this->belongsToMany(Space::class);
    }

    protected static function booted()
    {
        static::creating(function ($amenity) {
            if (empty($amenity->pid)) {
                $amenity->pid = (string) Str::orderedUuid();
            }
        });
    }
}

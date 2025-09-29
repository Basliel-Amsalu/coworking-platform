<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class EquipmentData extends Data
{
    public function __construct(
        public ?string $pid = null,
        public string $name,
        public ?string $description,
        #[DataCollectionOf(MeetingRoomData::class)]
        public ?DataCollection $meeting_rooms,
    ) {}
}

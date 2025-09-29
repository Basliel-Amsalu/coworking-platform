<?php

namespace App\Data;

use App\Enums\SpaceStatusEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class SpaceData extends Data
{
    public function __construct(
        //
        public ?string $pid,
        public string $name,
        public string $location,
        public ?string $description,
        public ?array $opening_hours,
        public ?SpaceStatusEnum $status,
        public ?string $email,
        public ?string $phone,
        public ?string $website,
        public ?UserData $manager,
        #[DataCollectionOf(DeskData::class)]
        public ?DataCollection $desks,
        #[DataCollectionOf(MeetingRoomData::class)]
        public ?DataCollection $meeting_rooms,
        #[DataCollectionOf(AmenityData::class)]
        public ?DataCollection $amenities
    ) {}
}

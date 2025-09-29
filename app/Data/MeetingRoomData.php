<?php

namespace App\Data;

use App\Enums\AssetStatusEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class MeetingRoomData extends Data
{
    public function __construct(
        public ?string $pid,
        public string $name,
        public int $capacity,
        public ?float $hourly_rate,
        public ?AssetStatusEnum $status,
        #[DataCollectionOf(EquipmentData::class)]
        public ?DataCollection $equipment,
        public ?string $space_pid,
        #[DataCollectionOf(BookingData::class)]
        public ?DataCollection $bookings,
    ) {}
}

<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class AmenityData extends Data
{
    public function __construct(
        public ?string $pid,
        public string $name,
        public ?string $description,
        #[DataCollectionOf(SpaceData::class)]
        public ?DataCollection $spaces,
    ) {}
}

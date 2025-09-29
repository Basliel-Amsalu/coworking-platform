<?php

namespace App\Data;

use App\Enums\AssetStatusEnum;
use App\Enums\DeskTypeEnum;
use Spatie\LaravelData\Data;

class DeskData extends Data
{
    public function __construct(
        public ?string $pid,
        public string $name,
        public ?DeskTypeEnum $type,
        public ?AssetStatusEnum $status,
        public ?float $hourly_rate,
        public ?float $daily_rate,
        public ?float $monthly_rate,
        public ?string $space_pid,
    ) {}
}

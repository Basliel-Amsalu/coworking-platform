<?php

namespace App\Data;

use App\Enums\RoleEnum;
use DateTime;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class UserData extends Data
{
    public function __construct(
        //
        public ?string $pid,
        public string $name,
        public ?string $first_name,
        public ?string $last_name,
        public string $email,
        // public RoleEnum $role,
        public ?string $phone,
        public ?string $address,
        public ?string $profile_photo,
        public ?string $date_of_birth,
        public ?DateTime $email_verified_at = null,
        #[DataCollectionOf(SpaceData::class)]
        public ?DataCollection $spaces = null,
        #[DataCollectionOf(BookingData::class)]
        public ?DataCollection $bookings = null,

    ) {}
}

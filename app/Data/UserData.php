<?php

namespace App\Data;

use App\Enums\RoleEnum;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        //
        public string $name,
        public string $email,
        public string $password,
        public RoleEnum $role,
    ) {}
}

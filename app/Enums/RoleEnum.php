<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case SPACE_MANANGER = 'space_manager';
    case MEMBER = 'member';
}

<?php

namespace App\Enums;

use OpenApi\Attributes as OAT;

#[OAT\Schema()]
enum SystemGroupType : string
{
    case DEFAULT = 'DEFAULT';
    case CUSTOM = 'CUSTOM';
}

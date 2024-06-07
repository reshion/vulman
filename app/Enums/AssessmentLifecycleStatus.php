<?php
namespace App\Enums;

use OpenApi\Attributes as OAT;

#[OAT\Schema()]
enum AssessmentLifecycleStatus: string {
    case OPEN = 'OPEN';
    case CLOSED = 'CLOSED';
}
<?php
namespace App\Enums;

use OpenApi\Attributes as OAT;

#[OAT\Schema()]
enum AssessmentLifecycleStatus: string {
    case OPEN = 'open';
    case CLOSED = 'closed';
}
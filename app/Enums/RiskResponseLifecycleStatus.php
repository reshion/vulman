<?php
namespace App\Enums;

use OpenApi\Attributes as OAT;

#[OAT\Schema()]
enum RiskResponseLifecycleStatus: string {
    case OPEN = 'OPEN';
    case IN_PROGRESS = 'IN_PROGRESS';
    case CLOSED = 'CLOSED';
}
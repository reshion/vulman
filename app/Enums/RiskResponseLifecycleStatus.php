<?php
namespace App\Enums;

enum RiskResponseLifecycleStatus: string {
    case OPEN = 'OPEN';
    case IN_PROGRESS = 'IN_PROGRESS';
    case CLOSED = 'CLOSED';
}
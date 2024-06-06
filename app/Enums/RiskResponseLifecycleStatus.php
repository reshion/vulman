<?php
namespace App\Enums;

enum RiskResponseLifecycleStatus: string {
    case OPEN = 'open';
    case CLOSED = 'closed';
    case IN_PROGRESS = 'in_progress';
}
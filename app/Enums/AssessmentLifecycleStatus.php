<?php
namespace App\Enums;

enum AssessmentLifecycleStatus: string {
    case OPEN = 'open';
    case CLOSED = 'closed';
}
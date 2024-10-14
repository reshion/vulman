<?php
namespace App\Enums;

use OpenApi\Attributes as OAT;

#[OAT\Schema()]
enum AssessmentTreatment: string {
    case ACCEPT = 'ACCEPT';
    case MITIGATE = 'MITIGATE';
    case TRANSFER = 'TRANSFER';
    case AVOID = 'AVOID';    
}
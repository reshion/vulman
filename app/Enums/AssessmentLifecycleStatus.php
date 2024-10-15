<?php
namespace App\Enums;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: "AssessmentLifecycleStatus",  // Name des Schemas
    type: "string",
    enum: ["OPEN", "CLOSED"],  // Werte des Enums
    description: "Status of the Assessment lifecycle"
)]
enum AssessmentLifecycleStatus: string {
    case OPEN = 'OPEN';
    case CLOSED = 'CLOSED';
}
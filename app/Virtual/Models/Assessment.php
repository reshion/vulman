<?php

namespace App\Virtual\Models;

use App\Enums\AssessmentLifecycleStatus;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Assessment",
 *     description="Assessment model",
 * )
 */
class Assessment extends NamedBaseModel
{

    /**
     * @OA\Property(
     *      title="created",
     *      description="Created date of the Assessment",
     *      format="date",
     *      example="2020-01-27",
     * )
     *
     * @var date
     */
    public $created;

    /**
     * @OA\Property()
     */
    public AssessmentLifecycleStatus $lifecycle_status;
}

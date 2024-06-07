<?php

namespace App\Virtual\Models;

use App\Enums\AssessmentLifecycleStatus;
use OpenApi\Annotations as OA;
use OpenApi\Attributes as OAT;
/**
 * @OA\Schema(
 *     title="Assessment",
 *     description="Assessment model",
 *     @OA\Xml(
 *         name="Assessment"
 *     )
 * )
 */
class Assessment extends NamedBaseModel
{   

    /**
     * @OA\Property(
     *      title="created",
     *      description="Created date of the Assessment",
     *      format="date",
     *      example="2020-01-27 17:50:45",
     * )
     *
     * @var date
     */
    public $created;

    #[OAT\Property()]
    public AssessmentLifecycleStatus $lifecycle_status;    
    
}
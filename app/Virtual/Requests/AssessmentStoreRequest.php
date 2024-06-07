<?php

namespace App\Virtual\Requests;

use App\Enums\AssessmentLifecycleStatus;
use OpenApi\Annotations as OA;
use OpenApi\Attributes as OAT;
/**
 * @OA\Schema(
 *     schema="AssessmentStoreRequest",
 *     type="object",
 *     title="AssessmentStoreRequest"     
 * )
 */
class AssessmentStoreRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new Assessment",
     *      example="Approve"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="created",
     *      description="The date the Assessment was created",
     *      example="2021-10-10"
     * )
     *
     * @var date
     */
    public $created;
    

    #[OAT\Property()]
    public AssessmentLifecycleStatus $lifecycle_status;


}

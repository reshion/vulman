<?php

namespace App\Virtual\Requests;

use App\Enums\RiskResponseLifecycleStatus;
use OpenApi\Annotations as OA;
use OpenApi\Attributes as OAT;
/**
 * @OA\Schema(
 *     schema="RiskResponseUpdateRequest",
 *     type="object",
 *     title="RiskResponseUpdateRequest"     
 * )
 */
class RiskResponseUpdateRequest
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
     *      description="The date the RiskResponse was created",
     *      example="2021-10-10"
     * )
     *
     * @var date
     */
    public $created;
    

    #[OAT\Property()]
    public RiskResponseLifecycleStatus $lifecycle_status;


}

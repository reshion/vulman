<?php

namespace App\Virtual\Requests;

use App\Enums\RiskResponseLifecycleStatus;
use OpenApi\Annotations as OA;
use OpenApi\Attributes as OAT;
/**
 * @OA\Schema(
 *     schema="RiskResponseStoreRequest",
 *     type="object",
 *     title="RiskResponseStoreRequest"     
 * )
 */
class RiskResponseStoreRequest
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

    /**
     * @OA\Property(
     *      title="assessment_id",
     *      description="The assessment id of the risk response",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $assessment_id;


}

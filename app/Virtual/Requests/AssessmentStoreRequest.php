<?php

namespace App\Virtual\Requests;

use App\Enums\AssessmentLifecycleStatus;
use App\Enums\RiskResponseLifecycleStatus;
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
    

    #[OAT\Property()]
    public AssessmentLifecycleStatus $lifecycle_status;

     /**
     * @OA\Property(
     *      title="company_id",
     *      description="The company id of the Assessment",
     *      example="1",
     *      nullable=true
     * )
     *
     * @var integer
     */
    public $company_id;

    /**
     * @OA\Property(
     *      title="system_group_id",
     *      description="The system group id of the Assessment",
     *      example="1",
     *      nullable=true
     * )
     *
     * @var integer
     */

    public $system_group_id;

    /**
     * @OA\Property(
     *      title="asset_id",
     *      description="The asset id of the Assessment",
     *      example="1",
     *      nullable=true
     * )
     *
     * @var integer
     */

    public $asset_id;

    /**
     * @OA\Property(
     *      title="risk_response_name",
     *      description="Risk Response name of the Assessment",
     *      example="Approve"
     * )
     *
     * @var string
     */
    public $risk_response_name;

    #[OAT\Property()]
    public RiskResponseLifecycleStatus $risk_response_lifecycle_status;


}

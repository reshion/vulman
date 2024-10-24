<?php

namespace App\Virtual\Requests;

use App\Enums\AssessmentLifecycleStatus;
use OpenApi\Annotations as OA;
use OpenApi\Attributes as OAT;
/**
 * @OA\Schema(
 *     schema="AssessmentFindRequest",
 *     type="object",
 *     title="AssessmentFindRequest"     
 * )
 */
class AssessmentFindRequest
{    

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
     * @OA\Property()
     */
    private AssessmentLifecycleStatus $lifecycle_status;


}

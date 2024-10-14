<?php

namespace App\Virtual\Requests;

use App\Enums\AssessmentLifecycleStatus;
use App\Enums\AssessmentTreatment;
use OpenApi\Annotations as OA;
use OpenApi\Attributes as OAT;
/**
 * @OA\Schema(
 *     schema="AssessmentUpdateRequest",
 *     type="object",
 *     title="AssessmentUpdateRequest"     
 * )
 */
class AssessmentUpdateRequest
{
    /**
     * @OA\Property(
     *      title="Note",
     *      description="Note of the Assessment",
     *      example="This is a note"
     * )
     *
     * @var string
     */
    public $note;

    #[OAT\Property()]
    public AssessmentTreatment $treatment;

    #[OAT\Property()]
    public AssessmentLifecycleStatus $lifecycle_status;

     /**
     * @OA\Property(
     *      title="company_id",
     *      description="The company id of the Assessment",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $company_id;

    /**
     * @OA\Property(
     *      title="system_group_id",
     *      description="The system group id of the Assessment",
     *      example="1"
     * )
     *
     * @var integer
     */

    public $system_group_id;

    /**
     * @OA\Property(
     *      title="asset_id",
     *      description="The asset id of the Assessment",
     *      example="1"
     * )
     *
     * @var integer
     */

    public $asset_id;


}

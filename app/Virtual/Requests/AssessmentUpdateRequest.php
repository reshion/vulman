<?php

namespace App\Virtual\Requests;

use App\Enums\AssessmentLifecycleStatus;
use App\Enums\AssessmentTreatment;
use App\Enums\RiskResponseLifecycleStatus;
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
     *      title="risk_response",
     *      description="Risk Response of the Assessment",
     *      example="Approve"
     * )
     *
     * @var string
     */
    public $risk_response;

    #[OAT\Property()]
    public RiskResponseLifecycleStatus $risk_response_lifecycle_status;

    


}

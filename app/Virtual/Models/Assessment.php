<?php

namespace App\Virtual\Models;

use App\Enums\AssessmentLifecycleStatus;
use App\Enums\RiskResponseLifecycleStatus;
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
    private $created;

    /**
     * @OA\Property()
     */
    private AssessmentLifecycleStatus $lifecycle_status;

    /**
     * @OA\Property()
     */
    private RiskResponseLifecycleStatus $risk_response_lifecycle_status;


    /**
     * @OA\Property(
     *      title="Company Id",
     *      description="Company's id of the Assessment",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    private $company_id;

    /**
     * @OA\Property(
     *     title="Company",
     *     description="Company of the Assessment"
     * )
     *
     * @var \App\Virtual\Models\Company
     */
    private $company;
}

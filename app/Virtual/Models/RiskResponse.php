<?php

namespace App\Virtual\Models;

use App\Enums\RiskResponseLifecycleStatus;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="RiskResponse",
 *     description="RiskResponse model",
 * )
 */
class RiskResponse extends NamedBaseModel
{

    /**
     * @OA\Property(
     *      title="created",
     *      description="Created date of the RiskResponse",
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
    public RiskResponseLifecycleStatus $lifecycle_status;

    /**
     * @OA\Property(
     *      title="Assessment ID",
     *      description="Assessment's id of the RiskResponse",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $assessment_id;

    /**
     * @OA\Property(
     *     title="Assessment",
     *     description="Risk response assessment model"
     * )
     *
     * @var \App\Virtual\Models\Assessment
     */
    private $assessment;
}

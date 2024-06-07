<?php

namespace App\Virtual\Models;

use App\Enums\RiskResponseLifecycleStatus;
use OpenApi\Annotations as OA;
use OpenApi\Attributes as OAT;
/**
 * @OA\Schema(
 *     title="RiskResponse",
 *     description="RiskResponse model",
 *     @OA\Xml(
 *         name="RiskResponse"
 *     )
 * )
 */
class RiskResponse extends NamedBaseModel
{   

    /**
     * @OA\Property(
     *      title="created",
     *      description="Created date of the RiskResponse",
     *      format="date",
     *      example="2020-01-27 17:50:45",
     * )
     *
     * @var date
     */
    public $created;

    #[OAT\Property()]
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
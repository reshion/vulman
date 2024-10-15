<?php

namespace App\Virtual\Models;

use App\Enums\AssessmentLifecycleStatus;
use App\Enums\RiskResponseLifecycleStatus;
use App\Enums\AssessmentTreatment;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Assessment",
 *     description="Assessment model",
 * )
 */
class Assessment extends BaseModel
{
    /**
     * @OA\Property(
     *      title="Note",
     *      description="Some notes of the Assessment",
     *      example="This is a note"
     * )
     *
     * @var string
     */
    private $note;

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
     * @OA\Property()
     */
    private AssessmentTreatment $treatment;


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


    /**
     * @OA\Property(
     *      title="Vulnerability Id",
     *      description="Vulnerability's id of the Assessment",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    private $vulnerability_id;
    /**
     * @OA\Property(
     *     title="Vulnerabilities",
     *     description="Assessment vulnerabilities model"
     * )
     *
     * @var \App\Virtual\Models\Vulnerability
     */

    private $vulnerability;


    /**
     * @OA\Property(
     *      title="Asset Id",
     *      description="Asset's id of the Assessment",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    private $asset_id;

    /**
     * @OA\Property(
     *     title="Assets",
     *     description="Assessment assets model"
     * )
     *
     * @var \App\Virtual\Models\Asset
     */
    private $asset;

    /**
     * @OA\Property(
     *      title="System Group Id",
     *      description="System Group's id of the Assessment",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    private $system_group_id;

    /**
     * @OA\Property(
     *     title="System Groups",
     *     description="Assessment system groups model"
     * )
     *
     * @var \App\Virtual\Models\SystemGroup
     */

    private $system_group;

    /**
     * @OA\Property(
     *      title="Risk Response",
     *      description="Risk Response of the Assessment",
     *      format="string",
     *      example="Approve"
     * )
     *
     * @var string
     */
    private $risk_response;
   
}


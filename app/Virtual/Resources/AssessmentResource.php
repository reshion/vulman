<?php

namespace App\Virtual\Resources;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="AssessmentResource",
 *     type="object",
 *     title="AssessmentResource"     
 * )
 */
class AssessmentResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Assessment
     */
    private $data;
}

/**
 * @OA
 * @OA\Schema(
 *   schema="AssessmentsResource",
 *   type="object",
 *   title="AssessmentsResource",
 * )
 */
class AssessmentsResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Assessment[]
     */
    private $data;
}

/**
 * @OA\Schema(
 *     schema="AssessmentPagingResource",
 *     type="object",
 *     title="AssessmentPagingResource"     
 * )
 */
class AssessmentPagingResource extends AssessmentsResource
{
    /**
     * @OA\Property(
     *     title="Meta",
     *     description="Meta wrapper"
     * )
     *
     * @var \App\Virtual\Resources\Meta
     */
    private $meta;
}

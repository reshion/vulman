<?php

namespace App\Virtual\Resources;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="AssessmentPagingResource",
 *     type="object",
 *     title="AssessmentPagingResource"     
 * )
 */
class AssessmentPagingResource
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
<?php

namespace App\Virtual\Resources;
use OpenApi\Annotations as OA;
use OpenApi\Attributes as OAT;

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
     * @var \App\Virtual\Models\Assessment[]
     */
    private $data;
}
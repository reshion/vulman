<?php

namespace App\Virtual\Resources;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RiskResponsePagingResource",
 *     type="object",
 *     title="RiskResponsePagingResource"     
 * )
 */
class RiskResponsePagingResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\RiskResponse[]
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
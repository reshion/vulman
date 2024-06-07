<?php

namespace App\Virtual\Resources;
use OpenApi\Annotations as OA;
use OpenApi\Attributes as OAT;

/**
 * @OA\Schema(
 *     schema="RiskResponseResource",
 *     type="object",
 *     title="RiskResponseResource"     
 * )
 */
class RiskResponseResource
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
}
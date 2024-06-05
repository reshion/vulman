<?php

namespace App\Virtual\Requests;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema(
 *     schema="CompanyUpdateRequest",
 *     type="object",
 *     title="CompanyUpdateRequest"     
 * )
 */
class CompanyUpdateRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the company",
     *      example="A nice Tenant"
     * )
     *
     * @var string
     */
    public $name;
}

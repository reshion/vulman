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
     *      example="A nice company name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="tenant_id",
     *      description="The tenant id of the company",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $tenant_id;
}

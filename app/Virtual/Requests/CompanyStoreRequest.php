<?php

namespace App\Virtual\Requests;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema(
 *     schema="CompanyStoreRequest",
 *     type="object",
 *     title="CompanyStoreRequest"     
 * )
 */
class CompanyStoreRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new company",
     *      example="A nice company"
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

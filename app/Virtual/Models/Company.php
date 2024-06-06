<?php

namespace App\Virtual\Models;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Company",
 *     description="Company model",
 *     @OA\Xml(
 *         name="Company"
 *     )
 * )
 */
class Company extends NamedBaseModel
{   

    /**
     * @OA\Property(
     *      title="Tenant ID",
     *      description="Tenant's id of the Company",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $tenant_id;

    /**
     * @OA\Property(
     *     title="Tenant",
     *     description="Company tenants model"
     * )
     *
     * @var \App\Virtual\Models\Tenant
     */
    private $tenant;
}
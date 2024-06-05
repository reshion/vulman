<?php

namespace App\Virtual\Requests;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema(
 *     schema="TenantStoreRequest",
 *     type="object",
 *     title="TenantStoreRequest"     
 * )
 */
class TenantStoreRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new Tenant",
     *      example="A nice Tenant"
     * )
     *
     * @var string
     */
    public $name;
}

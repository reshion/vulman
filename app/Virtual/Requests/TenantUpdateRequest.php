<?php

namespace App\Virtual\Requests;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema(
 *     schema="TenantUpdateRequest",
 *     type="object",
 *     title="TenantUpdateRequest"     
 * )
 */
class TenantUpdateRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Update name of the new Tenant",
     *      example="A nice Tenant"
     * )
     *
     * @var string
     */
    public $name;
}

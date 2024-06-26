<?php

namespace App\Virtual\Resources;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="TenantResource",
 *     description="TenantResource",
 *     @OA\Xml(
 *        name="TenantResource"
 *    )
 * )
 */

class TenantResource
{
  /**
   * @OA\Property(
   *     title="Data",
   *     description="Data wrapper"
   * )
   *
   * @var \App\Virtual\Models\Tenant
   */
  private $data;
}

/**
 * @OA\Schema(
 *     title="TenantPagingResource",
 *     description="TenantPagingResource",
 *     @OA\Xml(
 *        name="TenantPagingResource"
 *    )
 * )
 */

 class TenantPagingResource
 {
   /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Tenant[]
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

<?php

namespace App\Virtual\Resources;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="SystemGroupResource",
 *     description="SystemGroupResource",
 *     @OA\Xml(
 *        name="SystemGroupResource"
 *    )
 * )
 */

class SystemGroupResource
{
  /**
   * @OA\Property(
   *     title="Data",
   *     description="Data wrapper"
   * )
   *
   * @var \App\Virtual\Models\SystemGroup
   */
  private $data;
}


/**
 * @OA\Schema(
 *     title="SystemGroupPagingResource",
 *     description="SystemGroupPagingResource",
 *     @OA\Xml(
 *        name="SystemGroupPagingResource"
 *    )
 * )
 */

 class SystemGroupPagingResource
 {
   /**
    * @OA\Property(
    *     title="Data",
    *     description="Data wrapper"
    * )
    *
    * @var \App\Virtual\Models\SystemGroup[]
    */
   private $data;
 }
<?php

namespace App\Virtual\Resources;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="AssetResource",
 *     description="AssetResource",
 *     @OA\Xml(
 *        name="AssetResource"
 *    )
 * )
 */

class AssetResource
{
  /**
   * @OA\Property(
   *     title="Data",
   *     description="Data wrapper"
   * )
   *
   * @var \App\Virtual\Models\Asset
   */
  private $data;
}

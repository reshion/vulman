<?php
namespace App\Virtual\Resources;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="AssetPagingResource",
 *     description="AssetPagingResource",
 *     @OA\Xml(
 *        name="AssetPagingResource"
 *    )
 * )
 */

 class AssetPagingResource
 {
   /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Asset[]
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
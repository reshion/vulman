<?php

namespace App\Virtual\Resources;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="ScanImportJobResource",
 *     description="ScanImportJobResource",
 *     @OA\Xml(
 *        name="ScanImportJobResource"
 *    )
 * )
 */

class ScanImportJobResource
{
  /**
   * @OA\Property(
   *     title="Data",
   *     description="Data wrapper"
   * )
   *
   * @var \App\Virtual\Models\ScanImportJob
   */
  private $data;
}


/**
 * @OA\Schema(
 *     title="ScanImportJobPagingResource",
 *     description="ScanImportJobPagingResource",
 *     @OA\Xml(
 *        name="ScanImportJobPagingResource"
 *    )
 * )
 */

 class ScanImportJobPagingResource
 {
   /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\ScanImportJob[]
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
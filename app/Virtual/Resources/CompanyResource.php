<?php

namespace App\Virtual\Resources;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="CompanyResource",
 *     description="CompanyResource",
 *     @OA\Xml(
 *        name="CompanyResource"
 *    )
 * )
 */

 class CompanyResource
 {
   /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Company[]
     */
    private $data;
 }
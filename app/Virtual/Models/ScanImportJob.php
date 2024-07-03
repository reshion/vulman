<?php
namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="ScanImportJob",
 *     description="ScanImportJob model",
 * )
 */
class ScanImportJob extends BaseModel
{
    /**
     * @OA\Property(
     *     title="Company",
     *     description="Company model"
     * )
     *
     * @var \App\Virtual\Models\Company
     */
    private $company;
}

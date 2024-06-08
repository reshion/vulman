<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Asset",
 *     description="Asset model"
 * )
 */
class Asset extends BaseModel
{

    /**
     * @OA\Property(
     *      title="fqdn",
     *      description="FQDN of the asset",
     *      format="string",
     *      example="example.com"
     * )
     *
     * @var string
     */
    public $fqdn;

    /**
     * @OA\Property(
     *      title="unique_id",
     *      description="The unique id of the Asset",
     *      format="string",
     *      example="test123"
     * )
     *
     * @var string
     */
    public $unique_id;

    /**
     * @OA\Property(
     *      title="operating_system",
     *      description="The operating system of the Asset",
     *      format="string",
     *      example="Windows"
     * )
     *
     * @var string
     */
    public $operating_system;
}

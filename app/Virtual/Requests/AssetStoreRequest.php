<?php

namespace App\Virtual\Requests;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema(
 *     schema="AssetStoreRequest",
 *     type="object",
 *     title="AssetStoreRequest"     
 * )
 */
class AssetStoreRequest
{
    /**
     * @OA\Property(
     *      title="fqdn",
     *      description="FQDN of the new Asset",
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
     *      example="1"
     * )
     *
     * @var string
     */
    public $unique_id;
    

    /**
     * @OA\Property(
     *      title="operating_system",
     *      description="The operating system of the Asset",
     *      example="Windows"
     * )
     *
     * @var string
     */
    public $operating_system;


}

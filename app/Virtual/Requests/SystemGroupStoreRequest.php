<?php

namespace App\Virtual\Requests;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema(
 *     schema="SystemGroupStoreRequest",
 *     type="object",
 *     title="SystemGroupStoreRequest"     
 * )
 */
class SystemGroupStoreRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new system group",
     *      example="A nice company"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="company_id",
     *      description="The company id",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $company_id;
}

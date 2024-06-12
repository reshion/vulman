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
     *      example="A nice system group name"
     * )
     *
     * @var string
     */
    public $name;

   
}

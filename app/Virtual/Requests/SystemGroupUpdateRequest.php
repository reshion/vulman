<?php

namespace App\Virtual\Requests;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema(
 *     schema="SystemGroupUpdateRequest",
 *     type="object",
 *     title="SystemGroupUpdateRequest"     
 * )
 */
class SystemGroupUpdateRequest
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

}

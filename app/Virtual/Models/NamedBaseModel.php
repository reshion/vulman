<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="NamedBaseModel",
 *     description="NamedBaseModel",
 * )
 */
class NamedBaseModel extends BaseModel
{
    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the entity",
     *      example="Elmofuchto"
     * )
     *
     * @var string
     */
    public $name;
}

<?php

namespace App\Virtual\Models;

use Faker\Guesser\Name;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Tenant",
 *     description="Tenant model",
 *     @OA\Xml(
 *         name="Tenant"
 *     )
 * )
 */
class Tenant extends NamedBaseModel
{    
   
}
<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User extends NamedBaseModel
{   

    /**
     * @OA\Property(
     *     title="Email verified at",
     *     description="Email verified at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $email_verified_at;

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
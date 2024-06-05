<?php

namespace App\Virtual\Requests;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="LoginRequest",
 *     type="object",
 *     title="LoginRequest"     
 * )
 */

 class LoginRequest
 {
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email of of User",
     *      example="test@example.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Users password",
     *      example="password"
     * )
     *
     * @var string
     */
    public $password;
 }
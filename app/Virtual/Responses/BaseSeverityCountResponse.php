<?php

namespace App\Virtual\Responses;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="BaseSeverityCountResponse",
 *     description="BaseSeverityCountResponse",
 *     type="object"
 * )
 */
class BaseSeverityCountResponse
{
    /**
     * @OA\Property(
     *     title="Crtitical",
     *     description="Crtitical severity count",
     *     default=0
     * )
     *
     * @var integer
     */
    private $critical;

    /**
     * @OA\Property(
     *     title="High",
     *     description="High severity count",
     *     default=0
     * )
     *
     * @var integer
     */
    private $high;

    /**
     * @OA\Property(
     *     title="Medium",
     *     description="Medium severity count",
     *     default=0
     * )
     *
     * @var integer
     */

    private $medium;

    /**
     * @OA\Property(
     *     title="Low",
     *     description="Low severity count",
     *     default=0
     * )
     *
     * @var integer
     */
    private $low;


}
<?php

namespace App\Virtual\Resources;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Meta",
 *     type="object",
 *     title="Meta"     
 * )
 */
class Meta
{
    /**
     * @OA\Property(
     *     title="Current Page",
     *     description="Current Page of the data"
     * )
     *
     * @var integer
     */
    private $current_page;

    /**
     * @OA\Property(
     *     title="From",
     *     description="From"
     * )
     *
     * @var integer
     */
    private $from;

    /**
     * @OA\Property(
     *     title="Last Page",
     *     description="Last Page of the data"
     * )
     *
     * @var integer
     */
    private $last_page;


    /**
     * @OA\Property(
     *     title="Per Page",
     *     description="Per Page of the data"
     * )
     *
     * @var integer
     */
    private $per_page;

    /**
     * @OA\Property(
     *     title="To",
     *     description="To"
     * )
     *
     * @var integer
     */
    private $to;

    /**
     * @OA\Property(
     *     title="Total",
     *     description="Total"
     * )
     *
     * @var integer
     */
    private $total;

}
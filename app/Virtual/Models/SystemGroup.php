<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="SystemGroup",
 *     description="System Group model",
 * )
 */
class SystemGroup extends NamedBaseModel
{
    /**
     * @OA\Property(
     *      title="Company Id",
     *      description="Id of the Company",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $company_id;

    /**
     * @OA\Property(
     *     title="Company",
     *     description="Company tenants model"
     * )
     *
     * @var \App\Virtual\Models\Company
     */
    private $company;
}

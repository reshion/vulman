<?php

namespace App\Virtual\Models;

use App\Enums\SystemGroupType;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="SystemGroup",
 *     description="System Group model" *    
 * )
 */
class SystemGroup extends NamedBaseModel
{

    /**
     * @OA\Property()
     */
    private SystemGroupType $type;

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
    private $company_id;

    /**
     * @OA\Property(
     *     title="Company",
     *     description="Company tenants model"
     * )
     *
     * @var \App\Virtual\Models\Company
     */
    private $company;


    /**
     * @OA\Property(
     *     title="Assets",
     *     description="System group assets list", 
     *     
     * )
     *
     * @var \App\Virtual\Models\Asset[]
     */
    private $assets;
}

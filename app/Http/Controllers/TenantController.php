<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Http\Controllers\Controller;
use App\Http\Requests\TenantStoreRequest;
use App\Http\Requests\TenantUpdateRequest;
use App\Http\Resources\TenantResource;
use Illuminate\Http\Request;

use OpenApi\Annotations as OA;

/** 
 * @OAS\SecurityScheme(      
 *      securityScheme="sanctum",
 *      type="http",
 *      scheme="bearer"
 * )
 */
class TenantController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/tenants",
     *     operationId="listTenants",
     *     summary="Lists tenants",
     *     tags={"Tenants"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="count",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/TenantPagingResource")
     *     )
     * )
     */
    public function index(Request $request)
    {
        $count = $request->input('count', 10);
        $tenants = Tenant::paginate($count);
        return TenantResource::collection($tenants);
    }

    /**
     * @OA\Post(
     *     path="/api/tenants",
     *     operationId="storeTenant",
     *     tags={"Tenants"},
     *     security={{"sanctum":{}}},
     *     summary="Adds a new tenant",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/TenantStoreRequest")
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/TenantResource")
     *     )
     * )
     */

    public function store(TenantStoreRequest $request)
    {
        $tenant = Tenant::create($request->all());
        return new TenantResource($tenant);             
    }

    /**
     * @OA\Get(
     *      path="/api/tenants/{id}",
     *      tags={"Tenants"},
     *      operationId="showTenant",
     *      security={{"sanctum":{}}},
     *      summary="Get Tenant information",
     *      description="Returns Tenant data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Tenant id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TenantResource")
     *       )
     * )
     */
    public function show(Tenant $tenant)
    {
        return new TenantResource($tenant);
    }
    

    /**
     * @OA\Put(
     *      path="/api/tenants/{id}",
     *      tags={"Tenants"},
     *      operationId="updateTenant",
     *      security={{"sanctum":{}}},
     *      summary="Update Tenant information",
     *      description="Returns Tenant data",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/TenantUpdateRequest")          
     *         )
     *     ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Tenant id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TenantResource")
     *       )
     * )
     */
    public function update(TenantUpdateRequest $request, Tenant $tenant)
    {
        $tenant->update($request->validated());
        return new TenantResource($tenant);
    }

    /**
     * @OA\Delete(
     *      path="/api/tenants/{id}",
     *      tags={"Tenants"},
     *      operationId="destroyTenant",
     *      security={{"sanctum":{}}},
     *      summary="Delete Tenant",
     *      description="Returns deleted Tenant data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Tenant id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TenantResource")
     *       )
     * )
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return new TenantResource($tenant);
    }
}

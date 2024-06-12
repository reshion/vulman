<?php

namespace App\Http\Controllers;

use App\Enums\SystemGroupType;
use App\Http\Requests\SystemGroupStoreRequest;
use App\Http\Requests\SystemGroupUpdateRequest;
use App\Http\Resources\SystemGroupResource;
use App\Models\SystemGroup;
use Illuminate\Http\Request;
use PHPUnit\Event\Telemetry\System;

/** 
 * @OAS\SecurityScheme(      
 *      securityScheme="sanctum",
 *      type="http",
 *      scheme="bearer"
 *      description="Bearer 4|oeXad4kChJT43wli90LOd1VbFhtuGuEdvxvEHMAtcb025185",
 * )
 */
class SystemGroupController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/system-groups",
     *     operationId="listSystemGroups",
     *     summary="Lists system groups",
     *     tags={"SystemGroups"},
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
     *         @OA\JsonContent(ref="#/components/schemas/SystemGroupPagingResource")
     *     )
     * )
     */
    public function index(Request $request)
    {
        $count = $request->input('count', 10);
        $companies = SystemGroup::with('company')->paginate($count);
        return SystemGroupResource::collection($companies);
    }

    /**
     * @OA\Post(
     *     path="/api/system-groups",
     *     tags={"SystemGroups"},
     *     operationId="storeSystemGroup",
     *     security={{"sanctum":{}}},
     *     summary="Adds a new system group",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/SystemGroupStoreRequest")
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/SystemGroupResource")
     *     )
     * )
     */
    public function store(SystemGroupStoreRequest $request)
    {
        

        $systemGroup = new SystemGroup($request->validated());
        $user = $request->user();
        $systemGroup->company_id = $user->company_id;
        $systemGroup->type = SystemGroupType::CUSTOM;
        $systemGroup = SystemGroup::create($systemGroup->toArray());
        return new SystemGroupResource($systemGroup);
    }

    /**
     * @OA\Get(
     *      path="/api/system-groups/{id}",
     *      tags={"SystemGroups"},
     *      operationId="getSystemGroup",
     *      security={{"sanctum":{}}},
     *      summary="Get system group information",
     *      description="Returns system group",
     *      @OA\Parameter(
     *          name="id",
     *          description="System group id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/SystemGroupResource")
     *       )
     * )
     */
    public function show(SystemGroup $systemGroup)
    {
        return new SystemGroupResource($systemGroup->load('company.tenant'));
    }

    /**
     * @OA\Put(
     *     path="/api/system-groups/{id}",
     *     tags={"SystemGroups"},
     *     operationId="updateSystemGroup",
     *     security={{"sanctum":{}}},
     *     summary="Update an existing system group",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="System group id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/SystemGroupUpdateRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/SystemGroupResource")
     *     )
     * )
     */
    public function update(SystemGroupUpdateRequest $request, SystemGroup $systemGroup)
    {
        $systemGroup->update($request->validated());
        return new SystemGroupResource($systemGroup);
    }

    /**
     * @OA\Delete(
     *      path="/api/system-groups/{id}",
     *      tags={"SystemGroups"},
     *      operationId="deleteSystemGroup",
     *      security={{"sanctum":{}}},
     *      summary="Delete system group",
     *      description="Deletes a system group",
     *      @OA\Parameter(
     *          name="id",
     *          description="System group id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/SystemGroupResource")
     *       )
     * )
     */
    public function destroy(string $id)
    {
        $systemGroup = SystemGroup::findOrFail($id);
        $systemGroup->delete();
        return new SystemGroupResource($systemGroup);
    }
}

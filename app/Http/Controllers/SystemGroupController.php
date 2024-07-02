<?php

namespace App\Http\Controllers;

use App\Enums\SystemGroupType;
use App\Http\Requests\SystemGroupStoreRequest;
use App\Http\Requests\SystemGroupUpdateRequest;
use App\Http\Resources\AssetResource;
use App\Http\Resources\SystemGroupResource;
use App\Models\Asset;
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
        $user = $request->user();
        $systemGroup = SystemGroup::with(['company', 'assets'])->where('company_id', $user->company_id)->paginate($count);
        // $companies->
        return SystemGroupResource::collection($systemGroup);
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

    /**
     * @OA\Delete(
     *     path="/api/system-groups/{id}/asset/{assetId}",
     *     tags={"SystemGroups"},
     *     operationId="removeAsset",
     *     security={{"sanctum":{}}},
     *     summary="Add an asset to a system group",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="System group id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="assetId",
     *         in="path",
     *         description="Asset id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/SystemGroupResource")
     *     )
     * )
     */
    public function removeAsset(Request $request)
    {
        $systemGroup = SystemGroup::findOrFail($request->id);
        $assetId = $request->assetId;
        if($systemGroup->type === SystemGroupType::DEFAULT)
        {
            return response()->json(['message' => 'Cannot remove asset from system group'], 400);
        }
        $systemGroup->assets()->detach($assetId);
        return new SystemGroupResource($systemGroup);
    }

    /**
     * @OA\Post(
     *    path="/api/system-groups/{id}/asset/{assetId}",
     *    tags={"SystemGroups"},
     *    operationId="addAsset",
     *    security={{"sanctum":{}}},
     *    summary="Add an asset to a system group",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="System group id",
     *        required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(
     *        name="assetId",
     *        in="path",
     *        description="Asset id",
     *        required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="OK",
     *        @OA\JsonContent(ref="#/components/schemas/SystemGroupResource")
     *    )
     * )
     * 
     */
    public function addAsset(Request $request)
    {
        $systemGroup = SystemGroup::findOrFail($request->id);
        $assetId = $request->assetId;
        // Check if asset is already in system group
        if($systemGroup->assets()->where('asset_id', $assetId)->exists())
        {
            return response()->json(['message' => 'Asset already in system group'], 400);
        }
        $systemGroup->assets()->attach($assetId);
        return new SystemGroupResource($systemGroup);
    }

    // Get all assets with paging that are not in the system group
    /**
     * @OA\Get(
     *     path="/api/system-groups/{id}/assets/unassigned",
     *     tags={"SystemGroups"},
     *     operationId="getUnassignedAssets",
     *     security={{"sanctum":{}}},
     *     summary="Get all assets that are not in the system group",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="System group id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
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
     *         @OA\JsonContent(ref="#/components/schemas/AssetPagingResource")
     *     )
     * )
     */
    public function getUnassignedAssets(Request $request)
    {
        $count = $request->input('count', 10);
        $systemGroup = SystemGroup::findOrFail($request->id);
        $assets = Asset::whereDoesntHave('system_groups', function ($query) use ($systemGroup) {
            $query->where('system_group_id', $systemGroup->id);
        })->paginate($count);
        return AssetResource::collection($assets);
    }

}

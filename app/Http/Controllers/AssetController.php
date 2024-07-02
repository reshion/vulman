<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetStoreRequest;
use App\Http\Requests\AssetUpdateRequest;
use App\Http\Resources\AssetResource;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

/** 
 * @OAS\SecurityScheme(      
 *      securityScheme="sanctum",
 *      type="http",
 *      scheme="bearer"
 * )
 */
class AssetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/assets",
     *     operationId="listAssets",
     *     summary="Lists assets",
     *     tags={"Assets"},
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
     *         @OA\JsonContent(ref="#/components/schemas/AssetPagingResource")
     *     )
     * )
     */
    public function index(Request $request)
    {
        $count = $request->input('count', 10);
        $assets = Asset::whereHas('system_groups',  function ($query) use ($request) {
            $query->where('system_groups.company_id', '=', $request->user()->company_id);
        });

        $assets =  $assets->whereHas('vulnerabilities', function ($query) use ($request) {

            return $query
                ->whereJsonContains('cve_details->containers->cna->metrics', [['cvssV3_1' => ['baseSeverity' => 'CRITICAL']]])
                ->orWhereJsonContains('cve_details->containers->cna->metrics', [['cvssV3_1' => ['baseSeverity' => 'HIGH']]])
                ->orWhereJsonContains('cve_details->containers->cna->metrics', [['cvssV3_1' => ['baseSeverity' => 'MEDIUM']]])
                ->orWhereJsonContains('cve_details->containers->cna->metrics', [['cvssV3_1' => ['baseSeverity' => 'LOW']]]);
            //->select(DB::raw("jsonb_extract_path_text(cve_details ::jsonb, 'containers','cna','metrics','0','cvssV3_1','baseSeverity') as baseSeverity"));;
        });
        $assets = $assets->paginate($count);
        return AssetResource::collection($assets);
    }

    /**
     * @OA\Get(
     *     path="/api/assets/vulnerability/{vulnerability_id}",
     *     operationId="getAssetsByVulnerability",
     *     summary="Lists assets by vulnerability id",
     *     tags={"Assets"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="vulnerability_id",
     *         in="query",
     *         description="Vulnerability id",
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
    public function getAssetsByVulnerability(Request $request)
    {
        $count = $request->input('count', 10);
        $vulnerabilityId = $request->input('vulnerability_id');
        $assets = Asset::whereHas('vulnerabilities', function ($query) use ($vulnerabilityId) {
            $query->where('vulnerabilities.id', '=', $vulnerabilityId);
        })->paginate($count);
        return AssetResource::collection($assets);
    }

    /**
     * @OA\Get(
     *     path="/api/assets/system-group/{system_group_id}",
     *     operationId="getAssetsBySystemGroup",
     *     summary="Lists assets by system group id",
     *     tags={"Assets"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="system_group_id",
     *         in="query",
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
    public function getAssetsBySystemGroup(Request $request)
    {
        $count = $request->input('count', 10);
        $systemGroupId = $request->input('system_group_id');
        $assets = Asset::whereHas('system_groups', function ($query) use ($systemGroupId) {
            $query->where('system_groups.id', '=', $systemGroupId);
        })->paginate($count);
        return AssetResource::collection($assets);
    }

    /**
     * @OA\Post(
     *     path="/api/assets",
     *     operationId="storeAsset",
     *     tags={"Assets"},
     *     security={{"sanctum":{}}},
     *     summary="Adds a new asset",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/AssetStoreRequest")
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/AssetResource")
     *     )
     * )
     */

    public function store(AssetStoreRequest $request)
    {
        $asset = Asset::create($request->all());
        return new AssetResource($asset);
    }

    /**
     * @OA\Get(
     *      path="/api/assets/{id}",
     *      tags={"Assets"},
     *      operationId="showAsset",
     *      security={{"sanctum":{}}},
     *      summary="Get Asset information",
     *      description="Returns Asset data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Asset id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AssetResource")
     *       )
     * )
     */
    public function show(Asset $asset)
    {
        return new AssetResource($asset);
    }


    /**
     * @OA\Put(
     *      path="/api/assets/{id}",
     *      tags={"Assets"},
     *      operationId="updateAsset",
     *      security={{"sanctum":{}}},
     *      summary="Update Asset information",
     *      description="Returns updated Asset data",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/AssetStoreRequest")          
     *         )
     *     ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Asset id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AssetResource")
     *       )
     * )
     */
    public function update(AssetUpdateRequest $request, Asset $asset)
    {
        $asset->update($request->validated());
        return new AssetResource($asset);
    }

    /**
     * @OA\Delete(
     *      path="/api/assets/{id}",
     *      tags={"Assets"},
     *      operationId="deleteAsset",
     *      security={{"sanctum":{}}},
     *      summary="Delete Asset",
     *      description="Deletes a single Asset",
     *      @OA\Parameter(
     *          name="id",
     *          description="Asset id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AssetResource")
     *       )
     * )
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();
        return new AssetResource($asset);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RiskResponseStoreRequest;
use App\Http\Requests\RiskResponseUpdateRequest;
use App\Http\Resources\RiskResponseResource;
use App\Models\RiskResponse;
use Illuminate\Http\Request;

/** 
 * @OAS\SecurityScheme(      
 *      securityScheme="sanctum",
 *      type="http",
 *      scheme="bearer"
 * )
 */
class RiskResponseController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/risk-responses",
     *     operationId="listRiskResponses",
     *     summary="Lists risk-responses",
     *     tags={"RiskResponses"},
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
     *         @OA\JsonContent(ref="#/components/schemas/RiskResponsePagingResource")
     *     )
     * )
     */
    public function index(Request $request)
    {
        $count = $request->input('count', 10);
        $riskResponses = RiskResponse::paginate($count);
        return RiskResponseResource::collection($riskResponses);
    }

    /**
     * @OA\Post(
     *     path="/api/risk-responses",
     *     operationId="storeRiskResponse",
     *     tags={"RiskResponses"},
     *     security={{"sanctum":{}}},
     *     summary="Adds a new risk-response",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/RiskResponseStoreRequest")
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/RiskResponseResource")
     *     )
     * )
     */

    public function store(RiskResponseStoreRequest $request)
    {
        $assessment = RiskResponse::create($request->all());
        return new RiskResponseResource($assessment);             
    }

    /**
     * @OA\Get(
     *      path="/api/risk-responses/{id}",
     *      tags={"RiskResponses"},
     *      operationId="showRiskResponse",
     *      security={{"sanctum":{}}},
     *      summary="Get RiskResponse information",
     *      description="Returns RiskResponse data",
     *      @OA\Parameter(
     *          name="id",
     *          description="RiskResponse id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/RiskResponseResource")
     *       )
     * )
     */
    public function show(RiskResponse $assessment)
    {
        return new RiskResponseResource($assessment);
    }
    

    /**
     * @OA\Put(
     *      path="/api/risk-responses/{id}",
     *      tags={"RiskResponses"},
     *      operationId="updateRiskResponse",
     *      security={{"sanctum":{}}},
     *      summary="Update RiskResponse information",
     *      description="Returns updated RiskResponse data",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/RiskResponseStoreRequest")          
     *         )
     *     ),
     *      @OA\Parameter(
     *          name="id",
     *          description="RiskResponse id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/RiskResponseResource")
     *       )
     * )
     */
    public function update(RiskResponseUpdateRequest $request, RiskResponse $assessment)
    {
        $assessment->update($request->validated());
        return new RiskResponseResource($assessment);
    }

    /**
     * @OA\Delete(
     *      path="/api/risk-responses/{id}",
     *      tags={"RiskResponses"},
     *      operationId="deleteRiskResponse",
     *      security={{"sanctum":{}}},
     *      summary="Delete RiskResponse",
     *      description="Deletes a single RiskResponse",
     *      @OA\Parameter(
     *          name="id",
     *          description="RiskResponse id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/RiskResponseResource")
     *       )
     * )
     */
    public function destroy(RiskResponse $assessment)
    {
        $assessment->delete();
        return new RiskResponseResource($assessment);
    }
}
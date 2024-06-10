<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssessmentStoreRequest;
use App\Http\Requests\AssessmentUpdateRequest;
use App\Http\Resources\AssessmentResource;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenApi\Annotations as OA;

/** 
 * @OAS\SecurityScheme(      
 *      securityScheme="sanctum",
 *      type="http",
 *      scheme="bearer"
 * )
 */
class AssessmentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/assessments",
     *     operationId="listAssessments",
     *     summary="Lists assessments",
     *     tags={"Assessments"},
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
     *         @OA\JsonContent(ref="#/components/schemas/AssessmentPagingResource")
     *     )
     * )
     */
    public function index(Request $request)
    {
        $count = $request->input('count', 10);
        $assessments = Assessment::paginate($count);
        return AssessmentResource::collection($assessments);
    }

    /**
     * @OA\Post(
     *     path="/api/assessments",
     *     operationId="storeAssessment",
     *     tags={"Assessments"},
     *     security={{"sanctum":{}}},
     *     summary="Adds a new assessment",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/AssessmentStoreRequest")
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/AssessmentResource")
     *     )
     * )
     */

    public function store(AssessmentStoreRequest $request)
    {
        $assessment = Assessment::create($request->all());
        return new AssessmentResource($assessment);
    }

    /**
     * @OA\Get(
     *      path="/api/assessments/{id}",
     *      tags={"Assessments"},
     *      operationId="showAssessment",
     *      security={{"sanctum":{}}},
     *      summary="Get Assessment information",
     *      description="Returns Assessment data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Assessment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AssessmentResource")
     *       )
     * )
     */
    public function show(Assessment $assessment)
    {
        return new AssessmentResource($assessment);
    }


    /**
     * @OA\Put(
     *      path="/api/assessments/{id}",
     *      tags={"Assessments"},
     *      operationId="updateAssessment",
     *      security={{"sanctum":{}}},
     *      summary="Update Assessment information",
     *      description="Returns updated Assessment data",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/AssessmentStoreRequest")          
     *         )
     *     ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Assessment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AssessmentResource")
     *       )
     * )
     */
    public function update(AssessmentUpdateRequest $request, Assessment $assessment)
    {
        $assessment->update($request->validated());
        return new AssessmentResource($assessment);
    }

    /**
     * @OA\Delete(
     *      path="/api/assessments/{id}",
     *      tags={"Assessments"},
     *      operationId="deleteAssessment",
     *      security={{"sanctum":{}}},
     *      summary="Delete Assessment",
     *      description="Deletes a single Assessment",
     *      @OA\Parameter(
     *          name="id",
     *          description="Assessment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AssessmentResource")
     *       )
     * )
     */
    public function destroy(Assessment $assessment)
    {
        $assessment->delete();
        return new AssessmentResource($assessment);
    }
}

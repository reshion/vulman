<?php

namespace App\Http\Controllers;

use App\Enums\AssessmentLifecycleStatus;
use App\Http\Requests\AssessmentStoreRequest;
use App\Http\Requests\AssessmentUpdateRequest;
use App\Http\Resources\AssessmentResource;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;
use Termwind\Components\Li;

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
        $assessment->company_ref_id = $request->user()->company_id;
        $assessment->save();
        return new AssessmentResource($assessment);
    }

     /**
     * @OA\Post(
     *     path="/api/assessments/store-assessment/vulnerability",
     *     operationId="storeAssessmentVulnerability",
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
     *     @OA\Parameter(
     *         name="vulnerability_id",
     *         in="query",
     *         description="Vulnerability id",
     *         required=true,
     *         @OA\Schema(type="integer", default=10)
     *     ),

     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/AssessmentResource")
     *     )
     * )
     */

     public function storeAssessmentVulnerability(AssessmentStoreRequest $request)
     {
        $companyId = $request->user()->company_id;
         // Validierung der Anforderung
         $validator = Validator::make($request->all(), [
             'vulnerability_id' => 'required|integer',
             'asset_id' => 'nullable|integer',
             'company_id' => 'nullable|integer',
             'system_group_id' => 'nullable|integer',
         ]);
 
         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 422);
         }
 
         // Sicherstellen, dass einer der optionalen Fremdschlüssel übermittelt wird
         if (!$request->hasAny(['asset_id', 'company_id', 'system_group_id'])) {
             return response()->json(['error' => 'Either asset_id, company_id, or system_group_id must be provided.'], 422);
         }

         // Check if assessment already exists
        $assessment = Assessment::where('vulnerability_id', $request->input('vulnerability_id'))
            ->where('company_ref_id', $companyId)               
            ->first();
            
        if (!$assessment) {
            // Create new assessment if it does not exist
            $assessment = new Assessment();
        }
        
         $assessment->company_ref_id = $companyId; // This is the company id of the user
         $assessment->name = $request->name;
         $assessment->lifecycle_status = $request->lifecycle_status;
         $assessment->vulnerability_id = $request->input('vulnerability_id');
         $assessment->asset_id = $request->input('asset_id');
         $assessment->company_id = $request->input('company_id'); // This is the company id of the assessment
         $assessment->system_group_id = $request->input('system_group_id');
         $assessment->save();
 
         // Rückgabe der Ressource
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
     * @OA\POST(
     *     path="/api/assessments/find",
     *     operationId="findAssessments",
     *     summary="Find assessments by vulnerability id, asset id, system group id, company id",
     *     tags={"Assessments"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="vulnerability_id",
     *         in="query",
     *         description="Vulnerability id",
     *         required=true,
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Parameter(
     *         name="asset_id",
     *         in="query",
     *         description="Asset id",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="system_group_id",
     *         in="query",
     *         description="System group id",
     *         required=false,
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Parameter(
     *         name="company_id",
     *         in="query",
     *         description="Company id",
     *         required=false,
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/AssessmentResource")
     *     )
     * )
     */
    public function find(Request $request)
    {
        Log::info('find method called');
        
        $companyRefId = $request->user()->company_id;

        $vulnerabilityId = $request->input('vulnerability_id');
        $assetId = $request->input('asset_id');
        $systemGroupId = $request->input('system_group_id');
        $companyId = $request->input('company_id');
    
        $assessments = Assessment::where('vulnerability_id', $vulnerabilityId)
            ->where('company_ref_id', $companyRefId)
            ->when($assetId, function ($query, $assetId) {
                return $query->where('asset_id', $assetId);
            })
            ->when($systemGroupId, function ($query, $systemGroupId) {
                return $query->where('system_group_id', $systemGroupId);
            })
            ->when($companyId, function ($query, $companyId) {
                return $query->where('company_id', $companyId);
            })
            ->get();
    
        return AssessmentResource::collection($assessments);
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

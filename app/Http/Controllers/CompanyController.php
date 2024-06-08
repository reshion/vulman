<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

/** 
 * @OAS\SecurityScheme(      
 *      securityScheme="sanctum",
 *      type="http",
 *      scheme="bearer"
 *      description="Bearer 4|oeXad4kChJT43wli90LOd1VbFhtuGuEdvxvEHMAtcb025185",
 * )
 */
class CompanyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/companies",
     *     operationId="listCompanies",
     *     summary="Lists companies",
     *     tags={"Companies"},
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
     *         @OA\JsonContent(ref="#/components/schemas/CompanyPagingResource")
     *     )
     * )
     */
    public function index(Request $request)
    {
        $count = $request->input('count', 10);
        $companies = Company::with('tenant')->paginate($count);
        return CompanyResource::collection($companies);
    }

    /**
     * @OA\Post(
     *     path="/api/companies",
     *     tags={"Companies"},
     *     operationId="storeCompany",
     *     security={{"sanctum":{}}},
     *     summary="Adds a new company",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/CompanyStoreRequest")
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/CompanyResource")
     *     )
     * )
     */
    public function store(CompanyStoreRequest $request)
    {
        $company = Company::create($request->validated());
        return new CompanyResource($company);
    }

    /**
     * @OA\Get(
     *      path="/api/companies/{id}",
     *      tags={"Companies"},
     *      operationId="showCompany",
     *      security={{"sanctum":{}}},
     *      summary="Get Company information",
     *      description="Returns Company data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CompanyResource")
     *       )
     * )
     */
    public function show(Company $company)
    {
        return new CompanyResource($company->load('tenant.company'));
    }

    /**
     * @OA\Put(
     *      path="/api/companies/{id}",
     *      tags={"Companies"},
     *      operationId="updateCompany",
     *      security={{"sanctum":{}}},
     *      summary="Update Company information",
     *      description="Returns Company data",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/CompanyUpdateRequest")          
     *         )
     *     ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CompanyResource")
     *       )
     * )
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company->update($request->validated());
        return new CompanyResource($company);
    }

    /**
     * @OA\Delete(
     *      path="/api/companies/{id}",
     *      tags={"Companies"},
     *      operationId="destroyCompany",
     *      security={{"sanctum":{}}},
     *      summary="Delete Company",
     *      description="Returns deleted Company data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CompanyResource")
     *       )
     * )
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return new CompanyResource($company);
    }
}

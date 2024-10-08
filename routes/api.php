<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\RiskResponseController;
use App\Http\Controllers\ScanImportJobController;
use App\Http\Controllers\SystemGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\VulnerabilityController;

Route::post('/user/login', [UserController::class, 'login'])->withoutMiddleware(['auth:sanctum']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    // User Routes
    Route::get('/user/current', [UserController::class, 'current']);
    Route::post('/user/logout', [UserController::class, 'logout']);

    // Tenant Routes
    Route::apiResource('tenants', TenantController::class);
    // Company Routes
    Route::apiResource('companies', CompanyController::class);
    // Asset Routes
    Route::apiResource('assets', AssetController::class);
    Route::get('assets/vulnerability/{vulnerabilityId}', [AssetController::class, 'getAssetsByVulnerability']);
    Route::get('assets/system-group/{systemGroupId}', [AssetController::class, 'getAssetsBySystemGroup']);
    Route::post('assets/list-all', [AssetController::class, 'listAll']);

    // Assessment Routes
    Route::apiResource('assessments', AssessmentController::class);
    Route::post('/assessments/find', [AssessmentController::class, 'find']);
    Route::post('/assessments/store-assessment/vulnerability', [AssessmentController::class, 'storeAssessmentVulnerability']);

    // Scan Import Job Routes
    Route::apiResource('scan-import-jobs', ScanImportJobController::class);
    // Vulnerability Routes
    Route::apiResource('vulnerabilities', VulnerabilityController::class);
    Route::get('vulnerabilities/base-severity/system-group/{systemGroupId}', [VulnerabilityController::class, 'getBaseSeverityBySystemGroup']);
    Route::get('vulnerabilities/base-severity/asset/{assetId}', [VulnerabilityController::class, 'getBaseSeverityByAsset']);
    Route::get('vulnerabilities/asset/{assetId}', [VulnerabilityController::class, 'getVulnerabilitiesByAsset']);
    Route::get('vulnerabilities/system-group/{systemGroupId}', [VulnerabilityController::class, 'getVulnerabilitiesBySystemGroup']);
    Route::get('vulnerabilities/company', [VulnerabilityController::class, 'getByCompany']);
    Route::get('vulnerabilities/company/asset-count/', [VulnerabilityController::class, 'getByCompanyWithAssetCount']);
    // System Group Routes
    Route::apiResource('system-groups', SystemGroupController::class);
    // Remove Asset from System Group
    Route::delete('system-groups/{id}/asset/{assetId}', [SystemGroupController::class, 'removeAsset']);
    // Add Asset to System Group
    Route::post('system-groups/{id}/asset/{assetId}', [SystemGroupController::class, 'addAsset']);
    // Get unassigned assets
    Route::get('system-groups/{id}/assets/unassigned', [SystemGroupController::class, 'getUnassignedAssets']);



    Route::post('/import/scan-results', [ImportController::class, 'importScanResults']);
});

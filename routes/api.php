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
    // Assessment Routes
    Route::apiResource('assessments', AssessmentController::class);
    // Scan Import Job Routes
    Route::apiResource('scan-import-jobs', ScanImportJobController::class);
    // Vulnerability Routes
    Route::apiResource('vulnerabilities', VulnerabilityController::class);
    Route::get('vulnerabilities/base-severity/system-group/{systemGroupId}', [VulnerabilityController::class, 'getBaseSeverityBySystemGroup']);
    Route::get('vulnerabilities/base-severity/asset/{assetId}', [VulnerabilityController::class, 'getBaseSeverityByAsset']);
    Route::get('vulnerabilities/company', [VulnerabilityController::class, 'getByCompany']);
    Route::get('vulnerabilities/company/asset-count/', [VulnerabilityController::class, 'getByCompanyWithAssetCount']);
    // System Group Routes
    Route::apiResource('system-groups', SystemGroupController::class);


    Route::post('/import/scan-results', [ImportController::class, 'importScanResults']);
});

<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RiskResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\VulnerabilityController;

Route::post('/user/login', [UserController::class, 'login']);


Route::group(['middleware' => 'auth:sanctum'], function () {

    // User Routes
    Route::get('/user/current', [UserController::class, 'current']);

    // Tenant Routes
    Route::apiResource('tenants', TenantController::class);
    // Company Routes
    Route::apiResource('companies', CompanyController::class);
    // Asset Routes
    Route::apiResource('assets', AssetController::class);
    // Assessment Routes
    Route::apiResource('assessments', AssessmentController::class);
    // Risk Response Routes
    Route::apiResource('risk-responses', RiskResponseController::class);
    // Vulnerability Routes
    Route::apiResource('vulnerabilities', VulnerabilityController::class);

});

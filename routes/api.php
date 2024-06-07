<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TenantController;


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
});

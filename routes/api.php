<?php

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
    Route::apiResource('companies', CompanyController::class);
});

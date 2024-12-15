<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\GovernanceController;

use App\Models\Governance;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Note that we are not using Laravel Sanctum, no need to generate API tokens for this project

Route::middleware('auth:api')->get('/governance-bugdets',[GovernanceController::class,'index']);

Route::middleware('auth:api')->get('/governance-budgets/{governance}',[GovernanceController::class,'show']);

Route::middleware('auth:api')->post('/governance-budgets',[GovernanceController::class,'store']);

<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\FinanceController;

use App\Models\Finance;

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

Route::middleware('auth:api')->get('/research-finance',[FinanceController::class,'index']);

Route::middleware('auth:api')->get('/research-finance/{finance}',[FinanceController::class,'show']);

/*  Note that only the 'staff_comment' field value and no other fields in a Finance table row can be updated by a staff member. 
	No rows in this table can be deleted.
*/
Route::middleware('auth:api')->put('/research-finance/{finance}',[FinanceController::class,'update']);


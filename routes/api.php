<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('employee','ApiController@employee');
Route::post('/login/check','ApiController@check');
Route::get('/other', [App\Http\Controllers\OtherController::class, 'other'])->name('other');


Route::get('doctor','ApiController@doctor');

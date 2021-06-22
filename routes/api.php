<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\MaterialController;
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

Route::group(['prefix' => 'clients'], function() {
    Route::post('/register', [ClientController::class, 'registerNewClient']);

    Route::post('/authenticate', [ClientController::class, 'authenticate']);

    Route::get('/', [ClientController::class,'listAllClients']);

});


Route::group(['prefix' => 'materiais'], function (){
    Route::get('lista', [MaterialController::class, 'index']);
    Route::post('create', [MaterialController::class, 'store']);
});


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

    //Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //    return $request->user();
    //});
    //    Route::middleware('auth_api')->get('/user/{id}', function (Request $request, $id) {
    //        $user = \App\Models\User::find($id);
    //        if (!$user) return response('', 404);
    //
    //        return $user;
    //    });
    Route::get('tickets', [\App\Http\Controllers\PostController::class, 'getPost']);


    Route::middleware('auth_api')->post('sendticket', [\App\Http\Controllers\PostController::class, 'sendPost']);

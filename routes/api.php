<?php

use App\Http\Controllers\Api\HomeController;
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

Route::middleware(['auth:sanctum', 'jsonResponse'])->get('/user', function (Request $request) {
    return $request->user();
    // return 'hi';
});

Route::post('login', 'Auth\ApiAuthController@login');
// Route::get('hi', function(){
//     return response()->json(['message'=>'hi']);
// });

Route::group(['middleware' => ['auth:sanctum', 'jsonResponse']], function(){

    Route::post('/projects/{project:id}/start', 'Api\EntryController@start');
    Route::patch('/projects/{project}/stop', 'Api\EntryController@stop');

    Route::apiResource('projects', 'Api\ProjectController');

    Route::get('home', 'Api\HomeController');
    Route::get('/', 'Api\HomeController');
});

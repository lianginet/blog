<?php

//use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;

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

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function (Router $api) {
    $api->group([
        'namespace' => 'App\Http\Controllers\Front\V1'
    ], function (Router $api) {
        $api->get('init', 'IndexController@init');
    });
});
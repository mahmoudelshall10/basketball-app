<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['namespace'=>'Api\V1'],function(){
	Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

	], function ($router) {

	    Route::post('login', 'AuthController@login');
	    Route::post('logout', 'AuthController@logout');
	    Route::post('refresh', 'AuthController@refresh');
	    Route::post('me', 'AuthController@me');
	    

	});
	Route::get('getNews', 'IndexController@getNews')->middleware('auth:api');
	Route::get('homeData', 'IndexController@homeData')->middleware('auth:api');
	Route::get('getQuestion', 'IndexController@getQuestion')->middleware('auth:api');
	Route::get('finishExam', 'IndexController@finishExam')->middleware('auth:api');
	Route::get('show-all-matches','GeneralController@showAllMatches');
	Route::post('reportPersonal','GeneralController@reportPersonal');
	Route::post('match-acceptance','GeneralController@storeAccept');
	Route::post('match-decline','GeneralController@storeDecline');
	Route::post('match-confirmation','GeneralController@storeMatchConfirmation');
	Route::post('report','GeneralController@report');
	Route::post('scoresheetimage/{id}','GeneralController@scoreSheetImage');

});
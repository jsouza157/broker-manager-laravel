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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::group(['prefix' => 'v1'], function($r) {
	#-> PROPERTIES

	$r->get('teste', function() {
		dd('teste');
	});

	$r->get('/properties/{per_page?}', 'Api\\PropertyController@show');
	$r->get('/property/{id}', 'Api\\PropertyController@showProperty');

	#-> CONTACTS
	$r->post('/contact/create', 'Api\\ContactsController@store');
});


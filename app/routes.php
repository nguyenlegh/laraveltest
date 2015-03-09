<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');
Route::get('/map', 'MapController@indexAction');
Route::get('/upload-demo', 'UploadDemoController@indexAction');
Route::post('/upload', 'UploadDemoController@uploadAction');

Route::any('/hello/{name?}', function($name = 'Nguyen')
{
	return "Hello {$name}";
});

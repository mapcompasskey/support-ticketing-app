<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
	return view('index');
});

// Organizations
Route::get('organizations', 'OrganizationsController@index');
Route::get('organizations/create', 'OrganizationsController@create');
Route::get('organizations/{id}', 'OrganizationsController@show');
Route::get('organizations/{id}/edit', 'OrganizationsController@edit');
Route::get('organizations/{id}/destroy', 'OrganizationsController@destroy');
Route::post('organizations', 'OrganizationsController@store');
Route::post('organizations/{id}', 'OrganizationsController@update');

// Tickets
Route::get('tickets', 'TicketsController@index');
Route::get('tickets/create', 'TicketsController@create');
Route::get('tickets/create/organization/{id}', 'TicketsController@createFromOrganization');
Route::get('tickets/{id}', 'TicketsController@show');
Route::get('tickets/{id}/edit', 'TicketsController@edit');
Route::get('tickets/{id}/destroy', 'TicketsController@destroy');
Route::post('tickets', 'TicketsController@store');
Route::post('tickets/{id}', 'TicketsController@update');

//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);

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
Route::resource('oauth', 'OAuthController');
Route::resource('user', 'UserController');
Route::resource('venues', 'VenueController');
Route::resource('session', 'SessionController');
Route::resource('wifipoints', 'WifiPointController');
Route::resource('checkin', 'CheckinController');

Route::get('/facebook', 'OAuthController@loginWithFacebook');
Route::get('/venues', 'VenueController@index');
Route::get('/venue/{id}', 'VenueController@show');
Route::get('/logout', 'SessionController@destroy');
Route::get('/wifipoints', 'WifiPointController@index');
Route::get('/wifipoints/{id}', 'WifiPointController@show');
Route::get('/checkin/{venue_id}', "CheckinController@store");
Route::get('/', function()
{
	return View::make('users.new');
});
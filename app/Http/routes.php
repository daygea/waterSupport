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

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('autocomplete', 'HomeController@autocomplete')->name('autocomplete');
Route::get('new_ticket', 'TicketsController@create');
Route::post('new_ticket', 'TicketsController@store');
Route::get('new_product', 'ProductsController@create');
Route::post('new_product', 'ProductsController@store');
Route::get('new_customer', 'CustomersController@create');
Route::post('new_customer', 'CustomersController@store');
Route::get('edit_customer/{id}', 'CustomersController@edit');
Route::post('edit_customer', 'CustomersController@update');
Route::get('tickets/{ticket_id}', 'TicketsController@show');
Route::get('tickets/print/{ticket_id}', 'TicketsController@print');
Route::get('products/{product_id}', 'ProductsController@show');
Route::get('my_tickets', 'TicketsController@userTickets');

Route::get('new_zone', 'ZonesController@create');
Route::post('new_zone', 'ZonesController@store');
Route::get('edit_zone/{id}', 'ZonesController@edit');
Route::post('edit_zone', 'ZonesController@update');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
	Route::get('tickets', 'TicketsController@index');
	Route::get('customers', 'CustomersController@index');
	Route::get('products', 'ProductsController@index');
	Route::get('products/{id}', 'ProductsController@edit');
	Route::post('products', 'ProductsController@update');
	Route::get('categories', 'CategoriesController@index');
	Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
	Route::get('zones', 'ZonesController@index');
});

Route::post('comment', 'CommentsController@postComment');

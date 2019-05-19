<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| These routes controls the dashboard and handles payment requests and 
| creating charges with stripe!
|
*/


Route::group(['middleware' => ['web']], function () {
	Auth::routes();

	//Route for viewing the dashboard
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	//Route for connecting to Stripe
	Route::get('/stripe-connect', 'DashboardController@stripeConnect')->name('stripeConnect');

	//Route for getting a payment request
	Route::get('/pay/{user_name}/{user_id}/{charge_id}', 'DashboardController@getPayment')->name('getPayment');

	//Route for creating a payment request
	Route::post('/pay/{user_id}', 'DashboardController@createPayment')->name('createPayment');

	//Route for creating a payment request/link
	Route::post('/dashboard/create-payment-link', 'DashboardController@createPaymentLink')->name('createPaymentLink');
	//Route for viewing details of an already created payment request/link
	Route::get('/dashboard/charge/{charge_id}', 'DashboardController@getPaymentLink')->name('getPaymentLink');

	//Route for deleting payment request/link
	Route::post('/dashboard/charge/{charge_id}/delete', 'DashboardController@deletePaymentLink')->name('deletePaymentLink');

	//Route creating a direct charge
	Route::any('/pay/{user_name}/{user_id}', 'DashboardController@directChargeUser')->name('directChargeUser');
});

<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*Route::bind('accounts', function($subdomain) {
  //dd(Auth::check());
  $currentAccount = App\Account::where('subdomain', $subdomain)->first();
  //$currentAccount = App\Account::where('subdomain', $subdomain)->first();
  /// TODO: check the account whether logged in user is having membership in it.

  return $currentAccount;
});*/

Route::group(['middleware' => 'web'], function () {

    Route::get('/', function () {
        return view('welcome');
    });
    Route::auth();
    Route::group(['middleware' => 'auth'], function() {
      //Route::get('/home', 'HomeController@index');
      Route::get('/account/change', 'AccountController@change');
      Route::get('/account/switch/{subdomain}', 'AccountController@switchAccount');
      Route::get('/account/register', 'AccountController@create');
      Route::post('/account/register', 'AccountController@store');

      //Route::group(['middleware' => 'account.verify'], function () { //, 'prefix' => 'accounts/{accounts}'
      //Route::group(['domain' => '{accounts}.alotracker.dev'], function() {
        Route::get('/dashboard', 'AccountController@dashboard');
        //Route::get('/invite/create', 'InvitationController@create');
        //Route::post('/invite', 'InvitationController@store');
        //Route::get('/invite/accept', 'InvitationController@accept');
        Route::resource('users', 'UserController');
        Route::resource("clients","ClientController");
        Route::resource('projects', 'ProjectController');
        Route::resource('tickets', 'TicketController');
        
        Route::group([
          'prefix' => 'master_datas/{masterType}',
          'where' => ['masterType' => 'ticket_categories']
        ], function() {
          Route::get('/', 'MasterDataController@index');
          Route::post('/', 'MasterDataController@store');
          Route::put('/{id}', 'MasterDataController@update');
          Route::delete('/{id}', 'MasterDataController@destroy');
        });
      //});
    });
});

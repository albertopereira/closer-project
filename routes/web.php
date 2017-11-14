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
    return view('welcome');
});

Auth::routes();

Route::get('/home/entity/create', 'EntityController@create');
Route::post('/home/entity/create', 'EntityController@store');
Route::get('/home/entity/{entity}', 'EntityController@edit');
Route::patch('/home/entity/{entity}', 'EntityController@update');
Route::delete('/home/entity/{entity}', 'EntityController@destroy')->name('entities.destroy');

Route::get('/home/budget_types/create/{entity}', 'BudgetTypeController@create');
Route::post('/home/budget_types/create', 'BudgetTypeController@store');
Route::get('/home/budget_types/{budget_type}', 'BudgetTypeController@edit');
Route::patch('/home/budget_types/{budget_type}', 'BudgetTypeController@update');
Route::post('/home/budget_types/{budget_type}', 'BudgetTypeController@updateData')->name('budget_types.updateData');
Route::delete('/home/budget_types/{budget_type}', 'BudgetTypeController@destroy')->name('budget_types.destroy');

Route::post('/home/views/{view}', 'ViewController@updateData')->name('views.updateData');
Route::delete('/home/views/{view}', 'ViewController@destroy')->name('views.destroy');

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home/{entity}', 'HomeController@show');
Route::get('/home/{entity}/{budget_type?}', 'HomeController@show');


// Route::get("/view/{page?}/{year?}/{mode?}/{node?}", function(){
//    return View::make("views.main");
// });

Route::get("/view/{budget}/{view}/{page?}/{year?}/{mode?}/{node?}", 'ViewController@show');

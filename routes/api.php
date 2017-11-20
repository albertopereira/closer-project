<?php

use Illuminate\Http\Request;
use \App\BudgetType;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['api','cors']], function () {
    
    Route::get('view/{budget}', function (BudgetType $budget) {
        $t = str_replace("\"sub\"","\"children\"",$budget->data);
        return $t;
    });

    Route::get('view/{budget}/{view}', function (BudgetType $budget, $view) {
        $v = $budget->views[$view - 1];
        $ret = json_decode($budget->data);
        $ret->view = json_decode($v->data);

        $t = str_replace("\"sub\"","\"children\"",json_encode($ret));
        return $t;
    });

});
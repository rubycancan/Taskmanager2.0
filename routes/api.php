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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//测试数据
Route::get('project', 'Api\ProjectsApiController@getProject');
//end

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {

    Route::name('api.')->group(function () {
        Route::get('tasks/search', 'TasksApiController@search')->name('tasks.search');

        Route::get('tasks/{task}/steps', 'StepApiController@index')->name('tasks.steps.index');

        Route::delete('tasks/{task}/steps/clear', 'StepApiController@clear')->name('tasks.steps.clear');

        Route::post('tasks/{task}/steps', 'StepApiController@store')->name('tasks.steps.store');

        Route::delete('tasks/{task}/steps/{step}', 'StepApiController@destroy')->name('tasks.steps.destroy');

        Route::patch('tasks/{task}/steps/{step}', 'StepApiController@update')->name('tasks.steps.update');

        Route::patch('tasks/{task}/steps/{step}/toggle', 'StepApiController@toggle')->name('tasks.steps.toggle');

        Route::post('tasks/{task}/steps/complete', 'StepApiController@completeAll')->name('tasks.steps.complete');
    });
});

//在分组里重构以下路由
//Route::get('tasks/{task}/steps', 'Api\StepApiController@index')->name('api.tasks.steps.index');
//
//Route::delete('tasks/{task}/steps/clear', 'Api\StepApiController@clear')->name('api.tasks.steps.clear');
//
//Route::post('tasks/{task}/steps', 'Api\StepApiController@store')->name('api.tasks.steps.store');
//
//Route::delete('tasks/{task}/steps/{step}', 'Api\StepApiController@destroy')->name('api.tasks.steps.destroy');
//
//Route::patch('tasks/{task}/steps/{step}', 'Api\StepApiController@update')->name('api.tasks.steps.update');
//
//Route::post('tasks/{task}/steps/complete', 'Api\StepApiController@completeAll')->name('api.tasks.steps.complete');


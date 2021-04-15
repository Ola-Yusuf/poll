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
    return "$request->user()";
});

// Route::get('/polls', 'PollController@index');
Route::get('/poll/{id}', 'PollController@show');
Route::post('/polls', 'PollController@store');
Route::put('/poll/{poll}', 'PollController@update');
Route::delete('/poll/{poll}', 'PollController@destroy');
Route::any('errors', 'PollController@errors');
Route::apiResource('question', 'QuestionController');
Route::get('/poll/{poll}/question', 'PollController@question');
Route::get('/file/get', 'FilesController@show');
Route::post('/file/create', 'FilesController@create');

Route::group(['middleware'  =>  ['apiToken', 'httpheaders:Come Work With Them!']], function () {
    Route::group(['prefix'  =>  'v1'], function () {
        Route::get('/polls', 'PollController@index');
    });
});

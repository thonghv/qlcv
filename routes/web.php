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
    return redirect('/login');
});


Auth::routes();
Route::resource('todo','TodoController');


    Route::get('/taskdetail/{id_todo}','TaskDetailController@index');
    Route::post('/taskdetail/create','TaskDetailController@store');
    Route::post('/taskdetail/updateUserManage','TaskDetailController@updateUserManage');
    Route::post('/taskdetail/removeTask','TaskDetailController@removeTask');
    Route::put('/taskdetail/{id_task_detail}','TaskDetailController@update');
    Route::delete('/taskdetail/{id_task_detail}','TaskDetailController@destroy');

Route::post('/taskdetail/success','TaskDetailController@success');

Route::post('/taskdetail/comment','TaskDetailCommentController@store');

Route::post('/taskdetail/reject','TaskDetailReportController@reject');
Route::post('/taskdetail/report','TaskDetailReportController@report');
Route::post('/taskdetail/removecv','TaskDetailReportController@removecv');


Route::post('/taskdetail/report/{id_task_detail}','TaskDetailReportController@report');

Route::get( '/download/{filename}/{name}', 'TaskDetailController@download');

Route::resource('home','TodoController');

Route::get('/kpi','KPIReportController@index');
Route::post('/kpi/report','KPIReportController@report');

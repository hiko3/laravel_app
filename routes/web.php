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
Route::resource('todo', 'TodoController');
// 様々なアクションを処理する、複数のルートがこの１定義により生成

// Route::get('todo', ‘todoController@index');
// Route::post('todo', 'todoController@store');
// Route::get('todo/create', 'todoController@create');
// Route::get('todo/:id', 'todoController@show');
// Route::put('todo/:id', 'todoController@update');
// Route::delete('todo/:id', 'todoController@destroy');
// Route::get('todo/:id/edit', 'todoController@edit');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

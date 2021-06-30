<?php

use Illuminate\Support\Facades\Route;

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

/**
 * Students All Route
 * Student Features
 */

Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'student'], function (){
    Route::get('/', 'StudentController@index') -> name('student.index');
    Route::post('/store', 'StudentController@store') -> name('student.store');
    Route::get('/all', 'StudentController@all') -> name('student.all');
    Route::get('/show/{id}', 'StudentController@show') -> name('student.show');
    Route::delete('/delete/{id}', 'StudentController@delete') -> name('student.delete');
    Route::get('/edit/{id}', 'StudentController@edit') -> name('student.edit');
    Route::post('/update/{id}', 'StudentController@update') -> name('student.update');
});

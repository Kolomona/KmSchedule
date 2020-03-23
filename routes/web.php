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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); //Home just redirects to current schedule TODO:remove 
// Route::get('/schedule/{id}', 'ScheduleController@index')->name('index');

Route::get('schedule/print/{id}', 'ScheduleController@print')->name('schedule.print');
Route::resource('schedule', 'ScheduleController');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController');
});








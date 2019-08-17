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
    return view('index');
})->middleware('auth');

Route::get('salary/' , 'salaryController@index')->name('salary');

Route::resource('attend/', 'attendController');
Route::post('depart/', 'attendController@depart')->name('depart.attend');
Route::get('attend/{id}', 'attendController@editatt')->name('edit.attend');

Route::get('attend/edit/{id}', 'attendController@edit')->name('ed.attend');
Route::post('attend/update/{id}', 'attendController@update')->name('up.attend');

Route::post('attend/{id}', 'attendController@updateatt')->name('update.attend');
Route::get('delattend/{id}', 'attendController@destroyatt')->name('delete.attend');


Route::resource('dayho/', 'dayholyController');
Route::get('day/{id}', 'dayholyController@editday')->name('edit.day');
Route::post('day/{id}', 'dayholyController@updateday')->name('update.day');
Route::get('delday/{id}', 'dayholyController@destroyday')->name('delete.day');


Route::resource('weekho/', 'weekholyController');
Route::get('week/{id}', 'weekholyController@editweek')->name('edit.week');
Route::post('week/{id}', 'weekholyController@updateweek')->name('update.week');
Route::get('delweek/{id}', 'weekholyController@destroyweek')->name('delete.week');


Route::resource('setting/', 'settingController');
Route::get('setting/{id}', 'settingController@editset')->name('edit.set');
Route::post('setting/{id}', 'settingController@updateset')->name('update.set');
Route::get('delset/{id}', 'settingController@destroyset')->name('delete.set');

Route::get('/month' , 'employeeConttroller@get_month')->name('month.emplo');

//route for employee
Route::prefix('employee')->group(function(){
    
    Route::get('/' , 'employeeConttroller@index')->name('index.emplo');
	Route::get('/create' , 'employeeConttroller@create')->name('create.emplo');
	Route::post('/create' , 'employeeConttroller@store')->name('store.emplo');
	Route::get('/edit/{id}' , 'employeeConttroller@edit')->name('edit.emplo');
	Route::post('/edit/{id}' , 'employeeConttroller@update')->name('update.emplo');
	Route::get('/delete/{id}' , 'employeeConttroller@destroy')->name('destroy.emplo');
	Route::get('/salary/{id}' , 'employeeConttroller@salary')->name('salary.emplo');

}); 

//route for employee
Route::prefix('dateattend')->group(function(){
    
    Route::get('/' , 'dateattendController@index')->name('index.daatt');
	Route::get('/create' , 'dateattendController@create')->name('create.daatt');
	Route::post('/create' , 'dateattendController@store')->name('store.daatt');
	Route::get('/edit/{id}' , 'dateattendController@edit')->name('edit.daatt');
	Route::post('/edit/{id}' , 'dateattendController@update')->name('update.daatt');
	Route::get('/delete/{id}' , 'dateattendController@destroy')->name('destroy.daatt');

}); 


Route::get('profile/' , 'profileController@index')->name('index.profile');
Route::get('profile/edit' , 'profileController@edit')->name('edit.profile');
Route::post('profile/update' , 'profileController@update')->name('update.profile');
Route::get('profile/pass' , 'profileController@editpass')->name('pass.profile');
Route::post('profile/pass' , 'profileController@updatepass')->name('uppass.profile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

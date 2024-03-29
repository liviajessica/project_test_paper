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

Mohon maaf sebelumnya, seharusnya menurut kaidah jwt auth, harusnya Route dashboard, account, dan transaction dimasukkan kedalam group 'middleware' => 'jwt.auth', tetapi saya kurang memahami untuk jwt bearer token ketika di set kedalam header laravel. Saya akan berusaha mencari tahu dan belajar kembali untuk mendalami laravel jwt auth ini. Saya dapat menampilkan token melalui response json saja. Untuk handle jwt pun sudah dapat berjalan secara sisi back end. Saya memindahkan Route dibawah ini bertujuan untuk melihat fitur lain selain dari login register. Terima kasih atas perhatiannya.

*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'UserController@index');
Route::post('/auth/login', 'UserController@login');
Route::get('/auth/create', 'UserController@create');
Route::post('/auth/register', 'UserController@register');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/auth/logout', 'UserController@logout');
    Route::get('/user', 'UserController@getAuthUser');
});

Route::get('/dashboard', 'Controller@dashboard');

Route::get('/account', 'Finance\AccountController@index');
Route::get('/account/create', 'Finance\AccountController@create');
Route::post('/account/store', 'Finance\AccountController@store');
Route::get('/account/{financeAccount}/detail', 'Finance\AccountController@show');
Route::get('/account/{financeAccount}', 'Finance\AccountController@edit');
Route::patch('/account/{financeAccount}/update', 'Finance\AccountController@update');
Route::delete('/account/{financeAccount}/delete', 'Finance\AccountController@destroy');
Route::post('/account/restore', 'Finance\AccountController@restoreAll');

Route::get('/transaction', 'Finance\TransactionController@index');
Route::get('/transaction/create', 'Finance\TransactionController@create');
Route::post('/transaction/store', 'Finance\TransactionController@store');
Route::get('/transaction/{financeTransaction}/detail', 'Finance\TransactionController@show');
Route::get('/transaction/{financeTransaction}', 'Finance\TransactionController@edit');
Route::patch('/transaction/{financeTransaction}/update', 'Finance\TransactionController@update');
Route::delete('/transaction/{financeTransaction}/delete', 'Finance\TransactionController@destroy');
Route::post('/transaction/restore', 'Finance\TransactionController@restoreAll');

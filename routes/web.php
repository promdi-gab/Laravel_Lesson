<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\artistController;
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

//Route::get('/album','AlbumController@index');

//Route::get('/album/create','AlbumController@create')->name('album.create'); // option1

//Route::post('/album/store',['uses' => 'AlbumController@store','as' => 'album.store']); //option2
//Route::get('/album/edit/{id}','AlbumController@edit')->name('album.edit');

//Route::post('/album/update{id}',['uses' => 'AlbumController@update','as' => 'album.update']); 

//Route::get('/album/delete/{id}',['uses' => 'AlbumController@delete','as' => 'album.delete']);

//Route::resource("customer", CustomerController::class);

Route::group(['middleware' => ['auth']], function(){
Route::get('/customer/restore/{id}', ['uses' => 'CustomerController@restore', 'as' => 'customer.restore']);
Route::resource('album', 'AlbumController');
Route::resource('artist', 'artistController');
Route::resource('customer', 'CustomerController');
//Route::resource("/artist", artistController::class);
Route::resource('listener', 'listenerController');
});
//testing

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
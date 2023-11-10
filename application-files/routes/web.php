<?php

use App\Http\Controllers\System\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
     return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([ 'prefix' => 'system', 'middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
});


// Route::resource('users', UserController::class);
/* SAMPLE ON HOW TO USE ROUTE NAMES
Route::resource('users', UserController::class)->names([
    'index'   => 'users.index',
    'create'  => 'users.create',
    'store'   => 'users.store',
    'show'    => 'users.show',
    'edit'    => 'users.edit',
    'update'  => 'users.update',
    'destroy' => 'users.destroy',
]); */

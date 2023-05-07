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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(
    ['register' => false]
);

Route::group(['middleware' => ['CheckIfAdmin', 'auth', 'caffeinated']], function () {
    Route::group(['namespace' => 'Admin'], function () {
        // admin index
        Route::get('/admin', function () {
            return view('admin.index');
        })->name('admin');

        // users
        Route::resource('/admin/users', 'UserController');

        // categories
        Route::resource('/admin/categories', 'CategoryController');

        // posts
        Route::resource('/admin/posts', 'PostController');

        // pages
        Route::resource('/admin/pages', 'PageController');
    });
});

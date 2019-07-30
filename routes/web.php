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

Route::group(['namespace' => 'Content'], function () {
    // homepage
    Route::get('/', 'IndexController@index')->name('index');

    // pages
    Route::get('/page/{slug}.html', 'PageController@index')->name('pages');

    // posts
    Route::get('/{slug}.html', 'PostController@index')->name('posts');

    // categories
    Route::get('/category/{slug}.html', 'CategoryController@index')->name('category');

    // tags
    Route::get('/tag/{slug}.html', 'TagController@index')->name('tags');

    // sitemap
    Route::get('/sitemap.xml', 'SitemapController@sitemap');

    // search
    Route::get('/search', 'SearchController@index')->name('search');
});

Auth::routes(
    ['register' => false],
    ['logout' => '\App\Http\Controllers\Auth\LoginController@logout']
);

Route::group(['middleware' => ['CheckIfAdmin', 'auth']], function () {
    Route::group(['namespace' => 'Admin'], function () {
        // admin index
        Route::get('/admin', function () {
            return view('/admin/index');
        })->name('admin');

        // site settings
        Route::get('/admin/settings', 'SettingsController@index')->name('admin/settings');
        Route::post('/admin/settings', 'SettingsController@update')->name('admin/settings/store');

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


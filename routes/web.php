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

/**
 * 前台的界面
 */

Route::group(['domain' => 'blog.app'], function () {

    $front = function () {
        return view('blog');
    };

    Route::get('/', $front);
    Route::get('/categories', $front);
    Route::get('/tags', $front);
    Route::get('/wiki', $front);
    Route::get('/about', $front);
});

/**
 * 后台界面
 */
Route::group(['domain' => 'admin.blog.app'], function () {
    $back = function () {
        return view('admin');
    };
    Route::get('/', $back);
    Route::get('/categories', $back);
    Route::get('/tags', $back);
    Route::get('/wiki', $back);
    Route::get('/about', $back);
    Route::get('/auth', $back);
});

Route::get('save', 'TestController@save');
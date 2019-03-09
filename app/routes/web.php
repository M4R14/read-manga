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

Route::prefix('admin')
    ->namespace('Admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('manga', 'MangaController');
        Route::get('manga/get-image/{name}', 'MangaController@getImage')
            ->name('manga.get-image');
        Route::resource('manga-chater', 'Manga\ChaterController');
        Route::resource('manga-chater-image', 'Manga\ChaterImageController');
    });

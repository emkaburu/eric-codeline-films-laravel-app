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



Auth::routes();

Route::get('/', function () {
    return redirect('films');
});
Route::get('films', 'FilmController@index')->name('films');
Route::get('films/{slug}', 'FilmController@show')->name('film.show');
Route::get('image/{image_name}', 'FilmController@display_image');

//Auth Protected Routes
Route::middleware(['auth'])->group(function () {
	// Route::get('create-new-film', 'FilmController@create')->name('film.create');
	Route::get('film/create', 'FilmController@create')->name('film.create');

    Route::post('films/create', 'FilmController@store')->name('film.store');

    Route::post('comments/create', 'CommentController@store')->name('comment.store');
});//end auth middleware group


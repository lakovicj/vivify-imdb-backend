<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\RegisterController@create');
});

Route::apiResource('movies', 'Api\MovieController')->middleware('auth:api');

Route::get('search/movies', 'Api\MovieController@searchMovies')->middleware('auth:api')->name('movies.search');

Route::get('genres', 'Api\GenreController@getAllGenres')->middleware('api')->name('genres.all');

Route::get('filter/movies', 'Api\MovieController@filterMovies')->middleware('auth:api')->name('movies.filter');

Route::post('reactions', 'Api\ReactionController@store')->middleware('auth:api')->name('movies.reaction');

Route::post('comments', 'Api\CommentController@addComment')->middleware('auth:api')->name('movies.comments');
Route::get('movies/{id}/comments', 'Api\CommentController@getMovieComments')->middleware('auth:api');

Route::put('views/movies/{id}', 'Api\MovieController@addToMovieCount')->middleware('auth:api');

Route::get('popular', 'Api\MovieController@getPopularMovies')->middleware('auth:api');

Route::get('watchlist', 'Api\WatchlistController@getUsersWatchlist')->middleware('auth:api')->name('user.watchlist');
Route::post('watchlist', 'Api\WatchlistController@addWatchlistItem')->middleware('auth:api');
Route::put('watchlist/{itemId}', 'Api\WatchlistController@updateWatchlistItem')->middleware('auth:api');
Route::delete('watchlist/{itemId}', 'Api\WatchlistController@removeWatchlistItem')->middleware('auth:api');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
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
    return view('home');
});


//admin
Route::get('/admin}', [AdminController::class, 'index']);


Route::resource('articles', ArticleController::class)->names([
    'by_author' => 'articles.show_author'
]);
Route::Post(
    '/articcles/image/',
    [UserProfileController::class, 'image']
);

Route::get('/articles/{id}', [UserController::class, 'show']);

/*Route::get('user/{id}', 'UserController@index');
Route::get('user/{id}/posts', 'UserController@posts');
*/

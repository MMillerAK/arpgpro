<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DatabaseController;
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
Route::get('/admin', [AdminController::class, 'index']);

//articles and guides
Route::resource('articles', ArticleController::class)->names([
    'by_author' => 'articles.show_author'
]);

Route::get('/articles/{id}', [UserController::class, 'show']);

Route::Post(
    '/articles/image/',
    [UserProfileController::class, 'image']
);

//game database
Route::get('/database/create/item', [DatabaseController::class, 'createItem']);
Route::Post('/database/create/item', [DatabaseController::class, 'storeItem']);
Route::get('/view/item/{id}', [DatabaseController::class, 'viewItem']);


Route::view('/test', 'test/loaditem');
Route::view('/item', 'item');
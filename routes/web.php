<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CountIncrementController;
use App\Http\Controllers\ParserAllPageController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\LorePageController;
use App\Http\Controllers\JobApplyController;
use App\Http\Controllers\ImagePageController;
use App\Http\Controllers\LorePageContentController;
use App\Http\Controllers\NestedCommentController;
use App\Http\Controllers\PreviewController;
use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;

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
    return redirect('post');
});
Auth::routes(['verify' => true]);

Route::get('/profile', function () {
    // This route can only be accessed by confirmed users...
    
})->middleware('verified');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('post', PostController::class);
Route::resource('tag', TagController::class);
Route::resource('comment', CommentController::class);

Route::resource('nestedComment', NestedCommentController::class);
Route::resource('character', CharacterController::class);
Route::resource('/parser', ParserAllPageController::class);
Route::resource('/imagePage', ImagePageController::class);
Route::resource('/lore', LorePageController::class);
Route::resource('/projectHelp', JobApplyController::class)->middleware('verified');
Route::resource('/loreContent', LorePageContentController::class);
Route::resource('/profile', UserProfileController::class);
Route::get('/search', SearchController::class)->name('search');
Route::get('/preview', [PreviewController::class, 'preview'])->name('preview');
Route::get('/count/textCountIncrement', [CountIncrementController::class, 'textCountIncrement'])->name('count.textCountIncrement');
Route::get('/count/imageCountIncrement', [CountIncrementController::class, 'imageCountIncrement'])->name('count.imageCountIncrement');
Route::get('/count/characterTitleCountIncrement', [CountIncrementController::class, 'characterTitleCountIncrement'])->name('count.characterTitleCountIncrement');
Route::get('/count/characterTextCountIncrement', [CountIncrementController::class, 'characterTextCountIncrement'])->name('count.characterTextCountIncrement');
Route::get('/count/characterImageCountIncrement', [CountIncrementController::class, 'characterImageCountIncrement'])->name('count.characterImageCountIncrement');

Auth::routes();








Route::get('/testResource', function() {
    return new PostCollection(Post::all());
});

Route::get('/testResource/{id}', function($id) {
    return new PostResource(Post::findOrFail($id));
});
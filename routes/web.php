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
use App\Http\Controllers\ParserAllPageForKrishaController;
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
    
    return view('welcome');
});

Auth::routes();

//parser 
// Route::get('/parser', ParserController::class)->name('parser');

Route::get('test', function() {
    $result = DB::select('select * from characters where id > 3');
    $resultForHash = 'sharpolat';
    $resultForHash2 = Hash::make('sharpolat');
    if (Hash::check($resultForHash, $resultForHash2)) {
        echo Hash::make($resultForHash), $resultForHash2;
    }else{echo "not ok";}
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('post', PostController::class);
Route::resource('tag', TagController::class);
Route::resource('comment', CommentController::class);
Route::resource('character', CharacterController::class);
Route::resource('/parser', ParserAllPageController::class);
Route::resource('/parserForKrisha', ParserAllPageForKrishaController::class);
Route::get('/search', SearchController::class)->name('search');
Route::get('/preview', [PreviewController::class, 'preview'])->name('preview');
Route::get('/count/countIncrement', [CountIncrementController::class, 'countIncrement'])->name('count.countIncrement');

Auth::routes();








Route::get('/testResource', function() {
    return new PostCollection(Post::all());
});

Route::get('/testResource/{id}', function($id) {
    return new PostResource(Post::findOrFail($id));
});
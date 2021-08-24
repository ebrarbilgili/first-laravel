<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

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
    // return view('welcome');

    return 'Hi You';
});

// Route::get('/post', 'PostsController@index'); => LARAVEL 7
//LARAVEL 8 =>
// Route::get('/post', [PostsController::class, 'index']);
// Route::get('/post/{id}', [PostsController::class, 'index']);

// Route::resource('posts', PostsController::class);


Route::get('/contact',[PostsController::class, 'contact']);

Route::get('/post/{id}/{name}/{password}', [PostsController::class, 'show_post']);


// Route::get('/about', function () {
//     return 'Hi About Page';
// });

// Route::get('/post', function () {
//     return "This is post";
// });

// Route::get('/post/{id}', function ($id) {
//     return "This is post number " . $id;
// });

// Route::get('/post/{id}/{name}', function ($id, $name) {
//     return "This is post number and name " . $id . ' ' . $name;
// });


// Route::get('admin/posts/example', array('as' => 'admin.home', function () {
//     $url = route('admin.home');

//     // <a href="route('admin.home)">Click Here</a>

//     return "This url is " . $url;
// }));

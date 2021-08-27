<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;

Route::get('/', function () {
    // return view('welcome');

    return 'Hi You';
});

// Route::get('/post', 'PostsController@index'); => LARAVEL 7
//LARAVEL 8 =>
// Route::get('/post', [PostsController::class, 'index']);
// Route::get('/post/{id}', [PostsController::class, 'index']);

// Route::resource('posts', PostsController::class);


Route::get('/contact', [PostsController::class, 'contact']);

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


Route::get('/insert/{title}/{body}', function ($title, $body) {
    $value = DB::insert('insert into  posts(title, body,user_id) values(?, ?, ?)', [$title, $body, '1']);
    return $value;
});

Route::get('/read', function () {
    $results = DB::select('select * from posts');
    return $results;
    // foreach ($results as $result) {
    //     return $result->title;
    // }
});
Route::get('/read/{id}', function ($id) {
    $results = DB::select('select * from posts where id = ?', [$id]);
    return $results;
});
Route::get('/update', function () {
    $updated = DB::update('update posts set title ="Updated Title" where id = ?', [1]);
    return $updated;
});
Route::get('/delete', function () {
    $deleted = DB::delete('delete from posts where id = ?', [1]);
    return $deleted;
});

//ELOQUENT - ORM
Route::get('/find', function () {
    $posts = Post::all();
    return $posts;
    // foreach ($posts as $post ) {
    //     return $post->title;
    // }

});
Route::get('/findwhere', function () {
    $posts = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
    return $posts;
});

Route::get('/basicinsert', function () {
    $post = new Post;

    $post->title = 'new ORM title';
    $post->body = 'Wow eloquent is really cool';

    $post->save();

    return array($post);
});
//UPDATE ->
Route::get('/basicinsert/{id}', function ($id) {
    $post = Post::find($id);

    $post->title = 'Updated with insert title';
    $post->body = 'and this is the body...';

    $post->save();

    return array($post);
});

Route::get('/create', function () {
    Post::create(['title' => 'the create method', 'body' => 'and this is the create method body.']);
});

Route::get('/update', function () {
    $value = Post::where('id', 2)->where('is_admin', 0)->update(['title' => 'NEW PHP TITLE', 'body' => 'NEW PHP BODYYYYY']);
    return $value;
});

Route::get('/delete', function () {
    $post = Post::find(3);
    $post->delete();
});
Route::any('/delete2', function () {
    Post::destroy(3);
});

// Route::get('/find', function () {
//     $posts = Post::find(2);
//     return $posts->title;
//     // foreach ($posts as $post ) {
//     //     return $post->title;
//     // }
// });


// ELOQUENT Relationships
// ONE TO ONE
Route::get('/user/{id}/post', function ($id) {
    return array(User::find($id)->post);
});
Route::get('/post/{id}/user', function ($id) {
    return array(Post::find($id)->user);
});

// ONE TO MANY
Route::any('/posts', function () {
    $user = User::find(1);

    foreach ($user->posts as $post) {
        echo $post->title . "<br>"; 
    }
});

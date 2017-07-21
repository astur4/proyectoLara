<?php

  use App\Post;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Insert
Route::get('/insert', function () {
    DB::insert('insert into posts (title,contenido) values (?,?)',['PHP with GOOOD Laravel','good things happen in laravel']);
});

//
Route::get('/read',function(){
    $results = DB::select('select * from posts where id = ?', [1]);

    foreach ($results as $posts) {
        return $posts->title;
    }
});

//Route::get('/delete',function(){
//    $deleted = DB::delete('delete from posts where id=?',[1]);
//    return $deleted;
//});

Route::get('/update',function(){

    $updated = DB::update('update posts set title="Updated Title" where id = ?', [1]);

    return $updated;
});

Route::get('/about', function () {
    return "Hi about page";
});

Route::get('/contact', function () {
    return "Hi I'm contact";
});

Route::get('/post/{id}/{name}',function($id,$name){

    return "This is post number ".$id." ".$name;
});

Route::get('admin/posts/example', array('as'=>'admin.home', function(){
  $url= route('admin.home');
  return "this url is ". $url;
}));


// ELOQUENT
//Route::get('/find', function(){
//    $posts = Post::all();
//    foreach ($posts as $post) {
//      return $post->title;
//    }
//});

Route::get('/find', function(){
    $post = Post::find(2);

    return $post->title;
});

Route::get('/findwhere',function(){

    $posts = Post::where('id',2)->OrderBy('id','desc')->take(1)->get();

    return $posts;

});

Route::get('/findmore',function(){

//    $posts = Post::findOrFail(2);
//    return $posts;

  //Ejemplo para contar en caso de bases de datos con esa tabla users_count
    $posts = Post::where('users_count','<',50)->firstOrFail();
    return $posts;
});

Route::get('/basicinsert',function(){
    $post = new Post;
    $post->title = 'new ORM title';
    $post->contenido = 'MOla mogoollon';
    $post->save();
});

Route::get('/basicinsert2',function(){
    $post = Post::find(2);
    $post->title = 'Update 2';
    $post->contenido = 'Contente numbero 2';
    $post->save();
});

Route::get('/create',function(){
    Post::create(['title'=>'the create method','contenido'=>'WOOOOW']);
});

Route::get('/update',function(){

    Post::where('id',2)->where('is_admin',0)->update(['title'=>'New PHP Title', 'contenido'=>'I love PHP']);

});

Route::get('/delete',function(){
    $post = Post::find(3);
    $post->delete();
});

Route::get('/delete2',function(){

    //Para un solo elemento
    //Post::destroy(4);
    //Para mas elementos
    Post::destroy([4,5);

});

//Route::get('/post/{id}', 'PostController@index');

//Route::resource('posts', 'PostController');

Route::get('/contact','PostController@contact');

Route::get('post/{id}/{name}/{password}','PostController@show_post');

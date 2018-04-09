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
    return redirect(route('articles.index'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/articles/{id}/destroy', 'ArticlesController@destroy');
Route::get('/article/{id}/edit', 'ArticlesController@edit');

Route::post('/articles/{id}/update', 'ArticlesController@update');

Route::Resource('articles', 'ArticlesController');

Route::post('/articles/{id}/comments', 'CommentsController@savecomment');
Route::post('/articles/{id}/votes', 'VotesController@vote');
Route::delete('/articles/{id}/votes', 'VotesController@voteDelete');

Route::get('/profile/{id}', 'ProfileController@show');

Route::post('/users/{id}', 'UserController@update');

Route::resource('discuss', 'ArticlesController');
Route::get('/discuss/{id}/destroy', 'ArticlesController@destroy');

Route::post('/upload_image', function() {
    $message = $url = '';
    error_log('iasdfasdf');
    if (Request::hasFile('upload')) {
        $file = Request::file('upload');
        if ($file->isValid()) {
            $filename = uniqid().'.'.$file->extension();
            $file->move(storage_path().'/app/public/images/', $filename);
            $url = '/storage/images/'.$filename;
            $message = storage_path().'/app/public/images '.$filename.' Success';
            error_log($message);
            return response()->json(['uploaded' => 1, 'url' => $url]);
        } else {
            $message = 'An error occured while uploading the file.';
    error_log('error');

        }
    } else {
        $message = 'No file uploaded.';
    error_log('no');

    }
    error_log('shit');
    error_log($message);

    return response();
});

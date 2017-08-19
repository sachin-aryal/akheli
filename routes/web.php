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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test_admin')->name('home');

<<<<<<< HEAD
Route::post('user/{id}', function (Request $request, $id) {
    // Get the file from the request
    $file = $request->file('image');

    // Get the contents of the file
    $contents = $file->openFile()->fread($file->getSize());

    // Store the contents to the database
    $user = App\User::find($id);
    $user->avatar = $contents;
    $user->save();
});

=======
Route::resource('product','ProductController');
>>>>>>> c2ad8cc9066fb66819dd28ac169199618f409e64

Route::get('product/create','ProductController@create');
Route::get('product','ProductController@index');
Route::get('product/edit','ProductController@edit');
Route::get('product/detail','ProductController@detail');
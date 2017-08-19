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


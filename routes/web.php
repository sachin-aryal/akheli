<?php
use Illuminate\Http\Request;

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

Route::get("/login",[ 'as' => 'login',function (Request $request){
    $requested_from = $request->rd;
    if($requested_from == "/register"){
        $requested_from = "/home";
    }
    $request->session()->put('url.intended',$requested_from."/");
    return View::make('auth/login')->with('rpath', $requested_from);
}]);
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('product','ProductController');
Route::get('user', 'UserController@index');

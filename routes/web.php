<?php
//ログインルート
Auth::routes();
//トップ画面へのルート
Route::get('/','ItemController@index')->name('top');
//いいねボタンの実装
Route::patch('/items/{item}/toggle_like','ItemController@toggleLike')->name('items.toggle_like');
//ユーザー画面をresourceで設定
Route::resource('users','UserController');
//プロフィール画面へのルート
Route::get('/profile/edit','ProfileController@edit')->name('profile.edit');
Route::patch('/profile/edit','ProfileController@update')->name('profile.update');
Route::get('/profile/edit_image','ProfileController@editImage')->name('profile.edit_image');
Route::patch('/profile/edit_image','ProfileController@updateImage')->name('profile.update_image');
//出品商品一覧画面へのルート
Route::get('users/{user}/exhibitions','UserController@index')->name('users.exhibitions');
//出品商品編集画面のルート
Route::get('/items/{item}/edit','ItemController@edit')->name('items.edit');
Route::patch('/items/{item}/edit','ItemController@update')->name('items.update');
//新規出品商品画面をresourceで設定
Route::resource('items','ItemController')->only('create','store','destroy');
//出品商品画像編集画面のルート
Route::get('/items/{item}/edit_image','ItemController@editImage')->name('items.edit_image');
Route::patch('/items/{item}','ItemController@updateImage')->name('items.update_image');
//商品詳細画面のルート
Route::get('/items/{item}','ItemController@show')->name('items.show');
//購入確認画面のルート
Route::post('/items/{item}/confirm','ItemController@confirm')->name('items.confirm');
//購入確定画面のルート
Route::post('/items/{item}/finish','ItemController@finish')->name('items.finish');
//お気に入り一覧画面のルート
Route::get('/likes','LikeController@index')->name('likes.index');

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

// Route::get('/', function () {
//     return view('welcome');
// });

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

Route::get('/','ListingsController@index');                                 //リスト一覧画面　ListingsControllerのindexアクションを実行せよ
Route::get('/new', 'ListingsController@new')->name('new');                  //リスト新規画面
Route::post('/listings','ListingsController@store');                        //リスト新規処理
Route::get('/listingsedit/{listing_id}', 'ListingsController@edit');        //リスト更新画面　
Route::post('/listing/edit','ListingsController@update');                   //リスト更新処理
Route::get('/listingsdelete/{listing_id}', 'ListingsController@destroy');   //リスト削除処理

Route::get('listing/{listing_id}/card/new', 'CardsController@new')->name('new_card');   //カード新規画面
Route::post('/listing/{listing_id}/card', 'CardsController@store');                     //カード新規処置
Route::get('listing/{listing_id}/card/{card_id}', 'CardsController@show');              //カード詳細画面
Route::get('listing/{listing_id}/card/{card_id}/edit', 'CardsController@edit');         //カード編集画面
Route::post('/card/edit', 'CardsController@update');                                    //カード更新画面
Route::get('listing/{listing_id}/card/{card_id}/delete', 'CardsController@destroy');    //カード削除処理


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
#user search
Route::get('user/find/{userid}', 'DanbeeController@search');
#sign UP
Route::get('user/signup/{userid}/{pw}/{phone}/{name}/{gender}/{birth}', 'DanbeeController@signup');
#all user
Route::get('user/list', 'DanbeeController@alluser');
#login
Route::get('user/login/{userid}/{pw}', 'DanbeeController@login');
#find id
Route::get('user/show&id/{name}/{phone}', 'DanbeeController@getId');
#find pw
Route::get('user/show&pw/{id}/{name}/{phone}/{birth}', 'DanbeeController@getPw');

#start kickboard
Route::get('kick/borrow/{kickid}/{userid}', 'KickController@borrow');
#end kickboard
Route::get('kick/lend/{userid}', 'KickController@lend');
#set kick status
Route::get('kick/set/{kickid}', 'KickController@setStatus');
#all kick
Route::get('kick/list', 'KickController@allkick');
#get battery
Route::get('kick/battery/{kickid}', 'KickController@getBattery');

#all notice
Route::get('notice/list', 'NoticeController@allnotice');
#insert notice
Route::get('notice/insert/{title}&{content}', 'NoticeController@insertnotice');

#all history
Route::get('history/list', 'HistoryController@allHistory');


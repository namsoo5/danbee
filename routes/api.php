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
#Route::get('user/signup/{userid}/{pw}/{phone}/{name}/{gender}/{birth}', 'DanbeeController@signup');
Route::post('user/signup', 'DanbeeController@signupPost');
#all user
Route::get('user/list', 'DanbeeController@alluser');
#login
#Route::get('user/login/{userid}/{pw}', 'DanbeeController@login');
Route::post('user/login', 'DanbeeController@loginPost');
#find id
Route::get('user/show&id/{name}/{phone}', 'DanbeeController@getId');
#find pw
Route::get('user/show&pw/{id}/{name}/{phone}/{birth}', 'DanbeeController@getPw');
#change pw
Route::get('user/change/{userid}/{pw}', 'DanbeeController@changePw');
#sns signup
Route::get('user/sns/signup/{userid}/{name}/{gender}/{birth}', 'DanbeeController@snsSignup');
#user delete
Route::get('user/delete/{userid}', 'DanbeeController@userDelete');
#user state
Route::get('user/state/{userid}', 'DanbeeController@userState');

#start kickboard
Route::get('kick/borrow/{kickid}/{userid}', 'KickController@borrow');
#end kickboard
Route::get('kick/lend/{userid}', 'KickController@lend');
#set kick status
Route::get('kick/set/{kickid}', 'KickController@setStatus');
#all kick
Route::get('kick/list', 'KickController@allkick');
#get battery
Route::get('kick/battery/get/{kickid}', 'KickController@getBattery');
#set battery
Route::get('kick/battery/set/{kickid}/{battery}', 'KickController@setBattery');
#get status
Route::get('kick/status/{kickid}', 'KickController@getStatus');
#set kick gps
Route::get('kick/gps/set/{kickid}/{lat}/{lng}', 'KickController@setGps');
#get kick gps
Route::get('kick/gps/get', 'KickController@getGps');

#all notice
Route::get('notice/list', 'NoticeController@allnotice');
#insert notice
#Route::get('notice/insert/{title}&{content}', 'NoticeController@insertnotice');
#insert notice post
Route::post('notice/insert', 'NoticeController@insertNoticePost');
#delete notice post
Route::post('notice/delete', 'NoticeController@deleteNoticePost');


#all history
Route::get('history/list', 'HistoryController@allHistory');
#user history
Route::get('history/user/{userid}', 'HistoryController@userHistory');
#question list
Route::get('question/list', 'QuestionController@allQuestion');
#insert question
#Route::get('question/new/{userid}/{title}/{content}', 'QuestionController@newQuestion');
Route::post('question/new', 'QuestionController@newQuestionPost');
#delete question
Route::post('question/delete', 'QuestionController@deleteQuestionPost');

/*
#answer list
Route::get('answer/list', 'QuestionController@allAnswer');
#insert answer
Route::get('answer/new/{qid}/{userid}/{content}', 'QuestionController@newAnswer');
#get answer
Route::get('answer/get/{qid}', 'QuestionController@getAnswer');
 */

<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile']);
Route::get('/editUser', [App\Http\Controllers\UserController::class, 'editUser']);
Route::post('/update', [App\Http\Controllers\UserController::class, 'update']);
Route::post('/upload', [App\Http\Controllers\UserController::class, 'upload']);
Route::post('/delete', [App\Http\Controllers\UserController::class, 'deleteAccount']);

Route::get('/profile/{id}',[App\Http\Controllers\UserController::class, 'display']);

Route::resource('/group','App\Http\Controllers\GroupController');
Route::get('/groups/myGroups','App\Http\Controllers\GroupController@myGroups');
Route::get('/PendingRequest','App\Http\Controllers\GroupController@PendingRequest');
Route::get('/group/JoinGroup/{id}','App\Http\Controllers\GroupController@JoinGroup');
Route::get('/groups/adminGroups','App\Http\Controllers\GroupController@AdminGroups');
Route::get('/accept/{groupid}/{usergroupid}', 'App\Http\Controllers\GroupController@accept');
Route::get('/reject/{groupid}/{usergroupid}','App\Http\Controllers\GroupController@reject');
Route::resource('/Posts','App\Http\Controllers\PostController');

Route::get('/Posts/createPost/{id}','App\Http\Controllers\PostController@createPost');


Route::get('/adminUploadFile', function () {
    if(Auth::User()->role==1)
    {
    return view('adminUploadFile');
    }else{
        return redirect('home');
    }
    
})->middleware('verified');

Route::post('/adminUploadFile','App\http\Controllers\ScheduleController@uploadFile');

Route::get('/schedules','App\http\Controllers\ScheduleController@openPage')->middleware('verified');;

Route::post('/schedules','App\http\Controllers\ScheduleController@GetData');

Route::get('/getTeacher','App\http\Controllers\ScheduleController@GetTeacher');
Route::get('/search',[
    'uses'=>'App\http\Controllers\SearchController@getResults',
    'as'=>'search.results',
]);
Route::get('/friends',[
    'uses'=>'App\http\Controllers\FriendController@getIndex',
    'as'=>'user.Friends',
]);
Route::get('/user/{$id}',[
    'uses'=>'App\http\Controllers\ProfileController@getProfile',
    'as'=>'profile.index',
]);
Route::get('/add/{id}',[App\Http\Controllers\FriendController::class, 'getAdd']);
Route::get('/accept/{id}',[App\Http\Controllers\FriendController::class, 'getAccept']);
Route::get('/unfriend/{id}',[App\Http\Controllers\FriendController::class, 'unfriend']);
Route::get('/decline/{id}',[App\Http\Controllers\FriendController::class, 'decline']);


Route::get('/chat',[App\Http\Controllers\ChatController::class, 'index']);
Route::get('/getmessages','App\Http\Controllers\ChatController@fetchMessages');
Route::post('/messages',[App\Http\Controllers\ChatController::class, 'sendMessage']);
Route::get('ajax', 'App\http\Controllers\ScheduleController@view');
Route::post('ajax', 'App\http\Controllers\ScheduleController@send_http_request')->name('ajaxRequest.post');
Route::post('/Like','App\http\Controllers\LikeController@AddLike');
Route::post('/reLike','App\http\Controllers\LikeController@RemoveLike');
Route::post('/LikeCounter{id}','App\http\Controllers\LikeController@LikeCounter');

Route::post('/Comment','App\http\Controllers\ComentController@addComment');
Route::post('/getConments','App\http\Controllers\ComentController@getComments');

Route::get('/userLike','App\http\Controllers\LikesController@ShowPage')->middleware('verified');

Route::post('ajax1','App\http\Controllers\LikesController@AddToLikes')->name('addToLikes.post');

Route::post('ajax2','App\http\Controllers\LikesController@RemoveLikes')->name('removeLikes.post');

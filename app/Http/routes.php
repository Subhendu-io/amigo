<?php

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

// Home...
Route::get('/',
	[
		'uses' => '\Amigo\Http\Controllers\HomeController@index',
		'as' => 'home',
	]);

// Alerts...
Route::get('/alert', function ()
	{
		return redirect()->route('home')->with('info', 'You have signed up!');
	});


// Authentication...

	//Sign Up...
		Route::get('/signup',
			[
				'uses' => '\Amigo\Http\Controllers\AuthController@getSignup',
				'as' => 'auth.signup',
				'middleware' => ['guest'],
			]);
		Route::post('/signup',
			[
				'uses' => '\Amigo\Http\Controllers\AuthController@postSignup',
				'middleware' => ['guest'],
			]);

	//Sign In...
		Route::get('/signin',
			[
				'uses' => '\Amigo\Http\Controllers\AuthController@getSignin',
				'as' => 'auth.signin',
				'middleware' => ['guest'],
			]);
		Route::post('/signin',
			[
				'uses' => '\Amigo\Http\Controllers\AuthController@postSignin',
				'middleware' => ['guest'],
			]);

	//Sign Out...
		Route::get('/signout',
			[
				'uses' => '\Amigo\Http\Controllers\AuthController@getSignout',
				'as' => 'auth.signout',
			]);


// Search...
	Route::get('/search',
		[
			'uses' => '\Amigo\Http\Controllers\SearchController@getResults',
			'as' => 'search.results',
		]);


//User Profile
	Route::get('/user/{username}',
		[
			'uses' => '\Amigo\Http\Controllers\ProfileController@getProfile',
			'as' => 'profile.index',
		]);

	//Edit Profile
		Route::get('/profile/edit',
			[
				'uses' => '\Amigo\Http\Controllers\ProfileController@getEdit',
				'as' => 'profile.edit',
				'middleware' => ['auth'],
			]);

		Route::post('/profile/edit',
			[
				'uses' => '\Amigo\Http\Controllers\ProfileController@postEdit',
				'middleware' => ['auth'],
			]);

//Friends
	Route::get('/friends',
			[
				'uses' => '\Amigo\Http\Controllers\FriendController@getIndex',
				'as' => 'friends.index',
				'middleware' => ['auth'],
			]);

	Route::get('/friends/add/{username}',
			[
				'uses' => '\Amigo\Http\Controllers\FriendController@getAdd',
				'as' => 'friends.add',
				'middleware' => ['auth'],
			]);

	Route::get('/friends/accept/{username}',
			[
				'uses' => '\Amigo\Http\Controllers\FriendController@getAccept',
				'as' => 'friends.accept',
				'middleware' => ['auth'],
			]);

	Route::post('/friends/delete/{username}',
			[
				'uses' => '\Amigo\Http\Controllers\FriendController@postDelete',
				'as' => 'friend.delete',
				'middleware' => ['auth'],
			]);

// Statuses
	Route::post('/status',
			[
				'uses' => '\Amigo\Http\Controllers\StatusController@postStatus',
				'as' => 'status.post',
				'middleware' => ['auth'],
			]);

	Route::post('/status/{statusId}/reply',
			[
				'uses' => '\Amigo\Http\Controllers\StatusController@postReply',
				'as' => 'status.reply',
				'middleware' => ['auth'],
			]);

	Route::get('/status/{statusId}/like',
			[
				'uses' => '\Amigo\Http\Controllers\StatusController@getLike',
				'as' => 'status.like',
				'middleware' => ['auth'],
			]);
<?php

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

/*Route::get('/', function() {
    return response()->json(['data' => 'API de Inskub']);
});

Route::namespace('Auth')->group(function() {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
});

Route::middleware('auth:api')->group(function() {
    Route::namespace('Chat')->name('chat.')->group(function() {
        Route::get('/chat/{id?}', 'ChatController@show');
        Route::get('/chat/create/{id}', 'ChatController@createDirectConversation');
        Route::get('/chat/create-groups', 'ChatController@createGroupConversation');
        Route::post('/chat/{id}', 'ChatController@addParticipants');
    });

    Route::get('/jobs', 'Job\JobController@index');
    Route::namespace('Job')->prefix('job')->group(function() {
        Route::get('/create', 'JobController@create');
        Route::post('/create', 'JobController@store');
        Route::get('/{id}', 'JobController@show');
    });

    Route::get('/formations', 'Formation\FormationController@index');
    Route::namespace('Formation')->prefix('formation')->group(function() {
        Route::get('/create', 'FormationController@create');
        Route::get('/{id}', 'FormationController@show');
        Route::post('/create', 'FormationController@store');
    });

    Route::get('/projects', 'Project\ProjectController@index');
    Route::post('/projects', 'Project\ProjectController@store');
    Route::namespace('Project')->prefix('project')->group(function() {
        Route::get('/{id}', 'ProjectController@show');
        Route::post('/{id}', 'ProjectController@storePost');

        Route::name('todo.')->group(function() {
            Route::get('/{id}/todos', 'TodoController@index');
            Route::post('/{id}/todo/create', 'TodoController@store');
        });

        Route::name('note.')->group(function() {
            Route::get('/{id}/note/{note_id}', 'NoteController@show');
            Route::put('/{id}/note/{note_id}', 'NoteController@update');
            Route::post('/{id}/note/create', 'NoteController@store');
        });

        Route::name('post.')->group(function() {
            Route::get('/{id}/post/{post_id}', 'PostController@show');
        });
    });

    Route::namespace('User')->name('user.')->group(function() {
        Route::get('/profil/{id}', 'UserController@index');
        Route::post('/profil/{id}', 'UserController@storeAbout');
        Route::get('/profil/{id}/followers', 'UserController@follower');
        Route::get('/profil/{id}/followings', 'UserController@following');

        Route::prefix('mon-compte')->group(function() {
            Route::get('/', 'UserController@edit');
            Route::put('/', 'UserController@update');
            Route::get('/options', 'UserController@options');

            Route::name('formation.')->prefix('formation')->group(function() {
                Route::get('/create', 'UserFormationController@create');
                Route::post('/create', 'UserFormationController@store');
            });

            Route::name('experience.')->prefix('experience')->group(function() {
                Route::get('/create', 'UserExperienceController@create');
                Route::post('/create', 'UserExperienceController@store');
            });

            Route::name('skill.')->prefix('skill')->group(function() {
                Route::get('/create', 'UserSkillController@create');
                Route::post('/create', 'UserSkillController@store');
            });
        });
    });

    Route::namespace('Post')->name('post.')->group(function() {
        Route::prefix('post')->group(function() {
            Route::get('/details/{id}', 'PostController@show');
            Route::post('/like/{id}', 'PostController@like');
            Route::post('/{id}', 'ReplyPostController@store');
        });
    });
});*/

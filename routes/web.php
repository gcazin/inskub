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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('index');
Route::post('/', 'Post\PostController@store')->name('post.create');
Route::get('/discover', 'HomeController@discover')->name('discover');

// Page d'accueil
Route::namespace('Post')->name('post.')->group(function() {
    Route::prefix('post')->group(function() {
        Route::get('/details/{id}', 'PostController@show')->name('show');
        Route::post('/like/{id}', 'PostController@like')->name('like');
        Route::post('/{id}', 'ReplyPostController@store')->name('reply');
    });
});

// Utilisateur
Route::namespace('Auth')->group(function() {
    // Connexion
    Route::get('/connexion', 'LoginController@showLoginForm')->name('login');
    Route::post('/connexion', 'LoginController@login');
    // Inscription
    Route::get('/inscription', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('/inscription', 'RegisterController@register');

    // Mot de passe oublié
    Route::get('mot-de-passe/reinitialisation', 'ForgotPasswordController@showLinkRequestForm');
    Route::post('mot-de-passe/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::get('mot-de-passe/reinitialisation/{token}', 'ResetPasswordController@showResetForm');
    Route::post('mot-de-passe/reinitialisation', 'ResetPasswordController@reset');

    Route::get('/deconnexion', 'LoginController@logout')->name('user.logout');
});

Route::namespace('User')->name('user.')->group(function() {
    // Partie "Mon compte"
    Route::get('/profil/{id}', 'UserController@index')->name('profile');
    Route::get('/profil/{id}/followers', 'UserController@follower')->name('follower');
    Route::get('/profil/{id}/followings', 'UserController@following')->name('following');

    Route::prefix('mon-compte')->group(function() {

        /**
         * Gestion du compte
         */
        Route::get('/', 'UserController@edit')->name('edit');
        Route::put('/', 'UserController@update');
        Route::get('/options', 'UserController@options')->name('options');

        /**
         * Crud des formations de l'utilisateur
         */
        Route::name('formation.')->prefix('formation')->group(function() {
            Route::get('/create', 'UserFormationController@create')->name('create');
            Route::post('/create', 'UserFormationController@store');
        });

        /**
         * Crud des expériences de l'utilisateur
         */
        Route::name('experience.')->prefix('experience')->group(function() {
            Route::get('/create', 'UserExperienceController@create')->name('create');
            Route::post('/create', 'UserExperienceController@store');
        });
    });
});

/**
 * CRUD des projets
 */
Route::get('/projects', 'Project\ProjectController@index')->name('project.index');
Route::post('/projects', 'Project\ProjectController@store');
Route::namespace('Project')->prefix('project')->name('project.')->group(function() {
    Route::get('/{id}', 'ProjectController@show')->name('show');
    Route::post('/{id}', 'ProjectController@storePost')->name('postStore');
});

/**
 * CRUD des formations
 */
Route::get('/formations', 'Formation\FormationController@index')->name('formation.index');
Route::namespace('Formation')->prefix('formation')->name('formation.')->group(function() {
    Route::get('/create', 'FormationController@create')->name('create');
    Route::get('/{id}', 'FormationController@show')->name('show');
    Route::post('/create', 'FormationController@store');
});

/**
 * CRUD des jobs
 */
Route::get('/jobs', 'Job\JobController@index')->name('job.index');
Route::namespace('Job')->prefix('job')->name('job.')->group(function() {
    Route::get('/create', 'JobController@create')->name('create');
    Route::post('/create', 'JobController@store');
    Route::get('/{id}', 'JobController@show')->name('show');
});

Route::namespace('Chat')->name('chat.')->group(function() {
    // Messagerie privée
    Route::get('/chat/{id?}', 'ChatController@show')->name('index');
    Route::get('/chat/create/{id}', 'ChatController@createDirectConversation')->name('createConversation');
    Route::get('/chat/create-groups', 'ChatController@createGroupConversation')->name('createGroupConversation');
    Route::post('/chat/{id}', 'ChatController@addParticipants')->name('addParticipants');
});

Route::namespace('Follow')->group(function() {
    Route::post('/follow/add', 'FollowerController@add')->name('follower.add');
});

// Administration
Route::namespace('Admin')->group(function() {
    Route::get('/admin', 'AdminController@index')->name('admin.index');
});

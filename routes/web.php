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

Route::get('/discover', 'HomeController@discover')->name('discover');

// Page d'accueil
Route::namespace('Post')->name('post.')->group(function() {
    Route::get('/', 'PostController@index')->name('index');
    Route::prefix('post')->group(function() {
        Route::get('/details/{id}', 'PostController@show')->name('show');
        Route::get('/create', 'PostController@create')->name('create');
        Route::post('/create', 'PostController@store');
        Route::post('/like/{id}', 'PostController@like')->name('like');
        Route::post('/{id}', 'ReplyPostController@store')->name('reply');
    });
});

// Utilisateur
Route::namespace('Auth')->group(function() {
    // CRUD de la classe User
    Route::resource('user', 'UserController')->except(['index', 'show', 'create']);
    // Partie "Mon compte"
    Route::name('user.')->group(function() {
        Route::get('/profil/{id}', 'UserController@index')->name('profile');
        Route::get('/mon-compte', 'UserController@edit')->name('edit');
        Route::get('/options', 'UserController@options')->name('options');
        Route::get('/avances', 'UserController@advanced')->name('advanced');
        Route::get('/deconnexion', 'LoginController@logout')->name('logout');
    });

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
});

Route::namespace('Chat')->name('chat.')->group(function() {
    // Messagerie privée
    Route::get('/chat', 'ChatController@index')->name('index');
    Route::get('/chat/create/{id}', 'ChatController@createDirectConversation')->name('createConversation');
    Route::get('/chat/{id}', 'ChatController@chat')->name('chat');
    Route::post('/chat/{id}', 'ChatController@addParticipants')->name('addParticipants');
});

Route::namespace('Follow')->group(function() {
    Route::post('/follow/add', 'FollowerController@add')->name('follower.add');
});

Route::namespace('Formation')->group(function() {
    Route::get('/formation/creation', 'FormationController@create')->name('create.formation');
    Route::post('/formation/creation', 'FormationController@store')->name('store.formation');
    Route::get('/formation/list', 'FormationController@show')->name('show.formation');
});

// Administration
Route::namespace('Admin')->group(function() {
    Route::get('/admin', 'AdminController@index')->name('admin.index');
});

// Article
Route::namespace('Article')->group(function() {

    // CRUD des articles
    Route::resource('/article', 'ArticleController', [])->except(['index', 'show']);
    Route::get('/article/{id}/edit', 'ArticleController@edit')->name('article.edit');
    Route::get('/articles', 'ArticleController@index')->name('article.index');
    Route::get('/article/{id}/{slug}', 'ArticleController@show')->name('article.show');

    // Création des CRUD d'administration
    /*Route::name('admin.')->group(function () {
        Route::resource('admin/subcategory', 'SubCategoryController', [
            'prefix' => 'admin.'
        ])->except(['index', 'show']);
        Route::resource('admin/category', 'CategoryController', [
            'prefix' => 'admin.'
        ])->except(['index', 'show']);
    });*/
    Route::get('/articles/categorie/{category_id}', 'CategoryController@index')->name('category.index');
    //Route::get('/admin/subcategory/{id}/edit', 'SubCategoryController@edit')->name('admin.subcategory.edit');

    // Recherche
    Route::get('/articles/search', 'SearchController@search')->name('search');

    // TODO: A supprimer
    Route::get('/threads', 'ArticleController@threads')->name('threads');
});

Route::get('/question', function() {
    return view('question-answer');
})->name('question');

Route::get('/agents', function() {
    return view('listing-agents');
})->name('listing-agents');

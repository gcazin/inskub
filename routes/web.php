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

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Discover\DiscoverController;
use App\Http\Controllers\Expert\ExpertController;
use App\Http\Controllers\Expert\RateExpertController;
use App\Http\Controllers\Expert\RequestExpertiseController;
use App\Http\Controllers\Expert\SinisterController;
use App\Http\Controllers\Faq\FaqController;
use App\Http\Controllers\Follow\FollowerController;
use App\Http\Controllers\Formation\FormationController;
use App\Http\Controllers\Job\JobController;
use App\Http\Controllers\Misc\CityController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\ReplyPostController;
use App\Http\Controllers\Project\NoteController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Project\TodoController;
use App\Http\Controllers\School\ClassroomController;
use App\Http\Controllers\School\ProfessorController;
use App\Http\Controllers\School\SchoolController;
use App\Http\Controllers\School\StudentController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserExperienceController;
use App\Http\Controllers\User\UserFormationController;
use App\Http\Controllers\User\UserSkillController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::namespace('Discover')->name('discover.')->group(function() {
    Route::get('/discover', [DiscoverController::class, 'discover'])->name('index');
    Route::get('/discover/search', [DiscoverController::class, 'search'])->name('search');
});

// Page d'accueil
Route::namespace('Post')->group(function() {
    Route::get('/index', [PostController::class, 'index'])->name('index');
    Route::post('/index', [PostController::class, 'store'])->name('post.create');

    Route::prefix('post')->name('post.')->group(function() {
        Route::get('/details/{id}', [PostController::class, 'show'])->name('show');
        Route::post('/like/{id}', [PostController::class, 'like'])->name('like');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('destroy');
        Route::post('/{id}', [ReplyPostController::class, 'store'])->name('reply');
        Route::post('/{id}/report-post', [PostController::class, 'report'])->name('report');
    });
});

Route::namespace('Expert')->group(function() {

    Route::name('expert.')->group(function() {
        Route::get('/experts', [ExpertController::class, 'index'])->name('index');
        Route::post('/experts/search', [ExpertController::class, 'search']);
        Route::prefix('expert')->group(function() {
            /**
             * Dashboard de l'expert
             */
            Route::get('/missions', [RequestExpertiseController::class, 'missions'])->name('missions');
            Route::post('/{id}/request', [RequestExpertiseController::class, 'requestExpertise'])->name('request');
            Route::get('/{id}/accept', [RequestExpertiseController::class, 'acceptExpertise'])->name('accept');

            // L'expert demande des informations supplémentaires
            Route::post('/{id}/more-info', [RequestExpertiseController::class, 'moreInfoExpertise'])->name('moreInfo');

            // L'intermédiaire précise sa demande lorsqu'il manque des informations pour l'expert
            Route::post('/{id}/detailed-description', [RequestExpertiseController::class, 'detailedDescriptionExpertise'])->name('detailedDescriptionExpertise');

            Route::post('/{id}/refuse', [RequestExpertiseController::class, 'refuseExpertise'])->name('refuse');
            Route::post('/{id}/finish', [RequestExpertiseController::class, 'finishExpertise'])->name('finish');
            Route::post('/{id}/rating', [RateExpertController::class, 'ratingExpert'])->name('rating');
            Route::post('/{id}/renew', [RequestExpertiseController::class, 'renewExpertise'])->name('renew');
        });
    });

    Route::prefix('sinister')->name('sinister.')->group(function() {
        /**
         * Dashboard du demandeur
         */
        Route::get('/index', [SinisterController::class, 'index'])->name('index');
    });
});

// Utilisateur
Route::namespace('Auth')->group(function() {
    // Connexion
    Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/connexion',  [LoginController::class, 'login']);
    // Inscription
    Route::get('/inscription',  [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/inscription', [RegisterController::class, 'register']);

    // Mot de passe oublié
    Route::get('mot-de-passe/reinitialisation', [ForgotPasswordController::class, 'showLinkRequestForm']);
    Route::post('mot-de-passe/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::get('mot-de-passe/reinitialisation/{token}', [ResetPasswordController::class, 'showResetForm']);
    Route::post('mot-de-passe/reinitialisation', [ResetPasswordController::class, 'reset']);

    Route::get('/deconnexion', [LoginController::class, 'logout'])->name('user.logout');
});

Route::namespace('User')->name('user.')->group(function() {
    // Partie "Mon compte"
    Route::get('/profil/{id}', [UserController::class, 'index'])->name('profile');
    Route::post('/profil/{id}', [UserController::class, 'storeAbout'])->name('storeAbout');
    Route::get('/profil/{id}/followers', [UserController::class, 'follower'])->name('follower');
    Route::get('/profil/{id}/followings', [UserController::class, 'following'])->name('following');
    Route::get('/activity', [UserController::class, 'activity'])->name('activity');


    Route::prefix('mon-compte')->group(function() {

        /**
         * Gestion du compte
         */
        Route::get('/', [UserController::class, 'edit'])->name('edit');
        Route::put('/', [UserController::class, 'update']);
        Route::get('/options', [UserController::class, 'options'])->name('options');

        /**
         * Crud des formations de l'utilisateur
         */
        Route::name('formation.')->prefix('formation')->group(function() {
            Route::get('/create', [UserFormationController::class, 'create'])->name('create');
            Route::post('/create', [UserFormationController::class, 'store']);
        });

        /**
         * Crud des expériences de l'utilisateur
         */
        Route::name('experience.')->prefix('experience')->group(function() {
            Route::get('/create', [UserExperienceController::class, 'create'])->name('create');
            Route::post('/create', [UserExperienceController::class, 'store']);
        });

        /**
         * Crud des expériences de l'utilisateur
         */
        Route::name('skill.')->prefix('skill')->group(function() {
            Route::get('/create', [UserSkillController::class, 'create'])->name('create');
            Route::post('/create', [UserSkillController::class, 'store']);
        });
    });
});

/**
 * CRUD des projets
 */
Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
Route::namespace('Project')->prefix('project')->name('project.')->group(function() {
    Route::get('/{id}', [ProjectController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit');
    Route::put('/edit/{id}', [ProjectController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ProjectController::class, 'destroy'])->name('destroy');

    Route::put('/participants/update/{id}', [ProjectController::class, 'updateParticipants'])->name('participants.update');

    Route::name('todo.')->group(function() {
        Route::get('/{id}/todos', [TodoController::class, 'index'])->name('index');
        Route::post('/{id}/todo/create', [TodoController::class, 'store'])->name('create');
    });

    Route::name('note.')->group(function() {
        Route::get('/{id}/note/{note_id}', [NoteController::class, 'show'])->name('show');
        Route::put('/{id}/note/{note_id}', [NoteController::class, 'update']);
        Route::post('/{id}/note/create', [NoteController::class, 'store'])->name('create');
    });

    Route::name('post.')->group(function() {
        Route::get('/{id}/post/{post_id}', [PostController::class, 'show'])->name('show');
    });
});

Route::namespace('School')->prefix('school')->name('school.')->group(function() {
    Route::get('/', [SchoolController::class, 'index'])->name('index');

    Route::name('professor.')->prefix('professor')->group(function() {
        Route::get('/', [ProfessorController::class, 'index'])->name('index');
        Route::post('/', [ProfessorController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProfessorController::class, 'update'])->name('update');
        Route::put('/edit/{id}', [ProfessorController::class, 'update']);
    });

    Route::name('classroom.')->prefix('classroom')->group(function() {
        Route::get('/', [ClassroomController::class, 'index'])->name('index');
        Route::post('/', [ClassroomController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ClassroomController::class, 'update'])->name('update');
        Route::put('/edit/{id}', [ClassroomController::class, 'update']);
    });

    Route::name('student.')->prefix('student')->group(function() {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::post('/', [StudentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [StudentController::class, 'update'])->name('update');
        Route::put('/edit/{id}', [StudentController::class, 'update']);
    });
});
/**
 * CRUD des jobs
 */
Route::namespace('Faq')->prefix('faq')->name('faq.')->group(function() {
    Route::get('/', [FaqController::class, 'index'])->name('index');
    Route::post('/', [FaqController::class, 'store']);
});

/**
 * CRUD des formations
 */
Route::get('/formations', 'Formation\FormationController@index')->name('formation.index');
Route::namespace('Formation')->prefix('formation')->name('formation.')->group(function() {
    Route::get('/create', [FormationController::class, 'create'])->name('create');
    Route::get('/{id}', [FormationController::class, 'show'])->name('show');
    Route::post('/create', [FormationController::class, 'store']);
});

/**
 * CRUD des jobs
 */
Route::get('/jobs', [JobController::class, 'index'])->name('job.index');
Route::namespace('Job')->prefix('job')->name('job.')->group(function() {
    Route::get('/create', [JobController::class, 'create'])->name('create');
    Route::post('/create', [JobController::class, 'store']);
    Route::get('/{id}', [JobController::class, 'show'])->name('show');
});

Route::namespace('Chat')->name('chat.')->group(function() {
    // Messagerie privée
    Route::get('/chat/{id?}', [ChatController::class, 'show'])->name('show');
    Route::delete('/chat/{id}', [ChatController::class, 'destroy'])->name('destroy');
    Route::get('/chat/create/{id}', [ChatController::class, 'createDirectConversation'])->name('createConversation');
    Route::get('/chat/create-groups', [ChatController::class, 'createGroupConversation'])->name('createGroupConversation');
    Route::post('/chat/{id}', [ChatController::class, 'addParticipants'])->name('addParticipants');
});

Route::namespace('Follow')->name('follower.')->group(function() {
    Route::post('/follow/add', [FollowerController::class, 'add'])->name('add');
});

Route::namespace('Notification')->name('notification.')->group(function() {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('index');
    Route::get('/notifications/mark-as-read', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');
});

Route::namespace('Misc')->group(function() {
    Route::get('/cities/{postal_code}', [CityController::class, 'cities'])->name('show');
});

/**
 * Test des mails
 */
Route::get('mailable', function () {
    $user = User::find(1);

    return new \App\Mail\StudentCreated($user, 'salut', 1);
});

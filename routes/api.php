<?php
use App\Http\Controllers\Api\Web\Frontoffice\IncludesController;
use App\Http\Controllers\Api\Web\Frontoffice\HomeController; 

use App\Http\Controllers\Api\Web\Authentication\RegisterController;
use App\Http\Controllers\Api\Web\Authentication\ForgotPasswordController;
use App\Http\Controllers\Api\Web\Authentication\LoginController;
use App\Http\Controllers\Api\Web\Authentication\LogoutController;
use App\Http\Controllers\Api\Web\Authentication\ProfileController;
use App\Http\Controllers\Api\Web\Frontoffice\UserActionAuthController;


use App\Http\Controllers\Api\Web\Backoffice\Publicateur\TagsController;
use App\Http\Controllers\Api\Web\Backoffice\Publicateur\AuthorsController;

use App\Http\Controllers\Api\Web\Backoffice\Admin\NewsLetterController;
use App\Http\Controllers\Api\Web\Backoffice\Admin\TypePublicationController;
use App\Http\Controllers\Api\Web\Backoffice\Admin\CategoryController;
use App\Http\Controllers\Api\Web\Backoffice\Admin\TagsAdminController;
use App\Http\Controllers\Api\Web\Backoffice\Admin\AuthorsAdminController;
use App\Http\Controllers\Api\Web\Backoffice\Admin\Publications\CRUD\AlertInfosAnnonceController;
use App\Http\Controllers\Api\Web\Backoffice\Admin\Publications\CRUD\ArticlesController;
use App\Http\Controllers\Api\Web\Backoffice\Admin\Publications\CRUD\PublicitesController;
use App\Http\Controllers\Api\Web\Backoffice\Admin\Publications\PublicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Les routes pour les données du haader

Route::get('/frontoffice/header/politique', [IncludesController::class, 'politiqueRequestData']);

Route::get('/frontoffice/header/afrique', [IncludesController::class, 'afriqueRequestData']);

Route::get('/frontoffice/header/monde', [IncludesController::class, 'mondeRequestData']);

Route::get('/frontoffice/header/diaspora', [IncludesController::class, 'diasporaRequestData']);

Route::get('/frontoffice/header/societe', [IncludesController::class, 'societeRequestData']);

Route::get('/frontoffice/header/sports', [IncludesController::class, 'sportsRequestData']);

Route::get('/frontoffice/header/chroniques', [IncludesController::class, 'chroniquesRequestData']);

Route::get('/frontoffice/header/economie', [IncludesController::class, 'economieRequestData']);

Route::get('/frontoffice/header/communique', [IncludesController::class, 'communiqueRequestData']);


//Routes pour les données du footer

Route::post('/frontoffice/footer/newsletter', [IncludesController::class, 'newsletterStoreRequest']);

Route::get('/frontoffice/footer/tags_populars', [IncludesController::class, 'tagsRequestData']);

Route::get('/frontoffice/footer/category_populars', [IncludesController::class, 'categoryRequestData']);

//Gestion d'envoi de message sans connexion de l'utilisateur

Route::post('/home/contact', [IncludesController::class, 'submitContact']); 


//Les routes pour les données de la page d'accueil

Route::get('/frontoffice/home_page/togo_politique', [HomeController::class, 'togoPolitiqueDataRequest']);

Route::get('/frontoffice/home_page/a_ne_pas_manquer_togo', [HomeController::class, 'aNePasManquerTogoDataRequest']);

Route::get('/frontoffice/home_page/international_fenetre_afrique_sports', [HomeController::class, 'internationalFenetreSurLAfriqueSportsDataRequest']);

Route::get('/frontoffice/home_page/societe', [HomeController::class, 'societeDataRequest']);

Route::get('/frontoffice/home_page/opinion_faits_divers', [HomeController::class, 'opinionFaitsDiversDataRequest']);

Route::get('/frontoffice/home_page/important', [HomeController::class, 'importantDataRequest']); 


Route::post('/frontoffice/save-push-notification-sub', [IncludesController::class, 'saveSubscription']);

//Les routes pour les matricules de référence

Route::post('/home/visitor/create_views', [IncludesController::class, 'generateVisitorMatriculeViews']);

Route::get('/home/visitor/{matricule}/check_views', [IncludesController::class, 'checkVisitorMatriculeViews']);

Route::post('/home/visitor/create_likes', [IncludesController::class, 'generateVisitorMatriculeLikes']);

Route::get('/home/visitor/{matricule}/check_likes', [IncludesController::class, 'checkVisitorMatriculeLikes']);

Route::post('/home/visitor/create_comments', [IncludesController::class, 'generateVisitorMatriculeComments']);

Route::get('/home/visitor/{matricule}/check_comments', [IncludesController::class, 'checkVisitorMatriculeComments']);
  
//Les routes pour les données de la page d'un article

Route::get('/article/{slug}/article_states/{local_storage_views}/check_likes_views/{local_storage_likes}', [IncludesController::class, 'articleState']);

Route::get('/article/{slug}/article_comments_states/{local_storage_comment}/check_comments', [IncludesController::class, 'articleComments']);


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    //Gestion du système de mot de passe oublié

    Route::post('send_otp/forgot_password', [ForgotPasswordController::class, 'sendOtpForgotPassword']);

    Route::patch('check_otp/forgot_password', [ForgotPasswordController::class, 'checkOtpForgotPassword']);

    Route::patch('new_pass/forgot_password', [ForgotPasswordController::class, 'newPassForgotPassword']);

    //Gestion du système d'inscription

    Route::post('send_otp/register', [RegisterController::class, 'sendOtpRegister']);

    Route::patch('check_otp/register', [RegisterController::class, 'checkOtpRegister']);

    Route::put('new_info/register', [RegisterController::class, 'newInfoRegister']);

    Route::patch('new_pass/register', [RegisterController::class, 'newPassRegister']);

    //Gestion de l' authentification et securité JWT

    Route::post('login', [LoginController::class, 'submitLogin']);

    Route::post('logout', [LogoutController::class, 'logout'])->middleware('auth:api');

    Route::post('me', [ProfileController::class, 'me'])->middleware('auth:api');

    Route::post('profile', [ProfileController::class, 'profile'])->middleware('auth:api');

    Route::put('updateMeProfile', [ProfileController::class, 'updateMeProfile'])->middleware('auth:api');

    Route::put('updateMePassword', [ProfileController::class, 'updateMePassword'])->middleware('auth:api');

    Route::get('role', [ProfileController::class, 'getRole'])->middleware('auth:api');

    //Gestion d'envoi de message avec connexion de l'utilisateur

    Route::post('/home/contact_auth', [UserActionAuthController::class, 'submitContactAuth'])->middleware('auth:api');

    //Gestion des likes avec connexion de l'utilisateur

    Route::get('/article/{slug}/article_likes/{local_storage_likes}/check_likes', [UserActionAuthController::class, 'actionsLikes'])->middleware('auth:api');

    Route::post('article/{slug}/actions_comments/{local_storage_comment}/comments_creator', [UserActionAuthController::class, 'submitCommentAuth'])->middleware('auth:api');
    
    //Gestion de la partie des publicateurs

        //Gestion des auteurs

        Route::get('/backoffice/publicator/authors_list', [AuthorsController::class, 'index'])->middleware('auth:api');

        Route::get('/backoffice/publicator/{slug}/authors_show', [AuthorsController::class, 'show'])->middleware('auth:api');

        Route::post('/backoffice/publicator/authors_store', [AuthorsController::class, 'store'])->middleware('auth:api');

        Route::put('/backoffice/publicator/{slug}/authors_update', [AuthorsController::class, 'update'])->middleware('auth:api');

        Route::delete('/backoffice/publicator/{slug}/authors_delete', [AuthorsController::class, 'delete'])->middleware('auth:api');

        //Gestion des tags

        Route::get('/backoffice/publicator/tags_list', [TagsController::class, 'index'])->middleware('auth:api');

        Route::get('/backoffice/publicator/tags_search_by_date', [TagsController::class, 'searchByDate'])->middleware('auth:api');

        Route::get('/backoffice/publicator/tags_search_by_date_infos', [TagsController::class, 'searchByDateInfos'])->middleware('auth:api');

        Route::get('/backoffice/publicator/{slug}/tags_show', [TagsController::class, 'show'])->middleware('auth:api');

        Route::post('/backoffice/publicator/tags_store', [TagsController::class, 'store'])->middleware('auth:api');

        Route::put('/backoffice/publicator/{slug}/tags_update', [TagsController::class, 'update'])->middleware('auth:api');

        Route::delete('/backoffice/publicator/{slug}/tags_delete', [TagsController::class, 'delete'])->middleware('auth:api');

    //Gestion de la partie administrative

        //Gestion des types de publications

        Route::get('/backoffice/admin/type_publication_list', [TypePublicationController::class, 'index'])->middleware('auth:api');

        Route::get('/backoffice/admin/{slug}/type_publication_show', [TypePublicationController::class, 'show'])->middleware('auth:api');

        Route::post('/backoffice/admin/type_publication_store', [TypePublicationController::class, 'store'])->middleware('auth:api');

        Route::put('/backoffice/admin/{slug}/type_publication_update', [TypePublicationController::class, 'update'])->middleware('auth:api');

        Route::delete('/backoffice/admin/{slug}/type_publication_delete', [TypePublicationController::class, 'delete'])->middleware('auth:api');

        //Gestion des catégories

        Route::get('/backoffice/admin/category_list', [CategoryController::class, 'index'])->middleware('auth:api');

        Route::get('/backoffice/admin/{slug}/category_show', [CategoryController::class, 'show'])->middleware('auth:api');

        Route::post('/backoffice/admin/category_store', [CategoryController::class, 'store'])->middleware('auth:api');

        Route::put('/backoffice/admin/{slug}/category_update', [CategoryController::class, 'update'])->middleware('auth:api');

        Route::delete('/backoffice/admin/{slug}/category_delete', [CategoryController::class, 'delete'])->middleware('auth:api');

        //Gestion des auteurs

        Route::get('/backoffice/admin/authors_list', [AuthorsAdminController::class, 'index'])->middleware('auth:api');

        Route::get('/backoffice/admin/authors_search_by_user', [AuthorsAdminController::class, 'searchByUser'])->middleware('auth:api');

        Route::get('/backoffice/admin/authors_search_by_user_infos', [AuthorsAdminController::class, 'searchByUserInfos'])->middleware('auth:api');

        Route::get('/backoffice/admin/{slug}/authors_show', [AuthorsAdminController::class, 'show'])->middleware('auth:api');

        Route::post('/backoffice/admin/authors_store', [AuthorsAdminController::class, 'store'])->middleware('auth:api');

        Route::put('/backoffice/admin/{slug}/authors_update', [AuthorsAdminController::class, 'update'])->middleware('auth:api');

        Route::delete('/backoffice/admin/{slug}/authors_delete', [AuthorsAdminController::class, 'delete'])->middleware('auth:api');


        //Gestion des tags

        Route::get('/backoffice/admin/tags_list', [TagsAdminController::class, 'index'])->middleware('auth:api');

        Route::get('/backoffice/admin/tags_search_by_date', [TagsAdminController::class, 'searchByDate'])->middleware('auth:api');

        Route::get('/backoffice/admin/tags_search_by_date_infos', [TagsAdminController::class, 'searchByDateInfos'])->middleware('auth:api');

        Route::get('/backoffice/admin/tags_search_by_user_infos', [TagsAdminController::class, 'searchByUserInfos'])->middleware('auth:api');

        Route::get('/backoffice/admin/{slug}/tags_show', [TagsAdminController::class, 'show'])->middleware('auth:api');

        Route::post('/backoffice/admin/tags_store', [TagsAdminController::class, 'store'])->middleware('auth:api');

        Route::put('/backoffice/admin/{slug}/tags_update', [TagsAdminController::class, 'update'])->middleware('auth:api');

        Route::delete('/backoffice/admin/{slug}/tags_delete', [TagsAdminController::class, 'delete'])->middleware('auth:api');

        //Gestion des newsletters

        Route::get('/backoffice/admin/news_letters_list', [NewsLetterController::class, 'index'])->middleware('auth:api');

        Route::get('/backoffice/admin/{status}/news_letters_search_by_status', [NewsLetterController::class, 'searchByStatus'])->middleware('auth:api');

        Route::get('/backoffice/admin/{slug}/news_letters_show', [NewsLetterController::class, 'show'])->middleware('auth:api');

        Route::post('/backoffice/admin/news_letters_store', [NewsLetterController::class, 'store'])->middleware('auth:api');

        Route::put('/backoffice/admin/{slug}/news_letters_update', [NewsLetterController::class, 'update'])->middleware('auth:api');

        Route::delete('/backoffice/admin/{slug}/news_letters_delete', [NewsLetterController::class, 'delete'])->middleware('auth:api');

        Route::patch('/backoffice/admin/{slug}/news_letters_activate', [NewsLetterController::class, 'activate'])->middleware('auth:api');

        Route::patch('/backoffice/admin/{slug}/news_letters_block', [NewsLetterController::class, 'block'])->middleware('auth:api');

        //Gestion des publications

        Route::get('/backoffice/admin/publications/change_programm', [PublicationController::class, 'changeStatusPublicationPrgramm']);

        Route::get('/backoffice/admin/publications/create/{slug}/type_publications', [PublicationController::class, 'publicationCreateBySlugType'])->middleware('auth:api');

        Route::post('/backoffice/admin/publications/create/{slug}/store_info_alert_annonce', [AlertInfosAnnonceController::class, 'storeInfoAlertAnnonce'])->middleware('auth:api');

        Route::post('/backoffice/admin/publications/create/{slug}/store_publicites', [PublicitesController::class, 'storePublicites'])->middleware('auth:api');

        Route::post('/backoffice/admin/publications/create/{slug}/store_articles', [ArticlesController::class, 'storeArticles'])->middleware('auth:api');
  
        Route::get('/backoffice/admin/publications/create/{slug}/get_files', [ArticlesController::class, 'getFiles']);
        
        Route::get('/backoffice/admin/publications/create/{slug}/get_files_search/{status}/search_by_type_files', [ArticlesController::class, 'searchByTypeFiles']);
        
        Route::get('/backoffice/admin/publications/create/{slug}/get_files', [PublicitesController::class, 'getFiles']);
        
        Route::get('/backoffice/admin/publications/create/{slug}/get_files_search/{status}/search_by_type_files', [PublicitesController::class, 'searchByTypeFiles']);

});

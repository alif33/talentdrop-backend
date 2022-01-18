<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TimezoneController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// User

Route::group([
    'prefix' => 'user'

], function () use ($router) {

    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/verify', [MailController::class, 'verification']);
    Route::post('/refresh', [UserController::class, 'refresh']);
    Route::post('/profile', [UserController::class, 'profile']);

});


// Company

Route::group([
    'prefix' => 'company'

], function () use ($router) {

    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/verify', [MailController::class, 'verification']);
    Route::post('/refresh', [UserController::class, 'refresh']);
    Route::post('/profile', [UserController::class, 'profile']);

});


// Admin

Route::group([
    'prefix' => 'admin'

], function () use ($router) {

    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/apply', [AdminController::class, 'apply']);
    Route::post('/register', [AdminController::class, 'register']);
    Route::post('refresh', 'UserController@refresh');
    Route::post('me', 'UserController@me');

});


// Category

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::post('/company', [CompanyController::class, 'store']);
    }
);


// Tag

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::get('/tags', [TagController::class, 'index']);
        Route::post('/tag', [TagController::class, 'store']);
        Route::put('/tag/{id}', [TagController::class, 'update']);
        Route::delete('/tag/{id}', [TagController::class, 'destory']);
    }
);


// Job

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::get('/jobs', [JobController::class, 'index']);
        Route::post('/job', [JobController::class, 'store']);
        Route::put('/job/{id}', [JobController::class, 'update']);
        Route::delete('/job/{id}', [JobController::class, 'destory']);
    }
);


// setup 

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::get('/setup', [SetupController::class, 'run']);
    }
);


// others 

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::get('/timezones', [TimezoneController::class, 'index']);
    }
);
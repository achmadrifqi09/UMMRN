<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;

use App\Http\Controllers\CurriculumVitaeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResearcherController;

// all user if login
Route::group(['middleware' => ['auth:student,researcher', 'back_button', 'status']], function(){
    route::get('/', [DashboardController::class, 'index']);
    route::get('/researchers', [ResearcherController::class, 'index']);
    route::get('/researchers/details/{id}', [ResearcherController::class, 'show']);

    route::get('/profile', [AccountController::class, 'index']);
    route::get('/profile/edit/{id}/{role}', [AccountController::class, 'edit']);
    route::put('/profile/edit/{id}/{role}', [AccountController::class, 'update']);
    route::post('/profile/change-image/{id}/{role}', [AccountController::class, 'changeImage']);

    route::get('/projects', [ProjectController::class, 'index']);
    route::get('/projects/detail/{id}', [ProjectController::class, 'show']);
    route::post('/projects/join', [ProjectController::class, 'join']);

    route::get('/communities', [CommunityController::class, 'index']);
    route::get('/communities/detail/{id}', [CommunityController::class, 'show']);
    route::post('/communities/join', [CommunityController::class, 'join']);
});


// super researcher
Route::group(['middleware' => ['auth:student,researcher', 'super_researcher', 'back_button', 'status']], function(){
    Route::get('/researchers/create', [ResearcherController::class, 'create']);
    Route::post('/researchers/create', [ResearcherController::class, 'store']);
    Route::delete('/researchers/destroy/{id}', [ResearcherController::class, 'destroy']);
});

// researcher
Route::group(['middleware' => ['auth:student,researcher', 'researcher', 'back_button', 'status']], function(){
    Route::get('/curriculum-vintae/create', [CurriculumVitaeController::class, 'create']);
    Route::post('/curriculum-vintae/create', [CurriculumVitaeController::class, 'store']);
    Route::get('/curriculum-vintae/edit/{id}', [CurriculumVitaeController::class, 'edit']);
    Route::put('/curriculum-vintae/edit/{id}', [CurriculumVitaeController::class, 'update']);

    route::get('/projects/create', [ProjectController::class, 'create']);
    route::post('/projects/create', [ProjectController::class, 'store']);
    route::get('/projects/edit/{id}', [ProjectController::class, 'edit']);
    route::post('/projects/edit/{id}', [ProjectController::class, 'update']);
    route::post('/projects/approval', [ProjectController::class, 'approval']);
    route::delete('/projects/destroy/{id}', [ProjectController::class, 'destroy']);

    route::get('/communities/create', [CommunityController::class, 'create']);
    route::post('/communities/create', [CommunityController::class, 'store']);
    route::get('/communities/manage/{id}', [CommunityController::class, 'manage']);
    route::post('/communities/approval', [CommunityController::class, 'approval']);
});

Route::get('/error-page', function(){
    return view('pages/errors/index', ['errorMessage' => "Access Denied ..", 'desc' => "You don't have permission to acces this page."]);
});

Route::get('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/signin', [AuthController::class, 'validateUser']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/signup', [AuthController::class, 'signup']);
Route::post('/signup', [AuthController::class, 'createAccount']);

Route::get('/resend-code/{id}/{role}', [AuthController::class, 'resendCode']);
Route::get('/otp-validation/{id}/{role}', [AuthController::class, 'otp'])->name('otp-validation');
Route::post('/otp-validation/{id}/{role}', [AuthController::class, 'validateOtp']);

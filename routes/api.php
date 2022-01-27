<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SociaLiteController;
use App\Http\Controllers\SubjectCategoryController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\SubSectionController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
// */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
// Route::post('reset-password', [NewPasswordController::class, 'reset']);
// Route::get('reset-password', [NewPasswordController::class, 'getTokenReset'])->name('password.reset');

Route::middleware('guest')->group(function () {
    //Register&Login
    Route::post('register', [UserController::class, 'store']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('auth/{provider}', [SociaLiteController::class, 'redirectToProvider']);
    Route::get('auth/{provider}/callback', [SociaLiteController::class, 'handleProvideCallback']);
    //Verif
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/send-email-verification', [VerificationController::class, 'sendVerificationEmail']);
    // Reset PW
    Route::post('/forgot-password', [NewPasswordController::class, 'forgotPassword'])->name('password.email');
    Route::post('/forgot-password/{id}', [NewPasswordController::class, 'verifOtp'])->name('password.verif');
    Route::post('/reset-password/{id}', [NewPasswordController::class, 'resetPassword'])->name('password.reset');

    // Subject
    Route::get('/subject', [SubjectController::class, 'index']);
    Route::get('/subject/{id}', [SubjectController::class, 'show']);

    // SubjectCategory
    Route::get('/category', [SubjectCategoryController::class, 'index']);
    Route::get('/category/{id}', [SubjectCategoryController::class, 'show']);

    // Section
    Route::get('section/{id}', [SectionController::class, 'show']);

    // Subsection
    Route::get('subsection/{id}', [SubSectionController::class, 'show']);

    // Grade
    Route::get('grade', [GradeController::class, 'index']);
    Route::get('grade/{id}', [GradeController::class, 'show']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Subject
    Route::post('subject', [SubjectController::class, 'store']);
    Route::post('subject/${id}', [SubjectController::class, 'update']);
    Route::delete('subject/${id}', [SubjectController::class, 'destroy']);

    // SubjectCategory
    Route::post('category', [SubjectCategoryController::class, 'store']);
    Route::post('category/${id}', [SubjectCategoryController::class, 'update']);
    Route::delete('category/${id}', [SubjectCategoryController::class, 'destroy']);

    // Grade
    Route::post('grade', [GradeController::class, 'store']);
    Route::post('grade/{id}', [GradeController::class, 'update']);
    Route::delete('grade/{id}', [GradeController::class, 'destroy']);

    // Section
    Route::post('section', [SectionController::class, 'store']);
    Route::post('section/{id}', [SectionController::class, 'update']);
    Route::delete('section/{id}', [SectionController::class, 'destroy']);

    // Subsection
    Route::post('subsection', [SubSectionController::class, 'store']);
    Route::post('subsection/{id}', [SubSectionController::class, 'update']);
    Route::delete('subsection/{id}', [SubSectionController::class, 'destroy']);
});

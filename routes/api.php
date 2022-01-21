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
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('category', SubjectCategoryController::class);

    // Grade
    Route::get('grade', [GradeController::class, 'index']);
    Route::post('grade', [GradeController::class, 'store']);
    Route::get('grade/{id}', [GradeController::class, 'show']);
    Route::put('grade/{id}', [GradeController::class, 'update']);
    Route::delete('grade/{id}', [GradeController::class, 'destroy']);

    // Section
    Route::apiResource('section', SectionController::class)->except('index');
    Route::apiResource('subject', SubjectController::class);

    //Subsection
    Route::apiResource('subsection', SubSectionController::class)->except('index');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonCompletionController;
use App\Http\Controllers\CourseRatingController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\StudentAnswerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // ----------------------
    // Users
    // ----------------------
    Route::middleware('role:admin')->group(function() {
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
    });

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);

    // ----------------------
    // Courses
    // ----------------------
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);

    Route::middleware('role:admin')->group(function() {
        Route::post('/courses', [CourseController::class, 'store']);
        Route::put('/courses/{id}', [CourseController::class, 'update']);
        Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
        Route::patch('/courses/{id}/toggle-publish', [CourseController::class, 'togglePublish']);
    });

    // ----------------------
    // Lessons
    // ----------------------
    Route::get('/lessons', [LessonController::class, 'index']);
    Route::get('/lessons/{id}', [LessonController::class, 'show']);

    Route::middleware('role:admin')->group(function() {
        Route::post('/lessons', [LessonController::class, 'store']);
        Route::put('/lessons/{id}', [LessonController::class, 'update']);
        Route::delete('/lessons/{id}', [LessonController::class, 'destroy']);
    });

    // ----------------------
    // Enrollments
    // ----------------------
    Route::middleware('role:admin')->group(function() {
        Route::post('/enrollments', [EnrollmentController::class, 'store']);
        Route::put('/enrollments/{id}', [EnrollmentController::class, 'update']);
        Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy']);
    });
    Route::get('/enrollments', [EnrollmentController::class, 'index']);
    Route::get('/enrollments/{id}', [EnrollmentController::class, 'show']);

    // ----------------------
    // Lesson Completions
    // ----------------------
    Route::middleware('role:admin')->group(function() {
        Route::post('/lessonCompletions', [LessonCompletionController::class, 'store']);
        Route::delete('/lessonCompletions/{id}', [LessonCompletionController::class, 'destroy']);
    });
    Route::get('/lessonCompletions', [LessonCompletionController::class, 'index']);
    Route::get('/lessonCompletions/{id}', [LessonCompletionController::class, 'show']);

    // ----------------------
    // Course Ratings
    // ----------------------
    Route::middleware('role:admin')->group(function() {
        Route::post('/courseRatings', [CourseRatingController::class, 'store']);
        Route::delete('/courseRatings/{id}', [CourseRatingController::class, 'destroy']);
    });
    Route::get('/courseRatings', [CourseRatingController::class, 'index']);
    Route::get('/courseRatings/{id}', [CourseRatingController::class, 'show']);

    // ----------------------
    // Certificates
    // ----------------------
    Route::middleware('role:admin')->group(function() {
        Route::post('/certificates', [CertificateController::class, 'store']);
        Route::delete('/certificates/{id}', [CertificateController::class, 'destroy']);
    });
    Route::get('/certificates', [CertificateController::class, 'index']);
    Route::get('/certificates/{id}', [CertificateController::class, 'show']);

    // ----------------------
    // Quizzes
    // ----------------------
    Route::middleware('role:admin')->group(function() {
        Route::post('/quizzes', [QuizController::class, 'store']);
        Route::put('/quizzes/{id}', [QuizController::class, 'update']);
        Route::delete('/quizzes/{id}', [QuizController::class, 'destroy']);
    });
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::get('/quizzes/{id}', [QuizController::class, 'show']);

    // ----------------------
    // Questions
    // ----------------------
    Route::middleware('role:admin')->group(function() {
        Route::post('/questions', [QuestionController::class, 'store']);
        Route::put('/questions/{id}', [QuestionController::class, 'update']);
        Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);
    });
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::get('/questions/{id}', [QuestionController::class, 'show']);

    // ----------------------
    // Answers
    // ----------------------
    Route::middleware('role:admin')->group(function() {
        Route::post('/answers', [AnswerController::class, 'store']);
        Route::put('/answers/{id}', [AnswerController::class, 'update']);
        Route::delete('/answers/{id}', [AnswerController::class, 'destroy']);
    });
    Route::get('/answers', [AnswerController::class, 'index']);
    Route::get('/answers/{id}', [AnswerController::class, 'show']);

    // ----------------------
    // Quiz Attempts
    // ----------------------
    Route::middleware('role:admin')->group(function() {
        Route::post('/quizAttempts', [QuizAttemptController::class, 'store']);
        Route::delete('/quizAttempts/{id}', [QuizAttemptController::class, 'destroy']);
    });
    Route::get('/quizAttempts', [QuizAttemptController::class, 'index']);
    Route::get('/quizAttempts/{id}', [QuizAttemptController::class, 'show']);

    // ----------------------
    // Student Answers
    // ----------------------
    Route::middleware('role:admin')->group(function() {
        Route::post('/studentAnswers', [StudentAnswerController::class, 'store']);
        Route::delete('/studentAnswers/{id}', [StudentAnswerController::class, 'destroy']);
    });
    Route::get('/studentAnswers', [StudentAnswerController::class, 'index']);
    Route::get('/studentAnswers/{id}', [StudentAnswerController::class, 'show']);

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizResultController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\QuizResult;

Route::get('/', function () {
    return view('quiz');
});

// Endpoint to receive quiz submissions from the client-side JS
Route::post('/quiz/submit', function (\Illuminate\Http\Request $request) {
    $data = $request->all();

    $payload = [
        'q1' => $data['Q1'] ?? null,
        'q2' => $data['Q2'] ?? null,
        'q3' => $data['Q3'] ?? null,
        'q4' => $data['Q4'] ?? null,
        'q5' => $data['Q5'] ?? null,
        'q6' => $data['Q6'] ?? null,
        'score_a' => $data['ScoreA'] ?? 0,
        'score_b' => $data['ScoreB'] ?? 0,
        'score_c' => $data['ScoreC'] ?? 0,
        'score_d' => $data['ScoreD'] ?? 0,
        'score_e' => $data['ScoreE'] ?? 0,
        'final_category' => $data['FinalCategory'] ?? null,
        'final_category_name' => $data['FinalCategoryName'] ?? null,
        'rolling_list' => $data['RollingList'] ?? null,
    ];

    // attach user if authenticated
    if (auth()->check()) {
        $payload['user_id'] = auth()->id();
    }

    $result = QuizResult::create($payload);

    return response()->json(['ok' => true, 'id' => $result->id]);
});

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

// Password reset (request link + reset)
use App\Http\Controllers\Auth\PasswordResetController;

Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

// Admin routes — protect using the EnsureAdmin middleware class
Route::middleware([\App\Http\Middleware\EnsureAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.quiz_results.index');
    })->name('home');

    Route::get('quiz-results', [QuizResultController::class, 'index'])->name('quiz_results.index');
    Route::get('quiz-results/{quizResult}', [QuizResultController::class, 'show'])->name('quiz_results.show');
    Route::get('quiz-results/{quizResult}/edit', [QuizResultController::class, 'edit'])->name('quiz_results.edit');
    Route::put('quiz-results/{quizResult}', [QuizResultController::class, 'update'])->name('quiz_results.update');
    Route::delete('quiz-results/{quizResult}', [QuizResultController::class, 'destroy'])->name('quiz_results.destroy');
    Route::get('quiz-results/export', [QuizResultController::class, 'export'])->name('quiz_results.export');
    Route::post('quiz-results/export-sheets', [QuizResultController::class, 'exportToSheets'])->name('quiz_results.export_sheets');
});

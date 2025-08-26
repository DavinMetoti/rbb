<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;

// Redirect root to participants (public view)
Route::get('/', function () {
    return redirect('/participants');
});

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Language switching
Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'zh'])) {
        session(['applocale' => $lang]);
    }
    return redirect()->back();
});

// Protected routes - only authenticated users can create, edit, delete
Route::middleware(['auth'])->group(function () {
    Route::get('/participants/create', [ParticipantController::class, 'create'])->name('participants.create');
    Route::post('/participants', [ParticipantController::class, 'store'])->name('participants.store');
    Route::get('/participants/{participant}/edit', [ParticipantController::class, 'edit'])->name('participants.edit');
    Route::put('/participants/{participant}', [ParticipantController::class, 'update'])->name('participants.update');
    Route::delete('/participants/{participant}', [ParticipantController::class, 'destroy'])->name('participants.destroy');
    
    // Password change routes
    Route::get('/password/change', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [PasswordController::class, 'changePassword'])->name('password.update');
});

// Public routes - anyone can view participants (read-only access)
Route::get('/participants', [ParticipantController::class, 'index'])->name('participants.index');
Route::get('/participants/{participant}', [ParticipantController::class, 'show'])->name('participants.show');
Route::get('/participants/{participant}/pdf', [ParticipantController::class, 'downloadPdf'])->name('participants.pdf');

// Debug routes (remove in production) - temporary without auth
Route::get('/debug/participant', [ParticipantController::class, 'debug'])->name('participant.debug');
Route::get('/debug/participant/test', [ParticipantController::class, 'testCreate'])->name('participant.test');

// Debug locale route
Route::get('/debug/locale', function () {
    return response()->json([
        'session_locale' => session('applocale'),
        'app_locale' => app()->getLocale(),
        'config_locale' => config('app.locale'),
        'all_session' => session()->all(),
        'translation_test' => [
            'participants' => __('participants'),
            'add_participant' => __('add_participant'), 
            'logout' => __('logout')
        ]
    ]);
})->name('debug.locale');

// Test locale page
Route::get('/test/locale', function () {
    return view('test.locale');
})->name('test.locale');

// Debug routes (remove in production) - temporary without auth
Route::get('/debug/participant', [ParticipantController::class, 'debug'])->name('participant.debug');
Route::get('/debug/participant/test', [ParticipantController::class, 'testCreate'])->name('participant.test');

// Debug locale route
Route::get('/debug/locale', function () {
    return response()->json([
        'session_locale' => session('applocale'),
        'app_locale' => app()->getLocale(),
        'config_locale' => config('app.locale'),
        'all_session' => session()->all(),
        'translation_test' => [
            'participants' => __('participants'),
            'add_participant' => __('add_participant'), 
            'logout' => __('logout')
        ]
    ]);
})->name('debug.locale');

// Test locale page
Route::get('/test/locale', function () {
    return view('test.locale');
})->name('test.locale');

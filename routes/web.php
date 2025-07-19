<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Dashboard\{ProfileController, DashboardController};
use App\Http\Controllers\Admin\{AdminDashboardController, MockTestController};
use App\Http\Controllers\Teacher\{DashboardController as TeacherDashboardController, ReviewController};
use App\Http\Controllers\Test\TestDeliveryController;

// ========================================================
// 🌐 Public Pages
// ========================================================
Route::view('/', 'index');
Route::view('/privacy', 'home.privacy.privacy');
Route::view('/terms', 'home.terms.terms');
Route::view('/cookies', 'home.cookies.cookies');

// ========================================================
// 🔐 Google Authentication
// ========================================================
Route::middleware('guest')->group(function () {
    Route::view('/auth', 'auth.auth')->name('auth');
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
});

// ========================================================
// 👤 Authenticated User Routes
// ========================================================
Route::middleware('auth')->group(function () {
    // 🔓 Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('auth');
    })->name('logout');

    // 🙍‍♂️ Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::get('/{id}', [ProfileController::class, 'show'])->name('profile.show');
    });

    // 📊 User Dashboard
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/history', [DashboardController::class, 'history'])->name('history');
        Route::get('/history/{id}', [DashboardController::class, 'view'])->name('history.view');
        Route::get('/leaderboard', [DashboardController::class, 'leaderboard'])->name('leaderboard');

        Route::prefix('tests')->name('tests.')->group(function () {
            // Add more skills as needed
            Route::get('/writing', [DashboardController::class, 'writing'])->name('writing');
            Route::get('/speaking', [DashboardController::class, 'speaking'])->name('speaking');
        });
    });

    // 🧪 Take Test
    // Route::get('/take-test/{id}/{skill}', [TakeTestController::class, 'redirect'])->name('test.take');
    Route::get('/take-test/{id}', [TestDeliveryController::class, 'show'])->name('test.take');
    Route::post('/take-test', [TestDeliveryController::class, 'store'])->name('test.submit');


    // 🔔 Notifications
    Route::patch('/notifications/{id}/read', function ($id) {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();
        return back();
    })->name('notifications.read');
});

// ========================================================
// 🛠️ Admin Routes (Boss & Admin Roles)
// ========================================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:boss,admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:boss'])->group(function () {
    Route::get('/test/{test}/edit', [MockTestController::class, 'edit'])->name('tests.edit');
    Route::put('/test/{test}', [MockTestController::class, 'update'])->name('tests.update');
    Route::delete('/test/{test}', [MockTestController::class, 'destroy'])->name('tests.destroy');
    Route::get('/test/{test}', [MockTestController::class, 'show'])->name('tests.show');
    Route::resource('user', UserController::class)->except(['show']);

    Route::prefix('writing')->group(function () {
        Route::get('/', [MockTestController::class, 'index'])->name('tests.index');
        Route::get('/create', [MockTestController::class, 'create'])->name('tests.create');
        Route::post('/', [MockTestController::class, 'store'])->name('tests.store');
    });
});
// ========================================================
// 👩‍🏫 Teacher Routes (Manual Review System)
// ========================================================
Route::prefix('teacher')->name('teacher.')->middleware(['auth', 'role:boss,teacher'])->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::get('/{id}', [ReviewController::class, 'show'])->name('show');
        Route::put('/{id}', [ReviewController::class, 'update'])->name('update');
    });
});

// ========================================================
// 🌍 Language Localization Routes
// ========================================================
require __DIR__ . '/lang.php';

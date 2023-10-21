<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\LessonController;

Route::get('/', function () {
    return view('welcome');
});

// Rotas de Autenticação
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerSave'])->name('register.save');

Route::get('auth/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('auth/login', [AuthController::class, 'login'])->name('login.action');

Route::middleware('jwt.auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:api')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('courses')->group(function () {
        Route::get('', [CourseController::class, 'index'])->name('courses');
        Route::get('create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('store', [CourseController::class, 'store'])->name('courses.store');
        Route::get('show/{id}', [CourseController::class, 'show'])->name('courses.show');
        Route::get('edit/{id}', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('edit/{id}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('destroy/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });

    Route::resource('enrollments', EnrollmentController::class);

    Route::middleware('checkRole:Aluno')->group(function () {
        // Rotas específicas para alunos
    });

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware(['checkRole:Professor,Administração'])->group(function () {
        Route::prefix('modules')->group(function () {
            Route::get('', [ModuleController::class, 'index'])->name('modules.index');
            Route::get('create', [ModuleController::class, 'create'])->name('modules.create');
            Route::post('store', [ModuleController::class, 'store'])->name('modules.store');
            Route::get('show/{id}', [ModuleController::class, 'show'])->name('modules.show');
            Route::get('edit/{id}', [ModuleController::class, 'edit'])->name('modules.edit');
            Route::put('update/{id}', [ModuleController::class, 'update'])->name('modules.update');
            Route::delete('destroy/{id}', [ModuleController::class, 'destroy'])->name('modules.destroy');
        });
    });

    Route::resource('lessons', LessonController::class);
    Route::resource('slides', SlideController::class);
});

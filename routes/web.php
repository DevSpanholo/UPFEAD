<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AssessmentQuestionUserController;
use App\Http\Controllers\QuestionOptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProfileController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
  
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
  
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
 
    Route::controller(CourseController::class)->prefix('courses')->group(function () {
        Route::get('', 'index')->name('courses');
        Route::get('create', 'create')->name('courses.create');
        Route::post('store', 'store')->name('courses.store');
        Route::get('show/{id}', 'show')->name('courses.show');
        Route::get('edit/{id}', 'edit')->name('courses.edit');
        Route::put('edit/{id}', 'update')->name('courses.update');
        Route::delete('destroy/{id}', 'destroy')->name('courses.destroy');
        
    });
 
    Route::resource('enrollments', EnrollmentController::class);


        // Rotas específicas para alunos
    Route::middleware('checkRole:Aluno')->group(function () {

        });


    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');

    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware(['auth', 'checkRole:Professor,Administração'])->group(function () {
    Route::get('modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('modules/create', [ModuleController::class, 'create'])->name('modules.create');
    Route::post('modules/create', [ModuleController::class, 'store']);
    Route::post('modules/store', [ModuleController::class, 'store'])->name('modules.store');
    Route::get('modules/edit/{id}', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::put('modules/update/{id}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('modules/destroy/{id}', [ModuleController::class, 'destroy'])->name('modules.destroy');
    Route::get('modules/{id}', [ModuleController::class, 'show'])->name('modules.show');
});

Route::resource('lessons', LessonController::class);

Route::resource('slides', SlideController::class);


Route::resource('assessments', AssessmentController::class);

Route::prefix('assessments/{assessment}')->group(function () {
    Route::post('questions', [AssessmentQuestionUserController::class, 'store'])->name('assessments.questions.store');
    Route::put('questions/{question}', [AssessmentQuestionUserController::class, 'update'])->name('assessments.questions.update');
    Route::delete('questions/{question}', [AssessmentQuestionUserController::class, 'destroy'])->name('assessments.questions.destroy');
});

    Route::resource('question-options', QuestionOptionController::class);

    Route::resource('questions', QuestionController::class);

});
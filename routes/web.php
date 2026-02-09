<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseOfferController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
Route::get('/course/edit', [CourseController::class, 'edit'])->name('course.edit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/course-offer', [CourseOfferController::class, 'index'])->name('course-offer.index');
    Route::get('/course-offer/create', [CourseOfferController::class, 'create'])->name('course-offer.create');
    Route::get('/course-offer/edit', [CourseOfferController::class, 'edit'])->name('course-offer.edit');

    Route::get('/faculty', [FacultyController::class, 'index'])->name('faculty.index');
    Route::get('/faculty/create', [FacultyController::class, 'create'])->name('faculty.create');
    Route::get('/faculty/edit', [FacultyController::class, 'edit'])->name('faculty.edit');

    Route::get('/period', [PeriodController::class, 'index'])->name('period.index');
    Route::get('/period/create', [PeriodController::class, 'create'])->name('period.create');
    Route::get('/period/edit', [PeriodController::class, 'edit'])->name('period.edit');

    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::get('/student/edit', [StudentController::class, 'edit'])->name('student.edit');
});

require __DIR__.'/auth.php';

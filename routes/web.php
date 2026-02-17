<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseOfferController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::get('/courses/edit', [CourseController::class, 'edit'])->name('courses.edit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
    Route::get('/students/edit', [StudentController::class, 'edit'])->name('student.edit');

    Route::get('/course_offer', [CourseOfferController::class, 'index'])->name('course_offer.index');
    Route::get('/course_offer/create', [CourseOfferController::class, 'create'])->name('course_offer.create');
    Route::get('/course_offer/edit', [CourseOfferController::class, 'edit'])->name('course_offer.edit');

    Route::get('/faculties', [FacultyController::class, 'index'])->name('faculty.index');
    Route::get('/faculties/create', [FacultyController::class, 'create'])->name('faculty.create');
    Route::get('/faculties/edit', [FacultyController::class, 'edit'])->name('faculty.edit');

    Route::get('/period', [PeriodController::class, 'index'])->name('period.index');
    Route::get('/period/create', [PeriodController::class, 'create'])->name('period.create');
    Route::get('/period/edit', [PeriodController::class, 'edit'])->name('period.edit');
});

require __DIR__.'/auth.php';

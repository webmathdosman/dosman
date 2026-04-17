<?php

use App\Enums\UserRole;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentDisciplineSummaryController;
use App\Http\Controllers\StudentAchievementController;
use App\Http\Controllers\StudentViolationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/admin/users', 'dashboard')
        ->middleware('role:'.UserRole::SuperAdmin->value)
        ->name('admin.users');

    Route::view('/teacher/rapor', 'dashboard')
        ->middleware('role:'.UserRole::Teacher->value)
        ->name('teacher.rapor');

    Route::view('/student/rapor', 'dashboard')
        ->middleware('role:'.UserRole::Student->value)
        ->name('student.rapor');

    Route::get('/reports', [ReportController::class, 'index'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('reports.index');
    Route::post('/reports', [ReportController::class, 'store'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('reports.store');
    Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('reports.edit');
    Route::put('/reports/{report}', [ReportController::class, 'update'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('reports.update');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('reports.destroy');
    Route::get('/reports-export-pdf', [ReportController::class, 'exportPdf'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('reports.export-pdf');

    Route::get('/attendances', [AttendanceController::class, 'index'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('attendances.index');
    Route::post('/attendances', [AttendanceController::class, 'store'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('attendances.store');
    Route::get('/attendances/{attendance}/edit', [AttendanceController::class, 'edit'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('attendances.edit');
    Route::put('/attendances/{attendance}', [AttendanceController::class, 'update'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('attendances.update');
    Route::delete('/attendances/{attendance}', [AttendanceController::class, 'destroy'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('attendances.destroy');

    Route::get('/violations', [StudentViolationController::class, 'index'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('violations.index');
    Route::post('/violations', [StudentViolationController::class, 'store'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('violations.store');
    Route::get('/violations/{violation}/edit', [StudentViolationController::class, 'edit'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('violations.edit');
    Route::put('/violations/{violation}', [StudentViolationController::class, 'update'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('violations.update');
    Route::delete('/violations/{violation}', [StudentViolationController::class, 'destroy'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('violations.destroy');

    Route::get('/achievements', [StudentAchievementController::class, 'index'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('achievements.index');
    Route::post('/achievements', [StudentAchievementController::class, 'store'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('achievements.store');
    Route::get('/achievements/{achievement}/edit', [StudentAchievementController::class, 'edit'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('achievements.edit');
    Route::put('/achievements/{achievement}', [StudentAchievementController::class, 'update'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('achievements.update');
    Route::delete('/achievements/{achievement}', [StudentAchievementController::class, 'destroy'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('achievements.destroy');

    Route::get('/students/{student}/discipline-summary', [StudentDisciplineSummaryController::class, 'show'])
        ->middleware('role:'.UserRole::Teacher->value.','.UserRole::SuperAdmin->value)
        ->name('students.discipline-summary');
});

require __DIR__.'/auth.php';

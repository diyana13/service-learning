<?php

use App\Http\Controllers\AssessorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
// });

Route::group(['middleware' => ['auth', 'role:lecturer']], function () {
    Route::get('lecturer/home', [HomeController::class, 'lecturerIndex'])->name('lecturer.home');
    Route::get('lecturer/projects', [ProjectController::class, 'index'])->name('lecturer.projects');
    Route::get('lecturer/projects/create', [ProjectController::class, 'create'])->name('lecturer.create');
    Route::post('lecturer/projects/store', [ProjectController::class, 'store'])->name('lecturer.store');
    Route::get('lecturer/projects/{project}/show', [ProjectController::class, 'show'])->name('lecturer.show');
    Route::get('lecturer/projects/{project}/edit', [ProjectController::class, 'edit'])->name('lecturer.edit');
    Route::put('lecturer/projects/{project}/update', [ProjectController::class, 'update'])->name('lecturer.update');
    Route::delete('lecturer/{project}/destroy', [ProjectController::class, 'destroy'])->name('lecturer.destroy');
    Route::get('lecturer/projects/{student}/students_mark', [ProjectController::class, 'studentsMark'])->name('lecturer.students-mark');

    Route::get('lecturer/projects/{group}/evaluate', [ProjectController::class, 'evaluate'])->name('lecturer.evaluate');
    Route::post('lecturer/projects/{group}/store', [ProjectController::class, 'storeEvaluate'])->name('lecturer.store-evaluate');

    // PDF route
    Route::get('lecturer/projects/{project}/students_mark/pdf', [ProjectController::class, 'generatePdf'])->name('lecturer.generate-pdf');
});

Route::group(['middleware' => ['auth', 'role:student']], function () {
    Route::get('student/home', [HomeController::class, 'studentIndex'])->name('student.home');
    Route::get('student/projects', [StudentController::class, 'index'])->name('student.student-project');
    Route::post('student/projects/search', [StudentController::class, 'search'])->name('student.search-project');
    Route::post('student/projects/{project}/register', [StudentController::class, 'register'])->name('student.register');
    Route::get('student/projects/{project}/show', [StudentController::class, 'show'])->name('student.show-project');
    Route::get('student/projects/{project}/{group}/{groupMember}/evaluate', [StudentController::class, 'evaluate'])->name('student.evaluate');
    Route::post('student/projects/store', [StudentController::class, 'storeEvaluation'])->name('student.store-evaluation');
});

Route::group(['middleware' => ['auth', 'role:assessor']], function () {
    Route::get('assessor/home', [HomeController::class, 'assessorIndex'])->name('assessor.home');
    Route::get('assessor/projects', [AssessorController::class, 'index'])->name('assessor.project-list');
    Route::post('assessor/projects/search', [AssessorController::class, 'search'])->name('assessor.search-project');
    Route::post('assessor/projects/{project}/register', [AssessorController::class, 'register'])->name('assessor.register');
    Route::get('assessor/projects/{project}/show', [AssessorController::class, 'show'])->name('assessor.show-project');
    Route::get('assessor/projects/{group}/evaluate', [AssessorController::class, 'evaluate'])->name('assessor.evaluate');
    Route::post('assessor/projects/{group}/store', [AssessorController::class, 'storeEvaluate'])->name('assessor.store-evaluate');
});

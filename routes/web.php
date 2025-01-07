<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
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
});

Route::group(['middleware' => ['auth', 'role:student']], function () {
    Route::get('student/home', [HomeController::class, 'studentIndex'])->name('student.home');
    Route::get('student/projects', [ProjectController::class, 'studentProject'])->name('student.student-project');
    Route::post('student/projects/search', [ProjectController::class, 'searchProject'])->name('student.search-project');
    Route::post('student/projects/{project}/register', [ProjectController::class, 'registerProject'])->name('student.register');
    Route::get('student/projects/{project}/showStudent', [ProjectController::class, 'showStudent'])->name('student.show-project');
});

Route::group(['middleware' => ['auth', 'role:assessor']], function () {
    Route::get('assessor/home', [HomeController::class, 'assessorIndex'])->name('assessor.home');
    Route::get('assessor/projects', [ProjectController::class, 'ProjectList'])->name('assessor.project-list');
    Route::post('assessor/projects/search', [ProjectController::class, 'searchAssessor'])->name('assessor.search-project');
    Route::post('assessor/projects/{project}/register', [ProjectController::class, 'ProjectAssessor'])->name('assessor.register');
    Route::get('assessor/projects/{project}/showAssessor', [ProjectController::class, 'showAssessor'])->name('assessor.show-project');
});

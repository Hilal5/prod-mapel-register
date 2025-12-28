<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ClassController;

// Redirect root ke dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Mata Pelajaran Routes
Route::prefix('mata-pelajaran')->name('subjects.')->group(function () {
    Route::get('/', [SubjectController::class, 'index'])->name('index');
    Route::get('/{id}', [SubjectController::class, 'show'])->name('show');
    
    // Admin only (nanti bisa ditambah middleware)
    Route::get('/create', [SubjectController::class, 'create'])->name('create');
    Route::post('/', [SubjectController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [SubjectController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SubjectController::class, 'update'])->name('update');
    Route::delete('/{id}', [SubjectController::class, 'destroy'])->name('destroy');
});

// Jadwal Routes
Route::prefix('jadwal')->name('schedules.')->group(function () {
    Route::get('/', [ScheduleController::class, 'index'])->name('index');
    Route::get('/kelas/{classId}', [ScheduleController::class, 'byClass'])->name('by-class');
    Route::get('/hari/{day}', [ScheduleController::class, 'byDay'])->name('by-day');
});

// Registrasi Routes
Route::prefix('registrasi')->name('registrations.')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('index');
    Route::post('/daftar', [RegistrationController::class, 'register'])->name('register');
    Route::get('/saya', [RegistrationController::class, 'myRegistrations'])->name('my');
    Route::delete('/{id}', [RegistrationController::class, 'cancel'])->name('cancel');
});

// Kelas Routes
Route::prefix('kelas')->name('classes.')->group(function () {
    Route::get('/', [ClassController::class, 'index'])->name('index');
    Route::get('/{id}', [ClassController::class, 'show'])->name('show');
    Route::get('/{id}/siswa', [ClassController::class, 'students'])->name('students');
});

// Auth Routes (nanti kita buat)
// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
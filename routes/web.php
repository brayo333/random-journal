<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\JournalEntryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('MainApp/Home');
});

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);


Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/journal', [JournalEntryController::class, 'index']);
    Route::post('/journal/new', [JournalEntryController::class, 'store']);
    Route::delete('/journal/{id}', [JournalEntryController::class, 'destroy']);
    Route::get('/journal/random', [JournalEntryController::class, 'random']);
});

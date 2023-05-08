<?php

use App\Http\Controllers\api\v1\AuthController;
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
});

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
});

Route::post('/login', [AuthController::class, 'login']);

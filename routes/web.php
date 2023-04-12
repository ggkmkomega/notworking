<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;

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
    return view('landing');
});

Route::get('cp', [AdminAuthController::class, 'controlPanel']);
Route::get('cp/login', [AdminAuthController::class, 'login'])->name('login');
Route::post('cp/loginin', [AdminAuthController::class, 'admLogin'])->name('login-c');
Route::get('cp/signout', [AdminAuthController::class, 'signOut'])->name('signout');
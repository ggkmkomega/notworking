<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\SoftwareController;
use App\Http\Middleware\AdminAuth;

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

Route::get('cp', [AdminAuthController::class, 'controlPanel'])
    ->middleware([AdminAuth::class])
    ->name('cp');
Route::get('cp/login', [AdminAuthController::class, 'login'])->name('login');
Route::post('cp/loginin', [AdminAuthController::class, 'admLogin'])->name('login-c');
Route::get('cp/signout', [AdminAuthController::class, 'signOut'])->name('signout');
Route::get('cp/profile', [AdminAuthController::class, 'showProfile'])->name('adminProfile');

Route::get('cp/hardwares/{hardware}/edit/dltimg/{img}', [HardwareController::class, 'deleteImg'])->name('hwdeleteImg');
Route::resource('cp/hardwares', HardwareController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy', 'show'])
    ->middleware([AdminAuth::class]);

Route::get('cp/softwares/{software}/edit/dltimg/{img}', [SoftwareController::class, 'deleteImg'])->name('swdeleteImg');
Route::resource('cp/softwares', SoftwareController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy', 'show'])
    ->middleware([AdminAuth::class]);
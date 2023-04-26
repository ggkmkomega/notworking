<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
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
})->name("main");

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

Route::get('cp/services/{service}/edit/dltimg/{img}', [ServiceController::class, 'deleteImg'])->name('svdeleteImg');
Route::resource('cp/services', ServiceController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy', 'show'])
    ->middleware([AdminAuth::class]);
    
Route::get('cp/courses/{course}/edit/dltimg/{img}', [CourseController::class, 'deleteImg'])->name('crdeleteImg');
Route::resource('cp/courses', CourseController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy', 'show'])
    ->middleware([AdminAuth::class]);

Route::get('products/hardwares', [HardwareController::class, 'siteIndex'])->name('hwSiteIndex');
Route::get('products/hardwares/{hardware}', [HardwareController::class, 'siteShow'])->name('hwSiteShow');

Route::get('services/{service}', [ServiceController::class, 'siteShow'])->name('svSiteShow');
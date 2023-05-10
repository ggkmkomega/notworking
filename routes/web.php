<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\HardwareController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;


use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\RedirectIfLogedIn;
use App\Http\Middleware\UserLoggedIn;

use Illuminate\Foundation\Auth\EmailVerificationRequest;


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


/*---------------- main -----------------*/

/* user auth */
Route::get('register', [UserAuthController::class, 'showRegisterForm'])->name('registerForm');
Route::get('login', [UserAuthController::class, 'showLoginForm'])
    ->middleware(RedirectIfLogedIn::class)
    ->name('loginForm');
Route::post('registering', [UserAuthController::class, 'register'])->name('userRegister');
Route::post('logining', [UserAuthController::class, 'login'])->name('userLogin');
Route::get('signout', [UserAuthController::class, 'signout'])->name('userSignOut');

/* mail verification */
Route::get('/email/verify', function () {
    return view('user.auth.verify-email');
})->middleware([UserLoggedIn::class])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect(route('main'));
})->middleware([UserLoggedIn::class])->name('verification.verify');


/* genearl */
Route::controller(FrontendController::class)->group(function () {

    //Search
    Route::get('search', 'searchProduct');

    //Dashboard
    Route::get('dashboard', 'showDashboard')
        ->middleware([UserLoggedIn::class])
        ->name('userDashboard');
    //Account Settings
    Route::get('dashboard/account', 'accountSettings')->name('userAccountSettings');
    Route::post('dashboard/account/update-info', 'updateUserInfo')->name('updateUserInfo');
    Route::post('dashboard/account/update-email', 'updateUserEmail')->name('updateUserEmail');
    Route::post('dashboard/account/update-password', 'updateUserPassword')->name('updateUserPassword');
    Route::get('dashboard/account/resend-verification-mail', 'resendVerificationMail')->name('resendVerificationMail');
});

//Orders
Route::controller(OrderController::class)->group( function () {
    Route::get('dashboard/orders/new', 'NewOrderForm')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('newOrderForm');
    Route::post('dashboard/orders/new/submit', 'NewOrder')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('newOrder');
    Route::get('dashboard/orders', 'DisplayAllOrders')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('displayAllOrders');
    Route::get('dashboard/orders/{order}', 'DisplayOrder')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('displayOrder');
});

Route::get('/', function () {
    return view('landing');
})->name("main");

/* products */
Route::get('products/hardwares', [HardwareController::class, 'siteIndex'])->name('hwSiteIndex');
Route::get('products/hardwares/{hardware}', [HardwareController::class, 'siteShow'])->name('hwSiteShow');

Route::get('products/softwares', [SoftwareController::class, 'siteIndex'])->name('swSiteIndex');
Route::get('products/softwares/{software}', [SoftwareController::class, 'siteShow'])->name('swSiteShow');

Route::get('services/{service}', [ServiceController::class, 'siteShow'])->name('svSiteShow');

Route::get('products/courses', [CourseController::class, 'siteIndex'])->name('crSiteIndex');
Route::get('products/courses/{course}', [CourseController::class, 'siteShow'])->name('crSiteShow');



/*----------------- control panel ---------------*/

/* admin auth */
Route::get('cp', [AdminAuthController::class, 'controlPanel'])
    ->middleware([AdminAuth::class])
    ->name('cp');
Route::get('cp/login', [AdminAuthController::class, 'login'])->name('login');
Route::post('cp/loginin', [AdminAuthController::class, 'admLogin'])->name('login-c');
Route::get('cp/signout', [AdminAuthController::class, 'signOut'])->name('signout');
Route::get('cp/profile', [AdminAuthController::class, 'showProfile'])->name('adminProfile');

/* products */
Route::get('cp/hardwares/{hardware}/edit/dltimg/{img}', [HardwareController::class, 'deleteImg'])->name('hwdeleteImg');
Route::resource('cp/hardwares', HardwareController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware([AdminAuth::class]);

Route::get('cp/softwares/{software}/edit/dltimg/{img}', [SoftwareController::class, 'deleteImg'])->name('swdeleteImg');
Route::resource('cp/softwares', SoftwareController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware([AdminAuth::class]);

Route::get('cp/services/{service}/edit/dltimg/{img}', [ServiceController::class, 'deleteImg'])->name('svdeleteImg');
Route::resource('cp/services', ServiceController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware([AdminAuth::class]);
    
Route::get('cp/courses/{course}/edit/dltimg/{img}', [CourseController::class, 'deleteImg'])->name('crdeleteImg');
Route::resource('cp/courses', CourseController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware([AdminAuth::class]);

/* accounts */
//users
Route::resource('cp/accounts/users', UserController::class)
    ->only(['index', 'edit', 'update', 'destroy', 'show'])
    ->middleware([AdminAuth::class]);

//admins
Route::resource('cp/accounts/admins', AdminController::class)
    ->only(['index', 'edit', 'update', 'destroy', 'show', 'store'])
    ->middleware([AdminAuth::class]);

Route::controller(OrderController::class)->group( function () {

    //Orders Indexing
    Route::get('cp/orders/pending', 'IndexPendingOrders')
        ->middleware([AdminAuth::class])
        ->name('indexPendingOrders');

    Route::get('cp/orders/delivering', 'IndexDeliveringOrders')
        ->middleware([AdminAuth::class])
        ->name('indexDeliveringOrders');

    Route::get('cp/orders/completed', 'IndexCompletedOrders')
        ->middleware([AdminAuth::class])
        ->name('indexCompletedOrders');

    Route::get('cp/orders/archived', 'IndexArchivedOrders')
        ->middleware([AdminAuth::class])
        ->name('indexArchivedOrders');


    //Order Management
    Route::get('cp/orders/{order}', 'ShowOrder')
        ->middleware([AdminAuth::class])
        ->name('showOrder');

    Route::get('cp/orders/{order}/status={status}', 'ChangeOrderStatus')
        ->middleware([AdminAuth::class])
        ->name('changeOrderStatus');

    Route::get('cp/orders/{order}/archive', 'ArchiveOrder')
        ->middleware([AdminAuth::class])
        ->name('archiveOrder');
    
    Route::get('cp/orders/{order}/unarchive', 'UnarchiveOrder')
        ->middleware([AdminAuth::class])
        ->name('unarchiveOrder');


    //Task Management
    Route::post('cp/orders/{order}/addTask', 'AddTask')
        ->middleware([AdminAuth::class])
        ->name('addTask');

    Route::post('cp/orders/{order}/editTask/{task}', 'EditTask')
        ->middleware([AdminAuth::class])
        ->name('editTask');

});


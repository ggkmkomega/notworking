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
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TicketController;
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
    Route::get('dashboard/account', 'accountSettings')
    ->middleware([UserLoggedIn::class])
    ->name('userAccountSettings');
    Route::post('dashboard/account/update-info', 'updateUserInfo')->middleware([UserLoggedIn::class])->name('updateUserInfo');
    Route::post('dashboard/account/update-email', 'updateUserEmail')->middleware([UserLoggedIn::class])->name('updateUserEmail');
    Route::post('dashboard/account/update-password', 'updateUserPassword')->middleware([UserLoggedIn::class])->name('updateUserPassword');
    Route::get('dashboard/account/resend-verification-mail', 'resendVerificationMail')->middleware([UserLoggedIn::class])->name('resendVerificationMail');
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
    
    Route::get('dashboard/orders/{order}/invoice', 'DisplayInvoice')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('displayInvoice');
    
    Route::get('dashboard/orders/{order}/cancel', 'CancelOrder')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('cancelOrder');

    Route::get('products/{category}/{id}/addProductToList', 'AddProductToList')
        ->middleware([UserLoggedIn::class])
        ->name('addProductToList');

    Route::get('orderList/removeItem={listItem}', 'RemoveProductFromList')
        ->middleware([UserLoggedIn::class])
        ->name('removeProductFromList');

    
    
});

Route::get('/', function () {
    return view('landing');
})->name("main");

/* products */
Route::get('products/hardwares', [HardwareController::class, 'siteIndex'])->name('hwSiteIndex');
Route::get('products/hardwares/{hardware}', [HardwareController::class, 'siteShow'])->name('hwSiteShow');

Route::get('products/softwares', [SoftwareController::class, 'siteIndex'])->name('swSiteIndex');
Route::get('products/softwares/{software}', [SoftwareController::class, 'siteShow'])->name('swSiteShow');

Route::get('products/services/{service}', [ServiceController::class, 'siteShow'])->name('svSiteShow');

Route::get('products/courses', [CourseController::class, 'siteIndex'])->name('crSiteIndex');
Route::get('products/courses/{course}', [CourseController::class, 'siteShow'])->name('crSiteShow');


Route::controller(ReviewController::class)->group( function () {
    Route::post('review/new.cat={prod_category}.id={prod_id}', 'Add')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('addNewReview');
    
    Route::get('review/{review}', 'Remove')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('removeReview');

    Route::put('review/{review}', 'Edit')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('editReview');

    Route::get('dashboard/reviews', 'IndexForUser')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('indexForUser');
});

Route::controller(TicketController::class)->group( function () {

    Route::get('dashboard/tickets/new', 'NewTicketForm')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('newTicketForm');

    Route::get('dashboard/tickets/new/submit', 'NewTicket')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('newTicket');

    Route::get('dashboard/tickets/{ticket}', 'UserShowTicket')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('userShowTicket');

    Route::post('dashboard/tickets/{ticket}/send', 'UserSendMessage')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('userSendMessage');

    Route::get('dashboard/tickets&status=ongoing', 'UserIndexOngoingTickets')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('userIndexOngoingTickets');
    
    Route::any('dashboard/tickets&status=closed', 'UserIndexClosedTickets')
        ->middleware([UserLoggedIn::class])
        ->middleware('verified')
        ->name('userIndexClosedTickets');

    
});


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

Route::controller(TicketController::class)->group( function () {

    Route::get('cp/tickets/{ticket}', 'AdminShowTicket')
        ->middleware([AdminAuth::class])
        ->name('adminShowTicket');

    Route::post('cp/tickets/{ticket}/send', 'AdminSendMessage')
        ->middleware([AdminAuth::class])
        ->name('adminSendMessage');

    Route::get('cp/tickets/{ticket}/update', 'UpdateMessageData')
        ->name('updateMessageData');

    Route::get('cp/tickets&status=ongoing', 'AdminIndexOngoingTickets')
        ->middleware([AdminAuth::class])
        ->name('adminIndexOngoingTickets');

    Route::get('cp/tickets&status=closed', 'AdminIndexClosedTickets')
        ->middleware([AdminAuth::class])
        ->name('adminIndexClosedTickets');

    Route::get('cp/tickets&status=archived', 'AdminIndexArchivedTickets')
        ->middleware([AdminAuth::class])
        ->name('adminIndexArchivedTickets');

    Route::post('cp/tickets/{ticket}/statusUpdate', 'UpdateTicketStatus')
        ->middleware([AdminAuth::class])
        ->name('updateTicketStatus');

    Route::get('cp/tickets/{ticket}/archive', 'ArchiveTicket')
        ->middleware([AdminAuth::class])
        ->name('archiveTicket');

    Route::get('cp/tickets/{ticket}/unarchive', 'UnarchiveTicket')
        ->middleware([AdminAuth::class])
        ->name('unarchiveTicket');

    
});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\DataImportController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\InvoiceController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//test dev

Route::get('/', function () {
    return view('auth/login');
})->middleware('guest')->name('/');

// Route::get('login', function () {
//     return view('auth/login');
// });

Route::get('/login', [LoginController::class,'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/logout', [LogoutController::class, 'store'])->name('logout');



Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/changePassword', [ChangePasswordController::class, 'changePasswordPost'])->name('changePassword');
Route::get('/forgot-password', [ChangePasswordController::class,'forgot_password'])->name('forgot-password');
Route::post('forgot-password', [ChangePasswordController::class,'forgot_password_submit'])->name('send-forgot-password');
Route::get('reset-password/{token}', [ChangePasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ChangePasswordController::class, 'resetPassword'])->name('reset-password');




Route::group(['middleware' => 'auth'],function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/filter', [DashboardController::class, 'index'])->name('filter');
    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordGet'])->name('change-password');
    Route::get('/view-profile', [ProfileController::class, 'index'])->name('view-profile');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('/update-profile/{uid}', [ProfileController::class, 'update'])->name('update-profile/{uid}');

    //imports
    Route::group(['prefix' => 'users'],function(){
        Route::group(['middleware' => ['role:system admin|system editor|system user']], function () {
            Route::get('/list', [UsersController::class,'index'])->name('users/list');
            Route::group(['middleware' => ['role:system admin|system editor']], function () {
                Route::get('/sub-accounts', [UsersController::class,'sub_accounts'])->name('users/sub-accounts');
                Route::get('/create', [UsersController::class, 'create'])->name('users/create');
                Route::post('/store', [UsersController::class, 'store'])->name('users/store');
                Route::get('/edit/{uid}', [UsersController::class, 'edit'])->name('users/edit/{uid}');
                Route::get('/view/{uid}', [UsersController::class, 'show'])->name('users/view/{uid}');
                Route::post('/update/{uid}', [UsersController::class, 'update'])->name('users/update/{uid}');
            });
            Route::group(['middleware' => ['role:system admin']], function () {
                Route::post('/deactivate/{uid}', [UsersController::class, 'deactivateUser'])->name('users/deactivate/{uid}');
                Route::post('/activate/{uid}', [UsersController::class, 'activateUser'])->name('users/activate/{uid}');
            });
        });
    });

    Route::group(['prefix' => 'domain'],function(){
        Route::group(['middleware' => ['role:system admin|system editor']], function () {
            Route::get('/import', [DataImportController::class,'show'])->name('domain/import');
            Route::get('/create', [DataImportController::class,'create'])->name('domain/create');
            Route::post('/input', [DataImportController::class,'input'])->name('domain/input');
            Route::get('/edit/{did}', [DataImportController::class,'edit'])->name('domain/edit/{did}');
            Route::post('/delete/{did}', [DataImportController::class,'delete'])->name('domain/delete/{did}');
            Route::post('/update/{did}', [DataImportController::class,'update'])->name('domain/update/{did}');
            Route::post('/parse_import', [DataImportController::class,'parse'])->name('domain/parse_import');
            Route::post('/import', [DataImportController::class,'store'])->name('domain/import');
        });
        Route::get('/list', [DataImportController::class,'index'])->name('domain/list');
        Route::get('/{did}/article/create', [ArticleController::class,'create'])->name('domain/{did}/article/create');
        Route::post('/{did}/article/store', [ArticleController::class,'store'])->name('domain/{did}/article/store');
        Route::get('/{did}/article/order', [ArticleController::class,'order'])->name('domain/{did}/article/order');

    });

    Route::group(['prefix' => 'company'],function(){
        Route::get('/list', [CompanyController::class,'index'])->name('company/list');
        Route::get('/{cname}/users/{id}', [CompanyController::class,'company_accounts'])->name('company/{cname}/users/{id}');
        Route::get('/edit/user/{id}', [CompanyController::class,'sub_accounts_edit'])->name('company/edit/user/{id}');
        Route::get('/view/user/{uid}', [CompanyController::class,'sub_accounts_show'])->name('company/biew/user/{uid}');
        Route::get('/sub-accounts', [CompanyController::class,'sub_accounts'])->name('company/sub-accounts');
        Route::get('/create', [CompanyController::class, 'create'])->name('company/create');
        Route::post('/store', [CompanyController::class, 'store'])->name('company/store');
        Route::get('/edit/{uid}', [CompanyController::class, 'edit'])->name('company/edit/{uid}');
        Route::post('/update/{uid}', [CompanyController::class, 'update'])->name('company/update/{uid}');
        Route::post('/update_user/{id}',[CompanyController::class,'update_user'])->name('company/update_user/{uid}');
        Route::post('/deactivate/{uid}', [CompanyController::class, 'deactivateUser'])->name('company/deactivate/{uid}');
        Route::post('/activate/{uid}', [CompanyController::class, 'activateUser'])->name('company/activate/{uid}');
        Route::get('/details', [CompanyController::class,'details'])->name('company/details');
        Route::group(['middleware' => ['role:system admin|system editor']], function () { 
            Route::get('{cid}/company-details', [CompanyController::class, 'company_details'])->name('company/{cid}/company-details');
        });
        
        // Route::post('/activate/{uid}', [CompanyController::class, 'activateUser'])->name('company/activate/{uid}');
    });

    Route::group(['prefix' => 'article'],function(){
        Route::group(['middleware' => ['role:system admin|system user|system editor|company admin|company user']], function () {
                Route::get('/lists', [ArticleController::class,'index'])->name('article/lists');
                Route::group(['middleware' => ['role:system admin|system editor']], function () {
                    Route::post('/order/{aid}/approve', [ArticleController::class,'order_approve'])->name('article/order/{aid}/approve');
                    Route::post('/order/{aid}/decline', [ArticleController::class,'order_decline'])->name('article/order/{aid}/decline');
                    Route::post('/order/{aid}/publish', [ArticleController::class,'order_publish'])->name('article/order/{aid}/publish');
                    Route::post('/{aid}/publish', [ArticleController::class,'publish_request'])->name('article/{aid}/publish');
                    Route::post('/update/{aid}', [ArticleController::class,'update'])->name('article/update/{aid}');
                    Route::post('/delete/{aid}', [ArticleController::class,'delete'])->name('article/delete/{aid}');
                });
                Route::get('/orders', [ArticleController::class,'orders'])->name('article/orders');
                Route::get('/requests', [ArticleController::class,'requests'])->name('article/requests');
                Route::get('/create', [ArticleController::class,'create'])->name('article/create');
                Route::post('/store', [ArticleController::class,'store'])->name('article/store');
                Route::get('/completed', [ArticleController::class,'completed_orders'])->name('article/completed');
                Route::post('/upload', [ArticleController::class,'upload_img'])->name('article/upload');
                Route::get('/order', [ArticleController::class,'order'])->name('article/order');
                Route::post('/order/{uid}/{cid}', [ArticleController::class,'make_order'])->name('article/order/{uid}/{cid}');

                Route::post('ordr/{aid}/delete', [ArticleController::class,'delete_order'])->name('article/ordr/{aid}/delete');
                Route::get('/order/edit/{aid}', [ArticleController::class,'show_order'])->name('article/order/edit/{aid}');
                Route::post('/order/update/{aid}', [ArticleController::class,'udpate_order'])->name('article/order/update/{aid}');
                
                Route::get('/edit/{aid}', [ArticleController::class,'edit'])->name('article/edit/{aid}');
                Route::get('/view/{aid}', [ArticleController::class,'show'])->name('article/view/{aid}');
                Route::get('/view-completed-order/{aid}', [ArticleController::class,'show_order'])->name('article/view-completed-order/{aid}');
                Route::get('/transactions', [ArticleController::class,'transactions'])->name('article/transactions');
            });
    });

    Route::group(['prefix' => 'package'],function(){
        Route::get('/lists', [PlanController::class,'index'])->name('package/lists');
        Route::get('/create', [PlanController::class,'create'])->name('package/create');
        Route::post('/store', [PlanController::class,'store'])->name('package/store');
        Route::get('/edit/{aid}', [PackageController::class,'edit'])->name('package/edit/{aid}');
        Route::post('/update/{pid}', [PlanController::class,'update'])->name('package/update/{pid}');
        Route::post('/delete/{pid}', [PlanController::class,'destroy'])->name('package/delete/{pid}');
        Route::get('/checkout/{planid}', [PlanController::class,'checkout'])->name('package/checkout/{planid}');
        Route::post('/process', [PlanController::class,'processPlan'])->name('package/process');
        // Route::get('/lists', [PackageController::class,'index'])->name('package/lists');
        // Route::get('/create', [PackageController::class,'create'])->name('package/create');
        // Route::post('/store', [PackageController::class,'store'])->name('package/store');
        // Route::get('/edit/{aid}', [PackageController::class,'edit'])->name('package/edit/{aid}');
        // Route::post('/update/{pid}', [PackageController::class,'update'])->name('package/update/{pid}');
        // Route::post('/delete/{aid}', [PackageController::class,'delete'])->name('package/delete/{aid}');
        Route::post('/buy/{aid}', [PackageController::class,'buy'])->name('package/buy/{aid}');
        Route::get('/requests', [SubscriptionsController::class,'package_requests'])->name('package/requests');
        Route::post('/approve/{pid}/{uid}', [SubscriptionsController::class,'approve'])->name('package/approve/{pid}/{uid}');
        Route::post('/decline/{pid}', [SubscriptionsController::class,'decline'])->name('package/decline/{pid}');
        Route::post('/cancel/{sid}', [SubscriptionsController::class,'cancel'])->name('package/cancel/{sid}');
        Route::get('/my-subscriptions',[SubscriptionsController::class,'my_subscriptions'])->name('package/my-subscriptions');
        Route::get('/unsubscribe',[SubscriptionsController::class,'unsubscribe'])->name('package/unsubscribe');
    });

    Route::group(['prefix' => 'invoice'],function(){
        Route::get('/lists', [InvoiceController::class,'index'])->name('invoice/lists');
        Route::get('/show/{id}', [InvoiceController::class,'show'])->name('invoice/show/{id}');
        Route::get('/generate-pdf/{id}',[InvoiceController::class,'generateInvoicePdf'])->name('invoice/generate-pdf/{id}');
    });
});

Route::group(['prefix' => 'user'],function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user/dashboard');
    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordGet'])->name('user/change-password');
    Route::get('/view-profile', [ProfileController::class, 'index'])->name('user/view-profile');
});

Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return "Cleared!";

});



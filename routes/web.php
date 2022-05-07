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
})->name('/');

// Route::get('login', function () {
//     return view('auth/login');
// });

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/logout', [LogoutController::class, 'store'])->name('logout');

// Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/changePassword', [ChangePasswordController::class, 'changePasswordPost'])->name('changePassword');


Route::group(['middleware' => 'auth'],function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordGet'])->name('change-password');
    Route::get('/view-profile', [ProfileController::class, 'index'])->name('view-profile');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('/update-profile/{uid}', [ProfileController::class, 'update'])->name('update-profile/{uid}');

    //imports
    Route::group(['prefix' => 'users'],function(){
        Route::get('/list', [UsersController::class,'index'])->name('users/list');
        Route::get('/sub-accounts', [UsersController::class,'sub_accounts'])->name('users/sub-accounts');
        Route::get('/create', [UsersController::class, 'create'])->name('users/create');
        Route::post('/store', [UsersController::class, 'store'])->name('users/store');
        Route::get('/edit/{uid}', [UsersController::class, 'edit'])->name('users/edit/{uid}');
        Route::post('/update/{uid}', [UsersController::class, 'update'])->name('users/update/{uid}');
        Route::post('/deactivate/{uid}', [UsersController::class, 'deactivateUser'])->name('users/deactivate/{uid}');
        Route::post('/activate/{uid}', [UsersController::class, 'activateUser'])->name('users/activate/{uid}');
    });

    Route::group(['prefix' => 'domain'],function(){
        Route::get('/import', [DataImportController::class,'show'])->name('domain/import');
        Route::get('/list', [DataImportController::class,'index'])->name('domain/list');
        Route::get('/create', [DataImportController::class,'create'])->name('domain/create');
        Route::post('/input', [DataImportController::class,'input'])->name('domain/input');
        Route::get('/edit/{did}', [DataImportController::class,'edit'])->name('domain/edit/{did}');
        Route::post('/delete/{did}', [DataImportController::class,'delete'])->name('domain/delete/{did}');
        Route::post('/update/{did}', [DataImportController::class,'update'])->name('domain/update/{did}');
        Route::post('/parse_import', [DataImportController::class,'parse'])->name('domain/parse_import');
        Route::post('/import', [DataImportController::class,'store'])->name('domain/import');
    });

    Route::group(['prefix' => 'company'],function(){
        Route::get('/list', [CompanyController::class,'index'])->name('company/list');
        Route::get('/list/users/{id}', [CompanyController::class,'company_accounts'])->name('company/list/users/{id}');
        Route::get('/edit/user/{id}', [CompanyController::class,'sub_accounts_edit'])->name('company/edit/user/{id}');
        Route::get('/sub-accounts', [CompanyController::class,'sub_accounts'])->name('company/sub-accounts');
        Route::get('/create', [CompanyController::class, 'create'])->name('company/create');
        Route::post('/store', [CompanyController::class, 'store'])->name('company/store');
        Route::get('/edit/{uid}', [CompanyController::class, 'edit'])->name('company/edit/{uid}');
        Route::post('/update/{uid}', [CompanyController::class, 'update'])->name('company/update/{uid}');
        Route::post('/deactivate/{uid}', [CompanyController::class, 'deactivateUser'])->name('company/deactivate/{uid}');
        Route::post('/activate/{uid}', [CompanyController::class, 'activateUser'])->name('company/activate/{uid}');
        Route::get('/company-details', [CompanyController::class, 'company_details'])->name('company/company-details');
        // Route::post('/activate/{uid}', [CompanyController::class, 'activateUser'])->name('company/activate/{uid}');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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



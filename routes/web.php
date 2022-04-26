<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\UsersImportController;
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


Route::group(['middleware' => 'auth'],function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordGet'])->name('change-password');
    Route::get('/view-profile', [ProfileController::class, 'index'])->name('view-profile');

    //imports
    Route::group(['prefix' => 'users'],function(){
        Route::get('/import', [UsersImportController::class,'show'])->name('users/import');
        Route::post('/parse_import', [UsersImportController::class,'parse'])->name('users/parse_import');
        Route::post('/import', [UsersImportController::class,'store'])->name('users/import');
        Route::get('/list', [UsersController::class,'index'])->name('users/list');
        Route::get('/create', [UsersController::class, 'create'])->name('users/create');
    });

    Route::group(['prefix' => 'company'],function(){
        Route::get('/list', [CompanyController::class,'index'])->name('company/list');
        Route::get('/create', [CompanyController::class, 'create'])->name('company/create');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::group(['prefix' => 'user'],function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user/dashboard');
    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordGet'])->name('user/change-password');
    Route::get('/view-profile', [ProfileController::class, 'index'])->name('user/view-profile');

});


Route::post('/changePassword', [ChangePasswordController::class, 'changePasswordPost'])->name('changePassword');

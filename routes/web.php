<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\UsersImportController;
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


Route::group(['prefix' => 'admin'],function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin/dashboard');
    Route::get('/dashboard/register', [AdminController::class, 'index'])->name('admin/dashboard/register');

    //imports
    Route::get('/users/import', [UsersImportController::class,'show'])->name('admin/users/import');
    Route::post('/users/import', [UsersImportController::class,'store'])->name('admin/users/import');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin/dashboard');

});


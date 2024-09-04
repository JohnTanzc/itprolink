<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserRegistrationController;


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
    // return view('welcome');
    return view('index');
});

// Route::get('/index', function () {
//     return view('index');
// });


Route::get('/login/user', [UserRegistrationController::class, 'showLoginForm'])->name('user.login');
Route::get('/register/user', [UserRegistrationController::class, 'showRegistrationForm'])->name('user.register');
Route::get('/Home', [IndexController::class, 'index'])->name('index');
Route::get('/About', [AboutController::class, 'about'])->name('about');
Route::get('/Course', [CourseController::class, 'course'])->name('course');
Route::get('/Contacts', [ContactsController::class, 'contacts'])->name('contacts');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



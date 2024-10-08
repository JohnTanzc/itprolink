<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TutorCardController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TuteeController;
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

// User Roles
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});


Route::middleware(['auth', 'user.role:Tutor', 'verified'])->group(function () {
    Route::get('/tutor/dashboard', [TutorController::class, 'tutor']);
});

Route::group(['middleware' => ['role:tutee']], function () {
    Route::get('/tutee/dashboard', [TuteeController::class, 'index']);
});
// End of User Roles

Route::get('/Login', [UserRegistrationController::class, 'showLoginForm'])->name('user.login');
Route::get('/Register', [UserRegistrationController::class, 'showRegistrationForm'])->name('user.register');
Route::get('/Home', [IndexController::class, 'index'])->name('index');
Route::get('/About', [AboutController::class, 'about'])->name('about');
Route::get('/Course', [CourseController::class, 'course'])->name('course');
Route::get('/Contacts', [ContactsController::class, 'contacts'])->name('contacts');

Route::middleware('auth')->group(function () {
    Route::get('/Tutors', [TutorCardController::class, 'tutorcard'])->name('tutor.card');
});
Route::middleware('auth')->group(function () {
Route::get('/User/Profile', [UserProfileController::class, 'userprofile'])->name('user.profile');
Route::post('/profile/upload', [UserProfileController::class, 'uploadProfilePicture'])->name('profile.upload');
});



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



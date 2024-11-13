<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TuteeProfileController;
use App\Http\Controllers\TutorCardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TuteeController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\Auth\UpdateController;
use App\Http\Controllers\Auth\UserRegistrationController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// Unauthenticated (guest) users can also view these routes
Route::get('/', [IndexController::class, 'index'])->name('index'); // Make this the landing page
Route::get('/About', [AboutController::class, 'about'])->name('about');
Route::get('/Course', [CourseController::class, 'course'])->name('course');
Route::get('/Contacts', [ContactsController::class, 'contacts'])->name('contacts');

// User Roles
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

// Tutor routes
Route::middleware(['auth', 'user.role:tutor', 'verified'])->group(function () {
    Route::get('Dashboard', [TutorController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/Tutor/Profile', [TutorController::class, 'tutorprofile'])->name('tutor.profile');
    Route::post('/tutor/update-profile', [TutorController::class, 'updateProfilePicture'])->name('profile.upload');
    Route::get('/Tutors', [TutorCardController::class, 'tutorcard'])->name('tutor.card');
});

// Tutee routes
Route::middleware(['auth', 'user.role:Tutee', 'verified'])->group(function () {
    Route::get('/tutee/dashboard', [TuteeController::class, 'index'])->name('tutee.dashboard');
    Route::get('/Tutee/Profile', [TuteeProfileController::class, 'tuteeprofile'])->name('tutee.profile');
    Route::get('/Tutors', [TutorCardController::class, 'tutorcard'])->name('tutor.card');
});

// Redirect authenticated users if they try to access login or register pages
Route::middleware('auth')->group(function () {
    Route::get('/Login', function () {
        return redirect()->route('index'); // Redirect to home
    })->name('user.login');

    Route::get('/Register', function () {
        return redirect()->route('index'); // Redirect to home
    })->name('user.register');

    // Route to display all credentials for the authenticated user
    Route::get('/get/credentials', [CredentialController::class, 'index'])->name('credentials.index');
    // Route to handle the credential file upload
    Route::post('/credentials', [CredentialController::class, 'store'])->name('credentials.store');

    // Route to show the edit form
    Route::get('/User/Profile/Edit/{id}', [UpdateController::class, 'edit'])->name('user.edit');

    // Route to handle the update submission
    Route::put('/User/Profile/Update/{id}', [UpdateController::class, 'update'])->name('user.update');
});

// Guest-only routes
Route::middleware('guest')->group(function () {
    Route::get('/Login', [UserRegistrationController::class, 'showLoginForm'])->name('user.login');
    Route::get('/Register', [UserRegistrationController::class, 'showRegistrationForm'])->name('user.register');
});

// Logout route for authenticated users
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Optional Auth routes
Auth::routes();

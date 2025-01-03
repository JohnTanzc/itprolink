<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RecoverController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\VerificationController;
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



//Dashboard route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/Admin/Dashboard', [DashboardController::class, 'dashboard'])
        ->middleware('role:admin,tutor,tutee'); // Allows access to specific roles
    Route::post('/enroll', [EnrollmentController::class, 'store'])->name('enroll.store');
    Route::put('/enrollment/{id}/update-status', [EnrollmentController::class, 'updateStatus'])->name('enrollment.updateStatus');
    Route::put('/enrollment/{id}/update-payment-status', [EnrollmentController::class, 'updatePaymentStatus'])->name('enrollment.updatePaymentStatus');
    Route::get('/courses/{courseId}/enrolled-students', [EnrollmentController::class, 'getEnrolledStudentsCount'])
        ->name('courses.enrolledStudents');
    // In web.php
    Route::post('/notifications/mark-all-read', [DashboardController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::get('/notifications/{userId}', [NotificationController::class, 'checkNotifications']);
    Route::post('/notifications/delete-all', [NotificationController::class, 'deleteAll'])->name('notifications.deleteAll');




});


// Admin-only routes
Route::middleware(['auth', 'checkuserrole:admin', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile/{id}', [DashboardController::class, 'dashprofile'])->name('admin.profile');
    Route::get('/admin/setting/{id}', [DashboardController::class, 'dashsetting'])->name('admin.setting');
    Route::put('/admin/setting/{id}', [DashboardController::class, 'editprofile'])->name('admin.update');
    Route::put('/admin/password/update/{id}', [DashboardController::class, 'updatePassword'])->name('admin.password.update');
    Route::put('/admin/email/update/{id}', [DashboardController::class, 'updateEmail'])->name('admin.email.update');
    Route::post('/admin/verify-user/{id}', [AdminController::class, 'verifyUser'])->name('admin.verify.user');
    Route::get('/admin/users', [AdminController::class, 'viewUsers'])->middleware('auth')->name('admin.users');
    // Admin approve/reject verification
    Route::post('/admin/users/{userId}/approve', [AdminController::class, 'approveVerification'])->name('admin.approve.verification');
    Route::post('/admin/users/{userId}/reject', [AdminController::class, 'rejectVerification'])->name('verification.reject');
    Route::get('/admin/tutee/view', [AdminController::class, 'allTutee'])->name('dashtutee');
    Route::get('/admin/tutor/view', [AdminController::class, 'allTutor'])->name('dashtutor');
    Route::get('/admin/courses/view', [AdminController::class, 'allCourse'])->name('dashcourse');
    Route::post('/api/verification-status/{user}', [VerificationController::class, 'updateVerificationStatus']);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
    Route::get('/admin/all/users', [AdminController::class, 'dashCreate'])->name('admin.dashcreate');
    // Route::get('/course/detail/{course}', [CourseController::class, 'show'])->name('course.detail');
    Route::get('/payments', [EnrollmentController::class, 'payments'])->name('payment.view');
    Route::get('/payment-details/{enrollment_id}', [PaymentController::class, 'getPaymentDetails']);
    Route::put('/admin/user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateuser');
    Route::get('/admin/user/{id}', [AdminController::class, 'getUserProfile']);
    Route::get('/get-user-profile/{id}', [UserController::class, 'getProfileData']);
    Route::delete('/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('users.destroy');
    Route::post('/admin/user-create', [AdminController::class, 'createUser'])->name('admin.createuser');


});



// Tutor-specific routes
Route::middleware(['auth', 'checkuserrole:tutor', 'verified'])->group(function () {
    Route::get('tutor/dashboard', [DashboardController::class, 'dashboard'])->name('tutor.dashboard');
    Route::get('/tutor/profile/{id}', [DashboardController::class, 'dashprofile'])->name('tutor.profile');
    Route::get('/tutor/setting', [DashboardController::class, 'dashsetting'])->name('tutor.setting');
    Route::put('/tutor/setting/{id}', [DashboardController::class, 'editprofile'])->name('tutor.update');
    Route::put('/tutor/password/update/{id}', [DashboardController::class, 'updatePassword'])->name('tutor.password.update');
    Route::put('/tutor/email/update/{id}', [DashboardController::class, 'updateEmail'])->name('tutor.email.update');
    Route::get('/submit-course', [DashboardController::class, 'submitCourse'])->name('submit.course');

    Route::post('/submit-course', [CourseController::class, 'store'])->name('courses.store');  // POST route for course submission
    // Route::get('/tutor/course/detail/{id}', [DashboardController::class, 'coursedetail'])->name('tutors.coursedetail');
    Route::post('/tutor/upload-verification', [VerificationController::class, 'uploadVerification'])->name('tutor.uploadverification');
    Route::post('/tutor/verification/submit', [VerificationController::class, 'submit'])->name('tutor.verificationsubmit');
    Route::get('/tutor/enrollees', [EnrollmentController::class, 'showEnrollee'])->middleware('auth')->name('tutor.enrollee');
    Route::get('/tutor/mycourses/{id}', [DashboardController::class, 'tutcourse'])->name('tut.course');
    Route::delete('/course/{id}/delete', [DashboardController::class, 'destroy'])->name('course.delete');

});

// Tutee-specific routes
Route::middleware(['auth', 'checkuserrole:tutee', 'verified'])->group(function () {
    Route::get('/tutee/dashboard', [DashboardController::class, 'dashboard'])->name('tutee.dashboard');
    Route::get('/tutee/profile/{id}', [DashboardController::class, 'dashprofile'])->name('tutee.profile');
    Route::get('/tutee/setting', [DashboardController::class, 'dashsetting'])->name('tutee.setting');
    Route::put('/tutee/setting/{id}', [DashboardController::class, 'editprofile'])->name('tutee.update');
    Route::put('/tutee/password/update/{id}', [DashboardController::class, 'updatePassword'])->name('tutee.password.update');
    Route::put('/tutee/email/update/{id}', [DashboardController::class, 'updateEmail'])->name('tutee.email.update');
    // Route::get('/tutee/course/detail/{id}', [DashboardController::class, 'coursedetail'])->name('tutee.coursedetail');
    // Route::get('/tutee/course/detail/{id}', [CourseController::class, 'show'])->name('course.detail');
    Route::get('/verification', [VerificationController::class, 'showUploadForm'])->name('verification.upload')
        ->middleware('auth'); // Ensure only authenticated users can access
    Route::post('/tutee/upload-verification', [VerificationController::class, 'uploadVerification'])->name('tutee.uploadverification');
    Route::post('/tutee/verification/submit', [VerificationController::class, 'submit'])->name('tutee.verificationsubmit');
    Route::get('/tutee/mycourses', [DashboardController::class, 'myCourses'])->name('mycourses');

});



// Redirect authenticated users if they try to access login or register pages
Route::middleware('auth')->group(function () {
    Route::get('/Login', function () {
        return redirect()->route('index'); // Redirect to home
    })->name('user.login');
    // Enrollment
    Route::get('/Register', function () {
        return redirect()->route('index'); // Redirect to home
    })->name('user.register');

    // Authenticated verify
    Route::get('/enroll-now', [UserController::class, 'enrollNow'])->name('enrollNow');
    Route::get('/course/detail/{course}', [CourseController::class, 'show'])->name('course.detail');
    Route::get('/profile/detail/{id}', [DashboardController::class, 'pubprofile'])
        ->name('pub.profile')
        ->middleware('checkuserrole:tutee,admin,tutor');  // Make sure it's applied here
    Route::post('/save-course', [CourseController::class, 'saveCourse'])->name('save.course');
    Route::get('/check-saved-course', [CourseController::class, 'checkSavedCourse']);
    Route::post('/remove-saved-course', [CourseController::class, 'removeSavedCourse'])->name('remove.saved.course');
    Route::post('enroll', [EnrollmentController::class, 'store'])
        ->middleware('verified') // Assuming you have a middleware for verification
        ->name('enroll.store');
    Route::get('/message', [MessageController::class, 'message'])->name('message.index');
    Route::get('/message/{id}', [MessageController::class, 'fetchConversation'])->name('messages.fetch');
    Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
    Route::get('/course/{courseId}/preview/{resourceTitle}', [CourseController::class, 'previewResource'])->name('course.preview');

});



// Guest-only routes
Route::get('/', [IndexController::class, 'index'])->name('index'); // Make this the landing page
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/course', [CourseController::class, 'course'])->name('course');
Route::get('/contacts', [IndexController::class, 'contacts'])->name('contacts');
Route::get('/privacypolicy', [IndexController::class, 'privacy'])->name('privacy');
Route::get('/terms&conditions', [IndexController::class, 'terms'])->name('terms');
Route::get('/error', [IndexController::class, 'error'])->name('error');
Route::get('/faqs', [IndexController::class, 'faqs'])->name('faqs');
Route::get('/recoverpassword', [RecoverController::class, 'recover'])->name('recover.password');
Route::post('/recover', [RecoverController::class, 'sendResetLink'])->name('recover.send');
// Routes for password recovery
Route::get('/reset-password/{token}', [RecoverController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/update', [RecoverController::class, 'resetPassword'])->name('password.update');
// Routes blocked account
Route::get('/account-blocked', function () {
    return view('auth.account-blocked');
})->name('account.blocked');


Route::middleware('guest')->group(function () {
    Route::get('/Login', [UserRegistrationController::class, 'showLoginForm'])->name('user.login');
    // For handling the login form submission (POST request)
    Route::post('/Login', [LoginController::class, 'login'])->name('user.login.submit');
    Route::get('/Register', [UserRegistrationController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('/Register', [UserRegistrationController::class, 'register'])->name('user.register.submit');

});

// Route::post('enroll', [EnrollmentController::class, 'store'])
//     ->middleware('verified') // Assuming you have a middleware for verification
//     ->name('enroll.store');

// Logout route for authenticated users
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Optional Auth routes
// Auth::routes();

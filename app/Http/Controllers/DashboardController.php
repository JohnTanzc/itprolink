<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    /**
     * Show the dashboard based on user role.
     */

    public function dashboard()
    {
        $user = Auth::user();
        $role = $user->role;

        // Fetch counts for active users
        $activeTutees = User::where('role', 'tutee')->where('active', 1)->count();
        $activeTutors = User::where('role', 'tutor')->where('active', 1)->count();

        $totalTutors = User::where('role', 'tutor')->count();
        $totalTutees = User::where('role', 'tutee')->count();

        // Fetch the course count for the authenticated user
        $courseCount = $user->courses()->count(); // Assuming the relationship 'courses' is defined in User model

        // Fetch the count of completed courses for the authenticated user
        $completedCourseCount = $user->enrollments()->where('status', 'completed')->count(); // Assuming 'status' column exists in the Enrollment model

        // Fetch the count of uploaded courses for the authenticated tutor
        $uploadedCourseCount = ($role === 'tutor') ? Course::where('user_id', $user->id)->count() : null;

        // Fetch the count of enrolled courses for the authenticated tutee
        $enrolledCourseCount = ($role === 'tutee') ? $user->enrollments()->count() : 0; // Default to 0 if no enrollments

        // Fetch the total number of courses uploaded by all tutors (only for admin)
        $totalCourses = ($role === 'admin') ? Course::count() : null;

        // Fetch notifications for the user (including rejection notifications)
        $notifications = $user->notifications;

        // Return the view with all data
        return view('dash.dashboard', compact(
            'user',
            'role',
            'activeTutees',
            'activeTutors',
            'courseCount',
            'completedCourseCount',
            'uploadedCourseCount',
            'enrolledCourseCount', // Pass enrolled course count to the view
            'totalTutees',
            'totalTutors',
            'totalCourses',
            'notifications'
        ));
    }



    public function myCourses(Request $request)
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the enrolled courses where the status is 'approved' and eager load the 'course' relationship with pagination
        $enrolledCourses = $user->enrollments()->where('status', 'approved')->with('course')->paginate(9); // Paginate results (adjust number as needed)

        // Get courses directly related to the user, if the user is a tutor
        $courses = $user->courses;

        // Retrieve the tutor data (if you want to display tutor info, assuming 'tutor' relationship is defined)
        $tutor = $user->tutor; // Assuming user has a 'tutor' relationship

        // Retrieve the saved courses for the tutee with pagination
        $savedCourses = $user->savedCourses()->with('users')->paginate(6); // Paginate saved courses (adjust number as needed)

        // If the request is via AJAX, return the partial content for saved courses and pagination
        if ($request->ajax()) {
            return response()->json([
                'savedCourses' => view('partials.saved_courses', compact('savedCourses'))->render(),
                'pagination' => view('partials.pagination', compact('savedCourses'))->render(),
                'activeTab' => 'favorite',  // Add the active tab state
            ]);
        }

        // Check if no courses, enrolled courses, saved courses, or tutor data is available
        if ($enrolledCourses->isEmpty() && $courses->isEmpty() && $savedCourses->isEmpty() && !$tutor) {
            session()->flash('error', 'No courses, saved courses, or tutor data available.');
        }

        // Return the view with necessary data for courses, enrolled courses, saved courses, and tutor
        return view('dash.dashmycourse', compact('courses', 'enrolledCourses', 'savedCourses', 'tutor'));
    }



    // Profile View
    public function dashprofile()
    {
        $user = Auth::user();
        $role = $user->role;
        $bio = $user->bio;

        return view('dash.dashprofile', compact('user', 'role', 'bio'));
    }

    public function dashsetting()
    {
        $user = Auth::user();
        $role = $user->role;


        return view('dash.dashsetting', compact('user', 'role'));
    }

    /**View Public Profile */
    public function pubprofile($id)
{
    $tutor = User::find($id); // Fetch the tutor by their ID
    $user = User::findOrFail($id); // Fetch the user by their ID
    $courses = Course::where('user_id', $id)->paginate(6); // Fetch courses for this tutor with pagination

    // Get all enrollments for the tutor's courses with 'approved' status
    $enrollments = Enrollment::whereIn('course_id', $courses->pluck('id')) // Get enrollments for the tutor's courses
                              ->where('status', 'approved') // Filter by 'approved' status
                              ->distinct('user_id') // Ensure we only count unique tutees
                              ->count();

    // Other user and tutor details
    $role = $user->role; // Get the user's role
    $totalCourses = $courses->total(); // Get the total number of courses

    // Retrieve the 'about_me', education, career, and experience attributes
    $aboutMe = $user->about_me;
    $education = $tutor->edu;
    $career = $tutor->career;
    $experience = $tutor->exp;

    // Pass the total enrolled tutees to the view
    return view('dash.dashpub', compact('courses', 'user', 'role', 'tutor', 'totalCourses', 'aboutMe', 'education', 'career', 'experience', 'enrollments'));
}



    /**View Public Profile */
    public function coursedetail($courseId)
    {
        if (!Auth::check()) {
            return redirect('/Login');
        }

        $user = Auth::user();

        // Fetch the specific course based on the ID and ensure it belongs to the logged-in tutor
        $course = Course::where('id', $courseId)->where('user_id', $user->id)->first();

        // If the user is a tutor but the course doesn't belong to them, abort with an error
        if ($user->role === 'tutor' && !$course) {
            return redirect()->route('tutors.courses')->with('error', 'Course not found.');
        }

        // Fetch all courses for the tutee (you can modify this as needed)
        if ($user->role === 'tutee') {
            $course = Course::find($courseId);
            if (!$course) {
                abort(404, 'Course not found.');
            }
        }

        // If no matching course found for the tutee, abort
        if (!$course) {
            abort(404, 'Course not found.');
        }

        // Decode lectures and resources from JSON if they exist and are not already arrays
        $lectures = is_array($course->lectures) ? $course->lectures : json_decode($course->lectures, true);
        $resources = is_array($course->resources) ? $course->resources : json_decode($course->resources, true);

        // Pass lectures and resources to the view alongside course and user
        return view('dash.dashcourse', compact('user', 'course', 'lectures', 'resources'));
    }


    /** Submit Course */
    public function submitCourse()
    {
        $user = Auth::user();
        $role = $user->role;
        $courses = Course::all(); // Fetch all courses (or any specific query)

        return view('dash.dashupload', compact('user', 'role', 'courses')); // Pass courses to the view
    }

    /**
     * Edit user profile.
     */
     public function editprofile(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Validate the incoming request
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'age'   => 'nullable|integer|min:1|max:150',
            'gender' => 'nullable|string|in:Male,Female',
            'designation' => 'nullable|string', // Validate the designation field
            'birthday' => 'nullable|date|before:today',
            'phone' => [
                'nullable', // Allow null value if the phone number is optional
                'regex:/^(?:\+63|0)(9\d{2})\s?\d{3}\s?\d{4}$/', // Regex for Philippine phone numbers
            ],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB
            'about_me' => 'nullable|string', // Add validation for "About Me"
            'edu' => 'nullable|string',
            'career' => 'nullable|string',
            'exp' => 'nullable|string',
        ]);

        // Update user details
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->designation = $request->designation;
        $user->birthday = $request->birthday;
        $user->phone = $request->input('phone', $user->phone);
        $user->about_me = $request->input('about_me', $user->about_me);
        $user->edu = $request->input('edu', $user->edu);
        $user->career = $request->input('career', $user->career);
        $user->exp = $request->input('exp', $user->exp);


        // Check if a new profile picture is uploaded
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
            }

            // Save the new profile picture
            $fileName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->storeAs('public/profile_pictures', $fileName);

            // Update the user's profile picture in the database
            $user->profile_picture = $fileName;
        }

        // Save the updated user information
        $user->save();

        // Update instructor_name in courses if the user is a tutor
        if ($user->role === 'tutor') {
            // Find all courses associated with the tutor
            $courses = Course::where('user_id', $user->id)->get(); // Check if 'user_id' is correct
            foreach ($courses as $course) {
                $course->instructor_name = $user->fname . ' ' . $user->lname;
                $course->save();
            }
        }

        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->route('admin.setting', ['id' => Auth::user()->id])->with('status', 'Profile updated successfully');
        } elseif ($user->role === 'tutor') {
            return redirect()->route('tutor.setting', ['id' => Auth::user()->id])->with('status', 'Profile updated successfully');
        } elseif ($user->role === 'tutee') {
            return redirect()->route('tutee.setting')->with('status', 'Profile updated successfully');
        } else {
            return redirect()->back()->with('status', 'Profile updated successfully');
        }
    }


    public function updatePassword(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'old_password' => 'required',  // Validate old password
            'new_password' => 'required|min:8|confirmed',  // Validate new password
        ]);

        // Retrieve the user by ID
        $user = User::findOrFail($id);

        // Check if the old password matches
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'The old password is incorrect.');
        }

        // Check if the new password is the same as the old password
        if (Hash::check($request->new_password, $user->password)) {
            return back()->with('error', 'Your new password cannot be the same as your old password.');
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Return success response
        return back()->with('status', 'Password changed successfully.');
    }

    public function updateEmail(Request $request)
    {
        // Validate the input for email
        $validatedData = $request->validate([
            'old_email' => 'required|email', // Old email is required and must be valid
            'new_email' => 'required|email|unique:users,email,' . Auth::id(), // New email must be unique
            'new_email_confirmation' => 'required|same:new_email', // Confirm new email matches new email
        ]);

        $user = Auth::user(); // Get the currently authenticated user

        // Ensure the old email matches the user's current email
        if (trim($validatedData['old_email']) !== trim($user->email)) {
            return back()->with('error', 'The old email is incorrect.');
        }

        // Ensure the new email is different from the old email
        if (trim($validatedData['new_email']) === trim($user->email)) {
            return back()->with('error', 'The new email must be different from the old email.');
        }

        // Update email
        $user->email = trim($validatedData['new_email']);
        $user->save(); // Save the new email

        // Return success message
        return back()->with('success', 'Email updated successfully.');
    }

    public function markAllAsRead()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();  // Mark all unread notifications as read

        // Redirect back to the previous page
        return back();
    }

    public function tutcourse($id)
    {
        // Fetch courses for the tutor using the user_id column with pagination
        $courses = Course::where('user_id', $id)->paginate(5);

        // Fetch tutor details (optional, for display in the view)
        $tutor = User::find($id);

        // Check if the tutor exists
        if (!$tutor) {
            return redirect()->back()->with('error', 'Tutor not found.');
        }

        // Pass courses and tutor data to the view
        return view('dash.dashtutcourse', compact('courses', 'tutor'));
    }


    public function destroy($id)
    {
        // Find the course by ID
        $course = Course::findOrFail($id);

        // Capture the current page from the request
        $page = request()->get('page', 1); // Defaults to page 1 if not set

        // Optionally, delete the course's image if it exists
        if ($course->image && file_exists(public_path('storage/courses/' . $course->image))) {
            unlink(public_path('storage/courses/' . $course->image));
        }

        // Delete the course
        $course->delete();

        // Redirect back to the tutor's course list (including the tutor's ID and current page) with a success message
        return redirect()->route('tut.course', ['id' => Auth::user()->id, 'page' => $page])
            ->with('success', 'Course deleted successfully');
    }


}

<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

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



    public function myCourses()
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the enrolled courses where the status is 'approved' and eager load the 'course' relationship
        $enrolledCourses = $user->enrollments()->where('status', 'approved')->with('course')->get();

        // Get courses directly related to the user, if the user is a tutor
        $courses = $user->courses;

        // Retrieve the tutor data (if you want to display tutor info, assuming 'tutor' relationship is defined)
        $tutor = $user->tutor; // Assuming user has a 'tutor' relationship

        // Check if courses or tutor is null and set appropriate error message
        if ($enrolledCourses->isEmpty() && $courses->isEmpty() && !$tutor) {
            session()->flash('error', 'No courses or tutor data available.');
        }

        // Return the view with necessary data for both courses and enrolled courses
        return view('dash.dashmycourse', compact('courses', 'enrolledCourses', 'tutor'));
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

        // Add the enrolled count to each course
        $courses->getCollection()->transform(function ($course) {
            // Check if enrollments exist and assign the enrolledCount
            $course->enrolledCount = $course->enrollments()->count();
            return $course;
        });

        $role = $user->role; // Get the user's role
        $totalCourses = $courses->total(); // Get the total number of courses

        return view('dash.dashpub', compact('courses', 'user', 'role', 'tutor', 'totalCourses'));
    }





    /**View Public Profile */
    public function coursedetail()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->role === 'tutor') {
            // Fetch courses uploaded by the tutor and eager load lectures and requirements
            $courses = Course::where('user_id', $user->id)
                ->with('lectures', 'requirements')  // Eager load lectures and requirements
                ->get();
        } elseif ($user->role === 'tutee') {
            // Fetch courses available to the tutee and eager load lectures and requirements
            $courses = Course::with('lectures', 'requirements')  // Eager load lectures and requirements
                ->get();
        } else {
            abort(403, 'Unauthorized action.');
        }

        return view('dash.dashcourse', compact('user', 'courses'));
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
            'phone' => [
                'nullable', // Allow null value if the phone number is optional
                'regex:/^(?:\+63|0)(9\d{2})\s?\d{3}\s?\d{4}$/', // Regex for Philippine phone numbers
            ],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB
            'about_me' => 'nullable|string|max:1000', // Add validation for "About Me"
        ]);

        // Update user details
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->phone = $request->input('phone', $user->phone);
        $user->about_me = $request->input('about_me', $user->about_me);

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


    public function updatePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'old_password' => 'required',  // Validate old password
            'new_password' => 'required|min:8|confirmed',  // Validate new password
        ]);

        $user = Auth::user();

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

}


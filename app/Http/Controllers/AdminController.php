<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Notifications\VerificationRejectedNotification;


class AdminController extends Controller
{
    public function viewUsers()
    {
        $users = User::where('role', '!=', 'admin')->paginate(6); // Paginate 10 users per page
        return view('dash.dashtable', compact('users'));
    }

    public function allTutee()
    {
        // Eager load the enrollments relationship for tutees
        $tutees = User::with('enrollments')->where('role', 'tutee')->paginate(6);  // Paginate tutees with 10 per page

        return view('dash.dashtutee', compact('tutees'));
    }


    public function allCourse()
    {
        // Paginate courses with 6 per page (adjust the number as needed)
        $courses = Course::with('enrollments')->paginate(6);

        // Loop through each course and calculate the enrolled count for approved enrollments
        foreach ($courses as $course) {
            // Count the number of approved enrollments for each course
            $course->enrolledCount = $course->enrollments()->where('status', 'approved')->count();
        }

        // Pass the courses with the enrolledCount to the view
        return view('dash.dashallcourse', compact('courses'));
    }



    public function allTutor()
    {
        // Eager load the 'user' relationship for enrollments
        $enrollments = Enrollment::with('user')->get();

        // Paginate tutors with 10 per page (adjust the number as needed)
        $tutors = User::where('role', 'tutor')->paginate(6);

        return view('dash.dashtutor', compact('tutors', 'enrollments'));
    }

    public function approveVerification(Request $request, $userId)
    {
        // Find the user by ID, if not found, throw an exception
        $user = User::findOrFail($userId);

        // Get the verification status from the request
        $verificationStatus = $request->input('verification_status');
        $reason = $request->input('reason', 'The photo was not clear.'); // Default rejection reason

        // Update verification status and verified field
        $user->verification_status = $verificationStatus;
        $user->verified = $verificationStatus === 'approved' ? 1 : 0;
        $user->save();

        // Return a success response
        return response()->json(['success' => true]);
    }


    /**
     * Reject the verification and reset the status of the user.
     *
     * @param int $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectVerification(Request $request, $userId)
    {
        // Validate the rejection message from the form (optional, depending on your setup)
        $request->validate([
            'reason' => 'required|string|max:255',  // Adjust validation rules as necessary
        ]);

        // Find the user by ID
        $user = User::findOrFail($userId);

        // Reject the verification and reset the status
        $user->update([
            'verification_status' => 'not_submitted',
            'verified' => false, // Ensure the user is not marked as verified
        ]);

        // Send the rejection notification with the custom reason
        $user->notify(new VerificationRejectedNotification($request->reason));

        // Return a success message and redirect back
        return response()->json(['success' => true]);
    }



    public function dashCreate(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Update the filter for 'active' instead of 'status'
        if ($request->has('status') && $request->status != '') {
            $status = $request->status == 'active' ? 1 : 0;
            $query->where('active', $status);
        }


        // Sorting
        if ($request->has('sort_by') && $request->has('sort_order')) {
            $query->orderBy($request->sort_by, $request->sort_order);
        }

        // Get the users with pagination
        $users = $query->paginate(6);

        return view('dash.dashcreate', compact('users'));
    }


}


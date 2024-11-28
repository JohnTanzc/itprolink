<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    // In the appropriate controller (likely EnrollmentController or UserController)
    public function showEnrollee()
    {
        // Fetch users with their enrollments (eager loading)
        $users = User::with('enrollments')->paginate(10);

        // Pass the users to the view
        return view('dash.dashenrollee', compact('users'));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Adjust if necessary
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = Auth::user();

        // Check if the user is verified
        if (!$user->verified) {
            // If not verified, return an error and ask for verification
            return redirect()->back()->with('error', 'You need to get verified first to enroll.');
        }

        // Check if the user is already enrolled in the course
        $existingEnrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $validated['course_id'])
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Enroll the user if they are verified and not already enrolled
        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $validated['course_id'],
        ]);

        // Update the UI state in the front-end to show the button is disabled (in progress)
        return redirect()->back()->with('success', 'You have successfully enrolled in this course! Enrollment is in progress...');
    }



    public function updateStatus(Request $request, $id)
    {
        // Find the enrollment by its ID
        $enrollment = Enrollment::findOrFail($id);

        // Get the new status from the request
        $newStatus = $request->input('status');

        // Define the valid statuses
        $validStatuses = ['pending', 'approved', 'rejected'];

        // Check if the new status is valid
        if (in_array($newStatus, $validStatuses)) {
            // If the status is 'rejected', delete the enrollment
            if ($newStatus === 'rejected') {
                $enrollment->delete();  // Delete the enrollment record
                return back()->with('success', 'Enrollment has been rejected and deleted.');
            }

            // Otherwise, update the enrollment's status
            $enrollment->status = $newStatus;
            $enrollment->updated_at = now(); // Update the timestamp
            $enrollment->save();

            // Return a success response
            return back()->with('success', 'Enrollment status updated successfully.');
        } else {
            // Handle invalid status
            return back()->with('error', 'Invalid status selected.');
        }
    }

    public function getEnrolledStudentsCount($courseId)
    {
        // Count the number of enrollments for the specific course
        $enrolledCount = Enrollment::where('course_id', $courseId)->count();

        // Pass the count to the view (replace 'your.view' with your actual view file)
        return view('dash.dashenrolledstudents', compact('enrolledCount'));
    }


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id'); // Assuming 'course_id' is the course's ID
    }
}

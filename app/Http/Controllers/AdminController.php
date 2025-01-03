<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Storage;
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
        return response()->json([
            'success' => true,
            'message' => 'Verification status updated successfully.'
        ]);
    }


    /**
     * Reject the verification and reset the status of the user.
     *
     * @param int $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectVerification(Request $request, $userId)
    {
        // Validate the rejection message from the form
        $request->validate([
            'reason' => 'required|string|max:255',
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

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Verification rejected successfully.'
        ]);
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

    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'fname' => 'nullable|string|max:255',
            'lname' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'role' => 'nullable|in:tutee,tutor,admin',
            'active' => 'nullable|in:0,1', // Validate status field
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return response()->json(['status' => true, 'message' => 'Profile updated successfully!']);
    }

    public function getUserProfile($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'fname' => $user->fname,
            'lname' => $user->lname,
            'email' => $user->email,
            'age' => $user->age,
            'gender' => $user->gender,
            'birthday' => $user->birthday ? $user->birthday->format('Y-m-d') : null,
            'role' => $user->role,
            'active' => $user->active,
        ]);
    }


    public function getUserData($id)
    {
        $user = User::find($id); // Find the user by ID
        return response()->json($user); // Return the user data as JSON
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);

            // Perform any additional checks if needed
            // e.g., prevent deleting an admin, etc.

            $user->delete();

            return response()->json(['message' => 'User deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting user: ' . $e->getMessage()], 500);
        }
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,tutor,tutee',
        ]);

        User::create([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('admin.dashcreate')->with('success', 'User added successfully!');
    }
}

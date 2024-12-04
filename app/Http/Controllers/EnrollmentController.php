<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class EnrollmentController extends Controller
{
    // In the appropriate controller (likely EnrollmentController or UserController)
    public function showEnrollee()
    {
        // Fetch users with their enrollments (eager loading)
        $users = User::with('enrollments')->paginate(6);

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
            'sender_number' => 'required|string|max:15',
            'sender_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'ref_no' => 'required|string|unique:payments,ref_no',
            'screenshot' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Check if the user is verified
        if (!$user->verified) {
            return redirect()->back()->with('error', 'You need to get verified first to enroll.');
        }

        // Check if the user is already enrolled
        $existingEnrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $validated['course_id'])
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Create a new enrollment
        $enrollment = Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $validated['course_id'],
            'status' => 'pending', // Default status
        ]);

        // Handle the screenshot upload
        $screenshotPath = $request->file('screenshot')->store('payments', 'public');

        // Create a payment record
        Payment::create([
            'enrollment_id' => $enrollment->id,
            'sender_number' => $validated['sender_number'],
            'sender_name' => $validated['sender_name'],
            'amount' => $validated['amount'],
            'ref_no' => $validated['ref_no'],
            'screenshot' => $screenshotPath,
        ]);

        return redirect()->back()->with('success', 'You have successfully enrolled and submitted your payment. Enrollment is in progress...');
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

    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'isPaid' => 'required|in:0,1,2', // Validate the input
        ]);

        $enrollment = Enrollment::findOrFail($id);
        $enrollment->isPaid = $request->input('isPaid');
        $enrollment->save();

        return redirect()->back()->with('success', 'Payment status updated successfully.');
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

    public function payments()
    {
        // Correct eager loading for the singular relationship
        $payments = Payment::with(['enrollment.user'])->paginate(6);  // 'enrollment' should be singular

        // Pass the payments data to the view
        return view('dash.dashpayments', compact('payments'));
    }
}

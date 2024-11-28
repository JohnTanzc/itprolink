<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Method to handle the "Enroll Now" action
    public function enrollNow()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is a tutee and if they are verified
        $isVerified = ($user->role == 'tutee' && $user->verified);

        // Return the view and pass the verification status
        return view('dash.dashcourse', compact('isVerified'));
    }

    // Method to show the profile settings page (using the existing `dashsetting` view)
    public function settings()
    {
        $user = Auth::user();

        // Check if the user is a tutee and if they are verified
        if ($user->role == 'tutee' && !$user->verified) {
            return view('dashboard.dashsetting', ['verificationPending' => true]);
        }

        return view('dashboard.dashsetting', ['verificationPending' => false]);
    }

    // Method to handle verification document uploads (ID and photo with ID)
    public function uploadVerificationDocuments(Request $request)
    {
        // Logic to handle the file upload and update the verification status
        $request->validate([
            'id_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo_with_id' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Store the files
        $idImagePath = $request->file('id_image')->store('verifications', 'public');
        $photoWithIdPath = $request->file('photo_with_id')->store('verifications', 'public');

        // Update the user's verification status (assuming a `verified` field exists)
        $user->update([
            'id_image' => $idImagePath,
            'photo_with_id' => $photoWithIdPath,
            'verified' => false, // Pending admin approval
        ]);

        return back()->with('status', 'Documents uploaded successfully. Please wait for admin approval.');
    }


}

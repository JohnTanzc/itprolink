<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /**
     * Check the verification status of the logged-in user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkVerificationStatus()
    {
        $user = auth()->user();

        // Check if the user is a tutee or tutor
        if ($user->role === 'tutee' || $user->role === 'tutor') {
            // Check if the user's verification status is approved
            if ($user->verified !== 'approved') {
                return response()->json([
                    'verified' => false,
                    'message' => 'Your account is not verified yet or is pending approval.'
                ]);
            }

            // If verified, return success message
            return response()->json(['verified' => true]);
        }

        // If the user is neither a tutee nor a tutor
        return response()->json([
            'verified' => false,
            'message' => 'Only tutors and tutees can check verification status.'
        ], 403);
    }

    /**
     * Handle the upload of verification documents (ID and photo with ID).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadVerification(Request $request)
    {
        $user = Auth::user();

        // Validation for both tutee and tutor
        $request->validate([
            'id_photo' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            'selfie_with_id' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        // Delete old verification files if they exist
        if ($user->id_photo) {
            Storage::disk('public')->delete($user->id_photo);
        }
        if ($user->selfie_with_id) {
            Storage::disk('public')->delete($user->selfie_with_id);
        }

        // Save the new uploaded files
        $idPhotoPath = $request->file('id_photo')->store('verification/id_photos', 'public');
        $selfiePath = $request->file('selfie_with_id')->store('verification/selfies', 'public');

        // Initialize diplomaPath for tutors
        $diplomaPath = null;

        // Handle diploma upload for tutors
        if ($user->role === 'tutor') {
            $request->validate([
                'diploma' => 'nullable|mimes:pdf,jpg,png|max:10000',
            ]);

            if ($user->diploma) {
                Storage::disk('public')->delete($user->diploma);
            }

            $diplomaPath = $request->hasFile('diploma')
                ? $request->file('diploma')->store('verification/diplomas', 'public')
                : null;
        }

        // Update user's verification data
        $user->update([
            'id_photo' => $idPhotoPath,
            'selfie_with_id' => $selfiePath,
            'diploma' => $diplomaPath,
            'verification_status' => 'pending', // Set status to pending
            'verified' => false, // Reset to not verified
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Your documents have been submitted for verification.');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // For date manipulation
use App\Models\Credential; // Import the Credential model

class TuteeProfileController extends Controller
{
    /**
     * Display the Tutee profile with age calculation.
     */
    public function tuteeprofile()
    {
        // Fetch the currently authenticated user
        $user = Auth::user();

        // Calculate age based on the birthday field
        $age = $user->birthday ? Carbon::parse($user->birthday)->age : null;

        // Fetch credentials associated with the user
        $credentials = Credential::where('user_id', $user->id)->get(); // Get user's credentials

        // Return the view with the user data, calculated age, and credentials
        return view('tuteeprofile', [ // Change to 'tuteeprofile' view
            'user' => $user,
            'age' => $age, // Pass age to the view
            'credentials' => $credentials, // Pass credentials to the view
        ]);
    }

    /**
     * Upload and update the profile picture.
     */
    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png|max:10240',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            // Get the original filename
            $originalName = $request->file('image')->getClientOriginalName();

            // Create a unique filename to avoid overwriting
            $filename = time() . '_' . $originalName;

            // Store the image with the original name in 'profile_pictures'
            $path = $request->file('image')->storeAs('profile_pictures', $filename, 'public'); // Use the unique filename

            // Save the image path to the user's profile
            $user->profile_picture = $path;
            $user->save();
        }

        return back()->with('success', 'Profile picture updated successfully!');
    }

    /**
     * Update user profile including birthday, "About Me", and other fields.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'gender' => 'required|in:Male,Female,Others',
            'birthday' => 'nullable|date|before:today', // Validate birthday
            'about_me' => 'nullable|string|max:1000', // Add validation for "About Me"
        ]);

        $user = Auth::user();

        // Update user profile fields
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');

        // Update birthday if provided
        $user->birthday = $request->input('birthday');

        // Update "About Me" message
        $user->about_me = $request->input('about_me');

        // Save the updated user data
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}

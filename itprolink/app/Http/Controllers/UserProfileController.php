<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image; // If you are using Intervention Image
use Carbon\Carbon; // Add Carbon for date manipulation

class UserProfileController extends Controller
{
    /**
     * Display the user profile with age calculation.
     */
    public function userprofile()
    {
        // Fetch the currently authenticated user
        $user = Auth::user();

        // Calculate age based on the birthday field
        $age = $user->birthday ? Carbon::parse($user->birthday)->age : null;

        // Return the view with the user data and calculated age
        return view('userprofile', [
            'user' => $user,
            'age' => $age, // Pass age to the view
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
            // Store the image with the original name in 'profile_pictures'
            $path = $request->file('image')->storeAs('profile_pictures', $originalName, 'public');

            // Save the image path to the user's profile
            $user->profile_picture = $path;
            $user->save();
        }

        return back()->with('success', 'Profile picture updated successfully!');
    }

    /**
     * Update user profile including birthday and other fields.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'gender' => 'required|in:Male,Female,Others',
            'birthday' => 'nullable|date|before:today', // Validate birthday
        ]);

        $user = Auth::user();

        // Update user profile fields
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');

        // Update birthday if provided
        $user->birthday = $request->input('birthday');

        // Recalculate age after updating birthday
        // Note: The 'age' field is not stored in the database; it can be calculated when needed
        $user->age = $user->birthday ? Carbon::parse($user->birthday)->age : null;

        // Save the updated user data
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}

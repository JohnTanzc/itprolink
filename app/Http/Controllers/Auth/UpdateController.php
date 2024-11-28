<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    /**
     * Show the form for editing the specified user profile.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
{
    // Find the user by ID
    $user = User::findOrFail($id);
    // Return the edit view with the user data
    return view('auth.update-user', compact('user'));
}

    /**
     * Update the specified user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Validate the request data
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'age' => 'required|integer',
            'birthday' => 'required|date',
            'email' => 'required|email|max:255',
            'mobile' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'about_me' => 'nullable|string|max:1000', // Add validation for "About Me"
        ]);

        // Update user details with the validated data
        $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'age' => $request->age,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'about_me' => $request->about_me,
        ]);

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
            $user->save();
        }

         // Redirect the user back to their profile page based on role
         $redirectRoute = auth()->user()->role === 'tutor' ? 'tutor.profile' : 'tutee.profile';

         return redirect()->route($redirectRoute)->with('success', 'Profile updated successfully.');
    }
}

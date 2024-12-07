<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Notifications\WelcomeDashboardNotification; // Import the notification class


class UserRegistrationController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->user()) {
            return redirect()->intended('/');
        }
        return view('auth.user-login');
    }

    public function showRegistrationForm()
    {
        return view('auth.user-register');
    }


    public function register(Request $request)
    {
        // Validate the user input
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:tutor,tutee',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the new user
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Assign role to the user using Spatie
        $role = Role::findByName($request->role);
        $user->assignRole($role);

        // Send the welcome notification to the dashboard
        $user->notify(new WelcomeDashboardNotification());

        // Redirect back to the registration page with SweetAlert success message
        return redirect()->route('user.login') // Redirect to login page
            ->with('success', 'Registration successful!'); // Add success message to session
    }




}

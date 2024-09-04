<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserRegistrationController extends Controller
{
    public function showLoginForm()
    {
        if(auth()->user()){
            return redirect()->intended('/home');
        }
        return view('auth.user-login');
    }

    public function showRegistrationForm(){
        return view ('auth.user-register');
    }

    // public function register(Request $request)
    // {
    //     // Validate the user input for user registration
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'address' => 'required|string|max:255',
    //         'phone' => 'required|numeric',
    //         'email' => 'required|string|email|unique:users,email,NULL,id',
    //         'password' => 'required|string|min:4|confirmed',
    //     ]);

    //     // Create the new user
    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->address = $request->address;
    //     $user->phone = $request->phone;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);
    //     $user->save();

    //     $role = Role::findByName('user');
    //     $user->assignRole($role);

    //     $image = $request->file('image');
    //     if ($image) {
    //         $path = $image->store('valid-id', 'public');
    //         User::whereid($user->id)->update([
    //             'valid_id' => $path,
    //         ]);
    //     }

    //     $user->sendEmailVerificationNotification();

    //     return response()->json(['code' => 200, 'status' => 'success', 'data' => $user], 200);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember_me') ? true : false;


        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed, redirect to a property owner dashboard or other secure page
            $user = Auth::user();
            $role = $user->roles->first();
            if ($role && $role->name === 'user' && $user->status == 1) {
                return redirect()->intended('/home');
            }
            Auth::logout();
            return redirect()->route('user.login')->with('error', 'Your credentials are invalid');
        } else {
            // Authentication failed, redirect back to the login form with an error message
            return redirect()->route('user.login')->with('error', 'Your credentials are invalid');
        }
    }

}

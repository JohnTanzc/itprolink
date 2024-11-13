<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CredentialController extends Controller
{

    public function index()
    {
        $credential = Credential::all();
        return view('pages.credentials', compact('credential'));
    }

    // Display all credentials for the authenticated user
    // Method to handle the credential file upload
    public function store(Request $request)
    {
        $request->validate([
            'credential_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('credential_image')) {
            $file = $request->file('credential_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('credential', $filename, 'public');

            // Assuming you have a Credential model that stores image data
            $credential = new Credential();
            $credential->user_id = auth()->id(); // Assign user ID if necessary
            $credential->image_path = $path;
            $credential->save();

            return back()->with('success', 'Credential image uploaded successfully.');
        }

        return back()->withErrors(['credential_image' => 'Please select an image to upload.']);
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'rateable_id' => 'required|integer',
            'rateable_type' => 'required|string',
            'stars' => 'required|integer|between:1,5', // Ensure a valid star rating
        ]);

        // Create a new rating
        $rating = new Rating();
        $rating->rateable_id = $request->rateable_id; // The ID of the course or tutor
        $rating->rateable_type = $request->rateable_type; // The model type (Course or Tutor)
        $rating->stars = $request->stars; // The star rating
        $rating->user_id = auth()->id(); // Store the authenticated user's ID
        $rating->save();

        return back()->with('success', 'Rating saved successfully!');
    }
}

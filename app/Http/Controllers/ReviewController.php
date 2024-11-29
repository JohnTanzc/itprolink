<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Submit a new review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitReview(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'rate' => 'required|integer|between:1,5',
            'course_id' => 'required|exists:courses,id',  // Ensure the course exists in the database
        ]);

        // Save the review
        Review::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'rate' => $validated['rate'],
            'course_id' => $validated['course_id'],
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

}

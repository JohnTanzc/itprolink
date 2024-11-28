<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::with('user')->get(); // Fetch all courses
        return view('index', compact('courses'));  // Pass courses to the 'layouts.main' view
    }


    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('about');
    }
    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contacts()
    {
        return view('contacts');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('termscondition');
    }
    public function faqs()
    {
        return view('faq');
    }
    public function error()
    {
        return view('error');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
class CourseController extends Controller
{


    /**
     * Show the main courses page.
     */
    public function course()
    {
        // Check if the user is authenticated
        $user = Auth::check() ? Auth::user() : null;

        // Fetch courses based on user role or show all courses for guests
        $courses = $user && $user->role === 'tutor'
            ? Course::where('user_id', $user->id)->paginate(6) // Tutors see their own courses
            : Course::paginate(6); // Everyone else sees all courses

        return view('course', compact('courses'));
    }

    /**
     * Display a listing of all courses.
     */
    public function index()
    {
        $courses = Course::all(); // Fetch all courses
        return view('tutors.coursedetail', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        if (Auth::user()->role !== 'tutor') {
            return redirect()->back()->with('error', 'Only tutors can create courses.');
        }

        return view('courses.create'); // Create course form
    }

    /**
     * Store a newly created course in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'section' => 'required|string',
            'instructor_name' => 'required|string',
            'courselanguage' => 'nullable|array',
            'courselanguage.*' => 'string',
            'requirement' => 'nullable|string',
            'description' => 'nullable|string',
            'class' => 'required|integer',
            'course_time' => 'required|integer',
            'level' => 'required|string',
            'category' => 'required|string', // Added category field
            'image' => 'nullable|image|max:2048',
        ]);

        if (Auth::user()->role !== 'tutor') {
            return redirect()->back()->with('error', 'Only tutors can upload courses.');
        }

        $course = new Course();
        $course->title = $request->title;
        $course->section = $request->section;
        $course->instructor_name = $request->instructor_name;
        $course->courselanguage = implode(', ', $request->courselanguage ?? []); // Store languages as comma-separated string
        $course->requirement = $request->requirement;
        $course->description = $request->description;
        $course->class = $request->class;
        $course->course_time = $request->course_time;
        $course->category = $request->category; // Store the selected category
        $course->user_id = Auth::id();
        $course->level = $request->level;
        $course->uploaded_date = now();

        // Handle the image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalPath = $file->getPathname(); // Get the temporary file path
            $newFilename = uniqid() . '.jpg'; // Generate a unique filename
            $newPath = public_path('storage/courses/' . $newFilename); // Destination path

            // Resize the image using GD
            $this->resizeImageGD($originalPath, $newPath, 600, 400);

            $course->image = 'courses/' . $newFilename; // Store the relative path in the database
        } else {
            // If no image uploaded, assign the default image based on category
            $defaultImages = [
                'graphic-design' => 'graphicdesign-default.png',
                'ui/ux' => 'uiux-default.png',
                'data-analysis' => 'data-analysis-default.png',
                'itsuppport-&-troubleshooting' => 'itsuppport-&-troubleshooting-default.png',
                'webdesign-&-development' => 'webdesign-&-development-default.png',
                'game-design' => 'game-design-default.png',
                'digital-illustration' => 'digital-illustration-default.png',
                'character-animation' => 'character-animation-default.png',
                'cloud-computing' => 'cloud-computing-default.png',
                '3d-modeling' => '3d-modeling-default.png',
                'other' => 'default-other.png',
            ];

            $category = $course->category; // Get the selected category
            $image = $defaultImages[$category] ?? 'default-other.jpg'; // Use default image or fallback to 'other'

            // Set the default image
            $course->image = 'courses/' . $image;
        }

        $course->save();

        return redirect()->route('courses.store')->with('success', 'Course created successfully.');
    }
    /**
     * Get the default image for a given category.
     */
    private function getDefaultImage($category)
    {
        $defaultImages = [
            'graphic-design' => 'graphicdesign-default.png',
            'ui/ux' => 'uiux-default.png',
            'data-analysis' => 'data-analysis-default.png',
            'itsuppport-&-troubleshooting' => 'itsuppport-&-troubleshooting-default.png',
            'webdesign-&-development' => 'webdesign-&-development-default.png',
            'game-design' => 'game-design-default.png',
            'digital-illustration' => 'digital-illustration-default.png',
            'character-animation' => 'character-animation-default.png',
            'cloud-computing' => 'cloud-computing-default.png',
            '3d-modeling' => '3d-modeling-default.png',
            'other' => 'default-other.png',
        ];

        // Fallback to 'default-other.jpg' if the category does not exist
        return 'categories/' . ($defaultImages[$category] ?? 'default-other.png');
    }

    /**
     * Resize an image using GD.
     */
    private function resizeImageGD($sourcePath, $destinationPath, $width, $height)
    {
        $originalImage = imagecreatefromstring(file_get_contents($sourcePath));
        $originalWidth = imagesx($originalImage);
        $originalHeight = imagesy($originalImage);

        $resizedImage = imagecreatetruecolor($width, $height);

        imagecopyresampled(
            $resizedImage,
            $originalImage,
            0,
            0,
            0,
            0,
            $width,
            $height,
            $originalWidth,
            $originalHeight
        );


        // Save the resized image as a JPEG
        imagejpeg($resizedImage, $destinationPath, 100); // Save as JPEG with 100% quality


        // Free up memory
        imagedestroy($originalImage);
        imagedestroy($resizedImage);
    }
    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        // Ensure only tutee and tutor roles can access
        if (Auth::check() && !in_array(Auth::user()->role, ['tutee', 'tutor'])) {
            abort(403, 'Forbidden');
        }

        // Initialize verification and enrollment status variables
        $isVerified = false;
        $isInProgress = false;

        // Check if the user is authenticated and their verification status
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user is verified (only for tutees)
            if ($user->role === 'tutee') {
                $isVerified = $user->is_verified; // Assuming 'is_verified' is the verification status column
            } elseif ($user->role === 'tutor') {
                // If the tutor doesn't need verification, set to true
                $isVerified = true;
            }

            // Check if the user has an ongoing enrollment process
            $isInProgress = $user->enrollment_in_progress ?? false; // Update based on your actual logic
        }
        // Retrieve all courses
        $courses = Course::all();

        // Calculate enrolled count for each course
        foreach ($courses as $course) {
            // Count the number of approved enrollments for each course
            $course->enrolledCount = Enrollment::where('course_id', $course->id)
                ->where('status', 'approved') // Filter by approved status
                ->count();
        }

        // Count enrolled students with an 'approved' status, excluding those in progress
        $enrolledCount = Enrollment::where('course_id', $course->id)
            ->where('status', 'approved') // Filter by approved status
            ->count();

        // Pass variables to the view
        return view('dash.dashcourse', compact('course', 'isVerified', 'isInProgress', 'enrolledCount'));
    }



    /**
     * Show the form for editing a course.
     */
    public function edit(Course $course)
    {
        if (Auth::id() !== $course->user_id) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        return view('courses.edit', compact('course')); // Add an edit Blade for the course form
    }

    /**
     * Update the specified course in the database.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string',
            'section' => 'required|string',
            'instructor_name' => 'required|string',
            'courselanguage' => 'nullable|array',
            'courselanguage.*' => 'string',
            'requirement' => 'nullable|string',
            'description' => 'nullable|string',
            'class' => 'required|integer',
            'course_time' => 'required|integer',
            'level' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if (Auth::id() !== $course->user_id) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $course->title = $request->title;
        $course->section = $request->section;
        $course->instructor_name = $request->instructor_name;
        $course->courselanguage = implode(', ', $request->courselanguage ?? []); // Store languages as comma-separated string
        $course->requirement = $request->requirement;
        $course->description = $request->description;
        $course->class = $request->class;
        $course->level = $request->level;
        $course->course_time = $request->course_time;

        if ($request->file('image')) {
            $course->image = $request->file('image')->store('courses', 'public');
        }

        $course->save();

        return redirect()->route('tutors.coursedetail')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified course from the database.
     */
    public function destroy(Course $course)
    {
        if (Auth::id() !== $course->user_id) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $course->delete();
        return redirect()->route('tutors.coursedetail')->with('success', 'Course deleted successfully.');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }
}

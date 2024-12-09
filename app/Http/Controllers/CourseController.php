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
            ? Course::paginate(6) // Tutors see all courses, including their own
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
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'price' => 'nullable|numeric|min:0',
            'lectures' => 'nullable|array',
            'lectures.*.lecture_title' => 'required|string|max:255',
            'lectures.*.resources' => 'nullable|array',
            'lectures.*.resources.*.title' => 'required|string|max:255',
            'lectures.*.resources.*.file' => 'nullable|file|mimes:pdf|max:10240', // PDF files for resources
        ]);

        if (Auth::user()->role !== 'tutor') {
            return redirect()->back()->with('error', 'Only tutors can upload courses.');
        }

        // Create course record
        $course = new Course();
        $course->title = $request->title;
        $course->section = $request->section;
        $course->instructor_name = $request->instructor_name;
        $course->courselanguage = implode(', ', $request->courselanguage ?? []);
        $course->requirement = $request->requirement;
        $course->description = $request->description;
        $course->class = $request->class;
        $course->course_time = $request->course_time;
        $course->category = $request->category;
        $course->user_id = Auth::id();
        $course->level = $request->level;
        $course->price = $request->price;
        $course->uploaded_date = now();

        // Initialize resources as an empty array
        $resources = [];

        if ($request->has('lectures')) {
            foreach ($request->lectures as $lecture) {
                // Initialize resources array for the current lecture
                $lectureResources = [];

                if (isset($lecture['resources'])) {
                    foreach ($lecture['resources'] as $resource) {
                        if (isset($resource['file']) && $resource['file']) {
                            // Store the PDF file in the 'resources' directory
                            $filePath = $resource['file']->store('resources', 'public');

                            // Add resource info: lecture title, resource title, and resource file path
                            $lectureResources[] = [
                                'resource_title' => $resource['title'], // Resource title
                                'resource_file' => $filePath // Stored file path
                            ];
                        }
                    }
                }

                // Add lecture with resources to the resources array
                if (count($lectureResources) > 0) {
                    $resources[] = [
                        'lecture_title' => $lecture['lecture_title'], // Lecture title
                        'resources' => $lectureResources // Resources under the lecture title
                    ];
                }
            }
        }

        // Store resources (lecture title, resource title, and resource file) in the `resources` column as JSON
        $course->resources = json_encode($resources);

        // Handle the image upload if provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalPath = $file->getPathname(); // Get the temporary file path
            $newFilename = uniqid() . '.jpg'; // Generate a unique filename
            $newPath = public_path('storage/courses/' . $newFilename); // Destination path

            // Resize the image using GD
            $this->resizeImageGD($originalPath, $newPath, 600, 400);

            $course->image = 'courses/' . $newFilename; // Store the relative path in the database
        } else {
            // Default image based on category
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

            $category = $course->category;
            $image = $defaultImages[$category] ?? 'default-other.jpg';

            $course->image = 'courses/' . $image;
        }

        // Save the course record
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

        if (Auth::check()) {
            $user = Auth::user();

            // Check verification status for tutee
            if ($user->role === 'tutee') {
                $isVerified = $user->is_verified; // Assuming 'is_verified' is the verification status column
            } elseif ($user->role === 'tutor') {
                $isVerified = true; // Tutors are considered verified automatically
            }

            // Check for ongoing enrollment process
            $isInProgress = $user->enrollment_in_progress ?? false;
        }

        // Calculate enrolled count for the specific course
        $enrolledCount = Enrollment::where('course_id', $course->id)
            ->where('status', 'approved') // Filter by approved status
            ->count();

        // Decode resources if stored as JSON
        $resources = is_string($course->resources) ? json_decode($course->resources, true) : $course->resources;

        // Group resources under each lecture title
        $lecturesWithResources = [];
        if ($resources) {
            foreach ($resources as $resource) {
                // Ensure the resource has both resource_title and resource_file keys before accessing them
                if (isset($resource['resource_title']) && isset($resource['resource_file'])) {
                    // Check if the lecture already exists in the array
                    $lectureIndex = array_search($resource['lecture_title'], array_column($lecturesWithResources, 'lecture_title'));

                    // If the lecture exists, add the resource to that lecture
                    if ($lectureIndex !== false) {
                        $lecturesWithResources[$lectureIndex]['resources'][] = [
                            'resource_title' => $resource['resource_title'],
                            'resource_file' => $resource['resource_file']
                        ];
                    } else {
                        // If the lecture doesn't exist, create a new entry
                        $lecturesWithResources[] = [
                            'lecture_title' => $resource['lecture_title'],
                            'resources' => [
                                [
                                    'resource_title' => $resource['resource_title'],
                                    'resource_file' => $resource['resource_file']
                                ]
                            ]
                        ];
                    }
                }
            }
        }

        // Pass the course details, verification status, enrollment count, and grouped resources to the view
        return view('dash.dashcourse', compact('course', 'isVerified', 'isInProgress', 'enrolledCount', 'lecturesWithResources'));
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
            'price' => 'nullable|numeric|min:0',
            'lectures.*.lecture_title' => 'required|string|max:255', // Each lecture should have a title
            'lectures.*.resources' => 'nullable|array', // Each lecture can have resources
            'lectures.*.resources.*.title' => 'required|string|max:255', // Each resource in lecture must have a title
            'lectures.*.resources.*.file' => 'nullable|file|mimes:pdf|max:10240', // PDF files for resources
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
        $course->price = $request->price;
        // Add lectures and resources handling
        $course->lectures = $request->lectures ? json_encode($request->lectures) : null;
        $course->resources = $request->resources ? json_encode($request->resources) : null;
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

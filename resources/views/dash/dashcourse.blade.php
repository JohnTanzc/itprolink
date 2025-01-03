@extends('layouts.main')
@section('content')
    {{-- Header --}}
    @include('pages.nav')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="breadcrumb-area pt-50px pb-50px bg-white pattern-bg">
        <div class="container">
            <div class="col-lg-8 me-auto">
                <div class="breadcrumb-content">
                    <ul class="generic-list-item generic-list-item-arrow d-flex flex-wrap align-items-center">
                        <li><a href="index.html">Home</a></li>
                        <li><a>Course</a></li>
                        <li><a>Details</a></li>
                    </ul>
                    <div class="section-heading">
                        <h2 class="section__title">
                            {{ $course->title }}
                        </h2>
                        <p class="section__desc pt-2 lh-30">
                            {{ $course->section }}
                        </p>
                    </div>
                    <!-- end section-heading -->
                    <div class="d-flex flex-wrap align-items-center pt-3">
                        <h6 class="ribbon ribbon-lg me-2 bg-3 text-white">{{ $course->level }}</h6>
                        <div class="rating-wrap d-flex flex-wrap align-items-center">
                            <div class="review-stars">
                                <span class="rating-number">{{ $course->rating }}</span>
                                <!-- Add stars based on rating -->
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="la la-star{{ $i <= $course->rating ? '' : '-o' }}"></span>
                                @endfor
                            </div>
                            <span class="rating-total ps-1">(20,230 ratings)</span>
                            <span class="student-total ps-2">{{ $enrolledCount }}
                                @if ($enrolledCount === 1)
                                    Tutee
                                @else
                                    Tutees
                                @endif
                            </span>
                        </div>
                    </div>
                    <!-- end d-flex -->
                    <p class="pt-2 pb-1">
                        Created by
                        <a href="{{ route('pub.profile', ['id' => $course->user_id]) }}" class="text-color hover-underline">
                            {{ $course->instructor->fname }} {{ $course->instructor->lname }}
                            <!-- Dynamically retrieves the instructor's name -->
                        </a>
                    </p>
                    <div class="d-flex flex-wrap align-items-center">
                        <p class="pe-3 d-flex align-items-center">
                            <svg class="svg-icon-color-gray me-1" width="16px" viewBox="0 0 24 24">
                                <path
                                    d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12zm-10 5h-2v-2h2v2zm0-4h-2V7h2v6z">
                                </path>
                            </svg>
                            @if ($course->created_at != $course->updated_at)
                                Last updated {{ $course->updated_at->format('j M, Y') }}
                            @else
                                Created on {{ $course->created_at->format('j M, Y') }}
                            @endif
                        </p>
                        <p class="pe-3 d-flex align-items-center">
                            <svg class="svg-icon-color-gray me-1" width="16px" viewBox="0 0 24 24">
                                <path
                                    d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95a15.65 15.65 0 00-1.38-3.56A8.03 8.03 0 0118.92 8zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56A7.987 7.987 0 015.08 16zm2.95-8H5.08a7.987 7.987 0 014.33-3.56A15.65 15.65 0 008.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 01-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z">
                                </path>
                            </svg>
                            {{ ucwords($course->courselanguage) }}
                        </p>
                    </div>
                    <!-- end d-flex -->
                </div>
                <!-- end breadcrumb-content -->
            </div>
            <!-- end col-lg-8 -->
        </div>
        <!-- end container -->
    </section>

    <section class="course-details-area pb-20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pb-5">
                    <div class="course-details-content-wrap pt-90px">
                        <div class="course-overview-card bg-gray p-4 rounded">
                            <h3 class="fs-24 font-weight-semi-bold pb-3">
                                Course Description
                            </h3>
                            <p class="fs-15 pb-2">
                                {{ $course->description }}
                            </p>
                        </div>
                        <!-- end course-overview-card -->

                        <!-- end course-overview-card -->
                        <div class="course-overview-card">
                            <h3 class="fs-24 font-weight-semi-bold pb-3">Requirements</h3>
                            <ul class="generic-list-item generic-list-item-bullet fs-15">
                                {!! $course->requirement !!}
                            </ul>
                        </div>
                        <!-- end course-overview-card -->


                        <!-- end course-overview-card -->
                        <div class="course-overview-card">
                            <div class="curriculum-header d-flex align-items-center justify-content-between pb-4">
                                <h3 class="fs-24 font-weight-semi-bold">Course content</h3>
                                <div class="curriculum-duration fs-15">
                                    <span class="curriculum-total__text me-2">
                                        <strong class="text-black font-weight-semi-bold">Total:</strong>
                                        @php
                                            // Decode the JSON string
                                            $resources = json_decode($course->resources, true);

                                            // Initialize resource count
                                            $totalResourceTitles = 0;

                                            // Check if resources are available and count each resource_title
                                            if ($resources) {
                                                foreach ($resources as $lecture) {
                                                    // Count the number of resources for each lecture
                                                    $totalResourceTitles += count($lecture['resources']);
                                                }
                                            }
                                        @endphp
                                        {{ $totalResourceTitles }}
                                        @if ($totalResourceTitles === 1)
                                            Resource
                                        @else
                                            Resources
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="curriculum-content">
                                <div id="accordion" class="generic-accordion">
                                    @foreach ($resources as $lectureIndex => $lectureWithResources)
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $lectureIndex }}">
                                                <button
                                                    class="btn btn-link d-flex align-items-center justify-content-between"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $lectureIndex }}"
                                                    aria-expanded="{{ $lectureIndex === 0 ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $lectureIndex }}">
                                                    <i class="la la-plus"></i>
                                                    <i class="la la-minus"></i>
                                                    {{ $lectureWithResources['lecture_title'] }}
                                                    <span class="fs-15 text-gray font-weight-medium">
                                                        @php
                                                            $resourceCount = !empty($lectureWithResources['resources'])
                                                                ? count($lectureWithResources['resources'])
                                                                : 0;
                                                        @endphp
                                                        {{ $resourceCount }}
                                                        @if ($resourceCount === 1)
                                                            Resource
                                                        @else
                                                            Resources
                                                        @endif
                                                    </span>
                                                </button>
                                            </div>
                                            <div id="collapse{{ $lectureIndex }}"
                                                class="collapse {{ $lectureIndex === 0 ? 'show' : '' }}"
                                                aria-labelledby="heading{{ $lectureIndex }}" data-bs-parent="#accordion">
                                                <div class="card-body">
                                                    <ul class="generic-list-item" id="resources-{{ $lectureIndex }}">
                                                        @if (!empty($lectureWithResources['resources']))
                                                            @foreach ($lectureWithResources['resources'] as $resourceIndex => $resource)
                                                                <li class="resource-item"
                                                                    id="resource-item-{{ $lectureIndex }}-{{ $resourceIndex }}">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <span>
                                                                            <i class="la la-file me-1"></i>
                                                                            {{ $resource['resource_title'] }}
                                                                        </span>
                                                                        @if ($isEnrolled)
                                                                            <!-- Display full resource content and allow download for enrolled users -->
                                                                            <span>
                                                                                <a href="{{ asset('storage/' . $resource['resource_file']) }}"
                                                                                    target="_blank" class="btn-link">
                                                                                    Download
                                                                                </a>
                                                                            </span>
                                                                        @else
                                                                            <!-- Display preview and watermark for non-enrolled users -->
                                                                            {{-- <span class="watermark">
                                                                                Enroll to this course to view full content
                                                                            </span> --}}
                                                                            <span>
                                                                                <a href="javascript:void(0);"
                                                                                    onclick="showAlert()" class="btn-link">
                                                                                    Download
                                                                                </a>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li>No resources available for this lecture.</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <script>
                            // SweetAlert for non-enrolled users
                            function showAlert() {
                                Swal.fire({
                                    title: 'Please Enroll!',
                                    text: 'You must enroll in the course to download this resource.',
                                    icon: 'warning',
                                    confirmButtonText: 'Okay'
                                });
                            }
                        </script>

                        {{-- About Instructor --}}
                        <div class="course-overview-card pt-5">
                            <h3 class="fs-24 font-weight-semi-bold pb-4">
                                About the instructor
                            </h3>
                            <div class="instructor-wrap">
                                <div class="media media-card">
                                    <div class="instructor-img">
                                        <a href="teacher-detail.html" class="media-img d-block">
                                            <img class="rounded-full"
                                                src="{{ asset('storage/profile_pictures/' . ($course->tutor->profile_picture ?? 'default-image.png')) }}"
                                                alt="Tutor thumbnail image" />
                                        </a>
                                        <ul class="generic-list-item pt-3">
                                            <li>
                                                <i class="la la-star me-2 text-color-3"></i> 4.6
                                                Instructor Rating
                                            </li>
                                            <li>
                                                <i class="la la-user me-2 text-color-3"></i>
                                                {{ $enrolledCount }}
                                                @if ($enrolledCount === 1)
                                                    Tutee
                                                @else
                                                    Tutees
                                                @endif
                                                </span>
                                            </li>
                                            <li>
                                                <i class="la la-comment-o me-2 text-color-3"></i>
                                                2,533 Reviews
                                            </li>
                                            <li>
                                                <i class="la la-play-circle-o me-2 text-color-3"></i>
                                                {{ $tutorCourseCount }}
                                                @if ($tutorCourseCount === 1)
                                                    Course
                                                @else
                                                    Courses
                                                @endif
                                            </li>
                                            <li>
                                                <a href="{{ route('pub.profile', ['id' => $course->user_id]) }}">View all
                                                    Courses</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end instructor-img -->
                                    <div class="media-body">
                                        <h5><a href="{{ route('pub.profile', ['id' => $course->user_id]) }}">{{ $course->instructor->fname }}
                                                {{ $course->instructor->lname }}</a></h5>
                                        <span class="d-block lh-18 pt-2 pb-3">Joined
                                            {{ $course->tutor->created_at->format('F j, Y') }}</span>
                                        <p class="text-black lh-18 pb-3">
                                            {{ $course->user->designation }}
                                        </p>
                                        @php
                                            // Split the about_me content into sentences by dots
                                            $sentences = preg_split('/(?<=\.)\s/', $course->user->about_me); // Split by periods (.) followed by spaces

                                            // First 5 sentences to be shown initially
                                            $firstPart = array_slice($sentences, 0, 5);

                                            // Remaining sentences will be hidden initially
                                            $remainingPart = array_slice($sentences, 5);
                                        @endphp

                                        <!-- Display the first 5 sentences -->
                                        <p class="pb-3">
                                            {!! nl2br(e(implode(' ', $firstPart))) !!}
                                        </p>

                                        <!-- Hidden content (remaining sentences) -->
                                        <div class="collapse" id="collapseMoreTwo">
                                            <p class="pb-3">
                                                {!! nl2br(e(implode(' ', $remainingPart))) !!}
                                            </p>
                                        </div>

                                        <!-- Toggle button for "Show more" -->
                                        <a class="collapse-btn collapse--btn fs-15" data-bs-toggle="collapse"
                                            href="#collapseMoreTwo" role="button" aria-expanded="false"
                                            aria-controls="collapseMoreTwo">
                                            <span class="collapse-btn-hide">Show more<i
                                                    class="la la-angle-down ms-1 fs-14"></i></span>
                                            <span class="collapse-btn-show">Show less<i
                                                    class="la la-angle-up ms-1 fs-14"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end instructor-wrap -->
                        </div>
                        {{-- End of Instructor --}}

                        {{-- Ratings View  --}}
                        <div class="course-overview-card pt-4">
                            <h3 class="fs-24 font-weight-semi-bold pb-4">Reviews</h3>
                            <div class="review-wrap">
                                <div class="d-flex flex-wrap align-items-center pb-4">
                                    <form method="post" class="me-3 flex-grow-1">
                                        <div class="form-group">
                                            <input class="form-control form--control ps-3" type="text" name="search"
                                                placeholder="Search reviews" />
                                            <span class="la la-search search-icon"></span>
                                        </div>
                                    </form>
                                    <div class="select-container select2-full-wrapper mb-3">
                                        <select class="select-container-select">
                                            <option value="all-rating">All ratings</option>
                                            <option value="five-star">Five stars</option>
                                            <option value="four-star">Four stars</option>
                                            <option value="three-star">Three stars</option>
                                            <option value="two-star">Two stars</option>
                                            <option value="one-star">One star</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                    <div class="media-img me-4 rounded-full">
                                        <img class="rounded-full lazy" src="images/img-loading.png"
                                            data-src="images/small-avatar-1.jpg" alt="User image" />
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                            <h5>Kavi arasan</h5>
                                            <div class="review-stars">
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                            </div>
                                        </div>
                                        <span class="d-block lh-18 pb-2">a month ago</span>
                                        <p class="pb-2">
                                            This is one of the best courses I have taken in Udemy.
                                            It is very complete, and it has made continue learning
                                            about Java and SQL databases as well.
                                        </p>
                                        <div class="helpful-action">
                                            <span class="d-block fs-13">Was this review helpful?</span>
                                            <button class="btn">Yes</button>
                                            <button class="btn">No</button>
                                            <span class="btn-text fs-14 cursor-pointer ps-1" data-bs-toggle="modal"
                                                data-bs-target="#reportModal">Report</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- end media -->
                                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                    <div class="media-img me-4 rounded-full">
                                        <img class="rounded-full lazy" src="images/img-loading.png"
                                            data-src="images/small-avatar-2.jpg" alt="User image" />
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                            <h5>Jitesh Shaw</h5>
                                            <div class="review-stars">
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                            </div>
                                        </div>
                                        <span class="d-block lh-18 pb-2">1 months ago</span>
                                        <p class="pb-2">
                                            This is one of the best courses I have taken in Udemy.
                                            It is very complete, and it has made continue learning
                                            about Java and SQL databases as well.
                                        </p>
                                        <div class="helpful-action">
                                            <span class="d-block fs-13">Was this review helpful?</span>
                                            <button class="btn">Yes</button>
                                            <button class="btn">No</button>
                                            <span class="btn-text fs-14 cursor-pointer ps-1" data-bs-toggle="modal"
                                                data-bs-target="#reportModal">Report</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- end media -->
                                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                    <div class="media-img me-4 rounded-full">
                                        <img class="rounded-full lazy" src="images/img-loading.png"
                                            data-src="images/small-avatar-3.jpg" alt="User image" />
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                            <h5>Miguel Sanches</h5>
                                            <div class="review-stars">
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                                <span class="la la-star"></span>
                                            </div>
                                        </div>
                                        <span class="d-block lh-18 pb-2">2 month ago</span>
                                        <p class="pb-2">
                                            This is one of the best courses I have taken in Udemy.
                                            It is very complete, and it has made continue learning
                                            about Java and SQL databases as well.
                                        </p>
                                        <div class="helpful-action">
                                            <span class="d-block fs-13">Was this review helpful?</span>
                                            <button class="btn">Yes</button>
                                            <button class="btn">No</button>
                                            <span class="btn-text fs-14 cursor-pointer ps-1" data-bs-toggle="modal"
                                                data-bs-target="#reportModal">Report</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- end media -->
                            </div>
                            <!-- end review-wrap -->
                            <div class="see-more-review-btn text-center">
                                <button type="button" class="btn theme-btn theme-btn-transparent">
                                    Load more reviews
                                </button>
                            </div>
                        </div>
                        {{-- End of Ratings View  --}}

                        <!-- end course-overview-card -->
                    </div>
                    <!-- end course-details-content-wrap -->
                </div>
                <!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar sidebar-negative">
                        <div class="card card-item">
                            <div class="card-body">
                                <div class="preview-course-video">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#previewModal">
                                        <img class="w-100 rounded lazy"
                                            src="{{ asset('template/images/img-loading.png') }}"
                                            data-src="{{ $course->image ? asset('storage/' . $course->image) : asset('storage/' . $this->getDefaultImage($course->category)) }}"
                                            alt="Course image" />
                                    </a>
                                </div>
                                <!-- end preview-course-video -->
                                <div class="preview-course-feature-content pt-40px">
                                    <div class="d-flex justify-content-center align-items-center pb-3">
                                        <span class="fs-35 font-weight-semi-bold text-black">
                                            @if ($course->price == 0)
                                                Free
                                            @else
                                                ₱{{ number_format($course->price, 2) }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="buy-course-btn-box">
                                        @if (Auth::user()->role === 'tutee')
                                            @if (Auth::user()->verified)
                                                @if (!Auth::user()->enrollments->where('course_id', $course->id)->first())
                                                    <!-- Enroll Now Button -->
                                                    <button type="button" class="btn theme-btn w-100 mb-2"
                                                        data-bs-toggle="modal" data-bs-target="#enrollModal">
                                                        <i class="la la-book fs-18 me-1"></i> Enroll Now
                                                    </button>
                                                @elseif (Auth::user()->enrollments->where('course_id', $course->id)->first()->status === 'approved')
                                                    <button type="button" class="btn theme-btn w-100 mb-2 disabled">
                                                        <i class="la la-book fs-18 me-1"></i> You are Enrolled
                                                    </button>
                                                @else
                                                    <button type="button" class="btn theme-btn w-100 mb-2 disabled">
                                                        <i class="la la-book fs-18 me-1"></i> Enrollment in progress...
                                                    </button>
                                                @endif
                                            @elseif (Auth::user()->status === 'pending')
                                                <button type="button" class="btn theme-btn w-100 mb-2 disabled">
                                                    <i class="la la-book fs-18 me-1"></i> Enrollment in progress...
                                                </button>
                                            @else
                                                <form action="javascript:void(0);" onsubmit="showVerificationAlert()"
                                                    class="w-100 mb-2">
                                                    <button type="submit" class="btn theme-btn w-100">
                                                        <i class="la la-book fs-18 me-1"></i> Enroll Now
                                                    </button>
                                                </form>
                                            @endif
                                        @elseif (Auth::user()->role === 'tutor')
                                            @if ($course->user_id === Auth::id())
                                                <button type="button" class="btn theme-btn w-100 mb-2"
                                                    onclick="showTutorAlert('own')">
                                                    <i class="la la-book fs-18 me-1"></i> Enroll Now
                                                </button>
                                            @else
                                                <button type="button" class="btn theme-btn w-100 mb-2"
                                                    onclick="showTutorAlert('other')">
                                                    <i class="la la-book fs-18 me-1"></i> Enroll Now
                                                </button>
                                            @endif
                                        @endif
                                        <div class="buy-course-btn-box save-course-btn">
                                            <button type="button" class="btn theme-btn w-100 mb-2" id="save-course-btn"
                                                data-course-id="{{ $course->id }}">
                                                <i class="la la-heart-o fs-18 me-1"></i> Save
                                            </button>
                                        </div>
                                        <!-- end preview-course-incentives -->
                                    </div>
                                    <!-- end preview-course-content -->
                                </div>
                            </div>
                            <!-- end card -->

                            {{-- Save Courses --}}
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const saveButton = document.getElementById('save-course-btn');
                                    const courseId = saveButton.getAttribute('data-course-id'); // Get the course ID from the data attribute

                                    // Check if the course is already saved in localStorage
                                    if (localStorage.getItem('savedCourse_' + courseId)) {
                                        // If the course is saved, update the button state
                                        saveButton.disabled = true;
                                        saveButton.innerHTML = '<i class="la la-heart"></i> Saved'; // Change button text and icon
                                    }

                                    // Event listener for the save button
                                    saveButton.addEventListener('click', function() {
                                        // Send AJAX request to save the course
                                        fetch('/save-course', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                                },
                                                body: JSON.stringify({
                                                    course_id: courseId
                                                })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success',
                                                        text: data.message,
                                                        timer: 1500,
                                                        showConfirmButton: false
                                                    });

                                                    // Store the saved course in localStorage
                                                    localStorage.setItem('savedCourse_' + courseId, true);

                                                    // Update the button to reflect the saved state
                                                    saveButton.disabled = true;
                                                    saveButton.innerHTML =
                                                        '<i class="la la-heart"></i> Saved'; // Change icon and text
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error',
                                                        text: data.message,
                                                        timer: 1500,
                                                        showConfirmButton: false
                                                    });
                                                }
                                            })
                                            .catch(error => {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error',
                                                    text: 'Something went wrong. Please try again later.',
                                                    timer: 1500,
                                                    showConfirmButton: false
                                                });
                                            });
                                    });
                                });
                            </script>
                            {{-- Tutor Enroll Now SweetAlert --}}

                            <script>
                                function showTutorAlert(type) {
                                    if (type === 'own') {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Enrollment Not Allowed',
                                            text: 'You cannot enroll in your uploaded course. Please use a tutee account.',
                                        });
                                    } else if (type === 'other') {
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Action Restricted',
                                            text: 'Please create and use a tutee account to enroll.',
                                        });
                                    }
                                }

                                function showVerificationAlert() {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Verification Required',
                                        text: 'Please complete your account verification to enroll in courses.',
                                    });
                                }
                            </script>

                            {{-- End of Tutor Sweetalert --}}

                            @if (session('success'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: '{{ session('success') }}',
                                    });
                                </script>
                            @endif

                            @if (session('error'))
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: '{{ session('error') }}',
                                    });
                                </script>
                            @endif

                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Course Features</h3>
                                <div class="divider"><span></span></div>
                                <ul class="generic-list-item generic-list-item-flash">
                                    <li class="d-flex align-items-center justify-content-between">
                                        <span><i class="la la-clock me-2 text-color"></i>Instructor</span>
                                        {{ $course->instructor_name }}
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <span><i class="la la-clock me-2 text-color"></i>Duration</span>
                                        {{ $course->course_time }} Hours
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <span><i class="la la-play-circle-o me-2 text-color"></i>Lectures</span>
                                        {{ $course->class }}
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <span>
                                            <i class="la la-play-circle-o me-1 text-color"></i>
                                            @php
                                                // Decode the JSON string to access the resources
                                                $resources = json_decode($course->resources, true);

                                                // Initialize resource count
                                                $totalResourceTitles = 0;

                                                // Check if resources are available and count each resource_title
                                                if ($resources) {
                                                    foreach ($resources as $lecture) {
                                                        // Count the number of resources for each lecture
                                                        $totalResourceTitles += count($lecture['resources']);
                                                    }
                                                }
                                            @endphp

                                            @if ($totalResourceTitles === 1)
                                                Resource
                                            @else
                                                Resources
                                            @endif
                                        </span>
                                        {{ $totalResourceTitles }}
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <span><i class="la la-language me-2 text-color"></i>Language</span>


                                        {{ ucwords($course->courselanguage) }}


                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <span><i class="la la-users me-1 text-color"></i>
                                            Enrolled
                                            @if ($enrolledCount === 1)
                                                Tutee
                                            @else
                                                Tutees
                                            @endif
                                        </span>
                                        {{ $enrolledCount }}
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <span>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end sidebar -->
                    </div>
                    <!-- end col-lg-4 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
    </section>


    {{-- Modal for Payment --}}
    <!-- Enrollment Modal -->
    <div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('enroll.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="enrollModalLabel">Enrollment Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="send_to" class="form-label">Send to</label>

                            <div class="me-3 mb-2">
                                <!-- Name of Receiver (read-only) -->
                                <input type="text" class="form-control text-center" id="receiver_name"
                                    name="receiver_name" value="Gcash - El John Tanola" readonly
                                    style="background-color: #f0f0f0;">
                            </div>
                            <div class="me-3">
                                <!-- Number of Receiver (read-only) -->
                                <input type="text" class="form-control text-center" id="gcash_number"
                                    name="gcash_number" value="09690940143" readonly style="background-color: #f0f0f0;">
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="sender_number" class="form-label">Your Gcash Number</label>
                            <input type="text" class="form-control" id="sender_number" name="sender_number" required
                                placeholder="Enter your number">
                        </div>
                        <div class="mb-3">
                            <label for="sender_name" class="form-label">Name of Sender</label>
                            <input type="text" class="form-control" id="sender_name" name="sender_name" required
                                placeholder="Enter your complete name">
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required
                                placeholder="Enter the exact amount">
                        </div>
                        <div class="mb-3">
                            <label for="refNo" class="form-label"><strong>Ref. No.</strong></label>
                            <input type="text" class="form-control" id="refNo" name="ref_no" maxlength="13"
                                required placeholder="Enter 13-digit reference number">
                            <!-- Warning message that is initially hidden -->
                            <small id="refNoWarning" style="color: red; display: none;">
                                You have exceeded the 13-digit limit!
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="screenshot" class="form-label">Screenshot Photo</label>
                            <input type="file" class="form-control" id="screenshot" name="screenshot"
                                accept="image/*" required>
                            <small class="text-muted">Upload a screenshot of your payment confirmation.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Enrollment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End of Payment --}}

    {{-- SweetAlert Scripts --}}
    <script>
        function showVerificationAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'Verification Required',
                text: 'You need to complete the verification process before enrolling in this course.',
                showCancelButton: false, // Shows the "Go to Settings" button
                reverseButtons: true, // Reverses the order so that "Go to Settings" is on the left
                showConfirmButton: true, // Hides the "OK" button
                confirmButtonText: 'Go to Settings',
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.confirm) {
                    // Redirect to the appropriate settings page when "Go to Settings" is clicked
                    let userRole = "{{ Auth::user()->role }}"; // Get the role of the logged-in user
                    let redirectUrl = '';

                    // Determine the settings route based on the user's role
                    if (userRole === 'tutee') {
                        redirectUrl = "{{ route('tutee.setting') }}"; // Route for tutee settings
                    } else if (userRole === 'tutor') {
                        redirectUrl = "{{ route('tutor.setting') }}"; // Route for tutor settings
                    }

                    window.location.href = redirectUrl; // Redirect to the appropriate settings page
                }
            });
        }

        function showRejectedAlert() {
            Swal.fire({
                icon: 'error',
                title: 'Action Required',
                text: 'Your previous verification attempt was rejected. Please resubmit your documents.',
                confirmButtonText: 'Resubmit Documents',
            });
        }
    </script>

    <!-- Verification Check -->
    <script>
        document.getElementById('enrollBtn')?.addEventListener('click', function() {
            const courseId = this.getAttribute(
                'data-course-id'); // Get the course id from the button's data attribute
            const userId = {{ Auth::user()->id }}; // Get the current authenticated user's ID (tutee)

            // Disable the button and change the text to show it's in progress
            this.disabled = true;
            this.innerText = 'Enrollment in Progress...';

            // Send a POST request to enroll
            fetch('/enroll', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        course_id: courseId, // Course ID
                        user_id: userId, // Tutee ID
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'in_progress') {
                        Swal.fire({
                            title: 'Enrollment in Progress!',
                            text: data.message,
                            icon: 'info',
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'Okay'
                        });
                        // Re-enable the button and reset the text if there's an error
                        this.disabled = false;
                        this.innerText = 'Enroll Now';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Re-enable the button and reset the text in case of a network error
                    this.disabled = false;
                    this.innerText = 'Enroll Now';
                });
        });
    </script>

    @include('layouts.footer')
@endsection

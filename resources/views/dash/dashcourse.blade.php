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
                        <h6 class="ribbon ribbon-lg me-2 bg-3 text-white">Bestseller</h6>
                        <div class="rating-wrap d-flex flex-wrap align-items-center">
                            <div class="review-stars">
                                <span class="rating-number">{{ $course->rating }}</span>
                                <!-- Add stars based on rating -->
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="la la-star{{ $i <= $course->rating ? '' : '-o' }}"></span>
                                @endfor
                            </div>
                            <span class="rating-total ps-1">(20,230 ratings)</span>
                            <span class="student-total ps-2">540,815 students</span>
                        </div>
                    </div>
                    <!-- end d-flex -->
                    <p class="pt-2 pb-1">
                        Tutor
                        <a href="teacher-detail.html" class="text-color hover-underline">
                            {{ $course->instructor_name }}
                        </a>
                    </p>
                    <div class="d-flex flex-wrap align-items-center">
                        <p class="pe-3 d-flex align-items-center">
                            <svg class="svg-icon-color-gray me-1" width="16px" viewBox="0 0 24 24">
                                <path
                                    d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12zm-10 5h-2v-2h2v2zm0-4h-2V7h2v6z">
                                </path>
                            </svg>
                            {{ $course->created_at->format('F j, Y') }}
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
                                    <span class="curriculum-total__text me-2"><strong
                                            class="text-black font-weight-semi-bold">Total:</strong>
                                        17 lectures</span>
                                    <span class="curriculum-total__hours"><strong
                                            class="text-black font-weight-semi-bold">Total hours:</strong>
                                        02:35:47</span>
                                </div>
                            </div>
                            <div class="curriculum-content">
                                <div id="accordion" class="generic-accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <button
                                                class="btn btn-link collapsed d-flex align-items-center justify-content-between"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne">
                                                <i class="la la-plus"></i>
                                                <i class="la la-minus"></i>
                                                Course introduction
                                                <span class="fs-15 text-gray font-weight-medium">6 lectures</span>
                                            </button>
                                        </div>
                                        <!-- end card-header -->
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                            data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <ul class="generic-list-item">
                                                    <li>
                                                        <a href="#"
                                                            class="d-flex align-items-center justify-content-between text-color"
                                                            data-bs-toggle="modal" data-bs-target="#previewModal">
                                                            <span>
                                                                <i class="la la-play-circle me-1"></i>
                                                                Introductory words
                                                                <span class="ribbon ms-2 fs-13">Preview</span>
                                                            </span>
                                                            <span>02:27</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>
                                                                <i class="la la-play-circle me-1"></i>
                                                                Remaster in Progress
                                                            </span>
                                                            <span>03:09</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>
                                                                <i class="la la-play-circle me-1"></i>
                                                                Video Quality
                                                            </span>
                                                            <span>01:16</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>
                                                                <i class="la la-play-circle me-1"></i>
                                                                Important Tip - Source Code
                                                            </span>
                                                            <span>02:07</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- end card-body -->
                                        </div>
                                        <!-- end collapse -->
                                    </div>
                                    <!-- end card -->
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <button
                                                class="btn btn-link collapsed d-flex align-items-center justify-content-between"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="la la-plus"></i>
                                                <i class="la la-minus"></i>
                                                Software tools setup
                                                <span class="fs-15 text-gray font-weight-medium">6 lectures</span>
                                            </button>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                            data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <ul class="generic-list-item">
                                                    <li>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>
                                                                <i class="la la-play-circle me-1"></i>
                                                                Biggest Tip to Succeed as a Java Programmer
                                                            </span>
                                                            <span>02:27</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>
                                                                <i class="la la-file me-1"></i>
                                                                ** IMPORTANT ** - Configuring IntelliJ IDEA
                                                            </span>
                                                            <span>00:16</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>
                                                                <i class="la la-play-circle me-1"></i>
                                                                Video Quality
                                                            </span>
                                                            <span>01:16</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>
                                                                <i class="la la-play-circle me-1"></i>
                                                                Important Tip - Source Code
                                                            </span>
                                                            <span>02:07</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>
                                                                <i class="la la-code me-1"></i>
                                                                Interface
                                                            </span>
                                                            <span>1 question</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- end card-body -->
                                        </div>
                                    </div>
                                    <!-- end card -->
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <button
                                                class="btn btn-link collapsed d-flex align-items-center justify-content-between"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                <i class="la la-plus"></i>
                                                <i class="la la-minus"></i>
                                                Conclusion
                                                <span class="fs-15 text-gray font-weight-medium">1 lectures</span>
                                            </button>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                            data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <ul class="generic-list-item">
                                                    <li>
                                                        <a href="#"
                                                            class="d-flex align-items-center justify-content-between text-color"
                                                            data-bs-toggle="modal" data-bs-target="#previewModal">
                                                            <span>
                                                                <i class="la la-play-circle me-1"></i>
                                                                Conclusion
                                                                <span class="ribbon ms-2 fs-13">Watch</span>
                                                            </span>
                                                            <span>02:27</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- end card-body -->
                                        </div>
                                        <!-- end collapse -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end generic-accordion -->
                            </div>
                            <!-- end curriculum-content -->
                        </div>
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
                                        {{-- <div class="preview-course-video-content">
                                            <div class="overlay"></div>
                                            <div class="play-button">
                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                    viewBox="-307.4 338.8 91.8 91.8"
                                                    style="
                                                             enable-background: new -307.4 338.8 91.8 91.8;
                                                            "
                                                    xml:space="preserve">
                                                    <style type="text/css">
                                                        .st0 {
                                                            fill: #ffffff;
                                                            border-radius: 100px;
                                                        }

                                                        .st1 {
                                                            fill: #000000;
                                                        }
                                                    </style>
                                                    <g>
                                                        <circle class="st0" cx="-261.5" cy="384.7" r="45.9">
                                                        </circle>
                                                        <path class="st1"
                                                            d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </div>
                                            <p class="fs-15 font-weight-bold text-white pt-3">
                                                Preview this course
                                            </p>
                                        </div> --}}
                                    </a>
                                </div>
                                <!-- end preview-course-video -->
                                <div class="preview-course-feature-content pt-40px">
                                    <p class="d-flex align-items-center pb-2">
                                        <span class="fs-35 font-weight-semi-bold text-black">$76.99</span>
                                        <span class="before-price mx-1">$104.99</span>
                                        <span class="price-discount">24% off</span>
                                    </p>
                                    <p class="preview-price-discount-text pb-35px">
                                        <span class="text-color-3">4 days</span> left at this
                                        price!
                                    </p>
                                    <div class="buy-course-btn-box">
                                        @if (Auth::user()->verified)
                                            @if (!Auth::user()->enrollments->where('course_id', $course->id)->first())
                                                <form action="{{ route('enroll.store') }}" method="POST"
                                                    class="w-100 mb-2">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <button type="submit" class="btn theme-btn w-100">
                                                        <i class="la la-book fs-18 me-1"></i> Enroll Now
                                                    </button>
                                                </form>
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

                                        <div class="buy-course-btn-box">
                                            <button type="button" class="btn theme-btn w-100 mb-2">
                                                <i class="la la-shopping-cart fs-18 me-1"></i> Save
                                            </button>
                                        </div>
                                        <!-- end preview-course-incentives -->
                                    </div>
                                    <!-- end preview-course-content -->
                                </div>
                            </div>
                            <!-- end card -->

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
                                        <span><i class="la la-language me-2 text-color"></i>Ratings</span>
                                        {{ $course->rating }}
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <span><i class="la la-play-circle-o me-2 text-color"></i>Lectures</span>
                                        {{ $course->class }}
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <span><i class="la la-language me-2 text-color"></i>Language</span>


                                        {{ ucwords($course->courselanguage) }}


                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <span><i class="la la-users me-2 text-color"></i>Enrolled Students</span>
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
    </section>

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

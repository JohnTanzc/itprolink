@extends('layouts.main')

@section('content')
    @include('pages.nav')

    <section class="breadcrumb-area py-5 bg-white pattern-bg">
        <div class="container">
            <div class="breadcrumb-content">
                <div class="section-heading">
                    <h2 class="section__title">My Courses</h2>
                </div>
                <!-- end section-heading -->
                <ul class="nav nav-tabs generic-tab pt-30px" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="all-course-tab" data-bs-toggle="tab" href="#all-course" role="tab"
                            aria-controls="all-course" aria-selected="false">
                            All Courses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="collections-tab" data-bs-toggle="tab" href="#enrolled" role="tab"
                            aria-controls="collections" aria-selected="true">
                            Enrolled
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="wishlist-tab" data-bs-toggle="tab" href="#favorite" role="tab"
                            aria-controls="wishlist" aria-selected="false">Saved Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="archived-tab" data-bs-toggle="tab" href="#completed" role="tab"
                            aria-controls="archived" aria-selected="false">
                            Completed
                        </a>
                    </li>
                </ul>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end container -->
    </section>

    {{-- My Course --}}
    <section class="my-courses-area pt-30px pb-90px">
        <div class="container">
            <div class="my-course-content-wrap">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="all-course" role="tabpanel" aria-labelledby="all-course-tab">
                        <!-- test alert -->
                        <div class="my-course-body">

                            <!-- end alert -->
                            <div class="my-course-filter-wrap d-flex align-items-center pt-2">
                                <div class="my-course-filter-item my-course-sort-by-content">
                                    <span class="fs-14 font-weight-semi-bold">Sort by</span>
                                    <div class="select-container select2-full-wrapper w-100 pt-2">
                                        <select class="select-container-select">
                                            <option value="0" selected="">Recently Enrolled</option>
                                            <option value="1">Title: A-to-Z</option>
                                            <option value="2">Title: Z-to-A</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end my-course-filter-item -->
                                <div class="my-course-filter-item my-course-filter-by-content">
                                    <span class="fs-14 font-weight-semi-bold">Filter by</span>
                                    <div class="my-course-filter-by-content-inner d-flex align-items-center pt-2">
                                        <div class="select-container me-1 select2-full-wrapper">
                                            <select class="select-container-select">
                                                <option value="0" selected="">Categories</option>
                                                <option value="1">Enrolled</option>
                                                <option value="2">Saved</option>
                                                <option value="3">Completed</option>
                                            </select>
                                        </div>
                                        <div class="select-container me-1 select2-full-wrapper">
                                            <select class="select-container-select">
                                                <option value="0" selected="">Progress</option>
                                                <option value="1">In Progress</option>
                                                <option value="2">Completed</option>
                                            </select>
                                        </div>
                                        <div class="reset-btn-box">
                                            <button class="btn text-gray" type="button">
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end my-course-filter-item -->
                                <div class="my-course-filter-item my-course-search-content">
                                    <span class="fs-14 font-weight-semi-bold">Search</span>
                                    <form method="post" class="pt-2">
                                        <div class="input-group mb-0">
                                            <input class="form-control form--control form--control-gray ps-3" type="text"
                                                name="search" placeholder="Search courses" />
                                            <div class="input-group-append">
                                                <button class="btn theme-btn shadow-none">
                                                    <i class="la la-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end my-course-filter-item -->
                            </div>
                            <div class="my-course-cards pt-40px">
                                <div class="row">
                                    @foreach ($enrolledCourses as $enrollment)
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item">
                                                <div class="card-image">
                                                    <a href="{{ route('course.detail', ['course' => $enrollment->course->id]) }}"
                                                        class="d-block">
                                                        <img class="card-img-top lazy"
                                                            src="{{ asset('template/images/img-loading.png') }}"
                                                            data-src="{{ $enrollment->course->image
                                                                ? asset('storage/' . $enrollment->course->image)
                                                                : asset('storage/' . $this->getDefaultImage($enrollment->course->category)) }}"
                                                            alt="Course image" />
                                                    </a>
                                                </div>
                                                <!-- end card-image -->
                                                <div class="card-body">
                                                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                                                        {{ $enrollment->course->level }}
                                                    </h6>
                                                    <h5 class="card-title">
                                                        <a
                                                            href="{{ route('course.detail', ['course' => $enrollment->course->id]) }}">
                                                            {{ $enrollment->course->title }}
                                                        </a>
                                                    </h5>
                                                    <p class="card-text">
                                                        <a
                                                            href="teacher-detail.html">{{ $enrollment->course->instructor_name ?? 'Instructor Name Not Found' }}</a>
                                                    </p>
                                                    <div class="rating-wrap d-flex align-items-center py-2">
                                                        <div class="review-stars">
                                                            <span class="rating-number">4.4</span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <span class="rating-total ps-1">(20,230)</span>
                                                    </div>
                                                    <!-- end rating-wrap -->
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="card-price text-black font-weight-bold">
                                                            @if ($enrollment->course->price == 0)
                                                                Free
                                                            @else
                                                                ₱{{ number_format($enrollment->course->price, 2) }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- end card-body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!-- end col-lg-4 -->
                                    @endforeach
                                </div>
                            </div>


                        </div>
                        <!-- end my-course-body -->
                    </div>
                    <div class="tab-pane fade" id="enrolled" role="tabpanel" aria-labelledby="wishlist-tab">
                        <div class="my-course-body">
                            <div
                                class="my-course-info pb-40px d-flex flex-wrap align-items-center justify-content-between">
                                <h3 class="fs-22 font-weight-semi-bold">Enrolled Courses</h3>
                                <form method="post">
                                    <div class="input-group">
                                        <input class="form-control form--control form--control-gray ps-3" type="text"
                                            name="search" placeholder="Search courses" />
                                        <div class="input-group-append">
                                            <button class="btn theme-btn shadow-none">
                                                <i class="la la-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end my-course-info -->
                            <div class="my-course-cards pt-40px">
                                <div class="row">
                                    @forelse ($enrolledCourses as $enrollment)
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item">
                                                <div class="card-image">
                                                    <a href="{{ route('course.detail', ['course' => $enrollment->course->id]) }}"
                                                        class="d-block">
                                                        <img class="card-img-top lazy"
                                                            src="{{ asset('template/images/img-loading.png') }}"
                                                            data-src="{{ $enrollment->course->image
                                                                ? asset('storage/' . $enrollment->course->image)
                                                                : asset('storage/' . $this->getDefaultImage($enrollment->course->category)) }}"
                                                            alt="Course image" />
                                                    </a>
                                                </div>
                                                <!-- end card-image -->
                                                <div class="card-body">
                                                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                                                        {{ $enrollment->course->level }}
                                                    </h6>
                                                    <h5 class="card-title">
                                                        <a
                                                            href="{{ route('course.detail', ['course' => $enrollment->course->id]) }}">
                                                            {{ $enrollment->course->title }}
                                                        </a>
                                                    </h5>
                                                    <p class="card-text">
                                                        <a
                                                            href="teacher-detail.html">{{ $enrollment->course->instructor_name ?? 'Instructor Name Not Found' }}</a>
                                                    </p>
                                                    <div class="rating-wrap d-flex align-items-center py-2">
                                                        <div class="review-stars">
                                                            <span class="rating-number">4.4</span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star"></span>
                                                            <span class="la la-star-o"></span>
                                                        </div>
                                                        <span class="rating-total ps-1">(20,230)</span>
                                                    </div>
                                                    <!-- end rating-wrap -->
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="card-price text-black font-weight-bold">
                                                            @if ($enrollment->course->price == 0)
                                                                Free
                                                            @else
                                                                ₱{{ number_format($enrollment->course->price, 2) }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- end card-body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!-- end col-lg-4 -->
                                    @empty
                                        <p class="text-center">You have no enrolled courses.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end tab-pane -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="wishlist-tab">
                            <div class="my-course-body">
                                <div
                                    class="my-course-info pb-40px d-flex flex-wrap align-items-center justify-content-between">
                                    <h3 class="fs-22 font-weight-semi-bold">Saved Courses</h3>
                                    <form method="post">
                                        <div class="input-group">
                                            <input class="form-control form--control form--control-gray ps-3"
                                                type="text" name="search" placeholder="Search courses" />
                                            <div class="input-group-append">
                                                <button class="btn theme-btn shadow-none">
                                                    <i class="la la-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- Save Course Card --}}
                                <div class="my-course-cards">
                                    <div class="row">
                                        @forelse ($savedCourses as $course)
                                            <div class="col-lg-4 responsive-column-half">
                                                <div class="card card-item">
                                                    <div class="card-image">
                                                        <a href="{{ route('course.detail', $course->id) }}"
                                                            class="d-block">
                                                            <img class="card-img-top lazy"
                                                                src="{{ asset('template/images/img-loading.png') }}"
                                                                data-src="{{ $course->image ? asset('storage/' . $course->image) : asset('storage/' . $this->getDefaultImage($course->category)) }}"
                                                                alt="Course image" />
                                                        </a>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                                                            {{ $course->level ?? 'All Levels' }}</h6>
                                                        <h5 class="card-title">
                                                            <a
                                                                href="{{ route('course.detail', $course->id) }}">{{ $course->title }}</a>
                                                        </h5>
                                                        <p class="card-text"><a
                                                                href="#">{{ $course->instructor_name ?? 'Unknown User' }}</a>
                                                        </p>
                                                        <div class="rating-wrap d-flex align-items-center py-2">
                                                            <div class="review-stars">
                                                                <span
                                                                    class="rating-number">{{ $course->rating ?? 'N/A' }}</span>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <span
                                                                        class="la {{ $i <= ($course->rating ?? 0) ? 'la-star' : 'la-star-o' }}"></span>
                                                                @endfor
                                                            </div>
                                                            <span
                                                                class="rating-total ps-1">({{ $course->reviews_count ?? 0 }})</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="card-price text-black font-weight-bold">
                                                                {{ $course->price ? '$' . number_format($course->price, 2) : 'Free' }}
                                                            </p>
                                                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer remove-saved-course-btn"
                                                                data-saved-course-id="{{ $course->id }}"
                                                                title="Remove">
                                                                <i class="la la-heart"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-center">You have no saved courses.</p>
                                        @endforelse
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center mt-4">
                                            <div class="pagination-wrapper">
                                                {{ $savedCourses->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col-lg-4 -->

                    {{-- End of Card --}}

                    <!-- end tab-pane -->
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="archived-tab">
                        <div class="my-course-body">
                            <div class="my-course-info pb-40px">
                                <h3 class="fs-22 font-weight-semi-bold">Completed Courses</h3>
                            </div>


                            <!-- end my-course-cards -->
                        </div>
                        <!-- end my-course-body -->
                    </div>
                    <!-- end tab-pane -->
                </div>
                <!-- end tab-content -->
            </div>
        </div>
        <!-- end container -->
    </section>


    <!-- end leave-rating -->
    </div>
    <!-- end modal-body -->
    </div>
    <!-- end modal-content -->
    </div>
    <!-- end modal-dialog -->
    </div>
    <!-- end modal -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const removeButtons = document.querySelectorAll('.remove-saved-course-btn');

            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const courseId = this.getAttribute('data-saved-course-id');

                    // Send AJAX request to remove saved course
                    fetch('/remove-saved-course', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
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

                                // Optionally, remove the course card from the DOM
                                button.closest('.col-lg-4').remove();
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
        });
    </script>

    <script>
        $(document).ready(function() {
            // Check if an active tab is saved in localStorage
            var activeTab = localStorage.getItem('activeTab') || 'favorite'; // Default to 'Saved Courses' tab
            $("#" + activeTab + "-tab").addClass('active'); // Activate the correct tab
            $("#" + activeTab).addClass('active show'); // Display the correct tab content

            // Handle tab switch and save the active tab in localStorage
            $('#myTab .nav-link').on('click', function() {
                var tabId = $(this).attr('id').replace('-tab', ''); // Get the tab ID without '-tab'
                localStorage.setItem('activeTab', tabId); // Save active tab to localStorage
            });

            // Handle AJAX pagination click
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault(); // Prevent default pagination behavior

                var page = $(this).attr('href').split('page=')[1]; // Get the page number
                var url = "{{ route('mycourses') }}?page=" + page;

                // Make the AJAX request to fetch the paginated saved courses
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        // Update the saved courses and pagination with the new content
                        $('#favorite .my-course-cards').html(data.savedCourses);
                        $('#favorite .pagination-wrapper').html(data.pagination);

                        // After loading the content, ensure the correct tab is active
                        var activeTab = localStorage.getItem('activeTab') ||
                        'favorite'; // Default to 'Saved Courses'
                        $("#" + activeTab + "-tab").addClass('active');
                        $("#" + activeTab).addClass('active show');
                    }
                });
            });
        });
    </script>
    @include('layouts.footer')
@endsection

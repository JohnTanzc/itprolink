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
                        <a class="nav-link" id="collections-tab" data-bs-toggle="tab" href="#collections" role="tab"
                            aria-controls="collections" aria-selected="true">
                            Enrolled
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="wishlist-tab" data-bs-toggle="tab" href="#wishlist" role="tab"
                            aria-controls="wishlist" aria-selected="false">
                            Favorite
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="archived-tab" data-bs-toggle="tab" href="#archived" role="tab"
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
                                                <option value="1">Favorites</option>
                                                <option value="2">Enrolled</option>
                                                <option value="3">All Categories</option>
                                                <option value="4">Development</option>
                                                <option value="5">Design</option>
                                                <option value="6">Business</option>
                                                <option value="7">Marketing</option>
                                                <option value="8">IT & Software</option>
                                                <option value="9">Finance & Accounting</option>
                                                <option value="10">Personal Development</option>
                                                <option value="11">Office Productivity</option>
                                                <option value="12">Teaching & Academics</option>
                                                <option value="13">Lifestyle</option>
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
                                                    <a href="lesson-details.html" class="d-block">
                                                        <img class="card-img-top lazy"
                                                            src="{{ asset('template/images/img-loading.png') }}"
                                                            data-src="{{ $enrollment->course->image
                                                                ? asset('storage/' . $enrollment->course->image)
                                                                : asset('storage/' . $this->getDefaultImage($enrollment->course->category)) }}"
                                                            alt="Course image" />
                                                    </a>
                                                    <div class="course-badge-labels course--badge-labels">
                                                        <div
                                                            class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
                                                            <div class="dropdown">
                                                                <a class="action-btn bg-white text-gray dropdown-btn"
                                                                    href="#" role="button" id="allCourseMenuLink"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="la la-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                    aria-labelledby="allCourseMenuLink">
                                                                    <div class="section-block my-2"></div>
                                                                    <a href="javascript:void(0)"
                                                                        class="dropdown-item d-flex align-items-center justify-content-between">
                                                                        <span class="swapping-btn w-100"
                                                                            data-text-swap="Unfavorite"
                                                                            data-text-original="Favorite">Favorite</span>
                                                                        <i class="ms-auto la la-star"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0)"
                                                                        class="dropdown-item d-flex align-items-center justify-content-between">
                                                                        <span>In Progress</span>
                                                                        <i class="la la-circle-notch la-spin"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0)"
                                                                        class="dropdown-item d-flex align-items-center justify-content-between">
                                                                        <span>Completed</span>
                                                                        <i class="la la-check"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a href="lesson-details.html">{{ $enrollment->course->title }}</a>
                                                    </h5>
                                                    <p class="card-text lh-22 pt-2">
                                                        <a
                                                            href="teacher-detail.html">{{ $enrollment->course->instructor_name ?? 'Instructor Name Not Found' }}</a>
                                                    </p>
                                                    <div
                                                        class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative">
                                                        <p class="skillbar-title">Completed</p>
                                                        <div class="skillbar-box">
                                                            <div class="skillbar skillbar-skillbar-2">
                                                                <div class="skillbar-bar skillbar--bar-2 bg-1"></div>
                                                            </div>
                                                        </div>
                                                        <div class="skill-bar-percent">OK</div>
                                                    </div>
                                                    <div
                                                        class="rating-wrap d-flex align-items-center justify-content-between pt-3">
                                                        <div class="review-stars">

                                                        </div>
                                                        <button type="button" class="btn theme-btn"
                                                            data-bs-toggle="modal" data-bs-target="#reviewModal">
                                                            Add a Review
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>



                            <!-- end my-collection-item -->
                        </div>
                        <!-- end my-course-body -->
                    </div>
                    <!-- end tab-pane -->
                    <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">

                        <!-- end my-course-body -->
                    </div>
                    <!-- end tab-pane -->
                    <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                        <div class="my-course-body">
                            <div class="my-course-info pb-40px">
                                <h3 class="fs-22 font-weight-semi-bold">My archives</h3>
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


    <!-- Modal structure -->
    <!-- Modal HTML -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Add a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="course-overview-card pt-4">
                    <h3 class="fs-24 font-weight-semi-bold pb-4">Add a Review</h3>
                    <div class="leave-rating-wrap pb-4">
                        <div class="leave-rating leave--rating">
                            <input type="radio" name="rate" id="star5" value="5" />
                            <label for="star5"></label>
                            <input type="radio" name="rate" id="star4" value="4" />
                            <label for="star4"></label>
                            <input type="radio" name="rate" id="star3" value="3" />
                            <label for="star3"></label>
                            <input type="radio" name="rate" id="star2" value="2" />
                            <label for="star2"></label>
                            <input type="radio" name="rate" id="star1" value="1" />
                            <label for="star1"></label>
                        </div>
                        <!-- end leave-rating -->
                    </div>
                    <form method="POST" action="{{route('review.submit')}}" class="row" id="reviewForm">
                        @csrf
                        <div class="input-box col-lg-6">
                            <label class="label-text">Name</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="text" name="name"
                                    placeholder="Your Name" required />
                                <span class="la la-user input-icon"></span>
                            </div>
                        </div>
                        <!-- end input-box -->
                        <div class="input-box col-lg-6">
                            <label class="label-text">Email</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="email" name="email"
                                    placeholder="Email Address" required />
                                <span class="la la-envelope input-icon"></span>
                            </div>
                        </div>
                        <!-- end input-box -->
                        <div class="input-box col-lg-12">
                            <label class="label-text">Message</label>
                            <div class="form-group">
                                <textarea class="form-control form--control ps-3" name="message" placeholder="Write Message" rows="5" required></textarea>
                            </div>
                        </div>
                        <!-- end input-box -->
                        <div class="btn-box col-lg-12">
                            <button class="btn theme-btn" type="submit">
                                Submit Review
                            </button>
                        </div>
                        <!-- end btn-box -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and jQuery -->

<script>
    // Handle form submission
    $('#reviewForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/submit-review',  // Your route for review submission
            data: formData,
            success: function(response) {
                alert('Review submitted successfully!');
                $('#reviewModal').modal('hide'); // Hide the modal after submission
            },
            error: function(response) {
                alert('There was an error submitting your review.');
            }
        });
    });
</script>


    {{-- Modal --}}
    <!-- end leave-rating -->
    </div>
    <!-- end modal-body -->
    </div>
    <!-- end modal-content -->
    </div>
    <!-- end modal-dialog -->
    </div>
    <!-- end modal -->
    @include('layouts.footer')
@endsection

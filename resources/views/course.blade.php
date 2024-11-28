@extends('layouts.main')

@section('content')

    {{-- Header Start --}}
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Available Courses</h2>
                </div>
                <ul
                    class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Courses</li>
                    <li>Course Grid</li>
                </ul>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end container -->
    </section>
    {{-- End of Header --}}

    {{-- Course Start --}}
    <section class="course-area section-padding">
        <div class="container">
            <div class="filter-bar mb-4">
                <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                    <p class="fs-14">
                        We found <span class="text-black">56</span> courses available for
                        you
                    </p>
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="select-container select--container me-3">
                            <select class="select-container-select">
                                <option value="all-category">All Category</option>
                                <option value="newest">Newest courses</option>
                                <option value="oldest">Oldest courses</option>
                                <option value="high-rated">Highest rated</option>
                                <option value="popular-courses">Popular courses</option>
                                <option value="high-to-low">Price: high to low</option>
                                <option value="low-to-high">Price: low to high</option>
                            </select>
                        </div>
                        <a class="btn theme-btn theme-btn-sm theme-btn-white lh-28 collapse-btn py-1"
                            data-bs-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false"
                            aria-controls="collapseFilter">
                            Filters <i class="la la-angle-down ms-1 collapse-btn-hide"></i>
                            <i class="la la-angle-up ms-1 collapse-btn-show"></i>
                        </a>
                    </div>
                </div>
                <!-- end filter-bar-inner -->
                <div class="pt-4 collapse" id="collapseFilter">
                    <div class="row">
                        <!-- end col-lg-3 -->
                        <div class="col-lg-3">
                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">Course Type</h3>
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="catCheckbox" required />
                                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox">
                                        Business<span class="ms-1 text-gray">(12,300)</span>
                                    </label>
                                </div>
                                <!-- end custom-control -->
                                <div class="collapse" id="collapseMore">
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="checkbox" class="custom-control-input" id="catCheckbox5" required />
                                        <label class="custom-control-label custom--control-label text-black"
                                            for="catCheckbox5">
                                            Graphic Design<span class="ms-1 text-gray">(12,300)</span>
                                        </label>
                                    </div>
                                    <!-- end custom-control -->
                                </div>
                                <!-- end collapse -->
                                <a class="collapse-btn collapse--btn fs-15" data-bs-toggle="collapse" href="#collapseMore"
                                    role="button" aria-expanded="false" aria-controls="collapseMore">
                                    <span class="collapse-btn-hide">Show more<i
                                            class="la la-angle-down ms-1 fs-14"></i></span>
                                    <span class="collapse-btn-show">Show less<i
                                            class="la la-angle-up ms-1 fs-14"></i></span>
                                </a>
                            </div>
                            <!-- end widget-panel -->
                        </div>
                        <!-- end col-lg-3 -->

                        {{-- Video Area --}}

                        <!-- end col-lg-3 -->
                        <div class="col-lg-3">
                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">Level</h3>
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="levelCheckbox" required />
                                    <label class="custom-control-label custom--control-label text-black"
                                        for="levelCheckbox">
                                        All Levels<span class="ms-1 text-gray">(20,300)</span>
                                    </label>
                                </div>
                                <!-- end custom-control -->
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="levelCheckbox2" required />
                                    <label class="custom-control-label custom--control-label text-black"
                                        for="levelCheckbox2">
                                        Beginner<span class="ms-1 text-gray">(5,300)</span>
                                    </label>
                                </div>
                                <!-- end custom-control -->
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="levelCheckbox3" required />
                                    <label class="custom-control-label custom--control-label text-black"
                                        for="levelCheckbox3">
                                        Intermediate<span class="ms-1 text-gray">(3,300)</span>
                                    </label>
                                </div>
                                <!-- end custom-control -->
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="levelCheckbox4" required />
                                    <label class="custom-control-label custom--control-label text-black"
                                        for="levelCheckbox4">
                                        Expert<span class="ms-1 text-gray">(1,300)</span>
                                    </label>
                                </div>
                                <!-- end custom-control -->
                            </div>
                            <!-- end widget-panel -->
                        </div>
                        <!-- end col-lg-3 -->

                        <!-- end col-lg-3 -->
                        <div class="col-lg-3">
                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">Instructors</h3>
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="instructorCheckbox"
                                        required />
                                    <label class="custom-control-label custom--control-label text-black"
                                        for="instructorCheckbox">
                                        All Instructor
                                    </label>
                                </div>


                                <!-- end custom-control -->
                                <div class="collapse" id="collapseMoreThree">
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="checkbox" class="custom-control-input" id="instructorCheckbox"
                                            required />
                                        <label class="custom-control-label custom--control-label text-black"
                                            for="instructorCheckbox5">
                                            Nahla Jones
                                        </label>
                                    </div>
                                    <!-- end custom-control -->
                                </div>
                                <!-- end collapse -->
                                <a class="collapse-btn collapse--btn fs-15" data-bs-toggle="collapse"
                                    href="#collapseMoreThree" role="button" aria-expanded="false"
                                    aria-controls="collapseMoreThree">
                                    <span class="collapse-btn-hide">Show more<i
                                            class="la la-angle-down ms-1 fs-14"></i></span>
                                    <span class="collapse-btn-show">Show less<i
                                            class="la la-angle-up ms-1 fs-14"></i></span>
                                </a>
                            </div>
                            <!-- end widget-panel -->
                        </div>
                        <!-- end col-lg-3 -->

                        <!-- end col-lg-3 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end collapse -->
            </div>
            <!-- end filter-bar -->
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item card-preview"
                            data-tooltip-content="#tooltip_content_{{ $course->id }}">
                            <div class="card-image">
                                <a href="{{ route('course.detail', $course->id) }}" class="d-block">
                                    <!-- Image Source -->
                                    <img class="card-img-top lazy" src="{{ asset('template/images/img-loading.png') }}"
                                        data-src="{{ $course->image ? asset('storage/' . $course->image) : asset('storage/' . $this->getDefaultImage($course->category)) }}"
                                        alt="Course image" />
                                </a>
                                <div class="course-badge-labels">
                                    <div class="course-badge">Bestseller</div>
                                </div>
                            </div>
                            <!-- end card-image -->
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{$course->level}}</h6>
                                <h5 class="card-title">
                                    <a href="{{ route('course.detail', $course->id) }}">{{ $course->title }}</a>
                                </h5>
                                <p class="card-text">
                                    <a href="teacher-detail.html">{{ $course->instructor_name }}</a>
                                </p>
                                <div class="rating-wrap d-flex align-items-center py-2">
                                    <div class="review-stars">
                                        <span class="rating-number">{{ $course->rating }}</span>
                                        <!-- Add stars based on rating -->
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="la la-star{{ $i <= $course->rating ? '' : '-o' }}"></span>
                                        @endfor
                                    </div>
                                    <span class="rating-total ps-1">({{ $course->reviews_count }})</span>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col-lg-4 -->
                @endforeach
            </div>

            {{-- <!-- Pagination links -->
            {{ $courses->links() }}
            <!-- end row --> --}}

            <div class="d-flex justify-content-center mt-4">
                {{ $courses->links() }}
            </div>

            <!-- end row -->

        </div>
        <!-- end container -->
    </section>
    {{-- End of Course --}}
    @include('layouts.footer')
@endsection

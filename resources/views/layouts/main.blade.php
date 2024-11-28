<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="author" content="ITProLink">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>ITProLink</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200;300;400;500;600;700&amp;display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('template/images/favicon.png') }}">

    <!-- inject:css -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/emojionearea.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/css/tooltipster.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/jquery-te-1.4.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdn.tiny.cloud/1/l5num6gjn56iw78en3nuw0kie4ol1afq31ocsjfy04yziuw5/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}

    <link rel="preload" href="/template/fonts/la-brands-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="/template/fonts/la-regular-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="/template/fonts/la-solid-900.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    @stack('styles')
</head>

<body>

    <!-- start cssload-loader -->
    @if (!in_array(Route::currentRouteName(), ['tutor.setting', 'tutee.setting', 'admin.setting']))
        <!-- Check if route is not one of these -->
        <div class="preloader">
            <div class="loader">
                <svg class="spinner" viewBox="0 0 50 50">
                    <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5">
                    </circle>
                </svg>
            </div>
        </div>
    @endif
    <!-- end cssload-loader -->




    @yield('modals')
    @yield('content')
    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->
    {{-- ToolTip --}}
    @foreach ($courses as $course)
        <div class="tooltip_templates">
            <div id="tooltip_content_{{ $course->id }}">
                <div class="card card-item">
                    <div class="card-body">
                        <p class="card-text pb-2">
                            By <a
                                href="{{ route('tutor.profile', $course->user_id) }}">{{ $course->instructor_name ? $course->instructor_name : 'Unknown Instructor' }}</a>
                        </p>
                        <h5 class="card-title pb-1">
                            <a href="{{ route('course.detail', $course->id) }}">{{ $course->title }}</a>
                        </h5>
                        <div class="d-flex align-items-center pb-1">
                            <h6 class="ribbon fs-14 me-2">Bestseller</h6>
                            <p class="text-success fs-14 font-weight-medium">
                                Uploaded <span
                                    class="font-weight-bold ps-1">{{ $course->created_at->format('F Y') }}</span>
                            </p>
                        </div>
                        <ul
                            class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                            <li>{{ $course->course_time }} total hours</li>
                            <li>{{ $course->level }}</li>
                        </ul>
                        <p class="card-text pt-1 fs-14 lh-22 py-3">
                            {{ $course->description }}
                        </p>
                        <ol class="generic-list-item fs-14 py-3">
                            {!! $course->requirement !!}
                        </ol>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('course.detail', $course->id) }}" class="btn theme-btn flex-grow-1 me-3">
                                <i class="la la-book me-1 fs-18"></i> View Course</a>
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                                <i class="la la-heart-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tooltip_templates').each(function() {
                var tooltipId = $(this).find('.card').attr('data-tooltip-content');
                $(this).find('.card').tooltip({
                    content: $(tooltipId).html()
                });
            });
        });
    </script>

    <!-- end tooltip_templates -->
    <script src="{{ asset('template/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('template/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/js/select2.min.js') }}"></script>
    <script src="{{ asset('template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/js/isotope.js') }}"></script>
    <script src="{{ asset('template/js/waypoint.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('template/js/fancybox.js') }}"></script>
    <script src="{{ asset('template/js/progress-bar.js') }}"></script>
    <script src="{{ asset('template/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('template/js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('template/js/tooltipster.bundle.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.lazy.min.js') }}"></script>
    <script src="{{ asset('template/js/main.js') }}"></script>
    <script src="{{ asset('template/js/animated.skills.js') }}"></script>
    <script src="{{ asset('template/js/jquery.MultiFile.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery-te-1.4.0.min.js') }}"></script>

    <!-- Include SweetAlert (if not already included) -->


    @stack('scripts')


</body>

<script>
    // No need to force redirect to '/' when user presses "Back" button
    // The browser will automatically handle this behavior.
    if (performance.navigation.type === 2) {
        // Let the browser handle the previous page navigation naturally
        // No code needed here unless you want to add special behavior
    }
</script>

</html>

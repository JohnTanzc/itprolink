<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="author" content="ITProLink">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!-- Bootstrap CSS (place in <head>) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preload" href="/template/fonts/la-brands-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="/template/fonts/la-solid-900.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="/template/fonts/la-regular-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/tooltipster.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    @stack('styles')
</head>

<body>
    <section class="dashboard-area">

    </section>
    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>
    <!-- end cssload-loader -->

    @yield('content')
    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>
       <!-- end scroll top -->
    <div class="tooltip_templates">
        <div id="tooltip_content_1">
            <div class="card card-item">
                <div class="card-body">
                    <p class="card-text pb-2">
                        By <a href="teacher-detail.html">Jose Portilla</a>
                    </p>
                    <h5 class="card-title pb-1">
                        <a href="course-details.html">The Business Intelligence Analyst Course 2021</a>
                    </h5>
                    <div class="d-flex align-items-center pb-1">
                        <h6 class="ribbon fs-14 me-2">Bestseller</h6>
                        <p class="text-success fs-14 font-weight-medium">
                            Updated<span class="font-weight-bold ps-1">November 2020</span>
                        </p>
                    </div>
                    <ul
                        class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                        <li>23 total hours</li>
                        <li>All Levels</li>
                    </ul>
                    <p class="card-text pt-1 fs-14 lh-22">
                        The skills you need to become a BI Analyst - Statistics, Database
                        theory, SQL, Tableau – Everything is included
                    </p>
                    <ul class="generic-list-item fs-14 py-3">
                        <li>
                            <i class="la la-check me-1 text-black"></i> Become an expert in
                            Statistics, SQL, Tableau, and problem solving
                        </li>
                        <li>
                            <i class="la la-check me-1 text-black"></i> Boost your resume
                            with in-demand skills
                        </li>
                        <li>
                            <i class="la la-check me-1 text-black"></i> Gather, organize,
                            analyze and visualize data
                        </li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="#" class="btn theme-btn flex-grow-1 me-3"><i
                                class="la la-shopping-cart me-1 fs-18"></i> Add to Cart</a>
                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                            <i class="la la-heart-o"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end tooltip_templates -->
    <script src="{{ asset('template/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('template/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/js/select2.min.js') }}"></script>
    <script src="{{ asset('template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/js/isotope.js') }}"></script>
    <script src="{{ asset('template/js/waypoint.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('template/js/fancybox.js') }}"></script>
    <script src="{{ asset('template/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('template/js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('template/js/tooltipster.bundle.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.lazy.min.js') }}"></script>
    <script src="{{ asset('template/js/main.js') }}"></script>
    @stack('scripts')

</body>

</html>

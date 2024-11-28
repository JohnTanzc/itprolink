@extends('layouts.main')

@section('content')
    @include('pages.nav')
    {{-- Start of breadcrumb --}}
    <section class="breadcrumb-area section-padding img-bg-3">
        <div class="overlay z-index-n1"></div>
        <div class="container">
            <div class="breadcrumb-content">
                <div class="section-heading">
                    <h5 class="ribbon ribbon-lg ribbon-white mb-2">Welcome to ITProLink</h5>
                    <h2 class="section__title fs-45 lh-60 text-white">
                        Improve Your Lives <br />
                        With Learning
                    </h2>
                </div>
                <div class="breadcrumb-btn-box pt-40px ps-3">
                    <a href="#" class="btn-text text-white video-play-btn d-inline-flex align-items-center"
                        data-fancybox data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk">
                        <span class="icon-element icon-element-md pulse-btn me-3"><i class="la la-play"></i></span>Watch the
                        Video
                    </a>
                </div>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end container -->
    </section>
    <!-- end breadcrumb-area -->
    {{-- END OF BREADCRUMB --}}

    {{-- START OF ABOUT --}}
    <section class="about-area section--padding overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-content pb-5">
                        <div class="section-heading">
                            <h2 class="section__title pb-3 lh-50">
                                The leading global marketplace for learning and instruction
                            </h2>
                            <p class="section__desc">
                                Nemo enim ipsam,voluptatem quia voluptas sit aspernatur aut
                                odit aut fugit, sed quia,consequuntur magni dolores eos qui
                                ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                                qui dolorem ipsum quia dolor sit amet, adipisci velit, sed
                                quia non numquam eius modi tempora
                            </p>
                        </div>
                        <!-- end section-heading -->
                        <ul class="generic-list-item pt-3">
                            <li>
                                <i class="la la-check-circle me-2 text-success"></i>Online
                                Courses with full discount systems.
                            </li>
                            <li>
                                <i class="la la-check-circle me-2 text-success"></i>Online
                                Certificates which can be used worldwide.
                            </li>
                            <li>
                                <i class="la la-check-circle me-2 text-success"></i>An online
                                leadership development program at ITProLink.
                            </li>
                        </ul>
                    </div>
                    <!-- end about-content -->
                </div>
                <!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="generic-img-box generic-img-box-layout-2">
                        <div class="img__item img__item-1">
                            <img class="lazy" src="{{ asset('template/images/img-loading.png') }}"
                                data-src="{{ asset('template/images/img15.jpg') }}" alt="About image" />
                            <div class="generic-img-box-content">
                                <h3 class="fs-24 font-weight-semi-bold pb-1">55K</h3>
                                <span>Instructors</span>
                            </div>
                        </div>
                        <div class="img__item img__item-2">
                            <img class="lazy" src="{{ asset('template/images/img-loading.png') }}"
                                data-src="{{ asset('template/images/img16.jpg') }}" alt="About image" />
                            <div class="generic-img-box-content">
                                <h3 class="fs-24 font-weight-semi-bold pb-1">6,900+</h3>
                                <span>Courses</span>
                            </div>
                        </div>
                        <div class="img__item img__item-3">
                            <img class="lazy" src="{{ asset('template/images/img-loading.png') }}"
                                data-src="{{ asset('template/images/img17.jpg') }}" alt="About image" />
                            <div class="generic-img-box-content">
                                <h3 class="fs-24 font-weight-semi-bold pb-1">40M</h3>
                                <span>Learners</span>
                            </div>
                        </div>
                    </div>
                    <!-- end generic-img-box -->
                </div>
                <!-- end col-lg-6 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end about-area -->
    {{-- END OF ABOUT --}}

    {{-- START OF GETSTART --}}
    <section class="get-started-area pt-30px pb-120px position-relative">
        <span class="ring-shape ring-shape-1"></span>
        <span class="ring-shape ring-shape-2"></span>
        <span class="ring-shape ring-shape-3"></span>
        <span class="ring-shape ring-shape-4"></span>
        <span class="ring-shape ring-shape-5"></span>
        <span class="ring-shape ring-shape-6"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 responsive-column-half">
                    <div class="card card-item hover-s text-center">
                        <div class="card-body">
                            <img src="{{ asset('template/images/img-loading.png') }}"
                                data-src="{{ asset('template/images/small-img-2.jpg') }}" alt="card image"
                                class="img-fluid lazy rounded-full" />
                            <h5 class="card-title pt-4 pb-2">Personalized learning</h5>
                            <p class="card-text">
                                Students practice at their own pace, first filling in gaps in
                                their understanding and then accelerating their learning.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="card card-item hover-s text-center">
                        <div class="card-body">
                            <img src="{{ asset('template/images/img-loading.png') }}"
                                data-src="{{ asset('template/images/small-img-3.jpg') }}" alt="card image"
                                class="img-fluid lazy rounded-full" />
                            <h5 class="card-title pt-4 pb-2">Trusted content</h5>
                            <p class="card-text">
                                Created by experts, Coursector library of trusted practice and
                                lessons covers math, science, and more.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="card card-item hover-s text-center">
                        <div class="card-body">
                            <img src="{{ asset('template/images/img-loading.png') }}"
                                data-src="{{ asset('template/images/small-img-4.jpg') }}" alt="card image"
                                class="img-fluid lazy rounded-full" />
                            <h5 class="card-title pt-4 pb-2">Empower teachers</h5>
                            <p class="card-text">
                                With Coursector, teachers can identify gaps in their students’
                                understanding, tailor instruction
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-lg-4 -->
            </div>
            <!-- end row -->
            <p class="text-center">
                Want to join with us? See our<a href="careers.html" class="text-color hover-underline">
                    open positions</a>
            </p>
        </div>
        <!-- end container -->
    </section>
    {{-- END OF GETSTART --}}

    {{-- START OUR MISSION --}}
    <section class="our-mission-area section--padding bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row pb-5">
                        <div class="col-lg-6 responsive-column-half">
                            <div class="img-box">
                                <img src="{{ asset('template/images/img-loading.png') }}"
                                    data-src="{{ asset('template/images/img8.jpg') }}" alt="our mission image"
                                    class="img-fluid lazy rounded-rounded" />
                            </div>
                        </div>
                        <!-- end col-lg-6 -->
                        <div class="col-lg-6 responsive-column-half">
                            <div class="img-box my-3">
                                <img src="{{ asset('template/images/img-loading.png') }}"
                                    data-src="{{ asset('template/images/img10.jpg') }}" alt="our mission image"
                                    class="img-fluid lazy rounded-rounded" />
                            </div>
                        </div>
                        <!-- end col-lg-6 -->
                        <div class="col-lg-6 responsive-column-half">
                            <div class="img-box">
                                <img src="{{ asset('template/images/img-loading.png') }}"
                                    data-src="{{ asset('template/images/img11.jpg') }}" alt="our mission image"
                                    class="img-fluid lazy rounded-rounded" />
                            </div>
                        </div>
                        <!-- end col-lg-6 -->
                        <div class="col-lg-6 responsive-column-half">
                            <div class="img-box my-3">
                                <img src="{{ asset('template/images/img-loading.png') }}"
                                    data-src="{{ asset('template/images/img12.jpg') }}" alt="our mission image"
                                    class="img-fluid lazy rounded-rounded" />
                            </div>
                        </div>
                        <!-- end col-lg-6 -->
                    </div>
                </div>
                <!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="about-content ps-4">
                        <div class="section-heading">
                            <h2 class="section__title pb-3 lh-50">Our Mission</h2>
                            <p class="section__desc pb-3">
                                We’re not one of those companies. We are rethinking education
                                from the bottom up. The web has rethought nearly everything -
                                commerce, social networking, healthcare, and more. We are
                                building the education the world needs - the first truly net
                                native education. We take more cues from modern tech
                                innovators in creating an engaging educational experience than
                                we do from the classroom.
                            </p>
                            <p class="section__desc text-black">
                                Education is broken. Come help us build the education the
                                world deserves.
                            </p>
                        </div>
                        <!-- end section-heading -->
                    </div>
                    <!-- end about-content -->
                </div>
                <!-- end col-lg-6 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    {{-- END OF MISSION --}}

    <div class="section-block"></div>

    {{-- START OF TEAM --}}
    <section class="team-member-area section--padding">
        <div class="container">
            <div class="team-member-heading-content text-center">
                <div class="section-heading">
                    <h2 class="section__title lh-50">Meet Our Leaderships</h2>
                </div>
                <!-- end section-heading -->
            </div>
            <!-- end team-member-heading-content -->
            <div class="row pt-60px justify-content-center">
                <div class="col-lg-3 responsive-column-half">
                    <div class="card card-item member-card text-center">
                        <div class="card-image">
                            <img class="card-img-top" src="{{ asset('template/images/small-avatar-1.jpg') }}"
                                alt="team member" />
                        </div>
                        <div class="card-body ">
                            <h5 class="card-title"><a href="#">Alex Smith</a></h5>
                            <p class="card-text">Founder And CEO</p>
                            <ul class="social-icons social-icons-styled social--icons-styled pt-4">
                                <li>
                                    <a href="#"><i class="la la-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="la la-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="la la-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-lg-3 -->
                <div class="col-lg-3 responsive-column-half">
                    <div class="card card-item member-card text-center">
                        <div class="card-image">
                            <img class="card-img-top" src="{{ asset('template/images/small-avatar-2.jpg') }}"
                                alt="team member" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Rose Taylor</a></h5>
                            <p class="card-text">President And Co-CEO</p>
                            <ul class="social-icons social-icons-styled social--icons-styled pt-4">
                                <li>
                                    <a href="#"><i class="la la-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="la la-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="la la-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-lg-3 -->
                <div class="col-lg-3 responsive-column-half">
                    <div class="card card-item member-card text-center">
                        <div class="card-image">
                            <img class="card-img-top" src="{{ asset('template/images/small-avatar-3.jpg') }}"
                                alt="team member" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">Jef Collin</a></h5>
                            <p class="card-text">Chief Technology Officer</p>
                            <ul class="social-icons social-icons-styled social--icons-styled pt-4">
                                <li>
                                    <a href="#"><i class="la la-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="la la-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="la la-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- end card -->
                </div>

                <!-- end row -->
            </div>
            <!-- end container -->
    </section>
    {{-- END OF TEAM --}}

    <div class="section-block"></div>

    {{-- Great Area --}}
    <section class="about-area bg-gray section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-content pb-5">
                        <div class="section-heading">
                            <h2 class="section__title pb-3 lh-50">A great place to grow</h2>
                            <p class="section__desc pb-3">
                                Nemo enim ipsam,voluptatem quia voluptas sit aspernatur aut
                                odit aut fugit, sed quia,consequuntur magni dolores eos qui
                                ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                                qui dolorem ipsum quia dolor sit amet, adipisci velit, sed
                                quia non numquam eius modi tempora
                            </p>
                            <p class="section__desc">
                                Neque porro quisquam est, qui dolorem ipsum quia dolor sit
                                amet, adipisci velit, sed quia non numquam eius modi tempora
                            </p>
                        </div>
                        <!-- end section-heading -->
                        <div class="btn-box pt-35px">
                            <a href="#" class="btn theme-btn">Join with our team <i
                                    class="la la-arrow-right icon ms-1"></i></a>
                        </div>
                    </div>
                    <!-- end about-content -->
                </div>
                <!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="generic-img-box generic-img-box-layout-3">
                        <img src="{{ asset('template/images/img-loading.png') }}" data-src="{{ asset('template/images/img13.jpg') }}" alt="About image"
                            class="img__item lazy img__item-1" />
                    </div>
                </div>
                <!-- end col-lg-6 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    {{-- End of Great --}}

    <div class="section-block"></div>

    {{-- Become a Tutor --}}
    <section class="cta-area pt-60px pb-60px position-relative overflow-hidden">
        <span class="stroke-shape stroke-shape-1"></span>
        <span class="stroke-shape stroke-shape-2"></span>
        <span class="stroke-shape stroke-shape-3"></span>
        <span class="stroke-shape stroke-shape-4"></span>
        <span class="stroke-shape stroke-shape-5"></span>
        <span class="stroke-shape stroke-shape-6"></span>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    <div class="cta-content-wrap media py-4 align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <svg class="svg-icon-color-gray" width="85" viewBox="0 -48 496 496"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m472 0h-448c-13.230469 0-24 10.769531-24 24v352c0 13.230469 10.769531 24 24 24h448c13.230469 0 24-10.769531 24-24v-352c0-13.230469-10.769531-24-24-24zm8 376c0 4.414062-3.59375 8-8 8h-448c-4.40625 0-8-3.585938-8-8v-352c0-4.40625 3.59375-8 8-8h448c4.40625 0 8 3.59375 8 8zm0 0">
                                </path>
                                <path d="m448 32h-400v240h400zm-16 224h-368v-208h368zm0 0"></path>
                                <path
                                    d="m328 200.136719c0-17.761719-11.929688-33.578125-29.007812-38.464844l-26.992188-7.703125v-2.128906c9.96875-7.511719 16-19.328125 16-31.832032v-14.335937c0-21.503906-16.007812-39.726563-36.449219-41.503906-11.183593-.96875-22.34375 2.800781-30.574219 10.351562-8.25 7.550781-12.976562 18.304688-12.976562 29.480469v16c0 12.503906 6.03125 24.328125 16 31.832031v2.128907l-26.992188 7.710937c-17.078124 4.886719-29.007812 20.703125-29.007812 38.464844v39.863281h160zm-16 23.863281h-128v-23.863281c0-10.664063 7.160156-20.152344 17.40625-23.082031l38.59375-11.023438v-23.070312l-3.976562-2.3125c-7.527344-4.382813-12.023438-12.105469-12.023438-20.648438v-16c0-6.703125 2.839844-13.160156 7.792969-17.695312 5.007812-4.601563 11.496093-6.832032 18.382812-6.207032 12.230469 1.0625 21.824219 12.285156 21.824219 25.566406v14.335938c0 8.542969-4.496094 16.265625-12.023438 20.648438l-3.976562 2.3125v23.070312l38.59375 11.023438c10.246094 2.9375 17.40625 12.425781 17.40625 23.082031zm0 0">
                                </path>
                                <path
                                    d="m32 364.945312 73.886719-36.945312-73.886719-36.945312zm16-48 22.113281 11.054688-22.113281 11.054688zm0 0">
                                </path>
                                <path d="m152 288h16v80h-16zm0 0"></path>
                                <path d="m120 288h16v80h-16zm0 0"></path>
                                <path d="m336 288h-48v32h-104v16h104v32h48v-32h128v-16h-128zm-16 64h-16v-48h16zm0 0"></path>
                            </svg>
                        </div>
                        <div class="media-body">
                            <h2 class="fs-28 font-weight-bold mb-1">
                                Teach the world online
                            </h2>
                            <p class="fs-17">
                                Create an online video course, reach students across the
                                globe, and earn money
                            </p>
                        </div>
                    </div>
                    <!-- end media -->
                </div>
                <!-- end col-lg-9 -->
                <div class="col-lg-3">
                    <div class="cta-btn-box text-end">
                        <a href="become-a-teacher.html" class="btn theme-btn">Tech on ITProLink <i
                                class="la la-arrow-right icon ms-1"></i></a>
                    </div>
                </div>
                <!-- end col-lg-3 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    {{-- End of Tutor --}}
    @include('layouts.footer')
@endsection

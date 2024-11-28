@extends('layouts.main')

@section('content')
    @include('pages.nav')

    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                        <div class="section-heading">
                            <h2 class="section__title text-white">
                                Frequently asked questions
                            </h2>
                        </div>
                        <ul
                            class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li>Pages</li>
                            <li>Faq</li>
                        </ul>
                    </div>
                    <!-- end breadcrumb-content -->
                </div>
                <!-- end col-lg-12 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>


    <section class="faq-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div id="accordion" class="generic-accordion generic-accordion-layout-2">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    <i class="la la-plus"></i>
                                    <i class="la la-minus"></i>
                                    Getting Started
                                </button>
                            </div>
                            <!-- end card-header -->
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordion">
                                <div class="card-body">
                                    <p class="card-text">
                                        Learn how to begin your personalized IT learning journey with IT ProLink.
                                    </p>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end collapse -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="la la-plus"></i>
                                    <i class="la la-minus"></i>
                                    Account/Profile
                                </button>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                <div class="card-body">
                                    <p class="card-text">
                                        Manage your profile, update account information, and personalize your experience.
                                    </p>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="la la-plus"></i>
                                    <i class="la la-minus"></i>
                                    Courses
                                </button>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordion">
                                <div class="card-body">
                                    <p class="card-text">
                                        Find everything you need to know about scheduling,
                                        joining, and completing sessions with IT tutors.
                                    </p>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end collapse -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <i class="la la-plus"></i>
                                    <i class="la la-minus"></i>
                                    Troubleshooting
                                </button>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordion">
                                <div class="card-body">
                                    <p class="card-text">
                                        Facing a technical issue? We’re here to help resolve bugs or errors on the platform.
                                    </p>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end collapse -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-header" id="headingFive">
                                <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <i class="la la-plus"></i>
                                    <i class="la la-minus"></i>
                                    Mobile App
                                </button>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordion">
                                <div class="card-body">
                                    <p class="card-text">
                                        Learn about our mobile app, including features and how to stay connected on the go.
                                    </p>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end collapse -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-header" id="headingSix">
                                <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <i class="la la-plus"></i>
                                    <i class="la la-minus"></i>
                                    Payments and Refunds
                                </button>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordion">
                                <div class="card-body">
                                    <p class="card-text">
                                        Find information about pricing, payment methods, and requesting refunds.
                                    </p>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end collapse -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end generic-accordion -->
                    <div class="load-more-btn-box pt-5 text-center">
                        <button type="button" class="btn theme-btn">
                            <i class="la la-refresh me-1"></i> load more
                        </button>
                    </div>
                </div>
                <!-- end col-lg-7-->
                <div class="col-lg-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="fs-24 font-weight-semi-bold pb-2">
                                Still have question?
                            </h3>
                            <div class="divider"><span></span></div>
                            <form method="post">
                                <div class="input-box">
                                    <label class="label-text">Your Name</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="name"
                                            placeholder="Your name" />
                                        <span class="la la-user input-icon"></span>
                                    </div>
                                </div>
                                <!-- end input-box -->
                                <div class="input-box">
                                    <label class="label-text">Your email</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="email" name="email"
                                            placeholder="Your email" />
                                        <span class="la la-envelope input-icon"></span>
                                    </div>
                                </div>
                                <!-- end input-box -->
                                <div class="input-box">
                                    <label class="label-text">Subject</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="text"
                                            placeholder="Reason for contact" />
                                        <span class="la la-book input-icon"></span>
                                    </div>
                                </div>
                                <!-- end input-box -->
                                <div class="input-box">
                                    <label class="label-text">Message</label>
                                    <div class="form-group">
                                        <textarea class="form-control form--control ps-4" name="message" rows="6" placeholder="Write message"></textarea>
                                    </div>
                                </div>
                                <!-- end input-box -->
                                <div class="btn-box pt-2">
                                    <button class="btn theme-btn" type="submit">
                                        Send Message <i class="la la-arrow-right icon ms-1"></i>
                                    </button>
                                </div>
                                <!-- end btn-box -->
                            </form>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-lg-5 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>

    @include('layouts.footer')
@endsection

@extends('layouts.main')

@section('content')
    @include('pages.nav')

    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">ITProLink - Privacy Policy</h2>
                </div>
                <ul
                    class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end container -->
    </section>

    <section class="privacy-policy-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Search Field</h3>
                                <div class="divider"><span></span></div>
                                <form method="post">
                                    <div class="form-group">
                                        <input class="form-control form--control ps-3" type="text" name="search"
                                            placeholder="Type your search term..." />
                                        <p class="fs-13">
                                            Press the enter or click search now button
                                        </p>
                                    </div>
                                    <button type="submit" class="btn theme-btn w-100">
                                        <i class="la la-search me-2"></i>Search Now
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- end card -->

                        <!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Meta</h3>
                                <div class="divider"><span></span></div>
                                <ul class="generic-list-item">
                                    <li><a href="{{route('user.register')}}">Register</a></li>
                                    <li><a href="{{route('user.login')}}">Log in</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end sidebar -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-8">
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">
                                1. Information We Collect and How We Use It
                            </h2>
                            <div class="divider"><span></span></div>
                            <h3 class="fs-16 font-weight-semi-bold pb-1">
                                A. Account Information:
                            </h3>
                            <p class="pb-3">
                                When users (both tutors and learners) create an account on ITProLink,
                                we collect basic information such as names, email addresses, and profile details.
                                This information is used to verify identities, manage accounts, and provide a secure
                                and personalized experience.
                            </p>
                            <h3 class="fs-16 font-weight-semi-bold pb-1">
                                B. Public Content:
                            </h3>
                            <p class="pb-3">
                                Any public content shared on ITProLink, such as profiles, reviews,
                                or testimonials, can be visible to other users on the platform. This helps foster
                                transparency and build trust among tutors and learners.
                            </p>
                            <h3 class="fs-16 font-weight-semi-bold pb-1">C. Contacts:</h3>
                            <p class="pb-3">
                                ITProLink may request access to contact information to help users invite others
                                to join the platform or communicate with matched tutors and learners.
                                This information is used solely for connection purposes and is never shared without consent.
                            </p>
                            <h3 class="fs-16 font-weight-semi-bold pb-1">
                                D. Communications:
                            </h3>
                            <p>
                                We collect communication data, such as messages exchanged between tutors and learners
                                through the platform. This ensures smooth communication and helps maintain the quality
                                and safety of the interactions.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">2. Contact forms</h2>
                            <div class="divider"><span></span></div>
                            <h3 class="fs-16 font-weight-semi-bold pb-1">A. Cookies</h3>
                            <p class="pb-3">
                                ITProLink uses cookies to enhance user experience by remembering
                                preferences and login sessions. These cookies also help us analyze platform usage
                                to improve our services.
                            </p>
                            <h3 class="fs-16 font-weight-semi-bold pb-1">
                                B. Embedded content from other websites
                            </h3>
                            <p>
                                Content on ITProLink may include embedded resources, such as videos or articles,
                                to provide learners with additional educational materials. These external resources
                                may collect data, and users are encouraged to review their respective privacy policies.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">
                                3. How we protect your information
                            </h2>
                            <div class="divider"><span></span></div>
                            <p class="pb-3">
                                We prioritize the security of user data by adopting advanced data collection,
                                storage, and processing measures. User information, including usernames, passwords,
                                payment details, and session data, is stored securely.
                            </p>
                            <p>
                                Sensitive information is transmitted over an SSL-secured communication channel,
                                encrypted, and safeguarded with digital signatures. ITProLink also complies with
                                industry security standards to ensure a safe environment for all users.
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">
                                4. Your contact information
                            </h2>
                            <div class="divider"><span></span></div>
                            <p>
                                Users can request an export of their personal data stored on ITProLink,
                                including details provided during account creation or interaction with the platform.
                                Users can also request data deletion, except for information we must retain for legal,
                                security, or administrative purposes.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-lg-8 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>

    @include('layouts.footer')
@endsection

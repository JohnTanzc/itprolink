@extends('layouts.main')

@section('content')
    @include('pages.nav')

    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Terms & Conditions</h2>
                </div>
                <ul
                    class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Terms & Conditions</li>
                </ul>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end container -->
    </section>

    <section class="terms-and-conditions-area section--padding">
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
                                    <li><a href="sign-up.html">Register</a></li>
                                    <li><a href="login.html">Log in</a></li>
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
                                1. Welcome to IT ProLink
                            </h2>
                            <div class="divider"><span></span></div>
                            <p class="pb-3 text-black">
                                These terms and conditions outline the rules and regulations for using IT ProLink,
                                a digital platform for personalized IT education.
                            </p>
                            <p>
                                By accessing IT ProLink, you agree to comply with these terms and conditions.
                                Violation of these terms may result in restricted access to the platform.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">2. Cookies</h2>
                            <div class="divider"><span></span></div>
                            <p>
                                IT ProLink uses cookies to enhance the user experience by remembering preferences,
                                maintaining sessions, and analyzing site usage. By using IT ProLink, you consent to
                                the use of cookies in accordance with our Privacy Policy.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">3. Licence</h2>
                            <div class="divider"><span></span></div>
                            <p class="pb-3">
                                Unless stated otherwise, IT ProLink owns the intellectual property rights for
                                all content and materials on the platform.
                            </p>
                            <p class="pb-1 text-black">You must not:</p>
                            <ul class="text-black">
                                <li>Republish material from IT ProLink without permission. </li>
                                <li>
                                    Sell, rent, or sub-license platform content.
                                </li>
                                <li>
                                    Reproduce, duplicate, or copy material from IT ProLink.
                                </li>
                            </ul>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">4. User Comments</h2>
                            <div class="divider"><span></span></div>
                            <p class="pb-3">
                                Users are encouraged to leave comments, reviews, or testimonials regarding
                                their experience on the platform.
                            </p>
                            <p>
                                However, IT ProLink reserves the right to moderate,
                                edit, or remove any comments deemed inappropriate, offensive, or in violation of our terms.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">
                                5. Hyperlinking to our Content
                            </h2>
                            <div class="divider"><span></span></div>
                            <p class="pb-3">
                                Organizations may link to IT ProLink’s homepage or public pages as long as the link:
</p>
                            <p>
                                <li>Is not misleading.</li>
                                <li>Does not falsely imply sponsorship or endorsement.</li>
                                <li>Fits within the context of the linking site. IT ProLink may, at its discretion,
                                    request the removal of specific links to its website.</li>
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">6. Iframe</h2>
                            <div class="divider"><span></span></div>
                            <p>
                                Without prior approval and written permission, you may not create frames
                                around IT ProLink pages that alter the platform’s presentation or appearance.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">7. Reservation of Rights</h2>
                            <div class="divider"><span></span></div>
                            <p>
                                IT ProLink reserves the right to amend these terms and conditions at any time.
                                By continuing to use the platform, you agree to follow the updated terms.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">
                                8. Removal of links from our website
                            </h2>
                            <div class="divider"><span></span></div>
                            <p class="pb-3">
                                If you find any link on our platform or linked websites objectionable,
                                you can contact us to request removal. While we aim to address valid concerns,
                                we are not obligated to respond or act on such requests.
                            </p>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">9. Content Liability</h2>
                            <div class="divider"><span></span></div>
                            <p>
                                IT ProLink is not responsible for any content appearing on third-party
                                websites linked to or from our platform. You agree to indemnify IT ProLink
                                against any claims arising from such content.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">10. Disclaimer</h2>
                            <div class="divider"><span></span></div>
                            <p>
                                IT ProLink does not guarantee the accuracy, completeness, or availability
                                of the platform’s content and services. We are not liable for any interruptions
                                or errors and reserve the right to modify, suspend, or terminate the platform at any time.
                            </p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h2 class="card-title fs-18 pb-2">
                                11. Credit &amp; Contact Information
                            </h2>
                            <div class="divider"><span></span></div>
                            <p>
                                This Terms and Conditions page was customized for IT ProLink.
                                If you have any questions or concerns about these terms, please contact us
                                through our support channels.
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

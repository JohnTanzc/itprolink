@extends('layouts.main')
@section('content')
    {{-- Header --}}
    @include('pages.nav')

    <section class="breadcrumb-area py-5 bg-white pattern-bg">
        <div class="container">
            <div class="breadcrumb-content">
                <div class="media media-card align-items-center pb-4">
                    <div class="media-img media--img media-img-md rounded-full">
                        <img class="rounded-full"
                            src="{{ asset('storage/profile_pictures/' . ($tutor->profile_picture ?? 'default-image.png')) }}"
                            alt="Student thumbnail image"
                            style="width: 92px;
                            height: {{ $tutor->profile_picture ? '92px' : 'auto' }};
                            object-fit: {{ $tutor->profile_picture ? 'cover' : 'contain' }};
                            border-radius: 50%;" />
                    </div>
                    <div class="media-body">
                        <h2 class="section__title fs-30">{{ $tutor->fname }} {{ $tutor->lname }}</h2>
                        <span class="d-block lh-18 pt-1 pb-2">Joined {{ $tutor->created_at->format('F Y') }}</span>
                        <p class="lh-18">{{ ucwords($user->designation) }}</p>
                    </div>
                </div>
                <!-- end media -->
                <ul class="social-icons social-icons-styled social--icons-styled">
                    <li>
                        <a href="#"><i class="la la-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="la la-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="la la-instagram"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="la la-linkedin"></i></a>
                    </li>

                </ul>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end container -->
    </section>

    {{-- DETAILS --}}


    <section class="teacher-details-area pt-50px">
        <div class="container">
            <div class="student-details-wrap pb-20px">
                <div class="row">
                    <div class="col-lg-4 responsive-column-half">
                        <div class="counter-item">
                            <div class="counter__icon icon-element mb-3 shadow-sm">
                                <svg class="svg-icon-color-1" width="40" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 490.667 490.667"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <path
                                                d="M245.333,85.333c-41.173,0-74.667,33.493-74.667,74.667s33.493,74.667,74.667,74.667S320,201.173,320,160
                                                                                                                                      C320,118.827,286.507,85.333,245.333,85.333z M245.333,213.333C215.936,213.333,192,189.397,192,160
                                                                                                                                      c0-29.397,23.936-53.333,53.333-53.333s53.333,23.936,53.333,53.333S274.731,213.333,245.333,213.333z">
                                            </path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M394.667,170.667c-29.397,0-53.333,23.936-53.333,53.333s23.936,53.333,53.333,53.333S448,253.397,448,224
                                                                                                                                      S424.064,170.667,394.667,170.667z M394.667,256c-17.643,0-32-14.357-32-32c0-17.643,14.357-32,32-32s32,14.357,32,32
                                                                                                                                      C426.667,241.643,412.309,256,394.667,256z">
                                            </path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M97.515,170.667c-29.419,0-53.333,23.936-53.333,53.333s23.936,53.333,53.333,53.333s53.333-23.936,53.333-53.333
                                                                                                                                      S126.933,170.667,97.515,170.667z M97.515,256c-17.643,0-32-14.357-32-32c0-17.643,14.357-32,32-32c17.643,0,32,14.357,32,32
                                                                                                                                      C129.515,241.643,115.157,256,97.515,256z">
                                            </path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M245.333,256c-76.459,0-138.667,62.208-138.667,138.667c0,5.888,4.779,10.667,10.667,10.667S128,400.555,128,394.667
                                                                                                                                      c0-64.704,52.629-117.333,117.333-117.333s117.333,52.629,117.333,117.333c0,5.888,4.779,10.667,10.667,10.667
                                                                                                                                      c5.888,0,10.667-4.779,10.667-10.667C384,318.208,321.792,256,245.333,256z">
                                            </path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M394.667,298.667c-17.557,0-34.752,4.8-49.728,13.867c-5.013,3.072-6.635,9.621-3.584,14.656
                                                                                                                                      c3.093,5.035,9.621,6.635,14.656,3.584C367.637,323.712,380.992,320,394.667,320c41.173,0,74.667,33.493,74.667,74.667
                                                                                                                                      c0,5.888,4.779,10.667,10.667,10.667c5.888,0,10.667-4.779,10.667-10.667C490.667,341.739,447.595,298.667,394.667,298.667z">
                                            </path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M145.707,312.512c-14.955-9.045-32.149-13.845-49.707-13.845c-52.928,0-96,43.072-96,96
                                                                                                                                      c0,5.888,4.779,10.667,10.667,10.667s10.667-4.779,10.667-10.667C21.333,353.493,54.827,320,96,320
                                                                                                                                      c13.675,0,27.029,3.712,38.635,10.752c5.013,3.051,11.584,1.451,14.656-3.584C152.363,322.133,150.741,315.584,145.707,312.512z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h4 class="counter__title counter text-color-2 fs-35">
                                {{ number_format($enrollments) }}
                            </h4>
                            <p class="counter__meta">Total Tutees</p>
                        </div>
                        <!-- end counter-item -->
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-4 responsive-column-half">
                        <div class="counter-item">
                            <div class="counter__icon icon-element mb-3 shadow-sm">
                                <svg class="svg-icon-color-2" width="40" version="1.1" id="Layer_1"
                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <path
                                                d="M472.208,201.712c9.271-9.037,12.544-22.3,8.544-34.613c-4.001-12.313-14.445-21.118-27.257-22.979l-112.03-16.279
                                                                                                                                          c-2.199-0.319-4.1-1.7-5.084-3.694L286.28,22.632c-5.729-11.61-17.331-18.822-30.278-18.822c-12.947,0-24.549,7.212-30.278,18.822
                                                                                                                                          l-50.101,101.516c-0.985,1.993-2.885,3.374-5.085,3.694L58.51,144.12c-12.812,1.861-23.255,10.666-27.257,22.979
                                                                                                                                          c-4.002,12.313-0.728,25.576,8.544,34.613l81.065,79.019c1.591,1.552,2.318,3.787,1.942,5.978l-19.137,111.576
                                                                                                                                          c-2.188,12.761,2.958,25.414,13.432,33.024c10.474,7.612,24.102,8.595,35.56,2.572l100.201-52.679
                                                                                                                                          c1.968-1.035,4.317-1.035,6.286,0l100.202,52.679c4.984,2.62,10.377,3.915,15.744,3.914c6.97,0,13.896-2.184,19.813-6.487
                                                                                                                                          c10.474-7.611,15.621-20.265,13.432-33.024l-19.137-111.576c-0.375-2.191,0.351-4.426,1.942-5.978L472.208,201.712z
                                                                                                                                           M362.579,291.276l19.137,111.578c0.64,3.734-1.665,5.863-2.686,6.604c-1.022,0.74-3.76,2.277-7.112,0.513l-100.202-52.679
                                                                                                                                          c-4.919-2.585-10.315-3.879-15.712-3.879c-5.397,0-10.794,1.294-15.712,3.878l-100.201,52.678
                                                                                                                                          c-3.354,1.763-6.091,0.228-7.112-0.513c-1.021-0.741-3.327-2.87-2.686-6.604l19.137-111.576
                                                                                                                                          c1.879-10.955-1.75-22.127-9.711-29.886l-81.065-79.019c-2.713-2.646-2.099-5.723-1.708-6.923
                                                                                                                                          c0.389-1.201,1.702-4.052,5.451-4.596l112.027-16.279c10.999-1.598,20.504-8.502,25.424-18.471l50.101-101.516
                                                                                                                                          c1.677-3.397,4.793-3.764,6.056-3.764c1.261,0,4.377,0.366,6.055,3.764v0.001l50.101,101.516
                                                                                                                                          c4.919,9.969,14.423,16.873,25.422,18.471l112.029,16.279c3.749,0.544,5.061,3.395,5.451,4.596
                                                                                                                                          c0.39,1.201,1.005,4.279-1.709,6.923l-81.065,79.019C364.329,269.149,360.7,280.321,362.579,291.276z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M413.783,22.625c-6.036-4.384-14.481-3.046-18.865,2.988l-14.337,19.732c-4.384,6.034-3.047,14.481,2.988,18.865
                                                                                                                                          c2.399,1.741,5.176,2.58,7.928,2.58c4.177,0,8.295-1.931,10.937-5.567l14.337-19.732
                                                                                                                                          C421.155,35.456,419.818,27.009,413.783,22.625z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M131.36,45.265l-14.337-19.732c-4.383-6.032-12.829-7.37-18.865-2.988c-6.034,4.384-7.372,12.831-2.988,18.865
                                                                                                                                          l14.337,19.732c2.643,3.639,6.761,5.569,10.939,5.569c2.753,0,5.531-0.839,7.927-2.581C134.407,59.747,135.745,51.3,131.36,45.265
                                                                                                                                          z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M49.552,306.829c-2.305-7.093-9.924-10.976-17.019-8.671l-23.197,7.538c-7.095,2.305-10.976,9.926-8.671,17.019
                                                                                                                                          c1.854,5.709,7.149,9.337,12.842,9.337c1.383,0,2.79-0.215,4.177-0.666l23.197-7.538
                                                                                                                                          C47.975,321.543,51.857,313.924,49.552,306.829z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M256.005,456.786c-7.459,0-13.506,6.047-13.506,13.506v24.392c0,7.459,6.047,13.506,13.506,13.506
                                                                                                                                          c7.459,0,13.506-6.047,13.506-13.506v-24.392C269.511,462.832,263.465,456.786,256.005,456.786z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M502.664,305.715l-23.197-7.538c-7.092-2.303-14.714,1.577-17.019,8.672c-2.305,7.095,1.576,14.714,8.671,17.019
                                                                                                                                          l23.197,7.538c1.387,0.45,2.793,0.664,4.176,0.664c5.694,0,10.989-3.629,12.843-9.337
                                                                                                                                          C513.64,315.639,509.758,308.02,502.664,305.715z" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h4 class="counter__title counter text-color-3 fs-35">
                                515,351
                            </h4>
                            <p class="counter__meta">Reviews</p>
                        </div>
                        <!-- end counter-item -->
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-4 responsive-column-half">
                        <div class="counter-item">
                            <div class="counter__icon icon-element mb-3 shadow-sm">
                                <svg class="svg-icon-color-3" width="40" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <path
                                                    d="M405.333,42.667h-44.632c-4.418-12.389-16.147-21.333-30.035-21.333h-32.229C288.417,8.042,272.667,0,256,0
                                                                                                                                              s-32.417,8.042-42.438,21.333h-32.229c-13.888,0-25.617,8.944-30.035,21.333h-44.631C83.146,42.667,64,61.802,64,85.333v384
                                                                                                                                              C64,492.865,83.146,512,106.667,512h298.667C428.854,512,448,492.865,448,469.333v-384C448,61.802,428.854,42.667,405.333,42.667
                                                                                                                                              z M170.667,53.333c0-5.885,4.792-10.667,10.667-10.667h37.917c3.792,0,7.313-2.021,9.208-5.302
                                                                                                                                              c5.854-10.042,16.146-16.031,27.542-16.031s21.688,5.99,27.542,16.031c1.896,3.281,5.417,5.302,9.208,5.302h37.917
                                                                                                                                              c5.875,0,10.667,4.781,10.667,10.667V64c0,11.76-9.563,21.333-21.333,21.333H192c-11.771,0-21.333-9.573-21.333-21.333V53.333z
                                                                                                                                               M426.667,469.333c0,11.76-9.563,21.333-21.333,21.333H106.667c-11.771,0-21.333-9.573-21.333-21.333v-384
                                                                                                                                              c0-11.76,9.563-21.333,21.333-21.333h42.667c0,23.531,19.146,42.667,42.667,42.667h128c23.521,0,42.667-19.135,42.667-42.667
                                                                                                                                              h42.667c11.771,0,21.333,9.573,21.333,21.333V469.333z" />
                                                <path
                                                    d="M160,170.667c-17.646,0-32,14.354-32,32c0,17.646,14.354,32,32,32s32-14.354,32-32
                                                                                                                                              C192,185.021,177.646,170.667,160,170.667z M160,213.333c-5.875,0-10.667-4.781-10.667-10.667
                                                                                                                                              c0-5.885,4.792-10.667,10.667-10.667s10.667,4.781,10.667,10.667C170.667,208.552,165.875,213.333,160,213.333z" />
                                                <path
                                                    d="M160,277.333c-17.646,0-32,14.354-32,32c0,17.646,14.354,32,32,32s32-14.354,32-32
                                                                                                                                              C192,291.688,177.646,277.333,160,277.333z M160,320c-5.875,0-10.667-4.781-10.667-10.667c0-5.885,4.792-10.667,10.667-10.667
                                                                                                                                              s10.667,4.781,10.667,10.667C170.667,315.219,165.875,320,160,320z" />
                                                <path
                                                    d="M160,384c-17.646,0-32,14.354-32,32c0,17.646,14.354,32,32,32s32-14.354,32-32C192,398.354,177.646,384,160,384z
                                                                                                                                               M160,426.667c-5.875,0-10.667-4.781-10.667-10.667c0-5.885,4.792-10.667,10.667-10.667s10.667,4.781,10.667,10.667
                                                                                                                                              C170.667,421.885,165.875,426.667,160,426.667z" />
                                                <path
                                                    d="M373.333,192h-128c-5.896,0-10.667,4.771-10.667,10.667c0,5.896,4.771,10.667,10.667,10.667h128
                                                                                                                                              c5.896,0,10.667-4.771,10.667-10.667C384,196.771,379.229,192,373.333,192z" />
                                                <path
                                                    d="M373.333,298.667h-128c-5.896,0-10.667,4.771-10.667,10.667c0,5.896,4.771,10.667,10.667,10.667h128
                                                                                                                                              c5.896,0,10.667-4.771,10.667-10.667C384,303.438,379.229,298.667,373.333,298.667z" />
                                                <path
                                                    d="M373.333,405.333h-128c-5.896,0-10.667,4.771-10.667,10.667c0,5.896,4.771,10.667,10.667,10.667h128
                                                                                                                                              c5.896,0,10.667-4.771,10.667-10.667C384,410.104,379.229,405.333,373.333,405.333z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h4 class="counter__title counter text-color-4 fs-35">{{ $totalCourses }}</h4>
                            <p class="counter__meta">Courses</p>
                        </div>
                        <!-- end counter-item -->
                    </div>
                    <!-- end col-lg-4 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end team-single-wrap -->
        </div>
        <!-- end container -->
        <div class="bg-gray py-5">
            <div class="container">
                <ul class="nav nav-tabs generic-tab justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="about-me-tab" data-bs-toggle="tab" href="#about-me" role="tab"
                            aria-controls="about-me" aria-selected="false">
                            About Me
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="experience-tab" data-bs-toggle="tab" href="#experience" role="tab"
                            aria-controls="experience" aria-selected="false">
                            Other Information
                        </a>
                    </li>
                </ul>
                <div class="tab-content pt-40px" id="myTabContent">
                    <div class="tab-pane fade show active" id="about-me" role="tabpanel" aria-labelledby="about-me-tab">
                        <div class="card card-item">
                            <div class="card-body">
                                <!-- Truncated content -->
                                @php
                                    // Split the about_me content into sentences by dots
                                    $sentences = preg_split('/(?<=\.)\s/', $aboutMe ?? 'No information provided.'); // Split by periods (.) followed by spaces

                                    // First 5 sentences to be shown initially
                                    $firstPart = array_slice($sentences, 0, 5);

                                    // Remaining sentences will be hidden initially
                                    $remainingPart = array_slice($sentences, 5);
                                @endphp

                                <!-- Display the first 5 sentences -->
                                <p class="card-text pb-3" style="text-align: justify;" >
                                    {!! nl2br(e(implode(' ', $firstPart))) !!}
                                </p>

                                <!-- Hidden content (remaining sentences) -->
                                <div class="collapse" id="collapseMoreTwo">
                                    <p class="card-text pb-3" style="text-align: justify;">
                                        {!! nl2br(e(implode(' ', $remainingPart))) !!}
                                    </p>
                                </div>

                                <!-- Toggle button for "Show more" -->
                                <a class="collapse-btn collapse--btn fs-15" data-bs-toggle="collapse"
                                    href="#collapseMoreTwo" role="button" aria-expanded="false"
                                    aria-controls="collapseMoreTwo">
                                    <span class="collapse-btn-hide">Show more<i
                                            class="la la-angle-down ms-1 fs-14"></i></span>
                                    <span class="collapse-btn-show">Show less<i
                                            class="la la-angle-up ms-1 fs-14"></i></span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end tab-pane -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade " id="experience" role="tabpanel" aria-labelledby="experience-tab">
                        <div class="card card-item">
                            <div class="card-body">
                                <div class="row pt-5 mt-30">
                                    <div class="col-lg-4 col-sm-6 mb-30 pb-5">
                                        <a class="card" href="#">
                                            <div class="box-shadow bg-white rounded-circle mx-auto text-center"
                                                style="width: 90px; height: 90px; margin-top: -45px;">
                                                <svg class="mt-3" height="65px" width="65px" version="1.1"
                                                    id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                    xml:space="preserve" fill="#EC5252" stroke="none">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g>
                                                            <path class="st0"
                                                                d="M473.61,63.16L276.16,2.927C269.788,0.986,263.004,0,256.001,0c-7.005,0-13.789,0.986-20.161,2.927 L38.386,63.16c-3.457,1.064-5.689,3.509-5.689,6.25c0,2.74,2.232,5.186,5.691,6.25l91.401,27.88v77.228 c0.023,39.93,13.598,78.284,38.224,107.981c11.834,14.254,25.454,25.574,40.483,33.633c15.941,8.564,32.469,12.904,49.124,12.904 c16.646,0,33.176-4.34,49.126-12.904c22.597-12.143,42.04-31.646,56.226-56.39c14.699-25.683,22.471-55.155,22.478-85.224v-78.214 l45.244-13.804v64.192c-6.2,0.784-11.007,6.095-11.007,12.5c0,5.574,3.649,10.404,8.872,12.011l-9.596,63.315 c-0.235,1.576,0.223,3.168,1.262,4.386c1.042,1.204,2.554,1.902,4.148,1.902h36.273c1.592,0,3.104-0.699,4.148-1.91 c1.036-1.203,1.496-2.803,1.262-4.386l-9.596-63.307c5.223-1.607,8.872-6.436,8.872-12.011c0-6.405-4.81-11.716-11.011-12.5V81.544 l19.292-5.885c3.457-1.064,5.691-3.517,5.691-6.25C479.303,66.677,477.069,64.223,473.61,63.16z M257.62,297.871 c-10.413,0-20.994-2.842-31.448-8.455c-16.194-8.649-30.908-23.564-41.438-42.011c-4.854-8.478-8.796-17.702-11.729-27.445 c60.877-10.776,98.51-49.379,119.739-80.97c10.242,20.776,27.661,46.754,54.227,58.648c-3.121,24.984-13.228,48.812-28.532,67.212 c-8.616,10.404-18.773,18.898-29.375,24.573C278.606,295.029,268.025,297.871,257.62,297.871z">
                                                            </path>
                                                            <path class="st0"
                                                                d="M373.786,314.23l-1.004-0.629l-110.533,97.274L151.714,313.6l-1.004,0.629 c-36.853,23.036-76.02,85.652-76.02,156.326v0.955l0.846,0.45C76.291,472.365,152.428,512,262.249,512 c109.819,0,185.958-39.635,186.712-40.038l0.846-0.45v-0.955C449.808,399.881,410.639,337.265,373.786,314.23z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="card-body text-center">
                                                <h3 class="card-title pt-1">Education</h3>
                                                <p class="card-text text">
                                                    {{ $tutor->edu ?? 'No education information available.' }}</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-30 pb-5">
                                        <a class="card" href="#">
                                            <div class="box-shadow bg-white rounded-circle mx-auto text-center"
                                                style="width: 90px; height: 90px; margin-top: -45px;"><svg class="mt-3"
                                                    style="margin-left: 15px;" fill="#EC5252" width="60px"
                                                    height="60px" viewBox="0 0 846.66 846.66"
                                                    style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision;
                                                image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                    version="1.1" xml:space="preserve"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" stroke="none"
                                                    stroke-width="0.008466600000000001" transform="rotate(0)">
                                                    <g id="Layer_x0020_1">
                                                        <path class="fil0"
                                                            d="M714.45 435.47c-3.43,-61.63 -56.15,-107.41 -116.38,-104.07 -60.94,3.39 -107.46,55.46 -104.07,116.38 3.39,60.9 55.53,107.46 116.38,104.07 60.47,-3.39 107.45,-55.71 104.07,-116.38zm-115.39 -86.84c51.29,-2.86 95.31,36.54 98.16,87.83 2.87,51.37 -36.55,95.31 -87.83,98.16 -51.37,2.86 -95.31,-36.54 -98.17,-87.83 -2.85,-51.29 36.55,-95.31 87.84,-98.16zm2.27 41.3c-28.62,1.59 -50.39,25.99 -48.8,54.59 1.59,28.56 26.09,50.38 54.59,48.8 28.56,-1.59 50.38,-26.08 48.8,-54.59 -1.6,-28.62 -25.99,-50.39 -54.59,-48.8zm-470.74 68.39l259.17 0c11.45,0 20.74,9.29 20.74,20.73l0 199.05c0,11.45 -9.29,20.73 -20.74,20.73l-259.17 0c-11.45,0 -20.73,-9.28 -20.73,-20.73l0 -199.05c0,-11.44 9.28,-20.73 20.73,-20.73zm238.44 41.47l-217.71 0 0 157.58 217.71 0 0 -157.58zm-246.73 -176.24c-27.27,0 -27.27,-41.47 0,-41.47l207.33 0c27.27,0 27.27,41.47 0,41.47l-207.33 0zm0 -68.42c-27.27,0 -27.27,-41.47 0,-41.47l207.33 0c27.27,0 27.27,41.47 0,41.47l-207.33 0zm-71.99 -126.48l546.56 0 0 -52.11 -546.56 0 0 52.11zm546.56 41.47l-546.56 0 0 599.99 546.56 0 0 -176.9c-77.4,-3.71 -139.85,-65.44 -144.18,-143.16 -4.66,-83.61 59.5,-155.3 143.11,-159.96l1.07 -0.05 0 -119.92zm133.17 356.34l100.7 90.07c20.22,18.09 -7.32,48.87 -27.53,30.78l-100.7 -90.07c-18.94,16.15 -41.02,26.94 -64.17,32.27l0 201.34c0,11.45 -9.28,20.73 -20.73,20.73l-588.03 0c-11.45,0 -20.73,-9.28 -20.73,-20.73l0 -735.04c0,-11.45 9.28,-20.73 20.73,-20.73l588.03 0c11.45,0 20.73,9.28 20.73,20.73l0 237.92c65.63,15.11 113.66,71.98 117.41,139.47 1.8,32.26 -6.67,65.12 -25.71,93.26z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="card-body text-center">
                                                <h3 class="card-title pt-1">Career</h3>
                                                <p class="card-text text">
                                                    {{ $tutor->career ?? 'No career information available.' }}</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 mb-30 pb-5">
                                        <a class="card" href="#">
                                            <div class="box-shadow bg-white rounded-circle mx-auto text-center"
                                                style="width: 90px; height: 90px; margin-top: -45px;"><svg class="mt-3"
                                                    fill="#EC5252" height="60px" width="60px" version="1.1"
                                                    id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 508 508"
                                                    xml:space="preserve">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g>
                                                            <g>
                                                                <path
                                                                    d="M379.3,282.425v-59.3l41.9-41.9c5.5-5.5,5.5-14.4,0-19.9l-41.9-41.9v-59.3c0-7.8-6.3-14.1-14.1-14.1h-59.3L264,4.125 c-5.5-5.5-14.4-5.5-19.9,0l-42,41.9h-59.3c-7.8,0-14.1,6.3-14.1,14.1v59.3l-41.9,41.9c-5.5,5.5-5.5,14.4,0,19.9l41.9,41.9v59.3 c0,7.8,6.3,14.1,14.1,14.1h40.1l-77.4,152.7c-4.1,11.1,1.4,22.3,15.1,20.3l41.1-7.4l18.4,37.6c5.6,10.9,20.9,9.7,25.2,0.2 l48.6-95.8l48.6,95.8c5.9,10.8,19.4,10.8,25.2-0.2l18.4-37.6c0,0,42.8,7.6,43.6,7.6c18.4,1.1,15.3-17.1,11.8-22.1l-76.6-151.1H365 C372.9,296.525,379.3,290.225,379.3,282.425z M193.1,461.925l-10.7-21.8c-3.7-6.6-8.2-8.4-15.2-7.7l-23.7,4.3l66.9-131.9 l33.7,33.7c2.5,2.5,6,4,9.6,4.1L193.1,461.925z M364.5,436.725l-23.7-4.3c-6.2-1.1-12.4,2-15.2,7.7l-10.7,21.8l-45.1-89l31.2-61.5 L364.5,436.725z M351.1,217.325v51h-51c-3.7,0-7.3,1.5-10,4.1l-36.1,36l-36.1-36c-2.6-2.6-6.2-4.1-10-4.1h-51v-51 c0-3.7-1.5-7.3-4.1-10l-36.1-36.1l36.1-36.1c2.6-2.6,4.1-6.2,4.1-10v-51h51c3.7,0,7.3-1.5,10-4.1l36.1-36l36.1,36.1 c2.6,2.6,6.2,4.1,10,4.1h51v51c0,3.7,1.5,7.3,4.1,10l36.1,36.1l-36.1,36.1C352.5,210.025,351.1,213.625,351.1,217.325z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <g>
                                                                <path
                                                                    d="M254,94.025c-42.6,0-77.3,34.7-77.3,77.3s34.7,77.3,77.3,77.3c42.6,0,77.3-34.7,77.3-77.3 C331.3,128.725,296.6,94.025,254,94.025z M254,220.425c-27.1,0-49.1-22-49.1-49.1c0-27.1,22-49.1,49.1-49.1 c27.1,0,49.1,22,49.1,49.1C303.1,198.425,281.1,220.425,254,220.425z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg></div>
                                            <div class="card-body text-center">
                                                <h3 class="card-title pt-1">Experience</h3>
                                                <p class="card-text text">
                                                    {{ $tutor->exp ?? 'No experience information available.' }}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                CERTIFICATES
                            </div>
                        </div>
                        <!-- end tab-pane -->
                    </div>
                    <!-- end tab-content -->
                </div>
                <!-- end container -->
            </div>
        </div>

        {{-- Css --}}
        <style>
            a.card {
                text-decoration: none;
            }

            .card {
                position: relative;
                border: 0;
                border-radius: 0;
                background-color: #fff;
                -webkit-box-shadow: 0 12px 20px 1px rgba(64, 64, 64, 0.09);
                box-shadow: 0 12px 20px 1px rgba(64, 64, 64, 0.09);
            }

            .card {
                position: relative;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid rgba(0, 0, 0, 0.125);
                border-radius: .25rem;
            }

            .box-shadow {
                -webkit-box-shadow: 0 12px 20px 1px rgba(64, 64, 64, 0.09) !important;
                box-shadow: 0 12px 20px 1px rgba(64, 64, 64, 0.09) !important;
            }

            .ml-auto,
            .mx-auto {
                margin-left: auto !important;
            }

            .mr-auto,
            .mx-auto {
                margin-right: auto !important;
            }

            .rounded-circle {
                border-radius: 50% !important;
            }

            .bg-white {
                background-color: #fff !important;
            }

            .ml-auto,
            .mx-auto {
                margin-left: auto !important;
            }

            .mr-auto,
            .mx-auto {
                margin-right: auto !important;
            }

            .d-block {
                display: block !important;
            }

            img,
            figure {
                max-width: 100%;
                height: auto;
                vertical-align: middle;
            }

            .card-text {
                padding-top: 12px;
                color: #8c8c8c;
            }

            .text-sm {
                font-size: 12px !important;
            }

            p,
            .p {
                margin: 0 0 16px;
            }

            .card-title {
                margin: 0;
                font-family: "Montserrat", sans-serif;
                font-size: 18px;
                font-weight: 900;
            }

            .pt-1,
            .py-1 {
                padding-top: .25rem !important;
            }

            .head-icon {
                margin-top: 18px;
                color: #FF4500
            }
        </style>
    </section>

    {{-- MY COURSE --}}

    <section class="course-area section-padding">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between pb-3">
                <h3 class="fs-24 font-weight-semi-bold">Other Available Courses</h3>
                <span class="ribbon ribbon-lg">{{ $totalCourses }}</span>
            </div>
            <div class="divider"><span></span></div>
            <div class="row">
                @foreach ($courses as $course)
                    @if (
                        (Auth::user()->role == 'tutor' && $course->user_id == Auth::user()->id) ||
                            Auth::user()->role == 'tutee' ||
                            Auth::user()->role == 'admin')
                        <!-- Check if the course belongs to the logged-in user -->
                        <div class="col-lg-4 responsive-column-half">
                            <div class="card card-item card-preview"
                                data-tooltip-content="#tooltip_content_{{ $course->id }}">
                                <div class="card-image">
                                    <a href="{{ route('course.detail', $course->id) }}" class="d-block">
                                        <!-- Image Source -->
                                        <img class="card-img-top lazy"
                                            src="{{ asset('template/images/img-loading.png') }}"
                                            data-src="{{ $course->image ? asset('storage/' . $course->image) : asset('storage/' . $this->getDefaultImage($course->category)) }}"
                                            alt="Course image" />
                                    </a>
                                    <div class="course-badge-labels">
                                        <div class="course-badge">Bestseller</div>
                                    </div>
                                </div>
                                <!-- end card-image -->
                                <div class="card-body">
                                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
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
                    @endif
                @endforeach
            </div>
            <!-- end container -->
            <div class="d-flex justify-content-center mt-4">
                {{ $courses->links() }}
            </div>
    </section>

    {{-- About Me Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const collapseBtn = document.querySelector('.collapse-btn');
            const collapseHide = collapseBtn.querySelector('.collapse-btn-hide');
            const collapseShow = collapseBtn.querySelector('.collapse-btn-show');

            collapseBtn.addEventListener('click', function() {
                setTimeout(() => {
                    if (collapseBtn.getAttribute('aria-expanded') === 'true') {
                        collapseHide.classList.add('d-none');
                        collapseShow.classList.remove('d-none');
                    } else {
                        collapseHide.classList.remove('d-none');
                        collapseShow.classList.add('d-none');
                    }
                }, 300); // Delay to sync with Bootstrap's collapse animation
            });
        });
    </script>
    @include('layouts.footer')
@endsection

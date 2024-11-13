@extends('layouts.main')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
@section('content')
    <link rel="stylesheet" href="{{ asset('css/userprofile.css') }}">
    @include('pages.nav')
    <!-- ================ start banner Area ================= -->
    <section class="banner-area">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-10 banner-right">
                    <h1 class="text-white">
                        Profile
                    </h1>
                    <p class="mx-auto text-white mt-20 mb-40"></p>
                    <div class="link-nav">
                        <span class="box">
                            <a href="{{ route('index') }}">Home</a>
                            <i class="lnr lnr-arrow-right"></i>
                            <!-- Profile Link with Role Check -->
                            <a href="{{ auth()->user()->role === 'Tutor' ? route('tutor.profile') : route('tutee.profile') }}">
                                Profile
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ End banner Area ================= -->

    <!-- ================ Profile-page Area ================= -->
    <section class="contact-page-area section-gap">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="container">
            <div class="bootstrap-scope">
                <div class="row">
                    <div class="profile-nav col-md-3">
                        <div class="panel">
                            <!-- Profile picture image-->
                            <div class="user-heading round">
                                <a href="#" id="profileImageLink">
                                    <img src="{{ asset('storage/profile_pictures/' . (auth()->user()->profile_picture ?? 'default-avatar.png')) }}"
                                        alt="Profile Picture" id="profileImagePreview">
                                </a>
                                <h1>{{ $user->fname }} {{ $user->lname }}</h1>
                                <p>{{ $user->email }}</p>
                            </div>


                            <!-- Dynamic navigation with active class -->
                            <nav class="side-menu">
                                <ul class="nav horizontal-menu">
                                    <!-- Profile Link with Role Check -->
                                    <li class="{{ request()->routeIs('tutor.profile') || request()->routeIs('tutee.profile') ? 'active' : '' }}">
                                        <a href="{{ auth()->user()->role === 'Tutor' ? route('tutor.profile') : route('tutee.profile') }}">
                                            <i class="fa fa-user"></i> Profile
                                        </a>
                                    </li>

                                    <!-- Edit Profile Link -->
                                    <li class="{{ request()->routeIs('user.edit') ? 'active' : '' }}">
                                        <a href="{{ route('user.edit', ['id' => $user->id]) }}">
                                            <i class="fa fa-edit"></i> Edit Profile
                                        </a>
                                    </li>

                                    <!-- Conditionally Display "Setup Profile" for Tutors Only -->
                                    @if(auth()->user()->role === 'Tutor')
                                        <li class="{{ request()->routeIs('user.setup') ? 'active' : '' }}">
                                            <a href="">
                                                <i class="fa fa-edit"></i> Setup Profile
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Change Password Link -->
                                    <li class="{{ request()->routeIs('user.password') ? 'active' : '' }}">
                                        <a href="">
                                            <i class="fa fa-key"></i> Change Password
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="profile-info col-md-9">
                        <div class="panel">
                            <div class="panel-body bio-graph-info">
                                <h1>Profile</h1>
                                <div class="row">
                                    <div class="bio-row">
                                        <p><span>First Name </span>: {{ $user->fname }}</p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Last Name </span>: {{ $user->lname }}</p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Age </span>: {{ $user->age }}</p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Birthday</span>: {{ $user->birthday }}</p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Occupation </span>: UI Designer</p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Email </span>: {{ $user->email }}</p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Mobile </span>: (12) 03 4567890</p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Phone </span>: {{ $user->phone }}</p>
                                    </div>
                                </div>
                                {{-- New --}}

                                <h1>About Me</h1>
                                <div class="bio">
                                    <p>{{ $user->about_me }}</p>
                                </div>
                                {{-- End --}}

                                {{-- New Credentials --}}
                                <br>
                                <h1>Credentials</h1>
                                <div class="bio">
                                    <p>
                                    {{-- <div class="container">
                                        <!-- Upload Form -->
                                        <form id="uploadForm" enctype="multipart/form-data">
                                            <div id="uploadBox" class="upload-box"
                                                onclick="document.getElementById('fileInput').click();">
                                                <i class="bi bi-plus-lg"></i> <!-- Plus sign icon -->
                                                <span class="upload-text">Click or Drag to Upload</span>
                                            </div>
                                            <input type="file" id="fileInput" name="file"
                                                accept="application/pdf, image/png, image/jpeg" style="display: none;">
                                        </form>

                                        <!-- Credentials Section (Uploaded files will be displayed here) -->
                                        <div id="credentials" class="row mt-4"></div>

                                        <!-- Optional: Feedback Message -->
                                        <div id="uploadFeedback" class="mt-2"></div>
                                    </div> --}}
                                    @include('pages.credentials')
                                    </p>
                                </div>
                                {{-- End --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Profile Image -->
    <div id="imageModal" class="modal" style="display: none;"> <!-- Hidden by default -->
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage" alt="Profile Picture">
    </div>


    @include('layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileImageLink = document.getElementById('profileImageLink');
            const imageModal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const closeModal = document.getElementsByClassName('close')[0];

            // Show the modal when the profile image is clicked
            profileImageLink.onclick = function(event) {
                event.preventDefault(); // Prevent default link behavior
                modalImage.src = document.getElementById('profileImagePreview').src; // Set modal image source
                imageModal.style.display = "flex"; // Show the modal using flex to center
            };

            // Hide the modal when the close button is clicked
            closeModal.onclick = function() {
                imageModal.style.display = "none"; // Hide the modal
            };

            // Hide the modal when clicking anywhere outside of the modal content
            window.onclick = function(event) {
                if (event.target === imageModal) {
                    imageModal.style.display = "none"; // Hide the modal
                }
            };
        });
    </script>
@endsection

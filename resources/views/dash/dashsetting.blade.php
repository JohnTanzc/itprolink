@extends('layouts.main')
@section('content')
    {{-- Header --}}
    @include('dash.dashnav')
    {{-- End of Header --}}

    <div class="dashboard-content-wrap">
        <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ms-3">
            <i class="la la-bars me-1"></i> Dashboard Nav
        </div>
        <div class="container-fluid">
        </div>
        <!-- end breadcrumb-content -->
        {{-- <div class="section-block mb-5"></div> --}}
        <div class="dashboard-heading mb-5" style="margin-left: 20px; margin-right: 20px;">
            <h3 class="fs-22 font-weight-semi-bold">Settings</h3>
        </div>
        <ul class="nav nav-tabs generic-tab pb-30px" id="myTab" role="tablist">
            <li class="nav-item" style="margin-left: 10px; margin-right: 10px;">
                <a class="nav-link active" id="edit-profile-tab" data-bs-toggle="tab" href="#edit-profile" role="tab"
                    aria-controls="edit-profile" aria-selected="false">
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab"
                    aria-controls="password" aria-selected="true">
                    Change Password
                </a>
            </li>
            @if (in_array(Auth::user()->role, ['tutee', 'tutor']))
                <li class="nav-item">
                    <a class="nav-link" id="change-email-tab" data-bs-toggle="tab" href="#change-email" role="tab"
                        aria-controls="change-email" aria-selected="false">
                        Account Verification
                    </a>
                </li>
            @endif
        </ul>
        <div class="section-block mb-5"></div>
        <div class="tab-content" id="myTabContent" style="margin-left: 10px; margin-right: 10px;">
            <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
                <div class="setting-body">
                    <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>
                    <div class="media media-card align-items-center">
                        <div class="media-img media-img-lg me-4 bg-gray">
                            <img class="me-3"
                                src="{{ asset('storage/profile_pictures/' . (auth()->user()->profile_picture ?? 'default-image.png')) }}"
                                alt="Profile Picture" id="profileImagePreview"
                                style="width: 200px; max-height: 200px; border: 3px solid #ccc; border-radius: 10px;">
                        </div>
                        @php
                            $user = auth()->user(); // This ensures you have the authenticated user
                        @endphp

                        <form
                            action="{{ $user->role == 'admin'
                                ? route('admin.update', ['id' => $user->id])
                                : ($user->role == 'tutor'
                                    ? route('tutor.update', ['id' => $user->id])
                                    : route('tutee.update', ['id' => $user->id])) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="media-body">
                                <div class="file-upload-wrap file-upload-wrap-2">
                                    <label for="profile_picture" class="file-upload-text"><i
                                            class="la la-photo me-2"></i>Upload a
                                        Photo</label>
                                    <input type="file" name="profile_picture" class="form-control file-upload-input"
                                        id="profile_picture" accept="image/*" style="display: block;" multiple />
                                    @error('profile_picture')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- file-upload-wrap -->
                                <p class="fs-14 mt-4">
                                    Max file size is 5MB, Minimum dimension: 200x200. Suitable files are .jpg & .png.
                                </p>
                            </div>
                    </div>
                    <!-- end media -->
                    <div class="row pt-40px">
                        <div class="input-box col-lg-6">
                            <label class="label-text">First Name</label>
                            <div class="form-group">
                                <input type="text" class="form-control form--control" name="fname" id="fname"
                                    value="{{ old('fname', $user->fname) }}" required>
                                <span class="la la-user input-icon"></span>
                                @error('fname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- end input-box -->
                        <div class="input-box col-lg-6">
                            <label class="label-text">Last Name</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="text" name="lname"
                                    value="{{ $user->lname }}" />
                                <span class="la la-user input-icon"></span>
                                @error('lname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- end input-box -->

                        <div class="input-box col-lg-6">
                            <label class="label-text">Email Address</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="email" name="email"
                                    value="{{ $user->email }}" />
                                <span class="la la-envelope input-icon"></span>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- end input-box -->
                        <div class="input-box col-lg-6">
                            <label class="label-text">Phone Number</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="tel" name="phone"
                                    value="{{ old('phone', $user->phone ?? '') }}" />
                                <span class="la la-phone input-icon"></span>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- end input-box -->
                        <div class="input-box col-lg-6">
                            <label class="label-text">Age</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="number" name="age"
                                    value="{{ old('age', $user->age ?? '') }}" />
                                <span class="la la-user input-icon"></span>
                                @error('age')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- end input-box -->
                        <div class="input-box col-lg-6">
                            <label class="label-text">Birthday</label>
                            <div class="form-group">
                                <input type="date" class="form-control form--control" name="birthday"
                                    value="{{ old('birthday', isset($user->birthday) && $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}" />
                                <span class="la la-calendar input-icon"></span>
                                @error('birthday')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- end input-box -->
                        <div class="input-box col-lg-6">
                            <label class="label-text">Gender</label>
                            <div class="form-group">
                                <select class="form-control form--control form-select" name="gender">
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male"
                                        {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female"
                                        {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                                <span class="la la-user input-icon"></span>
                                @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- end input-box -->
                        @auth
                            @if (Auth::user()->role === 'tutor')
                                <div class="input-box col-lg-6">
                                    <label class="label-text">Designation</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="designation"
                                            value="{{ $user->designation }}" />
                                        <span class="la la-user input-icon"></span>
                                        @error('designation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        @endauth
                        <!-- end input-box -->
                        <div class="input-box col-lg-12">
                            <label class="label-text">Bio</label>
                            <div class="form-group">
                                <textarea class="form-control form--control ps-2" name="about_me" style="height: 200px !important;">{{ old('about_me', $user->about_me) }}</textarea>
                                @error('about_me')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        @auth
                            @if (Auth::user()->role === 'tutor')
                                <div class="section-block mb-2 mt-2"></div>
                                <div class="input-box col-lg-12 mb-4">
                                    <label class="label-text" style="font-size: 30px; font-weight: bold;">Other Info</label>
                                </div>

                                <div class="input-box col-lg-4">
                                    <label class="label-text" style="font-size: 20px; font-weight: bold;">Education</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control form--control" name="edu"
                                            id="edu" value="{{ old('edu', $user->edu) }}">
                                        <span class="la la-graduation-cap input-icon"></span>
                                        @error('edu')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-box col-lg-4">
                                    <label class="label-text" style="font-size: 20px; font-weight: bold;">Career</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control form--control" name="career"
                                            id="career" value="{{ old('career', $user->career) }}">
                                        <span class="la la-building input-icon"></span>
                                        @error('career')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-box col-lg-4">
                                    <label class="label-text" style="font-size: 20px; font-weight: bold;">Experience</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control form--control" name="exp"
                                            id="exp" value="{{ old('exp', $user->exp) }}">
                                        <span class="la la-suitcase input-icon"></span>
                                        @error('exp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        @endauth
                        <!-- end input-box -->
                        <div class="input-box col-lg-12 py-2">
                            <button type="submit " class="btn theme-btn">Save Changes</button>
                        </div>
                        <!-- end input-box -->
                    </div>
                    </form>
                </div>
                <!-- end setting-body -->
            </div>
            <!-- end tab-pane -->


            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                <div class="setting-body">
                    <h3 class="fs-17 font-weight-semi-bold pb-4">
                        Change Password
                    </h3>
                    <form action="{{ route($user->role . '.password.update', ['id' => $user->id]) }}" method="POST"
                        enctype="multipart/form-data" class="row" onsubmit="return validatePasswordLength();">
                        @csrf
                        @method('PUT')

                        <!-- Old Password -->
                        <div class="input-box col-lg-4">
                            <label class="label-text">Old Password</label>
                            <div class="form-group position-relative">
                                <input class="form-control form--control" type="password" name="old_password"
                                    placeholder="Old Password" id="old_password" required />
                                <span class="la la-lock input-icon"></span>
                                <span class="la la-eye toggle-password position-absolute"
                                    onclick="togglePassword('old_password')"
                                    style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></span>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="input-box col-lg-4">
                            <label class="label-text">New Password</label>
                            <div class="form-group position-relative">
                                <input class="form-control form--control" type="password" name="new_password"
                                    id="new_password" placeholder="New Password" required
                                    oninput="checkPasswordLength();" />
                                <span class="la la-lock input-icon"></span>
                                <span class="la la-eye toggle-password position-absolute"
                                    onclick="togglePassword('new_password')"
                                    style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></span>
                                <small id="password-error" class="text-danger"></small>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="input-box col-lg-4">
                            <label class="label-text">Confirm New Password</label>
                            <div class="form-group position-relative">
                                <input class="form-control form--control" type="password"
                                    name="new_password_confirmation" id="new_password_confirmation"
                                    placeholder="Confirm New Password" required />
                                <span class="la la-lock input-icon"></span>
                                <small id="password-message"></small>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="input-box col-lg-12 py-4">
                            <button class="btn theme-btn">Change Password</button>
                        </div>
                    </form>

                    <script>
                        function checkPasswordLength() {
                            const newPassword = document.getElementById('new_password').value;
                            const passwordError = document.getElementById('password-error');
                            if (newPassword.length < 8) {
                                passwordError.textContent = 'Password must be at least 8 characters.';
                            } else {
                                passwordError.textContent = '';
                            }
                        }

                        function validatePasswordLength() {
                            const newPassword = document.getElementById('new_password').value;
                            if (newPassword.length < 8) {
                                alert('New password must be at least 8 characters.');
                                return false; // Prevent form submission
                            }
                            return true; // Allow form submission
                        }

                        function togglePassword(fieldId) {
                            const field = document.getElementById(fieldId);
                            if (field.type === 'password') {
                                field.type = 'text';
                            } else {
                                field.type = 'password';
                            }
                        }
                    </script>


                    <!-- SweetAlert for Status -->
                    @if (session('status'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session('status') }}',
                                showConfirmButton: false,
                                timer: 10000, // Alert auto-closes after 10 seconds
                            });
                        </script>
                    @endif

                    <!-- SweetAlert for Errors -->
                    @if (session('error'))
                        <script>
                            Swal.fire({
                                title: 'Oops...',
                                text: '{{ session('status') }}',
                                icon: 'error'
                            });
                        </script>
                    @endif

                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session('success') }}',
                                showConfirmButton: false,
                                timer: 10000, // Alert auto-closes after 10 seconds
                            });
                        </script>
                    @endif

                    @if (session('error'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: '{{ session('error') }}',
                                showConfirmButton: false,
                                timer: 10000, // Alert auto-closes after 10 seconds
                            });
                        </script>
                    @endif
                </div>
                <!-- end setting-body -->
            </div>
            <!-- end tab-pane -->


            <!---------{{-- Change Email --}}-------->
            <div class="tab-pane fade" id="change-email" role="tabpanel" aria-labelledby="change-email-tab">
                <div class="setting-body">
                    <h3 class="fs-17 font-weight-semi-bold pb-4">Upload Validation</h3>
                    <form
                        action="{{ route(auth()->user()->role == 'tutee' ? 'tutee.uploadverification' : 'tutor.uploadverification') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="id_photo">Upload Valid ID</label>
                                <input type="file" class="form-control" name="id_photo" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="selfie_with_id">Upload Selfie with ID</label>
                                <input type="file" class="form-control" name="selfie_with_id" required>
                            </div>

                            @if (Auth::user()->role === 'tutor')
                                <div class="form-group col-md-4">
                                    <label for="selfie_with_id">Diploma</label>
                                    <input type="file" class="form-control" name="diploma" required>
                                </div>
                            @endif
                            <div class="input-box col-lg-12 py-4">
                                @if (Auth::user()->verified)
                                    <p class="text-success">You are already verified!</p>
                                @elseif (Auth::user()->verification_status === 'pending')
                                    <button class="btn theme-btn" type="button" disabled>Wait for Admin Approval</button>
                                @elseif (Auth::user()->verification_status === 'not_submitted')
                                    <form
                                        action="{{ route(auth()->user()->role == 'tutor' ? 'tutor.verificationsubmit' : 'tutee.verificationsubmit') }}"
                                        method="POST">
                                        @csrf
                                        <button class="btn theme-btn" type="submit">Submit Verification</button>
                                    </form>
                                @endif
                            </div>
                    </form>
                </div>
            </div>
            <!-- end setting-body -->
        </div>

        <!-- end tab-pane -->


        <!-- end tab-pane -->

        <!-- end tab-pane -->
    </div>


    <script>
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImagePreview').src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>

    <!-- JavaScript for Password Match Validation and Toggle Password -->
    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const icon = passwordField.nextElementSibling.nextElementSibling;
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.replace('la-eye', 'la-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.replace('la-eye-slash', 'la-eye');
            }
        }

        document.addEventListener('input', function() {
            const newPassword = document.getElementById('new_password').value;
            const confirmNewPassword = document.getElementById('new_password_confirmation').value;
            const passwordMessage = document.getElementById('password-message');

            if (confirmNewPassword) {
                if (newPassword === confirmNewPassword) {
                    passwordMessage.style.display = 'block';
                    passwordMessage.textContent = 'Password Match';
                    passwordMessage.className = 'text-success';
                } else {
                    passwordMessage.style.display = 'block';
                    passwordMessage.textContent = 'Passwords do not match';
                    passwordMessage.className = 'text-danger';
                }
            } else {
                passwordMessage.style.display = 'none';
            }
        });
    </script>
    <!-- Show SweetAlert on success or error -->
    @include('dash.dashfooter')
@endsection

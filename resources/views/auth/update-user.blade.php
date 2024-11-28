@extends('layouts.main')
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
                                <h1>Update Profile</h1>
                                <!-- Start of Form -->
                                <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <!-- First Name -->
                                        <div class="col-md-6 form-group">
                                            <label for="fname">First Name</label>
                                            <input type="text" class="form-control" name="fname" id="fname"
                                                value="{{ old('fname', $user->fname) }}" required>
                                            @error('fname')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Last Name -->
                                        <div class="col-md-6 form-group">
                                            <label for="lname">Last Name</label>
                                            <input type="text" class="form-control" name="lname" id="lname"
                                                value="{{ old('lname', $user->lname) }}" required>
                                            @error('lname')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Age -->
                                        <div class="col-md-6 form-group">
                                            <label for="age">Age</label>
                                            <input type="number" class="form-control" name="age" id="age"
                                                value="{{ old('age', $user->age) }}" required readonly>
                                            @error('age')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Birthday -->
                                        <div class="col-md-6 form-group">
                                            <label for="birthday">Birthday</label>
                                            <input type="date" class="form-control" name="birthday" id="birthday"
                                                value="{{ old('birthday', $user->birthday) }}" required>
                                            @error('birthday')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Occupation -->
                                        <div class="col-md-6 form-group">
                                            <label for="occupation">Occupation</label>
                                            <input type="text" class="form-control" name="occupation" id="occupation"
                                                value="{{ old('occupation', $user->occupation ?? 'UI Designer') }}">
                                            @error('occupation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6 form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Mobile -->
                                        <div class="col-md-6 form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control" name="mobile" id="mobile"
                                                value="{{ old('mobile', $user->mobile ?? '(12) 03 4567890') }}">
                                            @error('mobile')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Phone -->
                                        <div class="col-md-6 form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone"
                                                value="{{ old('phone', $user->phone) }}">
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- About Me -->
                                        <div class="col-md-12 form-group">
                                            <label for="about_me">About Me</label>
                                            <textarea class="form-control" name="about_me" id="about_me" rows="4">{{ old('about_me', $user->about_me) }}</textarea>
                                            @error('about_me')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Profile Picture Upload -->
                                        <div class="col-md-12 form-group">
                                            <label for="profile_picture">Profile Picture</label>
                                            <input type="file" class="form-control" name="profile_picture"
                                                id="profile_picture" accept="image/*"
                                                style="display: block;">
                                            @error('profile_picture')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary btn-large">Update Profile</button>
                                    </div>
                                </form>
                                <!-- End of Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ End contact-page Area ================= -->

    <!-- JavaScript to calculate and update age based on birthday -->
    <script>
        function updateAge() {
            var birthdate = document.getElementById('birthday').value;
            if (birthdate) {
                var birthDateObj = new Date(birthdate);
                var today = new Date();
                var age = today.getFullYear() - birthDateObj.getFullYear();
                var monthDiff = today.getMonth() - birthDateObj.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDateObj.getDate())) {
                    age--;
                }

                document.getElementById('age').value = age;
            }
        }

        // Attach the onchange event to the birthday field
        document.getElementById('birthday').addEventListener('change', updateAge);

        // Display the selected profile picture before uploading
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImagePreview').src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>

    @include('layouts.footer')
@endsection

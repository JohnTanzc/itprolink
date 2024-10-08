@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/reg.css') }}">
    @include('pages.nav')

    <section class="home-banner-area">
        <div class="container">
            <div class="row justify-content-center fullscreen align-items-center">
                {{-- Login --}}
                <div class="contain">
                    <div class="title">Registration</div>

                    <div class="content">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="user-details">

                                <div class="input-box">
                                    <span class="details">Email</span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Enter your email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-box">
                                    <span class="details">Password</span>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Enter your password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-box">
                                    <span class="details">Confirm Password</span>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirm password">
                                </div>

                                <div class="input-box">
                                    <span class="details">Phone Number</span>
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone"
                                        placeholder="Enter your number">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="input-box">
                                    <span class="details">First Name</span>
                                    <input id="fname" type="text"
                                        class="form-control @error('fname') is-invalid @enderror" name="fname"
                                        value="{{ old('fname') }}" required autocomplete="fname"
                                        placeholder="Enter your firstname">

                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-box">
                                    <span class="details">Last Name</span>
                                    <input id="lname" type="text"
                                        class="form-control @error('lname') is-invalid @enderror" name="lname"
                                        value="{{ old('lname') }}" required autocomplete="lname"
                                        placeholder="Enter your lastname">

                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Birthday --}}
                                <div class="input-box">
                                    <span class="details">Birthday</span>
                                    <input id="birthday" type="date"
                                        class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                                        value="{{ old('birthday') }}" required autocomplete="birthday"
                                        placeholder="Enter your birthdate" onchange="calculateAge()">

                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Age (Read-only) --}}
                                <div class="input-box">
                                    <span class="details">Age</span>
                                    <input id="age" type="number" class="form-control" name="age" readonly
                                        placeholder="Age">
                                    <input type="hidden" id="hidden-age" name="age" value="">
                                </div>

                                <div class="input-box">
                                    <span class="details">Select Gender</span>
                                    <select class="form-select" aria-label="Default select example" name="gender"
                                        required>
                                        <option value="" disabled selected>Select your role</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Selection of Role --}}
                                <div class="input-box">
                                    <span class="details">Select Role</span>
                                    <select id="roleSelect" class="form-select @error('role') is-invalid @enderror"
                                        name="role" required>
                                        <option value="" disabled selected>Select your role</option>
                                        <option value="tutor">Tutor</option>
                                        <option value="tutee">Tutee</option>
                                    </select><br><br>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- EndSelect of Role --}}

                            </div>

                            <div class="button">
                                <input type="submit" value="Register">
                            </div>
                        </form>

                    </div>
                </div>
                {{-- End of Login --}}
            </div>
        </div>
        @include('layouts.footer')
    </section>
    {{-- JavaScript for Age Calculation --}}
    <script>
        function calculateAge() {
            const birthdate = document.getElementById('birthday').value;
            if (birthdate) {
                const birthDateObj = new Date(birthdate);
                const today = new Date();
                let age = today.getFullYear() - birthDateObj.getFullYear();
                const monthDiff = today.getMonth() - birthDateObj.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDateObj.getDate())) {
                    age--;
                }
                document.getElementById('age').value = age;
                document.getElementById('hidden-age').value = age; // Update hidden field
            }
        }
    </script>
@endsection

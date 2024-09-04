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
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="user-details">

                                <div class="input-box">
                                    <span class="details">Email</span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-box">
                                    <span class="details" for="password-confirm">Confirm Password</span>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="input-box">
                                    <span class="details">Full Name</span>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="input-box">
                                    <span class="details">Phone Number</span>
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-box">
                                    <span class="details" for="password-confirm">Select Gender</span>
                                    <select class="form-select" aria-label="Default select example" name="gender" required>
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
@endsection

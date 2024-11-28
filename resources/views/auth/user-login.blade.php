@extends('layouts.main')
@section('content')
    @include('pages.nav')

    <!-- Breadcrumb Section -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Login</h2>
                </div>
                <ul
                    class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="index.html">Home</a></li>
                    <li>Pages</li>
                    <li>Login</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Login Form Section -->
    <section class="contact-area section--padding position-relative">\
        <span class="ring-shape ring-shape-1"></span>
        <span class="ring-shape ring-shape-2"></span>
        <span class="ring-shape ring-shape-3"></span>
        <span class="ring-shape ring-shape-4"></span>
        <span class="ring-shape ring-shape-5"></span>
        <span class="ring-shape ring-shape-6"></span>
        <span class="ring-shape ring-shape-7"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title text-center fs-25 lh-35 mt-1 pb-3">Login to Your Account!</h3>
                            <div class="section-block"></div>
                            <form method="POST" action="{{ route('user.login.submit') }}" class="pt-4">
                                @csrf

                                <!-- Email Input -->
                                <div class="input-box">
                                    <label class="label-text">Email</label>
                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control form--control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="Enter your email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                        <span class="la la-user input-icon"></span>
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="input-box">
                                    <label class="label-text">Password</label>
                                    <div class="input-group mb-3">
                                        <span class="la la-lock input-icon z-index-6"></span>
                                        <input class="form-control form--control top-bottom-left-radius-5 password-field"
                                            id="password" type="password"
                                            class="form-control form--control @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password"
                                            placeholder="Enter your password">
                                        @error('password')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                        <button class="btn theme-btn theme-btn-transparent toggle-password" type="button">
                                            <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" height="22px"
                                                viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                <path
                                                    d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z">
                                                </path>
                                            </svg>
                                            <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" height="22px"
                                                viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                                <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z"
                                                    fill="none"></path>
                                                <path
                                                    d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Remember Me & Forgot Password -->
                                <div class="d-flex align-items-center justify-content-between pb-4">
                                    <div class="custom-control custom-checkbox fs-15">
                                        <input type="checkbox" class="custom-control-input" id="rememberMeCheckbox" required="">
                                        <label class="custom-control-label custom--control-label" for="rememberMeCheckbox">Remember Me</label>
                                      </div>
                                    <a href="{{ route('recover.password') }}" class="btn-text">Forgot my password?</a>
                                </div>

                                <!-- Submit Button -->
                                <button class="btn theme-btn w-100" type="submit">Login Account</button>

                                <!-- Sign Up Link -->
                                <p class="fs-14 pt-2 text-center">Don't have an account?
                                    <a href="{{route('user.register')}}" class="text-color hover-underline">Register</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection

{{-- <section class="home-banner-area">
        <div class="container">
            <div class="row justify-content-center fullscreen align-items-center">
                <div class="conts">
                    <div class="title">Login</div>
                    <div class="content">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="user-details">
                                <div class="input-box">
                                    <span class="details">Email</span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Enter your email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-box">
                                    <span class="details">Password</span>
                                    <input id="password" type="password" class="@error('password') is-invalid @enderror"
                                        name="password" autocomplete="current-password" placeholder="Enter your password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="forgot-pass mt-1">
                                    <a href="#">Forgot Password?</a>
                                </div>

                            </div>

                            <div class="button">
                                <input type="submit">
                            </div>

                            <div class="signup-link">
                                Not a member? <a href="{{ route('user.register') }}">Signup now</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section> --}}




@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/log.css') }}">
    @include('pages.nav')

    <section class="home-banner-area">
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
    </section>

    @include('layouts.footer')
@endsection

@extends('layouts.main')

@section('content')
    @include('pages.nav')

    <!-- Breadcrumb Section -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Recover Password</h2>
                </div>
                <ul
                    class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Pages</li>
                    <li>Recover Password</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Recover Password Section -->
    <section class="contact-area section--padding position-relative">
        <!-- Decorative Shapes -->
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
                            <h3 class="card-title fs-24 lh-35 pb-2">Recover Password!</h3>
                            <p class="fs-15 lh-24 pb-3">
                                Enter the email associated with your account to reset your password. A reset link will be
                                sent
                                to your email. For assistance, <a href="{{ route('contacts') }}"
                                    class="text-color hover-underline">contact us</a>.
                            </p>
                            <div class="section-block"></div>

                            <!-- Password Recovery Form -->
                            <form method="POST" action="{{ route('recover.send') }}" class="pt-4">
                                @csrf
                                <div class="input-box">
                                    <label class="label-text">Email Address</label>
                                    <div class="form-group">
                                        <input class="form-control form--control @error('email') is-invalid @enderror"
                                            type="email" name="email" placeholder="Enter your email address"
                                            value="{{ old('email') }}" required />
                                        <span class="la la-envelope input-icon"></span>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="btn-box">
                                    <button class="btn theme-btn" type="submit">
                                        Sent Email <i class="la la-arrow-right icon ms-1"></i>
                                    </button>
                                    <div class="d-flex align-items-center justify-content-between fs-14 pt-2">
                                        <a href="{{ route('user.login') }}" class="text-color hover-underline">Login</a>
                                        <p>
                                            Not a member?
                                            <a href="{{ route('user.register') }}"
                                                class="text-color hover-underline">Register</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SweetAlert Notifications -->
        @if (session('status'))
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('status') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        @if ($errors->has('email'))
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: '{{ $errors->first('email') }}',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            </script>
        @endif
    </section>

    @include('layouts.footer')
@endsection

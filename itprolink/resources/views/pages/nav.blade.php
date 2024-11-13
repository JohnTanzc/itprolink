<!-- ================ Start Header Area ================= -->
<header class="header-menu-area">
    <div class="header-menu-content bg-white">
        <div class="container">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{ route('index') }}" class="logo"><img
                                    src="{{ asset('template/images/logo1.png') }}" alt="logo"></a>
                            <div class="user-btn-action">
                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm"
                                    data-toggle="tooltip" data-placement="top" title="Main menu">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col-lg-2 -->
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <nav class="main-menu">
                                <ul>
                                    @auth
                                        @if (Auth::user()->role === 'tutor')
                                            <!-- Tutor-specific navigation -->
                                            <li><a href="{{ route('index') }}">Home</a></li>
                                            <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                        @elseif (Auth::user()->role === 'admin')
                                            <!-- Admin-specific navigation -->
                                            <li><a href="{{ route('index') }}">Home</a></li>
                                            <li class="mega-menu-has"></li>
                                            <li><a href="">Dashboard</a></li>
                                            <li class="mega-menu-has"></li>
                                        @elseif (Auth::user()->role === 'tutee')
                                            <!-- Tutee-specific navigation -->
                                            <li><a href="{{ route('index') }}">Home</a></li>
                                            <li><a href="{{ route('tutee.dashboard') }}">Dashboard</a></li>
                                            <li><a href="{{ route('course') }}">Courses</a></li>
                                        @endif
                                    @else
                                        <!-- Navigation for guests -->
                                        <li><a href="{{ route('index') }}">Home</a></li>
                                        <li><a href="{{ route('about') }}">About</a></li>
                                        <li><a href="{{ route('course') }}">Courses</a></li>
                                        <li><a href="{{ route('contacts') }}">Contacts</a></li>
                                    @endauth

                                    @auth
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <!-- Conditional View Profile link based on role -->
                                                @if(Auth::user()->role === 'tutor')
                                                    <a class="dropdown-item" href="{{ route('tutor.profile') }}">View Profile</a>
                                                @elseif(Auth::user()->role === 'admin')
                                                    {{-- <a class="dropdown-item" href="{{ route('admin.profile') }}">View Profile</a> --}}
                                                @elseif(Auth::user()->role === 'tutee')
                                                    <a class="dropdown-item" href="{{ route('tutee.profile') }}">View Profile</a>
                                                @endif

                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endauth
                                </ul>
                            </nav>
                            <!-- end main-menu -->
                            <div class="nav-right-button border-left border-left-gray ps-4 me-3">
                                @guest
                                    <ul class="generic-list-item">
                                        <li><a href="{{ route('user.login') }}">Login</a></li>
                                        <li>Or</li>
                                        <li>
                                            <a href="{{ route('user.register') }}"
                                                class="btn theme-btn theme-btn-sm text-white"><i
                                                    class="la la-user-plus me-1"></i> Register</a>
                                        </li>
                                    </ul>
                                @endguest
                            </div>
                            <!-- end nav-right-button -->
                            <div class="theme-picker d-flex align-items-center">
                                <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                    <svg id="moon" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                    </svg>
                                </button>
                                <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                    <svg id="sun" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="5"></circle>
                                        <line x1="12" y1="1" x2="12" y2="3"></line>
                                        <line x1="12" y1="21" x2="12" y2="23"></line>
                                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                        <line x1="1" y1="12" x2="3" y2="12"></line>
                                        <line x1="21" y1="12" x2="23" y2="12"></line>
                                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- end menu-wrapper -->
                    </div>
                    <!-- end col-lg-10 -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end header-menu-content -->
    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm"
            data-toggle="tooltip" data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div>
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            @auth
                @if (Auth::user()->role === 'Tutor')
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('tutor.dashboard') }}">Dashboard</a></li>
                    @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <!-- Conditional View Profile link -->
                                @if (Auth::user()->role === 'Tutor')
                                    <a class="dropdown-item" href="{{ route('tutor.profile') }}">View Profile</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('tutee.profile') }}">View Profile</a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth
                @else
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="{{ route('course') }}">Courses</a></li>
                @endif
            @else
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('course') }}">Courses</a></li>
                <li><a href="{{ route('contacts') }}">Contacts</a></li>
                @if (Route::currentRouteName() === 'user.login')
                @endif
            </ul>
            <div class="btn-box px-4 pt-5 text-center">
                <a href="{{ route('user.login') }}" class="btn theme-btn theme-btn-sm theme-btn-transparent"><i
                        class="la la-sign-in me-1"></i> Login</a>
                <span class="fs-15 font-weight-medium d-inline-block mx-2">Or</span>
                <a href="{{ route('user.register') }}" class="btn theme-btn theme-btn-sm shadow-none"><i
                        class="la la-plus me-1"></i> Sign up</a>
            </div>
        @endauth
    </div>
    <div class="body-overlay"></div>
</header>
<!-- ================ End Header Area ================= -->

<!-- ================ Start Header Area ================= -->
{{-- <header class="default-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('template/img/logo1.png') }}" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="lnr lnr-menu"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav">

                    <!-- Show different links based on user role -->
                    @auth
                        @if (Auth::user()->role === 'Tutor')
                            <!-- Show Tutor-specific navigation -->
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li><a href="{{ route('tutor.dashboard') }}">Dashboard</a></li>
                            <li><a href="">Enrollees</a></li>
                        @else
                            <!-- Show default navigation for other users -->
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li><a href="">Dashboard</a></li>
                            <li><a href="{{ route('course') }}">Courses</a></li>
                            <li><a href="{{ route('tutor.card') }}">Tutors</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('course') }}">Courses</a></li>
                        <li><a href="{{ route('contacts') }}">Contacts</a></li>
                        @if (Route::currentRouteName() === 'user.login')
                            <li><a href="{{ route('user.register') }}">Sign Up</a></li>
                        @else
                            <li><a href="{{ route('user.login') }}">Login</a></li>
                        @endif
                    @endauth

                    <!-- User profile and logout section -->
                    @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <!-- Conditional View Profile link -->
                                @if (Auth::user()->role === 'Tutor')
                                    <a class="dropdown-item" href="{{ route('tutor.profile') }}">View Profile</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('tutee.profile') }}">View Profile</a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth

                    <li>
                        <button class="search">
                            <span class="lnr lnr-magnifier" id="search"></span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header> --}}
<!-- ================ End Header Area ================= -->

<!-- ================ Start Header Area ================= -->
<header class="header-menu-area">
    <div class="header-menu-content bg-white">
        <div class="container">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{ route('index') }}" class="logo"><img
                                    src="{{ asset('template/images/logo.png') }}" alt="logo"></a>
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
                                <ul class="shop-cart-btn">
                                    @auth
                                        @if (Auth::user()->role === 'tutor')
                                            <!-- Tutor-specific navigation -->
                                            <li><a href="{{ route('index') }}">Home</a></li>
                                            <li class="{{ request()->routeIs('tutor.dashboard') ? 'page-active' : '' }}">
                                                <a href="{{ route('tutor.dashboard') }}">Dashboard</a>
                                            </li>
                                            <li><a href="{{ route('course') }}">Courses</a></li>
                                            <li class="mega-menu-has"></li>
                                        @elseif (Auth::user()->role === 'admin')
                                            <!-- Admin-specific navigation -->
                                            <li><a href="{{ route('index') }}">Home</a></li>
                                            <li class="{{ request()->routeIs('admin.dashboard') ? 'page-active' : '' }}">
                                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                            </li>
                                            <li class="mega-menu-has"></li>
                                        @elseif (Auth::user()->role === 'tutee')
                                            <!-- Tutee-specific navigation -->
                                            <li><a href="{{ route('index') }}">Home</a></li>
                                            <li class="{{ request()->routeIs('tutee.dashboard') ? 'page-active' : '' }}">
                                                <a href="{{ route('tutee.dashboard') }}">Dashboard</a>
                                            </li>
                                            <li><a href="{{ route('course') }}">Courses</a></li>
                                            <li class="mega-menu-has"></li>
                                        @endif
                                    @else
                                        <!-- Navigation for guests -->
                                        <li><a href="{{ route('index') }}">Home</a></li>
                                        <li><a href="{{ route('about') }}">About</a></li>
                                        <li><a href="{{ route('course') }}">Courses</a></li>
                                        <li><a href="{{ route('contacts') }}">Contacts</a></li>
                                    </ul>
                                @endauth
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
                            {{-- @guest
                            <div class="theme-picker d-flex align-items-center">
                                <button
                                  class="theme-picker-btn dark-mode-btn"
                                  title="Dark mode"
                                >
                                  <svg
                                    id="moon"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  >
                                    <path
                                      d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"
                                    ></path>
                                  </svg>
                                </button>
                                <button
                                  class="theme-picker-btn light-mode-btn"
                                  title="Light mode"
                                >
                                  <svg
                                    id="sun"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                  >
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line
                                      x1="18.36"
                                      y1="18.36"
                                      x2="19.78"
                                      y2="19.78"
                                    ></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                  </svg>
                                </button>
                              </div>
                              @endguest --}}
                            @auth
                                <nav class="shop-cart user-profile-cart">
                                    <ul>
                                        <li>
                                            <div class="shop-cart-btn">
                                                <div class="avatar-xs">
                                                    <img class="rounded-full img-fluid"
                                                        src="{{ asset('storage/profile_pictures/' . (auth()->user()->profile_picture ?? 'default-image.png')) }}"
                                                        alt="Avatar image"
                                                        style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%;" />
                                                </div>

                                            </div>
                                            <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                <li class="menu-heading-block d-flex align-items-center">
                                                    <a href="teacher-detail.html" class="avatar-sm flex-shrink-0 d-block">
                                                        <img class="rounded-circle img-fluid"
                                                            src="{{ asset('storage/profile_pictures/' . (auth()->user()->profile_picture ?? 'default-image.png')) }}"
                                                            alt="Avatar image"
                                                            style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%;" />
                                                    </a>
                                                    <div class="ms-2">
                                                        <h4>
                                                            <a href="teacher-detail.html"
                                                                class="text-black">{{ $user->fname }}
                                                                {{ $user->lname }}
                                                            </a>
                                                        </h4>
                                                        {{-- <span class="d-block fs-14 lh-20">{{ $user->email }}</span> --}}
                                                    </div>
                                                </li>
                                                {{-- Darkmode --}}
                                                {{-- <li>
                                                    <div
                                                        class="theme-picker d-flex align-items-center justify-content-center lh-40">
                                                        <button
                                                            class="theme-picker-btn dark-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                            title="Dark mode">
                                                            <svg class="me-1" viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z">
                                                                </path>
                                                            </svg>
                                                            Dark Mode
                                                        </button>
                                                        <button
                                                            class="theme-picker-btn light-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                            title="Light mode">
                                                            <svg class="me-1" viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <circle cx="12" cy="12" r="5">
                                                                </circle>
                                                                <line x1="12" y1="1" x2="12"
                                                                    y2="3"></line>
                                                                <line x1="12" y1="21" x2="12"
                                                                    y2="23"></line>
                                                                <line x1="4.22" y1="4.22" x2="5.64"
                                                                    y2="5.64"></line>
                                                                <line x1="18.36" y1="18.36" x2="19.78"
                                                                    y2="19.78"></line>
                                                                <line x1="1" y1="12" x2="3"
                                                                    y2="12"></line>
                                                                <line x1="21" y1="12" x2="23"
                                                                    y2="12"></line>
                                                                <line x1="4.22" y1="19.78" x2="5.64"
                                                                    y2="18.36"></line>
                                                                <line x1="18.36" y1="5.64" x2="19.78"
                                                                    y2="4.22"></line>
                                                            </svg>
                                                            Light Mode
                                                        </button>
                                                    </div>
                                                </li> --}}
                                                <li>
                                                    <ul class="generic-list-item">
                                                        <li>
                                                            <div class="section-block"></div>
                                                        </li>
                                                        <li>
                                                            <a href="dashboard.html">
                                                                <i class="la la-bell me-1"></i>
                                                                Notifications
                                                                <span class="badge bg-info text-white ms-2 p-1">9+</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="dashboard-message.html">
                                                                <i class="la la-envelope me-1"></i>
                                                                Messages
                                                                <span class="badge bg-info text-white ms-2 p-1">12+</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            @if (Auth::user()->role === 'tutor')
                                                                <a href="{{ route('tutor.setting', ['id' => Auth::user()->id]) }}">
                                                                    <i class="la la-gear me-1"></i> Settings
                                                                </a>
                                                            @elseif(Auth::user()->role === 'admin')
                                                                <a href="{{ route('admin.setting', ['id' => Auth::user()->id]) }}">
                                                                    <i class="la la-gear me-1"></i> Settings
                                                                </a>
                                                            @elseif(Auth::user()->role === 'tutee')
                                                                <a href="{{ route('tutee.setting') }}">
                                                                    <i class="la la-gear me-1"></i> Settings
                                                                </a>
                                                            @endif
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <i class="la la-question me-1"></i> Help
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                                                <i class="la la-power-off me-1"></i>
                                                                {{ __('Logout') }}
                                                            </a>
                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                method="POST" class="d-none">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                </li>
                                                <li>
                                            </ul>
                                        </li>
                                    </ul>

                                @endauth
                            </nav>
                        </div>

                        <!-- end main-menu -->

                        <!-- end nav-right-button -->

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
                @if (Auth::user()->role === 'admin')
                    <li class="{{ request()->routeIs('index') ? 'page-active' : '' }}">
                        <a href="{{ route('index') }}">Home</a>
                    </li>
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a class="dropdown-item py-1" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @elseif(Auth::user()->role === 'tutor')
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{route('tutor.dashboard')}}">Dashboard</a></li>
                    <li><a class="dropdown-item py-1" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @elseif(Auth::user()->role === 'tutee')
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{route('tutee.dashboard')}}">Dashboard</a></li>
                    <li><a class="dropdown-item py-1" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
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

<header class="header-menu-area">
    <div class="header-menu-content dashboard-menu-content pe-30px ps-30px bg-white shadow-sm">
        <div class="container-fluid">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="logo-box logo--box">
                            <a href="{{ route('index') }}" class="logo"><img
                                    src="{{ asset('template/images/logo.png') }}" alt="logo" /></a>
                            <div class="user-btn-action">
                                <div class="search-menu-toggle icon-element icon-element-sm shadow-sm me-2"
                                    data-toggle="tooltip" data-placement="top" title="Search">
                                    <i class="la la-search"></i>
                                </div>
                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm"
                                    data-toggle="tooltip" data-placement="top" title="Main menu">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                        <!-- end logo-box -->
                        <div class="menu-wrapper">
                            <form method="post" class="me-auto ms-0">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control form--control-gray ps-3" type="text"
                                        name="search" placeholder="Search for anything" />
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                            <div class="nav-right-button d-flex align-items-center">
                                <div class="user-action-wrap d-flex align-items-center">
                                    {{-- add here for wishlist --}}
                                    <div class="shop-cart notification-cart pe-3 me-3 border-right border-right-gray">
                                        <ul>
                                            <li>
                                                <p class="shop-cart-btn">
                                                    <i class="la la-bell"></i>
                                                    <span class="dot-status bg-1"></span>
                                                </p>
                                                <ul
                                                    class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li
                                                        class="menu-heading-block d-flex align-items-center justify-content-between">
                                                        <h4>Notifications</h4>
                                                        <span class="ribbon fs-14">18</span>
                                                    </li>
                                                    <li>
                                                        <div class="notification-body">
                                                            <a href="dashboard.html"
                                                                class="media media-card align-items-center">
                                                                <div
                                                                    class="icon-element icon-element-sm flex-shrink-0 bg-1 me-3 text-white">
                                                                    <i class="la la-bolt"></i>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5>Your resume updated!</h5>
                                                                    <span class="d-block lh-18 pt-1 text-gray fs-13">1
                                                                        hour ago</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li class="menu-heading-block">
                                                        <a href="dashboard.html" class="btn theme-btn w-100">Show All
                                                            Notifications
                                                            <i class="la la-arrow-right icon ms-1"></i></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end shop-cart -->
                                    <div class="shop-cart user-profile-cart">
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
                                                <ul
                                                    class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li class="menu-heading-block d-flex align-items-center">
                                                        <a href="{{ route(auth()->user()->role . '.profile', ['id' => auth()->user()->id]) }}"
                                                            class="avatar-sm flex-shrink-0 d-block">
                                                            <img class="rounded-circle img-fluid"
                                                                src="{{ asset('storage/profile_pictures/' . (auth()->user()->profile_picture ?? 'default-image.png')) }}"
                                                                alt="Avatar image"
                                                                style="width: 35px; height: 35px; object-fit: cover; border-radius: 50%;" />
                                                        </a>
                                                        <div class="ms-2">
                                                            <h4>
                                                                <a href="{{ route(auth()->user()->role . '.profile', ['id' => auth()->user()->id]) }}"
                                                                    class="text-black">{{ $user->fname }}
                                                                    {{ $user->lname }}</a>
                                                            </h4>
                                                            {{-- <span class="d-block fs-14 lh-20">{{ $user->email }}</span> --}}
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div
                                                            class="theme-picker d-flex align-items-center justify-content-center lh-40">
                                                            <button
                                                                class="theme-picker-btn dark-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                                title="Dark mode">
                                                                <svg class="me-1" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                    <path
                                                                        d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z">
                                                                    </path>
                                                                </svg>
                                                                Dark Mode
                                                            </button>
                                                            <button
                                                                class="theme-picker-btn light-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                                title="Light mode">
                                                                <svg class="me-1" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round">
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
                                                                    <line x1="1" y1="12"
                                                                        x2="3" y2="12"></line>
                                                                    <line x1="21" y1="12"
                                                                        x2="23" y2="12"></line>
                                                                    <line x1="4.22" y1="19.78"
                                                                        x2="5.64" y2="18.36"></line>
                                                                    <line x1="18.36" y1="5.64"
                                                                        x2="19.78" y2="4.22"></line>
                                                                </svg>
                                                                Light Mode
                                                            </button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <ul class="generic-list-item">
                                                            <li>
                                                                <div class="section-block"></div>
                                                            </li>
                                                            <li>
                                                                <a href="dashboard.html">
                                                                    <i class="la la-bell me-1"></i>
                                                                    Notifications
                                                                    <span
                                                                        class="badge bg-info text-white ms-2 p-1">9+</span>
                                                                </a>
                                                            </li>
                                                            {{-- <li>
                                                                <a href="dashboard-message.html">
                                                                    <i class="la la-envelope me-1"></i>
                                                                    Messages
                                                                    <span
                                                                        class="badge bg-info text-white ms-2 p-1">12+</span>
                                                                </a>
                                                            </li> --}}
                                                            <li>
                                                                @if (Auth::user()->role === 'tutor')
                                                                    <a
                                                                        href="{{ route('tutor.setting', ['id' => Auth::user()->id]) }}">
                                                                        <i class="la la-gear me-1"></i> Settings
                                                                    </a>
                                                                @elseif(Auth::user()->role === 'admin')
                                                                    <a
                                                                        href="{{ route('admin.setting', ['id' => Auth::user()->id]) }}">
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
                                        </li>
                                        </ul>
                                    </div>
                                    <!-- end shop-cart -->
                                </div>
                            </div>
                            <!-- end nav-right-button -->
                        </div>
                        <!-- end menu-wrapper -->
                    </div>
                    <!-- end col-lg-10 -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end header-menu-content -->
    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm"
            data-toggle="tooltip" data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div>
        <!-- end off-canvas-menu-close -->
        <h4 class="off-canvas-menu-heading pt-90px"></h4>
        <ul class="generic-list-item off-canvas-menu-list pt-1 pb-2 border-bottom border-bottom-gray">
            {{-- <li><a href="dashboard.html">Notifications</a></li>
            <li><a href="dashboard-message.html">Messages</a></li> --}}
            <li><a
                    href=@if (Auth::user()->role == 'admin') {{ route('admin.setting', ['id' => Auth::user()->id]) }}
            @elseif(Auth::user()->role == 'tutor')
            {{ route('tutor.setting', ['id' => Auth::user()->id]) }}
            @elseif(Auth::user()->role == 'tutee')
                {{ route('tutee.setting') }} @endif>
                    Settings</a></li>
            <li><a href="index.html">Log out</a></li>
        </ul>
        <div class="theme-picker d-flex align-items-center justify-content-center mt-4 px-3">
            <button
                class="theme-picker-btn dark-mode-btn btn theme-btn-sm theme-btn-white w-100 font-weight-semi-bold justify-content-center"
                title="Dark mode">
                <svg class="me-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
                Dark Mode
            </button>
            <button
                class="theme-picker-btn light-mode-btn btn theme-btn-sm theme-btn-white w-100 font-weight-semi-bold justify-content-center"
                title="Light mode">
                <svg class="me-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
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
                Light Mode
            </button>
        </div>
    </div>
    <!-- end off-canvas-menu -->
    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <form method="post" class="flex-grow-1 me-3">
                <div class="form-group mb-0">
                    <input class="form-control form--control ps-3" type="text" name="search"
                        placeholder="Search for anything" />
                    <span class="la la-search search-icon"></span>
                </div>
            </form>
            <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                <i class="la la-times"></i>
            </div>
            <!-- end off-canvas-menu-close -->
        </div>
    </div>
    <!-- end mobile-search-form -->
    <div class="body-overlay"></div>
</header>
<div class="off-canvas-menu dashboard-off-canvas-menu off--canvas-menu custom-scrollbar-styled pt-20px">
    <div class="off-canvas-menu-close dashboard-menu-close icon-element icon-element-sm shadow-sm"
        data-toggle="tooltip" data-placement="left" title="Close menu">
        <i class="la la-times"></i>
    </div>
    <!-- end off-canvas-menu-close -->
    <div class="logo-box px-4">
        <a href="{{ route('index') }}" class="logo"><img src="{{ asset('template/images/logo.png') }}"
                alt="logo" /></a>
    </div>
    <ul class="generic-list-item off-canvas-menu-list off--canvas-menu-list pt-35px">
        <li class="{{ request()->routeIs('index') ? 'page-active' : '' }}">
            <a href="{{ route('index') }}">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                    width="18px">
                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path>
                </svg>
                Home
            </a>
        </li>

        @auth
            <li
                class="{{ request()->routeIs('tutor.dashboard') || request()->routeIs('tutee.dashboard') || request()->routeIs('admin.dashboard') ? 'page-active' : '' }}">
                <a
                    href="
                @if (Auth::user()->role === 'tutor') {{ route('tutor.dashboard') }}
                @elseif(Auth::user()->role === 'tutee')
                    {{ route('tutee.dashboard') }}
                @elseif(Auth::user()->role === 'admin')
                    {{ route('admin.dashboard') }} @endif
                ">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                        width="18px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li
                class="{{ request()->routeIs('tutor.profile') || request()->routeIs('tutee.profile') || request()->routeIs('admin.profile') ? 'page-active' : '' }}">
                <a
                    href="
                @if (Auth::user()->role === 'tutor') {{ route('tutor.profile', ['id' => Auth::user()->id]) }}
                @elseif(Auth::user()->role === 'tutee')
                    {{ route('tutee.profile', ['id' => Auth::user()->id]) }}
                @elseif(Auth::user()->role === 'admin')
                    {{ route('admin.profile', ['id' => Auth::user()->id]) }} @endif
                ">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                        width="18px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
                    </svg>
                    My Profile
                </a>
            </li>
        @endauth
        {{-- All Tutors --}}
        {{-- @auth
            @if (Auth::user()->role === 'admin')
                <li class="{{ request()->routeIs('dashtutor') ? 'page-active' : '' }}">
                    <a href="{{ route('dashtutor') }}">
                        <svg class="me-2" fill="#000000" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="18px"
                            width="18px" viewBox="0 0 256.00 256.00" style="transform: translateX(2px);"
                            enable-background="new 0 0 256 240" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M84.635,20.256c18.383,0,33.286,14.903,33.286,33.286s-14.903,33.286-33.286,33.286S51.349,71.925,51.349,53.542 S66.251,20.256,84.635,20.256z M31.002,145.011c0-2.499,1.606-4.194,4.194-4.194s4.194,1.606,4.194,4.194v92.986h91.469v-92.986 c0-2.499,1.606-4.194,4.194-4.194c2.499,0,4.194,1.606,4.194,4.194v92.986h29.092V136.623c0-22.934-18.74-41.585-41.585-41.585 h-8.388l-24.451,38.015l-2.945-28.467l4.016-9.638H76.96l4.016,9.638l-3.123,28.645L53.401,95.038h-9.816 C20.651,95.038,2,113.778,2,136.623v101.375h29.092v-92.986H31.002z M214,76h34.415c3.072,0,5.585-2.513,5.585-5.585V7.927 C254,4.903,251.361,2,248.38,2h-94.717C150.548,2,148,4.548,148,7.663v63.002c0,2.947,2.389,5.336,5.336,5.336H188v9h-9.113 c0.028,0.02,0.113,0.04,0.113,0.047v5.513c0,0-0.162,0.44-0.113,0.44H222v-6h-8V76z M156,64V11h90v53H156z">
                                </path>
                            </g>
                        </svg>
                        All Tutors
                    </a>
                </li>
            @endif
        @endauth --}}
        {{-- All Tutees --}}
        {{-- @auth
            @if (Auth::user()->role === 'admin')
                <li class="{{ request()->routeIs('dashtutee') ? 'page-active' : '' }}">
                    <a href="{{ route('dashtutee') }}">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                            width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
                        </svg>
                        All Tutees
                    </a>
                </li>
            @endif
        @endauth --}}
        @auth
            @if (Auth::user()->role === 'admin')
                <li class="{{ request()->routeIs('dashcourse') ? 'page-active' : '' }}">
                    <a href="{{ route('dashcourse') }}">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                            width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                        </svg>
                        All Courses
                    </a>
                </li>
            @endif
        @endauth
        @auth
            @if (Auth::user()->role === 'admin')
                <li class="{{ request()->routeIs('admin.dashcreate') ? 'page-active' : '' }}">
                    <a href="{{ route('admin.dashcreate') }}">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                            width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4s-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zM4 18v2h3v-2H4zm13 0v2h3v-2h-3zm-8 0v2h3v-2h-3z" />
                        </svg>
                        Users
                    </a>
                </li>
            @endif
        @endauth

        @auth
            @if (Auth::user()->role === 'admin')
                <li class="{{ request()->routeIs('admin.users') ? 'page-active' : '' }}">
                    <a href="{{ route('admin.users') }}">
                        <svg class="me-2" viewBox="-0.24 -0.24 24.48 24.48" fill="none"
                            xmlns="http://www.w3.org/2000/svg" height="18px" width="18px" stroke="#ffffff"
                            stroke-width="0.12000000000000002">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M21.5609 10.7386L20.2009 9.15859C19.9409 8.85859 19.7309 8.29859 19.7309 7.89859V6.19859C19.7309 5.13859 18.8609 4.26859 17.8009 4.26859H16.1009C15.7109 4.26859 15.1409 4.05859 14.8409 3.79859L13.2609 2.43859C12.5709 1.84859 11.4409 1.84859 10.7409 2.43859L9.17086 3.80859C8.87086 4.05859 8.30086 4.26859 7.91086 4.26859H6.18086C5.12086 4.26859 4.25086 5.13859 4.25086 6.19859V7.90859C4.25086 8.29859 4.04086 8.85859 3.79086 9.15859L2.44086 10.7486C1.86086 11.4386 1.86086 12.5586 2.44086 13.2486L3.79086 14.8386C4.04086 15.1386 4.25086 15.6986 4.25086 16.0886V17.7986C4.25086 18.8586 5.12086 19.7286 6.18086 19.7286H7.91086C8.30086 19.7286 8.87086 19.9386 9.17086 20.1986L10.7509 21.5586C11.4409 22.1486 12.5709 22.1486 13.2709 21.5586L14.8509 20.1986C15.1509 19.9386 15.7109 19.7286 16.1109 19.7286H17.8109C18.8709 19.7286 19.7409 18.8586 19.7409 17.7986V16.0986C19.7409 15.7086 19.9509 15.1386 20.2109 14.8386L21.5709 13.2586C22.1509 12.5686 22.1509 11.4286 21.5609 10.7386ZM16.1609 10.1086L11.3309 14.9386C11.1909 15.0786 11.0009 15.1586 10.8009 15.1586C10.6009 15.1586 10.4109 15.0786 10.2709 14.9386L7.85086 12.5186C7.56086 12.2286 7.56086 11.7486 7.85086 11.4586C8.14086 11.1686 8.62086 11.1686 8.91086 11.4586L10.8009 13.3486L15.1009 9.04859C15.3909 8.75859 15.8709 8.75859 16.1609 9.04859C16.4509 9.33859 16.4509 9.81859 16.1609 10.1086Z">
                                </path>
                            </g>
                        </svg>
                        User Verification
                    </a>
                </li>
            @endif
        @endauth
        @auth
            @if (Auth::user()->role === 'admin')
                <li class="{{ request()->routeIs('payment.view') ? 'page-active' : '' }}">
                    <a href="{{ route('payment.view') }}">
                        <svg class="me-2" viewBox="0 0 490.11 490.109" fill="none"
                            xmlns="http://www.w3.org/2000/svg" height="15px" width="15px" stroke="#ffffff"
                            stroke-width="0.12">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M449.958,175.251H399.55c1.892-10.802,2.837-22.363,2.837-34.687c0-4.865-0.201-9.525-0.496-14.088h48.066
                    c8.086,0,14.635-6.555,14.635-14.641c0-8.08-6.549-14.635-14.635-14.635h-52.346c-2.211-9.002-5.154-17.271-8.914-24.689
                    c-9.114-18.02-21.243-32.438-36.398-43.252c-15.167-10.811-32.663-18.388-52.487-22.742C279.999,2.172,259.489,0,238.29,0
                    c0,0-69.428,0-106.016,0c-36.59,0-33.727,45.737-33.727,45.737V97.2H40.152c-8.074,0-14.635,6.555-14.635,14.635
                    c0,8.086,6.561,14.641,14.635,14.641h58.396v48.782H40.152c-8.074,0-14.635,6.555-14.635,14.638
                    c0,8.086,6.561,14.635,14.635,14.635h58.396v213.763c0,0.248-0.071,0.473-0.071,0.709v39.638c0,17.39,14.088,31.47,31.466,31.47
                    s31.457-14.08,31.457-31.47v-10.97h0.121V289.711h59.909c59.977,0,105.152-12.508,135.463-37.534
                    c15.415-12.717,26.864-28.623,34.442-47.652h58.616c8.086,0,14.636-6.549,14.636-14.638
                    C464.586,181.807,458.037,175.251,449.958,175.251z M161.521,56.924h65.314c15.046,0,29.262,1.271,42.602,3.812
                    c13.37,2.547,24.968,7.051,34.845,13.518c8.777,5.76,15.764,13.482,21.195,22.937H161.521V56.924z M161.521,126.47h173.319
                    c0.644,4.956,1.087,10.107,1.087,15.682c0,12.238-1.549,23.229-4.444,33.1H161.526V126.47H161.521z M309.99,208.931
                    c-8.996,7.424-20.723,13.09-35.121,17.018c-14.423,3.925-32.134,5.884-53.114,5.884h-60.228v-27.308h153.157
                    C313.182,206.038,311.668,207.551,309.99,208.931z">
                                </path>
                            </g>
                        </svg>
                        Payments
                    </a>
                </li>
            @endif
        @endauth

        @if (Auth::user()->role === 'tutee')
            <li class="{{ request()->routeIs('mycourses') ? 'page-active' : '' }}">
                <a href="{{ route('mycourses') }}">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                        width="18px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                    </svg>
                    My Courses
                </a>
            </li>
        @endif
        @if (Auth::user()->role === 'tutor')
            <li class="{{ request()->is('tut.course') ? 'page-active' : '' }}">
                <a href="{{ route('tut.course', ['id' => Auth::user()->id]) }}">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                        width="18px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z" />
                    </svg>
                    My Course
                </a>
            </li>
        @endif

        @if (Auth::user()->role === 'tutor')
            <li class="{{ request()->routeIs('tutor.enrollee') ? 'page-active' : '' }}">
                <a href="{{ route('tutor.enrollee') }}">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                        width="18px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z" />
                    </svg>
                    Enrollees
                </a>
            </li>
        @endif
        @if (Auth::user()->role === 'tutor')
            <li class="{{ request()->is('pub.profile') ? 'page-active' : '' }}">
                <a href="{{ route('pub.profile', ['id' => Auth::user()->id]) }}">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                        width="18px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z" />
                    </svg>
                    Public Profile
                </a>
            </li>
        @endif
        @if (Auth::user()->role === 'tutor')
            <!-- Adjust this condition to your actual column name -->
            <!-- Verified Tutors: Link to Upload Courses -->
            <li class="{{ request()->routeIs('submit.course') ? 'page-active' : '' }}">
                <a href="{{ route('submit.course') }}">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                        width="18px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                    </svg>
                    Submit Courses
                </a>
            </li>
        @endif
        <li class="{{ request()->is('dashboard-message') ? 'page-active' : '' }}">
            <a href="{{ url('dashboard-message') }}">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                    width="18px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z" />
                </svg>
                Messages <span class="badge text-bg-info p-1 ms-2">2</span>
            </a>
        </li>
        <li class="{{ request()->is('dashboard-reviews') ? 'page-active' : '' }}">
            <a href="{{ url('dashboard-reviews') }}">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                    width="18px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z" />
                </svg>
                Feedbacks
            </a>
        </li>
        @auth
            @if (Auth::user()->role === 'admin')
                <li class="{{ request()->is('dashboard-earnings') ? 'page-active' : '' }}">
                    <a href="{{ url('dashboard-earnings') }}">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"
                            width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                            <path
                                d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z">
                            </path>
                        </svg>
                        Earnings
                    </a>
                </li>
            @endif
        @endauth
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const verifyAlertBtn = document.getElementById('verifyAlertBtn');

        if (verifyAlertBtn) {
            verifyAlertBtn.addEventListener('click', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Verification Required',
                    text: 'You need to verify your account before uploading courses.',
                    confirmButtonText: 'Go to Settings'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the settings page
                        window.location.href =
                            "{{ route('tutor.setting', ['id' => Auth::user()->id]) }}"; // Replace with the actual route
                    }
                });
            });
        }
    });
</script>

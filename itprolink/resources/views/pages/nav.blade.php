 <!-- ================ Start Header Area ================= -->
 <header class="default-header">
     <nav class="navbar navbar-expand-lg  navbar-light">
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
                     <li><a href="{{ route('index') }}">Home</a></li>
                     <li><a href="{{ route('about') }}">About</a></li>
                     <li><a href="{{ route('course') }}">Courses</a></li>
                     <!-- Dropdown -->
                     {{-- <li class="dropdown">
                         <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                             Pages
                         </a>
                         <div class="dropdown-menu">
                             <a class="dropdown-item" href="{{ asset('template/elements.html') }}">Elements</a>
                             <a class="dropdown-item" href="{{ asset('template/course-details.html') }}">Course
                                 Details</a>
                         </div>
                     </li>
                     <li class="dropdown">
                         <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                             Blog
                         </a>
                         <div class="dropdown-menu">
                             <a class="dropdown-item" href="{{ asset('template/blog-home.html') }}">Blog Home</a>
                             <a class="dropdown-item" href="{{ asset('template/blog-single.html') }}">Blog
                                 Details</a>
                         </div>
                     </li> --}}
                     <li><a href="{{ route('contacts') }}">Contacts</a></li>

                     @guest
                         @if (Route::currentRouteName() === 'user.login')
                             <li><a href="{{ route('user.register') }}">Sign Up</a></li>
                         @else
                             <li><a href="{{ route('user.login') }}">Login</a></li>
                         @endif
                     @else
                         <li class="nav-item dropdown">
                             <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 {{ Auth::user()->name }}
                             </a>

                             <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
                     @endguest

                     <li>
                         <button class="search">
                             <span class="lnr lnr-magnifier" id="search"></span>
                         </button>
                     </li>
                 </ul>
             </div>
         </div>
     </nav>
     <div class="search-input" id="search-input-box">
         <div class="container">
             <form class="d-flex justify-content-between">
                 <input type="text" class="form-control" id="search-input" placeholder="Search Here" />
                 <button type="submit" class="btn"></button>
                 <span class="lnr lnr-cross" id="close-search" title="Close Search"></span>
             </form>
         </div>
     </div>
 </header>
 <!-- ================ End Header Area ================= -->

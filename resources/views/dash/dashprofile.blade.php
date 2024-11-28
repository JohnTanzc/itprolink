@extends('layouts.main')

@section('content')
    {{-- Header --}}
    @include('dash.dashnav')
    {{-- End of Header --}}

    <!-- end off-canvas-menu -->
    <div class="dashboard-content-wrap">
        <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ms-3">
            <i class="la la-bars me-1"></i> Dashboard Nav
        </div>
        <div class="container-fluid">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
                <div class="media media-card align-items-center">
                    <div class="media-img media--img media-img-md rounded-full">
                        <img class="rounded-full"
                            src="{{ asset('storage/profile_pictures/' . (auth()->user()->profile_picture ?? 'default-image.png')) }}"
                            alt="Student thumbnail image" />
                    </div>
                    <div class="media-body">
                        <h2 class="section__title fs-30">{{ $user->fname }} {{ $user->lname }}</h2>
                        @if (Auth::user()->role == 'tutor')
                            <div class="rating-wrap d-flex align-items-center pt-2">
                                <div class="review-stars">
                                    <span class="rating-number">4.4</span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                </div>
                                <span class="rating-total ps-1">(20,230)</span>
                            </div>
                        @else
                        @endif
                        <!-- end rating-wrap -->
                    </div>
                    <!-- end media-body -->
                </div>
                <!-- end media -->
                {{-- <div class="file-upload-wrap file-upload-wrap-2 file--upload-wrap">
                    <input type="file" name="files[]" class="multi file-upload-input" />
                    <span class="file-upload-text"><i class="la la-upload me-2"></i>Upload a course</span>
                    </div> --}}
                <!-- file-upload-wrap -->
            </div>
            <!-- end breadcrumb-content -->
            <div class="section-block mb-5"></div>
            <div class="dashboard-heading mb-5">
                <h3 class="fs-22 font-weight-semi-bold">My Profile</h3>
            </div>
            <div class="profile-detail mb-5">
                <ul class="generic-list-item generic-list-item-highlight row">
                    <li>
                        <span class="profile-name">Registration Date:</span>
                        <span
                            class="profile-desc">{{ Auth::user()->created_at->format('F j, Y') ?? 'Not Available' }}</span>
                    </li>
                    <li>
                        <span class="profile-name">Email:</span>
                        <span class="profile-desc">{{ Auth::user()->email ?? 'Not Available' }}</span>
                    </li>
                    <li >
                        <span class="profile-name">First Name:</span>
                        <span class="profile-desc">{{ Auth::user()->fname ?? 'Not Available' }}</span>
                    </li>
                    <li>
                        <span class="profile-name">Last Name:</span>
                        <span class="profile-desc">{{ Auth::user()->lname ?? 'Not Available' }}</span>
                    </li>
                    <li>
                        <span class="profile-name">Phone Number:</span>
                        <span class="profile-desc">{{ Auth::user()->phone ?? 'Not Available' }}</span>
                    </li>
                    <div class="row col-md-12">
                        <li>
                            <span class="profile-name">Bio:</span>
                            <span class="profile-desc">{{ Auth::user()->about_me ?? 'Not Available' }}</span>
                        </li>
                    </div>
                </ul>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
        @include('dash.dashfooter')
    </div>
    <!-- end dashboard-content-wrap -->
@endsection

@extends('layouts.main')

@section('content')
    {{-- Header --}}
    @include('dash.dashnav')
    {{-- End of Header --}}

    <div class="dashboard-content-wrap">
        <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ms-3">
            <i class="la la-bars me-1"></i> Dashboard Nav
        </div>


        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">My Courses</h3>
        </div>

        <div class="dashboard-cards mb-5">
            @forelse($courses as $course)
                <div class="card card-item card-item-list-layout">
                    <div class="card-image">
                        <a href="{{ route('course.detail', $course->id) }}" class="d-block">
                            <!-- Image Source -->
                            <img class="card-img-top lazy" src="{{ asset('template/images/img-loading.png') }}"
                                data-src="{{ $course->image ? asset('storage/' . $course->image) : asset('storage/' . $this->getDefaultImage($course->category)) }}"
                                alt="{{ $course->title }}" />
                        </a>
                        <div class="course-badge-labels">
                            @if ($course->is_bestseller)
                                <div class="course-badge">Bestseller</div>
                            @endif
                        </div>
                    </div>
                    <!-- end card-image -->
                    <div class="card-body">
                        <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->level }}</h6>
                        <h5 class="card-title">
                            <a href="{{ route('course.detail', $course->id) }}">{{ $course->title }}</a>
                        </h5>
                        <p class="card-text">
                            <a href="{{ route('pub.profile', $course->tutor->id) }}">{{ $course->tutor->name }}</a>
                        </p>
                        <div class="rating-wrap d-flex align-items-center py-2">
                            <div class="review-stars">
                                <span class="rating-number">{{ $course->rating }}</span>
                                {!! str_repeat('<span class="la la-star"></span>', floor($course->rating)) !!}
                                {!! str_repeat('<span class="la la-star-o"></span>', 5 - floor($course->rating)) !!}
                            </div>
                            <span class="rating-total ps-1">({{ $course->reviews_count }})</span>
                        </div>
                        <!-- end rating-wrap -->
                        <ul class="card-duration d-flex align-items-center fs-15 pb-2">
                            <li class="me-2">
                                <span class="text-black">Status:</span>
                                <span class="badge text-bg-{{ $course->active == 1 ? 'success' : 'danger' }} text-white">
                                    {{ $course->active == 1 ? 'Active' : 'Not Active' }}
                                </span>

                            </li>
                            <li class="me-2">
                                <span class="text-black">Duration:</span>
                                <span>{{ $course->course_time }}</span>
                            </li>
                            <li class="me-2">
                                <span class="text-black">
                                    {{ $course->tutees_count == 1 ? 'Tutee:' : 'Tutees:' }}
                                </span>
                                <span>
                                    {{ $course->tutees_count }}
                                </span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-price text-black font-weight-bold">{{ $course->price }}</p>
                            <div class="card-action-wrap ps-3">
                                <a href="{{ route('course.detail', $course->id) }}"
                                    class="icon-element icon-element-sm shadow-sm cursor-pointer ms-1 text-success"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"><i
                                        class="la la-eye"></i></a>
                                <a href=""
                                    class="icon-element icon-element-sm shadow-sm cursor-pointer ms-1 text-secondary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i
                                        class="la la-edit"></i></a>
                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer ms-1 text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                    <span data-bs-toggle="modal" data-bs-target="#itemDeleteModal"
                                        class="w-100 h-100 d-inline-block"
                                        onclick="setDeleteUrl('{{ route('course.delete', $course->id) }}')">
                                        <i class="la la-trash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            @empty
                <p>No courses uploaded yet.</p>
            @endforelse
        </div>

        <!-- Pagination links -->
        <!-- Pagination links -->
        <div class="d-flex justify-content-center">
            {{ $courses->links() }} <!-- This will generate the pagination links -->
        </div>

        @include('dash.dashfooter')
    </div>
    <!-- end dashboard-content-wrap -->

    <!-- Modal for item deletion -->
    <div class="modal fade modal-container" id="itemDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="itemDeleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="la la-exclamation-circle fs-60 text-warning"></span>
                    <h4 class="modal-title fs-19 font-weight-semi-bold pt-2 pb-1">
                        Your item will be deleted permanently!
                    </h4>
                    <p>Are you sure you want to delete your item?</p>
                    <div class="btn-box pt-4">
                        <button type="button" class="btn font-weight-medium me-3" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <!-- Delete Form -->
                        <form id="deleteForm-{{ $course->id }}" method="POST"
                            action="{{ route('course.delete', $course->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn theme-btn theme-btn-sm lh-30">
                                Ok, Delete
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Modal --}}

    <!-- Show SweetAlert on success -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Course deleted successfully',
                        showConfirmButton: false,
                        timer: 2000
                });
            });
        </script>
    @endif


    <script>
        function setDeleteUrl(url) {
            document.getElementById('deleteForm').action = url;
        }
    </script>
@endsection

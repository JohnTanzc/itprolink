@extends('layouts.main')

@section('content')
    {{-- Header --}}
    @include('dash.dashnav')
    {{-- End of Header --}}

    <!-- Dashboard Content -->
    <div class="dashboard-content-wrap">
        <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ms-3">
            <i class="la la-bars me-1"></i> Dashboard Nav
        </div>

        <h3 class="fs-22 font-weight-semi-bold mb-3 ms-3">Courses</h3>

        <div class="card mx-3">
            <div class="card-body">

                <!-- Table with hoverable rows -->
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 5%;">Course ID#</th>
                            <th scope="col" style="width: 5%;">Uploader</th>
                            <th scope="col" style="width: 5%;">Course Name</th>
                            <th scope="col" style="width: 5%;">Enrollees</th>
                            <th scope="col" style="width: 5%;"s>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <th scope="row">{{ $course->id }}</th>
                                <td>{{ $course->instructor_name }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->enrolledCount }}</td> <!-- Use enrolledCount here -->
                                <td>{{ $course->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with hoverable rows -->
                <div class="d-flex justify-content-center">
                    {{ $courses->links() }} <!-- Generates the pagination links -->
                </div>
                <style>
                    .pagination {
                        display: flex;
                        justify-content: center;
                    }

                    .pagination a, .pagination span {
                        color: #EF6767; /* Set text color */
                        background-color: transparent; /* Ensure no background color for normal links */
                        border-color: #EF6767; /* Set border color to match text color */
                    }

                    .pagination a:hover {
                        color: #C85A5A; /* Change color on hover */
                        background-color: #F2D1D1; /* Light background on hover */
                        border-color: #EF6767; /* Border color on hover */
                    }

                    .pagination .active {
                        background-color: #EF6767; /* Set active page background color */
                        color: white; /* Active page text color */
                        border-color: #EF6767; /* Set border color for active page */
                    }

                    .pagination .disabled {
                        color: #d6d6d6; /* Set color for disabled pages */
                        background-color: transparent; /* Ensure no background color for disabled links */
                        border-color: #d6d6d6; /* Set border color for disabled pages */
                    }

                    /* Override Bootstrap active state (to prevent the default blue background) */
                    .pagination .page-item.active .page-link {
                        background-color: #EF6767 !important; /* Force active background color */
                        border-color: #EF6767 !important; /* Force active border color */
                        color: white !important; /* Ensure active page text color is white */
                    }
                </style>
            </div>
        </div>

        @include('dash.dashfooter')
    </div>
@endsection

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

        <h3 class="fs-22 font-weight-semi-bold mb-3 ms-3">Tutors</h3>

        <div class="card mx-3">
            <div class="card-body ">
                {{-- <h5 class="card-title"></h5> --}}

                <!-- Table with hoverable rows -->
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 5%;">#</th>
                            <th scope="col" style="width: 5%;">Name</th>
                            <th scope="col" style="width: 5%;">Role</th>
                            <th scope="col" style="width: 5%;">Email</th>
                            <th scope="col" style="width: 5%;">Active</th>
                            <th scope="col" style="width: 5%;">Status</th>
                            <th scope="col" style="width: 5%;">Uploaded Course</th>
                            {{-- <th scope="col" style="width: 5%;">Verification Documents</th> --}}
                            <th scope="col" style="width: 5%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tutors as $index => $tutor)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $tutor->fname }} {{ $tutor->lname }}</td>
                                <td>{{ $tutor->role }}</td>
                                <td>{{ $tutor->email }}</td>
                                <td>{{ $tutor->active ? 'Active' : 'Not Active' }}</td>
                                <td>{{ $tutor->verified ? 'Verified' : 'Not Verified' }}</td>
                                <td>{{ $tutor->courses->count() }}</td> <!-- Adjust relationship name if needed -->
                                {{-- <td>{{ $tutor->verification_documents }}</td> <!-- Adjust field name if needed --> --}}
                                <td>
                                    <!-- Vertical Dots Menu with SVG -->
                                    <div class="dropdown">
                                        <!-- Use SVG Image for the button -->
                                        <a href="javascript:void(0);" class="dot-btn"
                                            style="display: inline-block; cursor: pointer;" onclick="toggleDropdown(this)">
                                            <!-- Inline SVG for the 3 vertical dots -->
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="12" r="2" fill="black" />
                                                <circle cx="12" cy="12" r="2" fill="black" />
                                                <circle cx="20" cy="12" r="2" fill="black" />
                                            </svg>
                                        </a>
                                        <!-- Dropdown Content -->
                                        <div class="dropdown-content" style="display: none;">
                                            <a href="">View</a>
                                            <a href="">Edit</a>
                                            <a href="">Block</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No tutors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- End Table with hoverable rows -->

                <!-- Pagination Controls -->
                <div class="d-flex justify-content-center">
                    {{ $tutors->links() }} <!-- This will generate the pagination links -->
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
        {{-- end of wrap --}}
    </div>
    <script>
        function toggleDropdown(button) {
            const dropdownContent = button.nextElementSibling;

            // Close other dropdowns
            document.querySelectorAll('.dropdown-content').forEach((el) => {
                if (el !== dropdownContent) {
                    el.style.display = 'none';
                }
            });

            // Toggle the current dropdown
            dropdownContent.style.display =
                dropdownContent.style.display === 'block' ? 'none' : 'block';
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-content').forEach((el) => {
                    el.style.display = 'none';
                });
            }
        });
    </script>
@endsection

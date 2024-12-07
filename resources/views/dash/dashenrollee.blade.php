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

        <h3 class="fs-22 font-weight-semi-bold mb-3 ms-3">Enrollees</h3>

        <div class="card-body">
            @if (session('success'))
                <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>


        <style>
            .table-wrap {
                overflow-x: auto;
            }
        </style>
        <!-- Table with hoverable rows -->
        <div class="container mt-5">
            <div class="table-wrap">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 5%;">#</th>
                            <th scope="col" style="width: 5%;">Course Name</th>
                            <th scope="col" style="width: 5%;">Enrollee Name</th>
                            <th scope="col" style="width: 5%;">Status</th>
                            <th scope="col" style="width: 5%;">Payment Status</th>
                            <th scope="col" style="width: 5%;">Enrolled</th>
                            <th scope="col" style="width: 5%;">Created</th>
                            <th scope="col" style="width: 5%;">View Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @foreach ($user->enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->id }}</td>
                                    <!-- Combined iteration if you need both user and enrollment count -->
                                    <td>{{ $enrollment->course->title }}</td>
                                    <td>{{ $enrollment->user->fname }} {{ $enrollment->user->lname }}</td>
                                    <td>
                                        <form action="{{ route('enrollment.updateStatus', $enrollment->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm"
                                                onchange="this.form.submit()">
                                                <option value="pending"
                                                    {{ $enrollment->status === 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <!-- Disable the 'Approved' option if payment is pending or rejected -->
                                                <option value="approved"
                                                    {{ $enrollment->status === 'approved' ? 'selected' : '' }}
                                                    @if ($enrollment->isPaid == 0 || $enrollment->isPaid == 2) disabled @endif>
                                                    Approved
                                                </option>

                                                <option value="rejected"
                                                    {{ $enrollment->status === 'rejected' ? 'selected' : '' }}
                                                    @if ($enrollment->isPaid == 0 || $enrollment->isPaid == 1) disabled @endif>
                                                    Rejected</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        @if ($enrollment->isPaid == 0)
                                            <span class="text-warning"
                                                style="font-size: 1rem; padding: 0.3rem 1rem;">Pending</span>
                                        @elseif ($enrollment->isPaid == 1)
                                            <span class="text-success"
                                                style="font-size: 1rem; padding: 0.3rem 2rem;">Paid</span>
                                        @elseif ($enrollment->isPaid == 2)
                                            <span class="text-danger"
                                                style="font-size: 1rem; padding: 0.3rem 1rem;">Reject</span>
                                        @else
                                            <span class="text-muted">Unknown</span>
                                        @endif
                                    </td>
                                    <td>{{ $enrollment->created_at->diffForHumans() }}</td>
                                    <td>{{ $enrollment->created_at->format('M j, Y') }}</td>
                                    @if ($enrollment->payment && $enrollment->isPaid == 1)
                                        <td class="text-center">
                                            <button class="me-3 no-style-button" title="View"
                                                style="background: none; padding: 0; border: none;" data-bs-toggle="modal"
                                                data-bs-target="#paymentScreenshotModal"
                                                onclick="viewPaymentScreenshot('{{ asset('storage/' . $enrollment->payment->screenshot) }}')">
                                                View
                                            </button>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            Pending
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with hoverable rows -->
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }} <!-- Pagination links -->
        </div>
        <style>
            .pagination {
                display: flex;
                justify-content: center;
            }

            .pagination a,
            .pagination span {
                color: #EF6767;
                /* Set text color */
                background-color: transparent;
                /* Ensure no background color for normal links */
                border-color: #EF6767;
                /* Set border color to match text color */
            }

            .pagination a:hover {
                color: #C85A5A;
                /* Change color on hover */
                background-color: #F2D1D1;
                /* Light background on hover */
                border-color: #EF6767;
                /* Border color on hover */
            }

            .pagination .active {
                background-color: #EF6767;
                /* Set active page background color */
                color: white;
                /* Active page text color */
                border-color: #EF6767;
                /* Set border color for active page */
            }

            .pagination .disabled {
                color: #d6d6d6;
                /* Set color for disabled pages */
                background-color: transparent;
                /* Ensure no background color for disabled links */
                border-color: #d6d6d6;
                /* Set border color for disabled pages */
            }

            /* Override Bootstrap active state (to prevent the default blue background) */
            .pagination .page-item.active .page-link {
                background-color: #EF6767 !important;
                /* Force active background color */
                border-color: #EF6767 !important;
                /* Force active border color */
                color: white !important;
                /* Ensure active page text color is white */
            }
        </style> <div class="d-flex justify-content-center mt-3">
        {{ $users->links() }} <!-- Pagination links -->
    </div>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
        }

        .pagination a,
        .pagination span {
            color: #EF6767;
            /* Set text color */
            background-color: transparent;
            /* Ensure no background color for normal links */
            border-color: #EF6767;
            /* Set border color to match text color */
        }

        .pagination a:hover {
            color: #C85A5A;
            /* Change color on hover */
            background-color: #F2D1D1;
            /* Light background on hover */
            border-color: #EF6767;
            /* Border color on hover */
        }

        .pagination .active {
            background-color: #EF6767;
            /* Set active page background color */
            color: white;
            /* Active page text color */
            border-color: #EF6767;
            /* Set border color for active page */
        }

        .pagination .disabled {
            color: #d6d6d6;
            /* Set color for disabled pages */
            background-color: transparent;
            /* Ensure no background color for disabled links */
            border-color: #d6d6d6;
            /* Set border color for disabled pages */
        }

        /* Override Bootstrap active state (to prevent the default blue background) */
        .pagination .page-item.active .page-link {
            background-color: #EF6767 !important;
            /* Force active background color */
            border-color: #EF6767 !important;
            /* Force active border color */
            color: white !important;
            /* Ensure active page text color is white */
        }
    </style>
        @include('dash.dashfooter')
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $users->links() }} <!-- Pagination links -->
    </div>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
        }

        .pagination a,
        .pagination span {
            color: #EF6767;
            /* Set text color */
            background-color: transparent;
            /* Ensure no background color for normal links */
            border-color: #EF6767;
            /* Set border color to match text color */
        }

        .pagination a:hover {
            color: #C85A5A;
            /* Change color on hover */
            background-color: #F2D1D1;
            /* Light background on hover */
            border-color: #EF6767;
            /* Border color on hover */
        }

        .pagination .active {
            background-color: #EF6767;
            /* Set active page background color */
            color: white;
            /* Active page text color */
            border-color: #EF6767;
            /* Set border color for active page */
        }

        .pagination .disabled {
            color: #d6d6d6;
            /* Set color for disabled pages */
            background-color: transparent;
            /* Ensure no background color for disabled links */
            border-color: #d6d6d6;
            /* Set border color for disabled pages */
        }

        /* Override Bootstrap active state (to prevent the default blue background) */
        .pagination .page-item.active .page-link {
            background-color: #EF6767 !important;
            /* Force active background color */
            border-color: #EF6767 !important;
            /* Force active border color */
            color: white !important;
            /* Ensure active page text color is white */
        }
    </style>
    <!-- End of Card -->


    <!-- Modal -->
    <div class="modal fade" id="paymentScreenshotModal" tabindex="-1" aria-labelledby="paymentScreenshotModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentScreenshotModalLabel">Payment Screenshot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="paymentScreenshot" src="" alt="Screenshot" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

    <script>
        function viewPaymentScreenshot(imageUrl) {
            // Set the source of the image in the modal
            document.getElementById('paymentScreenshot').src = imageUrl;
        }
    </script>
    {{-- End of Modal View --}}
    <!-- End Dashboard Content -->
@endsection

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

        <div class="card mx-3">
            <div class="card-body">
                <!-- Table with hoverable rows -->
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 5%;">#</th>
                            <th scope="col" style="width: 5%;">Course Name</th>
                            <th scope="col" style="width: 5%;">Enrollee Name</th>
                            <th scope="col" style="width: 5%;">Status</th>
                            <th scope="col" style="width: 5%;">Enrolled</th>
                            <th scope="col" style="width: 5%;">Created</th>
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
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="pending"
                                                    {{ $enrollment->status === 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="in_progress"
                                                    {{ $enrollment->status === 'in_progress' ? 'selected' : '' }}>In
                                                    Progress</option>
                                                <option value="approved"
                                                    {{ $enrollment->status === 'approved' ? 'selected' : '' }}>Approved
                                                </option>
                                                <option value="rejected"
                                                    {{ $enrollment->status === 'rejected' ? 'selected' : '' }}>Rejected
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>{{ $enrollment->created_at->diffForHumans() }}</td>
                                    <td>{{ $enrollment->created_at->format('M j, Y') }}</td>
                                </tr>
                            @endforeach
                        @endforeach


                    </tbody>
                </table>
                <!-- End Table with hoverable rows -->

            </div>
        </div>
        <div>
            <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }} <!-- Pagination links -->
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
            <!-- End of Card -->
            {{-- <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }} <!-- Pagination links -->
            </div> --}}
            @include('dash.dashfooter')
        </div>
        <!-- End Dashboard Content -->

        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const viewVerificationModal = document.getElementById('viewVerificationModal');

                viewVerificationModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // The button that triggered the modal

                    // Extract data attributes from the button
                    // Extract data attributes from the button
                    const fname = button.getAttribute('data-fname');
                    const lname = button.getAttribute('data-lname');
                    const idPhoto = button.getAttribute('data-id-photo');
                    const selfieWithId = button.getAttribute('data-selfie-with-id');
                    const diploma = button.getAttribute('data-diploma');

                    // Set the modal title dynamically using fname and lname
                    const modalTitle = viewVerificationModal.querySelector('.modal-title');
                    modalTitle.textContent = `${fname} ${lname} - Verification Documents`;

                    // Update modal images
                    viewVerificationModal.querySelector('#idPhoto').src = idPhoto ? `/storage/${idPhoto}` :
                        '/default/path-to-id-placeholder.jpg';
                    viewVerificationModal.querySelector('#selfieWithId').src = selfieWithId ?
                        `/storage/${selfieWithId}` : '/default/path-to-selfie-placeholder.jpg';

                    const diplomaSection = viewVerificationModal.querySelector('#diplomaSection');
                    if (diploma) {
                        diplomaSection.querySelector('#diplomaPhoto').src = `/storage/${diploma}`;
                        diplomaSection.style.display = 'block';
                    } else {
                        diplomaSection.style.display = 'none';
                    }
                });

                // Pop-Out Logic
                const imagePopOut = document.getElementById('imagePopOut');
                const popOutImage = document.getElementById('popOutImage');

                document.querySelectorAll('.clickable-image').forEach(image => {
                    image.addEventListener('click', function() {
                        popOutImage.src = this.src; // Set the clicked image's source
                        imagePopOut.classList.remove('d-none'); // Show the pop-out
                    });
                });

                // Close the pop-out when clicking outside the image
                imagePopOut.addEventListener('click', function(event) {
                    if (event.target === imagePopOut || event.target.closest('.image-popout-wrapper')) {
                        imagePopOut.classList.add('d-none'); // Hide the pop-out
                    }
                });

                // Close the pop-out when pressing the Escape key
                document.addEventListener('keydown', function(event) {
                    if (event.key === "Escape") {
                        imagePopOut.classList.add('d-none'); // Hide the pop-out
                    }
                });
            });
        </script> --}}


        {{-- @push('scripts')
            <script>
                document.querySelectorAll('.verification-status').forEach(select => {
                    select.addEventListener('change', function() {
                        let userId = this.getAttribute('data-user-id');
                        let verificationStatus = this.value;

                        // Send an AJAX request to update the verification status
                        let updateUrl = '/admin/users/' + userId + '/approve'; // Default is approve route

                        // Check if the status is rejected, update URL to the reject route
                        if (verificationStatus === 'rejected') {
                            updateUrl = '/admin/users/' + userId + '/reject'; // Reject route
                        }

                        fetch(updateUrl, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    verification_status: verificationStatus
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'Verification status updated successfully.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    // Update the select dropdown with the new status value
                                    select.value =
                                        verificationStatus; // Ensure the dropdown reflects the change

                                    // Optionally, reload the page to reflect changes (uncomment if necessary)
                                    // window.location.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops!',
                                        text: 'Failed to update verification status.',
                                        showConfirmButton: true
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'An error occurred while processing your request.',
                                    showConfirmButton: true
                                });
                                console.error('Error:', error);
                            });
                    });
                });
            </script>
        @endpush --}}
    @endsection

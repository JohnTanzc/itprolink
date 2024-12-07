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

        <h3 class="fs-22 font-weight-semi-bold mb-3 ms-3">User Data</h3>

        <div class="card mx-3">
            <div class="card-body">
                <!-- Table with hoverable rows -->
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 5%;">#ID</th>
                            <th scope="col" style="width: 5%;">Name</th>
                            <th scope="col" style="width: 5%;">Role</th>
                            <th scope="col" style="width: 5%;">Joined</th>
                            <th scope="col" style="width: 5%;">Verification Status</th>
                            <th scope="col" style="width: 5%; text-align: center;">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @if ($user->role !== 'tuters')
                                <!-- Exclude admin from being displayed -->
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->fname }} {{ $user->lname }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>{{ $user->created_at->format('M j, Y') }}</td>
                                    <td>
                                        <!-- Use an onchange event to trigger AJAX call to update status -->
                                        <select class="form-select form-select-sm verification-status"
                                            data-user-id="{{ $user->id }}" data-role="{{ $user->role }}">
                                            <option value="not_submitted"
                                                {{ $user->verification_status == 'not_submitted' ? 'selected' : '' }}
                                                disabled>Not Submitted</option>
                                            <option value="pending"
                                                {{ $user->verification_status == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="approved"
                                                {{ $user->verification_status == 'approved' ? 'selected' : '' }}>Approved
                                            </option>
                                            <option value="rejected"
                                                {{ $user->verification_status == 'rejected' ? 'selected' : '' }}>Rejected
                                            </option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <!-- Action Buttons -->
                                        <button class="custom-btn me-3" title="View" data-bs-toggle="modal"
                                            data-bs-target="#viewVerificationModal" data-id-photo="{{ $user->id_photo }}"
                                            data-selfie-with-id="{{ $user->selfie_with_id }}"
                                            data-fname="{{ $user->fname }}" data-lname="{{ $user->lname }}"
                                            @if ($user->role === 'tutor') data-diploma="{{ $user->diploma }}"
                                        @else
                                        data-diploma="" @endif>
                                            <i class="la la-eye fs-2 icon-primary"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with hoverable rows -->
            </div>
        </div>
        <div>
            <!-- End of Card -->
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
            @include('dash.dashfooter')
        </div>
        <!-- End Dashboard Content -->

        {{-- Modal for Rejection --}}
        <div class="modal fade" id="rejectionReasonModal" tabindex="-1" aria-labelledby="rejectionReasonLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectionReasonLabel">Rejection Reason</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea id="rejectionReason" class="form-control" placeholder="Enter reason for rejection"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="submitRejectionReason">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Verification Modal -->
        <div class="modal fade" id="viewVerificationModal" tabindex="-1" aria-labelledby="viewVerificationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewVerificationModalLabel">Verification Documents</h5>
                        <!-- Dynamic Title will be Set Here -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="mb-2">ID Photo</h6>
                                <img id="idPhoto" class="img-fluid clickable-image" src="" alt="ID Photo" />
                            </div>
                            <div class="col-md-4">
                                <h6 class="mb-2">Selfie with ID</h6>
                                <img id="selfieWithId" class="img-fluid clickable-image" src=""
                                    alt="Selfie with ID" />
                            </div>
                            <div class="col-md-4" id="diplomaSection">
                                <h6 class="mb-2">Diploma</h6>
                                <img id="diplomaPhoto" class="img-fluid clickable-image" src="" alt="Diploma" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Floating Image Pop-Out -->
        <div id="imagePopOut" class="image-popout d-none">
            <div class="image-popout-wrapper">
                <img id="popOutImage" class="image-popout-content" src="" alt="Enlarged Image" />
            </div>
        </div>


        <script>
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
        </script>


        @push('scripts')
            <script>
                document.querySelectorAll('.verification-status').forEach(select => {
                    select.addEventListener('change', function() {
                        let userId = this.getAttribute('data-user-id');
                        let verificationStatus = this.value;

                        // Define the base URL for updates
                        let updateUrl = '/admin/users/' + userId + '/approve'; // Default is the approve route

                        // Check if the status is "rejected" and update URL accordingly
                        if (verificationStatus === 'rejected') {
                            updateUrl = '/admin/users/' + userId + '/reject'; // Reject route
                        }

                        // Prepare request body
                        const requestData = {
                            verification_status: verificationStatus
                        };

                        // If the status is rejected, prompt for a reason
                        if (verificationStatus === 'rejected') {
                            Swal.fire({
                                title: 'Rejection Reason',
                                input: 'textarea',
                                inputPlaceholder: 'Enter the reason for rejection...',
                                inputAttributes: {
                                    'aria-label': 'Enter the reason for rejection'
                                },
                                showCancelButton: true,
                                confirmButtonText: 'Submit',
                                cancelButtonText: 'Cancel'
                            }).then(result => {
                                if (result.isConfirmed) {
                                    requestData.reason = result.value; // Add reason to the request body
                                    sendVerificationRequest(updateUrl, requestData, select,
                                        verificationStatus);
                                } else {
                                    // Reset dropdown to its previous value if rejection is cancelled
                                    select.value = select.getAttribute('data-current-status');
                                }
                            });
                        } else {
                            sendVerificationRequest(updateUrl, requestData, select, verificationStatus);
                        }
                    });
                });

                /**
                 * Send AJAX request for updating the verification status.
                 *
                 * @param {string} url - The API endpoint.
                 * @param {object} data - The request body.
                 * @param {HTMLSelectElement} select - The dropdown element.
                 * @param {string} status - The selected status value.
                 */
                function sendVerificationRequest(url, data, select, status) {
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(data)
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
                                select.setAttribute('data-current-status', status); // Save current status
                                select.value = status; // Ensure the dropdown reflects the change
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
                }
            </script>
        @endpush
    @endsection

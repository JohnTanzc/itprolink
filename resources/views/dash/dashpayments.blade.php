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



         <style>
             .table-wrap {
                 overflow-x: auto;
             }

             table {
                 white-space: nowrap;
             }
         </style>
         <div class="container mt-3">
            <h3 class="fs-22 font-weight-semi-bold mb-3 ms-0">Payments</h3>
             <div class="table-wrap">
                 <table class="table table-hover table-bordered">
                     <thead class="table-light">
                         <tr>
                             <th>Enrollment ID</th>
                             <th>Enrollee Name</th>
                             <th>Course</th>
                             <th>Tutor</th>
                             <th>Status</th>
                             <th>Submitted</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @if ($payments->isEmpty())
                             <tr>
                                 <td colspan="7" class="text-center text-muted">No payments data available.</td>
                             </tr>
                         @else
                             @foreach ($payments as $payment)
                                 <tr>
                                     <td>{{ $payment['enrollment_id'] }}</td>
                                     <td>{{ $payment->enrollment->user->fname }} {{ $payment->enrollment->user->lname }}
                                     </td>
                                     <td>{{ $payment->enrollment->course->title }}</td>
                                     <td>{{ $payment->enrollment->course->user->fname }}
                                         {{ $payment->enrollment->course->user->lname }}</td>
                                     <td>
                                         <select name="isPaid" class="form-select form-select-sm"
                                             onchange="updatePaymentStatus({{ $payment->enrollment->id }}, this.value)">
                                             <option value="0"
                                                 {{ $payment->enrollment->isPaid == 0 ? 'selected' : '' }}>
                                                 Pending</option>
                                             <option value="1"
                                                 {{ $payment->enrollment->isPaid == 1 ? 'selected' : '' }}>
                                                 Paid</option>
                                             <option value="2"
                                                 {{ $payment->enrollment->isPaid == 2 ? 'selected' : '' }}>
                                                 Reject</option>
                                         </select>
                                     </td>
                                     <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                     <td>
                                         <div class="action-dots">
                                             <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                 <i class="la la-ellipsis-v" aria-hidden="true"
                                                     style="font-size: 30px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);"></i>
                                             </button>
                                             <ul class="dropdown-menu dropdown-menu-end" style="">
                                                 <li>
                                                     <a class="dropdown-item" href="javascript:void(0);"
                                                         onclick="viewPaymentDetails({{ $payment->enrollment_id }})">
                                                         <i class="la la-eye" aria-hidden="true"
                                                             style="font-size: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"></i>
                                                         View
                                                     </a>
                                                 </li>
                                                 <li>
                                                     <a class="dropdown-item" href="javascript:void(0);"
                                                         onclick="deleteUser(12)">
                                                         <i class="la la-trash" aria-hidden="true"
                                                             style="font-size: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"></i>
                                                         Delete
                                                     </a>
                                                 </li>
                                             </ul>
                                         </div>
                                     </td>
                                 </tr>
                             @endforeach
                         @endif
                     </tbody>
                 </table>
             </div>
         </div>

         <div class="d-flex justify-content-center mt-3 mb-3">
            {{ $payments->links() }} <!-- Pagination links -->
        </div>
        @include('dash.dashfooter')
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

         <!-- Modal Structure -->
         <div id="paymentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
             aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                         <!-- Close Button -->
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <form>
                             <div class="mb-3">
                                 <label for="senderNumber" class="form-label"><strong>Sender Number</strong></label>
                                 <input type="text" class="form-control" id="senderNumber" readonly>
                             </div>
                             <div class="mb-3">
                                 <label for="senderName" class="form-label"><strong>Sender Name</strong></label>
                                 <input type="text" class="form-control" id="senderName" readonly>
                             </div>
                             <div class="mb-3">
                                 <label for="amount" class="form-label"><strong>Amount</strong></label>
                                 <input type="text" class="form-control" id="amount" readonly>
                             </div>
                             <div class="mb-3">
                                 <label for="refNo" class="form-label"><strong>Ref. No</strong></label>
                                 <input type="text" class="form-control" id="refNo" readonly>
                             </div>
                             <div class="mb-3">
                                 <label for="screenshotImage" class="form-label"><strong>Screenshot</strong></label>
                                 <a id="screenshotLink" href="#" target="_blank">
                                     <img id="screenshotImage" src="#" alt="Payment Screenshot" class="img-fluid"
                                         style="cursor: pointer; max-width: 100%; height: auto; max-height: 300px; border: 1px solid #ccc; border-radius: 5px;">
                                 </a>
                             </div>
                         </form>
                     </div>
                     {{-- <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     </div> --}}
                 </div>
             </div>
         </div>
         <!-- JavaScript to handle modal and data population -->
         <script>
             function viewPaymentDetails(enrollmentId) {
                 $.ajax({
                     url: '/payment-details/' + enrollmentId, // Ensure this matches the correct route
                     method: 'GET',
                     success: function(paymentData) {
                         // Populate modal fields
                         document.getElementById('senderNumber').value = paymentData.sender_number;
                         document.getElementById('senderName').value = paymentData.sender_name;
                         document.getElementById('amount').value = paymentData.amount;
                         document.getElementById('refNo').value = paymentData.ref_no;
                         document.getElementById('screenshotImage').src = '/storage/' + paymentData.screenshot;
                         document.getElementById('screenshotLink').href = '/storage/' + paymentData.screenshot;

                         // Show the modal
                         $('#paymentModal').modal('show');
                     },
                     error: function(xhr, status, error) {
                         alert('Failed to fetch payment details: ' + xhr.responseText);
                     }
                 });
             }
         </script>

         <script>
             function updatePaymentStatus(id, status) {
                 $.ajax({
                     url: `/enrollment/${id}/update-payment-status`, // Update the URL to match the route
                     method: 'PUT', // Change to PUT to match the route method
                     data: {
                         isPaid: status, // Send the selected status
                         _token: '{{ csrf_token() }}' // Include CSRF token for security
                     },
                     success: function(response) {
                         // Show success alert if the status update is successful
                         Swal.fire({
                             icon: 'success',
                             title: 'Success!',
                             text: 'Payment status updated successfully.',
                             showConfirmButton: false,
                             timer: 1500
                         });
                     },
                     error: function(xhr, status, error) {
                         // Log error and show error alert if something goes wrong
                         console.log(xhr.responseText); // Log the full response for debugging
                         Swal.fire({
                             icon: 'error',
                             title: 'Error',
                             text: xhr.responseText || 'Something went wrong. Please try again later.',
                         });
                     }
                 });
             }
         </script>
     </div>
 @endsection

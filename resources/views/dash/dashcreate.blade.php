@extends('layouts.main')

@section('content')
    {{-- Header --}}
    @include('dash.dashnav')
    {{-- End of Header --}}

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

        <div class="container mt-4">
            <!-- Filters and Add User Button -->
            <h3 class="fs-22 font-weight-semi-bold ms-0">Users</h3>
            <div class="d-flex justify-content-end align-items-center mb-3">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('admin.dashcreate') }}" class="d-flex align-items-center">
                    <!-- Role Filter -->
                    <div class="me-2">
                        <select name="role" class="form-control form-select" onchange="this.form.submit()">
                            <option value="">Filter by Role</option>
                            <option value="tutor" {{ request('role') == 'tutor' ? 'selected' : '' }}>Tutor</option>
                            <option value="tutee" {{ request('role') == 'tutee' ? 'selected' : '' }}>Tutee</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="me-2">
                        <select name="status" class="form-control form-select" onchange="this.form.submit()">
                            <option value="">Filter by Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Blocked
                            </option>
                        </select>
                    </div>
                </form>

                <!-- Add User Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    Add User
                </button>

            </div>

            <!-- Table of Registered Users -->
            <div class="table-wrap">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>
                                <a
                                    href="{{ route('admin.dashcreate', [
                                        'sort_by' => 'role',
                                        'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc',
                                        'role' => request('role'),
                                        'status' => request('status'),
                                    ]) }}">
                                    Role
                                    @if (request('sort_by') == 'role')
                                        <i class="fa fa-sort-{{ request('sort_order') == 'asc' ? 'asc' : 'desc' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a
                                    href="{{ route('admin.dashcreate', [
                                        'sort_by' => 'active',
                                        'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc',
                                        'role' => request('role'),
                                        'status' => request('status'),
                                    ]) }}">
                                    Status
                                    @if (request('sort_by') == 'status')
                                        <i class="fa fa-sort-{{ request('sort_order') == 'asc' ? 'asc' : 'desc' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $startCount = ($users->currentPage() - 1) * $users->perPage() + 1; // Calculate the starting number
                        @endphp
                        @if ($users->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted">No user data available.</td>
                            </tr>
                        @else
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $startCount++ }}</td>
                                    <td>{{ $user->fname }} {{ $user->lname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ ucwords($user->role) }}</td>
                                    <td>
                                        @if ($user->active == 1)
                                            <span class="text-success">
                                                <i class="la la-check-circle"
                                                    style="text-shadow: 1px 1px 2px rgba(25, 183, 23, 0.807);"></i> Active
                                            </span>
                                        @else
                                            <span class="text-danger">
                                                <i class="la la-ban"></i> Blocked
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-dots">
                                            <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="la la-ellipsis-v" aria-hidden="true"
                                                    style="font-size: 30px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#profileModal" data-user-id="{{ $user->id }}">
                                                        <i class="la la-eye" aria-hidden="true"
                                                            style="font-size: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"></i>
                                                        View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#profileEditModal"
                                                        data-user-id="{{ $user->id }}">
                                                        <i class="la la-edit" aria-hidden="true"
                                                            style="font-size: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"></i>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="deleteUser(event, {{ $user->id }})">
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

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
        @include('dash.dashfooter')
    </div>


    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($user))
                        <div class="row">
                            <!-- Profile Picture -->
                            <div class="col-md-12 d-flex justify-content-center align-items-center text-center">
                                <img src="{{ $user->profile_picture ? asset('storage/profile_pictures/' . $user->profile_picture) : asset('storage/profile_pictures/default-image.png') }}"
                                    alt="Profile Picture" class="img-fluid mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #ccc; border-radius: 10px;">
                            </div>
                            <!-- Profile Details -->
                            <div class="col-md-12">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="fullName" class="col-form-label">Full Name:</label>
                                        <input type="text" class="form-control" id="fullName"
                                            value="{{ $user->fname }} {{ $user->lname }}" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="age" class="col-form-label">Age:</label>
                                        <input type="text" class="form-control" id="age"
                                            value="{{ $user->age }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="userType" class="col-form-label">User Type:</label>
                                        <input type="text" class="form-control" id="userType"
                                            value="{{ ucfirst($user->role) }}" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email" class="col-form-label">Email:</label>
                                        <input type="text" class="form-control" id="email"
                                            value="{{ $user->email }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="gender" class="col-form-label">Gender:</label>
                                        <input type="text" class="form-control" id="gender"
                                            value="{{ ucfirst($user->gender) }}" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="birthday" class="col-form-label">Birthday:</label>
                                        <input type="text" class="form-control" id="birthday"
                                            value="{{ isset($user->birthday) && $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('F d, Y') : '' }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p>No user data available.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileModal = document.getElementById('profileModal');

            profileModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const userId = button.getAttribute('data-user-id'); // Extract user ID from data attribute

                // Make AJAX request to fetch user data
                fetch(`/get-user-profile/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update the modal fields with user data
                        profileModal.querySelector('img').src = data.profile_picture ?
                            data.profile_picture :
                            '/path/to/default-image.png'; // Ensure proper fallback

                        profileModal.querySelector('#fullName').value = `${data.fname} ${data.lname}`;
                        profileModal.querySelector('#age').value = data.age;
                        profileModal.querySelector('#userType').value = data.role ? data.role.charAt(0)
                            .toUpperCase() + data.role.slice(1) : '';
                        profileModal.querySelector('#email').value = data.email;
                        profileModal.querySelector('#gender').value = data.gender ? data.gender.charAt(
                            0).toUpperCase() + data.gender.slice(1) : '';
                        profileModal.querySelector('#birthday').value = data.birthday_formatted ||
                            '';
                    })
                    .catch(error => console.error('Error fetching user data:', error));
            });
        });
    </script>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="profileEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileEditModalLabel">Edit User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($user))
                        <!-- Form for updating the user -->
                        <form id="editProfileForm" method="POST" action="{{ route('admin.updateuser', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="editUserId" name="id">

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="editFirstName" class="col-form-label">First Name:</label>
                                    <input type="text" class="form-control" id="editFirstName" name="fname"
                                        value="{{ old('fname', $user->fname) }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="editLastName" class="col-form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="editLastName" name="lname"
                                        value="{{ old('lname', $user->lname) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="editAge" class="col-form-label">Age:</label>
                                    <input type="text" class="form-control" id="editAge" name="age"
                                        value="{{ $user->age }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="editEmail" class="col-form-label">Email:</label>
                                    <input type="email" class="form-control" id="editEmail" name="email"
                                        value="{{ old('email', $user->email) }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                {{-- <div class="col-sm-6">
                                <label for="editBirthday" class="col-form-label">Birthday:</label>
                                <input type="date" class="form-control" id="editBirthday" name="birthday"
                                    value="{{ old('birthday', isset($user->birthday) && $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}">
                            </div> --}}
                                <div class="col-sm-6">
                                    <label for="editGender" class="col-form-label">Gender:</label>
                                    <select class="form-control form-select" id="editGender" name="gender">
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male"
                                            {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female"
                                            {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>


                                <div class="col-sm-6">
                                    <label for="editUserType" class="col-form-label">User Type:</label>
                                    <select class="form-control form-select" id="editUserType" name="role" required>
                                        <option value="tutee"
                                            {{ old('role', $user->role ?? '') == 'tutee' ? 'selected' : '' }}>Tutee
                                        </option>
                                        <option value="tutor"
                                            {{ old('role', $user->role ?? '') == 'tutor' ? 'selected' : '' }}>Tutor
                                        </option>
                                        <option value="admin"
                                            {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                    </select>
                                </div>


                                <label class="col-form-label mt-2">Account Status:</label>
                                <div class="col-sm-12">
                                    <div class="form-check form-check-inline"> <input class="form-check-input"
                                            type="radio" name="active" id="activeStatus" value="1"
                                            {{ old('active', $user->active ?? '') == '1' ? 'checked' : '' }}> <label
                                            class="form-check-label" for="activeStatus">Active</label> </div>
                                    <div class="form-check form-check-inline"> <input class="form-check-input"
                                            type="radio" name="active" id="blockedStatus" value="0"
                                            {{ old('active', $user->active ?? '') == '0' ? 'checked' : '' }}> <label
                                            class="form-check-label" for="blockedStatus">Blocked</label> </div>
                                </div>
                            </div>
                        @else
                            <p>No user data available.</p>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            // Handle edit button click
            $(document).on("click", "[data-bs-target='#profileEditModal']", function() {
                const userId = $(this).data("user-id");

                // Fetch user data
                $.ajax({
                    url: `/admin/user/${userId}`,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            // Populate modal fields with fetched data
                            $("#editUserId").val(data.id);
                            $("#editFirstName").val(data.fname);
                            $("#editLastName").val(data.lname);
                            $("#editAge").val(data.age);
                            $("#editEmail").val(data.email);
                            $("#editBirthday").val(data.birthday);
                            $("#editGender").val(data.gender);
                            $("#editUserType").val(data.role);

                            // Reset and set radio buttons for account status
                            if (parseInt(data.active) === 1) {
                                // Active account
                                $("#activeStatus").prop("checked", true);
                            } else if (parseInt(data.active) === 0) {
                                // Blocked account
                                $("#blockedStatus").prop("checked", true);
                            }
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to fetch user data. Please try again.",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    },
                });
            });

            // Handle form submission
            $("#editProfileForm").on("submit", function(e) {
                e.preventDefault(); // Prevent traditional form submission

                const userId = $("#editUserId").val(); // Get user ID from hidden field

                $.ajax({
                    url: `/admin/user/${userId}`,
                    type: "PUT",
                    dataType: "json",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === true) {
                            // Close the modal
                            $('#profileEditModal').modal('hide');

                            // Add a delay to ensure modal close animation completes
                            setTimeout(() => {
                                // Store a flag in sessionStorage for SweetAlert
                                sessionStorage.setItem("profileUpdated", "true");
                                // Reload the page
                                window.location.reload();
                            }, 300);
                        } else {
                            Swal.fire({
                                title: "Validation Error!",
                                text: "Validation failed. Please check the input fields.",
                                icon: "warning",
                                confirmButtonText: "OK",
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: "Error!",
                            text: "An error occurred while updating the profile. Please try again.",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    },
                });
            });

            // Check if the flag is set in sessionStorage
            if (sessionStorage.getItem("profileUpdated") === "true") {
                // Remove the flag
                sessionStorage.removeItem("profileUpdated");

                // Show SweetAlert without a button
                Swal.fire({
                    title: "Success!",
                    text: "Profile updated successfully!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000, // Alert disappears after 2 seconds
                });
            }
        });
    </script>

    {{-- Delete Script --}}
    <script>
        function deleteUser(event, userId) {
            event.preventDefault(); // Prevent default link navigation

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/users/${userId}/delete`, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                // Set a flag in localStorage to show the SweetAlert after reload
                                localStorage.setItem('userDeleted', 'true');
                                location.reload(); // Reload the page
                            } else {
                                return response.json().then(err => {
                                    throw new Error(err.message || "Failed to delete the user.");
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                "Error!",
                                error.message,
                                "error"
                            );
                        });
                }
            });
        }

        // Check if the deletion flag is set in localStorage
        window.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('userDeleted') === 'true') {
                // Show the success SweetAlert
                Swal.fire(
                    "Deleted!",
                    "User has been deleted successfully.",
                    "success"
                );
                // Clear the flag from localStorage
                localStorage.removeItem('userDeleted');
            }
        });
    </script>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" action="{{ route('admin.createuser') }}" method="POST">
                        @csrf
                         <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" required>
                        </div>
                         <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" name="lname" id="lname" class="form-control" required>
                        </div>
                         <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                         <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                         <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                        </div>
                         <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="tutor">Tutor</option>
                                <option value="tutee">Tutee</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="addUserForm">Save User</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        });
    </script>
@endsection

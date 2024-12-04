@extends('layouts.main')

@section('content')
    {{-- Header --}}
    @include('dash.dashnav')
    {{-- End of Header --}}

    <div class="dashboard-content-wrap">
        <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ms-3">
            <i class="la la-bars me-1"></i> Dashboard Nav
        </div>

        <h3 class="fs-22 font-weight-semi-bold mb-3 ms-3">Users</h3>

        <div class="container mt-4">
            <!-- Filters and Add User Button -->
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
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                </form>

                <!-- Add User Button -->
                <a href="" class="btn btn-primary">Add User</a>
            </div>

            <!-- Table of Registered Users -->
            <table class="table table-bordered">
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
                                    'active' => request('active'),
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
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->fname }} {{ $user->lname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ ucwords($user->role) }}</td>
                            <td>
                                @if ($user->active == 1)
                                    <span class="text-success">
                                    <i class="la la-check-circle" style= "text-shadow: 1px 1px 2px rgba(25, 183, 23, 0.807);"></i> Active
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
                                        <i class="la la-ellipsis-v" aria-hidden="true" style="font-size: 30px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" style="">
                                        <li><a class="dropdown-item" href="https://techive.danabangan.online/profile/12"><i
                                                    class="la la-eye" aria-hidden="true" style="font-size: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"></i> View</a></li>
                                        <li><a class="dropdown-item"
                                                href="https://techive.danabangan.online/admin/users/12"><i
                                                    class="la la-edit" aria-hidden="true" style="font-size: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="deleteUser(12)"><i
                                                    class="la la-trash" aria-hidden="true" style="font-size: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
        @include('dash.dashfooter')
    </div>
@endsection

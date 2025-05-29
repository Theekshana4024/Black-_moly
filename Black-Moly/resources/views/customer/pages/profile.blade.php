@php use Illuminate\Support\Facades\Auth; @endphp
@extends('customer.layouts.app')
@section('content')
    <!------ Breadcrumbs Start ------>
    <div class="impl_bread_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>My Profile</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!------ Profile wrapper Start ------>
    <div class="impl_profile_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <!-- Profile sidebar navigation -->
                    <div class="profile_sidebar">
                        <div class="profile_info text-center mb-4">
                            <h4 class="mt-3">{{ Auth::user()->name }}</h4>
                            <p class="text-muted">Member since {{ Auth::user()->created_at->format('M Y') }}</p>
                        </div>
                        <ul class="nav flex-column profile_nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="#profile" data-toggle="tab">
                                    <i class="fa fa-user mr-2"></i> My Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#vehicles" data-toggle="tab">
                                    <i class="fa fa-car mr-2"></i> My Vehicles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#transactions" data-toggle="tab">
                                    <i class="fa fa-credit-card mr-2"></i> Transactions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#password" data-toggle="tab">
                                    <i class="fa fa-lock mr-2"></i> Change Password
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out mr-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-9 col-md-8">
                    <!-- Profile content tabs -->
                    <div class="tab-content profile_content">
                        <!-- Profile Information Tab -->
                        <div class="tab-pane fade show active" id="profile">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Profile Information</h5>
                                    <button class="btn btn-sm btn-primary" id="editProfileBtn">Edit Profile</button>
                                </div>
                                <div class="card-body">
                                    <!-- Display Profile Information -->
                                    <div id="profileInfo">
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Name:</div>
                                            <div class="col-md-8">{{ Auth::user()->name }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Email:</div>
                                            <div class="col-md-8">{{ Auth::user()->email }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Phone:</div>
                                            <div class="col-md-8">{{ Auth::user()->contacts->first()?->telephone ?? 'Not provided' }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 font-weight-bold">Address:</div>
                                            <div class="col-md-8">{{ Auth::user()->contacts->first()?->address ?? 'Not provided' }}</div>
                                        </div>
                                    </div>

                                    <!-- Edit Profile Form (Hidden by default) -->
                                    <div id="editProfileForm" style="display: none;">
                                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->contacts->first()?->telephone ?? '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3">{{ Auth::user()->contacts->first()?->address?? '' }}</textarea>
                                            </div>

                                            <div class="form-group mt-4">
                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                                <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- My Vehicles Tab -->
                        <div class="tab-pane fade" id="vehicles">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">My Vehicles</h5>
                                    <a href="{{route('vehicle.sell')}}" class="btn btn-sm btn-primary">Add New Vehicle</a>
                                </div>
                                <div class="card-body">
                                    @if(count(Auth::user()->vehicles) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Listed Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(Auth::user()->vehicles as $vehicle)
                                                    <tr>
                                                        <td>{{ $vehicle->title }}</td>
                                                        <td>Rs {{ number_format($vehicle->price, 2) }}</td>
                                                        <td>
                                                            @if($vehicle->status == 'available')
                                                                <span class="badge badge-success">Available</span>
                                                            @elseif($vehicle->status == 'sold')
                                                                <span class="badge badge-danger">Sold</span>
                                                            @else
                                                                <span class="badge badge-warning">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $vehicle->created_at->format('M d, Y') }}</td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="{{ route('customer.vehicles.show', $vehicle->slug) }}" class="btn btn-info">View</a>
                                                                @if($vehicle->status != 'sold')
                                                                    <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-primary">Edit</a>
                                                                    <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <i class="fa fa-car fa-3x mb-3 text-muted"></i>
                                            <h5>No vehicles listed yet</h5>
                                            <p>Start selling your car by clicking the "Add New Vehicle" button.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Transactions Tab -->
                        <div class="tab-pane fade" id="transactions">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Transaction History</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        $buyerTransactions = Auth::user()->transactions ?? collect([]);
                                        $hasTransactions = count($buyerTransactions) > 0;
                                    @endphp

                                    @if($hasTransactions)
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Vehicle</th>
                                                    <th>Amount</th>
                                                    <th>Payment Method</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($buyerTransactions as $transaction)
                                                    <tr>
                                                        <td>{{ $transaction->vehicle->title }}</td>
                                                        <td>Rs {{ number_format($transaction->vehicle->price, 2) }}</td>
                                                        <td>{{ ucfirst($transaction->payment_method) }}</td>
                                                        <td>
                                                            @if($transaction->payment_status == 'paid')
                                                                <span class="badge badge-success">Paid</span>
                                                            @elseif($transaction->payment_status == 'pending')
                                                                <span class="badge badge-warning">Pending</span>
                                                            @else
                                                                <span class="badge badge-danger">Refunded</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <i class="fa fa-credit-card fa-3x mb-3 text-muted"></i>
                                            <h5>No transactions found</h5>
                                            <p>Your purchase history will appear here.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="password">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Change Password</h5>
                                </div>
                                <div class="card-body">
                                    @if(session('password_success'))
                                        <div class="alert alert-success">
                                            {{ session('password_success') }}
                                        </div>
                                    @endif

                                    @if(session('password_error'))
                                        <div class="alert alert-danger">
                                            {{ session('password_error') }}
                                        </div>
                                    @endif

                                    <form action="{{ route('profile.password.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="current_password">Current Password</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                                            @error('current_password')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password">New Password</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                                            @error('new_password')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password_confirmation">Confirm New Password</label>
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                        </div>

                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary">Update Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle between profile info view and edit form
            const editProfileBtn = document.getElementById('editProfileBtn');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            const profileInfo = document.getElementById('profileInfo');
            const editProfileForm = document.getElementById('editProfileForm');

            if (editProfileBtn) {
                editProfileBtn.addEventListener('click', function() {
                    profileInfo.style.display = 'none';
                    editProfileForm.style.display = 'block';
                });
            }

            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', function() {
                    profileInfo.style.display = 'block';
                    editProfileForm.style.display = 'none';
                });
            }

            // Tab navigation
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab');

            if (activeTab) {
                // Activate the tab from URL parameter
                const tabElement = document.querySelector(`.nav-link[href="#${activeTab}"]`);
                if (tabElement) {
                    const tabTrigger = new bootstrap.Tab(tabElement);
                    tabTrigger.show();
                }
            }

            // Update URL when tab changes
            const tabLinks = document.querySelectorAll('.profile_nav .nav-link');
            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!this.getAttribute('href').startsWith('#')) return;

                    e.preventDefault();
                    const tabId = this.getAttribute('href').substring(1);
                    history.replaceState(null, null, `?tab=${tabId}`);

                    // Remove active class from all tabs
                    tabLinks.forEach(tab => tab.classList.remove('active'));
                    // Add active class to current tab
                    this.classList.add('active');

                    // Hide all tab panes
                    document.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.remove('show', 'active');
                    });

                    // Show the selected tab pane
                    const selectedPane = document.querySelector(`#${tabId}`);
                    if (selectedPane) {
                        selectedPane.classList.add('show', 'active');
                    }
                });
            });
        });
    </script>
    <style>
        .tab-pane.fade {
            background-color: transparent !important;
            color: black;
        }

        .tab-pane.fade p,
        .tab-pane.fade h5,
        .tab-pane.fade label,
        .tab-pane.fade .form-control,
        .tab-pane.fade .col-md-8,
        .tab-pane.fade .col-md-4 {
            color: black !important;
        }
    </style>
@endsection

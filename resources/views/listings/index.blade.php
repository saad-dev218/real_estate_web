@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-4">
        <!-- Profile Section -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white">
                <h6 class="card-title mb-0">Profile</h6>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row align-items-center text-center">
                        <!-- Profile Image -->
                        <div class="col-md-4">
                            <label for="profile_picture" class="d-block position-relative">
                                <img src="{{ Auth::user()->profile_picture ?? 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png' }}"
                                    alt="Profile Image" class="img-fluid rounded-circle border border-3 shadow-sm"
                                    style="width: 110px; height: 110px; object-fit: cover; cursor: pointer;"
                                    id="profileImagePreview">
                            </label>
                            <input type="file" name="profile_picture" id="profile_picture" class="d-none"
                                accept="image/*" onchange="previewImage(event)">
                            <small class="text-muted d-block mt-2">Click image to update</small>
                        </div>

                        <!-- User Name -->
                        <div class="col-md-4">
                            <label class="fw-bold text-muted">User Name</label>
                            <input type="text" class="form-control form-control-sm text-center border-0 bg-light"
                                value="{{ Auth::user()->name ?? 'N/A' }}" disabled>
                        </div>

                        <!-- User Email -->
                        <div class="col-md-4">
                            <label class="fw-bold text-muted">User Email</label>
                            <input type="email" class="form-control form-control-sm text-center border-0 bg-light"
                                value="{{ Auth::user()->email ?? 'N/A' }}" disabled>
                        </div>
                    </div>

                    <!-- Update Button -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-upload"></i> Update Profile Picture
                        </button>
                    </div>
                </div>
            </form>
        </div>



        <!-- Listings Section -->


        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center ">
                    <h5>Your Listings</h5>
                    <a href="{{ route('listings.create') }}" class="btn btn-success">+ Create Listing</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $listings = [];
                        @endphp
                        @forelse($listings as $key => $listing)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $listing->title }}</td>
                                <td>${{ number_format($listing->price, 2) }}</td>
                                <td>{{ $listing->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('listings.edit', $listing->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('listings.destroy', $listing->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this listing?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No listings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            let reader = new FileReader();
            reader.onload = function() {
                document.getElementById('profileImagePreview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection

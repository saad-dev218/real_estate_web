@extends('layouts.app')

@section('title', 'Create Listing')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Create New Listing</h5>
                </div>
                <div>
                    <a href="{{ route('listings.index') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                </div>
            </div>
            <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- Title Input -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Listing Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            placeholder="Enter listing title" required>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control" placeholder="Enter description"
                            required></textarea>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="images" class="form-label">Listing Images</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
                    </div>
                    <!-- Featured Listing Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input">
                        <label for="is_featured" class="form-check-label">Mark as Featured Listing</label>
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-sm">Create Listing</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

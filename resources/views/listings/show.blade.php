@extends('layouts.app')

@section('title', 'Listing Details')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Listing Details</h5>
                <div>
                    <a href="{{ route('listings.edit', 45) }}" class="btn btn-warning btn-sm me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('listings.destroy', 45) }}" method="POST"
                        class="d-inline" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Listing Details -->
                    <h4 class="fw-bold">{{ $listing->title ?? 'N/A' }}</h4>
                    <p><strong>Description:</strong> {{ $listing->description ?? 'N/A' }}</p>

                    <h4 class="fw-bold">Listing Images</h4>
                    <!-- Gallery -->
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                                class="w-100 shadow-sm rounded mb-4" alt="Boat on Calm Water" />

                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain1.webp"
                                class="w-100 shadow-sm rounded mb-4" alt="Wintry Mountain Landscape" />
                        </div>

                        <div class="col-lg-4 mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain2.webp"
                                class="w-100 shadow-sm rounded mb-4" alt="Mountains in the Clouds" />

                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                                class="w-100 shadow-sm rounded mb-4" alt="Boat on Calm Water" />
                        </div>

                        <div class="col-lg-4 mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp"
                                class="w-100 shadow-sm rounded mb-4" alt="Waves at Sea" />

                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain3.webp"
                                class="w-100 shadow-sm rounded mb-4" alt="Yosemite National Park" />
                        </div>
                    </div>
                    <!-- Gallery -->
                </div>
            </div>
        </div>
    </div>
@endsection
